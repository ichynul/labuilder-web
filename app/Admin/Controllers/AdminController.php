<?php

namespace App\Admin\Controllers;

use App\Admin\Models\AdminGroup;
use App\Admin\Models\AdminRole;
use App\Admin\Models\AdminUser;
use Ichynul\Labuilder\Traits\HasResource;
use Illuminate\Routing\Controller;

/**
 * Undocumented class
 * @title 管理员管理
 */
class AdminController extends Controller
{
    use HasResource;

    /**
     * Undocumented variable
     *
     * @var AdminUser
     */
    protected $dataModel;

    /**
     * Undocumented variable
     *
     * @var AdminRole
     */
    protected $roleModel;

    /**
     * Undocumented variable
     *
     * @var \think\Model
     */
    protected $groupModel;

    public function __construct()
    {
        $this->dataModel = new AdminUser;
        $this->roleModel = new AdminRole;
        $this->groupModel = new AdminGroup;

        $this->pageTitle = '用户管理';
        $this->postAllowFields = ['phone', 'name', 'email'];
        $this->delNotAllowed = [1, session('admin_id')];

        $this->selectTextField = '{id}#{name}({username})';
        $this->selectFields = 'id,name,username';
        $this->selectSearch = 'username|name|phone';
    }

    protected function filterWhere()
    {
        $searchData = request()->post();

        $where = [];
        if (!empty($searchData['username'])) {
            $where[] = ['username', 'like', '%' . $searchData['username'] . '%'];
        }

        if (!empty($searchData['name'])) {
            $where[] = ['name', 'like', '%' . $searchData['name'] . '%'];
        }

        if (!empty($searchData['phone'])) {
            $where[] = ['phone', 'like', '%' . $searchData['phone'] . '%'];
        }

        if (!empty($searchData['email'])) {
            $where[] = ['email', 'like', '%' . $searchData['email'] . '%'];
        }

        if (!empty($searchData['role_id'])) {
            $where[] = ['role_id', 'eq', $searchData['role_id']];
        }

        if (!empty($searchData['group_id'])) {
            $where[] = ['group_id', 'eq', $searchData['group_id']];
        }

        return $where;
    }

    /**
     * 构建搜索
     *
     * @return void
     */
    protected function buildSearch()
    {
        $search = $this->search;

        $search->text('username', '账号')->maxlength(20);
        $search->text('name', '姓名')->maxlength(20);
        $search->text('phone', '手机号')->maxlength(20);
        $search->text('email', '邮箱')->maxlength(20);
        $search->select('role_id', '角色组')->optionsData($this->roleModel->all(), 'name');
        if (method_exists($this->groupModel, 'buildTree')) {
            $search->select('group_id', '分组')->options([0 => '请选择'] + $this->groupModel->buildTree());
        } else {
            $search->select('group_id', '分组')->optionsData($this->groupModel->all(), 'name');
        }
    }

    /**
     * 构建表格
     *
     * @return void
     */
    protected function buildTable(&$data = [])
    {
        $table = $this->table;

        $table->show('id', 'ID');
        $table->show('username', '登录帐号');
        $table->text('name', '姓名')->autoPost()->getWrapper()->addStyle('max-width:80px');
        $table->show('role_name', '角色');
        $table->show('group_name', '分组');
        $table->match('enable', '启用')->options([0 => '<label class="label label-danger">禁用</label>', 1 => '<label class="label label-success">正常</label>']);
        $table->show('email', '电子邮箱')->default('无');
        $table->show('phone', '手机号')->default('无');
        $table->show('errors', '登录失败');
        $table->show('login_time', '登录时间')->getWrapper()->addStyle('width:180px');
        $table->show('created_at', '添加时间')->getWrapper()->addStyle('width:180px');

        foreach ($data as &$d) {
            $d['__h_del__'] = $d['id'] == 1;
            $d['__h_en__'] = $d['enable'] == 1;
            $d['__h_dis__'] = $d['enable'] != 1 || $d['id'] == 1;
            $d['__h_clr__'] = $d['errors'] < 1;
        }
        unset($d);

        $table->getToolbar()
            ->btnCreate()
            ->btnEnable()
            ->btnDisable()
            ->btnRefresh();

        $table->getActionbar()
            ->btnEdit()
            ->btnEnableAndDisable()
            ->btnShow()
            ->btnDestroy()
            ->btnPostRowid('clear_errors', url('clearErrors'), '', 'btn-info', 'mdi-backup-restore', 'title="重置登录失败次数"')
            ->mapClass([
                'delete' => ['hidden' => '__h_del__'],
                'enable' => ['hidden' => '__h_en__'],
                'disable' => ['hidden' => '__h_dis__'],
                'clear_errors' => ['hidden' => '__h_clr__'],
            ]);
    }

    /**
     * 构建表单
     *
     * @param boolean $isEdit
     * @param array $data
     */
    protected function buildForm($isEdit, &$data = [])
    {
        $form = $this->form;

        $form->text('username', '登录帐号')->required()->beforSymbol('<i class="mdi mdi-account-key"></i>');
        $form->text('name', '姓名')->required()->beforSymbol('<i class="mdi mdi-rename-box"></i>');
        $form->password('password', '密码')->required(!$isEdit)->beforSymbol('<i class="mdi mdi-lock"></i>')->help($isEdit ? '不修改则留空（6～20位）' : '添加用户，密码必填（6～20位）');
        $form->select('role_id', '角色')->required()->optionsData($this->roleModel->all(), 'name')->disabled($isEdit && $data['id'] == 1);

        if (method_exists($this->groupModel, 'buildTree')) {
            $form->select('group_id', '分组')->options([0 => '请选择'] + $this->groupModel->buildTree());
        } else {
            $form->select('group_id', '分组')->optionsData($this->groupModel->all(), 'name');
        }

        $form->image('avatar', '头像')->default('/vendor/ichynul/labuilder/lightyearadmin/images/no-avatar.jpg');
        $form->text('email', '电子邮箱')->beforSymbol('<i class="mdi mdi-email-variant"></i>');
        $form->text('phone', '手机号')->beforSymbol('<i class="mdi mdi-cellphone-iphone"></i>');
        $form->radio('enable', '启用')->options([0 => '禁用', 1 => '启用'])->default(1)->help('禁用后无法登录后台');

        $form->tags('tags', '标签');

        if ($isEdit) {

            $data['password'] = '';

            $form->show('created_at', '添加时间');
            $form->show('updated_at', '修改时间');
        }
    }

    /**
     * 保存数据
     *
     * @param integer $id
     * @return void
     */
    private function save($id = 0)
    {
        // if ($id == 1 && session('admin_id') != 1) {
        //     return request()->json(['code' => 0, 'msg' => '超级管理员[id为1]，其他人不允许修改']);
        // }

        $data = request()->only([
            'name',
            'role_id',
            'group_id',
            'avatar',
            'username',
            'password',
            'email',
            'phone',
            'tags',
        ]);

        if ($id == 1) {
            $data['role_id'] = 1;
        }

        if (!$id && $this->dataModel->where(['username' => $data['username']])->count()) {
            return request()->json(['code' => 0, 'msg' => '账号已存在']);
        }

        $validator = validator($data, [
            'role_id' => 'required',
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return request()->json(['code' => 0, 'msg' => $validator->errors()->first()]);
        }

        // if (!empty($data['password'])) {
        //     $len = mb_strlen($data['password']);

        //     if ($len < 6 || $len > 20) {
        //         return request()->json(['code' => 0, 'msg' => '密码长度6～20']);
        //     }

        //     $password = $this->dataModel->passCrypt($data['password']);

        //     $data['password'] = $password[0];
        //     $data['salt'] = $password[1];
        // } else {
        //     unset($data['password']);
        // }

        // if (!empty($data['phone']) && !preg_match('/^1[3-9]\d{9}$/', $data['phone'])) {
        //     return request()->json(['code' => 0, 'msg' => '手机号码格式错误']);
        // }

        // if (!$id && (!isset($data['password']) || empty($data['password']))) {
        //     return request()->json(['code' => 0, 'msg' => '请输入密码']);
        // }

        return $this->doSave($data, $id);
    }

    /**
     * Undocumented function
     *
     * @title 清空错误次数
     * @return mixed
     */
    public function clearErrors()
    {
        $ids = request('ids', '');

        $ids = array_filter(explode(',', $ids), 'strlen');

        if (empty($ids)) {
            $this->error('参数有误');
        }

        $res = 0;

        foreach ($ids as $id) {
            if ($this->dataModel->where(['id' => $id])->update(['errors' => 0])) {
                $res += 1;
            }
        }

        if ($res) {
            $this->success('成功重置' . $res . '个账号的登录失败次数');
        } else {
            $this->error('重置失败');
        }
    }
}

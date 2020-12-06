<?php

namespace App\Admin\Controllers;

use App\Admin\Models\AdminMenu;
use App\Admin\Models\AdminPermission;
use Ichynul\Labuilder\Traits\Actions;
use Illuminate\Routing\Controller;

/**
 * Undocumented class
 * @title 菜单管理
 */
class MenuController extends Controller
{
    use actions\HasICED;
    use actions\HasAutopost;

    /**
     * Undocumented variable
     *
     * @var AdminMenu
     */
    protected $dataModel;

    /**
     * Undocumented variable
     *
     * @var AdminPermission
     */
    protected $permModel;

    public function __construct()
    {
        $this->dataModel = new AdminMenu;
        $this->permModel = new AdminPermission;

        $this->pageTitle = '菜单管理';
        $this->sortOrder = 'id desc';
        $this->postAllowFields = ['title', 'sort', 'enable'];

        $this->selectTextField = '{title}';
        $this->selectFields = 'id,title';
        $this->selectSearch = 'title';
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

        $tree = [0 => ['title' => '顶级', 'id' => 0]];

        $tree += $this->dataModel->get()->toArray(); //数组合并不要用 array_merge , 会重排数组键 ，作为options导致bug

        $form->text('title', '名称')->required();
        $form->select('parent_id', '上级')->required()->optionsData($tree, 'title');
        $form->text('url', 'url')->required();
        $form->icon('icon', '图标')->required()->default('mdi mdi-access-point');
        $form->radio('enable', '启用')->default(1)->required()->options([1 => '已启用', 0 => '未启用'])
            ->disabled($isEdit && $data['url'] == '/admin/menu/index');
        $form->text('sort', '排序')->default(1)->required();

        if ($isEdit) {
            $form->show('created_at', '添加时间');
            $form->show('updated_at', '修改时间');
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
        $table->raw('title_show', '结构')->getWrapper()->addStyle('text-align:left;');
        $table->show('url', 'url');
        $table->raw('icon', '图标')->to('<i class="{val}"></i>');
        $table->text('title', '名称')->autoPost('', true)->getWrapper()->addStyle('max-width:80px');
        $table->switchBtn('enable', '启用')->default(1)->autoPost()->mapClassWhen('/admin/menu/index', 'hidden', 'url')->getWrapper()->addStyle('max-width:120px');
        $table->text('sort', '排序')->autoPost('', true)->getWrapper()->addStyle('max-width:40px');
        $table->show('created_at', '添加时间')->getWrapper()->addStyle('width:180px');
        $table->show('updated_at', '修改时间')->getWrapper()->addStyle('width:180px');

        $table->sortable([]);

        foreach ($data as &$d) {
            $d['__dis_del__'] = $d['url'] == '/admin/menu/index';
        }

        unset($d);

        $table->getActionbar()->mapClass([
            'delete' => ['disabled' => '__dis_del__'],
        ]);
    }

    private function save($id = 0)
    {
        $data = request()->only([
            'title',
            'url',
            'icon',
            'sort',
            'enable',
            'parent_id',
        ], 'post');

        $validator = validator($data, [
            'title' => 'required',
            'url' => 'required',
            'icon' => 'required',
            'sort' => 'required',
            'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return request()->json(['code' => 0, 'msg' => $validator->errors()->first()]);
        }

        if ($id && $data['parent_id'] == $id) {
            return request()->json(['code' => 0, 'msg' => '上级不能是自己']);
        }

        return $this->doSave($data, $id);
    }
}

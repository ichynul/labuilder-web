<?php

namespace App\Admin\Controllers;

use App\Admin\Models\AdminMenu;
use App\Admin\Models\AdminPermission;
use App\Admin\Models\AdminRole;
use App\Admin\Models\AdminRolePermission;
use Ichynul\Labuilder\Traits\HasResource;
use Illuminate\Routing\Controller;

/**
 * Undocumented class
 * @title 角色管理
 */
class RoleController extends Controller
{
    use HasResource;

    /**
     * Undocumented variable
     *
     * @var AdminRole
     */
    protected $dataModel;
    /**
     * Undocumented variable
     *
     * @var AdminPermission
     */
    protected $permModel;
    /**
     * Undocumented variable
     *
     * @var AdminRolePermission
     */
    protected $rolePermModel;
    /**
     * Undocumented variable
     *
     * @var AdminMenu
     */
    protected $menuModel;

    public function __construct()
    {
        $this->dataModel = new AdminRole;
        $this->permModel = new AdminPermission;
        $this->rolePermModel = new AdminRolePermission;
        $this->menuModel = new AdminMenu;

        $this->pageTitle = '角色管理';
        $this->postAllowFields = ['sort', 'name'];
        $this->delNotAllowed = [1];
        $this->sortOrder = 'sort asc';

        $this->selectTextField = '{name}';
        $this->selectFields = 'id,name';
        $this->selectSearch = 'name';
    }

    protected function filterWhere()
    {
        $searchData = request()->post();

        $where = [];
        if (!empty($searchData['name'])) {
            $where[] = ['name', 'like', '%' . $searchData['name'] . '%'];
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

        $search->text('name', '名称', 3)->maxlength(20);
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
        $table->text('name', '名称')->autoPost();
        $table->show('description', '描述')->default('无描述');
        $table->text('sort', '排序')->autoPost()->getWrapper()->addStyle('max-width:40px');
        $table->show('created_at', '添加时间')->getWrapper()->addStyle('width:180px');
        $table->show('updated_at', '修改时间')->getWrapper()->addStyle('width:180px');
        $table->sortable('id,sort');

        foreach ($data as &$d) {
            $d['__h_del__'] = $d['id'] == 1;
        }

        unset($d);

        $table->getActionbar()
            ->btnEdit()
            ->btnShow()
            ->btnDestroy()
            ->mapClass([
                'destroy' => ['hidden' => '__h_del__'],
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

        $form->text('name', '名称')->maxlength(25)->required();
        $form->textarea('description', '描述')->maxlength(100);
        $form->text('sort', '排序')->required()->default(1);
        $form->tags('tags', '标签');

        if ($isEdit) {
            $form->show('created_at', '添加时间');
            $form->show('updated_at', '修改时间');
        }

        if ($isEdit && $data['id'] == 1) {
            $form->raw('permissions', '权限')->value('<label class="label label-warning">拥有所有权限</label>');
        } else {

            $perIds = [];
            if ($isEdit) {
                $perIds = $this->rolePermModel->where(['role_id' => $data['id']])->pluck('permission_id')->toArray();
            }

            $form->checkbox("permissions", '权限')
                ->default($perIds)
                ->optionsData($this->permModel->get(), 'action_name')
                ->inline()
                ->checkallBtn();
        }
    }

    private function save($id = 0)
    {
        $data = request()->only([
            'name',
            'description',
            'sort',
            'tags',
        ]);

        $validator = validator($data, [
            'name' => 'required',
            'sort' => 'required',
        ]);

        if ($validator->fails()) {
            return request()->json(['code' => 0, 'msg' => $validator->errors()->first()]);
        }

        if ($id) {
            $model = $this->dataModel->findOrFail($id);
            $res = $model->update($data);
        } else {
            $res = $this->dataModel->fill($data)->save();
            if ($res) {
                $id = $this->dataModel->id;
            }
        }

        if (!$res) {
            return request()->json(['code' => 0, 'msg' => '保存失败']);
        }

        if ($id > 1) {
            $this->savePermissions($id);
        }

        return $this->builder()->layer()->closeRefresh(1, '保存成功');
    }

    private function savePermissions($roleId)
    {
        $data = request()->only(['permissions']);

        $allIds = $this->rolePermModel->where(['role_id' => $roleId])->pluck('id')->toArray();
        $existIds = [];

        \DB::beginTransaction();

        $saveIds = array_filter($data['permissions'], 'strlen');

        foreach ($saveIds as $id) {
            $exists = $this->rolePermModel->where(['permission_id' => $id, 'role_id' => $roleId])->pluck('id')->toArray();

            if (count($exists)) {
                $existIds[] = $exists[0];
                continue;
            } else {
                $this->rolePermModel->create([
                    'permission_id' => $id,
                    'role_id' => $roleId,
                ]);
            }
        }

        $delIds = array_diff($allIds, $existIds);

        if (!empty($delIds)) {
            $this->rolePermModel->destroy(array_values($delIds));
        }

        \DB::commit();
    }
}

<?php

namespace App\Admin\Controllers;

use App\Admin\Models\AdminGroup;
use Ichynul\Labuilder\Traits\HasResource;
use Illuminate\Routing\Controller;

/**
 * Undocumented class
 * @title 分组管理
 */
class GroupController extends Controller
{
    use HasResource;

    /**
     * Undocumented variable
     *
     * @var AdminGroup
     */
    protected $dataModel;

    protected $adminGroupTitle = '分组';

    public function __construct()
    {
        $this->dataModel = new AdminGroup;

        $this->pageTitle = $this->adminGroupTitle . '管理';
        $this->sortOrder = 'id desc';
        $this->pagesize = 999;
        $this->postAllowFields = ['name', 'sort'];

        $this->selectTextField = '{id}#{name}';
        $this->selectFields = 'id,name';
        $this->selectSearch = 'name';
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

        $tree = [0 => ['name' => '顶级' . $this->adminGroupTitle, 'id' => 0]];

        $tree += $this->dataModel->get()->toArray(); //数组合并不要用 array_merge , 会重排数组键 ，作为options导致bug

        $form->text('name', '名称')->required();

        $form->textarea('description', '描述')->maxlength(100);
        $form->select('parent_id', '上级')->required()->options($tree);
        $form->tags('tags', '标签');
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
        $table->show('description', '描述')->default('无描述');
        $table->text('name', '名称')->autoPost('', true)->getWrapper()->addStyle('max-width:80px');
        $table->text('sort', '排序')->autoPost('', true)->getWrapper()->addStyle('max-width:40px');
        $table->show('created_at', '添加时间')->getWrapper()->addStyle('width:180px');
        $table->show('updated_at', '修改时间')->getWrapper()->addStyle('width:180px');

        $table->sortable([]);
    }

    private function save($id = 0)
    {
        $data = request()->only([
            'name',
            'description',
            'tags',
            'sort',
            'parent_id',
        ]);

        $validator = validator($data, [
            'name' => 'required',
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

<?php

namespace App\Admin\Controllers;

use App\Admin\Models\AdminPermission;
use Ichynul\Labuilder\Traits\HasResource;
use Illuminate\Routing\Controller;

/**
 * Undocumented class
 * @title 权限设置
 */
class PermissionController extends Controller
{
    use HasResource;

    /**
     * Undocumented variable
     *
     * @var AdminPermission
     */
    protected $dataModel;

    public function __construct()
    {
        $this->dataModel = new AdminPermission;
        $this->pageTitle = '权限设置';
    }

    /**
     * 构建表格
     *
     * @return void
     */
    protected function buildTable(&$data = [])
    {
        $table = $this->table;

        $table->field('url', 'url链接')->to('<a target="_blank" href="{val}">{val}</a>');
        $table->text('action_name', '动作名称')->mapClassWhen([''], 'hidden')->autoPost('', false)->getWrapper()->addStyle('max-width:100px');

        $table->getActionbar()
            ->btnEdit()
            ->btnDestroy()
            ->mapClass([
                'delete' => ['hidden' => '__h_del__'],
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

        $form->text('url', 'url')->maxlength(25)->required();
        $form->text('action_name', '动作名称')->required();
    }

    private function save($id = 0)
    {
        $data = request()->only([
            'url',
            'action_name',
        ]);

        $validator = validator($data, [
            'url' => 'required',
            'action_name' => 'required',
        ]);

        if ($validator->fails()) {
            return request()->json(['code' => 0, 'msg' => $validator->errors()->first()]);
        }

        return $this->doSave($data, $id);
    }
}

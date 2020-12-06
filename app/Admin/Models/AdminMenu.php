<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    protected $fillable = ['parent_id', 'sort', 'title', 'url', 'icon', 'enable'];

    public function buildList($parent = 0, $deep = 0)
    {
        $roots = static::where(['parent_id' => $parent])->order('sort')->get();
        $data = [];

        $deep += 1;

        foreach ($roots as $root) {

            if ($parent == 0) {
                if ($root['url'] != '#') {
                    $root['title_show'] = str_repeat('&nbsp;', 1 * 6) . '├─' . $root['title'];
                } else {
                    $root['title_show'] = $root['title'];
                }
            } else {
                $root['title_show'] = str_repeat('&nbsp;', ($deep - 1) * 6) . '├─' . $root['title'];
            }

            $data[] = $root;

            $data = array_merge($data, $this->buildList($root['id'], $deep));
        }

        return $data;
    }

    public function buildTree($parent = 0, $deep = 0, $except = 0)
    {
        $roots = static::where(['parent_id' => $parent])->order('sort')->field('id,title,parent_id,url')->get();
        $data = [];

        $deep += 1;

        foreach ($roots as $root) {

            $root['title_show'] = '|' . str_repeat('──', $deep) . $root['title'];

            if ($root['id'] == $except) {
                continue;
            }

            if ($root['url'] != '#') {
                continue;
            }

            $root['title_show'];

            $data[$root['id']] = $root['title_show'];

            $data += $this->buildTree($root['id'], $deep, $except);
        }

        return $data;
    }

    public function buildMenus($admin_user)
    {
        $roots = static::where(['parent_id' => 0, 'enable' => 1])->order('sort')->get();
        $list = [];

        foreach ($roots as $root) {
            if ($root['url'] == '#') {
                continue;
            }

            $list = array_merge($list, $this->getChildren($root, $admin_user['role_id']));
        }
        $menus = [];
        foreach ($list as $li) {
            $menus[] = [
                'id' => $li['id'],
                'name' => $li['title'],
                'url' => $li['url'],
                'pid' => $li['parent_id'],
                'icon' => 'mdi ' . $li['icon'],
                'is_out' => 0,
                'is_home' => $li['id'] == 1 ? 1 : 0,
            ];
        }

        return $menus;
    }

    private function getChildren($root, $role_id)
    {
        if ($root['url'] == '#') {
            $data = [];

            $data[] = $root;
            $children = static::where(['parent_id' => $root['id'], 'enable' => 1])->order('sort')->get();
            foreach ($children as $child) {
                $data = array_merge($data, $this->getChildren($child, $role_id));
            }
            if (count($data) > 1) {
                return $data;
            }

            return [];
        } else {

            $prmission = AdminPermission::find(['url' => $root['url']]);

            if (!$prmission) {
                return [];
            }

            $rolePrmission = AdminRolePermission::where(['role_id' => $role_id, 'permission_id' => $prmission['id']])->get();

            if (!$rolePrmission) {
                return [];
            }

            return [$root];
        }
    }
}

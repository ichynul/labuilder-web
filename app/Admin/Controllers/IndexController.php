<?php

namespace App\Admin\Controllers;

use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $menus = [
            [
                'id' => 1,
                'name' => '首页',
                'url' => url('/admin/index/welcome'),
                'pid' => 0,
                'icon' => 'mdi mdi-home',
                'is_out' => 0,
                'is_home' => 1,
            ],
            [
                'id' => 2,
                'name' => '权限设置',
                'url' => '#',
                'pid' => 0,
                'icon' => 'mdi mdi-account-key',
                'is_out' => 0,
                'is_home' => 0,
            ],
            [
                'id' => 3,
                'name' => '菜单管理',
                'url' => url('/admin/menus'),
                'pid' => 2,
                'icon' => 'mdi mdi-arrange-send-to-back',
                'is_out' => 0,
                'is_home' => 0,
            ],
            [
                'id' => 4,
                'name' => '权限设置',
                'url' => url('/admin/permissions'),
                'pid' => 2,
                'icon' => 'mdi mdi-account-key',
                'is_out' => 0,
                'is_home' => 0,
            ], [
                'id' => 5,
                'name' => '管理员',
                'url' => url('/admin/admins'),
                'pid' => 2,
                'icon' => 'mdi mdi-account-card-details',
                'is_out' => 0,
                'is_home' => 0,
            ], [
                'id' => 6,
                'name' => '角色管理',
                'url' => url('/admin/roles'),
                'pid' => 2,
                'icon' => 'mdi mdi-account-multiple',
                'is_out' => 0,
                'is_home' => 0,
            ], [
                'id' => 7,
                'name' => '分组管理',
                'url' => url('/admin/groups'),
                'pid' => 2,
                'icon' => 'mdi mdi-account-multiple-outline',
                'is_out' => 0,
                'is_home' => 0,
            ], [
                'id' => 8,
                'name' => '文件管理',
                'url' => url('/admin/attachments'),
                'pid' => 0,
                'icon' => 'mdi mdi-blur',
                'is_out' => 0,
                'is_home' => 0,
            ],
            [
                'id' => 9,
                'name' => 'other',
                'url' => 'other',
                'pid' => 0,
                'icon' => 'mdi mdi-apple-keyboard-command ',
                'is_out' => 0,
                'is_home' => 0,
            ],
        ];

        $vars = ['menus' => $menus];

        return view('admin.index', $vars);
    }

    public function login()
    {
        return view('admin.login');
    }

    public function welcome()
    {
        $vars = [
            'admin_css' => [
                '/vendor/ichynul/labuilder/lightyearadmin/css/bootstrap.min.css',
                '/vendor/ichynul/labuilder/lightyearadmin/css/materialdesignicons.min.css',
                '/vendor/ichynul/labuilder/lightyearadmin/css/animate.css',
                '/vendor/ichynul/labuilder/lightyearadmin/css/style.min.css',
                '/vendor/ichynul/labuilder/lightyearadmin/js/jconfirm/jquery-confirm.min.css',
            ],

            'admin_js' => [
                '/vendor/ichynul/labuilder/lightyearadmin/js/jquery.min.js',
                '/vendor/ichynul/labuilder/lightyearadmin/js/bootstrap.min.js',
                '/vendor/ichynul/labuilder/lightyearadmin/js/jquery.lyear.loading.js',
                '/vendor/ichynul/labuilder/lightyearadmin/js/bootstrap-notify.min.js',
                '/vendor/ichynul/labuilder/lightyearadmin/js/jconfirm/jquery-confirm.min.js',
                '/vendor/ichynul/labuilder/lightyearadmin/js/lightyear.js',
                '/vendor/ichynul/labuilder/lightyearadmin/js/main.min.js',
            ],
        ];

        return view('admin.welcome', $vars);
    }
}

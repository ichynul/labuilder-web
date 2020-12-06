<?php

use App\Admin\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => config('labuilder.admin_prefix'), 'middleware' => config('labuilder.admin_middleware')], function () {
    Route::get('/', Controllers\IndexController::class . '@index');
    Route::get('/index', Controllers\IndexController::class . '@index');
    Route::get('/index/index', Controllers\IndexController::class . '@index');
    Route::get('/index/welcome', Controllers\IndexController::class . '@welcome');
    Route::get('login', Controllers\IndexController::class . '@login');

    Route::get('menus/export', Controllers\MenuController::class . '@export');
    Route::get('menus/selectPage', Controllers\MenuController::class . '@selectPage');
    Route::patch('menus/autopost', Controllers\MenuController::class . '@autopost');
    Route::resource('menus', Controllers\MenuController::class);

    Route::get('admins/export', Controllers\AdminController::class . '@export');
    Route::get('admins/selectPage', Controllers\AdminController::class . '@selectPage');
    Route::patch('admins/autopost', Controllers\AdminController::class . '@autopost');
    Route::resource('admins', Controllers\AdminController::class);

    Route::get('permissions/export', Controllers\PermissionController::class . '@export');
    Route::get('permissions/selectPage', Controllers\PermissionController::class . '@selectPage');
    Route::patch('permissions/autopost', Controllers\PermissionController::class . '@autopost');
    Route::resource('permissions', Controllers\PermissionController::class);

    Route::get('roles/export', Controllers\RoleController::class . '@export');
    Route::get('roles/selectPage', Controllers\RoleController::class . '@selectPage');
    Route::patch('roles/autopost', Controllers\RoleController::class . '@autopost');
    Route::resource('roles', Controllers\RoleController::class);

    Route::get('groups/export', Controllers\GroupController::class . '@export');
    Route::get('groups/selectPage', Controllers\GroupController::class . '@selectPage');
    Route::patch('groups/autopost', Controllers\GroupController::class . '@autopost');
    Route::resource('groups', Controllers\GroupController::class); //同一个控制器，resource放最后
});

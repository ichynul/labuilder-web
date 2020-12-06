<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('url', 200);
            $table->string('action_name', 50);
            $table->timestamps();
        });

        Schema::create('admin_menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id', false, true)->index('parent_id')->default(0);
            $table->tinyInteger('sort', false, true)->default(0);
            $table->string('title', 55);
            $table->string('url', 255);
            $table->string('icon', 55)->default('');
            $table->tinyInteger('enable', false, true)->default(1);
            $table->timestamps();
        });

        Schema::create('admin_roles', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('sort', false, true)->default(0);
            $table->string('name', 55);
            $table->string('description', 255)->default('');
            $table->string('tags', 155)->default('');
            $table->timestamps();
        });

        Schema::create('admin_role_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id', false, true);
            $table->integer('permission_id', false, true);
            $table->timestamps();
        });

        Schema::create('admin_groups', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id', false, true)->index('parent_id')->default(0);
            $table->tinyInteger('sort', false, true)->default(0);
            $table->string('description', 255)->default('');
            $table->string('name', 55)->default('');
            $table->string('tags', 155)->default('');
            $table->timestamps();
        });

        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50);
            $table->string('password', 155)->default('');
            $table->string('salt', 20)->default('');
            $table->string('name', 30)->default('');
            $table->string('avatar', 255)->default('');
            $table->string('phone', 20)->default('');
            $table->string('email', 100)->default('');
            $table->tinyInteger('errors', false, true)->default(0);
            $table->tinyInteger('enable',false, true)->default(1);
            $table->string('tags', 155)->default('');
            $table->integer('role_id', false, true)->default(0);
            $table->integer('group_id', false, true)->index('group_id')->default(0);
            $table->timestamp('login_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_permission');

        Schema::dropIfExists('admin_menu');

        Schema::dropIfExists('admin_role_permission');

        Schema::dropIfExists('admin_role');

        Schema::dropIfExists('admin_group');

        Schema::dropIfExists('admin_user');
    }
}

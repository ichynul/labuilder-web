<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRolePermission extends Model
{
    protected $fillable = ['role_id', 'permission_id'];
}

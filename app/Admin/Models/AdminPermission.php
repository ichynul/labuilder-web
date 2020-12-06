<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $fillable = ['url', 'action_name'];
}

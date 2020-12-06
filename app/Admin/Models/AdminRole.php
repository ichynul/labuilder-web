<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $fillable = ['name', 'description', 'tags', 'sort'];
}

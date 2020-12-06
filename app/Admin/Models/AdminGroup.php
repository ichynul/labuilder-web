<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class AdminGroup extends Model
{
    protected $fillable = ['parent_id','sort', 'name', 'description', 'tags'];
}

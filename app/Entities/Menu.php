<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $fillable = [
            'name', 'icon', 'href', 'parent_id', 'permission_id',
    ];
}

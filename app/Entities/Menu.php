<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $fillable = [
            'name', 'icon', 'href', 'parent_id', 'permission_id',
    ];

    public function child()
    {
        return $this->hasMany(self::class,'parent_id','id');
    }
}

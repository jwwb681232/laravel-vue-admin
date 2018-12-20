<?php

namespace App\Entities;

use Spatie\Permission\Models\Permission as PermissionModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends PermissionModel
{
    use SoftDeletes;

    public function child()
    {
        return $this->hasMany(self::class,'parent_id','id');
    }
}

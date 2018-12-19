<?php

namespace App\Entities;

use Spatie\Permission\Models\Permission as PermissionModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends PermissionModel
{
    use SoftDeletes;
}

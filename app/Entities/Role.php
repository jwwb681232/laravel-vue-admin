<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/20
 * Time: 20:46
 */
namespace App\Entities;

use Spatie\Permission\Models\Role as RoleModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends RoleModel
{
    use SoftDeletes;
}

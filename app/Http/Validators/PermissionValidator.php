<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/19
 * Time: 16:31
 */

namespace App\Http\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PermissionValidator extends LaravelValidator implements ValidatorInterface
{
    protected $rules
        = [
            'store' => [
                'name'       => 'required|string|max:32',
                'guard_name' => 'required|string|max:32',
            ],
            'update' => [
                'name'       => 'required|string|max:32',
                'guard_name' => 'required|string|max:32',
            ],
        ];

    /*protected $messages
        = [
            'job_status.required' => 'Must choose an option.',
        ];*/

}
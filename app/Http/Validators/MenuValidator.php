<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/11
 * Time: 21:00
 */

namespace App\Http\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class MenuValidator extends LaravelValidator implements ValidatorInterface
{
    protected $rules
        = [
            'store' => [
                'name'     => 'required|string|max:32|unique:menus,name',
                'icon'     => 'required|string|max:32',
                'href'     => 'required|string|max:32',
            ],
        ];

    /*protected $messages
        = [
            'job_status.required' => 'Must choose an option.',
        ];*/

}
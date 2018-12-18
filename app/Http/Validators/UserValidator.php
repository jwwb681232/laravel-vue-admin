<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/18
 * Time: 18:31
 */

namespace App\Http\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator implements ValidatorInterface
{
    protected $rules
        = [
            'store' => [
                'name'     => 'required|string|min:3|max:255',
                'email'    => 'required|string|email|max:32|max:255|unique:users,email',
                'password' => 'required|string|min:6|max:32',
                'type'     => 'required',
            ],
            'update' => [
                'name'     => 'required|string|min:3|max:255',
                'email'    => 'required|string|email|max:32|max:255|unique:users,email',
                'password' => 'required|string|min:6|max:32',
                'type'     => 'required',
            ],
        ];

    /*protected $messages
        = [
            'job_status.required' => 'Must choose an option.',
        ];*/

}
<?php

namespace app\sys\validate;

use think\Validate;

/**
 * @author: qunfu
 * @date: 2017/6/23
 * @description:
 */
class Users extends Validate
{
    protected $rule = [
        'user_name' => 'require|length:4,20',
        'login_passwd' => 'require|alphaNum',
        'login_password_confirm' => 'require|confirm:login_passwd',
        'email' => 'require|email',
        'role_id' => 'require|number',
        'status' => 'require',
        'user_id' => 'require|number'
    ];

    protected $message = [
        'user_name.require' => 'Param login name can not be empty!',
        'user_name.length' => 'Param login name length require 4 to 20!',
        'login_passwd.require' => 'Param login password can not be empty!',
        'login_passwd.alphaNum' => 'Param login password only letters and numbers!',
        'login_password_confirm.confirm' => 'Param password and confirm password inconsistent!',
        'email.email' => 'Param email format is incorrect!',
        'role_id.require' => 'Param role can not be empty!',
        'status.require' => 'Param status can not be empty!',
        'user_id.number' => 'Param userId only numbers!'
    ];

    //validate scene
    protected $scene = [
        'login' => ['email', 'login_passwd'],
        'create' => ['user_name', 'login_passwd', 'login_password_confirm', 'email', 'role_id', 'status'],
        'edit' => ['user_name', 'email', 'role_id', 'status','user_id'],
    ];

}
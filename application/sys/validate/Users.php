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
        'user_login' => 'require|length:4,20',
        'user_pass' => 'require|alphaNum',
        'login_password_confirm' => 'require|confirm:login_passwd',
        'user_email' => 'require|email',
        'role_id' => 'require|number',
        'user_status' => 'require',
        'ID' => 'require|number'
    ];

    protected $message = [
        'user_login.require' => 'Param login name can not be empty!',
        'user_login.length' => 'Param login name length require 4 to 20!',
        'user_pass.require' => 'Param login password can not be empty!',
        'user_pass.alphaNum' => 'Param login password only letters and numbers!',
        'login_password_confirm.confirm' => 'Param password and confirm password inconsistent!',
        'user_email.email' => 'Param email format is incorrect!',
        'role_id.require' => 'Param role can not be empty!',
        'user_status.require' => 'Param status can not be empty!',
        'ID.number' => 'Param userId only numbers!'
    ];

    //validate scene
    protected $scene = [
        'login' => ['user_email', 'user_pass'],
        'create' => ['user_login', 'user_pass', 'login_password_confirm', 'user_email', 'role_id', 'user_status'],
        'edit' => ['user_login', 'user_email', 'role_id', 'user_status','Id'],
    ];

}
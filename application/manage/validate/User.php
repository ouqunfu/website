<?php
namespace app\manage\validate;
use think\Validate;

/**
 * Created by PhpStorm.
 * User: FEIWU187
 * Date: 2017/6/14
 * Time: 16:07
 */
class User extends Validate
{
    protected $rule = [
        ['age', 'number'],
    ];
}
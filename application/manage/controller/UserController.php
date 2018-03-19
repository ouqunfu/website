<?php
namespace app\manage\controller;
use app\common\controller\BaseController;
use app\manage\service\UserService;

/**
 * Created by PhpStorm.
 * User: qunfu
 * Date: 2017/6/14
 * Time: 15:57
 */
class UserController extends BaseController
{

    public function create(){
        $userService = new UserService();
        $userService->create(['user_name' => 'qunfu','age' => 26]);
    }

    public function index(){
        echo 'This is index page';
    }
}
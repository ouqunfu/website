<?php

namespace app\sys\controller;

use app\common\controller\BaseController;
use app\common\service\Constants;
use app\common\service\CommonUtil;
use app\sys\service\RoleService;
use app\sys\service\UsersService;
use think\Session;

/**
 * @author: qunfu
 * @date: 2017/6/27
 * @description: Users object
 */
class UserController extends BaseController
{
    /**
     * 用户登录
     */
    public function login()
    {
        if (Session::get('user')) {
            $sessionUser = Session::get('user');
            $data = [
                'userId' => $sessionUser['user_id'],
                'userName' => $sessionUser['user_name']
            ];
            return $this->_res(Constants::ERROR_OK, 'Sign in success!', $data);
        }

        list($userPwd, $loginName) = $this->_validateParams(['login_passwd', 'login_name'], Constants::HTTP_POST);

        //validate user info
        $loginValidate = validate('Users');
        if (!$loginValidate->scene('login')->check(['email' => $loginName, 'login_passwd' => $userPwd])) {
            return $this->_res(Constants::ERROR_PARAMS, $loginValidate->getError());
        }

        $loginService = new UsersService();
        $map['email'] = $loginName;
        $user = $loginService->getInfo($map);
        if (!$user) {
            return $this->_res(Constants::ERROR_OBJECT_NOT_EXIST, 'Users is not exist!');
        }

        if ($user['status'] != Constants::STATUS_ACTIVE) {
            return $this->_res(Constants::ERROR_STATUS_ERROR, 'Users status error!');
        }
        $pwd = CommonUtil::generatePwd($userPwd, $user['login_salt']);
        if ($pwd != $user['login_passwd']) {
            return $this->_res(Constants::ERROR_LOGIN, 'Password Error!');
        }
        $user['create_time'] = strtotime($user['create_time']);

        //update user info
        $userInfo = $user;
        $userInfo['last_login_time'] = time();
        $userInfo['last_login_ip'] = CommonUtil::getClientIP();
        $userInfo['last_login_ua'] = $_SERVER['HTTP_USER_AGENT'];
        $userService = new UsersService();
        $res = $userService->update(['user_id' => $user['user_id']], $userInfo);
        if (!$res) {
            return $this->_res(Constants::ERROR_SERVER, 'Login fail!');
        }

        Session::set('expire', Constants::TIME_DAY);
        Session::set('user', $userInfo);

        $data = [
            'userId' => $userInfo['user_id'],
            'userName' => $userInfo['user_name']
        ];
        return $this->_res(Constants::ERROR_OK, 'Sign in success!', $data);
    }

    /**
     * 退出
     */
    public function logout()
    {
        if (Session::has('user')) {
            Session::delete('user');
        }
        return $this->_res(Constants::ERROR_OK, 'Logout success!');
    }

    /**
     * 用户列表
     * @return array
     */
    public function lists()
    {
        $userName = input('get.user_name/s');
        $page = input('get.page/d');
        $sortKey = input('get.sort_key/s');
        $sortValue = input('get.sort_value/d');
        $userService = new UsersService();
        $map = [];
        if (!empty($userName)) {
            $map['user_name|email'] = ['like', '%' . $userName . '%'];
        }
        $page = intval($page) ? intval($page) : 1;
        $sortKey = empty($sortKey) ? 'user_id' : $sortKey;
        $sortValue = (empty($sortValue) || intval($sortValue) >= 0) ? 'asc' : 'desc';

        $sort = $sortKey . ' ' . $sortValue;

        $res = $userService->getList($map, [], '', $sort, $page);

        return $this->_res(Constants::ERROR_OK, 'Users list!', $res['list'], $res['page_count'], $res['count']);
    }

    /**
     * create user
     * @return array
     */
    public function create()
    {
        list($data['user_name'], $data['email'], $data['login_passwd'], $data['login_password_confirm'], $data['status'], $data['role_id'], $data['remark']
            ) = $this->_validateParams(['login_name', 'email', 'login_passwd', 'login_password_confirm', 'status', 'role_id'], Constants::HTTP_POST, ['remark']);
        //validate user data
        $loginValidate = validate('Users');
        if (!$loginValidate->scene('create')->check($data)) {
            return $this->_res(Constants::ERROR_PARAMS, $loginValidate->getError());
        }
        $userService = new UsersService();
        //validate user name or email whether exist
        $map = [
            'user_name' => $data['user_name']
        ];
        $mapOr = [
            'email' => $data['email']
        ];
        $userService->checkInfo($map, $mapOr);
        unset($data['login_password_confirm']);
        //generate password
        $data['login_salt'] = CommonUtil::generateSalt();
        $data['login_passwd'] = CommonUtil::generatePwd($data['login_passwd'], $data['login_salt']);
        $res = $userService->create($data);
        if ($res) {
            return $this->_res(Constants::ERROR_OK, 'Users created successfully!');
        }
        return $this->_res(Constants::ERROR_SERVER, 'Users created failed!');
    }

    /**
     * update user
     * @return array
     */
    public function update()
    {
        list($data['user_name'], $data['email'], $data['status'], $data['role_id'], $data['user_id'], $data['remark']
            ) = $this->_validateParams(['login_name', 'email', 'status', 'role_id', 'user_id'], Constants::HTTP_POST, ['remark']);
        list($data['login_passwd'], $data['login_password_confirm']) = $this->_receiveParams(['login_passwd', 'login_password_confirm'], Constants::HTTP_POST);
        if (!empty(trim($data['login_passwd'])) && trim($data['login_passwd']) != trim($data['login_password_confirm'])) {
            return $this->_res(Constants::ERROR_PARAMS, 'Param password and confirm password inconsistent!');
        }
        //validate user data
        $loginValidate = validate('Users');
        if (!$loginValidate->scene('edit')->check($data)) {
            return $this->_res(Constants::ERROR_PARAMS, $loginValidate->getError());
        }
        $userService = new UsersService();
        $userId = $data['user_id'];
        //validate user name or email whether exist
        $map = [
            'user_name' => $data['user_name'],
            'user_id' => ['<>', intval($userId)]
        ];
        $mapOr = [
            'email' => $data['email'],
            'user_id' => ['<>', intval($userId)]
        ];
        //generate password
        if (empty(trim($data['login_passwd'])) || empty(trim($data['login_password_confirm']))) {
            unset($data['login_passwd']);
        } else {
            $data['login_salt'] = CommonUtil::generateSalt();
            $data['login_passwd'] = CommonUtil::generatePwd(trim($data['login_passwd']), $data['login_salt']);
        }
        unset($data['login_password_confirm']);
        $userService->checkInfo($map, $mapOr);
        $res = $userService->update(['user_id' => intval($userId)], $data);
        if ($res) {
            return $this->_res(Constants::ERROR_OK, 'Users updated successfully!');
        }
        return $this->_res(Constants::ERROR_SERVER, 'Users updated failed!');
    }

    /**
     * get user info
     */
    public function get()
    {
        list($userId) = $this->_validateParams(['user_id'], Constants::HTTP_GET);
        $userService = new UsersService();
        $userInfo = $userService->getInfo(['user_id' => $userId], [], 'user_id,user_name,email,status,skype,phone,qq,remark,role_id');

        return $this->_res(Constants::ERROR_OK, 'Users info!', $userInfo);
    }

    /**
     * 用户状态更改
     */
    public function changeStatus()
    {
        list($userId) = $this->_validateParams(['user_id'], Constants::HTTP_GET);
        $userService = new UsersService();
        $userInfo = $userService->getInfo(['user_id' => $userId], [], ' user_id, status ');
        $data = [];
        if ($userInfo['status'] == Constants::STATUS_ACTIVE) {
            $data['status'] = Constants::STATUS_PAUSED;
        }
        if ($userInfo['status'] == Constants::STATUS_PAUSED) {
            $data['status'] = Constants::STATUS_ACTIVE;
        }
        $res = $userService->update(['user_id' => $userInfo['user_id']], $data);
        if ($res) {
            return $this->_res(Constants::ERROR_OK, 'Users status changed successfully!');
        }
        return $this->_res(Constants::ERROR_SERVER, 'Users status changed failed!');

    }

}
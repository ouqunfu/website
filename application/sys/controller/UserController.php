<?php

namespace app\sys\controller;

use app\common\controller\BaseController;
use app\common\service\Constants;
use app\common\service\CommonUtil;
use app\sys\service\RoleService;
use app\sys\service\UserMetaService;
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
                'userId' => $sessionUser['ID'],
                'userName' => $sessionUser['user_login']
            ];
            return $this->_res(Constants::ERROR_OK, 'Sign in success!', $data);
        }

        list($userPwd, $loginName) = $this->_validateParams(['user_pass', 'user_login'], Constants::HTTP_POST);

        //validate user info
        $loginValidate = validate('Users');
        if (!$loginValidate->scene('login')->check(['user_email' => $loginName, 'user_pass' => $userPwd])) {
            return $this->_res(Constants::ERROR_PARAMS, $loginValidate->getError());
        }

        $loginService = new UsersService();
        $map['user_email'] = $loginName;
        $user = $loginService->getInfo($map);
        if (!$user) {
            return $this->_res(Constants::ERROR_OBJECT_NOT_EXIST, 'Users is not exist!');
        }

        if ($user['user_status'] != Constants::STATUS_ACTIVE) {
            return $this->_res(Constants::ERROR_STATUS_ERROR, 'Users status error!');
        }
        $pwd = CommonUtil::generatePwd($userPwd, $user['user_login_salt']);
        if ($pwd != $user['user_pass']) {
            return $this->_res(Constants::ERROR_LOGIN, 'Password Error!');
        }

        //update user info
        $userInfo = $user;
        $userInfo['last_login_time'] = date('Y-m-d H:i:s');
        $userInfo['last_login_ip'] = CommonUtil::getClientIP();
        $userInfo['last_login_ua'] = $_SERVER['HTTP_USER_AGENT'];
        $userService = new UsersService();
        $res = $userService->update(['ID' => $user['ID']], $userInfo);
        if (!$res) {
            return $this->_res(Constants::ERROR_SERVER, 'Login fail!');
        }

        Session::set('expire', Constants::TIME_DAY);
        Session::set('user', $userInfo);

        $data = [
            'userId' => $userInfo['ID'],
            'userName' => $userInfo['user_login']
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
        $userName = input('get.user_login/s');
        $page = input('get.page/d');
        $sortKey = input('get.sort_key/s');
        $sortValue = input('get.sort_value/d');
        $userService = new UsersService();
        $map = [];
        if (!empty($userName)) {
            $map['user_login|email'] = ['like', '%' . $userName . '%'];
        }
        $page = intval($page) ? intval($page) : 1;
        $sortKey = empty($sortKey) ? 'ID' : $sortKey;
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
        list($data['user_login'], $data['user_email'], $data['user_pass'], $data['login_password_confirm'], $data['user_status'], $data['role_id']
            ) = $this->_validateParams(['user_login', 'user_email', 'user_pass', 'login_password_confirm', 'user_status', 'role_id'], Constants::HTTP_POST);
        //validate user data
        $loginValidate = validate('Users');
        if (!$loginValidate->scene('create')->check($data)) {
            return $this->_res(Constants::ERROR_PARAMS, $loginValidate->getError());
        }
        //user meta data
        list($metaData['safe_question'], $metaData['answer']) = $this->_validateParams(['safe_question', 'answer'], Constants::HTTP_POST);
        $userService = new UsersService();
        //validate user name or email whether exist
        $map = ['user_login' => $data['user_login']];
        $mapOr = ['user_email' => $data['user_email']];
        $userService->checkInfo($map, $mapOr);
        unset($data['login_password_confirm']);
        //generate password
        $data['user_login_salt'] = CommonUtil::generateSalt();
        $data['user_pass'] = CommonUtil::generatePwd($data['user_pass'], $data['user_login_salt']);
        $data['user_created'] = date('Y-m-d H:i:s');
        $res = $userService->create($data);
        if ($res) {
            // safe question and answer
            (new UserMetaService())->addUserMetaData($metaData, $res);
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
        list($data['user_login'], $data['user_email'], $data['user_pass'], $data['login_password_confirm'], $data['user_status'], $data['role_id']
            ) = $this->_validateParams(['user_login', 'user_email', 'user_pass', 'login_password_confirm', 'user_status', 'role_id'], Constants::HTTP_POST);
        list($data['user_pass'], $data['login_password_confirm']) = $this->_receiveParams(['user_pass', 'login_password_confirm'], Constants::HTTP_POST);
        if (!empty(trim($data['user_pass'])) && trim($data['user_pass']) != trim($data['login_password_confirm'])) {
            return $this->_res(Constants::ERROR_PARAMS, 'Param password and confirm password inconsistent!');
        }
        //user meta data
        list($metaData['safe_question'], $metaData['answer']) = $this->_validateParams(['safe_question', 'answer'], Constants::HTTP_POST);
        //validate user data
        $loginValidate = validate('Users');
        if (!$loginValidate->scene('edit')->check($data)) {
            return $this->_res(Constants::ERROR_PARAMS, $loginValidate->getError());
        }
        $userService = new UsersService();
        $userId = $data['ID'];
        //validate user name or email whether exist
        $map = [
            'user_login' => $data['user_login'],
            'ID' => ['<>', intval($userId)]
        ];
        $mapOr = [
            'user_email' => $data['user_email'],
            'ID' => ['<>', intval($userId)]
        ];
        //generate password
        if (empty(trim($data['user_pass'])) || empty(trim($data['login_password_confirm']))) {
            unset($data['user_pass']);
        } else {
            $data['user_login_salt'] = CommonUtil::generateSalt();
            $data['user_pass'] = CommonUtil::generatePwd(trim($data['user_pass']), $data['user_login_salt']);
        }
        unset($data['login_password_confirm']);
        $userService->checkInfo($map, $mapOr);
        $res = $userService->update(['ID' => intval($userId)], $data);
        if ($res) {
            // safe question and answer
            (new UserMetaService())->addUserMetaData($metaData, $res);
            return $this->_res(Constants::ERROR_OK, 'Users updated successfully!');
        }
        return $this->_res(Constants::ERROR_SERVER, 'Users updated failed!');
    }

    /**
     * get user info
     */
    public function get()
    {
        list($userId) = $this->_validateParams(['ID'], Constants::HTTP_GET);
        $userService = new UsersService();
        $userInfo = $userService->getInfo(['ID' => $userId], [], 'ID,user_login,user_email,user_status,role_id');

        return $this->_res(Constants::ERROR_OK, 'Users info!', $userInfo);
    }
}
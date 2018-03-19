<?php

namespace app\sys\service;

use app\common\service\BaseService;
use app\common\service\CommonUtil;
use app\common\service\Constants;
use app\sys\model\Users;

/**
 * @author: qunfu
 * @date: 2017/6/22
 * @description:
 */
class UsersService extends BaseService
{
    /**
     * get user info
     * @param array $condition
     * @param array $conditionOr
     * @param string $field
     * @return object|string
     */
    public function getInfo(array $condition = [], array $conditionOr = [], $field = '*')
    {
        if (empty($condition) || !is_array($condition)) {
            return '';
        }

        $userModel = new Users();
        $userInfo = $userModel->getOne($condition, $conditionOr, $field);
        if (empty($userInfo)) {
            return '';
        }

        return $userInfo;
    }

    /**
     * get user list
     * @param array $map
     * @param array $mapOr
     * @param string $field
     * @param string $order
     * @param int $page
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public function getList(array $map = [], array $mapOr = [], $field = '*', $order = '', $page = 1)
    {
        $userModel = new Users();
        $res = $userModel->getList($map, $mapOr, $field, $order, $page);
        $roleService = new RoleService();

        foreach ($res['list'] as $key => $v) {

            $roleMap['role_id'] = intval($v['role_id']);
            //获取角色信息
            $roleInfo = $roleService->getInfo($roleMap, [], 'role_name');
            if ($roleInfo) {

                $res['list'][$key]['role_name'] = $roleInfo['role_name'];
            }
        }

        return $res;
    }

    /**
     * get all
     * @param array $map
     * @param array $mapOr
     * @param string $field
     * @param string $order
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getListAll(array $map = [], array $mapOr = [], $field = '*', $order = '')
    {
        $userModel = new Users();
        $res = $userModel->getListAll($map, $mapOr, $field, $order);
        return $res;
    }

    /**
     * create user
     * @param array $info
     * @return bool|int|string
     */
    public function create(array $info = [])
    {
        if (empty($info)) {
            return false;
        }
        //generate password
        $info['login_salt'] = CommonUtil::generateSalt();
        $info['login_passwd'] = CommonUtil::generatePwd($info['login_passwd'], $info['login_salt']);
        $info['create_time'] = time();

        $userModel = new Users();
        $res = $userModel->addInfo($info);

        return $res;
    }

    /**
     * check user info
     * @param array $map
     * @param array $mapOr
     * @return array|bool|false|\PDOStatement|string|\think\Model
     */
    public function checkInfo(array $map = [], array $mapOr = [])
    {
        $userModel = new Users();
        $res = $userModel->getOneByClosure($map, $mapOr);
        if ($res) {
            if ($res['user_name'] == $map['user_name']) {
                return $this->_res(Constants::ERROR_REPEAT, 'Param user name is exist!');
            }
            if ($res['email'] == $mapOr['email']) {
                return $this->_res(Constants::ERROR_REPEAT, 'Param email is exist!');
            }
        }
        return false;

    }

    /**
     * update user info
     * @param array $condition
     * @param array $info
     * @return bool
     */
    public function update(array $condition = [], array $info = [])
    {
        if (empty($info) || !is_array($info) || empty($condition)) {
            return false;
        }

        $userModel = new Users();
        $res = $userModel->updateInfo($condition, $info);
        if ($res || (0 == $res)) {
            return true;
        }

        return $res;
    }
}
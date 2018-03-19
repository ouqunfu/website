<?php

namespace app\sys\service;

use app\common\service\BaseService;
use app\sys\model\Role;

/**
 * @author: qunfu
 * @date: 2017/6/27
 * @description: Role object
 */
class RoleService extends BaseService
{
    /**
     * create role
     * @param array $info
     * @return bool|int|string
     */
    public function create(array $info = [])
    {
        if (empty($info)) {
            return false;
        }

        $roleModel = new Role();
        $res = $roleModel->addInfo($info);

        return $res;
    }

    /**
     * get role info
     * @param array $condition
     * @param array $conditionOr
     * @param string $field
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public function getInfo(array $condition = [], array $conditionOr = [], $field = '*')
    {
        if (empty($condition) || !is_array($condition)) {
            return '';
        }
        $roleModel = new Role();
        $roleInfo = $roleModel->getOne($condition, $conditionOr, $field);
        if (empty($roleInfo)) {
            return '';
        }

        return $roleInfo;
    }

    /**
     * get role info list
     * @param array $map
     * @param array $mapOr
     * @param string $field
     * @param string $order
     * @param int $page
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public function getList(array $map = [], array $mapOr = [], $field = '*', $order = '', $page = 1)
    {
        $roleModel = new Role();
        $res = $roleModel->getList($map, $mapOr, $field, $order, $page);

        return $res;
    }

    /**
     * get function info list all
     * @param array $map
     * @param array $mapOr
     * @param string $field
     * @param string $group
     * @param string $order
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public function getListAll(array $map = [], array $mapOr = [], $field = '*', $group = '', $order = '')
    {
        $roleModel = new Role();
        $res = $roleModel->getListAll($map, $mapOr, $field, $group, $order);

        return $res;
    }

    /**
     * update role info
     * @param array $map
     * @param array $data
     * @return bool|int|string
     */
    public function update(array $map = [], array $data = [])
    {
        if (empty($data) || !is_array($data) || empty($map)) {
            return false;
        }

        $roleModel = new Role();
        $res = $roleModel->updateInfo($map, $data);
        if ($res || (0 == $res)) {
            return true;
        }

        return $res;
    }
}
<?php

namespace app\sys\controller;

use app\common\controller\BaseController;
use app\common\service\Constants;
use app\sys\service\FunctionsService;
use app\sys\service\RoleService;

/**
 * @author: qunfu
 * @date: 2017/6/28
 * @description: role manage
 */
class RoleController extends BaseController
{

    /**
     * create role
     */
    public function create()
    {
        list($data['role_name'], $data['status'],) = $this->_validateParams(['role_name', 'status'], Constants::HTTP_POST);
        $roleRule = input('post.role_rule/a');
        if ($roleRule && is_array($roleRule)) {
            $data['role_rule'] = implode(',', $roleRule);
        }
        $data['list_order'] = input('post.list_order/d');

        $roleService = new RoleService();

        $res = $roleService->create($data);
        if ($res) {
            return $this->_res(Constants::ERROR_OK, 'Role created successfully!');
        }
        return $this->_res(Constants::ERROR_OK, 'Role created failed!');
    }

    /**
     * update role
     * @return array
     */
    public function update()
    {
        list($data['role_name'], $data['status'], $data['role_id']) = $this->_validateParams(['role_name', 'status', 'role_id'], Constants::HTTP_POST);
        $roleRule = input('post.role_rule/a');
        if ($roleRule && is_array($roleRule)) {
            $data['role_rule'] = implode(',', $roleRule);
        }
        $data['list_order'] = input('post.list_order/d');

        $roleService = new RoleService();
        $res = $roleService->update(['role_id' => $data['role_id']], $data);
        if ($res) {
            return $this->_res(Constants::ERROR_OK, 'Role updated successfully!');
        }
        return $this->_res(Constants::ERROR_OK, 'Role updated failed!');
    }

    /**
     * get role list
     * @return array
     */
    public function lists()
    {
        list($sort, $page) = $this->_receiveParams(['sort', 'page'], Constants::HTTP_GET);
        $sort = (intval($sort) >= 0) ? 'asc' : 'desc';
        $roleService = new RoleService();
        $res = $roleService->getList([], [], '', ' list_order ' . $sort, $page);
        return $this->_res(Constants::ERROR_OK, 'Role list!', $res['list'], $res['page_count'], $res['count']);
    }

    /**
     * get role info
     * @return array
     */
    public function get()
    {
        list($roleId) = $this->_validateParams(['role_id'], Constants::HTTP_GET);
        $roleService = new RoleService();
        $roleInfo = $roleService->getInfo(['role_id' => $roleId]);
        $selected = $roleInfo['role_rule'] ? explode(',', $roleInfo['role_rule']) : [];
        //获取权限节点
        $funcService = new FunctionsService();
        $nodeList = $funcService->nodeList($selected);
        $roleInfo['node_list'] = $nodeList;
        return $this->_res(Constants::ERROR_OK, 'Role info!', $roleInfo);
    }

    /**
     * get role list all
     * @return array
     */
    public function getAll()
    {
        $roleService = new RoleService();
        $res = $roleService->getListAll(['status' => 'active'], [], 'role_id,role_name');
        return $this->_res(Constants::ERROR_OK, 'Role list!', $res);
    }

    /**
     * change role status
     * @return array
     */
    public function changeStatus()
    {
        list($roleId) = $this->_validateParams(['role_id'], Constants::HTTP_GET);
        $roleService = new RoleService();
        $roleInfo = $roleService->getInfo(['role_id' => $roleId], [], ' role_id, status ');
        $data = [];
        if ($roleInfo['status'] == Constants::STATUS_ACTIVE) {
            $data['status'] = Constants::STATUS_PAUSED;
        }
        if ($roleInfo['status'] == Constants::STATUS_PAUSED) {
            $data['status'] = Constants::STATUS_ACTIVE;
        }
        $res = $roleService->update(['role_id' => $roleInfo['role_id']], $data);
        if ($res) {
            return $this->_res(Constants::ERROR_OK, 'Role status changed successfully!');
        }
        return $this->_res(Constants::ERROR_SERVER, 'Role status changed failed!');
    }
}
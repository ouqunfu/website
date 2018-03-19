<?php

namespace app\sys\controller;

use app\common\controller\BaseController;
use app\common\service\Constants;
use app\sys\service\FunctionsService;

/**
 * @author: qunfu
 * @date: 2017/6/28
 * @description: add function to ..
 */
class FuncController extends BaseController
{
    /**
     * create function
     * @return array
     */
    public function create()
    {
        list(
            $data['function_name'],
            $data['module'],
            $data['controller'],
            $data['action'],
            $data['status'],
            ) = $this->_validateParams(['function_name', 'module', 'controller', 'action', 'status'], Constants::HTTP_POST);

        $map = [
            'module' => $data['module'],
            'controller' => $data['controller'],
            'action' => $data['action'],
        ];

        $mapOr = [
            'function_name' => $data['function_name']
        ];

        $funcService = new FunctionsService();

        //validate function name or module,controller,action whether exist
        $funcService->checkInfo($map, $mapOr);

        $res = $funcService->create($data);
        if ($res) {
            return $this->_res(Constants::ERROR_OK, 'Function created successfully!');
        }
        return $this->_res(Constants::ERROR_SERVER, 'Function created failed!');
    }

    /**
     * update function info
     * @return array
     */
    public function update()
    {
        list(
            $data['function_name'],
            $data['module'],
            $data['controller'],
            $data['action'],
            $data['status'],
            $data['function_id']
            ) = $this->_validateParams(['function_name', 'module', 'controller', 'action', 'status', 'function_id'], Constants::HTTP_POST);

        $map = [
            'module' => $data['module'],
            'controller' => $data['controller'],
            'action' => $data['action'],
            'function_id' => ['<>', $data['function_id']]
        ];

        $mapOr = [
            'function_name' => $data['function_name'],
            'function_id' => ['<>', $data['function_id']]
        ];

        $funcService = new FunctionsService();
        //validate function name or module,controller,action whether exist
        $funcService->checkInfo($map, $mapOr);

        $res = $funcService->update(['function_id' => intval($data['function_id'])], $data);
        if ($res) {
            return $this->_res(Constants::ERROR_OK, 'Function updated successfully!');
        }
        return $this->_res(Constants::ERROR_SERVER, 'Function updated failed!');
    }

    /**
     * get functions info
     */
    public function get()
    {
        list($functionId) = $this->_validateParams(['function_id'], Constants::HTTP_GET);
        $funcService = new FunctionsService();
        $funcInfo = $funcService->getInfo(['function_id' => $functionId]);

        return $this->_res(Constants::ERROR_OK, 'Function info!', $funcInfo);
    }

    /**
     * change functions status
     * @return array
     */
    public function changeStatus()
    {
        list($functionId) = $this->_validateParams(['function_id'], Constants::HTTP_GET);
        $funcService = new FunctionsService();
        $funcInfo = $funcService->getInfo(['function_id' => $functionId], [], ' function_id, status ');

        $data = [];
        if ($funcInfo['status'] == Constants::STATUS_ACTIVE) {
            $data['status'] = Constants::STATUS_PAUSED;
        }
        if ($funcInfo['status'] == Constants::STATUS_PAUSED) {
            $data['status'] = Constants::STATUS_ACTIVE;
        }
        $res = $funcService->update(['function_id' => $funcInfo['function_id']], $data);
        if ($res) {
            return $this->_res(Constants::ERROR_OK, 'Function status changed successfully!');
        }
        return $this->_res(Constants::ERROR_SERVER, 'Function status changed failed!');

    }

    /**
     * get functions list
     * @return array
     */
    public function lists()
    {
        list($sort, $page) = $this->_receiveParams(['sort', 'page'], Constants::HTTP_GET);
        $sort = (intval($sort) >= 0) ? 'asc' : 'desc';

        $funcService = new FunctionsService();
        $res = $funcService->getList([], [], '', ' list_order ' . $sort, $page);

        return $this->_res(Constants::ERROR_OK, 'Functions list!', $res['list'], $res['page_count'], $res['count']);
    }

    /**
     * get tree list
     * @return array
     */
    public function treeList()
    {
        $funcService = new FunctionsService();
        $res = $funcService->nodeList();
        return $this->_res(Constants::ERROR_OK, 'Functions tree list!', $res);
    }
}
<?php

namespace app\sys\controller;

use app\common\controller\BaseController;
use app\common\service\Constants;
use app\sys\service\LogService;

/**
 * @author: qunfu
 * @date: 2017/7/20
 * @description:
 */
class LogController extends BaseController
{
    /**
     * log lists
     * @return array
     */
    public function lists()
    {
        list($sortKey, $sortValue, $page, $map['log_type'], $map['user_name'], $map['date_range']) = $this->_receiveParams(['sort_key', 'sort_value', 'page', 'object','user_name','date_range'], Constants::HTTP_GET);
        $sortKey = empty($sortKey) ? 'create_time' : $sortKey;
        $sortValue = (empty($sortValue) || intval($sortValue) >= 0) ? 'desc' : 'asc';
        $sort = $sortKey . ' ' . $sortValue;

        $logService = new LogService();
        $map = $logService->getSearchMap($map);
        $res = $logService->getList($map, [], '*', $sort, $page);
        $res['list'] = $logService->handleLogList($res['list']);

        return $this->_res(Constants::ERROR_OK, 'Log list!', $res['list'], $res['page_count'], $res['count']);
    }

    /**
     * Search select option
     * @return array
     */
    public function searchSelectOption()
    {
        $logService = new LogService();
        $logInfo = $logService->getListAll([], 'user_name', 'user_name');
        $logInfo2 = $logService->getListAll([], 'log_type', 'log_type');
        $info['operator'] = array_column($logInfo, 'user_name');
        $info['object'] = array_column($logInfo2, 'log_type');

        return $this->_res(Constants::ERROR_OK, 'Search select option!', $info);
    }
}
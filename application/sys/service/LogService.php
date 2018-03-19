<?php

namespace app\sys\service;

use app\common\service\BaseService;
use app\sys\model\Log;

/**
 * @author: qunfu
 * @date: 2017/7/20
 * @description:
 */
class LogService extends BaseService
{
    /**
     * get log list
     * @param array $map
     * @param array $mapOr
     * @param string $field
     * @param string $order
     * @param int $page
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getList(array $map = [], array $mapOr = [], $field = '*', $order = '', $page = 1)
    {
        $logModel = new Log();
        $res = $logModel->getList($map, $mapOr, $field, $order, $page);
        return $res;
    }

    /**
     * get all
     * @param array $map
     * @param string $groupBy
     * @param string $field
     * @param string $order
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getListAll(array $map = [], $groupBy = '', $field = '*', $order = '')
    {
        $logModel = new Log();
        $res = $logModel->getListAll($map, $groupBy, $field, $order);
        return $res;
    }

    /**
     * handle log list data
     * @param array $data
     * @return array
     */
    public function handleLogList(array $data = [])
    {
        if (empty($data)) {
            return $data;
        }
        foreach ($data as $key => $v) {
            $data[$key]['action_param'] = json_decode($v['action_param'], true);
        }
        return $data;
    }


    /**
     * get search map
     * @param array $map
     * @return array|string
     */
    public function getSearchMap(array $map = [])
    {
        if (empty($map)) {
            return '';
        }
        $newMap = [];
        if (isset($map['log_type']) && $map['log_type']) {
            $newMap['log_type'] = ['eq', $map['log_type']];
        }
        if (isset($map['user_name']) && $map['user_name']) {
            $newMap['user_name'] = ['eq', $map['user_name']];
        }
        if (isset($map['date_range']) && $map['date_range']) {
            $dateRange = $map['date_range'] ? explode(',', $map['date_range']) : [];
            if ($dateRange) {
                $startTime = strtotime($dateRange[0]);
                $endTime = strtotime($dateRange[1]) + 24 * 3600;
                $newMap['create_time'] = [
                    ['>', $startTime],
                    ['<', $endTime],
                ];
            }
        }

        return $newMap;
    }
}
<?php

namespace app\sys\service;

use app\common\service\BaseService;
use app\common\service\Constants;
use app\sys\model\Functions;

/**
 * @author: qunfu
 * @date: 2017/6/28
 * @description:
 */
class FunctionsService extends BaseService
{
    /**
     * create function
     * @param array $info
     * @return bool
     */
    public function create(array $info = [])
    {
        if (empty($info)) {
            return false;
        }

        $functionModel = new Functions();
        $res = $functionModel->addInfo($info);

        return $res;
    }

    /**
     * check function info
     * @param array $map
     * @param array $mapOr
     * @return array|bool|false|\PDOStatement|string|\think\Model
     */
    public function checkInfo(array $map = [], array $mapOr = [])
    {
        $funcModel = new Functions();
        $res = $funcModel->getOneByClosure($map, $mapOr);
        if ($res) {
            if ($res['function_name'] == $mapOr['function_name']) {
                return $this->_res(Constants::ERROR_REPEAT, 'Param function name is exist!');
            }
            if ($res['module'] == $map['module'] && $res['controller'] == $map['controller'] && $res['action'] == $map['action']) {
                return $this->_res(Constants::ERROR_REPEAT, 'Param action is exist!');
            }
        }
        return true;

    }

    /**
     * get function info
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
        $funcModel = new Functions();
        $funcInfo = $funcModel->getOne($condition, $conditionOr, $field);
        if (empty($funcInfo)) {
            return '';
        }

        return $funcInfo;
    }

    /**
     * get function info list
     * @param array $map
     * @param array $mapOr
     * @param string $field
     * @param string $order
     * @param int $page
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public function getList(array $map = [], array $mapOr = [], $field = '*', $order = '', $page = 1)
    {
        $funcModel = new Functions();
        $res = $funcModel->getList($map, $mapOr, $field, $order, $page);

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
        $funcModel = new Functions();
        $res = $funcModel->getListAll($map, $mapOr, $field, $group, $order);

        return $res;
    }

    /**
     * update function info
     * @param array $condition
     * @param array $info
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public function update(array $condition = [], array $info = [])
    {
        if (empty($info) || !is_array($info) || empty($condition)) {
            return false;
        }

        $funcModel = new Functions();
        $res = $funcModel->updateInfo($condition, $info);
        if ($res || (0 == $res)) {
            return true;
        }

        return $res;
    }

    /**
     * function node list
     * @param array $selected
     * @return array
     */
    public function nodeList(array $selected = [])
    {
        $res = $this->getListAll([], [], '', '');
        $modules = array_values(array_unique(array_column($res, 'module')));
        //测试数据
//        $selected = explode(',', '3,4,6,7,9,12,13,14,19,20,22,24,25,26');
        //循环获取controller
        $data = [];
        foreach ($modules as $key => $mo) {
            $temp = [];
            $i = 0;
            foreach ($res as $k => $re) {
                if ($mo == $re['module']) {
                    $data[$key]['module'] = $mo;
                    $temp[$i] = $re['controller'];
                    $i++;
                }
            }
            $temp = array_values(array_unique($temp));
            //循环获取action
            $tempNext = [];
            foreach ($temp as $tk => $te) {
                $tempAction = [];
                $j = 0;
                foreach ($res as $k => $re) {
                    if ($mo == $re['module'] && $te == $re['controller']) {
                        $tempNext[$tk]['controller'] = $te;
                        $tempAction[$j]['action'] = $re['action'];
                        $tempAction[$j]['function_id'] = $re['function_id'];
                        $tempAction[$j]['selected'] = in_array($re['function_id'], $selected) ? true : false;
                        $j++;
                    }
                }
                $tempNext[$tk]['selected'] = in_array(true, array_column($tempAction, "selected")) ? true : false;
                $tempNext[$tk]['action'] = $tempAction;
            }
            $data[$key]['selected'] = in_array(true, array_column($tempNext, "selected")) ? true : false;
            $data[$key]['controller'] = $tempNext;
        }
        return $data;
    }
}
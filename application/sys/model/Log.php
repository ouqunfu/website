<?php

namespace app\sys\model;

use app\common\service\Constants;
use think\Model;

/**
 * @author: qunfu
 * @date: 2017/7/20
 * @description:
 */
class Log extends Model
{
    /**
     * get log table data
     * @param array $condition
     * @param array $conditionOr
     * @param string $field
     * @param string $order
     * @param int $page
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getList(array $condition = [], array $conditionOr = [], $field = '*', $order = '', $page = 1)
    {
        $field = !empty($field) ? $field : '*';
        if (intval($page) <= 0) $page = 1;
        $firstRow = ($page - 1) * Constants::PAGE_SIZE;
        $limit = $firstRow . ',' . Constants::PAGE_SIZE;
        $res = $this->field($field)->where($condition)->whereOr($conditionOr)->order($order)->limit($limit)->select();
        $data['list'] = $res ? $res->toArray() : [];
        $count = $this->where($condition)->whereOr($conditionOr)->count();
        $data['page_count'] = ceil($count / Constants::PAGE_SIZE);
        $data['count'] = $count;

        return $data;
    }

    /**
     * get all
     * @param array $condition
     * @param string $groupBy
     * @param string $field
     * @param string $order
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getListAll(array $condition = [], $groupBy = '', $field = '*', $order = '')
    {

        $field = !empty($field) ? $field : '*';
        $res = $this->field($field)->where($condition)->group($groupBy)->order($order)->select();
        $res = $res ? $res->toArray() : [];

        return $res;
    }
}
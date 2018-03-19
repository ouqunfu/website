<?php

namespace app\sys\model;

use app\common\service\Constants;
use think\Model;

/**
 * @author: qunfu
 * @date: 2017/6/28
 * @description:
 */
class Functions extends Model
{
    /**
     * insert function info
     * @param array $data
     * @return int|string
     */
    public function addInfo(array $data = [])
    {
        $res = $this->insert($data);
        return $res;
    }

    /**
     * get functions Info
     * @param array $condition
     * @param array $conditionOr
     * @param string $field
     * @return array|false|\PDOStatement|string|Model
     */

    public function getOne(array $condition = [], array $conditionOr = [], $field = '*')
    {
        $field = !empty($field) ? $field : '*';
        $res = $this->field($field)->where($condition)->whereOr($conditionOr)->find();
        $res = $res ? $res->toArray() : [];

        return $res;
    }

    /**
     * get functions info by closure
     * @param array $condition
     * @param array $conditionOr
     * @param string $field
     * @return array|false|\PDOStatement|string|Model
     */
    public function getOneByClosure(array $condition = [], array $conditionOr = [], $field = '*')
    {
        $field = !empty($field) ? $field : '*';

        $res = $this
            ->field($field)
            ->where(
                function ($query) use ($condition) {
                    $query->where($condition);
                }
            )
            ->whereOr(
                function ($query) use ($conditionOr) {
                    $query->where($conditionOr);
                }
            )
            ->find();
        $res = $res ? $res->toArray() : [];

        return $res;
    }

    /**
     * get functions list
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
     * get functions list all
     * @param array $condition
     * @param array $conditionOr
     * @param string $field
     * @param string $group
     * @param string $order
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getListAll(array $condition = [], array $conditionOr = [], $field = '*', $group = '', $order = '')
    {
        $field = !empty($field) ? $field : '*';
        $res = $this->field($field)->where($condition)->whereOr($conditionOr)->group($group)->order($order)->select();
        $res = $res ? $res->toArray() : [];

        return $res;
    }

    /**
     * update functions info
     * @param array $condition
     * @param array $data
     * @return int|string
     */
    public function updateInfo(array $condition = [], array $data = [])
    {
        $res = $this->where($condition)->update($data);
        return $res;
    }
}
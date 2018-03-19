<?php

namespace app\sys\model;

use app\common\service\Constants;
use think\Model;

/**
 * @author: qunfu
 * @date: 2017/6/27
 * @description:
 */
class Role extends Model
{
    /**
     * role create
     * @param array $data
     * @return int|string
     */
    public function addInfo(array $data = [])
    {
        $res = $this->insert($data);
        return $res;
    }

    /**
     * get role info
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
     * get role list
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
     * update role info
     * @param array $map
     * @param array $data
     * @return int|string
     */
    public function updateInfo(array $map = [], array $data = [])
    {
        $res = $this->where($map)->update($data);
        return $res;
    }
}
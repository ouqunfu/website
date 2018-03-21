<?php

namespace app\manage\model;

use app\common\service\Constants;
use think\Model;

/**
 * @author: qunfu
 * @date: 2018/3/21
 * @description:
 */
class Terms extends Model
{
    /**
     * insert data
     * @param array $data
     * @return int|string
     */
    public function addInfo(array $data = [])
    {
        $res = $this->insert($data);
        return $res;
    }

    /**
     * batch insert data
     * @param array $list
     * @return int|string
     */
    public function addAll(array $list = [])
    {
        $res = $this->insertAll($list);
        return $res;
    }

    /**
     * update data
     * @param array $condition
     * @param array $data
     * @return int|string
     */
    public function updateInfo(array $condition = [], array $data = [])
    {
        $res = $this->where($condition)->update($data);
        return $res;
    }

    /**
     * use primary key batch update data
     * @param array $data
     * @return array|false
     */
    public function updateAll(array $data = [])
    {
        $res = $this->saveAll($data);
        return $res;
    }

    /**
     * get data
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
     * get page list data
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
     * @param array $conditionOr
     * @param string $field
     * @param string $order
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getListAll(array $condition = [], array $conditionOr = [], $field = '*', $order = '')
    {

        $field = !empty($field) ? $field : '*';
        $res = $this->field($field)->where($condition)->whereOr($conditionOr)->order($order)->select();
        $res = $res ? $res->toArray() : [];
        return $res;
    }
}
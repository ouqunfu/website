<?php

namespace app\sys\model;

use think\Model;

/**
 * @author: qunfu
 * @date: 2018/3/20
 * @description:
 */
class Usermeta extends Model
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
}
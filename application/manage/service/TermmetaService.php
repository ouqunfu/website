<?php

namespace app\manage\service;

use app\common\service\BaseService;
use app\manage\model\Termmeta;

/**
 * @author: qunfu
 * @date: 2018/3/22
 * @description:
 */
class TermmetaService extends BaseService
{
    /**
     * create terms data
     * @param array $info
     * @return bool|int|string
     */
    public function create(array $info = [])
    {
        if (empty($info)) {
            return false;
        }
        $model = new Termmeta();
        $res = $model->addInfo($info);
        return $res;
    }

    /**
     * update terms
     * @param array $map
     * @param array $data
     * @return bool|int|string
     */
    public function update(array $map = [], array $data = [])
    {
        if (empty($data) || !is_array($data) || empty($map)) {
            return false;
        }
        $model = new Termmeta();
        $res = $model->updateInfo($map, $data);
        if ($res || (0 == $res)) {
            return true;
        }
        return $res;
    }

    /**
     * use primary key batch update term meta data
     * @param array $data
     * @return array|bool|false
     */
    public function updateAll(array $data = [])
    {
        if (empty($data)) {
            return false;
        }
        $model = new Termmeta();
        $res = $model->updateAll($data);
        return $res;
    }

    /**
     * get info
     * @param array $condition
     * @param array $conditionOr
     * @param string $field
     * @return object|string
     */
    public function getInfo(array $condition = [], array $conditionOr = [], $field = '*')
    {
        if (empty($condition) || !is_array($condition)) {
            return false;
        }
        $model = new Termmeta();
        $res = $model->getOne($condition, $conditionOr, $field);
        return $res;
    }

    /**
     * get all
     * @param array $map
     * @param array $mapOr
     * @param string $field
     * @param string $order
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getListAll(array $map = [], array $mapOr = [], $field = '*', $order = '')
    {
        $model = new Termmeta();
        $res = $model->getListAll($map, $mapOr, $field, $order);
        return $res;
    }
}
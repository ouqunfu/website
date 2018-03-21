<?php

namespace app\manage\service;

use app\common\service\BaseService;
use app\manage\model\TermTaxonomy;

/**
 * @author: qunfu
 * @date: 2018/3/21
 * @description:
 */
class TermTaxonomyService extends BaseService
{
    /**
     * create term taxonomy data
     * @param array $info
     * @return bool|int|string
     */
    public function create(array $info = [])
    {
        if (empty($info)) {
            return false;
        }
        $termsTaxonomyModel = new TermTaxonomy();
        $res = $termsTaxonomyModel->addInfo($info);
        return $res;
    }

    /**
     * update term taxonomy
     * @param array $map
     * @param array $data
     * @return bool|int|string
     */
    public function update(array $map = [], array $data = [])
    {
        if (empty($data) || !is_array($data) || empty($map)) {
            return false;
        }
        $termsTaxonomyModel = new TermTaxonomy();
        $res = $termsTaxonomyModel->updateInfo($map, $data);
        if ($res || (0 == $res)) {
            return true;
        }
        return $res;
    }

    /**
     * batch insert term taxonomy data
     * @param array $list
     * @return bool|int|string
     */
    public function insertAll(array $list = [])
    {
        if (empty($list)) {
            return false;
        }
        $termsTaxonomyModel = new TermTaxonomy();
        $res = $termsTaxonomyModel->addAll($list);
        return $res;
    }

    /**
     * use primary key batch update term taxonomy data
     * @param array $data
     * @return array|bool|false
     */
    public function updateAll(array $data = [])
    {
        if (empty($data)) {
            return false;
        }
        $termsTaxonomyModel = new TermTaxonomy();
        $res = $termsTaxonomyModel->updateAll($data);
        return $res;
    }

    /**
     * get list
     * @param array $map
     * @param array $mapOr
     * @param string $field
     * @param string $order
     * @param int $page
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getList(array $map = [], array $mapOr = [], $field = '*', $order = '', $page = 1)
    {
        $termsTaxonomyModel = new TermTaxonomy();
        $res = $termsTaxonomyModel->getList($map, $mapOr, $field, $order, $page);
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
        $termsTaxonomyModel = new TermTaxonomy();
        $res = $termsTaxonomyModel->getListAll($map, $mapOr, $field, $order);
        return $res;
    }
}
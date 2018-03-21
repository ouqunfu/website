<?php

namespace app\manage\service;

use app\common\service\BaseService;
use app\manage\model\Terms;

/**
 * @author: qunfu
 * @date: 2018/3/21
 * @description:
 */
class TermsService extends BaseService
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
        $termsModel = new Terms();
        $res = $termsModel->addInfo($info);
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
        $termsModel = new Terms();
        $res = $termsModel->updateInfo($map, $data);
        if ($res || (0 == $res)) {
            return true;
        }
        return $res;
    }

    /**
     * batch insert terms data
     * @param array $list
     * @return bool|int|string
     */
    public function insertAll(array $list = [])
    {
        if (empty($list)) {
            return false;
        }
        $termsModel = new Terms();
        $res = $termsModel->addAll($list);
        return $res;
    }

    /**
     * use primary key batch update terms data
     * @param array $data
     * @return array|bool|false
     */
    public function updateAll(array $data = [])
    {
        if (empty($data)) {
            return false;
        }
        $termsModel = new Terms();
        $res = $termsModel->updateAll($data);
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
        $termsModel = new Terms();
        $res = $termsModel->getOne($condition, $conditionOr, $field);
        return $res;
    }

    /**
     * get list
     * @param int $page
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getList($page = 1)
    {
        //get category
        $termTaxonomyService = new TermTaxonomyService();
        $category = $termTaxonomyService->getList(['taxonomy' => 'category', 'parent' => 0], [], 'term_id', '', $page);
        $termIds = array_column($category['list'], 'term_id');
        // get category base info
        $termsModel = new Terms();
        $category['list'] = $termsModel->getListAll(['term_id' => ['in', $termIds]]);
        // get category meta data
        $map['term_id'] = ['in', $termIds];
        $map['meta_key'] = 'category_is_nav';

        return $category;
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
        $termsModel = new Terms();
        $res = $termsModel->getListAll($map, $groupBy, $field, $order);
        return $res;
    }
}
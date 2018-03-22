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
        $category = $termTaxonomyService->getList(['taxonomy' => 'category'], [], 'term_id, parent', '', $page);
        $termIds = array_column($category['list'], 'term_id');
        $parents = array_column($category['list'], 'parent', 'term_id');
        // get category base info
        $category['list'] = $this->getListAll(['term_id' => ['in', $termIds]]);
        // get category meta data
        $map['term_id'] = ['in', $termIds];
//        $map['meta_key'] = ['eq','category_is_nav';
        $termMetaService = new TermmetaService();
        $termMetaData = $termMetaService->getListAll(['term_id' => ['in', $termIds], 'meta_key' => ['eq', 'category_is_nav']], ['meta_key' => 'category_sort']);
        foreach ($category['list'] as $key => $item) {
            $item['parent'] = $parents[$item['term_id']];
            foreach ($termMetaData as $termMetaDatum) {
                // 是否导航显示
                if ($item['term_id'] == $termMetaDatum['term_id'] && 'category_is_nav' == $termMetaDatum['meta_key']) {
                    $item['is_nav'] = $termMetaDatum['meta_value'];
                }
                // 排序
                if ($item['term_id'] == $termMetaDatum['term_id'] && 'category_sort' == $termMetaDatum['meta_key']) {
                    $item['sort'] = $termMetaDatum['meta_value'];
                }
            }
            $category['list'][$key] = $item;
        }
        return $category;
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
        $termsModel = new Terms();
        $res = $termsModel->getListAll($map, $mapOr, $field, $order);
        return $res;
    }
}
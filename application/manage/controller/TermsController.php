<?php

namespace app\manage\controller;

use app\common\controller\BaseController;
use app\common\service\Constants;
use app\manage\service\TermmetaService;
use app\manage\service\TermsService;

/**
 * @author: qunfu
 * @date: 2018/3/21
 * @description:
 */
class TermsController extends BaseController
{
    /**
     * get list
     * @return array
     */
    public function lists()
    {
        list($page) = $this->_receiveParams(['page'], Constants::HTTP_GET);
        $termsService = new TermsService();
        $res = $termsService->getList($page);
        return $this->_res(Constants::ERROR_OK, 'Terms list!', $res['list'], $res['page_count'], $res['count']);
    }

    /**
     * change term's sort
     * @return array
     */
    public function sort()
    {
        list($input['sort_data']) = $this->_validateParams(['sort_data'], Constants::HTTP_GET);
        $sortData = json_decode($input['sort_data'], true);
        $map['meta_key'] = 'category_sort';
        $map['term_id'] = ['in', array_keys($sortData)];
        $termMetaService = new TermmetaService();
        $termMeta = $termMetaService->getListAll($map);
        $data = [];
        foreach ($termMeta as $key => $item) {
            $data[$key]['meta_id'] = $item['meta_id'];
            $data[$key]['meta_value'] = $sortData[$item['term_id']];
        }
        $res = $termMetaService->updateAll($data);
        if ($res) return $this->_res(Constants::ERROR_OK, 'Update terms sort successfully!');
        return $this->_res(Constants::ERROR_SERVER, 'Update terms sort failed!');
    }

    public function changeParent()
    {

    }
}
<?php

namespace app\manage\controller;

use app\common\controller\BaseController;
use app\common\service\Constants;
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
}
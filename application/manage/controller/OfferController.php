<?php
namespace app\manage\controller;
use app\common\controller\BaseController;
use app\manage\service\OfferService;

/**
 * @author ouqunfu
 */

class OfferController extends BaseController{

    public function create(){

        $offerService = new OfferService();
        $data = [
            'adv_id' => 111,
            'adv_name' => 'Applift',
            'create_time' => time(),
            'offer_name' => 'test_name',
            'description' => 'This is a other test offer'
        ];
        $offerService->create($data);
    }

    public function getData(){

        $offerService = new OfferService();
        $offerService->getData();
    }

    public function getDataByFilter(){

        $offerService = new OfferService();
        $filter = [
            '$or' => [
                [
                    'offer_name' => ['$regex' => 'test']
                ],
                [
                    'geo' => ['$regex' => 'JP']
                ]
            ]
        ];
        $options = [
            'projection' => ['_id' => 0]
        ];
//        dump($cond);die;
        $offerService->getDataByFilter($filter,$options);
    }

    /**
     * 更新
     */
    public function updateByFilter(){

        $offerService = new OfferService();

        //查询条件
        $filter = [
            'offer_name' => ['$regex' => 'test']
        ];
        //更新的数据
        $data = [
            '$set' => ['adv_id' => 00,'description' => 'This is a new test description!']
        ];
        //选项
        $updateOptions = [
            'multi' => false, //默认false，只更新匹配的第一条记录，true则更新匹配的所有记录
            'upsert' => false //如果不存在update的记录,true为插入，默认是false，不插入
        ];
        $offerService->updateByFilter($filter, $data, $updateOptions);
}

    /**
     * 删除
     */
    public function deleteByFilter(){

        $offerService = new OfferService();

        //查询条件
        $filter = [
            'adv_id' => 111
        ];
        $limit = ['limit' => 1]; //1或者true ，只删除第一条匹配记录，0或者false则删除所有匹配记录
        $offerService->deleteByFilter($filter, $limit);
    }
}
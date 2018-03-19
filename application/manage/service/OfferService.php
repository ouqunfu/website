<?php
namespace app\manage\service;
use app\common\service\BaseService;
use app\manage\model\Offer;
use MongoDB\Driver\Query;
use MongoDB\Driver\BulkWrite;

/**
 * @author ouqunfu
 */

class OfferService extends BaseService{


    public function create(array $data = []){

        $bulk = new BulkWrite();
        $bulk->insert($data);
        $offerModel = new Offer();
        $res = $offerModel->executeBulkWrite($bulk);
        return $res;
    }

    public function getData(){

        $offerModel = new Offer();

        $filter = [
            'status' => ['$eq' => 'active'],
            'geo' => ['$regex' => 'JP'],
        ];
        $options = [
            //投影里除了_id以外，要么全是1，要么全是0，否则就报错
            'projection' => ['_id' => 0, 'adv_id' => 1, 'status' => 1, 'create_time' => 1, 'offer_name' => 1, 'geo' => 1],
            'sort' => ['create_time' => -1],
        ];
//        print_r($filter);
        // 查询数据
        $query = new Query($filter, $options);
        $cursor = $offerModel->executeQuery($query);
        foreach ($cursor as $key => $document) {
            dump($document);
        }
    }

    public function getDataByFilter(array $filter = [], array $options = []){

        $offerModel = new Offer();

//        print_r($filter);die;
        if(empty($options)){
            $options = [
                'projection' => ['_id' => 0]
            ];
        }
        // 查询数据
        $query = new Query($filter,$options);
        $cursor = $offerModel->executeQuery($query);
        foreach ($cursor as $key => $document) {
            dump($document);
        }
    }

    public function updateByFilter(array $filter = [], array $data = [], array $updateOptions = []){

        $bulk = new BulkWrite();
        $bulk->update($filter, $data, $updateOptions);
        $offerModel = new Offer();
        $offerModel->executeBulkWrite($bulk);
    }

    public function deleteByFilter(array $filter = [], array $limit = ['limit' => 1]){

        $bulk = new BulkWrite();
        $bulk->delete($filter, $limit);
        $offerModel = new Offer();
        $offerModel->executeBulkWrite($bulk);
    }
}
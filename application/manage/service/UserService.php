<?php
namespace app\manage\service;
use app\common\service\BaseService;
use app\manage\model\User;
use MongoDB\Driver\BulkWrite;

/**
 * Created by PhpStorm.
 * User: FEIWU187
 * Date: 2017/6/14
 * Time: 16:02
 */
class UserService extends BaseService
{

    public function create(array $data = []){
        $bulk = new BulkWrite();
        $bulk->insert($data);
        $userModel = new User();
        $userModel->executeBulkWrite($bulk);
    }
}
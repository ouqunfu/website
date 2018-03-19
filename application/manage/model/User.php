<?php
namespace app\manage\model;
use app\common\model\AaMongoModel;

/**
 * Created by PhpStorm.
 * User: FEIWU187
 * Date: 2017/6/14
 * Time: 16:04
 */
class User extends AaMongoModel
{
    public $collection = 'aa_user';
    public $dbName = 'aa';

}

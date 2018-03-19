<?php
namespace app\manage\model;
use app\common\model\AaMongoModel;

/**
 * @author ouqunfu
 */
class Offer extends AaMongoModel{

    public $collection = 'aa_offer';
    public $dbName = 'aa';
}
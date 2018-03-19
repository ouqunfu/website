<?php
namespace app\common\model;

/**
 * @author tommy
 * 不建议用tp5的mongo，问题比较多
 * Class BaseMongoModel
 * @package app\common\model
 */
class AaMongoModel extends BaseMongoModel
{
    protected $connection = 'aa_mongo';
}
 
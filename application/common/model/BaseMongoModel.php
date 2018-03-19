<?php
namespace app\common\model;

use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Command;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
use MongoDB\Driver\WriteConcern;
use think\Config;
use think\Model;

/**
 * @authur tommy
 * appsnt api的mongo
 * 封装原生的php7对于mongo的扩展
 * 不建议用tp5的mongo，问题比较多
 * Class BaseMongoModel
 * @package app\common\model
 */
class BaseMongoModel extends Model
{
    protected $connection = '';

    private static $manager = '';

    private static $writeConcern = '';

    /**
     * 继承的来指定集合名
     * @var string
     */
    protected $collection = '';

    /**
     * 继承来指定数据库名
     * db name
     * @var string
     */
    protected $dbName = '';

    /**
     * 单例获取mongo manager
     * @return Manager|string
     */
    public function getManager()
    {
        if (empty(self::$manager)) {
            $connectionUrl = Config::get($this->connection)['connection_url'];
            self::$manager = new Manager($connectionUrl);
        }
        return self::$manager;
    }

    /**
     * 单例获取mongo writeConcern
     * @return WriteConcern|string
     */
    public function getWriteConcern()
    {
        if (empty(self::$writeConcern)) {
            self::$writeConcern = new WriteConcern(WriteConcern::MAJORITY, 1000);
        }
        return self::$writeConcern;
    }

    /**
     * 插入更新
     * @param BulkWrite $bulk
     * @return \MongoDB\Driver\WriteResult
     */
    public function executeBulkWrite(BulkWrite $bulk)
    {
        if ($bulk->count() == 0){
            return [];
        }
        $result = $this->getManager()->executeBulkWrite($this->dbName . '.' . $this->collection, $bulk, $this->getWriteConcern());
        return $result;
    }

    /**
     * @param array $datas
     * @return int|string|void
     */
    public function insert(array $datas)
    {
        $bulk = new BulkWrite();
        foreach ($datas as $data) {
            $bulk->insert($data);
        }
        $this->executeBulkWrite($bulk);
    }

    /**
     * 查询
     * @param Query $query
     * @return \MongoDB\Driver\Cursor
     */
    public function executeQuery(Query $query)
    {
        $cursor = $this->getManager()->executeQuery($this->dbName . '.' . $this->collection, $query);
        return $cursor;
    }

    /**
     * 执行原生mongo查询
     * @param Command $command
     * @return \MongoDB\Driver\Cursor
     */
    public function executeCommand(Command $command)
    {
        $cursor = $this->getManager()->executeCommand($this->dbName, $command);
        return $cursor;
    }
}
 
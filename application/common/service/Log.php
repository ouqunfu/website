<?php
namespace app\common\service;
/**
 * @author: qunfu
 * @date: 2017/6/27
 * @description: 日志类
 */
class Log
{
    /**
     * 增加日志
     * @param array $log
     */
    public static function create(array $log = []){

        if($log) {
            db('log', [], false)->insert($log);
        }
        return ;
    }
}
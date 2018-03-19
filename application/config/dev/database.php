<?php
/**
 * Created by PhpStorm.
 * User: FEIWU187
 * Date: 2017/6/14
 * Time: 15:38
 */
$databaseConfig = [
    'database' => [
        // 数据库类型
        'type'           => 'mysql',
        // 服务器地址
        'hostname'       => '127.0.0.1',
        // 数据库名
        'database'       => 'website',
        // 用户名
        'username'       => 'jeffrey',
        // 密码
        'password'       => 'jeffrey123',
        // 端口
        'hostport'       => '3306',
        // 数据库编码默认采用utf8
        'charset'        => 'utf8',
        // 数据库表前缀
        'prefix'         => 'ws_',
        // 数据集返回类型 array 数组 collection Collection对象
        'resultset_type' => 'collection',
    ],
    'aa_mongo' => [
        // 数据库类型
        'type'           => 'mysql',
        // 服务器地址
        'hostname'       => '127.0.0.1',
        // 数据库名
        'database'       => '',
        // 用户名
        'username'       => '',
        // 密码
        'password'       => '',
        // 端口
        'hostport'       => '27017',
        // 数据库编码默认采用utf8
        'charset'        => 'utf8',
        // 自行封装，不属于tp的
        'connection_url'           => 'mongodb://127.0.0.1:27017'
    ],
];
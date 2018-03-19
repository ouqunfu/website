<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// [ 应用入口文件 ]
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');

// 检查环境变量，优先从 /etc/profile 取，不存在则从 $_SERVER 变量取，都没有则设为 production。
// 然后写入项目的 environment.txt 文件，下次直接读取该文件。
define('BASE_PATH',realpath(str_replace('public','',__DIR__)));
$envFile = BASE_PATH . '/env.txt';
$env = is_file($envFile) ? trim(file_get_contents($envFile)) : '';
if (empty($env)) {
    if (preg_match('/RUNTIME_ENVIROMENT=(.*)/', file_get_contents('/etc/profile'), $matches)) {
        $env = trim($matches[1], '" ');
    } elseif (!empty($_SERVER['RUNTIME_ENVIROMENT'])) {
        $env = $_SERVER['RUNTIME_ENVIROMENT'];
    } else {
        echo 'ENVIRONMENT undefined!';exit();
    }
    file_put_contents($envFile, $env);
}
unset($envFile);
define('ENVIRONMENT', $env);

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
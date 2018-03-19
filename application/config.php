<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
require_once __DIR__.'/config/'.ENVIRONMENT.'/base.php';
require_once __DIR__.'/config/'.ENVIRONMENT.'/database.php';

return array_merge($baseConfig,$databaseConfig);

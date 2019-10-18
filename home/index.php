<?php
// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
define('RUNTIME_PATH', 	'../runtime/');//缓存目录
define('ADMIN_STATUS','XHADMIN');
// $build = include APP_PATH.'build.php';
// \think\Build::run($build);
// 加载框架引导文件
 require __DIR__ . '/../thinkphp/start.php';

<?php
/**
 * 入口文件
 * 1.定义常量
 * 2.加载函数库
 * 3.启动框架
 */
header("Content-type:text/html; charset=uft-8");
# 定义全局常量
define('DIYPHP', realpath(__DIR__));
define('CORE', DIYPHP.'/core');
define('APP', DIYPHP.'/app');
define('MODULE', 'app');

define('DEBUG', true);
if(DEBUG) {
	ini_set('display_error', 'On');
} else {
	ini_set('display_error', 'Off');
}

# 加载公用函数库
include CORE . '/common/functions.php';
# 加载核心类库
include CORE . '/diyphp.php';

# 注册自动加载函数
spl_autoload_register('\core\diyphp::load');

# 启动框架
\core\diyphp::run();

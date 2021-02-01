<?php
// +----------------------------------------------------------------------
// | I was crazy about a girl
// +----------------------------------------------------------------------
// | Created By PhpStorm
// +----------------------------------------------------------------------
// | Author: J0n4than.L <admin@56fkj.cn>
// +----------------------------------------------------------------------

#自动加载
require_once __DIR__.'/../../vendor/autoload.php';
require_once 'functions.php';

define('ORDER_PATH', dirname(__DIR__).'/../storage/cache/order');
define('RECORD_PATH', dirname(__DIR__).'/../storage/cache/record');

use Medoo\Medoo;
use Lib\Session;

#database
try {
    $database = new Medoo([
        'database_type' => 'mysql',
        'server' => 'localhost',
        'port' => '3306',
        'database_name' => '',    //数据库
        'username' => '',    //用户名
        'password' => '',    //密码
        'charset' => 'utf8',
        'prefix' => 'pay_'
    ]);
} catch (PDOException $exception) {
    exit($exception->getMessage()."<br>请保证数据库的正确配置");
}

#conf
$configs = $database->select('config', '*');
$conf = [];
foreach ($configs as $config) {
    $conf[$config['k']] = $config['v'];
}

#session
$session_save_path = dirname(__DIR__).'/../storage/session';
$session = new Session($session_save_path);

#member
$user_session = $session->get('user_session');
if (!is_null($user_session)) {
    $isLogin = true;
    $userInfo = $database->get('user', '*', ['uid' => $user_session]);
}

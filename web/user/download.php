<?php
// +----------------------------------------------------------------------
// | I was crazy about a girl
// +----------------------------------------------------------------------
// | Created By PhpStorm
// +----------------------------------------------------------------------
// | Author: J0n4than.L <admin@56fkj.cn>
// +----------------------------------------------------------------------

require '../core/common.php';

if (empty($_COOKIE['file'])) {
    exit('x.x');
}
$type = isset($_GET['type']) ? $_GET['type'] : 0;
$path = ORDER_PATH;
if ($type == 1) {
    $path = RECORD_PATH;
}

$file = $path.'/'.$_COOKIE['file'];
$file_name = $_COOKIE['file'];
$file_size = filesize("$file");

header("Content-Description: File Transfer");
header("Content-Type:application/force-download");
header("Content-Length: {$file_size}");
header("Content-Disposition:attachment; filename={$file_name}");
readfile("$file");

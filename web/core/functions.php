<?php
// +----------------------------------------------------------------------
// | I was crazy about a girl
// +----------------------------------------------------------------------
// | Created By PhpStorm
// +----------------------------------------------------------------------
// | Author: J0n4than.L <admin@56fkj.cn>
// +----------------------------------------------------------------------

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

#公共函数

/**
 * 返回json
 *
 * @param $status
 * @param $message
 * @param $result
 */
function jsonResponse($status, $message, $result = null)
{
    $data = [
        'status' => $status,
        'message' => $message,
        'result' => $result
    ];

    exit(json_encode($data));
}

/**
 * 字符转义
 *
 * @param $string
 * @param  int  $force
 * @param  false  $strip
 * @return array|mixed|string
 */
function daddslashes($string, $force = 0, $strip = false)
{
    !defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
    if (!MAGIC_QUOTES_GPC || $force) {
        if (is_array($string)) {
            foreach ($string as $key => $val) {
                $string[$key] = daddslashes($val, $force, $strip);
            }
        } else {
            $string = addslashes($strip ? stripslashes($string) : $string);
        }
    }
    return $string;
}

/**
 * 获取加密后的密码字符
 *
 * @param $pwd
 * @param  null  $salt
 * @return string
 */
function getPassword($pwd, $salt = null): string
{
    return md5(md5($pwd).md5('1277180438'.$salt));
}

/**
 * bootstrap的active辅助检查
 *
 * @param $string
 * @return string|null
 */
function checkIfActive($string): ?string
{
    $array = explode(',', $string);
    $php_self = substr(
        $_SERVER['REQUEST_URI'],
        strrpos($_SERVER['REQUEST_URI'], '/') + 1,
        strrpos($_SERVER['REQUEST_URI'], '.') -
        strrpos($_SERVER['REQUEST_URI'], '/') - 1
    );
    if (in_array($php_self, $array)) {
        return 'active';
    } else {
        return null;
    }
}

/**
 * 订单表格导出
 *
 * @param $orders
 * @throws \PhpOffice\PhpSpreadsheet\Exception
 * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
 */
function order2excel($orders)
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->getCell('A1')->setValue('订单号');
    $sheet->getCell('B1')->setValue('商户订单号');
    $sheet->getCell('C1')->setValue('商品名称');
    $sheet->getCell('D1')->setValue('订单金额');
    $sheet->getCell('E1')->setValue('创建时间');
    $sheet->getCell('F1')->setValue('订单状态');
    $l = 2;
    foreach ($orders as $order) {
        $sheet->getCell('A'.$l)->setValue($order['trade_no'])
            ->setDataType(DataType::TYPE_STRING2);
        $sheet->getCell('B'.$l)->setValue($order['out_trade_no'])
            ->setDataType(DataType::TYPE_STRING2);
        $sheet->getCell('C'.$l)->setValue($order['name']);
        $sheet->getCell('D'.$l)->setValue($order['money']);
        $sheet->getCell('E'.$l)->setValue($order['addtime']);
        $sheet->getCell('F'.$l)->setValue(status2statusStr($order['status']));
        $l++;
    }
    $writer = new Xlsx($spreadsheet);
    $file = md5(time()).random(8).'.xlsx';
    $filepath = ORDER_PATH.'/'.$file;
    $writer->save($filepath);
    setcookie("file", $file, time() + 600);
}

/**
 * 资金明细表格导出
 *
 * @param $records
 * @throws \PhpOffice\PhpSpreadsheet\Exception
 * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
 */
function record2excel($records)
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->getCell('A1')->setValue('操作类型');
    $sheet->getCell('B1')->setValue('变更金额');
    $sheet->getCell('C1')->setValue('变更前金额');
    $sheet->getCell('D1')->setValue('变更后金额');
    $sheet->getCell('E1')->setValue('时间');
    $sheet->getCell('F1')->setValue('关联订单号');
    $l = 2;
    foreach ($records as $order) {
        $sheet->getCell('A'.$l)->setValue($order['type']);
        $sheet->getCell('B'.$l)->setValue($order['money']);
        $sheet->getCell('C'.$l)->setValue($order['oldmoney']);
        $sheet->getCell('D'.$l)->setValue($order['newmoney']);
        $sheet->getCell('E'.$l)->setValue($order['date']);
        $sheet->getCell('F'.$l)->setValue($order['trade_no'])
            ->setDataType(DataType::TYPE_STRING2);
        $l++;
    }
    $writer = new Xlsx($spreadsheet);
    $file = md5(time()).random(8).'.xlsx';
    $filepath = RECORD_PATH.'/'.$file;
    $writer->save($filepath);
    setcookie("file", $file, time() + 600);
}

/**
 * 返回状态字符串
 *
 * @param $status
 * @return string
 */
function status2statusStr($status): string
{
    return ($status == 1) ? '已完成' : '未完成';
}

/**
 * 随机字符串
 *
 * @param $length
 * @param  int  $numeric
 * @return string
 */
function random($length, $numeric = 0): string
{
    $seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
    $seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
    $hash = '';
    $max = strlen($seed) - 1;
    for ($i = 0; $i < $length; $i++) {
        $hash .= $seed{mt_rand(0, $max)};
    }
    return $hash;
}

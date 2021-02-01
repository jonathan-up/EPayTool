<?php
// +----------------------------------------------------------------------
// | I was crazy about a girl
// +----------------------------------------------------------------------
// | Created By PhpStorm
// +----------------------------------------------------------------------
// | Author: J0n4than.L <admin@56fkj.cn>
// +----------------------------------------------------------------------

require '../core/common.php';

if (!$isLogin) {
    jsonResponse(-1, '没有权限');
}

header('Content-Type:application/json; charset=utf-8');

$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($action) {
    case 'logout':
        $session->remove('user_session');
        jsonResponse(0, '注销登录成功');
        break;
    case 'out_order':
        $data = daddslashes($_POST);
        if (!empty($data['timeS']) && !empty($data['timeE'])) {
            $orders = $database->select('order', '*', [
                'AND' => [
                    "date[<>]" => [$data['timeS'], $data['timeE']],
                    "uid" => $userInfo['uid']
                ]
            ]);

            if ($orders == []) {
                jsonResponse(-1, '没有订单数据');
            }
            order2excel($orders);
            jsonResponse(0, '导出成功');
        }
        if (empty($data['timeS']) && empty($data['timeE'])) {
            //查询全部数据
            $orders = $database->select('order', '*', ['uid' => $userInfo['uid']]);

            if ($orders == []) {
                jsonResponse(-1, '没有订单数据');
            }
            order2excel($orders);
            jsonResponse(0, '导出成功');
        } else {
            if ((!empty($data['timeS']) && empty($data['timeE']))) {
                //查询开始时间后的所有数据
                $orders = $database->select('order', '*', [
                    'AND' => [
                        'date[>]' => $data['timeS'],
                        'uid' => $userInfo['uid']
                    ]
                ]);

                if ($orders == []) {
                    jsonResponse(-1, '没有订单数据');
                }
                order2excel($orders);
                jsonResponse(0, '导出成功');
            }
            if ((!empty($data['timeE']) && empty($data['timeS']))) {
                //查询结束时间前的所有数据
                $orders = $database->select('order', '*', [
                    'AND' => [
                        'date[<]' => $data['timeE'],
                        'uid' => $userInfo['uid']
                    ]
                ]);

                if ($orders == []) {
                    jsonResponse(-1, '没有订单数据');
                }
                order2excel($orders);
                jsonResponse(0, '导出成功');
            }
        }
        break;
    case 'out_record':
        $data = daddslashes($_POST);
        if (!empty($data['timeS']) && !empty($data['timeE'])) {
            $records = $database->select('record', '*', [
                'AND' => [
                    "date[<>]" => [$data['timeS'], $data['timeE']],
                    'uid' => $userInfo['uid']
                ]
            ]);

            if ($records == []) {
                jsonResponse(-1, '没有明细数据');
            }
            record2excel($records);
            jsonResponse(0, '导出成功');
        }
        if (empty($data['timeS']) && empty($data['timeE'])) {
            //查询全部数据
            $records = $database->select('record', '*', ['uid' => $userInfo['uid']]);

            if ($records == []) {
                jsonResponse(-1, '没有明细数据');
            }
            record2excel($records);
            jsonResponse(0, '导出成功');
        } else {
            if ((!empty($data['timeS']) && empty($data['timeE']))) {
                //查询开始时间后的所有数据
                $records = $database->select('record', '*', [
                    'AND' => [
                        'date[>]' => $data['timeS'],
                        'uid' => $userInfo['uid']
                    ]
                ]);

                if ($records == []) {
                    jsonResponse(-1, '没有明细数据');
                }
                record2excel($records);
                jsonResponse(0, '导出成功');
            }
            if ((!empty($data['timeE']) && empty($data['timeS']))) {
                //查询结束时间前的所有数据
                $records = $database->select('record', '*', [
                    'AND' => [
                        'date[<]' => $data['timeE'],
                        'uid' => $userInfo['uid']
                    ]
                ]);

                if ($records == []) {
                    jsonResponse(-1, '没有明细数据');
                }
                record2excel($records);
                jsonResponse(0, '导出成功');
            }
        }
        break;
}

<?php
// +----------------------------------------------------------------------
// | I was crazy about a girl
// +----------------------------------------------------------------------
// | Created By PhpStorm
// +----------------------------------------------------------------------
// | Author: J0n4than.L <admin@56fkj.cn>
// +----------------------------------------------------------------------

require '../core/common.php';

header('Content-Type:application/json; charset=utf-8');

$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($action) {
    case 'login':
        $data = daddslashes($_POST);

        if (is_null($data['username']) || is_null($data['password']) || is_null($data['type'])) {
            jsonResponse(-1, '请保证各项不为空!');
        }

        if ($data['type'] == 0) {
            //账号登陆
            $user = $database->get('user', '*', [
                'OR' => [
                    'email' => $data['username'],
                    'phone' => $data['username']
                ]
            ]);
            $password = getPassword($data['password'], $user['uid']);

            if ($password === $user['pwd']) {
                $session->set('user_session', $user['uid']);
                jsonResponse(0, '登录成功');
            } else {
                jsonResponse(-1, '登录信息不匹配');
            }
        } else {
            //密钥登录
            $user = $database->get('user', '*', ['uid' => $data['username']]);
            if (!is_null($user) && $user['keylogin'] == 0) {
                jsonResponse(-1, '该商户未开启密钥登录，请使用账号密码登录');
            }

            if ($data['password'] == $user['key']) {
                $session->set('user_session', $user['uid']);
                jsonResponse(0, '登录成功');
            } else {
                jsonResponse(-1, '登录信息不匹配');
            }
        }
        break;
}

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
    exit('<script>location.href="login.php";</script>');
}
?>
<!doctype html>
<html lang="en">
<head>
    <title><?= $title ?> | <?= $conf['sitename'] ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <a class="navbar-brand" href="#"><?= $conf['sitename'] ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= checkIfActive('index') ?>">
                <a class="nav-link" href="index.php">首页</a>
            </li>
            <li class="nav-item <?= checkIfActive('out_order') ?>">
                <a class="nav-link" href="out_order.php">导出订单</a>
            </li>
            <li class="nav-item <?= checkIfActive('out_record') ?>">
                <a class="nav-link" href="out_record.php">导出余额明细</a>
            </li>
        </ul>
        <button id="logout" class="btn btn-danger my-2 my-sm-0" type="button">注销登录</button>
    </div>
</nav>
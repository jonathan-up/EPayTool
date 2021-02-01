<?php
// +----------------------------------------------------------------------
// | I was crazy about a girl
// +----------------------------------------------------------------------
// | Created By PhpStorm
// +----------------------------------------------------------------------
// | Author: J0n4than.L <admin@56fkj.cn>
// +----------------------------------------------------------------------

require '../core/common.php';
?>
<!doctype html>
<html lang="en">
<head>
    <title>登录 | <?= $conf['sitename'] ?></title>
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
            <li class="nav-item active">
                <a class="nav-link" href="#">登录 <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-3">
    <div class="card">
        <div class="card-header bg-primary">用户登录</div>
        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show"
                       data-toggle="tab"
                       href="#user"
                       role="tab"
                       aria-selected="true"
                       onclick="setType(0)">用户名登录</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       data-toggle="tab"
                       href="#key" role="tab"
                       aria-selected="false"
                       onclick="setType(1)">密钥登录</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane p-3 active show" id="user" role="tabpanel">
                    <form id="login_user">
                        <div class="form-group">
                            <label for="username">邮箱/手机号</label>
                            <input name="username" type="text" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="password">密码</label>
                            <input name="password" type="password" class="form-control" id="password">
                        </div>
                    </form>
                    <div class="alert alert-info">易支付平台的登录信息.</div>
                </div>
                <div class="tab-pane p-3" id="key" role="tabpanel">
                    <form id="login_key">
                        <div class="form-group">
                            <label for="mch_id">商户ID</label>
                            <input name="username" type="text" class="form-control" id="mch_id">
                        </div>
                        <div class="form-group">
                            <label for="key_input">KEY</label>
                            <input name="password" type="password" class="form-control" id="key_input">
                        </div>
                    </form>
                    <div class="alert alert-info">易支付平台的登录信息.</div>
                </div>
                <button id="login" type="button" class="btn btn-primary">登录</button>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<script src="../assets/jquery/jquery.js"></script>
<script src="../assets/axios/axios.js"></script>
<script src="../assets/layer/layer.js"></script>
<script src="../assets/bootstrap/js/bootstrap.js"></script>

<script>
    let type = 0;

    function setType(type_input) {
        type = type_input;
    }

    <?php
    if ($isLogin) {
        echo "layer.alert('你已经登录!', function () {location.href = 'index.php';})";
    }
    ?>

    $(function () {
        $("#login").click(function () {
            let load = layer.load();
            let data;
            if (type === 0) {
                data = $("#login_user").serialize() + '&type=' + type;
            } else {
                data = $("#login_key").serialize() + '&type=' + type;
            }
            axios({
                method: 'post',
                url: 'ajax_without_auth.php?action=login',
                data: data
            }).then(function (response) {
                layer.close(load);
                if (response.data.status === 0) {
                    layer.alert(response.data.message);
                    setTimeout(function () {
                        window.location.href = "index.php";
                    }, 1000);
                } else {
                    layer.msg(response.data.message);
                }
            });
        });
    });

</script>
</body>
</html>

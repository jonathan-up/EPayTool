<?php
// +----------------------------------------------------------------------
// | I was crazy about a girl
// +----------------------------------------------------------------------
// | Created By PhpStorm
// +----------------------------------------------------------------------
// | Author: J0n4than.L <admin@56fkj.cn>
// +----------------------------------------------------------------------

$title = '后台首页';
require '../core/common.php';
require 'header.php';
?>

<div class="container mt-3">
    <div class="card">
        <div class="card-header bg-primary">
            后台首页
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                暂时只有两个功能
            </div>
            <a class="btn btn-primary" href="out_order.php">导出订单</a>
            <a class="btn btn-warning" href="out_order.php">导出余额明细</a>
        </div>
    </div>
</div>

<?php
require 'footer.php';
?>
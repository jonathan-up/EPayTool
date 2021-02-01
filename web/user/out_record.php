<?php
// +----------------------------------------------------------------------
// | I was crazy about a girl
// +----------------------------------------------------------------------
// | Created By PhpStorm
// +----------------------------------------------------------------------
// | Author: J0n4than.L <admin@56fkj.cn>
// +----------------------------------------------------------------------

$title = '导出余额明细';
require '../core/common.php';
require 'header.php';
?>

<div class="container mt-3">
    <div class="card">
        <div class="card-header bg-primary">
            导出余额明细
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <ul>
                    <li>全部留空会查询全部数据</li>
                    <li>只填写开始时间会查询开始时间到现在的数据</li>
                    <li>只填写结束时间会查询结束时间到最早的数据</li>
                    <li>都填写会查询两个时间中间的数据</li>
                </ul>
            </div>
            <form id="form-out">
                <div class="form-group">
                    <label for="timeS">开始时间</label>
                    <input name="timeS" type="text" class="form-control" id="timeS">
                </div>
                <div class="form-group">
                    <label for="timeE">结束时间</label>
                    <input name="timeE" type="text" class="form-control" id="timeE">
                </div>
                <button id="do" type="button" class="btn btn-primary">导出</button>
            </form>
        </div>
    </div>
</div>
<?php
require 'footer.php';
?>
<script src="../assets/laydate/laydate.js"></script>
<script>
    laydate.render({
        elem:'#timeS'
    });
    laydate.render({
        elem:'#timeE'
    });

    $(function () {
        $("#do").click(function () {
            let load = layer.load();
            axios({
                method: 'post',
                url: 'ajax.php?action=out_record',
                data: $("#form-out").serialize()
            }).then(function (response) {
                layer.close(load);
                if (response.data.status === 0) {
                    layer.alert(response.data.message);
                    window.open('download.php?type=1');
                } else {
                    layer.msg(response.data.message);
                }
            });
        });
    });
</script>
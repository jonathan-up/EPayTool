<?php
// +----------------------------------------------------------------------
// | I was crazy about a girl
// +----------------------------------------------------------------------
// | Created By PhpStorm
// +----------------------------------------------------------------------
// | Author: J0n4than.L <admin@56fkj.cn>
// +----------------------------------------------------------------------

?>
<!-- Optional JavaScript -->
<script src="../assets/jquery/jquery.js"></script>
<script src="../assets/axios/axios.js"></script>
<script src="../assets/layer/layer.js"></script>
<script src="../assets/bootstrap/js/bootstrap.js"></script>

<script>
    $(function () {
        $("#logout").click(function () {
            let load = layer.load();
            axios({
                method: 'post',
                url: 'ajax.php?action=logout',
            }).then(function (response) {
                layer.close(load);
                if (response.data.status === 0) {
                    layer.alert(response.data.message);
                    setTimeout(function () {
                        window.location.href = "login.php";
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

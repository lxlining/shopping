<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <title>退货订单</title>
    <link href="/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.js"></script>
    <style>
        .input{
            width: 30px;
        }
        a{
            text-decoration: none;
        }
        body{
            margin: 20px;
        }
    </style>
</head>
<?php
header("Content-type:text/html;charset=utf-8");
session_start();
include("conn/conn.php");
error_reporting(0);
$user=$_SESSION["username"];
?>
<body>
<div class="container">
    <div class="col-md-12 navbar navbar-default navbar-static-top">
        <button class="navbar-toggle" data-toggle="collapse" data-target="#a">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <ul class="nav nav-pills pull-right navbar-collapse" id="a">
            <li class="active"><a href="self.php">个人中心</a> </li>
            <li class="active"><a href="gwc.php">购物车</a> </li>
            <li class="active"><a href="order.php">订单系统</a> </li>
            <li class="active"><a href="index.php#link">网站导航</a> </li>
        </ul>
    </div>
    <br/><br/>
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <td>图片</td>
                <td>商品名</td>
                <td>数量</td>
                <td>价格</td>
                <td>订单状态</td>

            </tr>
            <?php
            $sql1="select * from (((tb_sc_order order1 join tb_sc_order_info info on order1.order_info_id=info.order_info_id) join tb_sc_goods goods on goods.goods_id=info.goods_id) join tb_sc_pic pic on goods.goods_id=pic.goods_id) where order1.user_name='$user' and pic.mr='3' and order1.order_zt='2'";
            $res1=$pdo->query($sql1);
            $row=$res1->fetch(PDO::FETCH_OBJ);
            do{
                ?>
                <tr>
                    <td><img src="admin/upfile2/<?php echo $row->address;?>" width="60" height="60"> &nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><?php echo $row->gname;?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><?php echo $row->num;?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><?php echo $row->price;?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><?php if($row->order_zt=='2') echo "已退货"; else echo "处理中"?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <?php
            }while($row=$res1->fetch(PDO::FETCH_OBJ));
            ?>
        </table>
    </div>
</div>
</body>
</html>

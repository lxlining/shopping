<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <title>个人中心</title>
    <link href="/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.js"></script>
    <style>
        /*.container{*/
        /*    width: 80%;*/
        /*    margin: 0 auto;*/
        /*}*/
        body{
            margin: 20px;
        }
    </style>
</head>
<?php
header("Content-type:text/html;charset=utf-8");
session_start();
include("conn/conn.php");
if($_SESSION["username"]==""){
    echo "<script>alert('未登录，请登录！');window.location.href='login.php';</script>";
}
$user=$_SESSION["id"];
$user1=$_SESSION["username"];
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
    <div class="col-md-12">
        <table class="table-hover table table-bordered table-striped">
            <tr>
                <?php
                $sql2="select * from tb_sc_user u join tb_sc_photo p on u.user_name=p.user_name where u.user_name='$user1' and p.mr='1'";
                $res2=$pdo->query($sql2);
                $row2=$res2->fetch(PDO::FETCH_OBJ);
                ?>
                <td><img src="upfile1/<?php echo $row2->address;?>" width="60" height="60" style="border-radius: 20px"> </td>
                <td><?php echo $row2->user_name;?></td>
                <td><a href="update_userinfo.php">修该信息</a> </td>
            </tr>

            <tr>
                <?php

                $sql1="select * from tb_sc_address where mr='1' and user_id=$user";
                $res1=$pdo->query($sql1);
                $row1=$res1->fetch(PDO::FETCH_OBJ);
                ?>
                <td>默认地址：</td>
                <td><?php echo $row1->address;?></td>
                <td><a href="add_address.php" >添加地址</a></td>
            </tr>

        </table>
    </div>
    <br/>
    <div class="col-md-12">
        <table class="table-hover table table-bordered table-striped">
            <tr>
                <td>图片</td>
                <td>商品名</td>
                <td>数量</td>
                <td>价格</td>
                <td>订单状态</td>
            </tr>
            <?php
            $sql2="select * from (((tb_sc_order order1 join tb_sc_order_info info on order1.order_info_id=info.order_info_id) join tb_sc_goods goods on goods.goods_id=info.goods_id) join tb_sc_pic pic on goods.goods_id=pic.goods_id) where order1.user_name='$user1' and pic.mr='3' order by order1.create_time desc";
            $res2=$pdo->query($sql2);
            $row2=$res2->fetch(PDO::FETCH_OBJ);
            do{
                ?>
                <tr>
                    <td><img src="admin/upfile2/<?php echo $row2->address;?>" width="60" height="60"></td>
                    <td><?php echo $row2->gname;?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><?php echo $row2->num;?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><?php echo $row2->price;?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><b class="btn-info btn btn-lg"><?php if($row2->order_zt=='1') echo "已发货"; else if($row2->order_zt=='3') echo "已收货"; else echo "未发货";?>&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                </tr>
                <?php
            }while($row2=$res2->fetch(PDO::FETCH_OBJ));
            ?>
        </table>
    </div>

</div>
</body>
</html>

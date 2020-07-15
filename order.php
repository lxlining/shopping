<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <title>订单</title>
    <link href="/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.js"></script>
    <style>
        body{
            padding: 20px;
        }
        /*body{*/
        /*    width: 1100px;*/
        /*    margin: 0 auto;*/
        /*}*/
        /*.input{*/
        /*    width: 30px;*/
        /*}*/
        /*a{*/
        /*    text-decoration: none;*/
        /*}*/
        /*.nav{*/
        /*    height: 30px;*/
        /*}*/
        /*.nav1{*/
        /*    text-decoration: none;*/
        /*    text-align: justify;*/
        /*    float: right;*/
        /*    margin-right: 20px;*/
        /*}*/
        /*ul{*/
        /*    text-decoration: none;*/
        /*}*/
        /*li{*/
        /*    text-decoration: none;*/
        /*    list-style: none;*/
        /*    text-align: center;*/
        /*    margin-left: 40px;*/
        /*}*/
        /*.input1{*/
        /*    width: 400px;*/
        /*    height: 30px;*/
        /*    border-radius: 15px;*/
        /*    border: 1px solid orange;*/
        /*}*/
        /*.input2{*/
        /*    width: 60px;*/
        /*    height: 30px;*/
        /*    border-radius: 15px;*/
        /*    border: 1px solid orange;*/
        /*}*/
        /*table{*/
        /*    border-collapse: collapse;*/
        /*}*/
    </style>
</head>
<?php
header("Content-type:text/html;charset=utf-8");
session_start();
include("conn/conn.php");
error_reporting(0);
if($_SESSION["username"]==""){
    echo "<script>alert('未登录，请登录！');window.location.href='login.php';</script>";
}
$user=$_SESSION["username"];
unset($_SESSION["infoid"]);
unset($_SESSION["aa"]);
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
        <div class="col-md-2 visible-md visible-lg" ><img src="images/bg2.png"> </div>
        <form action="search1.php" method="post" name="form1" class="navbar-form text-center ">
            <div class="form-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="关键字">
            </div>
            <input type="submit" name="submit" value="搜索" class="btn btn-default">
        </form>
    </div>
    <p>&nbsp;</p>
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <td>图片</td>
                <td>商品名</td>
                <td>数量</td>
                <td>价格</td>
                <td>订单状态</td>
                <td>支付状态</td>
                <td>操作</td>
            </tr>
                <?php
                $sql1="select * from (((tb_sc_order order1 join tb_sc_order_info info on order1.order_info_id=info.order_info_id) join tb_sc_goods goods on goods.goods_id=info.goods_id) join tb_sc_pic pic on goods.goods_id=pic.goods_id) where order1.user_name='$user' and pic.mr='3' and (order1.order_zt='1' or order1.order_zt='0') order by order1.order_id desc,order1.create_time desc";
                $res1=$pdo->query($sql1);
                $row=$res1->fetch(PDO::FETCH_OBJ);
                do{
                    ?>
                <tr>
                    <td><img src="admin/upfile2/<?php echo $row->address;?>" width="60" height="60"> </td>
                    <td><?php echo $row->gname;?></td>
                    <td><?php echo $row->num;?></td>
                    <td><?php echo $row->price;?></td>
                    <td><?php if($row->order_zt=='1') echo "已发货"; else if($row->order_zt=='0') echo "未发货";?></td>
                    <td><?php if($row->pay_zt=='1') echo "已支付";else echo "未支付";?></td>
                    <td><a href="update_order.php?id=<?php echo $row->order_id;?>">退货</a>||<a href="goods_ok.php?id=<?php echo $row->order_id;?>">收货</a> </td>
                </tr>
                <?php
                }while($row=$res1->fetch(PDO::FETCH_OBJ));
                $res1=$row=$pdo=NUll;
                ?>
        </table>
    </div>
</div>
<div class="col-md-12 text-center">
    <p>商城信息</p>

</div>
</body>
</html>

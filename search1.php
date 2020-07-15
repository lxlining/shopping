<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <title>商品搜索</title>
    <link href="/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.js"></script>

</head>
<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
session_start();
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

    <?php
    if(isset($_POST["submit"])){
        $search=$_POST["search"];
    }
    ?>
    <div class="col-md-12">
        <form action="search1.php" method="post" name="form1" class="navbar-form text-center ">
            <div class="form-group">
                <input type="text" name="search" id="search" class="form-control" value="<?php echo $search;?>">
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
                <td>收件人</td>
                <td>支付状态</td>
                <td>支付状态</td>
                <td>总价</td>
                <td>订单时间</td>
            </tr>
        <?php
        $sql1="select * from tb_sc_order order1 join tb_sc_order_info info on order1.order_info_id=info.order_info_id join tb_sc_goods goods on goods.goods_id=info.goods_id join tb_sc_pic pic on goods.goods_id=pic.goods_id where pic.mr='3' and info.user_name='$user' and (order1.user_name like '%$search%' or goods.info like '%$search%' or goods.gname like '%$search%') order by order1.order_id desc, order1.create_time desc ";
        $res1=$pdo->query($sql1);
        $row1=$res1->fetch(PDO::FETCH_OBJ);
        do{
            ?>
            <div class="pull-left">
                <tr>
                    <td> <img src="admin/upfile2/<?php echo $row1->address;?>" width="120" height="120"></td>
                    <td><?php echo $row1->gname;?></td>
                    <td><?php echo $row1->user_name;?></td>
                    <td><?php if($row1->order_zt=='1') echo "已发货"; else if($row1->order_zt=='0') echo "未发货";?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><?php if($row1->pay_zt=='1') echo "已支付";else echo "未支付";?></td>
                    <td><?php echo ($row1->price)*($row1->num);?></td>
                    <td><?php echo $row1->create_time;?></td>
                </tr>
            </div>
            <?php
        }while($row1=$res1->fetch(PDO::FETCH_OBJ));
        ?>
        </table>
    </div>
</div>
</body>
</html>

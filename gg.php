<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <title>公告信息</title>
    <link href="/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.js"></script>

</head>
<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
session_start();
if($_SESSION["username"]==""){
    echo "<script>alert('未登录，请登录！');window.location.href='login.php';</script>";
}
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

    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover">
            <thead ><span class="text-info text-justify btn-lg">公告信息</span></thead>
            <tr>
                <td>公告主题</td>
                <td>公告内容</td>
                <td>发布时间</td>
                <td>发布人</td>
            </tr>
            <?php
            $sql1="select * from tb_sc_ggxx";
            $res1=$pdo->query($sql1);
            $row1=$res1->fetch(PDO::FETCH_OBJ);
            do{
                ?>
                <div class="pull-left">
                    <tr>
                        <td><?php echo $row1->main;?></td>
                        <td><?php echo $row1->content;?></td>
                        <td><?php echo $row1->ggtime;?></td>
                        <td><?php echo $row1->admin_name;?></td>
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

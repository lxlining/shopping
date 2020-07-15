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
if($_SESSION["username"]==""){
    echo "<script>alert('未登录，请登录！');window.location.href='login.php';</script>";
}
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
        <form action="search.php" method="post" name="form1" class="navbar-form text-center ">
            <div class="form-group">
                <input type="text" name="search" id="search" class="form-control" value="<?php echo $search;?>">
            </div>
            <input type="submit" name="submit" value="搜索" class="btn btn-default">
        </form>
    </div>
    <p>&nbsp;</p>
    <div class="col-md-12">
        <?php
        $sql1="select * from tb_sc_goods join tb_sc_pic on tb_sc_goods.goods_id=tb_sc_pic.goods_id join tb_sc_gys on tb_sc_gys.goods_id=tb_sc_pic.goods_id where tb_sc_pic.mr='3' and (tb_sc_goods.info like '%$search%' or tb_sc_goods.gname like '%$search%' or tb_sc_gys.gys like '%$search%') order by tb_sc_goods.goods_id desc";
        $res1=$pdo->query($sql1);
        $row1=$res1->fetch(PDO::FETCH_OBJ);
        do{
            ?>
            <div class="pull-left" style="margin: 20px">
                <tr><td> <a href="sp_info.php?id=<?php echo $row1->goods_id;?>"><img src="admin/upfile2/<?php echo $row1->address;?>" width="120" height="120"></a></td></tr><br/>
                <tr><td>商品名：<?php echo $row1->gname;?></td></tr>
                <br/>
                <tr><td class="sp-r">价格：<?php echo $row1->price;?></td></tr>
            </div>
            <?php
        }while($row1=$res1->fetch(PDO::FETCH_OBJ));
        ?>
    </div>
</div>
</body>
</html>

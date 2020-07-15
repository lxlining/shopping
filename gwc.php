<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <title>购物车</title>
    <link href="/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.js"></script>
    <style>
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
if($_SESSION["username"]==""){
    echo "<script>alert('未登录，请登录！');window.location.href='login.php';</script>";
}

$user=$_SESSION["username"];
?>
<script>

    function quan(ch) {
        var sda = ch.checked;
        var zhe = document.getElementsByName("gwc");
        for(var i in zhe){
            zhe[i].checked=sda;
        }

    }
</script>
<body>
<script>
    function selectall() {
        var select=document.getElementsByTagName(select)[];
    }
</script>
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
        <form action="search.php" method="post" name="form1" class="navbar-form text-center ">
            <div class="form-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="关键字">
            </div>
            <input type="submit" name="submit" value="搜索" class="btn btn-default">
        </form>
    </div>
    <div class="col-md-12">

            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td>图片</td>
                    <td>商品名</td>
                    <td>数量</td>
                    <td>小计</td>
                    <td>操作</td>
                    <td></td>
                </tr>
        <?php
        $sql1="select * from tb_sc_gwc gwc join tb_sc_goods goods on gwc.goods_id=goods.goods_id join tb_sc_pic pic on gwc.goods_id=pic.goods_id where gwc.user_name='$user' and pic.mr='3' and gwc.status='0'  order by gwc.gtime desc";
        $res1=$pdo->query($sql1);
        $row1=$res1->fetch(PDO::FETCH_OBJ);

        $allprice=0;
        $a=[];
        $b=[];
        do{
                $a[]=$row1->gwc_id;

                $b[]=$row1->g_price;
                $_SESSION["aa"]=$a;
            ?>
            <form method="post" name="form2" action="update_gwc.php" >
                <tr>
                    <td><img src="admin/upfile2/<?php echo $row1->address;?>" width="60" height="60"></td>
                    <td><?php echo $row1->gname;?></td>
                        <td><input type="number" name="num" value="<?php echo $row1->goods_num;?>" class="input"></td>

                    <td><?php echo $row1->g_price;?></td>

                    <td><input type="submit" name="submit0" value="更改数量" class="btn btn-success"> ||<a href="del_gwc.php?id=<?php echo $row1->gwc_id;?>" class="btn btn-success">删除</a></td>
                    <td><input type="hidden" name="gwc_id" value="<?php echo $row1->gwc_id;?>"><input type="hidden" name="price1" value="<?php echo $row1->price;?>"></td>
                </tr>
            </form>
        <?php
        }while($row1=$res1->fetch(PDO::FETCH_OBJ));

        for($j=0;$j<count($b);$j++){
            $allprice+=$b[$j];
        }
        $pdo=$row1=$res1=NULL;
        ?>
                <br/>
                <tr>
                    <td></td>
                    <td></td>
                    <td>总计：</td>
                    <td><?php error_reporting(0); echo $allprice;?></td>
                    <td><a href="pay.php?allprice=<?php error_reporting(0); echo $allprice;?>" class="btn btn-warning btn-lg">结算</a> </td>
                    <td></td>
                </tr>
            </table>

    </div>

</div>
</body>
</html>

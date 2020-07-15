<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <title>分类</title>
    <link href="/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.js"></script>
    <style>

        #sort{
            height: auto;
        }
        body{
            margin-top: 20px;
        }
    </style>
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
    <div class="col-md-12 ">

        <?php
        $sql5="select * from tb_sc_sort";
        $res5=$pdo->query($sql5);
        $row5=$res5->fetch(PDO::FETCH_OBJ);
        do{
            $a[]=$row5->name;
            ?>
            <?php
        }while($row5=$res5->fetch(PDO::FETCH_OBJ));
        ?>


        <div id="sort0 sort">

            <h4><?php echo $a[0];?>类商品：</h4>

            <?php
            $query1="select * from tb_sc_goods join tb_sc_pic on tb_sc_goods.goods_id=tb_sc_pic.goods_id join tb_sc_gys on tb_sc_gys.goods_id=tb_sc_pic.goods_id join tb_sc_sortinfo on tb_sc_pic.goods_id=tb_sc_sortinfo.goods_id where tb_sc_pic.mr='3' and tb_sc_sortinfo.sname='$a[0]' order by tb_sc_goods.goods_id desc ";
            $result1=$pdo->query($query1);
            $info1=$result1->fetch(PDO::FETCH_OBJ);
            if(!$info1){
                echo "当前分类无商品！！！";
                echo "<br/>敬请期待！";
            }
            do {
                ?>
<br/><br/>
                <div style="float: left" class="center-block">
                    <tr><td> <a href="sp_info.php?id=<?php echo $info1->goods_id;?>"><img src="admin/upfile2/<?php echo $info1->address;?>" width="120" height="120"></a></td></tr><br/>
                    <tr><td>商品名：<?php echo $info1->gname;?></td></tr>
                    <br/>
                    <tr><td class="sp-r">价格：<?php echo $info1->price;?></td></tr>
                </div>
                <?php
            }while($info1=$result1->fetch(PDO::FETCH_OBJ));

            ?>
        </div>


    </div>
    </div>
</div>
</body>
</html>

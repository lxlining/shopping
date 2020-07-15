<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <title>商品详情</title>
<!--    <link href="css/css2.css" rel="stylesheet" type="text/css">-->
    <link href="/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.js"></script>
    <style>
        /*.container{*/
        /*    margin: 0 auto;*/
        /*    width: 80%;*/
        /*}*/
        /*.banner{*/
        /*    width: 100%;*/
        /*    height: 300px;*/
        /*}*/
        /*.sort{*/
        /*    border: 1px solid grey;*/
        /*    background-color: green;*/
        /*    color: black;*/
        /*    font-weight: bold;*/
        /*}*/
    </style>
</head>
<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
session_start();
error_reporting(0);
if($_SESSION["username"]==""){
    echo "<script>alert('未登录，请登录！');window.location.href='login.php';</script>";
}
$id=$_GET["id"];
?>
<body>
<div class="container">
    <div class="col-md-12">
        <?php
        $sql0="select * from tb_sc_goods goods join tb_sc_pic pic on goods.goods_id=pic.goods_id where goods.goods_id='$id'";
        $res0=$pdo->query($sql0);

        $row0=$res0->fetch(PDO::FETCH_OBJ);
        $a=[];
        $b=[];
        do {
            $a[]=$row0->address;
            $b[]=$row0->goods_id;
            ?>

            <?php
        }while($row0=$res0->fetch(PDO::FETCH_OBJ));
        ?>
        <div id="myCarousel" class="carousel slide">
            <!-- 轮播（Carousel）指标 -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="4"></li>
            </ol>
            <!-- 轮播（Carousel）项目 -->
            <div class="carousel-inner">
                <div class="item active">

                        <img src="admin/upfile2/<?php echo $a[0];?>" alt="tuijian-banner" class="img img-responsive">

                </div>
                <div class="item">

                        <img src="admin/upfile2/<?php echo $a[1];?>" alt="tuijian-banner" class="img img-responsive">

                </div>
                <div class="item">

                        <img src="admin/upfile2/<?php echo $a[2];?>" alt="tuijian-banner"  class="img img-responsive">

                </div>
                <div class="item">

                        <img src="images/1.jpg" alt="tuijian-banner"  class="img img-responsive">

                </div>
                <div class="item">

                        <img src="images/2.jpg" alt="tuijian-banner"  class="img img-responsive" >

                </div>
            </div>
            <!-- 轮播（Carousel）导航 -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <p>&nbsp;</p>
    <div class="col-md-12">
        <tr><td >商品分类： </td></tr>
        <?php
        $sql2="select * from tb_sc_sortinfo where goods_id='$id' order by sortinfo_id";
        $res2=$pdo->query($sql2);
        $row2=$res2->fetch(PDO::FETCH_OBJ);
        do{
            ?>
            &nbsp;&nbsp;&nbsp;&nbsp;<td><button class="btn btn-info disabled btn-lg" ><?php echo $row2->sname;?></button></td>
            <?php
        }while($row2=$res2->fetch(PDO::FETCH_OBJ));
        ?>

        <?php

        $sql1="select * from tb_sc_goods join tb_sc_gys on tb_sc_gys.goods_id=tb_sc_goods.goods_id where tb_sc_goods.goods_id='$id'";
        $res1=$pdo->query($sql1);
        $row1=$res1->fetch(PDO::FETCH_OBJ);
        $price=$row1->price;
        do{
            ?>
            <br/><br/>
            <div class="sp">

                <tr><td>商品名：
                        <button class="btn btn-info disabled btn-lg" ><?php echo $row1->gname;?></button></td></tr>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <tr><td class="sp-r">价格：<button class="btn btn-warning disabled btn-lg" ><?php echo $row1->price;?></button></td></tr> &nbsp;&nbsp;&nbsp;&nbsp;
                <tr>
                    <td>库存：<button class="btn btn-warning disabled btn-lg" ><?php echo $row1->num;?></button></td>
                </tr><br/><br/>
                <tr>
                    <td>商品生产期：<?php echo $row1->gtime;?></td>
                </tr>&nbsp;&nbsp;&nbsp;&nbsp;
                <tr>
                    <td>供应商名称：<button class="btn btn-primary disabled btn-lg" ><?php echo $row1->gys;?></button></td>
                </tr><br/><br/>
                <tr>
                    <td>供应商电话：<?php echo $row1->tel;?></td>
                </tr>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <tr>
                    <td>供应商地址：<?php echo $row1->gy_address;?></td>
                </tr>

            </div>
            <?php
        }while($row1=$res1->fetch(PDO::FETCH_OBJ));
        ?>
    </div>
<p>&nbsp;</p>
    <div class="col-md-12">
        <form name="form1" method="post" action="buy_goods.php">
            <tr>
                <td>购买数量：<input type="number" name="gnum" id="gnum" value="1"></td>
                <br/>
                <td><input type="hidden" name="goods_id" value="<?php echo $id;?>"></td>
                <td><input type="hidden" name="goods_price" value="<?php echo $price;?>" class="form-control"></td>
            </tr><br/>

            <tr>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td><input type="submit" name="submit" value="购买" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit2" value="购物车" class="btn btn-success"></td></tr>
        </form>
    </div>
    <p>&nbsp;</p>
    <hr>
    <div class="col-md-12">
        <table class="table-hover table table-striped table-bordered">
            <tr>
                <td>评论用户</td>
                <td>评论等级</td>
                <td>评论时间</td>
                <td>评论内容</td>
            </tr>
        <?php
        $sql3="select * from tb_sc_comment where goods_id='$id'";
        $res3=$pdo->query($sql3);
        $row3=$res3->fetch(PDO::FETCH_OBJ);
        do{
            ?>

                <tr>
                    <td><?php echo $row3->user_name;?></td>
                    <td><?php echo $row3->class;?></td>
                    <td><?php echo $row3->ctime;?></td>
                    <td><?php echo $row3->content;?></td>
                </tr>
            </table>
        <?php
        }while($row3=$res3->fetch(PDO::FETCH_OBJ));
        $row3=$res3=$res2=$row2=$row1=$res1=$pdo=NULL;
        ?>
    </div>

</div>
</body>
</html>

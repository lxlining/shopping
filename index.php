<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>电子商城</title>
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <link href="/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.js"></script>
</head>
<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
session_start();
?>
<style>
    body{
        padding: 20px;
    }
</style>
<body>
<div class="container">
    <div class="col-md-12 navbar navbar-default navbar-static-top">
        <button class="navbar-toggle" data-toggle="collapse" data-target="#a">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <ul class="nav navbar-nav pull-right collapse navbar-collapse" id="a">
            <li class=""><a href="self.php">个人中心</a> </li>
            <li class=""><a href="gwc.php">购物车</a> </li>
            <li class=""><a href="order.php">订单系统</a> </li>
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
        <div class="navbar navbar-default navbar-static-top">
            <button class="navbar-toggle" data-toggle="collapse" data-target="#b">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="nav nav-pills pull-right navbar-collapse navbar-nav collapse" id="b">
                <li><a href="sort1.php"><?php echo $a[0];?></a> </li>
                <li><a href="sort2.php"><?php echo $a[1];?></a> </li>
                <li><a href="sort3.php"><?php echo $a[2];?></a> </li>
                <li><a href="sort4.php"><?php echo $a[3];?></a> </li>
                <li><a href="sort5.php"><?php echo $a[4];?></a> </li>
                <li><a href="sort6.php"><?php echo $a[5];?></a> </li>
            </ul>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-9">
            <?php
            $sql1="select * from tb_sc_tuijian tuijian join tb_sc_pic pic on tuijian.goods_id=pic.goods_id where tuijian.mr='1' and pic.mr='3' order by tuijian.ttime desc limit 5";
            $res1=$pdo->query($sql1);
            $row1=$res1->fetch(PDO::FETCH_OBJ);
            $a=[];
            $b=[];
            do {
                $a[]=$row1->address;
                $b[]=$row1->goods_id;
                ?>

                <?php
            }while($row1=$res1->fetch(PDO::FETCH_OBJ));
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
                        <a href="sp_info.php?id=<?php echo $b[0];?>">
                            <img src="admin/upfile2/<?php echo $a[0];?>" alt="tuijian-banner" class="img img-responsive">
                        </a>
                    </div>
                    <div class="item">
                        <a href="sp_info.php?id=<?php echo $b[1];?>">
                            <img src="admin/upfile2/<?php echo $a[1];?>" alt="tuijian-banner" class="img img-responsive">
                        </a>
                    </div>
                    <div class="item">
                        <a href="sp_info.php?id=<?php echo $b[2];?>">
                            <img src="admin/upfile2/<?php echo $a[2];?>" alt="tuijian-banner"  class="img img-responsive">
                        </a>
                    </div>
                    <div class="item">
                        <a href="sp_info.php?id=<?php echo $b[3];?>">
                            <img src="admin/upfile2/<?php echo $a[3];?>" alt="tuijian-banner"  class="img img-responsive">
                        </a>
                    </div>
                    <div class="item">
                        <a href="sp_info.php?id=<?php echo $b[4];?>">
                            <img src="admin/upfile2/<?php echo $a[4];?>" alt="tuijian-banner"  class="img img-responsive" >
                        </a>
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

        <div class="col-md-3">
            <tr>
                <td align="center" bgcolor="#FFFFFF">
                    <?php
                    if(isset($_SESSION["username"])){
                        $user=$_SESSION["username"];
                        if($_SESSION["username"]!=""){
                            $sql3="select * from tb_sc_photo where mr='1' and user_name='$user'";
                            $res3=$pdo->query($sql3);
                            $row3=$res3->fetch(PDO::FETCH_OBJ);
                            if($row3){
                                echo "当前用户:$_SESSION[username]";
                                ?>
                                <img src="upfile1/<?php echo $row3->address;?>" width="60" height="60" style="border-radius: 40px">
                                <?php
                            }
                        }}else{
                    ?>
                <td><a href="login.php">请登录账户</a></td>
                <?php
                }
                ?>
                </td>
            </tr>
            <br/>
            <tr>
                <td bgcolor="#FFFFFF">
                    <?php
                    if(isset($_SESSION["username"])){
                        if($_SESSION["username"]!=""){
                            echo "<a href='login_out.php'>注销离开</a>";
                        }}
                    ?>
                </td>
            </tr>
            <hr>

            <div>
                <?php
                $sql4="select * from tb_sc_ggxx order by ggtime desc limit 1";
                $res4=$pdo->query($sql4);
                $row4=$res4->fetch(PDO::FETCH_OBJ);
                ?>
                <h5>公告信息</h5>
                <table>
                    <tr><td>公告标题：<?php echo $row4->main;?></td></tr>
                    <tr><td>广告内容：<?php echo $row4->content;?></td></tr>

                    <tr><td><a href="gg.php">更多...</a> </td></tr>
                </table>
            </div>
        </div>
    </div>

    <hr><br/><br/>

    <div class="col-md-12">
        <?php
        $sql2="select * from tb_sc_goods join tb_sc_pic on tb_sc_goods.goods_id=tb_sc_pic.goods_id join tb_sc_gys on tb_sc_gys.goods_id=tb_sc_pic.goods_id where tb_sc_pic.mr='3' order by tb_sc_goods.goods_id desc";
        $res2=$pdo->query($sql2);
        $row2=$res2->fetch(PDO::FETCH_OBJ);
        do {
            ?>
            <div class="pull-left" style="margin: 20px;float: left;">
                <tr><td> <a href="sp_info.php?id=<?php echo $row2->goods_id;?>"><img src="admin/upfile2/<?php echo $row2->address;?>" width="120" height="120" class="img img-rounded"></a></td></tr><br/><p>&nbsp;</p>
                <tr><td>商品名：<a class="btn btn-success" href="sp_info.php?id=<?php echo $row2->goods_id;?>"> <?php echo $row2->gname;?></a></td></tr>
                <br/>
                <tr><br/><td class="sp-r">价格：<span class="btn btn-warning disabled"> <?php echo $row2->price;?></span></td></tr>
            </div>
            <?php
        }while($row2=$res2->fetch(PDO::FETCH_OBJ));
        ?>
    </div>
</div>

<div class="container text-center">
    <div class="col-md-4"></div>
    <div class="col-md-8">
        <div id="link" >
            <ul class="nav nav-pills" >
                <?php
                $query="select * from tb_sc_link limit 6";
                $result=$pdo->query($query);
                $info=$result->fetch(PDO::FETCH_OBJ);
                do{
                    ?>
                    <li class="text-justify"><a href="http://<?php echo $info->link_address;?>"><?php echo $info->link_name;?></a> </li>
                    <?php
                }while($info=$result->fetch(PDO::FETCH_OBJ));
                $pdo=NULL;
                ?>
            </ul>
        </div>
    </div>
    <div class="text-center col-md-12">
        <p>重庆师范大学计算机与信息科学学院；李小林课设制作。</p>
        <p>联系方式QQ：1752116947；邮箱：1752116947@qq.com</p>
    </div>
</div>
 </body>
</html>

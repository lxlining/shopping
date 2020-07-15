<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商城后台管理</title>
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <link href="/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.js"></script>
    <style>
        body{
            margin: 10px auto;

        }
        .container{
            width: 100%;
            margin: auto;
        }
        .nav{
            width: 100%;
            height: 40px;

            text-align: right;
            padding-top: 12px;
            margin-right: 40px;
        }
        .left{
            width: 15%;
            height: auto;
            padding-left: 40px;
            float: left;
            /*background-color: grey;*/
        }
        .right{
            width: 83%;
            background-color: #fff;
        }
        ul>li{
            list-style: none;
        }
        a{
            text-decoration: none;
        }
    </style>
    <script src="../bootstrap-3.3.7/js/bootstrap.js"></script>
</head>
<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
session_start();
?>
<body>
<div class="container">
    <div class="container col-md-12">
        <div class="nav">
            <td align="center" bgcolor="#FFFFFF">
                <?php
                if(isset($_SESSION["admin"])){
                $admin=$_SESSION["admin"];
                if($_SESSION["admin"]!=""){

                echo "管理员:$_SESSION[admin]";
                ?>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><a href="login_out.php">注销</a></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <?php
            }}else{
                ?>
                <td><a href="login.php">登录</a></td>
                <?php
            }
            ?>
            </td>
        </div>
        <br/>
        <div class=" col-md-2">
            <h5 ><button class="btn-lg btn btn-success">用户管理</button> </h5>

            <h5><button class="btn-lg btn btn-default">商品管理</button></h5>
            <ul>
                <li><a href="add_goods.php">商品上架</a> </li>
                <li><a href="del_goods.php">商品下架</a> </li>
                <li><a href="mod_goods.php">商品修改</a> </li>
            </ul>
            <h5><button class="btn-lg btn btn-default">公告管理</button></h5>
            <ul>
                <li><a href="ggxx.php">发布公告</a> </li>
                <li><a href="del_ggxx.php">删除公告</a> </li>
            </ul>
            <h5><button class="btn-lg btn btn-default">推荐管理</button></h5>
            <ul>
                <li><a href="tuijian.php">添加推荐</a> </li>
                <li><a href="mod_tuijian.php">更改推荐</a> </li>
                <li><a href="tuijian_link.php">网站推荐</a> </li>
            </ul>


            <h5><button class="btn-lg btn btn-default">举报管理</button></h5>
            <ul>
                <li><a href="jubao.php">查看举报</a> </li>
            </ul>
        </div>
        <br/>
        <div class=" pull-right col-md-10">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td>用户名</td>
                    <td>性别</td>
                    <td>邮箱</td>
                    <td>手机号</td>
                    <td>操作</td>
                </tr>
                <?php
                $sql="select * from tb_sc_user order by user_id desc";
                $res=$pdo->query($sql);
                $row=$res->fetch(PDO::FETCH_OBJ);
                do{
                    ?>
                    <tr>
                        <td><?php echo $row->user_name;?></td>
                        <td><?php echo $row->sex;?></td>
                        <td><?php echo $row->email;?></td>
                        <td><?php echo $row->phone;?></td>
                        <td> <a href="del_user.php?id=<?php echo $row->user_id;?>">删除</a> </td>
                    </tr>
                    <?php
                }while($row=$res->fetch(PDO::FETCH_OBJ));
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>

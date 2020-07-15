<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>找回密码</title>
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
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
?>
<body>
<div class="container">
    <div class="col-md-12">
        <form name="form1" method="post" action="">
            <table>
                <br/>
                <tr>
                    <td>请输入用户名：</td>
                    <td><input type="text" name="user" class="input"></td>
                </tr>

                <tr>

                    <td>输入绑定邮箱：</td>
                    <td><input type="email" name="email" class="input"></td>
                </tr>

                <tr>
                    <td>输入新密码：</td>
                    <td><input type="text" name="pwd" class="input"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="找回">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="重置"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if(isset($_POST["submit"])){
    $user=$_POST["user"];
    $email=$_POST["email"];
    $newpwd=$_POST["pwd"];

    $sql1="select * from tb_sc_user where user_name='$user' and email='$email'";
    $res=$pdo->query($sql1);
    $info=$res->fetch(PDO::FETCH_OBJ);
    if($info){
        $sql2="update tb_sc_user set pwd='$newpwd' where user_name='$user'";
        $res2=$pdo->prepare($sql2);
        $res2->execute();
        if($res2){
            echo "<script>alert('密码重置成功');window.location.href='login.php';</script>";
        }else{
            echo "<script>history.back();</script>";
        }
    }
}
?>
</body>
</html>

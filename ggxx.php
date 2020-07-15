<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>公告信息</title>
</head>
<?php
header("Content-type:text/html;charset=utf-8");
session_start();
include("conn/conn.php");
if($_SESSION["admin"]==""){
    echo "<script>alert('请登录！');history.back();</script>";
}
?>
<body>
<div class="gg">
    <form name="form1" method="post" action="">
        <table border="0" cellpadding="2" cellspacing="0">
            <tr>
                <td>公告主题：</td>
                <td><input type="text" name="main" id="main" maxlength="30"></td>
            </tr>
            <tr>
                <td>内容：</td>
                <td><textarea cols="60" rows="3" name="content"></textarea> </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" name="submit" value="发布">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="reset" name="submit2" value="重置">
                </td>
            </tr>
        </table>
    </form>
</div>
<?php

if(isset($_POST["submit"])){
    $main=$_POST["main"];
    $content=$_POST["content"];
    $g_time=date("Y-m-d H:i:s");
    $name=$_SESSION["admin"];

    $sql="insert into tb_sc_ggxx(admin_name,content,main,ggtime) values ('$name','$content','$main','$g_time')";
    $result=$pdo->prepare($sql);
    $result->execute();
    if($result){
        echo "<script>alert('公告添加成功！');window.location.href='index.php';</script>";
    }else{
        echo "<script>history.back();</script>";
    }
}
$pdo=$result=NULL;
?>
</body>
</html>

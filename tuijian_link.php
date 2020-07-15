<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>连接推荐</title>
</head>
<?php
header("Content-type:text/html; charset=utf-8");
include("conn/conn.php");
session_start();
$admin=$_SESSION["admin"];
if($_SESSION["admin"]==""){
    echo "<script>alert('请登录！');history.back();</script>";
}
?>
<body>
<div>
    <table>
        <form method="post" name="form1" action="">
            <tr>
                <td>网站名称：</td>
                <td>
                    <input type="text" name="linkname" id="linkname" >
                </td>
            </tr>
            <tr>
                <td>网站地址：</td>
                <td>
                    <input type="text" name="linkaddr" id="linkaddr" >
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="推荐"><input type="reset" name="reset" value="重置"></td>
            </tr>
        </form>
    </table>
</div>
<?php
if (isset($_POST["submit"])){
    $na=$_POST["linkname"];
    $linkaddr=$_POST["linkaddr"];
    $sql="insert into tb_sc_link (link_name,link_address,admin_name) values ('$na','$linkaddr','$admin')";
    $res1=$pdo->prepare($sql);
    $info=$res1->execute();
    if($info){
        echo "<script>alert('推荐成功！');window.location.href='index.php';</script>";
    }else{
        echo "<script>history.back();</script>";
    }
    $pdo=$res1=$info=NULL;
}
?>
</body>
</html>

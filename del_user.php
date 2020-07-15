<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
session_start();
if($_SESSION["admin"]==""){
    echo "<script>alert('请登录！');history.back();</script>";
}
$uid=$_GET["id"];
$sql="delete from tb_sc_user where user_id='$uid'";
$res=$pdo->prepare($sql);
$res->execute();
if($res){
    echo "<script>alert('删除成功！');window.location.href='index.php';</script>";
}else{
    echo "<script>history.back();</script>";
}
$pdo=$res=NULL;
?>
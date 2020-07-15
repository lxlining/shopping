<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
session_start();
$adminname=$_SESSION["admin"];
$id=$_GET["id"];

$sql="update tb_sc_tuijian set mr='0' where goods_id='$id'";
$result=$pdo->prepare($sql);
$result->execute();
if($result){
    echo "<script>alert('取消推荐成功！');window.location.href='mod_tuijian.php';</script>";
}else{
    echo "<script>history.back();</script>";
}
$pdo=$result=NULL;
?>
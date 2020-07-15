<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
session_start();
$id=$_GET["id"];

$sql="delete from tb_sc_goods where goods_id='$id'";
$result=$pdo->prepare($sql);
$result->execute();

$sql1="delete from tb_sc_pic where goods_id='$id'";
$result1=$pdo->prepare($sql1);
$result1->execute();

$sql2="delete from tb_sc_gys where goods_id='$id'";
$result2=$pdo->prepare($sql2);
$result2->execute();

$sql3="delete from tb_sc_tuijian where goods_id='$id'";
$result3=$pdo->prepare($sql3);
$result3->execute();

if($result&&$result1&&$result2){
    echo "<script>alert('下架成功！');window.location.href='del_goods.php';</script>";
}else{
    echo "<script>history.back();</script>";
}
$pdo=$result=$result1=$result2=$result3=NULL;
?>
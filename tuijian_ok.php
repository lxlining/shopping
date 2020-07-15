<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
session_start();
$adminname=$_SESSION["admin"];
$id=$_GET["id"];
$ttime=date("Y-m-d H:i:s");
$sql="insert into tb_sc_tuijian(admin_name,goods_id,ttime,mr) values ('$adminname','$id','$ttime',1)";
$result=$pdo->prepare($sql);
$result->execute();
if($result){
    echo "<script>alert('推荐成功！');window.location.href='tuijian.php';</script>";
}else{
    echo "<script>history.back();</script>";
}
$pdo=$result=NULL;
?>
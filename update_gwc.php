<?php
header("Content-type:text/html;charset=utf-8");
session_start();
include("conn/conn.php");

$id=$_POST["gwc_id"];
$num=$_POST["num"];
$price=$_POST["price1"];
$account=$num*$price;
$time=date("Y-m-d H:i:s");
$sql="update tb_sc_gwc set goods_num='$num' , g_price='$account' , uptime='$time' where gwc_id= $id";
$res=$pdo->prepare($sql);
$res->execute();
if($res){

    echo "<script>window.location.href='gwc.php'</script>";
}else{
    echo "<script>history.back();</script>";
}
$pdo=$res=NULL;
?>
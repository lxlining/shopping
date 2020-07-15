<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
session_start();
$user=$_SESSION["username"];
$id=$_GET["id"];
$time=date("Y-m-d H:i:s");
$sql="update tb_sc_order set order_zt='3',re_time='$time' where order_id=$id";
$res=$pdo->prepare($sql);
$res->execute();
$_SESSION["oid"]=$id;
if($res){
    echo "<script>alert('收货成功！');window.location.href='commend.php'</script>";
} else {
    echo "<script>history.back();</script>";

}

?>

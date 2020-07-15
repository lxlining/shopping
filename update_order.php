<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
session_start();
$user=$_SESSION["username"];
$id=$_GET["id"];
$time=date("Y-m-d H:i:s");
$sql="update tb_sc_order set order_zt='2',up_time='$time' where order_id=$id";
$res=$pdo->prepare($sql);
$res->execute();

$sql1="insert into tb_sc_tuihuo(ttime,order_id) values ('$time','$id')";
$res1=$pdo->prepare($sql1);
$res1->execute();
if($res&&$res1){
    echo "<script>alert('退货成功！');window.location.href='tuihuo.php'</script>";
} else {
    echo "<script>history.back();</script>";

}

?>

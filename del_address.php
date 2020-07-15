<?php
header("Content-type:text/html;charset=utf-8");
session_start();
include("conn/conn.php");

$id=$_GET["id"];
$sql="delete from tb_sc_address where address_id='$id'";
$res=$pdo->prepare($sql);
$res->execute();
if($res){
    echo "<script>alert('删除成功!');window.location.href='add_address.php'</script>";
}else{
    echo "<script>history.back();</script>";
}
$pdo=$res=NULL;
?>
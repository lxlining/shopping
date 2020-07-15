<?php
header("Content-type:text/html;charset=utf-8");
session_start();
include("conn/conn.php");

$id=$_GET["id"];
$user_id=$_SESSION["id"];
$query="select * from tb_sc_address where mr='1' and user_id='$user_id'";
$row=$pdo->prepare($query);
$row->execute();
if($row){
    $sql2="update tb_sc_address set mr='2' where user_id='$user_id'";
    $res2=$pdo->prepare($sql2);
    $res2->execute();
    if($res2){
        $sql3="update tb_sc_address set mr='1' where address_id='$id'";
        $res3=$pdo->prepare($sql3);
        $res3->execute();
        if($res3) {
            echo "<script>alert('修改成功!');window.location.href='add_address.php'</script>";
        }
        else{
            echo "<script>alert('修改失败!');history.back();</script>";
            }

    }
    }
$pdo=$res3=$res2=NULL;
?>
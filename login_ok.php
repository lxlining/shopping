<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
session_start();
if(isset($_POST["submit"])){
    $adminname=$_POST["admin"];
    $pwd=$_POST["pwd"];
    $_SESSION["admin"]=$adminname;

    $sql = "select * from tb_sc_admin where name='$adminname'and pwd='$pwd'";

    $result = $pdo->prepare($sql);
    $result->execute();
    $info = $result->fetch(PDO::FETCH_OBJ);

    $A_id=$info->admin_id;
    $_SESSION["adminid"]=$A_id;

    if($info){
        echo "<script> window.location.href='sys.php';</script>";
        exit;
    } else {
        echo "<script language='javascript'>alert('密码输入错误！');history.back();</script>";
        exit;
    }

}
$pdo=$info=NULL;
?>
<?php
header("Content-type:text/html;charset=utf-8");
session_start();
include("conn/conn.php");
$user=$_SESSION["username"];

$query1="select * from tb_sc_address address join tb_sc_user user1 on address.user_id=user1.user_id where user1.user_name='$user' and address.mr='1'";
$result1=$pdo->query($query1);
$row=$result1->fetch(PDO::FETCH_OBJ);
$address=$row->address;

if(isset($_POST["submit"])){
    $num=$_POST["gnum"];
    $price=$_POST["goods_price"];
    $time=date("Y-m-d H:i:s");
    $goods_id=$_POST["goods_id"];
    $acount=$num*$price;
    $sql1="insert into tb_sc_order_info(goods_id,user_name,num,price,ctime,addr) values ('$goods_id','$user','$num','$acount','$time','$address')";
    $res1=$pdo->prepare($sql1);
    $res1->execute();

    $query1="select * from tb_sc_order_info where ctime='$time'";
    $result1=$pdo->query($query1);
    $info=$result1->fetch(PDO::FETCH_OBJ);
    $infoid=$info->order_info_id;
    $_SESSION["infoid"]=$infoid;
    if($res1&&$info){
        echo "<script>window.location.href='payother.php';</script>";
    }else{
        echo "<script>history.back();</script>";
    }
}

if(isset($_POST["submit2"])){

    $num=$_POST["gnum"];
    $price=$_POST["goods_price"];
    $goods_id=$_POST["goods_id"];
    $user=$_SESSION["username"];
    $gtime=date("Y-m-d H:i:s");
    $acount2=$num*$price;
    $sql2="insert into tb_sc_gwc(goods_id,goods_num,user_name,gtime,g_price) values ('$goods_id','$num','$user','$gtime','$acount2')";
    $res2=$pdo->prepare($sql2);
    $res2->execute();


    if($res2){
        echo "<script>window.location.href='gwc.php'</script>";
    }else{
        echo "<script>history.back();</script>";
    }
}

?>

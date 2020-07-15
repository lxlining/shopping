<?php
header("Content-type:text/html;charset=utf-8");
session_start();
include("conn/conn.php");

$user_id=$_SESSION["id"];
if(isset($_POST["submit"])){

    $name=$_POST["user"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];
    $mr=$_POST["mr"];
    $time=date("Y-m-d H:i:s");

    $query="select * from tb_sc_address where mr='1' and user_id='$user_id'";
    $row=$pdo->prepare($query);
    $row->execute();
    if($row){
        $sql2="update tb_sc_address set mr='2' where user_id='$user_id'";
        $res2=$pdo->prepare($sql2);
        $res2->execute();
        if($res2){
            $sql="insert into tb_sc_address (add_name,phone,address,user_id,mr,create_time) values ('$name','$phone','$address','$user_id','$mr','$time')";
            $res=$pdo->prepare($sql);
            $res->execute();
            if($res){
                echo "<script>alert('添加成功!');window.location.href='gwc.php'</script>";
            }else{
                echo "<script>history.back();</script>";
            }
        }

    }

    $pdo=$res=$res2=NULL;
}
?>
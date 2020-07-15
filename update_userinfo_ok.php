<?php
header("Content-type:text/html;charset=utf-8");
session_start();
include("conn/conn.php");
$id=$_SESSION["id"];

if(isset($_POST["submit"])){
    $user=$_POST["username"];
    $password = $_POST["pwd"];
    $email = $_POST["email"];
    $sex = $_POST["sex"];
    $phone=$_POST["phone"];
    $address=$_FILES["touxiang"]["name"];

    $sql1="select * from tb_sc_user where user_name='$user'";
    $res1=$pdo->prepare($sql1);
    $res1->execute();
    if($res1){
        $query="update tb_sc_user set pwd='$password',email='$email',sex='$sex',phone='$phone',photo_address='$address' where user_id=$id";
        $res2=$pdo->prepare($query);
        $res2->execute();
        echo "<script>alert('该昵称已经被注册,其他信息已经改变！');history.back();</script>";
    }else{
        $query="update tb_sc_user set user_name='$user',pwd='$password',email='$email',sex='$sex',phone='$phone',photo_address='$address' where user_id=$id";
        $res2=$pdo->prepare($query);
        $res2->execute();
        if($res2){
            echo "<script>alert('修改成功！');window.location.href='self.php';</script>";
        }
        else{
            echo "<script>alert('修改失败！');history.back();</script>";
        }
    }

}
?>
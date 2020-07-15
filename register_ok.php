<?php
header("Content-type:text/html;charset=utf-8");
session_start();
include("conn/conn.php");

if(!is_dir("./upfile1")){
    mkdir("./upfile1");
}
$path="upfile1/".$_FILES["touxiang"]["name"];
move_uploaded_file($_FILES["touxiang"]["tmp_name"],$path);

$username = $_POST["username"];
$password = $_POST["pwd"];
$email = $_POST["email"];
$sex = $_POST["sex"];
$phone=$_POST["phone"];
$address=$_FILES["touxiang"]["name"];


$sql = "select * from tb_sc_user where user_name = '$username'";
$result = $pdo->query($sql);
$info=$result->fetch(PDO::FETCH_OBJ);
if($info){
    echo "<script>alert('该昵称已经存在!');history.back();</script>";
    exit;
} else {
    $sql1 = "insert into tb_sc_user(user_name,pwd,email,sex,phone,photo_address) values ('$username','$password','$email','$sex','$phone','$address')";

    $result1 = $pdo->prepare($sql1);
    $result1->execute();

    $sql2="insert into tb_sc_photo(user_name,address) values('$username','$address')";
    $result2 =$pdo->prepare($sql2);
    $result2->execute();
    if($result1&&$result2)
        echo "<script>window.location.href='login.php';</script>";
}
$pdo=$info=$result2=$result1=NULL;
?>
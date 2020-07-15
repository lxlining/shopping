<?php
header("Content-type:text/html; charset=utf8");
include("conn/conn.php");
session_start();
if(!is_dir("./upfile2")){
    mkdir("./upfile2");
}

$path="upfile2/".$_FILES["images1"]["name"];
move_uploaded_file($_FILES["images1"]["tmp_name"],$path);
$file1=$_FILES["images1"]["name"];

$path2="upfile2/".$_FILES["images2"]["name"];
move_uploaded_file($_FILES["images2"]["tmp_name"],$path2);
$file2=$_FILES["images2"]["name"];

$path3="upfile2/".$_FILES["images3"]["name"];
move_uploaded_file($_FILES["images3"]["tmp_name"],$path3);
$file3=$_FILES["images3"]["name"];

if(isset($_POST["submit"])){

    $goods=$_POST["goods"];
    $ginfo=$_POST["info"];
    $gys=$_POST["gys"];
    $address=$_POST["addr"];
    $time1=$_POST["sctime"];
    $num=$_POST["num"];
    $tel=$_POST["tel"];

    $price=$_POST["price"];
    $time2=date("Y-m-d H:i:s");
    $admin=$_SESSION["admin"];

    $sql1="insert into tb_sc_goods(gname,info,price,gtime,admin) values ('$goods','$ginfo','$price','$time1','$admin')";
    $result1 = $pdo->prepare($sql1);
    $result1->execute();

    $query="select * from tb_sc_goods where gname='$goods' and info='$ginfo'";
    $results = $pdo->query($query);
    $row = $results->fetch(PDO::FETCH_OBJ);
    $goods_id=$row->goods_id;


    $sql2="insert into tb_sc_pic(address,goods_id,mr) values ('$file1','$goods_id','3')";
    $result2=$pdo->prepare($sql2);
    $result2->execute();

    $sql3="insert into tb_sc_pic(address,goods_id) values ('$file2','$goods_id')";
    $result3=$pdo->prepare($sql3);
    $result3->execute();

    $sql4="insert into tb_sc_pic(address,goods_id) values ('$file3','$goods_id')";
    $result4=$pdo->prepare($sql4);
    $result4->execute();

    $sql5="insert into tb_sc_gys(gys,gy_address,num,gytime,tel,goods_id) values ('$gys','$address','$num','$time2','$tel','$goods_id')";
    $result5=$pdo->prepare($sql5);
    $result5->execute();

    $sort=$_POST["sort"];
    $length=count($sort);
    $min=key($sort);

    for($i=$min;$i<$length;$i++){
        $query="insert into tb_sc_sortinfo(goods_id,sname) values ('$goods_id','$sort[$i]')";
        $res=$pdo->prepare($query);
        $res->execute();
    }


    if($result1&&$result2&&$result3&&$result4&&$result5){
        echo "<script>window.location.href='index.php';</script>";
    }else{
        echo "<script>history.back();</script>";
    }

}
$pdo=$row=$result1=$result2=$result3=$result4=$result5=NULL;
?>
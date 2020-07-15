<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品上架</title>
</head>
<?php
header("Content-type:text/html; charset=utf8");
include("conn/conn.php");
session_start();
error_reporting(0);
if($_SESSION["admin"]==""){
    echo "<script>alert('请登录！');history.back();</script>";
}
?>
<body>
<form name="form1" method="post" action="" enctype="multipart/form-data" target="_blank">
    <table border="1" cellspacing="0" cellpadding="0" align="center" width="600" height="400" >
        <tr>
            <td>商品名称：<input name="goods" id="goods" type="text"></td>
        </tr>
        <tr>
            <td>商品详情：&nbsp;&nbsp;<textarea name="info" id="info" type="text" cols="80" rows="3"></textarea></td>
        </tr>
        <tr>
            <td>浏览图片：<input name="images1" id="images1" type="file"><t style="color: red">*  大小建议：1100x410</t></td>
        </tr>
        <tr>
            <td>浏览图片：<input name="images2" id="images2" type="file"><t style="color: red">*  ------</t></td>
        </tr>
        <tr>
            <td>浏览图片：<input name="images3" id="images3" type="file"><t style="color: red">*  图片名称、路径不含中文字符</t></td>

        </tr>
        <tr>
            <td>商品分类：
                <select name="sort[]" id="sort" size=6 multiple>
                    <option value="电脑">电脑</option>
                    <option value="手机">手机</option>
                    <option value="配件">配件</option>
                    <option value="软件">软件</option>
                    <option value="专业">专业</option>
                    <option value="智能家居">智能家居</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>商品价格：<input name="price" id="price" type="number"></td>
        </tr>
        <tr>
            <td>商品数量：<input name="num" id="num" type="number"></td>
        </tr>
        <tr>
            <td>商品生产期：<input name="sctime" id="sctime" type="date"></td>
        </tr>
        <tr>
            <td>供应商名称：<input name="gys" id="gys" type="text"></td>
        </tr>
        <tr>
            <td>供应商电话：<input name="tel" id="tel" type="tel"></td>
        </tr>
        <tr>
            <td>供应商地址：<input name="addr" id="addr" type="text"></td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="submit" value="添加">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="reset" name="submit2" value="重置">
            </td>
        </tr>
    </table>
</form>
<?php
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
</body>
</html>

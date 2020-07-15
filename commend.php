<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>评论与举报</title>
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <link href="/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <style>
        body{
            margin: 20px;
        }
    </style>
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.js"></script>

</head>
<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
session_start();
?>
<body>
<div class="container">
    <div class="col-md-12">
        <form name="form1" method="post" action="">
            <table>
                <tr>
                    <td>评论等级：</td>
                    <td><input type="text" name="class" placeholder="好评、中评、差评||举报类型" required><br/></td><br/>
                </tr>
                <br/>
                <tr>
                    <td>内容：</td>
                    <td><br/><textarea name="content" rows="3" cols="40"></textarea></td>
                </tr>
                <tr>
                    <?php
                    $query="select * from tb_sc_admin order by admin_id desc limit 1";
                    $res1=$pdo->query($query);
                    $row1=$res1->fetch(PDO::FETCH_OBJ);
                    $ad_name=$row1->name;
                    ?>
                    <td><input type="hidden" name="admin" value="<?php echo $ad_name;?>" ></td>
                    <td><input type="submit" name="submit" value="评论" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit2" value="举报" class="btn btn-success"></td>

                </tr>
            </table>
        </form>
    </div>
</div>
<?php
$user=$_SESSION["username"];
$id=$_SESSION["oid"];
$sql1="select * from (((tb_sc_order order1 join tb_sc_order_info info on order1.order_info_id=info.order_info_id) join tb_sc_goods goods on goods.goods_id=info.goods_id) join tb_sc_pic pic on goods.goods_id=pic.goods_id) where order1.order_id='$id' and pic.mr='3' and order1.order_zt='3'";
$res=$pdo->query("$sql1");
$row=$res->fetch(PDO::FETCH_OBJ);
$goods=$row->goods_id;
$time=date("Y-m-d H:i:s");
if(isset($_POST["submit"])){
    $class=$_POST["class"];
    $content=$_POST["content"];

    $sql2="insert into tb_sc_comment (user_name,goods_id,class,content,ctime) values ('$user','$goods','$class','$content','$time')";
    $res2=$pdo->prepare($sql2);
    $res2->execute();
    if($res2){
        echo "<script>alert('评论成功！');window.location.href='order.php'</script>";
    } else {
        echo "<script>history.back();</script>";

    }
    $res=$res2=$pdo=NULL;
    unset($_SESSION["oid"]);
}
if(isset($_POST["submit2"])){
    $jclass=$_POST["class"];
    $jcontent=$_POST["content"];
    $sql3="insert into tb_sc_jubao (jb_class,jb_content,jb_time,goods_id,admin,jb_user_name) values ('$jclass','$jcontent','$time','$goods','$ad_name','$user')";
    $res3=$pdo->prepare($sql3);
    $res3->execute();
    if($res3){
        echo "<script>alert('举报成功！');window.location.href='order.php'</script>";
    } else {
        echo "<script>history.back();</script>";

    }
    $res3=$pdo=NULL;
    unset($_SESSION["oid"]);
}
?>
</body>
</html>

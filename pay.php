<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <title>支付</title>
    <link href="/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.js"></script>
    <style>
        /*body{*/
        /*    margin: 0 auto;*/
        /*    width: 1100px;*/
        /*    align-content: center;*/

        /*}*/
    </style>
</head>
<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");

session_start();
$user=$_SESSION["username"];
$uu_id=$_SESSION["id"];
$allprice=$_GET["allprice"];

?>

<body>
<div class="container">
    <div class="col-md-12">
        <form method="post" name="form1" action="" class="form-group">
            <table class="table table-striped table-bordered">
                <tr>
                    <td>支付方式</td>
                    <td></td>
                </tr>
                <tr>
                    <td>价格</td>
                    <td><?php echo $allprice;?></td>
                </tr>
                <tr>
                    <td>微信支付</td>
                    <td>支付宝</td>
                </tr>
                <tr>
                    <td><img src="images/wx.png" alt="微信" class="img img-responsive" width="300" height="300"> </td>
                    <td><img src="images/zfb.jpg" alt="支付宝" class="img img-responsive" width="300" height="300"> </td>
                </tr>
                <br/>
                <tr>
                    <td><input type="checkbox" name="addr" value="mr" checked>默认收货地址</td>
                    <td><input type="text" name="address" class="input-group"></td>
                </tr>
                <br/>
                <tr>
                    <td><input type="submit" name="submit" value="支付"></td>
                    <td><input type="reset" name="reset" value="取消"></td>
                </tr>
            </table>
        </form>
    </div>

</div>
<?php
$user=$_SESSION["username"];
if(isset($_POST["submit"])) {
    $query1 = "select * from tb_sc_address address join tb_sc_user user1 on address.user_id=user1.user_id where address.user_id='$uu_id' and address.mr='1'";
    $result1 = $pdo->query($query1);
    $row = $result1->fetch(PDO::FETCH_OBJ);
    $address1 = $row->address;


    if ($_POST["addr"]=="mr" && $address1 == "") {
        echo "<script>alert('未设置默认地址，即将跳转到地址设置！');window.location.href='add_address.php'</script>";
    }
    else if($_POST["addr"]=="" && $_POST["address"]!=""){
        $address=$_POST["address"];
    }else if($_POST["addr"]=="" && $_POST["address"]==""){
        echo "<script>history.back();</script>";
    }else{
        $address=$_POST["addr"];
    }

    $time = date("Y-m-d H:i:s");
    for ($i = 0; $i < count($_SESSION["aa"]); $i++) {
        $id1 = $_SESSION["aa"][$i];
        $sql1 = "select * from tb_sc_gwc where gwc_id='$id1'";
        $res1 = $pdo->query($sql1);
        $row1 = $res1->fetch(PDO::FETCH_OBJ);
        $gg_id=$row1->goods_id;

        $sql2 = "insert into tb_sc_order_info (goods_id,user_name,num,price,ctime,addr) values ('$row1->goods_id','$user','$row1->goods_num','$row1->g_price','$time','$address')";
        $res2 = $pdo->prepare($sql2);
        $info2 = $res2->execute();

        $sql3 = "select * from tb_sc_order_info where goods_id='$gg_id' and user_name='$user' order by order_info_id desc limit 1";
        $res3 = $pdo->query($sql3);
        $row3 = $res3->fetch(PDO::FETCH_OBJ);
        $o_id=$row3->order_info_id;



        $query2="insert into tb_sc_order (order_info_id,create_time,user_name) values ('$o_id','$time','$user') ";
        $result2=$pdo->prepare($query2);
        $row2=$result2->execute();


    }

    if ($info2&&$result2) {
        echo "<script>alert('购买成功！');</script>";
        $sql4 = "update tb_sc_gwc set status='1' where user_name='$user'";
        $res4 = $pdo->prepare($sql4);
        $info4 = $res4->execute();

    }
    if ($info4) {
        echo "<script>window.location.href='order.php'</script>";
    } else {
        echo "<script>history.back();</script>";
  }
}
?>
</body>
</html>

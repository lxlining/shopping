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
$order_info_id=$_SESSION["infoid"];

?>

<body>
<div class="container">
    <div class="col-md-12">
        <form method="post" name="form1" action="">
            <table class="table-bordered table table-striped">
                <tr>
                    <td>支付方式</td>
                    <td></td>
                </tr>
                <tr>
                    <td>价格</td>
                    <?php
                    $query2="select * from tb_sc_order_info where order_info_id='$order_info_id'";
                    $res2=$pdo->query($query2);
                    $info=$res2->fetch(PDO::FETCH_OBJ);
                    $num=$info->num;
                    $money=$info->price;
                    ?>
                    <td><?php echo $num*$money;?></td>
                </tr>
                <tr>
                    <td>微信支付</td>
                    <td>支付宝</td>
                </tr>
                <tr>
                    <td><img src="images/wx.png" alt="微信" width="200" height="200"> </td>
                    <td><img src="images/zfb.jpg" alt="支付宝" width="200" height="200"> </td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="addr" value="mr" checked>默认收货地址</td>
                    <td></td>
                </tr>

                <tr>
                    <td><input type="submit" name="submit" value="支付"></td>
                    <td><input type="reset" name="reset" value="取消"></td>
                </tr>
            </table>

        </form>

    </div>
</div>
<?php
$query1="select * from tb_sc_address address join tb_sc_user user1 on address.user_id=user1.user_id where user1.user_name='$user' and address.mr='1'";
$query1=$pdo->query($query1);
$row=$query1->fetch(PDO::FETCH_OBJ);
$address=$row->address;
if($address==""){
    echo "<script>alert('未设置默认地址，即将跳转到地址设置！');window.location.href='add_address.php'</script>";
}
$time=date("Y-m-d H:i:s");
if(isset($_POST["submit"])){
    if($order_info_id) {
//        pay_zt为0时，未付款；为1，已付款
        $sql1="insert into tb_sc_order (create_time,user_name,order_info_id,pay_zt) values('$time','$user','$order_info_id','1')";
        $res1=$pdo->prepare($sql1);
        $res1->execute();
            echo "<script>alert('购买成功！');window.location.href='order.php'</script>";
        } else {
            echo "<script>history.back();</script>";
        }

}
?>
</body>
</html>

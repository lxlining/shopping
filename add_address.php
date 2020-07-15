<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加地址</title>
</head>
<?php
header("Content-type:text/html;charset=utf-8");
session_start();
include("conn/conn.php");
error_reporting(0);
?>
<body>
<div>
    <div class="nav">
        <ul>
            <li class="nav1"><a href="self.php">个人中心</a> </li>
            <li class="nav1"><a href="gwc.php">购物车</a> </li>
            <li class="nav1"><a href="">收藏夹</a> </li>
            <li class="nav1"><a href="link.php">网站导航</a> </li>
        </ul>
    </div>
    <table border="1">
        <tr>
            <td>收件人</td>
            <td>收货地址</td>
            <td>手机号码</td>
            <td>默认地址</td>
            <td>操作</td>
        </tr>

    <?php
    $user_id=$_SESSION["id"];
    $sql="select * from tb_sc_address where user_id='$user_id' order by create_time and mr desc limit 10";
    $res=$pdo->query($sql);
    $info=$res->fetch(PDO::FETCH_OBJ);
    do{
        ?>

            <tr>
                <td><?php echo $info->add_name;?></td>

                <td><?php echo $info->address;?></td>

                <td><?php echo $info->phone;?></td>

                <td><?php if($info->mr=='1') echo " 是 ";?> </td>
                <td><a href="update_address_mr.php?id=<?php echo $info->address_id;?>">设为默认地址</a> ||<a href="del_address.php?id=<?php echo $info->address_id;?>">删除</a> </td>
            </tr>

    <?php
    }while($info=$res->fetch(PDO::FETCH_OBJ));
    ?>
    </table>
</div>
<form name="form1" method="post" action="add_address_ok.php">
    <table>
        <tr>
            <td>收货人：&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><input type="text" name="user" id="user"></td>
        </tr>
        <tr>
            <td>手机号码：</td>
            <td><input type="text" name="phone" id="tel"></td>
        </tr>
        <tr>
            <td>收货地址：</td>
            <td><input type="text" name="address" id="address"></td>
        </tr>
        <tr>
            <td>默认地址：</td>
            <td>
                <input type="radio" name="mr" value="1" checked>是
                <input type="radio" name="mr" value="0" >否
            </td>
        </tr>
        <tr>
            <td></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" name="submit" value="添加">
            </td>
        </tr>
    </table>
</form>
</body>
</html>

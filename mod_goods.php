<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品修改</title>
    <style>
        .red{
            color: red;
        }
        input{
            border-color: grey;
        }
    </style>
</head>
<?php
header("Content-type:text/html; charset=utf8");
include("conn/conn.php");
session_start();
if($_SESSION["admin"]==""){
    echo "<script>alert('请登录！');history.back();</script>";
}
?>
<body>
<?php
$sql="select * from tb_sc_goods join tb_sc_pic on tb_sc_goods.goods_id=tb_sc_pic.goods_id join tb_sc_gys on tb_sc_gys.goods_id=tb_sc_pic.goods_id where tb_sc_pic.mr='3' order by tb_sc_goods.goods_id desc";
$result=$pdo->query($sql);
$row=$result->fetch(PDO::FETCH_OBJ);
do{
    ?>
    <form name="form1" method="post" action="add_goods_ok.php" enctype="multipart/form-data" target="_blank">
        <table border="1" cellspacing="0" cellpadding="0" align="center" width="600" height="400">
            <tr>
                <td class="red">商品名称：<?php echo $row->gname; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="goods" id="goods" type="text"></td>
            </tr>
            <tr>
                <td class="red">商品详情：<?php echo $row->info; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="info" id="info" type="text" cols="80" rows="3"></textarea></td>
            </tr>
            <tr>
                <td class="red">浏览图片：<img src="upfile2/<?php echo $row->address; ?>" width="80" height="60"> &nbsp;&nbsp;&nbsp;&nbsp;<input
                            name="images1" id="images1" type="file"></td>
            </tr>

            <tr>
                <td class="red">商品价格：<?php echo $row->price; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="price" id="price" type="number"></td>
            </tr>
            <tr>
                <td class="red">商品数量：<?php echo $row->num; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="num" id="num" type="number"></td>
            </tr>
            <tr>
                <td class="red">商品生产期：<?php echo $row->gtime; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="sctime" id="sctime" type="date"></td>
            </tr>
            <tr>
                <td class="red">供应商名称：<?php echo $row->gys; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="gys" id="gys" type="text"></td>
            </tr>
            <tr>
                <td class="red">供应商电话：<?php echo $row->tel; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="tel" id="tel" type="tel"></td>
            </tr>
            <tr>
                <td class="red">供应商地址：<?php echo $row->gy_address; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="addr" id="addr" type="text"></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" value="修改">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="reset" name="submit2" value="重置">
                </td>
            </tr>
        </table>
    </form>
    <br/>
    <br/>
    <?php
}while($row=$result->fetch(PDO::FETCH_OBJ));
$pdo=$row=NULL;
?>
</body>
</html>

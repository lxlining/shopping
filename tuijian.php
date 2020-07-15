<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品推荐</title>
    <link href="../bootstrap-3.3.7/css/bootstrap.css" type="text/css" rel="stylesheet">
    <style>
        body{
            padding: 20px;
        }
    </style>
</head>
<?php
header("Content-type:text/html; charset=utf-8");
include("conn/conn.php");
session_start();
error_reporting(0);
if($_SESSION["admin"]==""){
    echo "<script>alert('请登录！');history.back();</script>";
}
?>
<body>
<table class="table table-bordered table-striped table-hover">
    <tr>
        <td>图片</td>
        <td>商品名</td>
        <td>操作</td>
    </tr>
    <?php

    $sql = "select * from tb_sc_goods goods join tb_sc_pic pic on goods.goods_id=pic.goods_id where pic.mr='3' and goods.goods_id not in(select goods_id from tb_sc_tuijian where mr='1' ) order by pic.goods_id desc";
    $result = $pdo->query($sql);
    $row = $result->fetch(PDO::FETCH_OBJ);
    if(!$row){
        echo "无商品可推荐!";
        echo "请先添加商品，在进行此项操作。";
    }
    do {
        ?>
        <tr>
            <td><img src="upfile2\<?php echo $row->address; ?>" width="80" height="60"></td><br>
            <td><?php echo $row->gname; ?></td>
            <td><a href="tuijian_ok.php?id=<?php echo $row->goods_id; ?>">推荐</a></td>

        </tr>
        <?php
    } while ($row = $result->fetch(PDO::FETCH_OBJ));

    $pdo=$row=NULL;

    ?>
</table>
<button type="button" href="index.php" class="btn btn-success btn-lg pull-right">返回首页</button>
</body>
</html>

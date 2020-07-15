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
header("Content-type:text/html; charset=utf8");
include("conn/conn.php");
session_start();
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
    $sql="select * from tb_sc_goods goods join tb_sc_pic pic on goods.goods_id=pic.goods_id join tb_sc_tuijian tuijian on tuijian.goods_id=pic.goods_id where pic.mr='3' and tuijian.mr='1' order by tuijian.tuijian_id desc";
    $result=$pdo->query($sql);
    $row=$result->fetch(PDO::FETCH_OBJ);
    do{
        ?>
        <tr>
            <form method="get" name="form1">
                <td><img src="upfile2\<?php echo $row->address;?>" width="80" height="60"></td>
                <td><?php echo $row->gname;?></td>
                <td><a href="mod_tuijian_ok.php?id=<?php echo $row->goods_id;?>" >取消推荐</a></td>
            </form>
        </tr>
        <?php
    }while($row=$result->fetch(PDO::FETCH_OBJ));
    $pdo=$row=NULL;
    ?>
</table>
<button type="button" href="index.php" class="btn btn-success btn-lg pull-right">返回首页</button>
</body>
</html>

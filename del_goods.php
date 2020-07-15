<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品下架</title>
    <link href="../bootstrap-3.3.7/css/bootstrap.css" type="text/css" rel="stylesheet">
</head>

<style>
    body{
        padding: 20px;
    }
</style>
<?php
header("Content-type:text/html; charset=utf8");
include("conn/conn.php");
session_start();
if($_SESSION["admin"]==""){
    echo "<script>alert('请登录！');history.back();</script>";
}
?>
<body>
<div class="col-md-12">
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <td>浏览图片 </td>
            <td>商品名称</td>

            <td>商品详情</td>



            <td>操作 </td>
        </tr>
        <?php
        $sql="select * from tb_sc_goods join tb_sc_pic on tb_sc_goods.goods_id=tb_sc_pic.goods_id where tb_sc_pic.mr='3' order by tb_sc_goods.goods_id desc";
        $result=$pdo->query($sql);
        $row=$result->fetch(PDO::FETCH_OBJ);
        do{
            ?>

                <tr>
                    <td><img src="upfile2/<?php echo $row->address;?>" height="60" width="80"> </td>
                    <td><?php echo $row->gname;?></td>

                    <td><?php echo $row->info;?></td>


                    <td><a href="del_goods_ok.php?id=<?php echo $row->goods_id;?>">下架</a> </td>
                </tr>

            <?php
        }while($row=$result->fetch(PDO::FETCH_OBJ));
        $pdo=$row=NULL;
        ?>
    </table>
    <button type="button" href="index.php" class="btn btn-success btn-lg pull-right">返回首页</button>
</div>
</body>
</html>

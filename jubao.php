<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>举报信息</title>
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
<div>
    <table>
        <tr>
            <td>举报用户</td>
            <td>举报类型</td>
            <td>举报时间</td>
            <td>举报内容</td>
            <td>举报商品</td>
            <td>操作</td>
        </tr>
        <?php
        $sql3="select * from tb_sc_jubao jubao join tb_sc_goods goods on jubao.goods_id=goods.goods_id order by jubao.jb_time desc";
        $res3=$pdo->query($sql3);
        $row3=$res3->fetch(PDO::FETCH_OBJ);
        do{
        ?>

        <tr>
            <td><?php echo $row3->jb_user_name;?></td>
            <td><?php echo $row3->jb_class;?></td>
            <td><?php echo $row3->jb_time;?></td>
            <td><textarea rows="4" cols="80"><?php echo $row3->jb_content;?></textarea></td>
            <td><?php echo $row3->gname;?></td>
            <td><a href="del_goods_ok.php?id=<?php echo $row3->goods_id;?>">强制下架</a> </td>
        </tr>
    </table>
    <?php
    }while($row3=$res3->fetch(PDO::FETCH_OBJ));
    $row3=$res3=$pdo=NULL;
    ?>
</div>
</body>
</html>

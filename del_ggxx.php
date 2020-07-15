<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>公告信息</title>
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
<table class="table table-striped table-bordered table-hover">
    <tr>
        <td>公告主题</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <td>内容</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <td>操作</a></td>
    </tr>
<?php
$sql="select * from tb_sc_ggxx order by gg_id desc";
$result=$pdo->query($sql);
$row=$result->fetch(PDO::FETCH_OBJ);
do{
    ?>

        <tr>
            <td>公告主题：<?php echo $row->main; ?></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <td>内容：<?php echo $row->content; ?></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <td><a href="del_ggxx_ok.php?id=<?php echo $row->gg_id; ?>">删除公告</a></td>
        </tr>


    <?php
}while($row=$result->fetch(PDO::FETCH_OBJ));
$pdo=$row=NULL;
?>
</table>
<button type="button" href="index.php" class="btn btn-success btn-lg pull-right">返回首页</button>
</body>
</html>

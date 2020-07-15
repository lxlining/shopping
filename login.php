<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员登录</title>
    <style>
        a{
            text-decoration: none;
        }
    </style>
</head>
<script>
    function mycheck() {
        if(myform.admin.value==""){
            alert("管理名称不能为空！！");
            myform.user.focus();return false;
        }
        if(myform.pwd.value==""){
            alert("用户密码不能为空！！");
            myform.pwd.focus();return false;
        }
    }
</script>
<br>
<br/><br/>
<form name="myform" method="post"action="login_ok.php">
    <table width="532" height="183" align="center" cellspacing="0" cellpadding="0" bgcolor="#ccff66">
        <tr>
            <td height="71" colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
            <td width="249" height="30" align="center">&nbsp;</td>
            <td width="281" align="left">管理名：
                <input type="text" name="admin" size="20" placeholder="admin"><br/><br/>
                密<span style="color: rgba(0,0,0,0);">户</span>码：
                <input type="password" name="pwd" id="pwd" size="20" placeholder="0000">
            </td>
        </tr>
        <tr>
            <td height="43" align="center">&nbsp;</td>
            <td height="43" align="center">
                <input type="submit" name="submit" onclick="return mycheck()" value="登录">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
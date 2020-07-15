<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <title>用户信息修改</title>
    <link href="/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.js"></script>
    <style>
        body{
            margin: 20px;
            background-color: gainsboro;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="col-md-12">
        <div class="col-md-offset-4">
            <form name="form1" method="post" enctype="multipart/form-data" action="update_userinfo_ok.php">
                <table >
                    <tr>
                        <td>用户名：<input type="text" name="username" id="username"></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td>密<span style="color: gainsboro">户</span>码：<input type="password" name="pwd" id="pwd"></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td>性<span style="color: gainsboro">户</span>别：&nbsp;&nbsp;<input type="radio" name="sex" value="男" checked>男&nbsp;&nbsp;<input type="radio" name="sex" value="女">女
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td>头<span style="color: gainsboro">户</span>像：<input type="file" name="touxiang"><t style="color: red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*图片不含中文字符</t></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td>邮<span style="color: gainsboro">户</span>箱：<input type="text" name="email" id="email"></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td>手机号：<input type="text" name="phone" id="phone"></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="修改">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="重置"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" media="screen" href="/cementProject/Public/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="/cementProject/Public/css/cement.css">
    <title>登陆页面</title>
</head>
<body style='background-color:skyblue;'>
<div class="topWelcome">
    <span>欢迎登录混泥砂浆后台管理页面</span>
</div>

    <div id="loginImage">
        <img src="/cementProject/Public/images/shajiang.jpg" width="100%" height="100%">
    </div>
    <div id="loginBox">
        <form id="loginForm" method="post">
        <h3 align="center">用户登录</h3><br>
        <div class="input-group input-group-md">
            <span class="input-group-addon">用户名</span>
            <input type="text" class="form-control" name="userName">
        </div><br>&nbsp;
        <div class="input-group input-group-md">
            <span class="input-group-addon">密码</span>
            <input type="password" class="form-control" name="password">
        </div><br>
        <button class="btn-info" id="loginBtn">登陆</button>
        </form>
    </div>

<script src="/cementProject/Public/js/jquery-2.1.1.min.js"></script>
<script>
$(document).ready(function(){
    var url="<?php echo U('login');?>";
    $("#loginBtn").on("click",function(){
        var form=document.getElementById("loginForm");
        form.action="<?php echo U('login');?>";
    })
})
</script>
</body>
</html>
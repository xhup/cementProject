<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" media="screen" href="/cementProject/Public/css/cement.css">
    <link rel="stylesheet" media="screen" href="/cementProject/Public/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <title>修改密码</title>
</head>
<body>
<div class="dropdown topOne">
    <span class="rightTag">
    <img src="/cementProject/Public/images/head_icon.png" width="25">
    <span class="currentUser"></span>
     </span>
</div>


<form name="changePasswd" id="changePasswordForm" method="post">
    <h3 align="center">修改密码</h3>
    <table align="center">
        <tr>
            <td align="right"><b>旧密码:</b></td>
            <td><input type="text" name="oldPassword" width="20" required="required"></td>
        </tr>
        <tr>
            <td align="right"><b>新密码:</b></td>
            <td><input type="text" name="newPassword1" width="20" required="required"></td>
        </tr>
        <tr>
            <td align="right"><b>确认新密码:</b></td>
            <td><input type="text" name="newPassword2" width="20" required="required"></td>
        </tr>
        <tr>
            <td align="right">  <input type="submit" value="提交" class="btn-info"> </td>
            <td align="left">  <a href="mainView.html">&nbsp;&nbsp;&nbsp;返回主页 </a> </td>
        </tr>
        </table>
    </form>

<script src="/cementProject/Public/js/jquery-2.1.1.min.js"></script>
<script src="/cementProject/Public/js/publicFunction.js"></script>
<script>
    $(document).ready(function(){
        $(".currentUser").load("<?php echo U('sessionCheck');?>");//通过ajax在网页右上角显示当前登录用户名
        var url="<?php echo U('changePassword');?>";
        $("#changePasswordForm input[type='submit']").on("click",function(){
            var oldPassword=$("#changePasswordForm input[name='oldPassword']").val();
            var newPassword1=$("#changePasswordForm input[name='newPassword1']").val();
            var newPassword2=$("#changePasswordForm input[name='newPassword2']").val();
            if(checkIsNotNull(oldPassword)&&checkIsNotNull(newPassword1)&&checkIsNotNull(newPassword2)){
                if(lengthCheck(newPassword1)){
                    if(newPassword1==newPassword2){
                        var form=document.getElementById("changePasswordForm");
                        form.action=url;
                    }else {
                        alert("请确保两次输入的新密码一致")
                        return false;
                    }
                }else {
                    alert("输入的新密码必须由6-16位的字母数字和下划线组成");
                    return false;
                }
            }else {
                alert("请确保输入框输入完全");
                return false;
            }

        })
    })
</script>
</body>
</html>
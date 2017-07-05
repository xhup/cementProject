<?php
/**
 * Created by PhpStorm.
 * User: XH
 * Date: 2017/1/6
 * Time: 15:53
 */

namespace project\Controller;
use Think\Controller;
class LoginController extends Controller
{
    public function loginView(){
        $this->display();
    }
//用户登录验证
    public function login(){
        $userName=I("post.userName");
        $password=I("post.password");
        $user=M("admin");
        $condition["account"]=$userName;
        $condition["password"]=$password;
        $result=$user->where($condition)->select();
        if($result){
            $_SESSION['isLogin']=1;  //把登录状态存入session
            $_SESSION['userName']=$userName; //把登录的用户名存入session
            $this->success('登录成功',"mainView");
        }else{
            $this->error('用户名或密码错误，请重新登录');
        }
    }

    /*session用户登录状态验证*/
    public function sessionCheck(){
        session_start();
        if( $_SESSION['isLogin']==1){
            echo $_SESSION['userName'];
        }else{
            echo "未登陆";
        }

    }

    /*用户退出登录*/
    public function loginOut(){
        session_start();
        if( $_SESSION['isLogin']==1){
            $old_user = $_SESSION['userName'];
            unset($_SESSION['userName']);
            $result_dest = session_destroy();
        }
        if (!empty($old_user)) {
            if ($result_dest)  {
                // if they were logged in and are now logged out
                $this->redirect("loginView","正在返回登录页面...");
            } else {
                // they were logged in and could not be logged out
                $this->error("注销失败，请稍后再试");
            }
        } else {
            // if they weren't logged in but came to this page somehow
            $this->error("用户未登陆","loginView");

        }
    }

    /*验证用户密码*/
   private function checkPassword($userName,$password){
        $user=M('admin');
        $condition['account']=$userName;
        $condition['password']=$password;
        $result=$user->where($condition)->select();
        if($result){
            return 1;
        }else{
            $this->error("旧密码不正确，请重新输入");
        }
    }

    /*更改用户密码*/
    private function updatePassword($userName,$oldPassword,$newPassword){
        $this->checkPassword($userName,$oldPassword);//验证用户密码
        $user=M('admin');
        $update['password']=$newPassword;
        $result=$user->where("account='$userName'")->setField($update);
        if($result){
            $this->success("密码修改成功");
        }else{
            $this->error("密码修改失败,请重试");
        }
    }
    /*用户修改密码的处理方法*/
    public function changePassword(){
        session_start();
        $oldPassword=I("post.oldPassword");
        $newPassword1=I("post.newPassword1");
        $newPassword2=I("post.newPassword2");
        //各种格式的检查
        if(isset($_SESSION['userName'])) {
            $this->updatePassword($_SESSION['userName'],$oldPassword,$newPassword1);//进行密码的修改
        } else{
            $this->error("用户还未登陆，请先登陆");
        }
    }


}
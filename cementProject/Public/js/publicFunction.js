/**
 * Created by XH on 2017/1/11.
 */
//验证输入不能为空（包括空格符）
function checkIsNotNull(parm){
    if(parm.replace(/(^\s*)|(\s*$)/g,"")==""){
        return false;
    } else {
        return parm;
    }

}
/*验证 */
function keepOnePoint(parm){
    var pattern=/^[0-9]+\.[0-9]$/;
    if(!pattern.test(parm)){
        alert("请确保输入身高体重保留一位小数");
        return false;
    }else {
        return parm;
    }

}
/*获取页面url的指定参数值*/
function getUrlparm(parm){
    var reg = new RegExp("(^|&)" + parm + "=([^&]*)(&|$)","i");
    var value = window.location.search.substr(1).match(reg);
    if (value!=null){
        return (value[2]);
    } else {
        return null;
    }
}
/*控制输入字符在6-16位之间*/
function lengthCheck(parm){
   var pattern=/^[0-9a-zA-Z]\w{5,15}$/;
    if(!pattern.test(parm)){
        return false;
    }else {
        return parm;
    }
}
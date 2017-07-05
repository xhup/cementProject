<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" media="screen" href="/cementProject/Public/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="/cementProject/Public/css/cement.css">
    <link rel="stylesheet" media="screen" href="/cementProject/Public/thirdPlug/DataTables/css/jquery.dataTables.css">
    <title>干混砂浆管理系统</title>
</head>
<body>

<div class="dropdown topOne">
混泥砂浆管理系统
    <span class="rightTag">
    <img src="/cementProject/Public/images/head_icon.png" width="25">
    <span class="currentUser"></span>
     </span>
    <button type="button" class="btn-info dropdown-toggle" id="dropdownMenu" data-toggle="dropdown">用户
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
        <li role="presentation">
            <a role="menuitem" tabindex="-1" href="<?php echo U('Login/changePasswdView');?>">修改密码</a>
        </li>
        <li role="presentation" class="divider"></li>
        <li role="presentation">
            <a role="menuitem" tabindex="-1"  href="javascript:if(confirm('确实要退出?'))location='../Login/loginOut'">注销用户</a>
        </li>
    </ul>
</div>
<!--显示系统时间-->
<div id="clock"></div>
<div id="mainPort">
    <table id="mainTable" class="display" align="center" border="0" width="90%" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th>序号</th>
            <th>瓶罐号</th>
            <th>工地位置</th>
            <th>是否缺料</th>
            <th>状态</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        </thead>
    </table>
</div>





<script src="/cementProject/Public/js/jquery-2.1.1.min.js"></script>
<script src="/cementProject/Public/js/bootstrap.min.js"></script>
<script src="/cementProject/Public/thirdPlug/DataTables/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
        $(".currentUser").load("<?php echo U('login/sessionCheck');?>");//通过ajax在网页右上角显示当前登录用户名
        setInterval("clock.innerHTML=new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay());",10);
    })


    $(function(){
        $("#webHead").load("<?php echo U('Login/webHead');?>");
    })

//    通过dataTables插件从服务器请求对应表格中儿童数据信息，这里要注意返回的数据要包装成"data"名字，并且数据列数与html中列数严格匹配，不然无法显示，这个问题卡了我好久
    $(document).ready(function() {
        var dataSource="<?php echo U('Data/allCansInfo');?>";
        console.log(dataSource);
        $('#mainTable').DataTable({
              "ajax": dataSource,
              language: {
                "sProcessing": "处理中...",
                "sLengthMenu": "显示 _MENU_ 项结果",
                "sZeroRecords": "没有匹配结果",
                "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
                "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                "sInfoPostFix": "",
                "sSearch": "搜索:",
                "sUrl": "",
                "sEmptyTable": "表中数据为空",
                "sLoadingRecords": "载入中...",
                "sInfoThousands": ",",
                "oPaginate": {
                    "sFirst": "首页",
                    "sPrevious": "上页",
                    "sNext": "下页",
                    "sLast": "末页"
                },
                "oAria": {
                    "sSortAscending": ": 以升序排列此列",
                    "sSortDescending": ": 以降序排列此列"
                }
            },
            "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button>查看</button>"
        } ],
              "columns": [
                { "data": "identifier" },
                { "data": "simnumber" },
                { "data": "location" },
                { "data": "islack" },
                { "data": "status" },
                { "data": "uploadtime" },
                 null//最后一类数据不需要从服务器获取，是自定义跳转按键
            ]
        } );

    } );
    //表格选中列高亮
    $(function(){
        $("#mainTable tbody").on("click","tr",function(){
            $(this).toggleClass("selected");
        })
    })
//表格奇偶行不同色
    $(function(){
        $("#mainTable tbody tr:even").addClass("even")
        $("#mainTable tbody tr:odd").addClass("odd")
    })
// //拿到对应点击儿童的就诊号
//    $(function(){
//       $("#mainTable tbody").on("click","button",function(){
//           var name =  $(this).parents("tr").children("td:eq(0)").text();//获取对应儿童的姓名
//           var value =  $(this).parents("tr").children("td:eq(1)").text();//获取对应儿童的就诊号
//           var childSex =  $(this).parents("tr").children("td:eq(2)").text();//获取对应儿童的性别，后续根据性别选择图表要用
//           if(childSex=="男"){
//               var sex="1";
//           } else {
//               var sex="2";
//           }
//           //将点击的儿童就诊号存到后台并跳转到相应页面
//           var target="saveMedicalID";
//           $.post(target,{"medicalID":value},function(data){
//               if(data){
//                   location.href='detailInformationView.html?medicalID='+value+'&name='+name+'&sex='+sex+'&timer='+new Date().getTime();
//               }

//           });
//       })
//    })
</script>
</body>
</html>
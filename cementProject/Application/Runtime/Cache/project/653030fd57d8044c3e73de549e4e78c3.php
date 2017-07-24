<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" media="screen" href="/cementProject/Public/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="/cementProject/Public/thirdPlug/DataTables/css/buttons.dataTables.min.css">
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
                <a role="menuitem" tabindex="-1" href="changePasswdView.html">修改密码</a>
            </li>
            <li role="presentation" class="divider"></li>
            <li role="presentation">
                <a role="menuitem" tabindex="-1" href="javascript:if(confirm('确实要退出?'))location='loginOut'">注销用户</a>
            </li>
        </ul>
    </div>
    <div id="mainPort">
        <table id="mainTable" class="display" align="center" border="0" width="90%" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>瓶罐号</th>
                    <th>工地名称</th>
                    <th>工地地址</th>
                    <th>经度</th>
                    <th>纬度</th>
                    <th>是否缺料</th>
                    <th>状态</th>
                    <th>更新时间</th>
                    <!-- <th>操作</th> -->
                </tr>
            </thead>
        </table>
    </div>
   
    <script src="/cementProject/Public/js/jquery-2.1.1.min.js"></script>
    <script src="/cementProject/Public/js/bootstrap.min.js"></script>
    <script src="/cementProject/Public/thirdPlug/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="/cementProject/Public/thirdPlug/DataTables/js/dataTables.buttons.min.js"></script>
    <script>
    $(document).ready(function() {
        // $(".currentUser").load("<?php echo U('login/sessionCheck');?>"); //通过ajax在网页右上角显示当前登录用户名
        $.get("<?php echo U('login/sessionCheck');?>", function(e) {
            var data = e.data;
            $(".currentUser").html(data);
            if (data == "未登陆") {
                alert("请先登陆！登陆后才能查看数据");
                window.location.href = "http://121.40.89.113/cementProject/index.php/login/loginView";
            }
        })

        setInterval(() => window.location.reload(), 5000 * 12 * 5); //页面每5分钟自动刷新一次

    })


    //    通过dataTables插件从服务器请求对应表格中数据信息，这里要注意返回的数据要包装成"data"名字，并且数据列数与html中列数严格匹配，不然无法显示，这个问题卡了我好久
    $(document).ready(function() {
        var dataSource = "<?php echo U('Data/allCansInfo');?>";
        $.when($('#mainTable').DataTable({
            ajax: dataSource,
            dom: 'lBfrtip',
            buttons: [{
                    // 扩展的按钮，用于快捷查找,
                    text: '缺料',
                    action: function(e, dt, node, config) {
                        this.search("是").draw();
                        // this.disable(); // disable button
                    }
                },


                {
                    text: '不缺',
                    action: function(e, dt, node, config) {
                        this.search("否").draw();
                        // this.disable(); // disable button

                    }
                }, {
                    text: '所有',
                    action: function(e, dt, node, config) {
                        this.search("").draw();
                        // this.disable(); // disable button

                    }
                }, {
                    text: '查看地图',
                    action: function(e, dt, node, config) {
                        window.open("http://192.168.1.121/cementProject/data/mainMap?ak=pass");
                        // this.disable(); // disable button

                    }
                }
            ],
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
            "columnDefs": [{
                "targets": -1,
                "data": null,
                "defaultContent": "<button>查看</button>"
            }],
            "columns": [{
                    "data": "identifier"
                }, {
                    "data": "simnumber"
                }, {
                    "data": "worksite"
                }, {
                    "data": "location"
                }, {
                    "data": "longitude"
                }, {
                    "data": "latitude"
                }, {
                    "data": "islack"
                }, {
                    "data": "status"
                }, {
                    "data": "uploadtime"
                },
                // null //最后一类数据不需要从服务器获取，是自定义跳转按键
            ]

        })).then($.get("<?php echo U('Data/lackInfo');?>", function(e) { //当dataTable加载完成后，如果存在缺料则弹出警告并报警
            var data = e.data;
            var result = data.some(value => value.islack == "是");
            if (result) {
                var audio = new Audio("/cementProject/Public/images/sound.mp3"); //报警音乐
                audio.play();
                audio.loop = true;
                setTimeout(function() {
                    alert('存在缺料砂浆罐!');
                    audio.pause();
                    audio = null;
                }, 2000);

            }
        }));
    });

    //表格选中列高亮
    $(function() {
            $("#mainTable tbody").on("click", "tr", function() {
                $(this).toggleClass("selected");
            })

              $("html").on("mouseover", function() {
                $("#mainTable tbody tr td:contains('是')").addClass("lackTD");//给缺料单元格加红色背景样式
            })

        })
        //表格奇偶行不同色
    $(function() {
        $("#mainTable tbody tr:even").addClass("even");
        $("#mainTable tbody tr:odd").addClass("odd");
    })
    </script>
</body>

</html>
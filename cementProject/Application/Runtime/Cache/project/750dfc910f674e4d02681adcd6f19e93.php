<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/cementProject/Public/css/cementMap.css">
    <title>地图显示</title>
</head>

<body>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=udjKUGxBhIejF1ON9FMiRMGHcbzld2lX"></script>
    <div id="bigMapContain">
        <div id="bigMap"></div>
    </div>
    <div id="smallMapContain">
        <div id="smallMap"></div>
    </div>
</body>

</html>
<script type="text/javascript" src="/cementProject/Public/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/cementProject/Public/js/mapRelevant.js"></script>
<script type="text/javascript">

//登陆限制，只有登陆了才能查看地图
var search = window.location.search;
var ak = search.slice(search.indexOf("=") + 1);
if (!(ak == 'pass')) {
    alert("请先登陆！登陆后才能查看地图模式");
    window.location.href = "http://192.168.1.121/cementProject/index.php/Login/loginView.html";

}

// 百度地图API功能
var bigMap = new BMap.Map("bigMap"); // 创建地图实例  
bigMap.centerAndZoom("东阳市", 8); // 初始化地图，设置中心点坐标和地图级别(浙江地图以东阳市为中心显示比较合适)  
var zhejiang = ["杭州市", "衢州市", "宁波市", "温州市", "嘉兴市", "绍兴市", "湖州市", "台州市", "舟山市", "丽水市", "金华市"]; //浙江省所有市集合

zhejiang.forEach(value => getBoundary(value)); //描绘浙江所有市的区域边界

var blueCan = new BMap.Icon("/cementProject/Public/images/blueCan.jpg", new BMap.Size(20, 30)); //加载自定义绿色水泥罐
var redCan = new BMap.Icon("/cementProject/Public/images/redCan.jpg", new BMap.Size(20, 30)); //加载自定义红色水泥罐
var selectCity = []; //存储缺料城市的数组变量

$.get('<?php echo U("Data/dataForMap");?>', function(e) {
    var data = e.data;
    var lackCan=data.map(value=>value.longitude + "-" + value.latitude + "-" + value.id);//拿到缺料具体罐号及对应经纬度
    
    var coordinate = data.map(value => value.location + "/" + value.worksite + "-" + value.longitude + "-" + value.latitude); //拿到所有缺料的工地地址和经纬度坐标
    var uniqueCoordinate = Array.from(new Set(coordinate)); //工地地址和经纬度去重
    var lackLocation = data.map(value => value.location); //拿到所有缺料的工地地址
    var uniqueLocation = Array.from(new Set(lackLocation)); //工地地址去重
    var lackBigCity = uniqueLocation.map(value => value.slice(0, 3)); //工地地址的市
    var lackSmallCity = uniqueLocation.map(value => value.slice(3, 6)); //工地地址的区

    var marker1 = new BMap.Marker(new BMap.Point(120.19, 30.26), {
        icon: lackBigCity.some(value => value == "杭州市") ? redCan : blueCan
    }); // 创建杭州市点坐标 
    var marker2 = new BMap.Marker(new BMap.Point(118.88, 28.97), {
        icon: lackBigCity.some(value => value == "衢州市") ? redCan : blueCan
    }); // 创建衢州市点坐标 
    var marker3 = new BMap.Marker(new BMap.Point(121.55, 29.88), {
        icon: lackBigCity.some(value => value == "宁波市") ? redCan : blueCan
    }); // 创建宁波市点坐标 
    var marker4 = new BMap.Marker(new BMap.Point(120.70, 28.00), {
        icon: lackBigCity.some(value => value == "温州市") ? redCan : blueCan
    }); // 创建温州市点坐标 
    var marker5 = new BMap.Marker(new BMap.Point(120.75, 30.75), {
        icon: lackBigCity.some(value => value == "嘉兴市") ? redCan : blueCan
    }); // 创建嘉兴市点坐标 
    var marker6 = new BMap.Marker(new BMap.Point(120.57, 30.00), {
        icon: lackBigCity.some(value => value == "绍兴市") ? redCan : blueCan
    }); // 创建绍兴市点坐标 
    var marker7 = new BMap.Marker(new BMap.Point(120.08, 30.90), {
        icon: lackBigCity.some(value => value == "湖州市") ? redCan : blueCan
    }); // 创建湖州市点坐标 
    var marker8 = new BMap.Marker(new BMap.Point(121.43, 28.68), {
        icon: lackBigCity.some(value => value == "台州市") ? redCan : blueCan
    }); // 创建台州市点坐标 
    var marker9 = new BMap.Marker(new BMap.Point(122.20, 30.00), {
        icon: lackBigCity.some(value => value == "舟山市") ? redCan : blueCan
    }); // 创建舟山市点坐标 
    var marker10 = new BMap.Marker(new BMap.Point(119.92, 28.45), {
        icon: lackBigCity.some(value => value == "丽水市") ? redCan : blueCan
    }); // 创建丽水市点坐标 
    var marker11 = new BMap.Marker(new BMap.Point(119.65, 29.08), {
        icon: lackBigCity.some(value => value == "金华市") ? redCan : blueCan
    }); // 创建金华市点坐标
    var marker = [marker1, marker2, marker3, marker4, marker5, marker6, marker7, marker8, marker9, marker10, marker11]; //所有市的点坐标集合

    marker.forEach(value => bigMap.addOverlay(value)); //添加每个市的水泥罐图标
    bigMap.enableScrollWheelZoom(true); //开启鼠标滚轮缩放


    lackBigCity.forEach(value => {
        switch (value) {
            case "杭州市":
                {
                    selectCity.push(marker1);
                    break;
                }
            case "衢州市":
                {
                    selectCity.push(marker2);
                    break;
                }
            case "宁波市":
                {
                    selectCity.push(marker3);
                    break;
                }
            case "温州市":
                {
                    selectCity.push(marker4);
                    break;
                }
            case "嘉兴市":
                {
                    selectCity.push(marker5);
                    break;
                }
            case "绍兴市":
                {
                    selectCity.push(marker6);
                    break;
                }
            case "湖州市":
                {
                    selectCity.push(marker7);
                    break;
                }
            case "台州市":
                {
                    selectCity.push(marker8);
                    break;
                }
            case "舟山市":
                {
                    selectCity.push(marker9);
                    break;
                }
            case "丽水市":
                {
                    selectCity.push(marker10);
                    break;
                }
            case "金华市":
                {
                    selectCity.push(marker11);
                    break;
                }

        }
    });

    //所有缺料城市的进一步事件监听
    selectCity.forEach(value => {
        //跳到小地图并传入工地地址和经纬度坐标
        value.addEventListener('click', function(e, spot1,spot2) {
            jumpToSmallMap(e, uniqueCoordinate,lackCan)
        });
        //地图Mark点动画并显示文字标签
        value.addEventListener('mouseover', markJumpAndShowText);
        //移除Mark点动画和文字标签
        value.addEventListener('mouseout', clearJumpAndText);

    });
})

setInterval(() => window.location.reload(), 5000 * 12 * 3); //页面每3分钟自动刷新一次
</script>
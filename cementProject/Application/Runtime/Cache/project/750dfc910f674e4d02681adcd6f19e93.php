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
// 百度地图API功能
var bigMap = new BMap.Map("bigMap"); // 创建地图实例  
bigMap.centerAndZoom("东阳市", 8); // 初始化地图，设置中心点坐标和地图级别(浙江地图以东阳市为中心显示比较合适)  
// getBoundary("杭州市江干区");
// getBoundary("杭州市西湖区");
// getBoundary("杭州市上城区");
// getBoundary("杭州市下城区");
// getBoundary("杭州市拱墅区");
// getBoundary("杭州市滨江区");
// getBoundary("杭州市萧山区");
// getBoundary("杭州市余杭区");
// getBoundary("杭州市富阳区");
// getBoundary("杭州市临安市");
// getBoundary("杭州市建德市");
// getBoundary("杭州市桐庐县");
// getBoundary("杭州市淳安县");
// 
//var marker1= new BMap.Marker(new BMap.Point(120.20, 30.27));   // 创建江干区点坐标 
// var marker2 = new BMap.Marker(new BMap.Point(120.17, 30.25));  // 创建上城区点坐标 
// var marker3 = new BMap.Marker(new BMap.Point(120.17, 30.28));  // 创建下城区点坐标 
// var marker4 = new BMap.Marker(new BMap.Point(120.13, 30.32));  // 创建拱墅区点坐标 
// var marker4 = new BMap.Marker(new BMap.Point(120.13, 30.32));  // 创建拱墅区点坐标 
// var marker5 = new BMap.Marker(new BMap.Point(120.13, 30.27));  // 创建西湖区点坐标 
// var marker6 = new BMap.Marker(new BMap.Point(120.20, 30.20));  // 创建滨江区点坐标 
// var marker7 = new BMap.Marker(new BMap.Point(120.27, 30.17));  // 创建萧山区点坐标 
// var marker8 = new BMap.Marker(new BMap.Point(120.30, 30.42));  // 创建余杭区点坐标 
// var marker9 = new BMap.Marker(new BMap.Point(119.95, 30.05));  // 创建富阳区点坐标 
// var marker10 = new BMap.Marker(new BMap.Point(119.28, 29.48)); // 创建建德市点坐标
// var marker11 = new BMap.Marker(new BMap.Point(119.72, 30.23)); // 创建临安市点坐标 
// var marker12 = new BMap.Marker(new BMap.Point(119.67, 29.80));  // 创建桐庐县点坐标
// var marker13 = new BMap.Marker(new BMap.Point(119.03, 29.60));  // 创建淳安县点坐标  
getBoundary("杭州市");
getBoundary("衢州市");
getBoundary("宁波市");
getBoundary("温州市");
getBoundary("嘉兴市");
getBoundary("绍兴市");
getBoundary("湖州市");
getBoundary("台州市");
getBoundary("舟山市");
getBoundary("丽水市");
getBoundary("金华市");

var blueCan = new BMap.Icon("/cementProject/Public/images/blueCan.jpg", new BMap.Size(20, 30)); //加载自定义绿色水泥罐
var redCan = new BMap.Icon("/cementProject/Public/images/redCan.jpg", new BMap.Size(20, 30)); //加载自定义红色水泥罐


$.get('<?php echo U("Data/dataForMap");?>', function(e) {
    var data = e.data;
    
    var coordinate= data.map(value => value.longitude+"-"+value.latitude); //拿到所有缺料的工地经纬度坐标
    var uniqueCoordinate = Array.from(new Set(coordinate)); //工地地址去重
    var lackLocation = data.map(value => value.location); //拿到所有缺料的工地地址
    var uniqueLocation = Array.from(new Set(lackLocation)); //工地地址去重
    var lackBigCity = uniqueLocation.map(value => value.slice(0, 3)); //工地地址的市
    var lackSmallCity = uniqueLocation.map(value => value.slice(3, 6)); //工地地址的区
  console.log(uniqueCoordinate);
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

    //添加每个市的水泥罐图标
    bigMap.addOverlay(marker1);
    bigMap.addOverlay(marker2);
    bigMap.addOverlay(marker3);
    bigMap.addOverlay(marker4);
    bigMap.addOverlay(marker5);
    bigMap.addOverlay(marker6);
    bigMap.addOverlay(marker7);
    bigMap.addOverlay(marker8);
    bigMap.addOverlay(marker9);
    bigMap.addOverlay(marker10);
    bigMap.addOverlay(marker11);

    bigMap.enableScrollWheelZoom(true); //开启鼠标滚轮缩放

    marker.forEach(value => {
    	//跳到小地图并传入经纬度坐标
        value.addEventListener('click', function(e,spot){jumpToSmallMap(e,uniqueCoordinate)});
        //地图Mark点动画并显示文字标签
        value.addEventListener('mouseover', markJumpAndShowText);
         //移除Mark点动画和文字标签
        value.addEventListener('mouseout', clearJumpAndText);

    }); //为所有点添加点击事件，进入指定小地图
})

// console.log(lackCity);
// lackHZ=lackCity[0].some(value=>value=="杭州市");
</script>
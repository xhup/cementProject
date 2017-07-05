<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>地图显示</title>
</head>

<body>
    <style type="text/css">
    body,
    html,
    #allmap {
        width: 100%;
        height: 100%;
        overflow: hidden;
        margin: 0;
        font-family: "微软雅黑";
    }
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=udjKUGxBhIejF1ON9FMiRMGHcbzld2lX"></script>
    <div id="allmap"></div>
</body>

</html>
<script type="text/javascript">
// 百度地图API功能
var map = new BMap.Map("allmap"); // 创建地图实例  
map.centerAndZoom("东阳市", 8); // 初始化地图，设置中心点坐标和地图级别(浙江地图以东阳市为中心显示比较合适)  

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

var marker1= new BMap.Marker(new BMap.Point(120.19, 30.26));   // 创建杭州市点坐标 
var marker2 = new BMap.Marker(new BMap.Point(118.88, 28.97));  // 创建衢州市点坐标 
var marker3 = new BMap.Marker(new BMap.Point(121.55, 29.88));  // 创建宁波市点坐标 
var marker4 = new BMap.Marker(new BMap.Point(120.70, 28.00));  // 创建温州市点坐标 
var marker5 = new BMap.Marker(new BMap.Point(120.75, 30.75));  // 创建嘉兴市点坐标 
var marker6 = new BMap.Marker(new BMap.Point(120.57, 30.00));  // 创建绍兴市点坐标 
var marker7 = new BMap.Marker(new BMap.Point(120.08, 30.90));  // 创建湖州市点坐标 
var marker8 = new BMap.Marker(new BMap.Point(121.43, 28.68));  // 创建台州市点坐标 
var marker9 = new BMap.Marker(new BMap.Point(122.20, 30.00));  // 创建舟山市点坐标 
var marker10 = new BMap.Marker(new BMap.Point(119.92, 28.45));  // 创建丽水市点坐标 
var marker11 = new BMap.Marker(new BMap.Point(119.65, 29.08)); // 创建金华市点坐标




map.addOverlay(marker1);    
map.addOverlay(marker2);      
map.addOverlay(marker3);   
map.addOverlay(marker4);   
map.addOverlay(marker5);   
map.addOverlay(marker6);   
map.addOverlay(marker7);   
map.addOverlay(marker8);   
map.addOverlay(marker9);   
map.addOverlay(marker10); 
map.addOverlay(marker11);        
map.enableScrollWheelZoom(true); //开启鼠标滚轮缩放

function getBoundary(city) {
    var bdary = new BMap.Boundary();
    bdary.get(city, function(rs) { //获取行政区域
        // map.clearOverlays(); //清除地图覆盖物       
        var count = rs.boundaries.length; //行政区域的点有多少个
        if (count === 0) {
            alert('未能获取当前输入行政区域');
            return;
        }
        var pointArray = [];
        for (var i = 0; i < count; i++) {
            var ply = new BMap.Polygon(rs.boundaries[i], {
                strokeWeight: 2,
                strokeColor: "#0015FF"
            }); //建立多边形覆盖物
            map.addOverlay(ply); //添加覆盖物
            pointArray = pointArray.concat(ply.getPath());
        }
        // map.setViewport(pointArray); //调整视野  
        // addlabel();
    });
}
</script>
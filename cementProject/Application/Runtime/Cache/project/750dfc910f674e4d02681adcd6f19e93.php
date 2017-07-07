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
var marker1 = new BMap.Marker(new BMap.Point(120.19, 30.26), {
    icon: blueCan
}); // 创建杭州市点坐标 
var marker2 = new BMap.Marker(new BMap.Point(118.88, 28.97), {
    icon: blueCan
}); // 创建衢州市点坐标 
var marker3 = new BMap.Marker(new BMap.Point(121.55, 29.88), {
    icon: blueCan
}); // 创建宁波市点坐标 
var marker4 = new BMap.Marker(new BMap.Point(120.70, 28.00), {
    icon: blueCan
}); // 创建温州市点坐标 
var marker5 = new BMap.Marker(new BMap.Point(120.75, 30.75), {
    icon: blueCan
}); // 创建嘉兴市点坐标 
var marker6 = new BMap.Marker(new BMap.Point(120.57, 30.00), {
    icon: blueCan
}); // 创建绍兴市点坐标 
var marker7 = new BMap.Marker(new BMap.Point(120.08, 30.90), {
    icon: blueCan
}); // 创建湖州市点坐标 
var marker8 = new BMap.Marker(new BMap.Point(121.43, 28.68), {
    icon: blueCan
}); // 创建台州市点坐标 
var marker9 = new BMap.Marker(new BMap.Point(122.20, 30.00), {
    icon: blueCan
}); // 创建舟山市点坐标 
var marker10 = new BMap.Marker(new BMap.Point(119.92, 28.45), {
    icon: blueCan
}); // 创建丽水市点坐标 
var marker11 = new BMap.Marker(new BMap.Point(119.65, 29.08), {
    icon: blueCan
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
	value.addEventListener('click', jumpToSmallMap);
	value.addEventListener('mouseover', markJumpAndShowText);
	value.addEventListener('mouseout', clearJumpAndText);

}); //为所有点添加点击事件，进入指定小地图

//弹出选中地级市的小地图
function jumpToSmallMap(e) {
    var p = e.target;
    // alert("marker的位置是" + p.getPosition().lng + "," + p.getPosition().lat);
    var smallMap = new BMap.Map("smallMap"); // 创建地图实例  
    var centerPoint = new BMap.Point(p.getPosition().lng, p.getPosition().lat); //拿到点击地市的经纬度
    smallMap.centerAndZoom(centerPoint, 10); // 初始化地市级地图
    smallMap.enableScrollWheelZoom(true); //开启鼠标滚轮缩放
}

//油桶标志跳动动画且显示文字
function  markJumpAndShowText(e){
	var p = e.target;
	var centerPoint = new BMap.Point(p.getPosition().lng, p.getPosition().lat); //拿到点击地市的经纬度
	p.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
	var opts = {
	  position : centerPoint,    // 指定文本标注所在的地理位置
	  offset   : new BMap.Size(25, -30)    //设置文本偏移量
	}
	var label = new BMap.Label("点击查看具体位置", opts);  // 创建文本标注对象
		label.setStyle({
			 color : "red",
			 fontSize : "12px",
			 height : "20px",
			 lineHeight : "20px",
			 fontFamily:"微软雅黑"
		 });
	 	p.setLabel(label);
}

//清除跳动动画和文字
function clearJumpAndText(e){
   var p = e.target;
   p.setAnimation(null); //取消标志点跳动的动画
   var allOverlay = bigMap.getOverlays();//拿到所有覆盖物
   bigMap.removeOverlay(p.getLabel());//去除标志点的文字
}

//画城市轮廓
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
            bigMap.addOverlay(ply); //添加覆盖物
            pointArray = pointArray.concat(ply.getPath());
        }
        // map.setViewport(pointArray); //调整视野  
        // addlabel();
    });
}
</script>
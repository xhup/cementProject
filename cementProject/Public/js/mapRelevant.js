//弹出选中地级市的小地图
function jumpToSmallMap(e,spot) {
    var p = e.target;
    var smallMap = new BMap.Map("smallMap"); // 创建地图实例  
    var centerPoint = new BMap.Point(p.getPosition().lng, p.getPosition().lat); //拿到点击地市的经纬度
    smallMap.centerAndZoom(centerPoint, 10); // 初始化区级地图
    smallMap.enableScrollWheelZoom(true); //开启鼠标滚轮缩放

    var bs = smallMap.getBounds();   //获取可视区域
    var bssw = bs.getSouthWest();   //可视区域左下角
    var bsne = bs.getNorthEast();   //可视区域右上角
    var flag=false;//坐标是否在可视区域内的判断标志

     console.log(spot);
    spot.forEach(value=>{
        var spotLng=value.slice(0,value.indexOf("-"));//传进来坐标的经度
        var spotLat=value.slice(value.indexOf("-")+1);//传进来坐标的纬度
        if((spotLng>=bssw.lng)&&(spotLng<=bsne.lng)&&(spotLat>=bssw.lat)&&(spotLat<=bsne.lat)){
            flag=true;
            console.log(flag);
         

        }
            console.log(spotLng,spotLat);
            console.log(bssw.lng,bssw.lat,bsne.lng,bsne.lat);
        flag=false;
      
    }); 

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
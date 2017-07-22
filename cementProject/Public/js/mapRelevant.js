//弹出选中地级市的小地图
function jumpToSmallMap(e, spot) {
    var p = e.target;
    var smallMap = new BMap.Map("smallMap"); // 创建地图实例  
    var centerPoint = new BMap.Point(p.getPosition().lng, p.getPosition().lat); //拿到点击地市的经纬度
    smallMap.centerAndZoom(centerPoint, 10); // 初始化区级地图
    smallMap.enableScrollWheelZoom(true); //开启鼠标滚轮缩放
    // var clickCity;//点击从城市
    var myGeo = new BMap.Geocoder(); // 创建地理编码实例   
    // 根据坐标得到地址描述    
    myGeo.getLocation(centerPoint, function(result) {
        if (result) {
            var clickCity = result.address; //转换得到点击的城市详细地址
            var clickSmallCity = clickCity.slice(3, 6); //得到点击的城市的市级城市
            spot.forEach(value => {
                var spotCity = value.slice(0, value.indexOf("市") + 1); //传进来的城市名字
                var spotWork = value.slice(value.indexOf("/") + 1, value.indexOf("-")); //传进来的工地名称
                var spotLng = value.slice(value.indexOf("-") + 1, value.lastIndexOf("-")); //传进来坐标的经度
                var spotLat = value.slice(value.lastIndexOf("-") + 1); //传进来坐标的纬度
                if (clickSmallCity == spotCity) {
                    var workPoint = new BMap.Point(spotLng, spotLat);
                    var marker = new BMap.Marker(workPoint);
                    smallMap.addOverlay(marker);
                    marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
                    var opts = {
                        position: workPoint, // 指定文本标注所在的地理位置
                        offset: new BMap.Size(20, -30) //设置文本偏移量
                    }
                    var label = new BMap.Label(spotWork, opts); // 创建文本标注对象
                    label.setStyle({
                        color: "#0CBDD8",
                        fontSize: "10px",
                        height: "15px",
                        lineHeight: "15px",
                        fontFamily: "微软雅黑",
                        border: "none"
                    });
                    marker.setLabel(label);
                }


            });


        }
    });

}

//油桶标志跳动动画且显示文字
function markJumpAndShowText(e) {
    var p = e.target;
    var centerPoint = new BMap.Point(p.getPosition().lng, p.getPosition().lat); //拿到点击地市的经纬度
    p.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
    var opts = {
        position: centerPoint, // 指定文本标注所在的地理位置
        offset: new BMap.Size(25, -30) //设置文本偏移量
    }
    var label = new BMap.Label("点击查看具体位置", opts); // 创建文本标注对象
    label.setStyle({
        color: "red",
        fontSize: "12px",
        height: "20px",
        lineHeight: "20px",
        fontFamily: "微软雅黑"
    });
    p.setLabel(label);
}

//清除跳动动画和文字
function clearJumpAndText(e) {
    var p = e.target;
    p.setAnimation(null); //取消标志点跳动的动画
    var allOverlay = bigMap.getOverlays(); //拿到所有覆盖物
    bigMap.removeOverlay(p.getLabel()); //去除标志点的文字
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




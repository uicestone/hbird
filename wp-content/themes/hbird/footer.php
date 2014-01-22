
	<script type="text/javascript" src="http://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://cdn.staticfile.org/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=fjvH5f1Gvj5xu24eapyfplh5"></script>
	<script type="text/javascript" src="<?=get_template_directory_uri()?>/js/jquery.smooth-scroll.js"></script>

	<!-- 创建地图 -->
	<script type="text/javascript">
		var map = new BMap.Map("map");                        // 创建Map实例
		map.centerAndZoom(new BMap.Point(116.404, 39.915), 11);     // 初始化地图,设置中心点坐标和地图级别
		map.addControl(new BMap.NavigationControl());               // 添加平移缩放控件
		map.addControl(new BMap.ScaleControl());                    // 添加比例尺控件
		map.addControl(new BMap.OverviewMapControl());              //添加缩略地图控件
		map.enableScrollWheelZoom();                            //启用滚轮放大缩小
		map.addControl(new BMap.MapTypeControl());          //添加地图类型控件
		map.setCurrentCity("北京");          // 设置地图显示的城市 此项是必须设置的
	</script>

	
	<?php wp_footer(); ?>
</body>
</html>

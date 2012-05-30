<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'member_header'); ?>
<script type="text/javascript">
<!--
	var charset = '<?php echo CHARSET;?>';
	var uploadurl = '<?php echo pc_base::load_config('system','upload_url')?>';
//-->
</script>
<link href="<?php echo CSS_PATH;?>dialog.css" rel="stylesheet" type="text/css" />
<style>
.s_pic_list li { float: left; overflow: hidden; text-align: center; width: 24.8%;}
.s_pic_list li img {border: 1px solid #CCCCCC; padding: 4px;}
</style>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>
<div id="memberArea">
	<?php include template('yp', 'member_left'); ?>
	<div class="col-auto">
		<div class="col-1 ">
			<h5 class="title">商铺位置标注</h5>
			<div class="content">
			<form method="post" action="index.php?m=yp&c=business&a=map&action=show_map" id="myform" name="myform">
				<div style="padding-bottom:10px; text-align:right"><input type="button" value=" 标注位置 " onclick="maps();" class="button"></div>
				<input type="hidden" name="map" id="map" value="<?php echo $memberinfo['map'];?>">
				<input type="hidden" name="dosubmit" id="dosubmit" value="1">
			</form>
				<table width="100%" cellspacing="0" class="table_form">
					<tr>
						<td><script type='text/javascript' src='http://api.map.baidu.com/api?v=1.2'></script><div id="mapObj" class="view" style="width: 100%; height:340px"></div><script type="text/javascript">
							var mapObj=null;
							<?php if($lng) { ?>
							lngX = <?php echo $lng;?>;
							latY = <?php echo $lat;?>;
							zoom = <?php echo $ZoomLevel;?>;	
							<?php } ?>
							var mapObj = new BMap.Map("mapObj");
							var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
							mapObj.addControl(ctrl_nav);
							
							mapObj.enableDragging();
							mapObj.enableScrollWheelZoom();
							mapObj.enableDoubleClickZoom();
							mapObj.enableKeyboard();//启用键盘上下左右键移动地图
							<?php if($lng) { ?>
							mapObj.centerAndZoom(new BMap.Point(lngX,latY),zoom);
							drawPoints();
							<?php } else { ?>
							mapObj.centerAndZoom("北京");
							<?php } ?>
							
							function drawPoints(){
								var myIcon = new BMap.Icon("<?php echo IMG_PATH;?>/icon/mak.png", new BMap.Size(27, 45), {anchor: new BMap.Size(10, 25)});
								var center = mapObj.getCenter();
								var point = new BMap.Point(lngX,latY);
								var marker = new BMap.Marker(point, {icon: myIcon});
								mapObj.addOverlay(marker);
							}
						</script>
						</td>
					</tr>
				</table>
			</div>
			<span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
		</div>
	</div>
</div>
<div class="clear"></div>
<script type="text/javascript">
function maps() {
	window.top.art.dialog({id:'add',iframe:'api.php?op=map&field=map&field=map&maptype=2', title:'标注商铺位置', width:'700', height:'440', lock:true}, function(){window.top.art.dialog({id:'add'}).close();$('#myform').submit();return false;}, function(){window.top.art.dialog({id:'add'}).close()});
}
</script>
<?php include template('member', 'footer'); ?>
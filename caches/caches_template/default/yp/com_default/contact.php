<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php $tpl_dir = $this->default_tpl;?>
<?php include template($tpl_dir, 'header'); ?>
<div class="main clear">
  <div class="col-auto">
  	<?php include template('yp/com_default', 'block_contact'); ?>
   	  <h2 class="crumbs">��ϵ��ʽ<span>/Contact Us</span></h2>
      	<div class="about">
        		<div class="map">
                <script type='text/javascript' src='http://api.map.baidu.com/api?v=1.2&key='></script><div id="mapObj" class="view" style="width: 490px; height:350px"></div><script type="text/javascript">
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
							mapObj.enableKeyboard();//���ü����������Ҽ��ƶ���ͼ
							<?php if($lng) { ?>
							mapObj.centerAndZoom(new BMap.Point(lngX,latY),zoom);
							drawPoints();
							<?php } else { ?>
							mapObj.centerAndZoom("����");
							<?php } ?>
							
							function drawPoints(){
								var myIcon = new BMap.Icon("<?php echo IMG_PATH;?>/icon/mak.png", new BMap.Size(27, 45), {anchor: new BMap.Size(10, 25)});
								var center = mapObj.getCenter();
								var point = new BMap.Point(lngX,latY);
								var marker = new BMap.Marker(point, {icon: myIcon});
								mapObj.addOverlay(marker);
							}
						</script>
						</div>
                <div class="lianxi">
                �� ַ�� <?php echo $array['address'];?><br />
                �� �ࣺ <?php echo $array['zip'];?><br />
                �� ���� <?php echo $array['telephone'];?><br />
                �� �棺 <?php echo $array['fax'];?><br />
                �� �䣺 <?php echo string2img($array[email],5,12);?><br />
                �� ַ�� <a href="<?php echo $array['web_url'];?>" target="_blank"><?php echo $array['web_url'];?></a> 
                </div>
        </div>
    </div>
</div>
<?php include template('yp/com_default', 'footer'); ?>

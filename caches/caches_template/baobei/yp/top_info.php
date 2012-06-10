<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>信息推荐</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link type="text/css" rel="stylesheet" href="<?php echo CSS_PATH;?>reset.css">
<link type="text/css" rel="stylesheet" href="<?php echo CSS_PATH;?>info.css">
<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>
</head>

<body>
    <div class="info-top">
        <div class="content">
        	<div class="not"></div>
		<form action="?m=yp&c=business&a=content&action=info_top_cost&modelid=<?php echo $modelid;?>" method="post" id="myform">
          <table width="100%" class="table" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th>选择推荐位置：</th>
                <td>
				<?php $n=1;if(is_array($position)) foreach($position AS $pos) { ?>
                	<?php if(!$exist_posids[$pos['posid']]) { ?><label <?php if($pos['disabled']) { ?> title="此位置信息数已满，请稍候再推"<?php } ?>><input type="checkbox" name="toptype[]"  onclick="info_top_select(this)"<?php if($pos['disabled']) { ?> disabled<?php } ?> value="<?php echo $pos['posid'];?>"/><?php echo $pos['name'];?></label><br /><?php } ?>
                <?php $n++;}unset($n); ?>
                </td>
              </tr>
              <tr>
                <th>选择置顶时长：</th>
                <td>
				<label><input type="radio" name="toptime" value="6" onclick="info_top_select(this)"/>6小时</label>
				<label><input type="radio" name="toptime" value="12" onclick="info_top_select(this)"/>12小时</label>
				<label><input type="radio" name="toptime" value="72" onclick="info_top_select(this)"/>3天</label>
				<label><input type="radio" name="toptime" value="240" onclick="info_top_select(this)">10天</label>
				<label><input type="radio" name="toptime" value="480" onclick="info_top_select(this)"/>20天</label>
				<label><input type="radio" name="toptime" value="720" onclick="info_top_select(this)"/>30天</label>
				</td>
              </tr>
              
              <tr>
                <th>&nbsp;</th>
                <td><p class="f12">此次推荐需要花费您<span class="f14 fb red" id="need_point">0</span>积分。您现在拥有<span class="f14 fb red" id="point"><?php echo $memberinfo['point'];?></span>积分，<span class="red" id="need_recharge"></span></p></td>
              </tr>
          </table>
          <input type="submit" class="dialog" value="完成置顶" name="dosubmit" id="dosubmit" />
		  <input type="hidden" value="<?php echo $modelid;?>" name="modelid"/>
		  <input type="hidden" value="<?php echo $id;?>" name="id" />
		  </form>
        </div>
    </div>
</div>
</body>
<script type="text/javascript"> 
$(function(){
	info_top_select(this);
})
$("#dosubmit").click( 
	function () { 
		art.dialog({id:'edit'}).close();
	}
);
function need_recharge() {
	var need_point = parseInt($('#need_point').html());
	var point = parseInt($('#point').html());
	var need_recharge = Number(point)-Number(need_point);
	if(need_recharge < 0) {
		$("#need_recharge").html('<a href="<?php echo APP_PATH;?>index.php?m=pay&c=deposit&a=pay" target="_blank">积分不足,马上充值'+Math.abs(need_recharge)+'积分</a>');
		$('#dosubmit').attr('disabled',"true").val('积分不足，无法充值');
	} else {
		$("#need_recharge").html('');
		$('#dosubmit').attr('disabled','');		
	}
}
function info_top_select(obj) {
	var toptime = $("input[name='toptime']:checked").attr('value');

	var chk = $("input[name='toptype[]'][type='checkbox']");
	var count = chk.length;
	var data = need_nifen = '';
	var top_data = new Array(); 
	for (var i=0; i < count; i++) {
		if(chk.eq(i).attr("checked")==true) {
			top_data += chk.eq(i).val()+'_';
		}
	}
	var select_top_type = top_data.length;
	$.post("<?php echo APP_PATH;?>index.php?m=yp&c=business&a=content&action=info_top_cost&modelid=<?php echo $modelid;?>", { toptype: top_data, toptime: toptime },
		function(data){
			$("#need_point").html(data);
			need_recharge();
		}
	);
}
</script>
</html>
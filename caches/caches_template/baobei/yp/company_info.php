<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'member_header'); ?>
<script type="text/javascript">
<!--
	var charset = '<?php echo CHARSET;?>';
	var uploadurl = '<?php echo pc_base::load_config('system','upload_url')?>';
//-->
</script>
<link href="<?php echo CSS_PATH;?>dialog.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>
<div id="memberArea">
	<?php include template('yp', 'member_left'); ?>
	<div class="col-auto">
    	<div class="col-1 ">
			<div class="tab-but cu-span"><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=company&t=3" class="on"><span>基本信息</span></a><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=company&action=logo&t=3"><span>我的资料</span></a></div>
            <div class="content">
			<form method="post" action="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=company&action=info&t=3" id="myform" name="myform">
				<table width="100%" cellspacing="0" class="table_form">
					<?php $n=1; if(is_array($forminfos)) foreach($forminfos AS $k => $v) { ?>
					<tr>
						<th width="100"><?php if($v['star']) { ?> <font color="red">*</font><?php } ?> <?php echo $v['name'];?>：</th> 
						<td><?php echo $v['form'];?><?php if($v['tips']) { ?><?php echo $v['tips'];?><?php } ?></td>
					</tr>
					<?php $n++;}unset($n); ?>
					<tr>
						<th></th>
						<td>
						<input name="forward" type="hidden" value="<?php echo HTTP_REFERER;?>">
						<input name="modelid" type="hidden" value="<?php echo $modelid;?>">
						<input name="dosubmit" type="submit" id="dosubmit" value="<?php echo L('submit');?>" class="button"></td>
					</tr>
				</table>
			</form>
			</div>
			<span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
		</div>
	</div>
</div>
<div class="clear"></div>
<script type="text/javascript"> 
<!--
//只能放到最下面
$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, 	function(){$(obj).focus();
	boxid = $(obj).attr('id');
	if($('#'+boxid).attr('boxid')!=undefined) {
		check_content(boxid);
	}
	})}});
	<?php echo $formValidator;?>

	$('#myform').submit(function (){
		/*
		if ($("#catids option").size()<1){
			alert('请选择企业库类型！');
			return false;
		} else {
			$("#catids option").each(function() {
				$(this).attr('selected','selected');
			});
		}
		*/
		return true;
	});
})
//-->
</script>
<?php include template('member', 'footer'); ?>
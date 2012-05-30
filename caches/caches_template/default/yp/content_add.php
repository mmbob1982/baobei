<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'member_header'); ?>
<script type="text/javascript">
<!--
	var charset = '<?php echo CHARSET;?>';
	var uploadurl = '<?php echo pc_base::load_config('system','upload_url')?>';
//-->
</script>
<link href="<?php echo CSS_PATH;?>dialog.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>content_addtop.js"></script>
<div id="memberArea">
	<?php include template('yp', 'member_left'); ?>
	<div class="col-auto">
		<div class="col-1 ">
			<h5 class="title">信息发布</h5>
			<div class="content">
			<form method="post" action="?m=yp&c=business&a=content&action=add&modelid=<?php echo $modelid;?>" id="myform" name="myform">
				<table width="100%" cellspacing="0" class="table_form">
					<?php $n=1; if(is_array($forminfos)) foreach($forminfos AS $k => $v) { ?>
					<tr>
						<th width="100"><?php if($v['star']) { ?> <font color="red">*</font><?php } ?> <?php echo $v['name'];?>：</th> 
						<td><?php echo $v['form'];?><?php if($v['tips']) { ?><?php echo $v['tips'];?><?php } ?></td>
					</tr>
					<?php $n++;}unset($n); ?>
				</table>
                <div id="addition_param" style="display:none;">
                    <h5>附加参数</h5>
                    <table width="100%" cellspacing="0" class="table_form">
                        <tbody id="addition_content">
                        </tbody>
                    </table>
                </div>
				<table width="100%" cellspacing="0" class="table_form">
					<tr>
						<th width="100"></th>
						<td>
						<input name="forward" type="hidden" value="<?php echo HTTP_REFERER;?>">
						<input name="dosubmit" type="submit" id="dosubmit" value="　　<?php echo L('submit');?>　　" class="button"></td>
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
})

function get_additional(obj) {
	var modelid = <?php echo $modelid;?>;
	var catid = obj.value;
	$.get('<?php echo APP_PATH;?>index.php', {m:'yp', c:'business', a:'content', action:'get_addition', modelid:modelid, catid:catid}, function (data) {
		if (data) {
			var obj = eval( "(" + data + ")" );
			var string = '';
			for (var one in obj) {
				string += '<tr><th width="100"> '+obj[one].name+'：</th>';
				string += '<td>'+obj[one].form+'</td>';
			}
			$('#addition_param').show();
			$('#addition_content').html(string);
		} else {
			$('#addition_param').hide();
			$('#addition_content').html();
		}
	})
}
//-->
</script>
<?php include template('member', 'footer'); ?>
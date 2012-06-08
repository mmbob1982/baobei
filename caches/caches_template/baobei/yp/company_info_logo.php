<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'member_header'); ?>
<link href="<?php echo CSS_PATH;?>dialog.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>
<div id="memberArea">
	<?php include template('yp', 'member_left'); ?>
	<div class="col-auto">
		<div class="col-1 ">
			<div class="tab-but cu-span"><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=company&t=3"><span>基本信息</span></a><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=company&action=logo&t=3"  class="on"><span>我的资料</span></a></div>
			<div class="content">
				
			<form method="post" action="" id="myform" name="myform">
				<table width="100%" cellspacing="0" class="table_form">
					<tr>
						<th width="100"> <font color="red">*</font> Logo：</th> 
						<td><?php echo form::images('info[logo]', 'logo', $memberinfo[logo], 'yp', '', 55, 'input-text');?></td>
					</tr>
					<tr>
						<th width="100"> Banner：</th> 
						<td><?php echo form::images('info[banner]', 'banner', $memberinfo[banner], 'yp', '', 55, 'input-text');?> </td>
					</tr>
					<tr>
						<th width="100"> 联系人：</th> 
						<td><input type="text" name="info[linkman]" id="linkman" size="15" value="<?php echo $memberinfo['linkman'];?>" class="input-text"  ></td>
					</tr>
					<tr>
						<th width="100"> Email：</th> 
						<td><input type="text" name="info[email]" id="email" size="30" value="<?php echo $memberinfo['email'];?>" class="input-text"  ></td>
					</tr>
					<tr>
						<th width="100"> 联系电话：</th> 
						<td><input type="text" name="info[telephone]" id="telephone" size="15" value="<?php echo $memberinfo['telephone'];?>" class="input-text"  ></td>
					</tr>
					<tr>
						<th width="100"> 公司简介：</th> 
						<td><textarea id="introduce" name="info[introduce]"><?php echo $memberinfo['introduce'];?></textarea><?php echo form::editor('info[introduce]','full','','','','1','0');?></td>
					</tr>
					<tr>
						<th width="100"> 传真：</th> 
						<td><input type="text" name="info[fax]" id="fax" size="15" value="<?php echo $memberinfo['fax'];?>" class="input-text"  ></td>
					</tr>
					<tr>
						<th width="100"> 邮编：</th> 
						<td><input type="text" name="info[zip]" id="zip" size="10" value="<?php if($memberinfo['zip']) { ?><?php echo $memberinfo['zip'];?><?php } ?>" class="input-text"  ></td>
					</tr>
					<tr>
						<th></th>
						<td>
						<input name="forward" type="hidden" value="<?php echo HTTP_REFERER;?>">
						<input name="modelid" type="hidden" value="<?php echo $modelid;?>">
						<input name="dosubmit" type="submit" id="dosubmit" value="　<?php echo L('submit');?>　" class="button"></td>
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
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform"});
	$("#logo").formValidator({onshow:"请上传logo",onfocus:"请上传logo"}).inputValidator({min:1,onerror:"必须上传logo"})<?php if($memberinfo[logo]) { ?>.defaultPassed()<?php } ?>;
	$("#banner").formValidator({onshow:"上传商家Banner",onfocus:"留空则显示默认",oncorrect:"输入正确",defaultvalue:""}).inputValidator({}).defaultPassed();
	$("#linkman").formValidator({onshow:"请输入联系人姓名",onfocus:"请输入联系人姓名",oncorrect:"输入正确"}).inputValidator({}).defaultPassed();
	$("#email").formValidator({onshow:"请输入Email地址",onfocus:"请输入Email地址",oncorrect:"输入正确"}).inputValidator({}).defaultPassed();
	$("#fax").formValidator({onshow:"请输入传真号码",onfocus:"请输入传真号码",oncorrect:"输入正确"}).inputValidator({}).defaultPassed();
	$("#telephone").formValidator({onshow:"请输入联系电话",onfocus:"请输入联系电话",oncorrect:"输入正确"}).inputValidator({}).defaultPassed();
	$("#zip").formValidator({onshow:"请输入邮编",onfocus:"请输入邮编",oncorrect:"输入正确"}).inputValidator({}).defaultPassed();
})
 
//-->
</script>

<?php include template('member', 'footer'); ?>
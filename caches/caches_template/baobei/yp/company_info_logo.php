<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'member_header'); ?>
<link href="<?php echo CSS_PATH;?>dialog.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>
<div id="memberArea">
	<?php include template('yp', 'member_left'); ?>
	<div class="col-auto">
		<div class="col-1 ">
			<div class="tab-but cu-span"><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=company&t=3"><span>������Ϣ</span></a><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=company&action=logo&t=3"  class="on"><span>�ҵ�����</span></a></div>
			<div class="content">
				
			<form method="post" action="" id="myform" name="myform">
				<table width="100%" cellspacing="0" class="table_form">
					<tr>
						<th width="100"> <font color="red">*</font> Logo��</th> 
						<td><?php echo form::images('info[logo]', 'logo', $memberinfo[logo], 'yp', '', 55, 'input-text');?></td>
					</tr>
					<tr>
						<th width="100"> Banner��</th> 
						<td><?php echo form::images('info[banner]', 'banner', $memberinfo[banner], 'yp', '', 55, 'input-text');?> </td>
					</tr>
					<tr>
						<th width="100"> ��ϵ�ˣ�</th> 
						<td><input type="text" name="info[linkman]" id="linkman" size="15" value="<?php echo $memberinfo['linkman'];?>" class="input-text"  ></td>
					</tr>
					<tr>
						<th width="100"> Email��</th> 
						<td><input type="text" name="info[email]" id="email" size="30" value="<?php echo $memberinfo['email'];?>" class="input-text"  ></td>
					</tr>
					<tr>
						<th width="100"> ��ϵ�绰��</th> 
						<td><input type="text" name="info[telephone]" id="telephone" size="15" value="<?php echo $memberinfo['telephone'];?>" class="input-text"  ></td>
					</tr>
					<tr>
						<th width="100"> ��˾��飺</th> 
						<td><textarea id="introduce" name="info[introduce]"><?php echo $memberinfo['introduce'];?></textarea><?php echo form::editor('info[introduce]','full','','','','1','0');?></td>
					</tr>
					<tr>
						<th width="100"> ���棺</th> 
						<td><input type="text" name="info[fax]" id="fax" size="15" value="<?php echo $memberinfo['fax'];?>" class="input-text"  ></td>
					</tr>
					<tr>
						<th width="100"> �ʱࣺ</th> 
						<td><input type="text" name="info[zip]" id="zip" size="10" value="<?php if($memberinfo['zip']) { ?><?php echo $memberinfo['zip'];?><?php } ?>" class="input-text"  ></td>
					</tr>
					<tr>
						<th></th>
						<td>
						<input name="forward" type="hidden" value="<?php echo HTTP_REFERER;?>">
						<input name="modelid" type="hidden" value="<?php echo $modelid;?>">
						<input name="dosubmit" type="submit" id="dosubmit" value="��<?php echo L('submit');?>��" class="button"></td>
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
	$("#logo").formValidator({onshow:"���ϴ�logo",onfocus:"���ϴ�logo"}).inputValidator({min:1,onerror:"�����ϴ�logo"})<?php if($memberinfo[logo]) { ?>.defaultPassed()<?php } ?>;
	$("#banner").formValidator({onshow:"�ϴ��̼�Banner",onfocus:"��������ʾĬ��",oncorrect:"������ȷ",defaultvalue:""}).inputValidator({}).defaultPassed();
	$("#linkman").formValidator({onshow:"��������ϵ������",onfocus:"��������ϵ������",oncorrect:"������ȷ"}).inputValidator({}).defaultPassed();
	$("#email").formValidator({onshow:"������Email��ַ",onfocus:"������Email��ַ",oncorrect:"������ȷ"}).inputValidator({}).defaultPassed();
	$("#fax").formValidator({onshow:"�����봫�����",onfocus:"�����봫�����",oncorrect:"������ȷ"}).inputValidator({}).defaultPassed();
	$("#telephone").formValidator({onshow:"��������ϵ�绰",onfocus:"��������ϵ�绰",oncorrect:"������ȷ"}).inputValidator({}).defaultPassed();
	$("#zip").formValidator({onshow:"�������ʱ�",onfocus:"�������ʱ�",oncorrect:"������ȷ"}).inputValidator({}).defaultPassed();
})
 
//-->
</script>

<?php include template('member', 'footer'); ?>
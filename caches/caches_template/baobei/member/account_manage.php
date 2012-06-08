<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('member', 'header'); ?>
<div id="memberArea">
<?php include template('member', 'account_manage_left'); ?>
<div class="col-auto">
	<div class="col-1 ">
		<h5 class="title"><?php echo L('memberinfo');?>£º</h5>
		<div class="content">
		<div class="col-1 member-info">
		<div class="content">
			<div class="col-left himg">
				<a title="<?php echo L('modify').L('avatar');?>" href="index.php?m=member&c=index&a=account_manage_avatar&t=1"><img src="<?php echo $avatar['90'];?>" width="60" height="60" onerror="this.src='<?php echo $phpsso_api_url;?>/statics/images/member/nophoto.gif'"></a>
			</div>
			<div class="col-auto">
				<h5><?php if($memberinfo['vip']) { ?><img src="<?php echo IMG_PATH;?>icon/vip.gif"><?php } elseif ($memberinfo['overduedate']) { ?><img src="<?php echo IMG_PATH;?>icon/vip-expired.gif" title="<?php echo L('overdue');?>£¬<?php echo L('overduedate');?>£º<?php echo format::date($memberinfo['overduedate'],1);?>"><?php } ?>
				<font color="<?php echo $grouplist[$memberinfo['groupid']]['usernamecolor'];?>">
				<?php if($memberinfo['nickname']) { ?> <?php echo $memberinfo['nickname'];?> <?php } else { ?> <?php echo $memberinfo['username'];?><?php } ?> 
				</font>
				<?php if($memberinfo['email']) { ?>£¨<?php echo $memberinfo['email'];?>£©<?php } ?></h5>
				<p class="blue">
				<?php echo L('member_group');?>£º<?php echo $grouplist[$memberinfo['groupid']]['name'];?>£¬
				<?php echo L('account_remain');?>£º<font style="color:#F00; font-size:22px;font-family:Georgia,Arial; font-weight:700"><?php echo $memberinfo['amount'];?></font> <?php echo L('unit_yuan');?>£¬
				<?php echo L('point');?>£º<font style="color:#F00; font-size:12px;font-family:Georgia,Arial; font-weight:700"><?php echo $memberinfo['point'];?></font> <?php echo L('unit_point');?><?php if($memberinfo['vip']) { ?>£¬vip<?php echo L('overduedate');?>£º<font style="color:#F00; font-size:12px;font-family:Georgia,Arial; font-weight:700"><?php echo format::date($memberinfo['overduedate']);?></font><?php } ?>
				</p>
			</div>
		</div>
	</div>

	<div class="bk10"></div>	
	<div class="col-1 ">
		<h5 class="title"><?php echo L('more_configuration');?>£º</h5>
		<div class="content">
				<table width="100%" cellspacing="0" class="table_form">
					<tr>
						<th width="120"><?php echo L('username');?></th>        
						<td><?php echo $memberinfo['username'];?></td>
					</tr>
					<tr>
						<th width="120"><?php echo L('in_model');?>£º</th>        
						<td><?php echo $member_model[$memberinfo['modelid']]['name'];?></td>
					</tr>
					<tr>
						<th width="120"><?php echo L('regtime');?>£º</th>        
						<td><?php echo FORMAT::date($memberinfo['regdate'] ,1);?></td>
					</tr>
					<tr>
						<th width="120"><?php echo L('lastlogintime');?>£º</th>        
						<td><?php echo FORMAT::date($memberinfo['lastdate'] ,1);?></td>
					</tr>
					<tr>
						<th width="120"><?php echo L('regip');?>£º</th>        
						<td><?php echo $memberinfo['regip'];?></td>
					</tr>
					<tr>
						<th width="120"><?php echo L('lastip');?>£º</th>        
						<td><?php echo $memberinfo['lastip'];?></td>
					</tr>
					<?php $n=1; if(is_array($member_modelinfo)) foreach($member_modelinfo AS $k => $v) { ?>
					<tr>
						<th width="120"><?php echo $k;?>£º</th>        
						<td><?php echo $v;?></td>
					</tr>
					<?php $n++;}unset($n); ?>
				</table>
		</div>
	</div>
</div>
</div>
</div>
<div class="clear"></div>
<?php include template('member', 'footer'); ?>
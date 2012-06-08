<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'member_header'); ?>
<script type="text/javascript">
<!--
	var charset = '<?php echo CHARSET;?>';
	var uploadurl = '<?php echo pc_base::load_config('system','upload_url')?>';
//-->
</script>
<div id="memberArea">
	<?php include template('yp', 'member_left'); ?>
	<div class="col-auto">
		<div class="col-1 clear">
		  <h5 class="title">模板选择</h5>
			<div class="content">
			<form method="post" action="" id="myform" name="myform">
            <?php $n=1;if(is_array($companytplnames)) foreach($companytplnames AS $tpl) { ?>
            	<div class="temp-list"<?php if($n%3==0) { ?> style="margin-right:0"<?php } ?>>
                	<a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=preview_template&tplname=<?php echo $tpl['dir'];?>" target="_blank" class="img"><img src="<?php echo thumb($tpl['thumb'], 98,98);?>" width="98" height="98" title="预览"></a>
                    <ul>
                    	<li><?php echo $tpl['title'];?> <?php if($memberinfo['tplname']==$tpl['dir']) { ?> <font color="red">√</font><?php } ?></li>
                        <li>作者：站点管理员</li>
                        <li><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=preview_template&tplname=<?php echo $tpl['dir'];?>
" target="_blank">预览</a> | <a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=set_default_tpl&tplname=<?php echo $tpl['dir'];?>&name=<?php echo $tpl['title'];?>">启用</a></li>
                    </ul>
                </div>
            <?php $n++;}unset($n); ?>
			</form>
			</div>
			<span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
		</div>
	</div>
</div>
<div class="clear"></div>

<?php include template('member', 'footer'); ?>
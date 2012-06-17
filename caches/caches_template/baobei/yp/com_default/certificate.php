<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php $tpl_dir = $this->default_tpl;?>
<?php include template($tpl_dir, 'header'); ?>
<div class="main clear">
  <div class="col-auto">
  	<?php include template('yp/com_default', 'block_contact'); ?>
   	  <h2 class="crumbs">»Ÿ”˛◊ ÷ <span>/PRODUCTS</span></h2>
   	 		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=747c0f92712aa435b7acde10c61c5127&action=get_certificate&userid=%24array%5Buserid%5D&status=1&num=10&order=addtime+desc&cache=0&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">±‡º≠</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'get_certificate')) {$pagesize = 10;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$yp_total = $yp_tag->count(array('userid'=>$array[userid],'status'=>'1','order'=>'addtime desc','limit'=>$offset.",".$pagesize,'action'=>'get_certificate',));$pages = pages($yp_total, $page, $pagesize, $urlrule);$data = $yp_tag->get_certificate(array('userid'=>$array[userid],'status'=>'1','order'=>'addtime desc','limit'=>$offset.",".$pagesize,'action'=>'get_certificate',));}?>
	            <ul class="rongyu-list picbig clear">
	            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>    
				<li>
				<div class="img-wrap">
				<a href="<?php echo $r['thumb'];?>" title="<?php echo $r['name'];?>" target="_blank"><img style="height: 285px; width: 250px;" src="<?php echo $r['thumb'];?>" title="<?php echo $r['name'];?>"></a>
				</div>
				<a href="<?php echo $r['thumb'];?>" title="<?php echo $r['name'];?>" target="_blank"><?php echo $r['name'];?></a>
				</li>
				<?php $n++;}unset($n); ?>
	            </ul>
	            <div id="pages" class="text-c"><?php echo $pages;?></div>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
</div>
<?php include template('yp/com_default', 'footer'); ?>

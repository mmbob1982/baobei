<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php $tpl_dir = $this->default_tpl;?>
<?php include template($tpl_dir, 'header'); ?>
<div class="main clear">
  <div class="col-auto">
  	<?php include template($tpl_dir, 'block_contact'); ?>
   	  <h2 class="crumbs">商机<span>/Business Opportunity</span></h2>
    <div class="sub-nav">商机分类：<?php if($catid) { ?><a href="<?php echo compute_company_url('model', array('catid'=>0));?>"><?php } ?>全部<?php if($catid) { ?></a><?php } ?><?php $n=1; if(is_array($catid_arr)) foreach($catid_arr AS $cid => $c) { ?>
	<?php if($catid!=$cid) { ?><a href="<?php echo compute_company_url('model', array('catid'=>$cid));?>"><?php } ?>
	<?php echo $categorys[$cid]['catname'];?>(<?php echo $c['num'];?>)
	<?php if($catid!=$cid) { ?></a><?php } ?> 
	<?php $n++;}unset($n); ?></div>
		 <?php $urlrule = yp_makeurlrule(); $b_type = array('1'=>'供应', '2'=>'求购', '3'=>'二手', '4'=>'促销',);$sql = " `userid`='".$array[userid]."'";?>
		 <?php intval($catid) ? $sql .= " AND `catid`=$catid" : ''; if (intval($_GET['tid'])) $sql .= " AND `tid`='".intval($_GET['tid'])."'";?>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=71e1976f89e1b3ff302a1d47abcaea6c&action=lists&where=%24sql&modelid=%24modelid&num=15&order=inputtime+desc&page=%24page&urlrule=%24urlrule\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$pagesize = 15;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$yp_total = $yp_tag->count(array('where'=>$sql,'modelid'=>$modelid,'order'=>'inputtime desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($yp_total, $page, $pagesize, $urlrule);$data = $yp_tag->lists(array('where'=>$sql,'modelid'=>$modelid,'order'=>'inputtime desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
		  <ul class="news-list">
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li><h2><a href="<?php echo compute_company_url('model', array('tid'=>$r['tid']));?>" class="blue fn" target="_blank">[<?php echo $b_type[$r['tid']];?>]</a> <a href="<?php echo compute_company_url('show', array('catid'=>$r['catid'], 'id'=>$r['id'], 'page'=>1));?>" title="<?php echo $r['title'];?>" target="_blank"><?php echo $r['title'];?></a><span><?php echo date("Y-m-d H:i:s",$r[inputtime]);?></span>
                </h2>
                <?php if($r[description]) { ?><p><?php echo str_cut($r[description],200,'....');?></p><?php } ?>
                </li>
			<?php $n++;}unset($n); ?>
		 </ul>
		 <div id="pages" class="text-c"><?php echo $pages;?></div>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
               
	</div>
</div>
<?php include template($tpl_dir, 'footer'); ?>
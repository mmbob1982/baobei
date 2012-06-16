<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php $tpl_dir = $this->default_tpl;?>
<?php include template($tpl_dir, 'header'); ?>
<div class="main clear">
  <div class="col-auto">
  	<?php include template('yp/com_default', 'block_contact'); ?>
   	  <h2 class="crumbs">产品中心<span>/PRODUCTS</span></h2>
    <div class="sub-nav">产品分类：<?php if($catid) { ?><a href="<?php echo compute_company_url('model', 0);?>"><?php } ?>全部<?php if($catid) { ?></a><?php } ?><?php $n=1; if(is_array($catid_arr)) foreach($catid_arr AS $cid => $c) { ?>
	<?php if($catid!=$cid) { ?><a href="<?php echo compute_company_url('model', array('catid'=>$cid, 'id'=>0, 'page'=>1));?>"><?php } ?>
	<?php echo $categorys[$cid]['catname'];?>(<?php echo $c['num'];?>)
	<?php if($catid!=$cid) { ?></a><?php } ?> 
	<?php $n++;}unset($n); ?></div>
    		  <?php $urlrule = yp_makeurlrule();?>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=3cf3c907a22db40cee8da2f915807b1f&action=lists&userid=%24array%5Buserid%5D&modelid=%24modelid&catid=%24catid&num=15&order=inputtime+DESC&page=%24page&urlrule=%24urlrule\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$pagesize = 15;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$yp_total = $yp_tag->count(array('userid'=>$array[userid],'modelid'=>$modelid,'catid'=>$catid,'order'=>'inputtime DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($yp_total, $page, $pagesize, $urlrule);$data = $yp_tag->lists(array('userid'=>$array[userid],'modelid'=>$modelid,'catid'=>$catid,'order'=>'inputtime DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
              <ul class="products-list picbig clear">
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    <li>
                    <div class="img-wrap">
                    <a href="<?php echo compute_company_url('show', array('catid'=>$r['catid'], 'id'=>$r['id'], 'page'=>1));?>" title="<?php echo $r['title'];?>"><img src="<?php echo $r['thumb'];?>" title="<?php echo $r['title'];?>"></a>
                    </div>
                    <a href="<?php echo compute_company_url('show', array('catid'=>$r['catid'], 'id'=>$r['id'], 'page'=>1));?>" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></a>
                    </li> 
                <?php $n++;}unset($n); ?>
             </ul>
             <div id="pages" class="text-c"><?php echo $pages;?></div>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
               
        </div>
</div>
<?php include template('yp/com_default', 'footer'); ?>

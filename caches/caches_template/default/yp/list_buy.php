<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'header'); ?>
<!--main-->
<div class="main clear">
	<div class="crumbs" style="margin-bottom:0"><a href="<?php echo APP_PATH;?>">首页</a><span> &gt; </span><a href="<?php echo get_yp_url();?>">企业黄页</a> &gt; <a href="<?php echo get_yp_url('model', $modelid);?>">商机</a> &gt; 列表</div>
    <div class="box cat-data" id="PropSingle">
    	<div class="choosed"><strong class="ib">您已选择:</strong><?php if(is_array($parent_url) && !empty($parent_url)) { ?><a href="<?php echo $parent_url['url'];?>" class=""><?php echo $parent_url['title'];?></a><?php } ?><?php $n=1;if(is_array($filter)) foreach($filter AS $fil) { ?><a href="<?php echo $fil['url'];?>"><?php echo $fil['title'];?></a><?php $n++;}unset($n); ?></div>
		<?php if($cat_arr) { ?>
    	<dl class="clear">
        	<dt><strong>分类：</strong></dt>
            <dd class="AttrBox clear">
			<?php $fdata = yp_filters('catid',$modelid,$cat_arr,0);?>
			<?php $n=1;if(is_array($fdata)) foreach($fdata AS $r) { ?>
				<?php echo $r['menu'];?>
			<?php $n++;}unset($n); ?>
			</dd>
        </dl> 
		<?php } ?>
		<dl class="clear">
        	<dt><strong>类别：</strong></dt>
            <dd class="AttrBox clear">
			<?php $n=1;if(is_array(yp_filters('tid',$modelid))) foreach(yp_filters('tid',$modelid) AS $r) { ?>
				<?php echo $r['menu'];?>
			<?php $n++;}unset($n); ?>
			</dd>
        </dl> 
		<?php $areaid = intval($_GET['areaid']); $linkage_data = yp_show_linkage(1, 'areaid', $areaid, $modelid);?>
		<?php if($linkage_data) { ?>
		<dl class="clear">
        	<dt><strong>地区：</strong></dt>
            <dd class="AttrBox clear">
			<?php $n=1;if(is_array($linkage_data)) foreach($linkage_data AS $r) { ?>
				<a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a> 
			<?php $n++;}unset($n); ?>
			</dd>
        </dl> 
		<?php } ?>
    </div>
    <div class="col-left">
    	<div class="category-main box generic info-content">
        	<div class="title">
                <div class="orderby-select mouseover" type="select" heights="23" position="0">
                	<div class="select"><?php if($_GET['order']=='1') { ?> <a class="up" >更新时间升序</a><?php } elseif ($_GET['order']=='2') { ?> <a class="down" >更新时间降序</a><?php } else { ?><a class="null" >请选择排序方式</a><?php } ?></div>
                    <ul class="selectlist subselect_0" style="display:none;">
						<li><a class="null" onclick="javascript:void(0);">请选择排序方式</a></li>
						<li><a class="up" href="<?php echo $current_url;?>&order=1">更新时间升序</a></li>
                        <li><a class="down" href="<?php echo $current_url;?>&order=2">更新时间降序</a></li>
					</ul>
                </div>
<strong>
<?php 
$now_tid = $_GET['tid'];
switch ($now_tid){
case '1':
  echo '供应';
  break;  
case '2':
  echo '求购';
  break;
case '3':
  echo '二手';
  break;
case '4':
  echo '促销';
  break;
default:
  echo '供应';
} 
?>信息
</strong></div>
            <ul class="info-top">
            	<li class="pic"></li>
                <li class="jiage">价格</li>
                <li class="vip">诚信</li>
                <li class="info">信息/公司</li>
            </ul>
			<?php $sql = yp_filters_sql($modelid);$y=1;$lisrorder = array('1'=>'updatetime ASC', 'updatetime DESC');?>
			<?php $order = $_GET['order'] ? $listorder[intval($_GET['order'])] : 'updatetime DESC'?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=f7af3b7e757c643e9dd9ee8ab971bab8&action=position&posid=%24posid&modelid=%24modelid&catid=%24catid&order=listorder+asc&num=5&expiration=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'position')) {$data = $yp_tag->position(array('posid'=>$posid,'modelid'=>$modelid,'catid'=>$catid,'order'=>'listorder asc','expiration'=>'1','limit'=>'5',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			 <?php $userid = get_memberinfo_buyusername($r['username'], 'userid');$memberinfo = get_companyinfo($userid, 'companyname, publish_total, url');$publish_total = string2array($memberinfo['publish_total']);?>
            <ul class="info-item clear"<?php if($y==1) { ?> style="border-top:none"<?php } ?>>
				<li class="pic"><div class="img-wrap">
					<a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><img src="<?php echo $r['thumb'];?>" title="<?php echo $r['title'];?>"></a></div>
				</li>
                <li class="jiage"><strong>&yen;2800</strong></li>
                <li class="vip"><?php echo get_company_rank($r['userid']);?></li>
                <li class="info">
                    <h2><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></a></h2>
                    <p>商家：<a href="<?php echo $memberinfo['url'];?>" target="_blank" class="blue"><?php echo $memberinfo['companyname'];?></a><br />
                       更新日期：<?php echo date("Y-m-d",$r[updatetime]);?>
					</p>
                </li>	
			</ul>
			<?php $y++;?>
				<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php $urlrule = yp_makeurlrule();?>
 			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=92ae13e7248ee48d72f659fb0e2099fc&action=lists&where=%24sql&modelid=%24modelid&order=%24order&num=10&urlrule=%24urlrule\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('where'=>$sql,'modelid'=>$modelid,'order'=>$order,'limit'=>'10',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			 <?php $memberinfo = get_companyinfo($r['userid'], 'companyname, publish_total, url');$publish_total = string2array($memberinfo['publish_total']);?>
			<ul class="info-item clear"<?php if($y==1) { ?> style="border-top:none"<?php } ?>>
				<li class="pic"><div class="img-wrap">
					<a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><img src="<?php echo $r['thumb'];?>" title="<?php echo $r['title'];?>"></a></div>
				</li>
                <li class="jiage"><strong>&yen;2800</strong></li>
                <li class="vip"><?php echo get_company_rank($r['userid']);?></li>
            	<li class="info">
                    <h2><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></a></h2>
                    <p>商家：<a href="<?php echo $memberinfo['url'];?>" target="_blank" class="blue"><?php echo $memberinfo['companyname'];?></a><br />
                       更新日期：<?php echo date("Y-m-d",$r[updatetime]);?>
					</p>
                </li>
            </ul>
			<?php $y++;?>
			<?php $n++;}unset($n); ?>
			 <div id="pages" class="text-c"><?php echo $pages;?></div>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
         </div>
    </div>
    <div class="col-auto">
    	<div class="box box-tab fillet fillet-blue">
        	<ul class="tab clear swap-tab cu-li">
            	<li class="on">推荐商机信息</li>
                <li>最新商机信息</li>
            </ul>
        	<div class="swap-content">
			<?php $buy_type = $this->buy_type;?>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=4fd2dd971ac6c88d4bd5b783a2aad7e7&action=position&posids=%24this-%3Eglobal_posid&modelid=%24modelid&order=listorder+asc&num=10&expiration=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'position')) {$data = $yp_tag->position(array('posids'=>$this->global_posid,'modelid'=>$modelid,'order'=>'listorder asc','expiration'=>'1','limit'=>'10',));}?>
	            <ul class="list-num">
				 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		            <li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo yp_filters_url('tid', array('tid'=>$r['tid'], 'catid'=>$r['catid']), 2, $modelid);?>" class="blue" target="_blank">[<?php echo $buy_type[$r['tid']];?>]</a> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 30);?></a></li>
		         <?php $n++;}unset($n); ?>
	            </ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	        	<ul class="list-num" style="display:none;">
	             <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=2f390e9f0fcedbf663681ad1b92f5902&action=lists&modelid=%24modelid&order=id+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('modelid'=>$modelid,'order'=>'id DESC','limit'=>'10',));}?>
	         	  <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		            <li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo yp_filters_url('tid', array('tid'=>$r['tid'], 'catid'=>$r['catid']), 2, $modelid);?>" class="blue" target="_blank">[<?php echo $buy_type[$r['tid']];?>]</a> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 30);?></a></li>
			      <?php $n++;}unset($n); ?>
				 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	            </ul>
             </div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    	<div class="bk10"></div>
        <div class="box box-tab fillet fillet-blue">
        	<ul class="tab clear swap-tab cu-li">
            	<li class="on">24小时热点商机</li>
                <li>本周热点商机</li>
            </ul>
			<div class="swap-content">
			<?php $buy_type = $this->buy_type;?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=c66093604542aad9e71ace753402a8eb&action=hits&modelid=%24modelid&day=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'hits')) {$data = $yp_tag->hits(array('modelid'=>$modelid,'day'=>'1','limit'=>'20',));}?>
				<ul class="list-num">
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo yp_filters_url('tid', array('tid'=>$r['tid'], 'catid'=>$r['catid']), 2, $modelid);?>" class="blue" target="_blank">[<?php echo $buy_type[$r['tid']];?>]</a> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 30);?></a></li>
					<?php $n++;}unset($n); ?>
				</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=65181f81cfa89f22645399d8a37a16ae&action=hits&modelid=%24modelid&order=weekviews+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'hits')) {$data = $yp_tag->hits(array('modelid'=>$modelid,'order'=>'weekviews DESC','limit'=>'20',));}?>
				<ul class="list-num" style="display:none;">
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo yp_filters_url('tid', array('tid'=>$r['tid'], 'catid'=>$r['catid']), 2, $modelid);?>" class="blue" target="_blank">[<?php echo $buy_type[$r['tid']];?>]</a> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 30);?></a></li>
					<?php $n++;}unset($n); ?>
				</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    </div>
</div>
<?php include template('yp', 'footer'); ?>
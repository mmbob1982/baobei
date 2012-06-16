<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'header'); ?>
<!--main-->
<div class="main clear">
	<div class="crumbs" style="margin-bottom:0"><a href="<?php echo APP_PATH;?>">首页</a><span> &gt; </span><a href="<?php echo APP_PATH;?>index.php?m=yp">黄页</a> &gt;品牌库列表</div>
	
	 <div class="box cat-data" id="PropSingle">
    	<div class="choosed"><strong class="ib">您已选择:</strong><?php if(is_array($parent_url) && !empty($parent_url)) { ?><a href="<?php echo $parent_url['url'];?>" class=""><?php echo $parent_url['title'];?></a><?php } ?></div>
		<?php if($company_fenlei[$catid][child]!='0') { ?>
    	<dl class="clear">
        	<dt><strong>分类：</strong></dt>
            <dd class="AttrBox clear">
			<?php $arr_parentid = yp_subcat($catid, $modelid);?>
			<?php $n=1;if(is_array($arr_parentid)) foreach($arr_parentid AS $k) { ?>
			<a title="<?php echo $k['catname'];?>" href="<?php echo $k['url'];?>"><?php echo $k['catname'];?></a>
			<?php $n++;}unset($n); ?>
			</dd>
        </dl> 
		<?php } ?>  
    </div>
    <div class="col-left picbig">
    	<div class="category-main box generic info-content">
        	<div class="title">
                <div class="orderby-select mouseover" type="select" heights="23" position="0" style="display:none">
                	<div class="select"><a class="up" href="">更新时间排序</a></div>
                    <ul class="selectlist subselect_0" style="display:none;"><li><a class="null" href="">请选择排序方式</a></li><li><a class="up" href="">更新时间排序</a></li><li><a class="up" href="">诚信等级由到高到低</a></li><li><a class="down" href="">诚信等级由低到低高</a></li></ul>
                </div>
<strong>品牌库信息列表</strong></div>
            <ul class="info-top">
            	<li class="pic"></li>
                <li class="vip" style="width:110px">会员等级</li>
                <li class="info">公司信息</li>
            </ul>
           
           <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=e1acc92212901bb8aaea1b3d17077c5a&sql=select+b.%2A+from+phpcms_yp_brand+b+%24catid_p_str+%24catid_str+%24where+&order=b.id+desc&num=10&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$pagesize = 10;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$r = $get_db->sql_query("SELECT COUNT(*) as count FROM  phpcms_yp_brand b $catid_p_str $catid_str $where ");$s = $get_db->fetch_next();$pages=pages($s['count'], $page, $pagesize, $urlrule);$r = $get_db->sql_query("select b.* from phpcms_yp_brand b $catid_p_str $catid_str $where  LIMIT $offset,$pagesize");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
           		<?php print_r($data);exit;?>
           <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
           
           
           <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=3f2ab488cd5cf8ef8da3b108563df3f9&action=get_company_byfenlei&catid=%24catid&num=3&cache=0&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'get_company_byfenlei')) {$pagesize = 3;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$yp_total = $yp_tag->count(array('catid'=>$catid,'limit'=>$offset.",".$pagesize,'action'=>'get_company_byfenlei',));$pages = pages($yp_total, $page, $pagesize, $urlrule);$data = $yp_tag->get_company_byfenlei(array('catid'=>$catid,'limit'=>$offset.",".$pagesize,'action'=>'get_company_byfenlei',));}?>
           <?php $n=1;if(is_array($data)) foreach($data AS $i) { ?>
           
           <?php $com_data=get_companyinfo($i['userid']);?>
           <?php if($com_data['status']==1) { ?>
                 <ul class="info-item clear"<?php if($n==1) { ?> style="border-top:none"<?php } ?>>
            	<li class="pic"><div class="img-wrap">
                        <a href="<?php echo $com_data['url'];?>" title="<?php echo $com_data['title'];?>"><img src="<?php echo $com_data['logo'];?>" title="<?php echo $com_data['title'];?>" width="112" height="92"></a>
                    </div></li>
                <li class="vip" style="width:110px">
				<?php echo get_company_rank($com_data['userid']);?>
				</li>
                <li class="info">
                    <h2><a href="<?php echo $com_data['url'];?>" title="<?php echo $com_data['title'];?>" target="_blank"><?php echo $com_data['companyname'];?></a></h2>
                    <p>
                       主营业务： <?php echo str_cut($com_data['products'],120);?><br />
                       联系方式：<?php echo $com_data['telephone'];?><br />
					   公司地址：<?php echo $com_data['areaname'];?> <?php echo $com_data['address'];?>
					</p>
                </li>
              </ul>
              <?php } ?>
             <?php $n++;}unset($n); ?>
              <div id="pages" class="text-c"><?php echo $pages;?></div>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>   
         </div>
    </div>
    <div class="col-auto">
    	<div class="box box-tab fillet fillet-blue">
    	
         	<ul class="tab clear swap-tab cu-li">
            	<li class="on">推荐商家</li>
                <li>最新加盟</li>
            </ul>
            
        	<div class="swap-content">
         	<ul class="list-num">
            	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=ca4b4bf488130c3fe3338b796df59c87&action=get_company&elite=1&num=8&order=regtime+DESC&cache=0\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'get_company')) {$data = $yp_tag->get_company(array('elite'=>'1','order'=>'regtime DESC','limit'=>'8',));}?>
        		<?php $n=1;if(is_array($data)) foreach($data AS $i) { ?>
        		<li><em <?php if($n<4) { ?>class="n<?php echo $n;?>"<?php } ?> ><?php echo $n;?></em><a href="<?php echo APP_PATH;?>index.php?m=yp&c=com_index&userid=<?php echo $i['userid'];?>" target="_blank"><?php echo $i['companyname'];?></a></li>
        		<?php $n++;}unset($n); ?>
        		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?> 
            </ul>
            
            <ul class="list-num" style="display:none;">
            	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=fb6587154687ec1e3c92845f3b24e75a&action=get_company&num=8&order=regtime+DESC&cache=0\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'get_company')) {$data = $yp_tag->get_company(array('order'=>'regtime DESC','limit'=>'8',));}?>
        		<?php $n=1;if(is_array($data)) foreach($data AS $i) { ?>
        		<li><em <?php if($n<4) { ?>class="n<?php echo $n;?>"<?php } ?> ><?php echo $n;?></em><a href="<?php echo APP_PATH;?>index.php?m=yp&c=com_index&userid=<?php echo $i['userid'];?>" target="_blank"><?php echo $i['companyname'];?></a></li>
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
         	<ul class="list-num">
            	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=e6bb0b720cef31ff01c674808247409a&action=hits&modelid=%24this-%3Esetting_models%5B76%5D&num=10&order=views+DESC&cache=0\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'hits')) {$data = $yp_tag->hits(array('modelid'=>$this->setting_models[76],'order'=>'views DESC','limit'=>'10',));}?>
 					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		            <li><em <?php if($n<4) { ?>class="n<?php echo $n;?>"<?php } ?> ><?php echo $n;?></em><a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['title'];?></a></li>
  	            <?php $n++;}unset($n); ?>
	            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
            
            <ul class="list-num" style="display:none;">
            	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=be361a126ba7f8cd5a4beb3ed497b575&action=hits&modelid=%24this-%3Esetting_models%5B76%5D&num=10&order=weekviews+DESC&cache=0\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'hits')) {$data = $yp_tag->hits(array('modelid'=>$this->setting_models[76],'order'=>'weekviews DESC','limit'=>'10',));}?>
 					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		            <li><em <?php if($n<4) { ?>class="n<?php echo $n;?>"<?php } ?> ><?php echo $n;?></em><a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['title'];?></a></li>
  	            <?php $n++;}unset($n); ?>
	            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
             </div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    </div>
</div>
<?php include template('yp', 'footer'); ?>
<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'header'); ?>
<div class="main clear">
    <div class="col-left">
    	<div class="category-main box generic">
        	<div class="title"><strong>企业库分类</strong></div>
        	
            <div class="cat-content">
           <?php $n=1;if(is_array($company_fenlei)) foreach($company_fenlei AS $r) { ?><?php if($r[parentid]=='0') { ?><div class="cat-item ib">
                    <h4><a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a></h4>
                    <p>		<?php $arr_parentid = yp_subcat($r['catid'], $modelid);?>
 							<?php $n=1;if(is_array($arr_parentid)) foreach($arr_parentid AS $k) { ?>
							<a title="<?php echo $k['catname'];?>" href="<?php echo $k['url'];?>" target="_blank"><?php echo $k['catname'];?></a>
							<?php $n++;}unset($n); ?>
							</p></div><?php } ?><?php $n++;}unset($n); ?>
			</div>
			
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
        		<?php $s=1;?>
        		<?php $n=1;if(is_array($data)) foreach($data AS $i) { ?>
        		<li><em <?php if($s<4) { ?>class="n<?php echo $s;?>"<?php } ?> ><?php echo $s;?></em><a href="<?php echo APP_PATH;?>index.php?m=yp&c=com_index&userid=<?php echo $i['userid'];?>" target="_blank"><?php echo $i['companyname'];?></a></li>
        		<?php $s++;?>
        		<?php $n++;}unset($n); ?>
        		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?> 
            </ul>
            
            <ul class="list-num" style="display:none;">
            	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=fb6587154687ec1e3c92845f3b24e75a&action=get_company&num=8&order=regtime+DESC&cache=0\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'get_company')) {$data = $yp_tag->get_company(array('order'=>'regtime DESC','limit'=>'8',));}?>
        		<?php $s=1;?>
        		<?php $n=1;if(is_array($data)) foreach($data AS $i) { ?>
        		<li><em <?php if($s<4) { ?>class="n<?php echo $s;?>"<?php } ?> ><?php echo $s;?></em><a href="<?php echo APP_PATH;?>index.php?m=yp&c=com_index&userid=<?php echo $i['userid'];?>" target="_blank"><?php echo $i['companyname'];?></a></li>
        		<?php $s++;?>
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
   				<?php $q=1;?>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		            <li><em <?php if($q<4) { ?>class="n<?php echo $q;?>"<?php } ?> ><?php echo $q;?></em><a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['title'];?></a></li>
		            <?php $q++;?>
 	            <?php $n++;}unset($n); ?>
	            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
            
            <ul class="list-num" style="display:none;">
            	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=be361a126ba7f8cd5a4beb3ed497b575&action=hits&modelid=%24this-%3Esetting_models%5B76%5D&num=10&order=weekviews+DESC&cache=0\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'hits')) {$data = $yp_tag->hits(array('modelid'=>$this->setting_models[76],'order'=>'weekviews DESC','limit'=>'10',));}?>
   				<?php $q=1;?>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		            <li><em <?php if($q<4) { ?>class="n<?php echo $q;?>"<?php } ?> ><?php echo $q;?></em><a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['title'];?></a></li>
		            <?php $q++;?>
 	            <?php $n++;}unset($n); ?>
	            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
             </div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    </div>
</div>
<?php include template('yp', 'footer'); ?>
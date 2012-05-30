<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'header'); ?>
<div class="main clear">
    <div class="col-left">
    	<div class="category-main box generic">
        	<div class="title"><strong><?php echo $MODEL['name'];?>分类</strong></div>
            <div class="cat-content">
			<?php $n=1;if(is_array($arr_parentid)) foreach($arr_parentid AS $c) { ?>
                <div class="cat-item ib">
                    <h4><a href="<?php echo $c['url'];?>"><?php echo $c['catname'];?></a></h4>
					<?php if($c['child']) { ?>
					<?php $arr_child = yp_subcat($c['catid'], $modelid);?>
                    <p>
					<?php $n=1;if(is_array($arr_child)) foreach($arr_child AS $catc) { ?>
						<a title="<?php echo $catc['catname'];?>" href="<?php echo $catc['url'];?>" target="_blank"><?php echo $catc['catname'];?></a>
					<?php $n++;}unset($n); ?>
                        </p>
						<?php } ?>
                </div>
				<?php $n++;}unset($n); ?>
			</div>
        </div>
    </div>
    <div class="col-auto">
    	<div class="box box-tab fillet fillet-blue">
        	<ul class="tab clear swap-tab cu-li">
            	<li class="on">推荐产品</li>
                <li>最新产品</li>
            </ul>
			<div class="swap-content">
			<?php $categorys_p = getcache('category_yp_'.$this->setting_models[73], 'yp');?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=92394a91183dc96f1247afc747189316&action=position&posid=%24posid&modelid=%24this-%3Esetting_models%5B73%5D&order=listorder+ASC&expiration=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'position')) {$data = $yp_tag->position(array('posid'=>$posid,'modelid'=>$this->setting_models[73],'order'=>'listorder ASC','expiration'=>'1','limit'=>'20',));}?>
				<ul class="list-num">
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo $categorys_p[$r['catid']]['url'];?>" class="blue">[<?php echo $categorys_p[$r['catid']]['catname'];?>]</a> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 26);?></a></li>
				<?php $n++;}unset($n); ?>
				</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=fcf42d06c11844521a1315a4f5b32fed&action=lists&modelid=%24this-%3Esetting_models%5B73%5D&num=10&order=id+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('modelid'=>$this->setting_models[73],'order'=>'id ASC','limit'=>'10',));}?>
				<ul class="list-num" style="display:none;">
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo $categorys_p[$r['catid']]['url'];?>" class="blue">[<?php echo $categorys_p[$r['catid']]['catname'];?>]</a> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 26);?></a></li>
				<?php $n++;}unset($n); ?>
				</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    	<div class="bk10"></div>
        <div class="box box-tab fillet fillet-blue">
        	<ul class="tab clear swap-tab cu-li">
            	<li class="on">24小时热点商机</li>
                <li>周热点商机</li>
            </ul>
			<div class="swap-content">
			<?php $buy_type = $this->buy_type;?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=07f5e667d3ed7a7fad8a31133ebda1f9&action=hits&modelid=%24this-%3Esetting_models%5B76%5D&day=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'hits')) {$data = $yp_tag->hits(array('modelid'=>$this->setting_models[76],'day'=>'1','limit'=>'20',));}?>
         	<ul class="list-num">
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo yp_filters_url('tid', array('tid'=>$r['tid'], 'catid'=>$r['catid']), 2, 76);?>" class="blue" target="_blank">[<?php echo $buy_type[$r['tid']];?>]</a> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 30);?></a></li>
				<?php $n++;}unset($n); ?>
            </ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=d28c4f542077c41845aa7362e3f2f012&action=hits&modelid=%24this-%3Esetting_models%5B76%5D&order=weekviews+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'hits')) {$data = $yp_tag->hits(array('modelid'=>$this->setting_models[76],'order'=>'weekviews DESC','limit'=>'20',));}?>
            <ul class="list-num" style="display:none;">
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo yp_filters_url('tid', array('tid'=>$r['tid'], 'catid'=>$r['catid']), 2, 76);?>" class="blue" target="_blank">[<?php echo $buy_type[$r['tid']];?>]</a> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 30);?></a></li>
				<?php $n++;}unset($n); ?>
            </ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    </div>
</div>
<?php include template('yp', 'footer'); ?>
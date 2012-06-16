<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'header'); ?>
<!--main-->
<div class="main clear">
	<div class="crumbs" style="margin-bottom:0"><a href="<?php echo APP_PATH;?>">首页</a><span> &gt; </span><a href="<?php echo get_yp_url();?>">企业黄页</a> &gt; <a href="<?php echo get_yp_url('model', $modelid);?>">产品</a> &gt; 列表</div>
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
			<dt><strong>价格：</strong></dt>
			<dd class="AttrBox clear">
			<?php $price_rang = array('500元以下|1_500','500-1000元|500_1000','1000-1500元|1000_1500','1500-2000元|1500_2000','2000-3000元|2000_3000','3000-4500元|3000_4500','4500元以上|4500_20000')?>
			<?php $n=1;if(is_array(yp_filters('price',$modelid,$price_rang))) foreach(yp_filters('price',$modelid,$price_rang) AS $r) { ?>
				<?php echo $r['menu'];?>
			<?php $n++;}unset($n); ?>
			</dd>
        </dl>
		<?php $areaid = intval($_GET['areaid']); $linkage_data = yp_show_linkage(1, 'areaid', $areaid, $modelid);?>
		<?php if($linkage_data) { ?>
		<dl class="clear">
        	<dt><strong>产地：</strong></dt>
            <dd class="AttrBox clear">
			<?php $n=1;if(is_array($linkage_data)) foreach($linkage_data AS $r) { ?>
				<a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a> 
			<?php $n++;}unset($n); ?>
			</dd>
        </dl> 
		<?php } ?>
    </div>
    <div class="col-left picbig">
    	<div class="category-main box generic info-content" id="checkbox">
        	<div class="title">
                <div class="orderby-select mouseover" type="select" heights="23" position="0">
                	<div class="select"><?php if($_GET['order']=='3') { ?> <a class="up" >更新时间升序</a><?php } elseif ($_GET['order']=='4') { ?> <a class="down" >更新时间降序</a><?php } elseif ($_GET['order']=='1') { ?> <a class="up" >价格由低到高</a><?php } elseif ($_GET['order']=='2') { ?> <a class="down" >价格由高到低</a><?php } else { ?><a class="null" >请选择排序方式</a><?php } ?></div>
                    <ul class="selectlist subselect_0" style="display:none;">
						<li><a class="null" onclick="javascript:void(0);">请选择排序方式</a></li>
						<li><a class="up" href="<?php echo $current_url;?>&order=1">价格由低到高</a></li>
                        <li><a class="down" href="<?php echo $current_url;?>&order=2">价格由高到低</a></li>
						<li><a class="up" href="<?php echo $current_url;?>&order=3">更新时间升序</a></li>
                        <li><a class="down" href="<?php echo $current_url;?>&order=4">更新时间降序</a></li>
					</ul>
                </div>
				<strong>产品信息</strong>
			</div>
            <ul class="info-top">
            	<li class="cp"></li>
            	<li class="pic"></li>
                <li class="jiage">价格</li>
                <li class="vip">诚信</li>
                <li class="info">信息/公司</li>
            </ul>
			<?php $sql = yp_filters_sql($modelid);$y=1;$listorder = array(1=>'price ASC', 'price DESC', 'updatetime ASC', 'updatetime DESC');?>
			<?php $order = $_GET['order'] ? $listorder[intval($_GET['order'])] : 'updatetime DESC'?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=7facbedab02594954489b5be8b031226&action=position&posid=%24posid&modelid=%24modelid&catid=%24catid&order=listorder+asc&num=4&expiration=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'position')) {$data = $yp_tag->position(array('posid'=>$posid,'modelid'=>$modelid,'catid'=>$catid,'order'=>'listorder asc','expiration'=>'1','limit'=>'4',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			 <?php $userid = get_memberinfo_buyusername($r['username'], 'userid');$memberinfo = get_companyinfo($userid, 'companyname, publish_total, url');$publish_total = string2array($memberinfo['publish_total']);?>
            <ul class="info-item clear"<?php if($y==1) { ?> style="border-top:none"<?php } ?>>
            	<?php if($last_cat) { ?><li class="cp"><label><input type="checkbox" value="<?php echo $r['id'];?>" title="<?php echo $r['title'];?>" img="<?php echo $r['thumb'];?>" id="c_<?php echo $r['id'];?>" name="moderate[]">对比</label></li><?php } ?>
				<li class="pic"><div class="img-wrap">
					<a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><img src="<?php echo $r['thumb'];?>" title="<?php echo $r['title'];?>"></a></div>
				</li>
                <li class="jiage"><strong>&yen;<?php echo $r['price'];?></strong></li>
                <li class="vip"><?php echo get_company_rank($r['userid']);?></li>
                <li class="info">
                    <h2><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></a></h2>
                    <p>商家：<a href="<?php echo $memberinfo['url'];?>" target="_blank" class="blue"><?php echo $memberinfo['companyname'];?></a><br />
					该商家共有 <?php echo $publish_total[$modelid];?> 条此类产品信息<br />
                       更新日期：<?php echo date("Y-m-d",$r[updatetime]);?>
					</p>
                </li>
			</ul>
			<?php $y++;?>
				<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			
			<?php $urlrule = yp_makeurlrule();?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=42828e6c41be1abdfb3b084fb099d05c&action=lists&where=%24sql&modelid=%24modelid&order=%24order&num=16&page=%24page&urlrule=%24urlrule\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$pagesize = 16;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$yp_total = $yp_tag->count(array('where'=>$sql,'modelid'=>$modelid,'order'=>$order,'limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($yp_total, $page, $pagesize, $urlrule);$data = $yp_tag->lists(array('where'=>$sql,'modelid'=>$modelid,'order'=>$order,'limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			 <?php $memberinfo = get_companyinfo($r['userid'], 'companyname, publish_total, url');$publish_total = string2array($memberinfo['publish_total']);?>
			<ul class="info-item clear"<?php if($y==1) { ?> style="border-top:none"<?php } ?>>
            	<?php if($last_cat) { ?><li class="cp"><label><input type="checkbox" value="<?php echo $r['id'];?>" title="<?php echo $r['title'];?>" img="<?php echo $r['thumb'];?>" id="c_<?php echo $r['id'];?>" name="moderate[]">对比</label></li><?php } ?>
				<li class="pic"><div class="img-wrap">
					<a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><img src="<?php echo $r['thumb'];?>" title="<?php echo $r['title'];?>"></a></div>
				</li>
                <li class="jiage"><strong>&yen;<?php echo $r['price'];?></strong></li>
                <li class="vip"><?php echo get_company_rank($r['userid']);?></li>
                <li class="info">
                    <h2><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></a></h2>
                    <p>商家：<a href="<?php echo $memberinfo['url'];?>" target="_blank" class="blue"><?php echo $memberinfo['companyname'];?></a><br />
					该商家共有 <?php echo $publish_total[$modelid];?> 条此类产品信息<br />
                       更新日期：<?php echo date("Y-m-d",$r[updatetime]);?>
					</p>
                </li>
            </ul>
			<?php $y++;?>
			<?php $n++;}unset($n); ?>
			<?php if($pages) { ?><div id="pages" class="text-c"><?php echo $pages;?></div><?php } ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
         </div>
    </div>
    <div class="col-auto">
    	<div class="box box-tab fillet fillet-blue">
        	<ul class="tab clear swap-tab cu-li">
            	<li class="on">推荐产品</li>
                <li>最新产品</li>
            </ul>
        	<div class="swap-content">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=4fd2dd971ac6c88d4bd5b783a2aad7e7&action=position&posids=%24this-%3Eglobal_posid&modelid=%24modelid&order=listorder+asc&num=10&expiration=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'position')) {$data = $yp_tag->position(array('posids'=>$this->global_posid,'modelid'=>$modelid,'order'=>'listorder asc','expiration'=>'1','limit'=>'10',));}?>
	            <ul class="list-num">
				 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		            <li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 30);?></a></li>
		         <?php $n++;}unset($n); ?>
		        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	            </ul>
	        	<ul class="list-num" style="display:none;">
	             <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=2f390e9f0fcedbf663681ad1b92f5902&action=lists&modelid=%24modelid&order=id+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('modelid'=>$modelid,'order'=>'id DESC','limit'=>'10',));}?>
	         	  <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		            <li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 30);?></a></li>
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
					<li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo yp_filters_url('tid', array('tid'=>$r['tid'], 'catid'=>$r['catid']), 2, $this->setting_models[76]);?>" class="blue" target="_blank">[<?php echo $buy_type[$r['tid']];?>]</a> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 30);?></a></li>
				<?php $n++;}unset($n); ?>
            </ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=d28c4f542077c41845aa7362e3f2f012&action=hits&modelid=%24this-%3Esetting_models%5B76%5D&order=weekviews+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'hits')) {$data = $yp_tag->hits(array('modelid'=>$this->setting_models[76],'order'=>'weekviews DESC','limit'=>'20',));}?>
            <ul class="list-num" style="display:none;">
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo yp_filters_url('tid', array('tid'=>$r['tid'], 'catid'=>$r['catid']), 2, $this->setting_models[76]);?>" class="blue" target="_blank">[<?php echo $buy_type[$r['tid']];?>]</a> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 30);?></a></li>
				<?php $n++;}unset($n); ?>
            </ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
             </div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    </div>
</div>
<script type="text/javascript">
var t_box = $("#checkbox :checkbox");
var modelid = '<?php echo $modelid;?>';
var catid = '<?php echo $catid;?>';
var ajax_url = '<?php echo APP_PATH;?>index.php';
var funbox = function () {
	var comparison =$("#comparison");
	if(comparison.length==0){
		$.getScript("<?php echo JS_PATH;?>comparison.js",function(){
			t_box.each(function(){
				var q = $(this)
				if(q.attr("checked")==true){
					var id = q.val(),
						title = q.attr('title'),
						img = q.attr('img'),
						sid = 'v1'+id,
						str = "<li id='"+sid+"'><img src="+img+" height='45' /><p>"+title+"</p><a href='javascript:;' class='close' onclick=\"remove_relation('"+sid+"',"+id+")\">X</a></li>";
						$.get(ajax_url, {m:'yp', c:'index', a:'pk', action:'add', id:id, title:title, thumb:img, catid:catid, random:Math.random()});
						$('#relation_text').append(str);
						$('#relation').val(id);
				}
			});
		});
	}else{
		t_box.unbind("click", funbox);
	}
};
t_box.bind("click", funbox);
t_box.attr("checked",false);
$.get(ajax_url, {m:'yp', c:'index', a:'pk', action:'get', catid:catid, random:Math.random()}, function(data) {
	if (data) {
		$.getScript("<?php echo JS_PATH;?>comparison.js",function(){
			var obj = eval('(' + data + ')');
			for(var i in obj) {
				var id = obj[i].id,
				relation_ids = $('#relation').val(),
				title = obj[i].title,
				img = obj[i].thumb,
				sid = 'v1'+id,
				str = "<li id='"+sid+"'><img src="+img+" height='45' /><p>"+title+"</p><a href='javascript:;' class='close' onclick=\"remove_relation('"+sid+"',"+id+")\">X</a></li>";
				$('#'+sid+' img').LoadImage(true, 120, 60,'statics/images/s_nopic.gif');
				if(relation_ids =='' ){
					$('#relation').val(id);
				}else{
					relation_ids = relation_ids+'-'+id;
					$('#relation').val(relation_ids);
				}
				$('#relation_text').append(str);
			}
			c_sum();
		});
	}
});

$.get(ajax_url, {m:'yp', c:'index', a:'get_buycar', random:Math.random()},function(data){
	var obj = eval('(' + data + ')');
	if (obj.num) {
		$('#buy_show').show();
		$('#buy_show_num').html(obj.num);
		$('#relation_text img').LoadImage(true, 120, 60,'statics/images/s_nopic.gif');
	}
});
</script>
<?php include template('yp', 'footer'); ?>
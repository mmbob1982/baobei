<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>jquery.ad-gallery.css">
<link href="<?php echo CSS_PATH;?>dianping.css" rel="stylesheet" type="text/css" />
<!--main-->
<div class="main clear">
	<div class="crumbs" style="margin-bottom:0"><a href="<?php echo APP_PATH;?>">首页</a><span> &gt; </span><a href="<?php echo get_yp_url();?>">企业黄页</a> &gt; <a href="<?php echo get_yp_url('model', $modelid);?>">产品</a> &gt; <a href="<?php echo $CAT['url'];?>"><?php echo $CAT['catname'];?></a>  &gt;  <?php echo $title;?></div>
    <div class="box show-box">
    	<h1><?php echo $title;?></h1>
        <div class="content clear">
			<?php if($exhibit) { ?>
            <div class="show-box-pic">
            	<!--slide play-->
                <div id="gallery" class="ad-gallery"><div class="ad-border"><div class="ad-image-wrapper"></div></div><div class="ad-controls"></div><div class="ad-nav"><div class="ad-thumbs"><ul class="ad-thumb-list">
				<?php $n=1;if(is_array($exhibit)) foreach($exhibit AS $e) { ?>
				<li><a href="<?php echo $e['url'];?>"><img src="<?php echo thumb($e['url'], 64, 44);?>" ></a></li>
				<?php $n++;}unset($n); ?>
          		</ul></div></div></div>
                <!--slide end-->
            </div>
<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.ad-gallery.js"></script>
<script type="text/javascript">
$(function() {
	  var galleries = $('.ad-gallery').adGallery();
	  galleries[0].settings.effect = 'fade';
});
</script>
			<?php } ?>
            <div class="yp-info">
			<?php $memberinfo = get_companyinfo($userid);?>
            	<h3 class="title">商家基本信息</h3>
                <div class="content">
                	公司名称：<?php echo $memberinfo['companyname'];?><br />
                    网址：<?php echo $memberinfo['web_url'];?><br />
                    地址：<?php echo $memberinfo['address'];?><br />
					联系人：<?php echo $memberinfo['linkman'];?><br />
                    传真：<?php echo $memberinfo['fax'];?><br />
                    电话：<?php echo $memberinfo['telephone'];?>
                    <div class="bk10 hr"></div>
					<?php if($setting['isbusiness'] && module_exists('dianping')) { ?>
					<?php echo get_pro_dainpingall(id_encode(ROUTE_M."_$catid",$id,$siteid));?> 
					<?php } ?>
					<p class="yp-btn"><a href="<?php echo compute_company_url('guestbook', array('userid'=>$memberinfo['userid']));?>">给我留言</a><a href="<?php echo $memberinfo['url'];?>" target="_blank">进入商铺</a></p>
                </div>
                <div class="bottom"></div>
            </div>
            <div class="col-auto show-info">
			<?php $type_arr = get_parent_url($modelid, $catid);?>
            	<h2><span>商家：</span><a href="<?php echo $memberinfo['url'];?>" class="blue" target="_blank"><?php echo $memberinfo['companyname'];?></a></h2>
                <p><span>类别：</span><a href="<?php echo $CAT['url'];?>"><?php echo $type_arr['title'];?></a><br />
                   <span>品牌：</span><?php echo $brand;?><br />
                   <span>型号：</span><?php echo $standard;?><br />
                   <span>产地：</span><?php echo $yieldly;?><br />
                   <span>价格：</span><?php echo $price;?>元 <?php if($units) { ?>/ <?php echo $units;?> <?php } ?><br />
                   <span>更新：</span><?php echo $updatetime;?>
				   <?php $n=1; if(is_array($additional_base)) foreach($additional_base AS $ab => $af) { ?><br /> <span><?php echo $additional_fields[$ab]['name'];?>：</span><?php echo $af;?><?php $n++;}unset($n); ?></p>
               <?php if($setting['isbusiness']) { ?> <p class="btns"><a href="javascript:void(0);" onclick="add_buycar(this, '<?php echo $id;?>', '<?php echo $modelid;?>', '1')" class="buy"><span>立即购买</span></a><a href="javascript:void(0);" onclick="add_buycar(this, '<?php echo $id;?>', '<?php echo $modelid;?>')" class="buycar"><span>加入购物车</span></a></p><?php } ?>
            </div>
        </div>
    </div>
    <div class="bk10"></div>
    <div class="col-left">
		<table width="100%" class="products-para" border="0">
           <caption>基本参数</caption>
		   <?php $n=1; if(is_array($additional_general)) foreach($additional_general AS $ag => $avalue) { ?>
          <?php if($n%2==1) { ?><tr><?php } ?>
            <th width="15%"><?php echo $additional_fields[$ag]['name'];?>：</th>
            <td width="35%">&nbsp;<?php echo $avalue;?></td>
          <?php if($n%2==0) { ?></tr><?php } ?>
		  <?php $n++;}unset($n); ?>
        </table>
        <div class="bk10"></div>
        <div class="box generic products-desc">
        	<div class="title"><strong>产品描述</strong></div>
            <div class="desc"><?php echo $content;?></div>
        </div>
        <div class="bk10"></div>
        <div class="box generic">
        	<div class="title"><strong>商家推荐产品</strong></div>
			<?php $sql="`userid`='$userid' AND `status`=99 AND `elite`=1";?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=bc512c646def84cbd8e2495ef08eca10&action=lists&where=%24sql&modelid=%24modelid&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('where'=>$sql,'modelid'=>$modelid,'limit'=>'10',));}?>
            <ul class="content news-photo picbig clear">
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li>
                    <div class="img-wrap">
                        <a href="<?php echo $r['url'];?>" target="_blank"><img style="height: 85px; width: 62.7517px;" src="<?php echo $r['thumb'];?>" title="<?php echo $r['title'];?>"></a>
                    </div>
                    <a href="<?php echo $r['url'];?>" target="_blank" title="<?php echo $r['title'];?>"><?php echo str_cut($r['title'], 20);?></a>
                </li>
				<?php $n++;}unset($n); ?>
           </ul>
		   <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
        <div class="bk10"></div>
		<?php if($setting['isbusiness']) { ?>
        <div class="box generic web-asked">
        	<div class="title"><strong>买家评价</strong></div>
		<div class="dianping-list">
<script type="text/javascript">
function SetCwinHeight(){
	var iframeid=document.getElementById("dianping_iframeid"); //iframe id
	if (document.getElementById){
		if (iframeid && !window.opera){
			if (iframeid.contentDocument && iframeid.contentDocument.body.offsetHeight){
				iframeid.height = iframeid.contentDocument.body.offsetHeight;
			}else if(iframeid.Document && iframeid.Document.body.scrollHeight){
				iframeid.height = iframeid.Document.body.scrollHeight;
			}
		}
	}
}
</script> 
 
 <?php if(module_exists('dianping') && $dianping_type!='') { ?>
 		<iframe  onload="Javascript:SetCwinHeight()" src="<?php echo APP_PATH;?>index.php?m=dianping&c=index&a=init&dianpingid=<?php echo id_encode(ROUTE_M."_$catid",$id,$siteid);?>&iframe=1&dianping_type=<?php echo $dianping_type;?>&module=<?php echo ROUTE_M;?>&modelid=<?php echo $modelid;?>&is_checkuserid=1&contentid=<?php echo $id;?>" width="100%" height="1" id="dianping_iframeid" frameborder="0" scrolling="no"></iframe>
 <?php } ?>
		</div>
		
        </div>
		<?php } ?>
    </div>
    <div class="col-auto">
    	<div class="box box-tab fillet fillet-blue">
        	<ul class="tab clear swap-tab cu-li">
            	<li class="on">相关产品</li>
                <li>最新产品</li>
            </ul>
        	<div class="swap-content">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=71a672087780a210249d09fd23f29b1e&action=relation&id=%24id&modelid=%24modelid&num=10&keywords=%24str_keywords\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'relation')) {$data = $yp_tag->relation(array('id'=>$id,'modelid'=>$modelid,'keywords'=>$str_keywords,'limit'=>'10',));}?>
	            <ul class="list-num">
				 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		            <li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'],34,false);?></a></li>
		         <?php $n++;}unset($n); ?>
	            </ul>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=2f390e9f0fcedbf663681ad1b92f5902&action=lists&modelid=%24modelid&order=id+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('modelid'=>$modelid,'order'=>'id DESC','limit'=>'10',));}?>
	        	<ul class="list-num" style="display:none;">
	         	  <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		            <li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 34,false);?></a></li>
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
    </div><div class="bk"></div>
</div>
<div class="show-buycar" id="show-buycar">
	<div class="title"><a href="javascript:;" onclick="$('.show-buycar').hide();" class="close">关闭</a><strong>提示</strong></div>
    <div class="content">
    	<h2>已成功添加到购物车！</h2>
        <p>购物车里已有 <font color="#FF0000" class="fb" id="product_num">0</font> 件商品。总价 <font color="#FF0000" class="fb f20" id="product_fee">0.00</font> 元。</p>
        <p class="bottom"><a href="<?php echo APP_PATH;?>index.php?m=yp&c=index&a=buycar_list" class="sbtn ib">去购物车结算</a></p>
    </div>
</div>
<script type="text/javascript">
$(function() {
	  $('.products-desc .desc img').LoadImage(true, 640, 660,'<?php echo IMG_PATH;?>s_nopic.gif');
});
function add_buycar(obj, id, modelid, buy) {
	var os = $(obj);
	$.get('<?php echo APP_PATH;?>index.php', {m:'yp', c:'index', a:'buycar', id:id, modelid:modelid, random:Math.random()}, function(data){
		if (data=='1') {
			alert('此商品不存在或已下架！');
		} else if (data=='2') {
			alert('不可购买自己的商品！');
		} else if(data=='3') {
			if (buy) {
				window.location.href="<?php echo APP_PATH;?>index.php?m=yp&c=index&a=buycar_list";
			} else {
				alert('商品已经添加到购物车！');
			}
		} else {
			if (buy) {
				window.location.href="<?php echo APP_PATH;?>index.php?m=yp&c=index&a=buycar_list";
			} else {
				var obj = eval('(' + data + ')');
				$('#product_num').html(obj.num);
				$('#product_fee').html(obj.total);
				var showBuycar=$(".show-buycar"),offset =os.offset();
				showBuycar.css({"position":"absolute","z-index":"100",left:offset.left,top:offset.top+35});
				if(showBuycar.css("display")=="none"){
					showBuycar.show();
				}else{
					showBuycar.hide();
				}
				$('#buy_show').show();
				$('#buy_show_num').html(obj.num);
			}
		}
	});
}

$.get('<?php echo APP_PATH;?>index.php', {m:'yp', c:'index', a:'get_buycar', random:Math.random()},function(data){
	var obj = eval('(' + data + ')');
	if (obj.num) {
		$('#buy_show').show();
		$('#buy_show_num').html(obj.num);
	}
});
</script>
<?php include template('yp', 'footer'); ?>
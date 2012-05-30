<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'header'); ?>
<!--main-->
<div class="main clear">
	<div class="top-gg">
    	<ul class="ads-146-60 clear">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=a7fa5309057f435520f0bc40fe276719&action=get_company&elite=1&num=12&order=userid+asc&cache=0\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'get_company')) {$data = $yp_tag->get_company(array('elite'=>'1','order'=>'userid asc','limit'=>'12',));}?>
		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
        	<li><a href="<?php echo $r['url'];?>" target="_blank" title="<?php echo $r['companyname'];?>"><img src="<?php echo $r['logo'];?>" width="143" height="60"/></a></li>
		<?php $n++;}unset($n); ?>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
         </ul>
	</div>
    <div class="col-left">
    	<div class="box recom">
        	<h5 class="title-2">市场行情</h5>
            <div class="content">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d30acc5f0345b544ee15611be11d8543&action=lists&catid=11076&num=7&order=id+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'11076','order'=>'id DESC','limit'=>'7',));}?>
                <ul class="list lh22">
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    <li> <a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo str_cut($r[title], 30);?></a></li>
                <?php $n++;}unset($n); ?>
                </ul>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </div>
        </div>
        <div class="col-auto">
        	<div class="yp-slide">
                <div class="FocusPic">
                    <div class="content" id="yp-slide">
                        <div class="changeDiv">  
                        <!-- <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"block\" data=\"op=block&tag_md5=99247fc6b61334c884eef03689fbe1e3&pos=yp_slide\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">添加碎片</a>";}$block_tag = pc_base::load_app_class('block_tag', 'block');echo $block_tag->pc_tag(array('pos'=>'yp_slide',));?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?> -->
						<!-- 将以下内容用上面碎片替换 -->
						<a href="http://bbs.phpcms.cn" title="黄页Beta 正式发布"><img src="<?php echo IMG_PATH;?>yp/ad.png" alt="黄页Beta 正式发布" width="447" height="201" /></a>
						<!-- end -->
                        </div>
                    </div>
                </div>
            </div>
        	<div class="process"><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"block\" data=\"op=block&tag_md5=f5c0d459cdf5a7e2d5262467025696b1&pos=yp_slide_textad\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">添加碎片</a>";}$block_tag = pc_base::load_app_class('block_tag', 'block');echo $block_tag->pc_tag(array('pos'=>'yp_slide_textad',));?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></div>
        </div>
    </div>
    <div class="col-auto">
		<?php if($is_exit=='1') { ?> 
			<div class="yp-login ypbox">
				<div class="title"><a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=logout&forward=<?php echo urlencode(get_url());?>" class="rt blue">退出</a>您好！<a href="<?php echo APP_PATH;?>index.php?m=member&siteid=<?php echo $siteid;?>" class="blue"><?php echo $user_array['username'];?></a></div>
				<ul class="alerts">
					<li>用户组：<?php echo $memberinfo['groupname'];?></li>
					<li>积分：<font color=red><?php echo $user_array['point'];?></font></li>
				</ul>
				<p class="yp-content">
					<font color="red">加入企业库能给我带来什么好处：</font><br />
					·查看买家求购信息，联系买家寻求商机<br />
					·发布活动信息，发布产品信息<br />
					·拥有精美企业店铺，让买家主动上门<br />
				</p>
				<p><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=init&t=3" class="reg f14 fb color-f70" target="_blank">立即免费入驻企业库</a></p>
			</div>
		<?php } ?>
		<?php if($is_exit == '0') { ?> 
        <form method="post" action="<?php echo APP_PATH;?>index.php?m=member&c=index&a=login" id="myform2" name="myform2">
		<input type="hidden" name="forward" id="forward" value="<?php echo urlencode(get_url());?>">
        <div class="yp-login ypbox">
            <div class="title fb">企业登录</div>
            <ul class="login-form">
            	<li><label>用户名：</label><input type="text" size="30" class="input" value="" name="username" id="k_username"></li>
                <li><label>密　码：</label><input type="password" size="30" class="input" name="password" id="k_password"></li>
                <li><label>验证码：</label><input type="text" id="code" name="code" id="code" size="8" class="input"><?php echo form::checkcode('code_img', '4', '14', 84, 24);?></li>
                <li><label>&nbsp;</label><input type="submit" name="dosubmit" class="btn" value="">　<a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=register&siteid=<?php echo $siteid;?>" class="blue" target="_blank">免费注册</a><span class="line"> | </span><a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=public_forget_password&siteid=<?php echo $siteid;?>" class="blue">忘记密码？</a></li>
            </ul>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
        </form>
		<?php } ?>
		<?php if($is_exit == '2') { ?>
        <div class="yp-login ypbox" >
        	<div class="title"><a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=logout&forward=<?php echo urlencode(get_url());?>" class="rt blue">退出</a>您好！<a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=init&t=3" class="blue" title="<?php echo $company_user_array['companyname'];?>"><?php echo str_cut($company_user_array['companyname'],28);?></a></div>
            <ul class="alerts" style="padding-top:8px">
            	<li>用户组：<?php echo $memberinfo['groupname'];?></li>
                <li>积　分：<font color=red><?php echo $user_array['point'];?></font></li>
                <li>留　言：<a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=guestbook&status=0&t=3"><font color="red"><?php echo count_new_guestbook($company_user_array['userid']);?></font></a> 条</li>
                <li>新订单：<a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=pay&t=3"><font color=red><?php echo get_orders();?></font></a> 笔</li>
            </ul>
            <div class="bk6"></div>
            <div class="func-btn ib-a"><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=company&t=3" class="i5"><span>管理企业网站</span></a><a href="<?php echo $company_user_array['url'];?>" class="i1"><span>访问我的网站</span></a><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=content&action=add&modelid=<?php echo $product_id;?>&t=3" class="i4"><span>发布产品</span></a><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=content&action=add&modelid=<?php echo $buy_id;?>&t=3" class="i2"><span>发布供求信息</span></a></div>
        </div>
		<?php } ?>
    	<dl class="announce">
        	<dt>公告</dt>
            <dd><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"block\" data=\"op=block&tag_md5=c715e8cb0f98d2a3142bc55a1274627d&pos=announce\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">添加碎片</a>";}$block_tag = pc_base::load_app_class('block_tag', 'block');echo $block_tag->pc_tag(array('pos'=>'announce',));?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></dd>
        </dl>
    </div>
    <div class="bk10"></div>
    <div class="col-left">
    	<div class="category-main box">
        	<div class="cat-name"><h4><a href="">所有类目</a></h4></div>
            <div class="cat-top-nav blue">
            <?php $n=1;if(is_array($pro_categorys)) foreach($pro_categorys AS $r) { ?><?php if($r['parentid']=='0') { ?><?php if($n!=1) { ?><span>| </span><?php } ?><a href="<?php echo $r['url'];?>"><strong><?php echo $r['catname'];?></strong></a><?php } ?><?php $n++;}unset($n); ?>
             </div>
            <div class="cat-content">
             <?php $n=1;if(is_array($pro_categorys)) foreach($pro_categorys AS $r) { ?><?php if($r[parentid]=='0') { ?><div class="cat-item ib">
                    <h4><a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a></h4>
                    <p>
							<?php $arr_parentid = yp_subcat($r[catid], $product_id);?>
							<?php $n=1;if(is_array($arr_parentid)) foreach($arr_parentid AS $k) { ?>
							<a title="<?php echo $k['catname'];?>" href="<?php echo $k['url'];?>" target="_blank"><?php echo $k['catname'];?></a>
							<?php $n++;}unset($n); ?>
                    </p>
                </div><?php } ?><?php $n++;}unset($n); ?>
			</div>
        </div>
        <div class="bk10"></div>
        <div class="box generic">
        	<div class="title"><strong>最新商机</strong> <a href="<?php echo yp_filters_url('tid', array('tid'=>1, 'catid'=>0), 2, $buy_id);?>">供应</a><span> | </span> <a href="<?php echo yp_filters_url('tid', array('tid'=>2, 'catid'=>0), 2, $buy_id);?>">求购</a><span> | </span> <a href="<?php echo yp_filters_url('tid', array('tid'=>3, 'catid'=>0), 2, $buy_id);?>">二手</a><span> | </span> <a href="<?php echo yp_filters_url('tid', array('tid'=>4, 'catid'=>0), 2, $buy_id);?>">促销</a></div>
            <div class="content clear">
            
            
             <?php $order = $_GET['order'] ? $_GET['order'] : 'updatetime DESC'?>
			 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=657d3edcdbe191fd9a5796f49cd1d1c1&action=lists&where=+tid%3D1+and+status%3D99&modelid=%24buy_id&order=%24order&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('where'=>' tid=1 and status=99','modelid'=>$buy_id,'order'=>$order,'limit'=>'6',));}?>
             	<div class="sub-box">
                	<h2 class="blue"><a href="<?php echo yp_filters_url('tid', array('tid'=>1, 'catid'=>0), 2, $buy_id);?>">供应信息</a><a href="<?php echo yp_filters_url('tid', array('tid'=>1, 'catid'=>0), 2, $buy_id);?>" class="more">更多>></a></h2>
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=2c8a033dc60aad6dfa32f988dfa69acf&action=lists&where=+tid%3D1+and+status%3D99+and+elite%3D1+and+thumb%21%3D%27%27&modelid=%24buy_id&order=%24order&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('where'=>' tid=1 and status=99 and elite=1 and thumb!=\'\'','modelid'=>$buy_id,'order'=>$order,'limit'=>'1',));}?>
					<div class="pic">
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    	<a href="<?php echo $r['url'];?>" target="_blank"><img src="<?php echo $r['thumb'];?>" width="110" height="80" alt="<?php echo $r['title'];?>"/></a>
                      <p><a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['title'];?></a></p>
					<?php $n++;}unset($n); ?>
                    </div>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    <ul class="list">
                    	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    	<li>·<a href="<?php echo $r['url'];?>" target="_blank"><?php echo str_cut($r['title'],30,false);?></a></li>
                    	<?php $n++;}unset($n); ?>
                    </ul>
                </div><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=1508117358660da48617214901ebff81&action=lists&where=+tid%3D2+and+status%3D99&modelid=%24buy_id&order=%24order&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('where'=>' tid=2 and status=99','modelid'=>$buy_id,'order'=>$order,'limit'=>'6',));}?>
             	<div class="sub-box">
                	<h2 class="blue"><a href="<?php echo yp_filters_url('tid', array('tid'=>2, 'catid'=>0), 2, $buy_id);?>">求购信息</a><a href="<?php echo yp_filters_url('tid', array('tid'=>2, 'catid'=>0), 2, $buy_id);?>" class="more">更多>></a></h2>
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=86b2479a1808c6c41f3b811b6e344e8e&action=lists&where=+tid%3D2+and+status%3D99+and+elite%3D1+and+thumb%21%3D%27%27&modelid=%24buy_id&order=%24order&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('where'=>' tid=2 and status=99 and elite=1 and thumb!=\'\'','modelid'=>$buy_id,'order'=>$order,'limit'=>'1',));}?>
					<div class="pic">
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    	<a href="<?php echo $r['url'];?>" target="_blank"><img src="<?php echo $r['thumb'];?>" width="110" height="80" alt="<?php echo $r['title'];?>"/></a>
                      <p><a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['title'];?></a></p>
					<?php $n++;}unset($n); ?>
                    </div>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    <ul class="list">
                    	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    	<li>·<a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></li>
                    	<?php $n++;}unset($n); ?>
                    </ul>
                </div><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=80935a4e84d64a169ad8c1e48afbac20&action=lists&where=+tid%3D3+and+status%3D99&modelid=%24buy_id&order=%24order&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('where'=>' tid=3 and status=99','modelid'=>$buy_id,'order'=>$order,'limit'=>'6',));}?>
             	<div class="sub-box">
                	<h2 class="blue"><a href="<?php echo yp_filters_url('tid', array('tid'=>3, 'catid'=>0), 2, $buy_id);?>">二手信息</a><a href="<?php echo yp_filters_url('tid', array('tid'=>3, 'catid'=>0), 2, $buy_id);?>" class="more">更多>></a></h2>
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=878d17ba28886ab0c5f7fb2867a00f4e&action=lists&where=+tid%3D3+and+status%3D99+and+elite%3D1+and+thumb%21%3D%27%27&modelid=%24buy_id&order=%24order&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('where'=>' tid=3 and status=99 and elite=1 and thumb!=\'\'','modelid'=>$buy_id,'order'=>$order,'limit'=>'1',));}?>
						<div class="pic">
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<a href="<?php echo $r['url'];?>" target="_blank"><img src="<?php echo $r['thumb'];?>" width="110" height="80" alt="<?php echo $r['title'];?>"/></a>
						 <p><a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['title'];?></a></p>
						<?php $n++;}unset($n); ?>
						</div>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    <ul class="list">
                    	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    	<li>·<a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></li>
                    	<?php $n++;}unset($n); ?>
                    </ul>
                </div><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=459aeccba75f050c18a84ca6e5ce8646&action=lists&where=+tid%3D4+and+status%3D99&modelid=%24buy_id&order=%24order&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('where'=>' tid=4 and status=99','modelid'=>$buy_id,'order'=>$order,'limit'=>'6',));}?>
             	<div class="sub-box">
                	<h2 class="blue"><a href="<?php echo yp_filters_url('tid', array('tid'=>4, 'catid'=>0), 2, $buy_id);?>">促销信息</a><a href="<?php echo yp_filters_url('tid', array('tid'=>4, 'catid'=>0), 2, $buy_id);?>" class="more">更多>></a></h2>
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=8bc7dc68149b15a9c254b18856129dda&action=lists&where=+tid%3D4+and+status%3D99+and+elite%3D1+and+thumb%21%3D%27%27&modelid=%24buy_id&order=%24order&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('where'=>' tid=4 and status=99 and elite=1 and thumb!=\'\'','modelid'=>$buy_id,'order'=>$order,'limit'=>'1',));}?>
						<div class="pic">
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<a href="<?php echo $r['url'];?>" target="_blank"><img src="<?php echo $r['thumb'];?>" width="110" height="80" alt="<?php echo $r['title'];?>"/></a>
						<p><a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['title'];?></a></p>
						<?php $n++;}unset($n); ?>
						</div>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    <ul class="list">
                    	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    	<li>·<a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></li>
                    	<?php $n++;}unset($n); ?>
                    </ul>
                </div><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
      
            </div>
        </div>
        <div class="bk10"></div>
        <div class="box generic">
        	<div class="title"><strong>产品推荐</strong> </div>
            <ul class="content news-photo picbig clear">
               
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=3e782e3c9efdea258ed3532ef0411f18&action=position&posid=%24posid&modelid=%24product_id&order=listorder+asc&num=10&expiration=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'position')) {$data = $yp_tag->position(array('posid'=>$posid,'modelid'=>$product_id,'order'=>'listorder asc','expiration'=>'1','limit'=>'10',));}?>  
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li>
			<div class="img-wrap">
			<a title="" href="<?php echo $r['url'];?>" target="_blank"><img title="<?php echo $r['title'];?>" src="<?php echo $r['thumb'];?>" style="height: 85px; width: 61.5132px;"></a>
			</div>
			<a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>"><?php echo str_cut($r[title],20,fasle);?></a>
			</li> 
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
           </ul>
        </div>
    </div>
    <div class="col-auto">
    	<div class="box box-tab fillet fillet-blue">
        	<ul class="tab clear">
            	<li class="on">最新加盟</li>
                <li></li>
             </ul>
				<ul class="list-num">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=1893649371d3f332a00acf2f92e7d23b&action=get_company&num=10&order=regtime+DESC&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('order'=>'regtime DESC',)).'1893649371d3f332a00acf2f92e7d23b');if(!$data = tpl_cache($tag_cache_name,3600)){$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'get_company')) {$data = $yp_tag->get_company(array('order'=>'regtime DESC','limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
 					<?php $n=1;if(is_array($data)) foreach($data AS $i) { ?>
					<li><em <?php if($n<4) { ?>class="n<?php echo $n;?>"<?php } ?> ><?php echo $n;?></em><a href="<?php echo $i['url'];?>"><?php echo $i['companyname'];?></a></li>
 					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?> 
				</ul>
            
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
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=b98bcb822b8186c6a7184e52dcde9131&action=hits&modelid=%24buy_id&day=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'hits')) {$data = $yp_tag->hits(array('modelid'=>$buy_id,'day'=>'1','limit'=>'20',));}?>
					<ul class="list-num" >
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo yp_filters_url('tid', array('tid'=>$r['tid']), 2, $buy_id);?>" class="blue" target="_blank">[<?php echo $buy_type[$r['tid']];?>]</a> <a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></li>
						<?php $n++;}unset($n); ?>
					</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	        	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=3c40d76c3ab68c6d13f423c7a3a1eb1e&action=hits&modelid=%24buy_id&order=weekviews+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'hits')) {$data = $yp_tag->hits(array('modelid'=>$buy_id,'order'=>'weekviews DESC','limit'=>'20',));}?>
				<ul class="list-num" style="display:none;">
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo yp_filters_url('tid', array('tid'=>$r['tid'], 'catid'=>0), 2, $buy_id);?>" class="blue" target="_blank">[<?php echo $buy_type[$r['tid']];?>]</a> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 30);?></a></li>
					<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
             </div>
            
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
        <div class="bk10"></div>
        <div class="box box-tab fillet fillet-blue">
        	<ul class="tab clear swap-tab cu-li">
            	<li class="on">推荐产品</li>
                <li>最新产品</li>
            </ul>
            <div class="swap-content">
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=bba7df957255e4e8a768514392726baf&action=position&posids=%24this-%3Eglobal_posid&modelid=%24product_id&order=listorder+asc&num=10&expiration=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'position')) {$data = $yp_tag->position(array('posids'=>$this->global_posid,'modelid'=>$product_id,'order'=>'listorder asc','expiration'=>'1','limit'=>'10',));}?>
	            <ul class="list-num">
				 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		            <li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></li>
		         <?php $n++;}unset($n); ?>
		        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	            </ul>
	        	<ul class="list-num" style="display:none;">
	             <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=a4aff8ac42104ccea8dc9b3dcff93c98&action=lists&modelid=%24product_id&order=id+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'lists')) {$data = $yp_tag->lists(array('modelid'=>$product_id,'order'=>'id DESC','limit'=>'10',));}?>
	         	  <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		            <li><em<?php if($n<4) { ?> class="n<?php echo $n;?>"<?php } ?>><?php echo $n;?></em><a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 30);?></a></li>
			      <?php $n++;}unset($n); ?>
	             </ul>
				 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    </div>
</div>
<?php include template('yp', 'footer'); ?>
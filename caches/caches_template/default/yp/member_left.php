<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><div class="col-left col-1 left-memu">
        	<h5 class="title"><img src="<?php echo IMG_PATH;?>icon/m_1.png" width="15" height="15" /> 信息管理</h5>
            <ul class="left-info">
            
			<?php $n=1; if(is_array($this->yp_models)) foreach($this->yp_models AS $mid => $model) { ?>
       	    <li <?php if($modelid==$mid) { ?> class="on"<?php } ?>><a href="index.php?m=yp&c=business&a=content&action=add&modelid=<?php echo $mid;?>&t=3" class="add" hidefocus="true">发布</a><a href="index.php?m=yp&c=business&a=content&action=list&modelid=<?php echo $mid;?>&t=3" hidefocus="true"> <?php echo $model['name'];?>管理</a></li>
			<?php $n++;}unset($n); ?>
            </ul>
            <?php if(module_exists('pay')) { ?>
<h6 class="title"> 商家资料管理</h6>
            <ul class="left-info">
                <li<?php if(ROUTE_A=="company" && ROUTE_C=="business") { ?> class="on"<?php } ?>><a href="index.php?m=yp&c=business&a=company&t=3" hidefocus="true">商家资料</a></li>
                <li<?php if(ROUTE_A!="pay" && ROUTE_C=="spend_list") { ?> class="on"<?php } ?>><a href="index.php?m=yp&c=business&a=map&t=3" hidefocus="true">地图标注</a></li>
				<li<?php if(ROUTE_A=="certificate") { ?> class="on"<?php } ?>><a href="index.php?m=yp&c=business&a=certificate&action=add&t=3" class="add" hidefocus="true">添加</a><a href="index.php?m=yp&c=business&a=certificate&t=3" hidefocus="true">资质证书</a></li>
				<!--<li<?php if(ROUTE_A=="collect") { ?> class="on"<?php } ?>><a href="index.php?m=yp&c=business&a=collect">我的收藏</a></li>-->
 				<li<?php if(ROUTE_A=="menu") { ?> class="on"<?php } ?>><a href="index.php?m=yp&c=business&a=menu&t=3">前台菜单</a></li>
                <li<?php if(ROUTE_A=="template" && ROUTE_C=="business") { ?> class="on"<?php } ?>><a href="index.php?m=yp&c=business&a=template&t=3" hidefocus="true">企业模板</a></li>
      </ul>
      <?php } ?>
      <h6 class="title">商业往来</h6>
            <ul class="left-info">
           	  <li<?php if(ROUTE_A=="guestbook" && ROUTE_C=="business") { ?> class="on"<?php } ?>><a href="index.php?m=yp&c=business&a=guestbook&status=0&t=3">留言管理(<font color=red><?php echo count_new_guestbook($this->_userid);?></font>)</a> </li>
			  <?php if($this->setting['isbusiness']) { ?>
			  <li<?php if(ROUTE_A=="pay" && ROUTE_C=="business") { ?> class="on"<?php } ?>><a href="index.php?m=yp&c=business&a=pay&t=3">订单处理(<font color=red><?php echo get_orders();?></font>)</a> </li>
			  <?php } ?>
           </ul>
      <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
</div>
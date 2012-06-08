<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php $tpl_dir = $this->default_tpl;?>
<?php include template($tpl_dir, 'header'); ?>
<!-- 主体开始 -->
<div class="main clear">
	<div class="col-left">
    	<div class="box">
        	<h2 class="title">企业信息</h2>
            <div class="content">
            <table width="100%" class="table-info" border="0">
                  <tr>
                    <th>公司名：</th>
                    <td><?php echo $array['companyname'];?></td>
                  </tr>
                  <tr>
                    <th>联系人：</th>
                    <td><?php echo $array['linkman'];?></td>
                  </tr>
                  <tr>
                    <th>电话：</th>
                    <td><?php echo $array['telephone'];?></td>
                  </tr>
                  <tr>
                    <th>传真：</th>
                    <td><?php echo $array['fax'];?></td>
                  </tr>
                  <tr>
                    <th>地址：</th>
                    <td><?php echo $array['address'];?></td>
                  </tr>
                  <tr>
                    <th>网址：</th>
                    <td><?php echo $array['web_url'];?></td>
                  </tr>
                  <tr>
                    <th>邮箱：</th>
                    <td><?php echo $array['email'];?></td>
                  </tr>
                </table>
            </div>
        </div>
        <div class="bk10"></div>
        <div class="box">
        	<h2 class="title">企业新闻</h2>
            <ul class="content list">
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=314d93e39d60a0f8a55f7f32a08e249e&action=get_datas&userid=%24array%5Buserid%5D&modelid=%24this-%3Esetting_models%5B72%5D&num=10&order=inputtime+desc&cache=0\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'get_datas')) {$data = $yp_tag->get_datas(array('userid'=>$array[userid],'modelid'=>$this->setting_models[72],'order'=>'inputtime desc','limit'=>'10',));}?>
 			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            	<li>·<a href="<?php echo compute_company_url('show', array('catid'=>$r['catid'], 'id'=>$r['id'], 'page'=>1));?>" title="<?php echo $r['title'];?>" ><?php echo str_cut($r[title],32,'');?></a></li> 
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>	
            </ul>
        </div>
        <div class="bk10"></div>
        <div class="box">
        	<h2 class="title">荣誉资质</h2>
            <div class="content">
            	<div class="FocusPic">
                    <div class="content" id="slide">
                        <div class="changeDiv">  
                        	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=c4b92d1e8421f8f2266316d1553c85a1&action=get_certificate&userid=%24array%5Buserid%5D&status=1&num=10&order=addtime+desc&cache=0\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'get_certificate')) {$data = $yp_tag->get_certificate(array('userid'=>$array[userid],'status'=>'1','order'=>'addtime desc','limit'=>'10',));}?>
                             <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                            	<a href="<?php echo $r['thumb'];?>" target="_blank"><img src="<?php echo $r['thumb'];?>" width="222" height="164" /></a>
                            <?php $n++;}unset($n); ?>
                            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                        </div>
                    </div>
                </div>
                </div>
        </div>
        <div class="bk10"></div>
    </div>
    <div class="col-auto">
  <div class="box introduction">
        	<h2 class="title">公司简介</h2>
            <div class="content"><?php echo $array['introduce'];?></div>
        </div>
        <div class="bk10"></div>
        <div class="box">
        	<h2 class="title">推荐产品</h2>
            <div class="content">
            	<ul class="news-photo picbig clear">
                 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"yp\" data=\"op=yp&tag_md5=431fe9c988cbc26a5b688e6edc45ea05&action=get_datas&userid=%24array%5Buserid%5D&modelid=%24this-%3Esetting_models%5B73%5D&num=10&order=listorder+asc&cache=0\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$yp_tag = pc_base::load_app_class("yp_tag", "yp");if (method_exists($yp_tag, 'get_datas')) {$data = $yp_tag->get_datas(array('userid'=>$array[userid],'modelid'=>$this->setting_models[73],'order'=>'listorder asc','limit'=>'10',));}?>
 				 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    <li>
                    <div class="img-wrap">
                    <a title="<?php echo $r['title'];?>" href="<?php echo compute_company_url('show', array('catid'=>$r['catid'], 'id'=>$r['id'], 'page'=>1));?>" target="_blank"><img title="<?php echo $r['title'];?>" src="<?php echo $r['thumb'];?>"></a>
                    </div>
                    <a title="<?php echo $r['title'];?>" href="<?php echo compute_company_url('show', array('catid'=>$r['catid'], 'id'=>$r['id'], 'page'=>1));?>"><?php echo $r['title'];?></a>
                	</li>
                <?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                            </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
new slide("#slide","cur",222,164,1);//首页焦点图
</script>
<?php include template('yp/com_default', 'footer'); ?>

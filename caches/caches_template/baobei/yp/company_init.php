<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'member_header'); ?>
<script type="text/javascript">
<!--
	var charset = '<?php echo CHARSET;?>';
	var uploadurl = '<?php echo pc_base::load_config('system','upload_url')?>';
//-->
</script>
<link href="<?php echo CSS_PATH;?>dialog.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>
<div id="memberArea">
	<?php include template('yp', 'member_left'); ?>
	<div class="col-auto">
		<div class="col-1 ">
        	<h6 class="title">��ҵ����</h6>
        	<div class="content">
            	<div class="col-1 member-info">
                    <div class="content">
                        <div class="col-left himg">
                            <a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=company&action=logo&t=3" title="�༭��ҵLogo"><img onerror="this.src='<?php echo IMG_PATH;?>yp/logobg.png'" src="<?php echo $memberinfo['logo'];?>" height="60" ></a>
                        </div>
                        <div class="col-auto">
                            <h5><?php echo $memberinfo['companyname'];?>��<?php echo $memberinfo['username'];?>��</h5>
                            <p class="blue">
                            ��Ա���ͣ�<?php echo $groups[$groupid]['name'];?>��
                            �˻���<font style="color:#F00; font-size:22px;font-family:Georgia,Arial; font-weight:700"><?php echo $memberinfo['amount'];?></font> Ԫ��
                           <?php if($setting['isbusiness']) { ?> ���õȼ���<?php echo get_company_rank($memberinfo['userid']);?> <?php } else { ?> ���ֵ�����<font style="color:#F00; font-size:12px;font-family:Georgia,Arial; font-weight:700">0</font> ��<?php } ?></p>
                        </div>
                    </div>
                </div>
                <div class="bk10"></div>
                <table width="100%" class="products-para" border="0">
                   <caption>��ҵ��ֵ����</caption>
                   <thead>
                  		<tr>
                            <th>��Ա��\����Χ</th>
                            <td>�����������</td>
							<?php $n=1;if(is_array($yp_models)) foreach($yp_models AS $m) { ?>
							<td><?php echo $m['name'];?></td>
							<?php $n++;}unset($n); ?>
                          </tr>
                   </thead>
				   <?php $n=1;if(is_array($groups)) foreach($groups AS $g) { ?>
				   <?php if(!in_array($g['groupid'], array(1, 7, 8))) { ?>
                  <tr class="func-btn">
                    <th><?php echo $g['name'];?></th>
                    <td align="center"><?php if($setting['priv'][$g['groupid']]['allowpostverify']) { ?><font color="red">��</font><?php } else { ?><font color="#0066FF">��</font><?php } ?></td>
					<?php $n=1;if(is_array($yp_models)) foreach($yp_models AS $m) { ?>
					<td><?php if($setting['priv'][$g['groupid']][$m['modelid']]) { ?>������<?php } else { ?>��Ȩ����<?php } ?></td>
                    <?php $n++;}unset($n); ?>
                  </tr>
				  <?php } ?>
				  <?php $n++;}unset($n); ?>
                </table>
            </div>
			<span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
		</div>
	</div>
</div>
<div class="clear"></div>
<?php include template('member', 'footer'); ?>
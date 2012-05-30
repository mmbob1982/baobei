<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'member_header'); ?>
<link href="<?php echo CSS_PATH;?>dialog.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>content_addtop.js"></script>
<div id="memberArea">
	<?php include template('yp', 'member_left'); ?>
	<div class="col-auto">
		<div class="col-1 ">
			<div class="tab-but cu-span"><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=content&action=list&status=99&modelid=<?php echo $modelid;?>&t=3"<?php if($_GET['status']==99) { ?> class="on"<?php } ?>><span>已通过</span></a><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=content&action=list&posids=1&modelid=<?php echo $modelid;?>&t=3"<?php if($_GET['posids']==1) { ?> class="on"<?php } ?>><span>已推荐</span></a><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=content&action=list&modelid=<?php echo $modelid;?>&t=3"<?php if(!$_GET['status'] && !$_GET['posids']) { ?> class="on"<?php } ?>><span>未通过</span></a></div>
			<div class="content">
		<form name="myform" id="myform" action="" method="post" >
			<table width="100%" cellspacing="0"  class="table-list">
        <thead>
            <tr>
			<th width="16"><input type="checkbox" value="" id="check_box" onclick="selectall('ids[]');"></th>
			<th width="37"><?php echo L('listorder');?></th>
            <th width="30">ID</th>
            <th><?php echo L('title');?></th>
            <th width="80"><?php echo L('category');?></th>
            <th width="80">添加时间</th>
            <th width="90">操作</th>
            </tr>
        </thead>
    <tbody>
	<?php $n=1;if(is_array($datas)) foreach($datas AS $info) { ?> 
	<tr>
	<td align="center"><input class="inputcheckbox " name="ids[]" value="<?php echo $info['id'];?>" type="checkbox"></td>
	<td align='center'><input name='listorders[<?php echo $info['id'];?>]' type='text' size='3' value='<?php echo $info['listorder'];?>' class='input-text-c'></td>
	<td align="center"><?php echo $info['id'];?></td>
	<td align="left"><a href="<?php echo $info['url'];?>" target="_blank" title="<?php echo $info['title'];?>"><?php echo str_cut($info['title'], 60);?></a><?php if($info['posids']) { ?> <img src="<?php echo IMG_PATH;?>icon/small_elite.gif" ><?php } ?> <?php if($info[status]==0) { ?><font color="red"><?php echo L('reject_content');?></font><?php } ?></td>
	<td align="center"><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=content&action=list&catid=<?php echo $info['catid'];?>&modelid=<?php echo $modelid;?>&status=<?php echo intval($_GET['status']);?>" title="按分类管理"><?php echo $CATEGORYS[$info['catid']]['catname'];?></a></td>
	<td align="center"><?php echo date('Y-m-d',$info['inputtime']);?></td>
	<td align="center"><?php if($info[status]==99) { ?><font color="#1D94C7">通过</font> <a href="index.php?m=yp&c=business&a=content&action=edit&modelid=<?php echo $modelid;?>&id=<?php echo $info['id'];?>">修改</a> <a href="javascript:void();" onclick="top_info('<?php echo $info['id'];?>', '<?php echo $modelid;?>');return false;"><font color="red">推荐</font></a><?php } elseif ($info[status]==1) { ?>审核中<?php } elseif ($info['status']==0) { ?><a href="index.php?m=yp&c=business&a=content&action=edit&modelid=<?php echo $modelid;?>&id=<?php echo $info['id'];?>">修改</a><?php } ?></td>
	</tr>
	<?php $n++;}unset($n); ?>
    </tbody>
    </table>
	</form>
 <div class="btn"><label for="check_box"><?php echo L('selected_all');?>/<?php echo L('cancel');?></label>
    	<input type="button" class="button" value="排序" onclick="myform.action='?m=yp&c=business&a=content&action=listorder&dosubmit=1&modelid=<?php echo $modelid;?>';myform.submit();"/>
		<input type="button" class="button" value="<?php echo L('delete');?>" onclick="myform.action='?m=yp&c=business&a=content&action=delete&dosubmit=1&modelid=<?php echo $modelid;?>';return confirm_delete()"/>
		<input type="button" class="button" value="刷新" title="更新修改时间，有利于排序" onclick="myform.action='?m=yp&c=business&a=content&action=update&dosubmit=1&modelid=<?php echo $modelid;?>';myform.submit();"/>
		</td></tr>
		</table>
		</div>
	</div>
 <div id="pages"> <?php echo $pages;?></div>

			</div>
			<span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
		</div>
	</div>
</div>
<div class="clear"></div>
<script language="JavaScript">
<!--
	function c_c(catid) {
		location.href='index.php?m=member&c=content&a=published&siteid=<?php echo $siteid;?>&catid='+catid;
	}

	function selectall(name) {
		if ($("#check_box").attr("checked")==false) {
			$("input[name='"+name+"']").each(function() {
				this.checked=false;
			});
		} else {
			$("input[name='"+name+"']").each(function() {
				this.checked=true;
			});
		}
	}

	function confirm_delete(){
		if(confirm('<?php echo L('confirm_delete', array('message' => L('selected')));?>')) $('#myform').submit();
	}

	function top_info(id, modelid) {
		art.dialog({title:'编辑', id:'top', iframe:'<?php echo APP_PATH;?>index.php?m=yp&c=business&a=content&action=info_top&id='+id+'&modelid='+modelid ,width:'600px',height:'200px'}, 	function(){var d = window.top.art.dialog({id:'top'}).data.iframe;
		var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'top'}).close()});
	}
//-->
</script>
<?php include template('member', 'footer'); ?>
<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'member_header'); ?>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>admin_common.js"></script> 
<link href="<?php echo CSS_PATH;?>dialog.css" rel="stylesheet" type="text/css" /> 
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>
<div id="memberArea">
<?php include template('yp', 'member_left'); ?>
<div class="col-auto">
<div class="col-1 ">
<div class="tab-but cu-span"><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=guestbook&status=1&t=3" <?php if($status=='1') { ?> class="on" <?php } ?>><span>�Ѷ�����</span></a><a href="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=guestbook&status=0&t=3" <?php if(!$status) { ?> class="on" <?php } ?>><span>δ������</span></a></div>
<div class="content"> 
<form name="myform" id="myform" action="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=guestbook&action=delete" method="post" >
<table width="100%" cellspacing="0"  class="table-list">
        <thead>
            <tr>
            <th width="5%"><input type="checkbox" value="" id="check_box" onclick="selectall('gid[]');"></th>
            <th width="35%">����ժҪ</th>
            <th width="15%">��Ϣ����</th>
            <th width="15%">����ʱ��</th>
			<th width="8%">״̬</th>
            <th width="8%">����</th>
            </tr>
        </thead>
    <tbody>
	<?php $n=1;if(is_array($infos)) foreach($infos AS $info) { ?> 
	<tr>
	<td width="5%" align="center"><input type="checkbox" name="gid[]" value="<?php echo $info['gid'];?>"></td>
	<td  width="35%" align=""><?php echo $info['content'];?></a></td>
	<td width="15%" align="center"><a href="<?php echo $info['url'];?>" target="_blank" title="����鿴���Զ�Ӧ��Ϣ"><?php echo str_cut($info['title'],20,false);?></a></td>
	<td width="15%" align="center"><?php echo date('Y-m-d',$info['addtime']);?></td>
	<td width="8%" align="center"><?php if($info['status']=='1') { ?><font color=green>�Ѷ�</font><?php } else { ?><font color=red>δ��</font><?php } ?> </td>
	<td width="8%" align="center"><a href="?m=yp&c=business&a=guestbook&action=edit&gid=<?php echo $info['gid'];?>&t=3">�鿴 </a></td>
	</tr>
	<?php $n++;}unset($n); ?>
    </tbody>
    </table>
<div class="btn"><a href="#" onClick="javascript:$('input[type=checkbox]').attr('checked', true)">ȫѡ</a>/<a href="#" onClick="javascript:$('input[type=checkbox]').attr('checked', false)">ȡ��</a> 
<input name="submit" type="submit" class="button" value="ɾ��ѡ��" onClick="return confirm('ȷ��Ҫɾ�� �� ѡ�� �� ��')">&nbsp;&nbsp;</div> 

</form>   

<div id="pages"><?php echo $pages;?></div>
</div>
<span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
</div>

</div>
</div>
<script type="text/javascript">
function read(id, name) {
	window.top.art.dialog({id:'sell_all'}).close();
	window.top.art.dialog({title:'�鿴����'+name+' ',id:'edit',iframe:'?m=message&c=index&a=read&messageid='+id,width:'700',height:'450'}, function(){var d = window.top.art.dialog({id:'see_all'}).data.iframe;var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'see_all'}).close()});
}
function checkuid() {
	var ids='';
	$("input[name='id[]']:checked").each(function(i, n){
		ids += $(n).val() + ',';
	});
	if(ids=='') {
		window.top.art.dialog({content:'��ѡ����ִ�в���',lock:true,width:'200',height:'50',time:1.5},function(){});
		return false;
	} else {
		myform.submit();
	}
}

</script>
<?php include template('member', 'footer'); ?>


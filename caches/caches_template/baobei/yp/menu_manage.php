<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('yp', 'member_header'); ?>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>admin_common.js"></script> 
<link href="<?php echo CSS_PATH;?>dialog.css" rel="stylesheet" type="text/css" /> 
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>
<div id="memberArea">
<?php include template('yp', 'member_left'); ?>
<div class="col-auto">
<div class="col-1 ">
<h6 class="title">前台菜单管理</h6>
<div class="content"> 
<form name="myform" id="myform" action="<?php echo APP_PATH;?>index.php?m=yp&c=business&a=menu" method="post" >
<table width="100%" cellspacing="0"  class="table-list">
        <thead>
            <tr>
            <th width="10%"> 启用</th>
            <th width="10%"> 排序</th>
            <th width="20%">菜单名称</th>
            <th width="60%">链接地址</th>
            </tr>
        </thead>
    <tbody>
    
  	<?php foreach($menus['list'] AS $k=>$v) {?>
	<tr id="menu_id<?php echo $k;?>">
	<td width="10%" align="center">
	<input type="checkbox" name="catname[<?php echo $v;?>][used]" value="1" <?php if($menus['catname'][$v]['used']=='1') { ?>checked<?php } ?>>
	<input type="hidden" name="catname[<?php echo $v;?>][is_system]" value="<?php echo $menus['catname'][$v]['is_system'];?>">
	<input type="hidden" name="list_catid[<?php echo $k;?>]" value="<?php echo $v;?>">
	</td>
	<td width="10%" align="center"><input type="text" size='3' name="list[<?php echo $k;?>]" value="<?php echo $k;?>"></td>
	<td  width="20%" align=""><input name="catname[<?php echo $v;?>][catname]" type="text" size="15" value="<?php echo $menus['catname'][$v]['catname'];?>" class="input-text"><input name="catname[<?php echo $v;?>][id]" type="hidden" value="<?php echo $menus['catname'][$v]['id'];?>"></td>
	<td width="60%" align="left"><input name="catname[<?php echo $v;?>][linkurl]" type="text" size="46" value="<?php echo $menus['catname'][$v]['linkurl'];?>" class="input-text" <?php if($menus['catname'][$v]['is_system']=='1') { ?>readonly title="此为系统菜单，不允许修改！"<?php } ?>> 
 	<?php if($menus['catname'][$v][is_system]=='0') { ?>
	<input type="button" value="删除" onclick="del_old(<?php echo $k;?>)" class="button">
	<?php } ?>
	</td>
	</tr>
	<?php }?> 
	 
	<tr>
	<td width="10%" align="center"><input type="checkbox" name="new_used" value="1" checked></td>
	<td width="10%" align="center"><input type="text" size='3' name="new_list" value=""></td>
	<td  width="20%" align=""><input name="new_catname" type="text" size="15" value="" class="input-text"></td>
	<td width="60%" align="left"><input name="new_linkurl" type="text" size="46" value="" class="input-text" ></td>
	</tr> 
	 
    </tbody>
    </table>
<div class="btn"><a href="#" onClick="javascript:$('input[type=checkbox]').attr('checked', true)">全选</a>/<a href="#" onClick="javascript:$('input[type=checkbox]').attr('checked', false)">取消</a> 
<input name="submit" type="submit" class="button" value="保存设置" onClick="return confirm('确认要修改 『 选中 』 吗？')">&nbsp;&nbsp;</div> 

</form>   

<div id="pages"><?php echo $pages;?></div>
</div>
<span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
</div>

</div>
</div>
<script type="text/javascript">
function del_old(id) {
	$("div [id=\'menu_id"+id+"\']").remove(); 
} 

function read(id, name) {
	window.top.art.dialog({id:'sell_all'}).close();
	window.top.art.dialog({title:'查看详情'+name+' ',id:'edit',iframe:'?m=message&c=index&a=read&messageid='+id,width:'700',height:'450'}, function(){var d = window.top.art.dialog({id:'see_all'}).data.iframe;var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'see_all'}).close()});
}
function checkuid() {
	var ids='';
	$("input[name='messageid[]']:checked").each(function(i, n){
		ids += $(n).val() + ',';
	});
	if(ids=='') {
		window.top.art.dialog({content:'请选择再执行操作',lock:true,width:'200',height:'50',time:1.5},function(){});
		return false;
	} else {
		myform.submit();
	}
}

</script>
<?php include template('member', 'footer'); ?>


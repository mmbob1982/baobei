<?php defined('IN_PHPCMS') or exit('No permission resources.');?>
<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td>ѡ������</td>
      <td>
	  <input type="radio" name="setting[boxtype]" value="pop" <?php if($setting['boxtype']=='pop') echo 'checked';?>/> �������
	  <input type="radio" name="setting[boxtype]" value="down" <?php if($setting['boxtype']=='down') echo 'checked';?> /> �������
	  <input type="radio" name="setting[boxtype]" value="multiple" <?php if($setting['boxtype']=='multiple') echo 'checked';?> /> ˫��ѡ��
	  </td>
    </tr>
	<tr> 
      <td>�Ƿ���Ϊɸѡ�ֶ�</td>
      <td>
	  <input type="radio" name="setting[filtertype]" value="1" <?php if($setting['filtertype']) echo 'checked';?> /> �� 
	  <input type="radio" name="setting[filtertype]" value="0" <?php if(!$setting['filtertype']) echo 'checked';?>/> ��
	  </td>
    </tr>
</table>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function fieldtype_setting(obj) {
	if(obj!='varchar') {
		$('#minnumber').css('display','');
	} else {
		$('#minnumber').css('display','none');
	}
}
//-->
</SCRIPT>
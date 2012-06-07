<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td>菜单ID</td>
      <td><input type="text" id="linkboxsid" name="setting[linkboxsid]" 
	  value="0" size="5" class="input-text"> 
	  <input type='button' value="在列表中选择" 
	  onclick="omnipotent('selectid','?m=admin&c=linkboxs&a=public_get_list','在
	  列表中选择')" class="button">
		请到导航 扩展 > 联动菜单 > 添加联动菜单</td>
    </tr>
	<tr>
	<td>显示方式</td>
	<td>
      	<input name="setting[showtype]" value="0" type="radio">
        只显示名称
        <input name="setting[showtype]" value="1" type="radio">
        显示完整路径  
        <input name="setting[showtype]" value="2" type="radio">
        返回菜单id		
	</td></tr>
	<tr> 
      <td>路径分隔符</td>
      <td><input type="text" name="setting[space]" value="" size="5" 
	  class="input-text"> 显示完整路径时生效</td>
    </tr>	
     <tr> 
      <td>最多添加数量</td>
      <td><input type="text" name="setting[most]" value="" size="5" 
	  class="input-text">用户最多添加的数据行数</td>
    </tr>        	
</table>

<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php if($modelid == MODELID_PRODUCTION) { ?>
	<?php $userid = $this->memberinfo['userid'];?>
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=b56e9fa9ea3fbd09d1b9d9e490f1f209&sql=select+%2A+from+phpcms_yp_brand+where+userid+%3D+%24userid+and+status%3D99&return=brand_arr\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("select * from phpcms_yp_brand where userid = $userid and status=99 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$brand_arr = $a;unset($a);?>
	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	<tr>
		<th width="100">所属品牌：</th> 
		<td>
			<select name="info[brand]">
				<option value="0">请选择品牌</option>
				<?php $n=1;if(is_array($brand_arr)) foreach($brand_arr AS $brand) { ?>
				<option value="<?php echo $brand['id'];?>" <?php if($brand['id'] == $data['brand']) { ?>selected="selected"<?php } ?>><?php echo $brand['title'];?></option>
				<?php $n++;}unset($n); ?>
			</select>
		</td>
	</tr>
<?php } ?>
					
<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php $tpl_dir = $this->default_tpl;?>
<?php include template($tpl_dir, 'header'); ?>
<script type="text/javascript" src="<?php echo JS_PATH;?>formvalidatorregex.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>formvalidator.js" charset="UTF-8"></script>
<link href="<?php echo CSS_PATH;?>table_form.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#username").formValidator({onshow:"����������",onfocus:"��������Ϊ��"}).inputValidator({min:1,max:999,onerror:"��������Ϊ��"});
	$("#code").formValidator({onshow:"��������֤��",onfocus:"��֤�벻��Ϊ��"}).inputValidator({min:1,max:999,onerror:"��֤�벻��Ϊ��"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"m=pay&c=deposit&a=public_checkcode",
		datatype : "html",
		async:'false',
		success : function(data){	
            if(data == 1){
                return true;
			}
            else
			{
                return false;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "��֤�����",
		onwait : "��֤��"
	});
}) 
//-->
</script>

<div class="main clear">
  <div class="col-auto">
      <?php include template('yp/com_default', 'block_contact'); ?>
   	  <h2 class="crumbs">��������<span>/GUESTBOOK</span></h2>
      <div class="book-form">
          <form action="" method="post" name="myform" id="myform"> 
          <ul>
              <li><label>������</label><input name="info[username]" id="username" type="text" size="20" maxlength="20" value=""></li>
              <li><label>QQ/E-mail��</label><input name="info[qq]" id="qq" type="text" size="20" maxlength="20" value=""></li>
              <li><label>��ϵ�绰��</label><input name="info[telephone]" id="telephone" type="text" size="20" maxlength="20" value=""></li>
              <li><label>�������ݣ�</label><textarea name="info[content]" id="content" rows="5" cols="50" value=""></textarea></li>
			  <li><label>�������ݣ�</label><input name="code" type="text" id="code" size="10"  class="input-text"/> <?php echo form::checkcode('code_img','4','14',110,30);?></li>
              <li><label><input name="info[userid]" type="hidden" value="<?php echo $array['userid'];?>" /></label><input name="dosubmit" class="submit-input btn" type="submit" value=" �ύ���� "></li>
          </ul>
          </form>
      </div>
  </div>
</div>
<?php include template('yp/com_default', 'footer'); ?>
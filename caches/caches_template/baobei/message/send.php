<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('member', 'header'); ?>
<div id="memberArea">
<?php include template('member', 'left'); ?>
<div class="col-auto">
<div class="col-1 ">
<h6 class="title">���Ͷ���Ϣ</h6>
<div class="content">
<form name="myform" action="<?php echo APP_PATH;?>index.php?m=message&c=index&a=send" method="post" id="myform">
<table width="100%" cellspacing="0" class="table_form">
    <tr>
       <th>�����ˣ�</th>
       <td><input name="info[send_to_id]" type="text" id="username" size="30" value=""  class="input-text"/> </td>
     </tr>
     <tr>
       <th>�� �⣺</th>
       <td><input name="info[subject]" type="text" id="subject" size="30" value=""  class="input-text"/></td>
     </tr>  
     <tr>
       <th>�� �ݣ�</th>
       <td><textarea name="info[content]"  id="con" rows="5" cols="50"></textarea></td>
     </tr>
     <tr>
       <th>��֤�룺</th>
       <td><input name="code" type="text" id="code" size="10"  class="input-text"/> <?php echo form::checkcode('code_img','4','14',110,30);?></td>
     </tr>
     <tr>
       <td></td>
       <td colspan="2"><label>
         <input type="submit" name="dosubmit" id="dosubmit" value="ȷ ��" class="button"/>
         </label></td>
     </tr>
   </table>
   </form>
   </div>
   <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
   </div>
   </div>
</div>
<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#subject").formValidator({onshow:"���������",onfocus:"���ⲻ��Ϊ��"}).inputValidator({min:1,max:999,onerror:"���ⲻ��Ϊ��"});
	$("#con").formValidator({onshow:"����������",onfocus:"���ݲ���Ϊ��"}).inputValidator({min:1,max:999,onerror:"���ݲ���Ϊ��"});
	$("#username").formValidator({onshow:"����д������",onfocus:"�����˲���Ϊ��"}).inputValidator({min:1,onerror:"�������ռ���ID"}).ajaxValidator({type : "get",url : "",data :"m=message&c=index&a=public_name",datatype : "html",async:'false',success : function(data){if( data == 1 ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "��ֹ���Լ����ע���û�������Ϣ! ",onwait : "����������...."});
	
	$("#code").formValidator({onshow:"��������֤��",onfocus:"��֤�벻��Ϊ��"}).inputValidator({min:1,max:999,onerror:"��֤�벻��Ϊ��"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"m=pay&c=deposit&a=public_checkcode",
		datatype : "html",
		async:'false',
		success : function(data){	
            if(data == 1)
			{
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

$(function(){
	$(".payment-show").each(function(i){
		if(i==0){
			$(this).addClass("payment-show-on");
		}
   		$(this).click(
			function(){
				$(this).addClass("payment-show-on");
				$(this).siblings().removeClass("payment-show-on");
			}
		)
 	});
	
})
//-->
</script>
<?php include template('member', 'footer'); ?>
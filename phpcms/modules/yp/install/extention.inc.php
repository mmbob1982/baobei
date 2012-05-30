<?php
error_reporting(E_ALL);
defined('IN_PHPCMS') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');
define('SQL_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

$parentid = $menu_db->insert(array('name'=>'yp', 'parentid'=>2, 'm'=>'yp', 'c'=>'yp', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'yp_setting', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'yp', 'a'=>'setting', 'data'=>'', 'listorder'=>0, 'display'=>'1'));
$second_pid = $menu_db->insert(array('name'=>'yp_category_manage', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'category', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'yp_add_category', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'category', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name'=>'yp_edit_category', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'category', 'a'=>'edit', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'export_category', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'category', 'a'=>'export', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'del_category', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'category', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'listorder_category', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'category', 'a'=>'listorder', 'data'=>'', 'listorder'=>0, 'display'=>'0'));


$second_pid = $menu_db->insert(array('name'=>'yp_model_manage', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'ypmodel', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'add_yp_model', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'ypmodel', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'edit_yp_model', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'ypmodel', 'a'=>'edit', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'del_yp_model', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'ypmodel', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'ypmodel_import', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'ypmodel', 'a'=>'import', 'data'=>'', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name'=>'disabled_ypmodel', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'ypmodel', 'a'=>'disabled', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'export_ypmodel', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'ypmodel', 'a'=>'export', 'data'=>'', 'listorder'=>0, 'display'=>'0'));

$three_pid = $menu_db->insert(array('name'=>'yp_fields_manage', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'ypmodel_field', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'0'), true);
$menu_db->insert(array('name'=>'add_yp_field', 'parentid'=>$three_pid, 'm'=>'yp', 'c'=>'ypmodel_field', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'edit_yp_field', 'parentid'=>$three_pid, 'm'=>'yp', 'c'=>'ypmodel_field', 'a'=>'edit', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'disabled_yp_field', 'parentid'=>$three_pid, 'm'=>'yp', 'c'=>'ypmodel_field', 'a'=>'disabled', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'delete_yp_field', 'parentid'=>$three_pid, 'm'=>'yp', 'c'=>'ypmodel_field', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'listorder_yp_field', 'parentid'=>$three_pid, 'm'=>'yp', 'c'=>'ypmodel_field', 'a'=>'listorder', 'data'=>'', 'listorder'=>0, 'display'=>'0'));

$second_pid = $menu_db->insert(array('name'=>'company_template_manage', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'template', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'add_new_template', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'template', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name'=>'setdefaulttpl', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'template', 'a'=>'tpl_default', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'priv_setting', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'template', 'a'=>'edit_priv', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'template_disabled', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'template', 'a'=>'disabled', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'template_delete', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'template', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));

$second_pid = $menu_db->insert(array('name'=>'yp_info_manage', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'content', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'edit_yp_content', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'content', 'a'=>'edit', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'listorder_yp_content', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'content', 'a'=>'listorder', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'delete_yp_content', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'content', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'push_yp_content', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'push', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'pass_yp_content', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'content', 'a'=>'pass', 'data'=>'', 'listorder'=>0, 'display'=>'0'));


$second_pid = $menu_db->insert(array('name'=>'yp_company_manage', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'company', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'company_edit', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'company', 'a'=>'edit', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'company_delete', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'company', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'company_passed_check', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'company', 'a'=>'passed_check', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'company_elite', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'company', 'a'=>'elite', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$three_pid = $menu_db->insert(array('name'=>'certificate_manage', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'certificate_ht', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'certificate_ht_edit', 'parentid'=>$three_pid, 'm'=>'yp', 'c'=>'certificate_ht', 'a'=>'edit', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'certificate_delete', 'parentid'=>$three_pid, 'm'=>'yp', 'c'=>'certificate_ht', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'passed_check_certificate', 'parentid'=>$three_pid, 'm'=>'yp', 'c'=>'certificate_ht', 'a'=>'passed_check', 'data'=>'', 'listorder'=>0, 'display'=>'0'));

$second_pid = $menu_db->insert(array('name'=>'batch_update', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'update_urls', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'update_urls_menu', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'update_urls', 'a'=>'menu', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'update_urls_category', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'update_urls', 'a'=>'category', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'update_urls_content', 'parentid'=>$second_pid, 'm'=>'yp', 'c'=>'update_urls', 'a'=>'content', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
//�����ֶβ˵�
$parentid = $menu_db->insert(array('name'=>'additional_field', 'parentid'=>977, 'm'=>'yp', 'c'=>'additional', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'additional_add', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'additional', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'additional_edit', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'additional', 'a'=>'edit', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'additional_disabled', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'additional', 'a'=>'disabled', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'additional_delete', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'additional', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'additional_listorder', 'parentid'=>$parentid, 'm'=>'yp', 'c'=>'additional', 'a'=>'listorder', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
//menu���԰�
$language = array('yp'=>'��ҵ��ҳ', 'yp_setting'=>'ģ������', 'yp_category_manage'=>'�������', 'yp_add_category'=>'��ӷ���', 'yp_edit_category'=>'�޸ķ���', 'export_category'=>'��������', 'del_category'=>'ɾ������', 'listorder_category'=>'��������', 'yp_model_manage'=>'��ҳģ�͹���', 'add_yp_model'=>'���ģ��', 'edit_yp_model'=>'�޸�ģ��', 'del_yp_model'=>'ɾ��ģ��', 'ypmodel_import'=>'����ģ��', 'disabled_ypmodel'=>'����ģ��', 'export_ypmodel'=>'����ģ��', 'yp_fields_manage'=>'�ֶι���', 'add_yp_field'=>'����ֶ�', 'edit_yp_field'=>'�޸��ֶ�', 'disabled_yp_field'=>'�����ֶ�', 'delete_yp_field'=>'ɾ���ֶ�', 'listorder_yp_field'=>'�ֶ�����', 'company_template_manage'=>'��ҵģ�����', 'add_new_template'=>'�����ģ��', 'setdefaulttpl'=>'����Ĭ��ģ��', 'priv_setting'=>'Ȩ������', 'template_disabled'=>'ģ�����ùر�', 'template_delete'=>'ģ��ɾ��', 'yp_info_manage'=>'��Ϣ����', 'edit_yp_content'=>'�޸���Ϣ', 'listorder_yp_content'=>'��Ϣ����', 'delete_yp_content'=>'��Ϣɾ��', 'push_yp_content'=>'��Ϣ����',  'pass_yp_content'=>'��Ϣ���/�˸�', 'yp_company_manage'=>'��ҵ�����', 'company_edit'=>'��ҵ�޸�', 'company_delete'=>'��ҵɾ��', 'company_passed_check'=>'��ҵ���/ȡ�����', 'company_elite'=>'��ҵ�Ƽ�/ȡ���Ƽ�', 'certificate_manage'=>'����֤�����', 'certificate_ht_edit'=>'����֤���޸�', 'certificate_delete'=>'ɾ��֤��', 'passed_check_certificate'=>'���֤��', 'batch_update'=>'��������URL', 'update_urls_menu'=>'������ҵ����', 'update_urls_category'=>'���·���url��ַ', 'update_urls_content'=>'��������url', 'additional_field'=>'�����ֶι���', 'additional_add'=>'��Ӹ����ֶ�', 'additional_edit'=>'�޸ĸ����ֶ�', 'additional_disabled'=>'���ø����ֶ�', 'additional_delete'=>'ɾ�������ֶ�', 'additional_listorder'=>'�����ֶ�����');
//ǰ̨�˵�����
$member_menu_db = pc_base::load_model('member_menu_model');
$member_menu_db->insert(array('name'=>'business_centre', 'm'=>'yp', 'c'=>'business', 'a'=>'init', 'data'=>'t=3', 'listorder'=>'4', 'display'=>'1'));
$file = PC_PATH.'languages'.DIRECTORY_SEPARATOR.'zh-cn'.DIRECTORY_SEPARATOR.'member_menu.lang.php';
if(file_exists($file)) {
	$content = file_get_contents($file);
	$content = substr($content,0,-2);
	$data = $content."\$LANG['business_centre'] = '��������';\r\n?>";
	file_put_contents($file,$data);
} else {
	$data = "\$LANG['business_centre'] = '��������';\r\n?>";
	file_put_contents($file,$data);
}
//���category���������ֶ�
$category_db = pc_base::load_model('category_model');
if (!$category_db->field_exists('additional')) {
	$category_db->query("ALTER TABLE `phpcms_category` ADD `additional` TEXT NOT NULL");
}
if (!$category_db->field_exists('commenttypeid')) {
	$category_db->query("ALTER TABLE `phpcms_category` ADD `commenttypeid` SMALLINT UNSIGNED NOT NULL DEFAULT '0'");
}
//��ģ�ͱ������ҵ�⡢���š���Ʒ���̻�ģ��
$sitemodel = pc_base::load_model('sitemodel_model');
$sitemodel_field = pc_base::load_model('sitemodel_field_model');
$com_modelid = $sitemodel->insert(array('siteid'=>'1', 'name'=>'��ҵ��', 'description'=>'��ҵ��Ա', 'tablename'=>'yp_company', 'setting'=>'', 'addtime'=>SYS_TIME, 'type'=>4), true);
$sqls = file_get_contents(SQL_PATH.'company.sql');
$sqls = explode("\n", $sqls);
foreach ($sqls as $sql) {
	$sql = trim(str_replace('$modelid', $com_modelid, $sql));
	$sitemodel_field->query($sql);
}
$models = array();
$setting = array2string(array('ismenu'=>'0', 'meta_title'=>'�й���ȫ�Ļ�ҳ��Ϣ', 'meta_keywords'=>'�й���ȫ�Ļ�ҳ��Ϣ', 'meta_description'=>'�й���ȫ�Ļ�ҳ��Ϣ'));
$models[72] = $sitemodel->insert(array('siteid'=>'1', 'name'=>'����', 'description'=>'', 'tablename'=>'yp_news', 'setting'=>$setting, 'addtime'=>SYS_TIME, 'default_style'=>'default', 'category_template'=>'', 'list_template'=>'', 'show_template'=>'', 'type'=>5), true);
$setting = array2string(array('ismenu'=>'1', 'meta_title'=>'Ʒ����Ʒ �̳Ǳ���', 'meta_keywords'=>'C2C,����ƽ̨,��Ʒ����', 'meta_description'=>'����������Ϲ�����վ�������������B2C����ƽ̨��B2C��Business to Customer�������̳ǹ������100%��Ʒ���ϡ�7���˻������ṩ��Ʊ�ķ��񡣼����̳ǣ���Ϊȫ�µ�B2C��ҵ���������漣��'));
$models[73] = $sitemodel->insert(array('siteid'=>'1', 'name'=>'��Ʒ', 'description'=>'', 'tablename'=>'yp_product', 'setting'=>$setting, 'addtime'=>SYS_TIME, 'default_style'=>'default', 'category_template'=>'model_product', 'list_template'=>'list_product', 'show_template'=>'show_product', 'type'=>5), true);
$models[76] = $sitemodel->insert(array('siteid'=>'1', 'name'=>'�̻�', 'description'=>'', 'tablename'=>'yp_buy', 'setting'=>$setting, 'addtime'=>SYS_TIME, 'default_style'=>'default', 'category_template'=>'model_buy', 'list_template'=>'list_buy', 'show_template'=>'show_buy', 'type'=>5), true);
foreach ($models as $_k => $_m) {
	$sqls = file_get_contents(SQL_PATH.$_k.'.sql');
	$sqls = explode("\n", $sqls);
	foreach ($sqls as $sql) {
		$sql = trim(str_replace('$modelid', $_m, $sql));
		$sitemodel_field->query($sql);
	}
	unset($sqls, $sql);
}
setcache('models', $models, 'yp');
//���û�ҳ��������ģ�ʹ������š���Ʒ���̻���
$yp_content = pc_base::load_model('yp_content_model');
if(file_exists(SQL_PATH.'table.sql')) {
	$sql = file_get_contents(SQL_PATH.'table.sql');
	_sql_execute($sql);
}

function _sql_execute($sql) {
	$r_tablepre = $s_tablepre = '';
	$yp_content = pc_base::load_model('yp_content_model');
    $sqls = _sql_split($sql,$r_tablepre,$s_tablepre);
	if(is_array($sqls)) {
		foreach($sqls as $sql) {
			if(trim($sql) != '') {
				$yp_content->query($sql);
			}
		}
	} else {
		$yp_content->query($sqls);
	}
	return true;
}

function _sql_split($sql) {
	$yp_content = pc_base::load_model('yp_content_model');
	$dbcharset = pc_base::load_config('database','default');
	$dbcharset = $dbcharset['charset'];
	if($yp_content->version() > '4.1' && $dbcharset) {
		$sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=".$dbcharset, $sql);
	}

	$sql = str_replace("\r", "\n", $sql);
	$ret = array();
	$num = 0;
	$queriesarray = explode(";\n", trim($sql));
	unset($sql);
	foreach($queriesarray as $query) {
		$ret[$num] = '';
		$queries = explode("\n", trim($query));
		$queries = array_filter($queries);
		foreach($queries as $query) {
			$str1 = substr($query, 0, 1);
			if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
		}
		$num++;
	}
	return $ret;
}
?>
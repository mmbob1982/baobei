<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);

class yp extends admin {

	private $db;

	function __construct() {
		parent::__construct();
	}

	public function init() {
		include $this->admin_tpl('yp_quick_panel');
	}

	public function setting() {
		$module_db = pc_base::load_model('module_model');
		if (isset($_POST['dosubmit'])) {
			$_POST['setting']['priv'] = $_POST['priv'];
			$setting = array2string($_POST['setting']);
			$module_db->update(array('setting'=>$setting), array('module'=>'yp'));
 			setcache('yp_setting', $_POST['setting']);
  			showmessage(L('operation_success'), HTTP_REFERER);
		} else {
			$grouplists = getcache('grouplist', 'member');
			pc_base::load_sys_class('form', '', '');
			$setting = $module_db->get_one(array('module'=>'yp'), 'setting');
			$setting = string2array($setting['setting']);
			$show_validator = 1;

 			//�������� - ����
			$v = array();
			//��ȡ��ҳģ�ͻ�������
			$yp_models = getcache('yp_model','model');
			//��ȡ֮ǰ����
			$yp_setting = $setting['priv'] ? $setting['priv'] : array();

 			//ѭ����ҳģ��
			$member_models = getcache('grouplist','member');
 			include $this->admin_tpl('yp_setting');
		}
	}
}
?>
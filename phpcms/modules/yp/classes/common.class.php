<?php

class common {
	public $db, $company_db, $memberinfo,$setting;

	public function __construct() {
		$this->db = pc_base::load_model('member_model');
		$this->company_db = pc_base::load_model('yp_company_model');
		$this->memberinfo = '';
		$this->_userid = param::get_cookie('_userid');
		$this->groupid = param::get_cookie('_groupid');
		$this->setting = getcache('yp_setting', 'yp');
		//��֤�û��Ƿ��¼���Ƿ�����ҵ�û�
		self::check_member();
	}

	/**
	 * �ж��û��Ƿ�Ϊ��ҵ��Ա
	 */
	final public function check_member() {

		//�ж��û��Ƿ��¼
		$forward= isset($_GET['forward']) ?  urlencode($_GET['forward']) : urlencode(get_url());

		if (!$this->_userid) showmessage(L('please_login', '', 'member'), APP_PATH.'index.php?m=member&c=index&a=login&forward='.$forward);
		//��ȡ��ҳģ�ͻ���
		$this->yp_models = getcache('yp_model', 'model');
		if (isset($_GET['modelid']) && !empty($_GET['modelid'])) {
			$modelid = intval($_GET['modelid']);
			if ($this->setting['priv'][$this->groupid][$modelid]==0) {
				$grouplist = getcache('grouplist', 'member');
				if ($grouplist[$this->groupid]['allowupgrade']) showmessage(L('have_no_right_publish'), APP_PATH.'index.php?m=member&c=index&a=account_manage_upgrade&t=1');
				else showmessage(L('have_no_right_publish'));
			}
		}
		//��ѯ���û��Ƿ�����ҵ���д���
		$_memberinfo = $this->company_db->get_one(array('userid'=>$this->_userid));
		if(ROUTE_M =='yp' && ROUTE_C =='business' && in_array(ROUTE_A, array('register'))) {
			if (isset($_memberinfo['status']) && $_memberinfo['status'] == 0) {
				showmessage(L('please_wait_review'), APP_PATH.'index.php?m=yp&c=index');
			}
			return true;
		} else {
			if ($_memberinfo) {
				if (ROUTE_A=='content' && $_memberinfo['status'] == 0) {
					showmessage(L('please_be_patient'), APP_PATH.'index.php?m=yp&c=business&t=3');
				}
				$memberinfo = $this->db->get_one(array('userid'=>$this->_userid));
				$this->memberinfo = array_merge($memberinfo, $_memberinfo);
			} else {
				showmessage(L('please_register_business'), APP_PATH.'index.php?m=yp&c=business&a=register&t=3');
			}
		}
	}
}
?>
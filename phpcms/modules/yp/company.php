<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);
pc_base::load_sys_class('form', '', '');
class company extends admin {
	private $yp_company,$db;

	function __construct() {
		parent::__construct();
		$this->yp_company = pc_base::load_model('yp_company_model');
		$this->db = pc_base::load_model('member_model');
  	}

	public function init() {
 		$status = $_GET['status'];
		$elite = $_GET['elite'];
		if($status!=''){
			$where = array("status"=>$status);
			if($elite!=""){
			$where = array("status"=>$status,"elite"=>'1');
			}
		}else{
			if($elite!=""){
			$where = array("elite"=>'1');
			}
		}
		$page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
		$infos = $this->yp_company->listinfo($where,$order = 'regtime desc',$page, $pages = '9');
		$pages = $this->yp_company->pages;
 		$show_header = true;
 		include $this->admin_tpl('company_list');
 	}

 	/**
 	 * �޸���ҵ��Ա
 	 */
 	public function edit () {
 		$userid = intval($_GET['userid']);
	 	if (!$userid) showmessage(L('illegal_parameters'), APP_PATH.'index.php?m=yp&c=company&a=init');
	 	//���ػ�Ա�����Ӧ������ģ��
	 	$yp_relation_db = pc_base::load_model('yp_relation_model');
 		if (isset($_POST['dosubmit'])) {
 			$modelid = $_POST['modelid'];
 			$info = new_addslashes($_POST['info']);
 			$catids = $info['catids'];
 			require_once CACHE_MODEL_PATH.'yp_input.class.php';
 			$yp_input = new yp_input($modelid);
			$inputinfo = $yp_input->get($info);
			$data = $inputinfo['system'];
			$this->yp_company->update($data, array('userid'=>$userid));
			//ɾ����ǰ�Ķ�Ӧ��ϵ�����¼�¼��Ӧ��ϵ
			$yp_relation_db->delete(array('userid'=>$userid));
 			foreach ($catids as $c) {
				$yp_relation_db->insert(array('userid'=>$userid, 'catid'=>$c));
			}
 			showmessage(L('operation_success'), '', '', 'edit');
 		} else {
	 		$sitemodel_db = pc_base::load_model('sitemodel_model');
	 		$r = $sitemodel_db->get_one(array('type'=>4), 'modelid');
	 		$modelid = $r['modelid'];
	 		$catids = ',';
	 		$res = $yp_relation_db->select(array('userid'=>$userid), 'catid');
	 		if (is_array($res) && !empty($res)) {
	 			foreach ($res as $c) {
	 				$catids .= $c['catid'].',';
	 			}
	 		}
	 		require CACHE_MODEL_PATH.'yp_form.class.php';
	 		$data = $this->yp_company->get_one(array('userid'=>$userid));
	 		$data['catids'] = $catids;
	 		$yp_form = new yp_form($modelid);
	 		$data = $yp_form->get($data);
	 		$forminfos = $data['base'];
 		}
 		$show_header = true;
 		include $this->admin_tpl('company_edit');
 	}

	/**
	 * ɾ����˾��Ϣ
	 * @param	intval	$sid	��¼ID���ݹ�ɾ��
	 */
	public function delete() {
  		if((!isset($_GET['userid']) || empty($_GET['userid'])) && (!isset($_POST['userid']) || empty($_POST['userid']))) {
			showmessage(L('illegal_parameters'), HTTP_REFERER);
		} else {
			if(is_array($_POST['userid'])){
				foreach($_POST['userid'] as $userid_arr) {
 					//ɾ�����ݿ���Ϣ
					$this->yp_company->delete(array('userid'=>$userid_arr));
					$this->delete_relation($userid_arr);
				}
				showmessage(L('operation_success'),HTTP_REFERER);
			}else{
				$userid = intval($_GET['userid']);
				if($userid < 1) return false;
				//ɾ����¼
				$result = $this->yp_company->delete(array('userid'=>$userid));
				$this->delete_relation($userid);
				if($result){
					showmessage(L('operation_success'),HTTP_REFERER);
				}else {
					showmessage(L("operation_failure"),HTTP_REFERER);
				}
			}
 		}
	}

	/**
	 *
	 * ɾ����ҵ��ͬ��ɾ���������࣬������ҵ�����ʱ����USERID��û�ж�Ӧ��ҵ��Ϣ������ ...
	 * @param unknown_type $userid
	 */
	public function delete_relation($userid){
		if(!$userid){
			return false;
		}
		$this->yp_relation = pc_base::load_model('yp_relation_model');
 		$this->yp_relation->delete(array('userid'=>$userid));
	}

	/**
	 *
	 * ������ҵ ...
	 */
	public function seache_company(){
		$where = '';
 		$username = $_POST['search']['username'];
		$start_time = $_POST['search']['start_time'];
		$end_time = $_POST['search']['end_time'];
		if($username){
			//��ȡUSERID
			$member_db = pc_base::load_model('member_model');
			$member_array = $member_db->get_one(array('username'=>$username),'userid');
			$userid = $member_array['userid'];
			$where .= $where ?  " AND userid='$userid'" : " userid='$userid'";
		}
		if($start_time && $end_time) {
			$start = strtotime($start_time);
			$end = strtotime($end_time);
			$where .= "AND `addtime` >= '$start' AND `addtime` <= '$end' ";
		}
		$page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
		$infos = $this->yp_company->listinfo($where,$order = 'regtime desc',$page, $pages = '9');
		$pages = $this->yp_company->pages;
 		$show_header = true;
 		include $this->admin_tpl('company_list');
	}

	/**
	 *
	 * �Ƽ���ҵ  ...
	 */
	public function elite(){
		if((!isset($_POST['userid']) || empty($_POST['userid']))) {
				showmessage(L('illegal_parameters'), HTTP_REFERER);
		} else {
			$status = $_GET['status'];
			foreach($_POST['userid'] as $userid_arr) {
				//�����Ƽ���ҵ
				$data = array('elite'=>$status);
				$this->yp_company->update($data,array('userid'=>$userid_arr));
			}
		}
 		showmessage(L("operation_success"),HTTP_REFERER);
	}

	/**
	 *
	 * ͨ�������Ա���� ...
	 */
	public function passed_check(){
		if((!isset($_GET['userid']) || empty($_GET['userid'])) && (!isset($_POST['userid']) || empty($_POST['userid']))) {
				showmessage(L('illegal_parameters'), HTTP_REFERER);
		} else {
			$status = $_GET['status'];
			if(is_array($_POST['userid'])){
				foreach($_POST['userid'] as $userid_arr) {
					//�������ͨ����ҵ����
					$data = array('status'=>$status);
					$this->yp_company->update($data,array('userid'=>$userid_arr));
 				}
  			}else{
				$userid = intval($_GET['userid']);
				if(!$userid){
				return false;
				}
				$data = array('status'=>$status);
				$this->yp_company->update($data,array('userid'=>$userid));
			}
		}
		showmessage(L("operation_success"),HTTP_REFERER);
	}

}
?>
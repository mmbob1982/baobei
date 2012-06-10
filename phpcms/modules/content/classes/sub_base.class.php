<?php
/**
 * ��վ������
 */
defined('IN_PHPCMS') or exit('No permission resources.');
//ģ�ͻ���·��
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
pc_base::load_app_func('util','content');

class sub_base{
	protected $db;
	//��ҵ����
	protected $sub_linkageid = 0;
	//��ҵ��������
	protected $sub_linkageid_arrchildid = '';
	protected $sub_linkageid_arrchildid_arr = array();
	//��Ʒ����
	protected $product_linkageid = 0;
	//��Ʒ��������
	protected $product_linkageid_arrchildid = '';
	protected $product_linkageid_arrchildid_arr = array();
	
	function __construct() {
		$this->db = pc_base::load_model('content_model');
		$this->_userid = param::get_cookie('_userid');
		$this->_username = param::get_cookie('_username');
		$this->_groupid = param::get_cookie('_groupid');
		
		//�趨����
		$this->_setArrchildid();
	}
	
	private function _setArrchildid(){
		$linkageid_arr = getcache(3360, 'linkage');
		$linkageid_arr = $linkageid_arr['data'];
		$this->sub_linkageid_arrchildid = $linkageid_arr[$this->sub_linkageid]['arrchildid'];
		$this->sub_linkageid_arrchildid_arr = explode(',', $this->sub_linkageid_arrchildid);
		$this->sub_linkageid_arrchildid_arr = array_filter($this->sub_linkageid_arrchildid_arr);
		
		$linkageid_arr = getcache(3413, 'linkage');
		$linkageid_arr = $linkageid_arr['data'];
		$this->product_linkageid_arrchildid = $linkageid_arr[$this->product_linkageid]['arrchildid'];
		$this->product_linkageid_arrchildid_arr = explode(',', $this->product_linkageid_arrchildid);
		$this->product_linkageid_arrchildid_arr = array_filter($this->product_linkageid_arrchildid_arr);
		
		unset($linkageid_arr);
	}
	
	//��վ��ҳ
	function init(){
		
	}
	
	function company(){
		$company_db = pc_base::load_model('company_model');
		$recommend_company_arr = $company_db->get_recommend_company($this->sub_linkageid_arrchildid, '*', 2);
		$newest_company_arr = $company_db->get_newest_company($this->sub_linkageid_arrchildid, '*', 2);
		
		
		$trade_db = pc_base::load_model('trade_model');
		$newest_trade = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, '', 2);
		var_dump($newest_trade);
	}
}
?>
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
	//��Ѷ
	protected $sub_news_catid = 0;
	protected $sub_news_modelid = 1;	//Ĭ��ʹ������ģ��
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
		$this->db->set_model($this->sub_news_modelid);
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
	
	//��ҵ
	function company(){
		$company_db = pc_base::load_model('company_model');
		$recommend_company_arr = $company_db->get_recommend_company($this->sub_linkageid_arrchildid, '*', 30);
		$newest_company_arr = $company_db->get_newest_company($this->sub_linkageid_arrchildid, '*', 20);
		
		//����������
		$trade_db = pc_base::load_model('trade_model');
		$newest_trade = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, '', '', 20);
		var_dump($newest_trade);

		include template('sub', 'company');
	}
	
	//Ʒ��
	function brand(){
		$brand_db = pc_base::load_model('brand_model');
		$recommend_brand_arr = $brand_db->get_recommend_brand($this->sub_linkageid_arrchildid, '*', 28);
		$newest_brand_arr = $brand_db->get_newest_brand($this->sub_linkageid_arrchildid, '*', 20);
		
		var_dump($recommend_brand_arr);
		var_dump($newest_brand_arr);
		
		//����������
		$trade_db = pc_base::load_model('trade_model');
		$newest_trade = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, '', 20);
		
		include template('sub', 'brand');
	}
	
	//��Ʒ
	function product(){
		$product_db = pc_base::load_model('product_model');
		$recommend_product_arr = $product_db->get_recommend_product($this->product_linkageid_arrchildid, '*', 28);
		$newest_product_arr = $product_db->get_newest_product($this->product_linkageid_arrchildid, '*', 20);
		
		var_dump($recommend_product_arr);
		var_dump($newest_product_arr);
		
		//����������
		$trade_db = pc_base::load_model('trade_model');
		$newest_trade = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, '', 20);
		
		include template('sub', 'product');
	}
	//����
	function trade(){
		$catid_gongying = 47;	//��Ӧ
		$catid_zhaopinpai = 48;	//��Ʒ��
		$catid_zhaojiameng = 49;	//�м���
		$catid_zhaojingxiao = 50;	//�о���
		
		$trade_db = pc_base::load_model('trade_model');
		
		//��Ӧ��
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_gongying,$catid_zhaopinpai", '', 12);
		var_dump($newest_trade_gongyingqiugou);
		//����
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_zhaojiameng", '', 12);
		var_dump($newest_trade_gongyingqiugou);
		//����
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_zhaojingxiao", '', 12);
		var_dump($newest_trade_gongyingqiugou);
		include template('sub', 'trade');
	}
	
	//�м���
	function join(){
		$catid_gongying = 47;	//��Ӧ
		$catid_zhaopinpai = 48;	//��Ʒ��
		$catid_zhaojiameng = 49;	//�м���
		$catid_zhaojingxiao = 50;	//�о���
		
		$trade_db = pc_base::load_model('trade_model');
		
		//��Ӧ��
		$recommend_trade_gongyingqiugou = $trade_db->get_recommend_trade($this->sub_linkageid_arrchildid, 1, "$catid_zhaojiameng", '', 30);
		var_dump($recommend_trade_gongyingqiugou);
		//����
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_zhaojiameng", '', 20);
		var_dump($newest_trade_gongyingqiugou);
		//����
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_zhaojingxiao", '', 20);
		var_dump($newest_trade_gongyingqiugou);
		include template('sub', 'join');
	}
	
	//�о���
	function dealers(){
		$catid_gongying = 47;	//��Ӧ
		$catid_zhaopinpai = 48;	//��Ʒ��
		$catid_zhaojiameng = 49;	//�м���
		$catid_zhaojingxiao = 50;	//�о���
		
		$trade_db = pc_base::load_model('trade_model');
		
		//��Ӧ��
		$recommend_trade_gongyingqiugou = $trade_db->get_recommend_trade($this->sub_linkageid_arrchildid, 1, "$catid_zhaojingxiao", '', 30);
		var_dump($recommend_trade_gongyingqiugou);
		//����
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_zhaojingxiao", '', 20);
		var_dump($newest_trade_gongyingqiugou);
		//����
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_zhaojingxiao", '', 20);
		var_dump($newest_trade_gongyingqiugou);
		include template('sub', 'dealers');
	}
	
	//��Ѷ
	function news(){
		
	}
	//չ��
	function brand_show(){
		
	}
}
?>
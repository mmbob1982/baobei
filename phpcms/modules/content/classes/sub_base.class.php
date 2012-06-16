<?php
/**
 * 分站控制器
 */
defined('IN_PHPCMS') or exit('No permission resources.');
//模型缓存路径
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
pc_base::load_app_func('util','content');

class sub_base{
	protected $db;
	//资讯
	protected $sub_news_catid = 0;
	protected $sub_news_modelid = 1;	//默认使用文章模型
	//行业分类
	protected $sub_linkageid = 0;
	//行业分类子类
	protected $sub_linkageid_arrchildid = '';
	protected $sub_linkageid_arrchildid_arr = array();
	//产品分类
	protected $product_linkageid = 0;
	//产品分类子类
	protected $product_linkageid_arrchildid = '';
	protected $product_linkageid_arrchildid_arr = array();
	
	function __construct() {
		$this->db = pc_base::load_model('content_model');
		$this->db->set_model($this->sub_news_modelid);
		$this->_userid = param::get_cookie('_userid');
		$this->_username = param::get_cookie('_username');
		$this->_groupid = param::get_cookie('_groupid');
		
		//设定子类
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
	
	//分站首页
	function init(){
		
	}
	
	//企业
	function company(){
		$company_db = pc_base::load_model('company_model');
		$recommend_company_arr = $company_db->get_recommend_company($this->sub_linkageid_arrchildid, '*', 30);
		$newest_company_arr = $company_db->get_newest_company($this->sub_linkageid_arrchildid, '*', 20);
		
		//供求经销加盟
		$trade_db = pc_base::load_model('trade_model');
		$newest_trade = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, '', '', 20);
		var_dump($newest_trade);

		include template('sub', 'company');
	}
	
	//品牌
	function brand(){
		$brand_db = pc_base::load_model('brand_model');
		$recommend_brand_arr = $brand_db->get_recommend_brand($this->sub_linkageid_arrchildid, '*', 28);
		$newest_brand_arr = $brand_db->get_newest_brand($this->sub_linkageid_arrchildid, '*', 20);
		
		var_dump($recommend_brand_arr);
		var_dump($newest_brand_arr);
		
		//供求经销加盟
		$trade_db = pc_base::load_model('trade_model');
		$newest_trade = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, '', 20);
		
		include template('sub', 'brand');
	}
	
	//产品
	function product(){
		$product_db = pc_base::load_model('product_model');
		$recommend_product_arr = $product_db->get_recommend_product($this->product_linkageid_arrchildid, '*', 28);
		$newest_product_arr = $product_db->get_newest_product($this->product_linkageid_arrchildid, '*', 20);
		
		var_dump($recommend_product_arr);
		var_dump($newest_product_arr);
		
		//供求经销加盟
		$trade_db = pc_base::load_model('trade_model');
		$newest_trade = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, '', 20);
		
		include template('sub', 'product');
	}
	//供求
	function trade(){
		$catid_gongying = 47;	//供应
		$catid_zhaopinpai = 48;	//找品牌
		$catid_zhaojiameng = 49;	//招加盟
		$catid_zhaojingxiao = 50;	//招经销
		
		$trade_db = pc_base::load_model('trade_model');
		
		//供应求购
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_gongying,$catid_zhaopinpai", '', 12);
		var_dump($newest_trade_gongyingqiugou);
		//加盟
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_zhaojiameng", '', 12);
		var_dump($newest_trade_gongyingqiugou);
		//经销
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_zhaojingxiao", '', 12);
		var_dump($newest_trade_gongyingqiugou);
		include template('sub', 'trade');
	}
	
	//招加盟
	function join(){
		$catid_gongying = 47;	//供应
		$catid_zhaopinpai = 48;	//找品牌
		$catid_zhaojiameng = 49;	//招加盟
		$catid_zhaojingxiao = 50;	//招经销
		
		$trade_db = pc_base::load_model('trade_model');
		
		//供应求购
		$recommend_trade_gongyingqiugou = $trade_db->get_recommend_trade($this->sub_linkageid_arrchildid, 1, "$catid_zhaojiameng", '', 30);
		var_dump($recommend_trade_gongyingqiugou);
		//加盟
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_zhaojiameng", '', 20);
		var_dump($newest_trade_gongyingqiugou);
		//经销
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_zhaojingxiao", '', 20);
		var_dump($newest_trade_gongyingqiugou);
		include template('sub', 'join');
	}
	
	//招经销
	function dealers(){
		$catid_gongying = 47;	//供应
		$catid_zhaopinpai = 48;	//找品牌
		$catid_zhaojiameng = 49;	//招加盟
		$catid_zhaojingxiao = 50;	//招经销
		
		$trade_db = pc_base::load_model('trade_model');
		
		//供应求购
		$recommend_trade_gongyingqiugou = $trade_db->get_recommend_trade($this->sub_linkageid_arrchildid, 1, "$catid_zhaojingxiao", '', 30);
		var_dump($recommend_trade_gongyingqiugou);
		//加盟
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_zhaojingxiao", '', 20);
		var_dump($newest_trade_gongyingqiugou);
		//经销
		$newest_trade_gongyingqiugou = $trade_db->get_newest_trade($this->sub_linkageid_arrchildid, "$catid_zhaojingxiao", '', 20);
		var_dump($newest_trade_gongyingqiugou);
		include template('sub', 'dealers');
	}
	
	//资讯
	function news(){
		
	}
	//展播
	function brand_show(){
		
	}
}
?>
<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('form', '', 0);
class brand {
	public $models,$setting,$buy_type,$db,$modelid;

	function __construct() {
		$this->setting = getcache('yp_setting', 'yp');
		if($this->setting['encode_page_cache'] && in_array(ROUTE_A,array('init','model','company'))) cache_page_start();
		pc_base::load_app_func('global', 'yp');
		$siteid = isset($_GET['siteid']) ? intval($_GET['siteid']) : get_siteid();
		$this->models = getcache('yp_model', 'model');
		//全局推荐位ID,模块配置推荐位第一个为列表页推荐位配置
		$this->global_posid = $this->setting['position'][1]['posid'];
		$this->buy_type = array(1=>L('supply'),2=>L('buy'), 3=>L('used'), 4=>L('promotional'));
		$this->setting_models = getcache('models', 'yp');
  		define("SITEID",$siteid);
  		
  		$this->db = pc_base::load_model('brand_model');
  		$this->modelid = MODELID_BRAND;//使用的企业类别
	}

	//取得品牌库的modelid
	private function get_company_model() {
		return get_company_model();
	}

	//品牌库管理
	public function init() {
//		$modelid = $this->get_company_model();
		$company_fenlei = getcache('category_yp_'.MODELID_COMPANY,'yp');
		$this->setting['seo_title'] =  L('yp').' - '.L('business_model');
		$this->setting['meta_keywords'] = L('yp').' - '.L('business_model');
		$this->setting['meta_description'] = L('yp').' - '.L('business_model');
		$SEO = seo(SITEID, '', $this->setting['seo_title'], $this->setting['meta_description'], $this->setting['meta_keywords']);
   		include template('brand', 'model_brand');
		if($this->setting['encode_page_cache']) cache_page(1200);
	}

	public function show() {
		$id = $_GET['id'] = intval($_GET['id']);
		$catid = $_GET['catid'] = intval($_GET['catid']);
		if (!$id) showmessage(L('link_address_error_content'));
		$category_db = pc_base::load_model('category_model');
        
        $dianping_type = intval($cat_info['commenttypeid']);

		$data = $this->db->get_one(array('id'=>$id));
		if (!$data) showmessage(L('information_deleted'));
		if ($data['addition_field']) {
			$addition_field = $data['addition_field'];
			unset($data['addition_field']);
		}
//		$modelid  = $content_yp->modelid;
		$groupid = param::get_cookie('_groupid') ? param::get_cookie('_groupid') : 8;
		
		$categorys = getcache('category_yp_'.MODELID_COMPANY, 'yp');
		$CAT = $categorys[$catid];
		$CAT['setting'] = string2array($CAT['setting']);

		require_once CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR.'yp_output.class.php';
		$yp_output = new yp_output($this->modelid,$catid,$categorys);
		$userid = intval($data['userid']);
        $str_keywords = $data['keywords'];
		$rs = $yp_output->get($data);
		if ($addition_field) {
			$addition_field = string2array($addition_field);
			$additional_fields = $yp_output->fields = get_additional_fields($catid, $categorys);
			$additional_data = $yp_output->get($addition_field);
			$additional_base = $additional_general = array();
			foreach ($additional_data as $k => $v) {
				if ($additional_fields[$k]['isbase']) {
					$additional_base[$k] = $additional_data[$k];
				} else {
					$additional_general[$k] = $additional_data[$k];
				}
			}
			unset($additional_data, $addition_field);
		}
		extract($rs);
		$setting = $this->setting;
		//取得模板文件名
		$MODEL = $this->models[$this->modelid];
		if (!$MODEL) showmessage(L('model_does_not_exist'));
		$default_style = $MODEL['default_style'] ? $MODEL['default_style'] : 'default';
		$template = $MODEL['show_template'];
		//SEO
		$siteid = get_siteid();
		$model_setting = string2array($MODEL[$this->modelid]['setting']);
		$seo_keywords = $CAT['setting']['meta_keywords'] ? $CAT['setting']['meta_keywords'] : ($model_setting['meta_keywords'] ? $model_setting['meta_keywords'] : $this->setting['meta_keywords']);
		$seo_description = $CAT['setting']['meta_description'] ? $CAT['setting']['meta_description'] : ($model_setting['meta_description'] ? $model_setting['meta_description'] : $this->setting['meta_description']);
		$SEO = seo($siteid, '', $title, $seo_description, $seo_keywords);

		pc_base::load_sys_class('form', '', 0);

		include template('brand', 'show');
	}

	
	
	//品牌库列表页
	public function lists() {
		$catid = intval($_GET['catid']);
		$catid_p = intval($_GET['catid_p']);
//		if (!$catid) showmessage(L('link_address_error_category'));
//		$modelid = $this->get_company_model();
		$company_fenlei = getcache('category_yp_'.MODELID_COMPANY,'yp');

 		/*以下代码为获取当前分类的父亲分类*/

		/*if ($catid) {
			$category_db = pc_base::load_model('category_model');
			$r = $category_db->get_one(array('catid'=>$catid), 'catname, modelid, setting, parentid');
			if (!$this->modelid) {
				$modelid = intval($r['modelid']);
			}
 		}*/

		//获取分类的完整名称及父栏目url
		if ($catid) {
			if ($r['parentid']) {
				$parent_url = new_get_parent_url($this->modelid, $catid, $r['parentid']);
			} else {
				$parent_url['title'] = $r['catname'];
				if ($this->setting['enable_rewrite']) {
					$parent_url['url'] = APP_PATH.'company-.html';
				} else {
 					$parent_url['url'] = APP_PATH.'index.php?m=yp&c=index&a=company';
				}
			}
		}
  		$page = $_GET['page'];

   		//品牌库主页SEO

   		$cat_setting = string2array($r['setting']);
  		$this->setting['seo_title'] = $cat_setting['meta_title'] ? $cat_setting['meta_title'] : ($model_setting['meta_title'] ? $model_setting['meta_title'] : $this->setting['seo_title']);
		$this->setting['meta_keywords'] = $cat_setting['meta_keywords'] ? $cat_setting['meta_keywords'] : ($model_setting['meta_keywords'] ? $model_setting['meta_keywords'] : $this->setting['meta_keywords']);
		$this->setting['meta_description'] = $cat_setting['meta_description'] ? $cat_setting['meta_description'] : ($model_setting['meta_description'] ? $model_setting['meta_description'] : $this->setting['meta_description']);
		$SEO = seo(SITEID, '', $this->setting['seo_title'], $this->setting['meta_description'], $this->setting['meta_keywords']);

		$where = ' where 1=1 ';
		
		$catid_str = '';
		if (!empty($catid)){ 
			$catid_str = ' INNER JOIN phpcms_yp_relation_15 r ON r.id = b.id ';
			$where .= ' AND r.catid in ('. get_arrchildid(3360, $catid).')';
		}
		
		$catid_p_str = '';
		if (!empty($catid_p)){ 
			$catid_p_str = ' INNER JOIN phpcms_yp_relation_15_p p ON p.id = b.id ';
			$where .= ' AND p.catid in ('. get_arrchildid(3413, $catid_p).')';
		}
		
 		include template('brand', 'list_brand');
	}
}
?>
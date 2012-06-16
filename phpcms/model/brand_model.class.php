<?php
defined('IN_PHPCMS') or exit('No permission resources.');
/**
 * 品牌模型数据库操作类
 */
pc_base::load_sys_class('model', '', 0);

class brand_model extends model {
	function __construct() {
		$this->db_config = pc_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'yp_brand';
		parent::__construct();
		
		$modelid = MODELID_BRAND;
	}
	
	public function get_recommend_brand($sub_linkageid_arrchildid='', $rows='*', $nums=10){
		$r_in = '';
		!empty($sub_linkageid_arrchildid) && $r_in = " and r.catid in ($sub_linkageid_arrchildid) ";
		
		$sql = "select $rows from phpcms_yp_brand c inner join phpcms_yp_relation_15 r on c.id=r.id
					 where c.elite=1 $r_in group by r.id order by c.id desc limit $nums";
		
		
		return $this->selectAll($sql);
	}
	
	public function get_newest_brand($sub_linkageid_arrchildid='', $rows='*', $nums=10){
		$r_in = '';
		!empty($sub_linkageid_arrchildid) && $r_in = " and r.catid in ($sub_linkageid_arrchildid) ";
		
		$sql = "select $rows from phpcms_yp_brand c inner join phpcms_yp_relation_15 r on c.id=r.id
					 where 1=1 $r_in group by r.id order by c.id desc limit $nums";
		
		
		return $this->selectAll($sql);
	}
	
	public function selectAll($sql){
		$this->query($sql);
		$arr = $this->fetch_array();
		return $arr;
	}
}
?>
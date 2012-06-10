<?php
defined('IN_PHPCMS') or exit('No permission resources.');
/**
 * 供求经销加盟 模型数据库操作类
 */
pc_base::load_sys_class('model', '', 0);

class trade_model extends model  {
	public function __construct() {
		$this->db_config = pc_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'yp_buy';
		parent::__construct();
	}
	
	public function get_newest_trade($sub_linkageid_arrchildid='', $rows='', $nums=10){
		$r_in = '';
		!empty($sub_linkageid_arrchildid) && $r_in = " and r.catid in ($sub_linkageid_arrchildid) ";
		empty($rows) && $rows = 'b.id as buy_id, b.title as buy_title';
		
		$sql = "select $rows from phpcms_yp_buy b inner join phpcms_yp_brand bd on b.brand=bd.id inner join phpcms_yp_relation_15 r on bd.id=r.id
					 where 1=1 $r_in group by r.id order by b.id desc limit $nums";
		
		
		return $this->selectAll($sql);
	}
	
	public function selectAll($sql){
		$this->query($sql);
		$arr = $this->fetch_array();
		return $arr;
	}
}
?>
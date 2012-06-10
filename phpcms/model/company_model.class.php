<?php
defined('IN_PHPCMS') or exit('No permission resources.');
/**
 * 企业模型数据库操作类
 */
pc_base::load_model('yp_company_model');

class company_model extends yp_company_model  {
	
	
	public function get_recommend_company($sub_linkageid_arrchildid='', $rows='*', $nums=10){
		$r_in = '';
		!empty($sub_linkageid_arrchildid) && $r_in = " and r.catid in ($sub_linkageid_arrchildid) ";
		
		$sql = "select $rows from phpcms_yp_company c inner join phpcms_yp_relation r on c.userid=r.userid
					 where c.elite=1 $r_in group by r.userid order by c.userid desc limit $nums";
		
		
		return $this->selectAll($sql);
	}
	
	public function get_newest_company($sub_linkageid_arrchildid='', $rows='*', $nums=10){
		$r_in = '';
		!empty($sub_linkageid_arrchildid) && $r_in = " and r.catid in ($sub_linkageid_arrchildid) ";
		
		$sql = "select $rows from phpcms_yp_company c inner join phpcms_yp_relation r on c.userid=r.userid
					 where 1=1 $r_in group by r.userid order by c.userid desc limit $nums";
		
		
		return $this->selectAll($sql);
	}
	
	public function selectAll($sql){
		$this->query($sql);
		$arr = $this->fetch_array();
		return $arr;
	}
}
?>
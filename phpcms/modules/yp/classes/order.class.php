<?php
// --------------------------------------------------------------------------------
// ��ҳģ����ҵ��Ʒ�����׶�����
// --------------------------------------------------------------------------------
// phpcms�ٷ��Ŷ�����
// http://www.phpcms.cn
// --------------------------------------------------------------------------------
// $Id: order.class.php 2011-6-24 15:19:06 $
// --------------------------------------------------------------------------------

class order {

	private $db;

	/**
	 * ���캯��
	 */
	public function __construct() {
		$this->db = pc_base::load_model('order_model');
	}

	/**
	 * ������ˮ��¼
	 * @param unknown_type
	 */
	public function add_record($data){
		$require_items = array('userid','username','uid', 'buycarid', 'email','contactname','telephone','order_sn','money','quantity','addtime','usernote','ip');
		if(is_array($data)) {
			foreach($data as $key=>$item) {
				if(in_array($key,$require_items)) $info[$key] = $item;
			}
		} else {
			return false;
		}
		$order_exist = $this->db->get_one(array('order_sn'=>$info['order_sn']), 'id');
		if($order_exist) return $order_exist['id'];
		$this->db->insert($info);
		return $this->db->insert_id();
	}

	/**
	 * ��ȡ��ˮ��¼
	 * @param init $id ��ˮ�ʺ�
	 */
	public function get_record($id) {
		$id = intval($id);
		$result = array();
		$result = $this->db->get_one(array('id'=>$id));
		$status_arr = array('succ','failed','error','timeout','cancel');
		return ($result && !in_array($result['status'],$status_arr)) ? $result: false;
	}

	/**
	 * ��ȡ������Ϣ
	 * @param intval $userid �̻�ID
	 * @param intval(0/1) $status 0��ʾδ����������1��ʾ�ѷ���������Ϊ��Ϊȫ������
	 */
	public function listinfo($userid, $status) {
		$where = array('uid'=>$userid);
		if (isset($status) && is_numeric($status)) {
			$where['status'] = $status;
		}
		$page = max(intval($_GET['page']), 1);
		$data = $this->db->listinfo($where, '`id` DESC', $page);
		$this->pages = $this->db->pages;
		return $data;
	}

	/**
	 * ��ȡ��������
	 * @param intval $id ����ID
	 */
	public function get($id) {
		$result = $this->db->get_one(array('id'=>$id));
		//ȡ����Ʒ��Ϣ
		$buycar_db = pc_base::load_model('buycar_model');
		$result['products'] = $buycar_db->select('`id` IN('.$result['buycarid'].') AND `status`=1', 'title, quantity, thumb, url, price');
		//ȡ���ͻ���ַ��Ϣ
		$member_address = pc_base::load_model('member_address_model');
		$result['address'] = $member_address->get_one(array('userid'=>$result['userid']));
 		return $result;
	}

    /**
	 * �޸Ķ���
	 * @param intval $id ����ID
     * @param array $data ����
	 */
    public function update($id, $data) {
		$where = array();
		if ($data['postal']) {
			$where['postal'] = new_addslashes($data['postal']);
		}
		if ($data['status']) {
			$where['status'] = intval($data['status']);
		}
        $r = $this->db->get_one(array('id'=>$id), 'uid, username, contactname, status, email');
        if ($r['status']==0 && $data['tip']) {
        	$message = str_replace($r['username'], '', $r['contactname']);
			$message .= L('you').$message.L('Shipped');
        	if ($data['tip']==1) {
		        $message_db = pc_base::load_model('message_model');
				$message_db->add_message($r['username'],'SYSTEM',L('order_status_reminder'),$message);
        	} else {
        		pc_base::load_sys_func('mail');
        		sendmail($r['email'], L('order_status_reminder'), $message);
        	}
        }
		$this->db->update($where, array('id'=>$id));
        return true;
    }
}
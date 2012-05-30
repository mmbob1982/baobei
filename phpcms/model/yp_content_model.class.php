<?php
/**
 * ��ҳģ�����ݿ������
 */

pc_base::load_sys_class('model', '', 0);
class yp_content_model extends model {
	public $table_name = '';
	public function __construct() {
		$this->db_config = pc_base::load_config('database');
		$this->db_setting = 'default';
		$this->siteid = get_siteid();
		parent::__construct();
	}
	public function set_model($modelid) {
		$this->model = getcache('yp_model', 'model');
		$this->modelid = $modelid;
		$this->table_name = $this->db_tablepre.$this->model[$modelid]['tablename'];
		$this->model_tablename = $this->model[$modelid]['tablename'];

	}

	/**
	 * �������
	 *
	 * @param $datas
	 * @param $isimport �Ƿ�Ϊ�ⲿ�ӿڵ���
	 */
	public function add_content($data,$isimport = 0) {
		if($isimport) $data = new_addslashes($data);
		$this->search_db = pc_base::load_model('search_model');
		$modelid = $this->modelid;
		require_once CACHE_MODEL_PATH.'yp_input.class.php';
        require_once CACHE_MODEL_PATH.'yp_update.class.php';
		$yp_input = new yp_input($this->modelid);
		$inputinfo = $yp_input->get($data,$isimport);

		$systeminfo = $inputinfo['system'];
		$modelinfo = $inputinfo['model'];

		if($data['inputtime'] && !is_numeric($data['inputtime'])) {
			$systeminfo['inputtime'] = strtotime($data['inputtime']);
		} elseif(!$data['inputtime']) {
			$systeminfo['inputtime'] = SYS_TIME;
		} else {
			$systeminfo['inputtime'] = $data['inputtime'];
		}

		if($data['updatetime'] && !is_numeric($data['updatetime'])) {
			$systeminfo['updatetime'] = strtotime($data['updatetime']);
		} elseif(!$data['updatetime']) {
			$systeminfo['updatetime'] = SYS_TIME;
		} else {
			$systeminfo['updatetime'] = $data['updatetime'];
		}
		$systeminfo['username'] = $data['username'] ? $data['username'] : param::get_cookie('admin_username');
		$systeminfo['userid'] = $data['userid'] ? intval($data['userid']) : param::get_cookie('admin_userid');

		//�Զ���ȡժҪ
		if(isset($_POST['add_introduce']) && $systeminfo['description'] == '' && isset($modelinfo['content'])) {
			$content = stripslashes($modelinfo['content']);
			$introcude_length = intval($_POST['introcude_length']);
			$systeminfo['description'] = str_cut(str_replace(array("\r\n","\t",'[page]','[/page]','&ldquo;','&rdquo;','&nbsp;'), '', strip_tags($content)),$introcude_length);
			$inputinfo['system']['description'] = $systeminfo['description'] = addslashes($systeminfo['description']);
		}
		//�Զ���ȡ����ͼ
		if(isset($_POST['auto_thumb']) && $systeminfo['thumb'] == '' && isset($modelinfo['content'])) {
			$content = $content ? $content : stripslashes($modelinfo['content']);
			$auto_thumb_no = intval($_POST['auto_thumb_no'])-1;
			if(preg_match_all("/(src)=([\"|']?)([^ \"'>]+\.(gif|jpg|jpeg|bmp|png))\\2/i", $content, $matches)) {
				$systeminfo['thumb'] = $matches[3][$auto_thumb_no];
			}
		}
		//����
		$tablename = $this->table_name = $this->db_tablepre.$this->model_tablename;
		$id = $modelinfo['id'] = $this->insert($systeminfo,true);
		$systeminfo['userid'] = $data['userid'];
		unset($modelinfo['userid']);
		$this->update($systeminfo,array('id'=>$id));
		//����URL��ַ
        $setting = getcache('yp_setting', 'yp');
		if($data['islink']==1) {
			$url = $_POST['linkurl'];
		} else {
			$model_setting = string2array($this->model[$modelid]['setting']);
			if (!$model_setting['ismenu']) {
				$url = compute_company_url('show', array('catid'=>$data['catid'], 'id'=>$id, 'page'=>1, 'userid'
				=>$systeminfo['userid']));
			} else {
				if ($setting['enable_rewrite']) {
					$url = APP_PATH.'yp-show-'.$systeminfo['catid'].'-'.$id.'.html';
				} else {
					$url = APP_PATH.'index.php?m=yp&c=index&a=show&catid='.$systeminfo['catid'].'&id='.$id;
				}
			}
		}
		$this->table_name = $tablename;
		$this->update(array('url'=>$url),array('id'=>$id));
		//������
		$this->table_name = $this->table_name.'_data';
		$this->insert($modelinfo);
		//���ͳ��
		$this->hits_db = pc_base::load_model('hits_model');
		$hitsid = 'c-'.$modelid.'-'.$id;
		$this->hits_db->insert(array('hitsid'=>$hitsid,'catid'=>$systeminfo['catid'],'updatetime'=>SYS_TIME));
		//���µ�ȫվ����
		$this->search_api($id,$inputinfo);
		//������Ŀͳ������
		$this->update_category_items($systeminfo['catid'],'add',1);
		//���� update
		$yp_update = new yp_update($this->modelid,$id);
		//�ϲ��󣬵���update
		$merge_data = array_merge($systeminfo,$modelinfo);
		$merge_data['posids'] = $data['posids'];
		$yp_update->update($merge_data);

		//���¸���״̬
		if(pc_base::load_config('system','attachment_stat')) {
			$this->attachment_db = pc_base::load_model('attachment_model');
			$this->attachment_db->api_update('','c-'.$systeminfo['catid'].'-'.$id,2);
		}
		return $id;
	}
	/**
	 * �޸�����
	 *
	 * @param $datas
	 */
	public function edit_content($data,$id) {
		$model_tablename = $this->model_tablename;
		//ǰ̨Ȩ���ж�
		if(!defined('IN_ADMIN')) {
			$_username = param::get_cookie('_username');
			$us = $this->get_one(array('id'=>$id,'username'=>$_username));
			if(!$us) return false;
		}

		$this->search_db = pc_base::load_model('search_model');

		require_once CACHE_MODEL_PATH.'yp_input.class.php';
        require_once CACHE_MODEL_PATH.'yp_update.class.php';
		$yp_input = new yp_input($this->modelid);
		$inputinfo = $yp_input->get($data);

		$systeminfo = $inputinfo['system'];
		$modelinfo = $inputinfo['model'];
		if($data['inputtime'] && !is_numeric($data['inputtime'])) {
			$systeminfo['inputtime'] = strtotime($data['inputtime']);
		} elseif(!$data['inputtime']) {
			$systeminfo['inputtime'] = SYS_TIME;
		} else {
			$systeminfo['inputtime'] = $data['inputtime'];
		}

		if($data['updatetime'] && !is_numeric($data['updatetime'])) {
			$systeminfo['updatetime'] = strtotime($data['updatetime']);
		} elseif(!$data['updatetime']) {
			$systeminfo['updatetime'] = SYS_TIME;
		} else {
			$systeminfo['updatetime'] = $data['updatetime'];
		}
		//�Զ���ȡժҪ
		if(isset($_POST['add_introduce']) && $systeminfo['description'] == '' && isset($modelinfo['content'])) {
			$content = stripslashes($modelinfo['content']);
			$introcude_length = intval($_POST['introcude_length']);
			$systeminfo['description'] = str_cut(str_replace(array("\r\n","\t",'[page]','[/page]','&ldquo;','&rdquo;','&nbsp;'), '', strip_tags($content)),$introcude_length);
			$inputinfo['system']['description'] = $systeminfo['description'] = addslashes($systeminfo['description']);
		}
		//�Զ���ȡ����ͼ
		if(isset($_POST['auto_thumb']) && $systeminfo['thumb'] == '' && isset($modelinfo['content'])) {
			$content = $content ? $content : stripslashes($modelinfo['content']);
			$auto_thumb_no = intval($_POST['auto_thumb_no'])-1;
			if(preg_match_all("/(src)=([\"|']?)([^ \"'>]+\.(gif|jpg|jpeg|bmp|png))\\2/i", $content, $matches)) {
				$systeminfo['thumb'] = $matches[3][$auto_thumb_no];
			}
		}
		$model_setting = string2array($this->model[$this->modelid]['setting']);
		if(!defined('IN_ADMIN')) {
			if($data['islink']==1) {
				$systeminfo['url'] = $_POST['linkurl'];
			} else {
				$setting = getcache('yp_setting', 'yp');
				if (!$model_setting['ismenu']) {
					$userid = param::get_cookie('_userid');
					$url = compute_company_url('show', array('catid'=>$data['catid'], 'id'=>$id, 'page'=>1, 'userid'
					=>$userid));
				} else {
					if ($setting['enable_rewrite']) {
						$url = APP_PATH.'yp-show-'.$systeminfo['catid'].'-'.$id.'.html';
					} else {
						$url = APP_PATH.'index.php?m=yp&c=index&a=show&catid='.$systeminfo['catid'].'&id='.$id;
					}
				}
				$systeminfo['url'] = $url;
			}
		}
		//����
		$this->table_name = $this->db_tablepre.$model_tablename;
		$this->update($systeminfo,array('id'=>$id));

		//������
		$this->table_name = $this->table_name.'_data';
		$this->update($modelinfo,array('id'=>$id));
		$this->search_api($id,$inputinfo);
		//���� update
		$yp_update = new yp_update($this->modelid,$id);
		$yp_update->update($data);
		//���¸���״̬
		if(pc_base::load_config('system','attachment_stat')) {
			$this->attachment_db = pc_base::load_model('attachment_model');
			$this->attachment_db->api_update('','c-'.$systeminfo['catid'].'-'.$id,2);
		}

		return true;
	}

	public function status($ids = array(), $status = 99, $modelid = 0) {
		$this->message_db = pc_base::load_model('message_model');
		$this->set_model($modelid);
		if(is_array($ids) && !empty($ids)) {
			foreach($ids as $id) {
				$this->update(array('status'=>$status),array('id'=>$id));
				$r = $this->get_one(array('id'=>$id));
				if($status==0) {
					//�˸巢�Ͷ���Ϣ���ʼ�
					$message = L('reject_message_tips').$r['title']."<BR><a href=\'index.php?m=yp&c=content&a=edit&modelid={$modelid}&id={$r[id]}\'><font color=red>".L('click_edit')."</font></a><br>";
					if(isset($_POST['reject_c']) && $_POST['reject_c'] != L('reject_msg')) {
						$message .= $_POST['reject_c'];
					} elseif(isset($_GET['reject_c']) && $_GET['reject_c'] != L('reject_msg')) {
						$message .= $_GET['reject_c'];
					}
					$this->message_db->add_message($r['username'],'SYSTEM',L('reject_message'),$message);
				}
			}
		} else {
			$this->update(array('status'=>$status),array('id'=>$ids));
			$r = $this->get_one(array('id'=>$ids));
			if($status==0) {
				//�˸巢�Ͷ���Ϣ���ʼ�
				$message = L('reject_message_tips').$r['title']."<BR><a href=\'index.php?m=member&c=content&a=edit&catid={$r[catid]}&id={$r[id]}\'><font color=red>".L('click_edit')."</font></a><br>";
				if(isset($_POST['reject_c']) && $_POST['reject_c'] != L('reject_msg')) {
					$message .= $_POST['reject_c'];
				} elseif(isset($_GET['reject_c']) && $_GET['reject_c'] != L('reject_msg')) {
					$message .= $_GET['reject_c'];
				}
				$this->message_db->add_message($r['username'],'SYSTEM',L('reject_message'),$message);
			}
		}
		return true;
	}
	/**
	 * ɾ������
	 * @param $id ����id
	 * @param $file �ļ�·��
	 * @param $catid ��Ŀid
	 */
	public function delete_content($id,$file,$catid = 0) {
		//ɾ����������
		$this->delete(array('id'=>$id));
		//ɾ���ӱ�����
		$this->table_name = $this->table_name.'_data';
		$this->delete(array('id'=>$id));
		//����Ĭ�ϱ�
		$this->table_name = $this->db_tablepre.$this->model_tablename;
		//������Ŀͳ��
		$this->update_category_items($catid,'delete');
	}


	private function search_api($id = 0, $data = array(), $action = 'update') {
		$type_arr = getcache('search_model_'.$this->siteid,'search');
		$typeid = $type_arr[$this->modelid]['typeid'];
		if($action == 'update') {
			$fulltext_array = getcache('model_field_'.$this->modelid,'model');
			foreach($fulltext_array AS $key=>$value){
				if($value['isfulltext']) {
					$fulltextcontent .= $data['system'][$key] ? $data['system'][$key] : $data['model'][$key];
				}
			}
			$this->search_db->update_search($typeid ,$id, $fulltextcontent,addslashes($data['system']['title']).' '.addslashes($data['system']['keywords']),$data['system']['inputtime']);
		} elseif($action == 'delete') {
			$this->search_db->delete_search($typeid ,$id);
		}
	}
	/**
	 * ��ȡ��ƪ��Ϣ
	 *
	 * @param $catid ��Ϣ�����ķ���ID
	 * @param $id ��ϢID
	 * @param $modelid ��Ϣ������ģ��ID
	 */
	public function get_content($catid = 0,$id, $modelid = 0) {
		$catid = intval($catid);
		$id = intval($id);
		if(!$id) return false;
		if (!$catid && !$modelid) return false;
		if (!$modelid) {
			$this->category_db = pc_base::load_model('category_model');
			$r = $this->category_db->get_one(array('catid'=>$catid), 'modelid');
			$modelid = intval($r['modelid']);
		}
		if($modelid) {
			$this->set_model($modelid);
			$r = $this->get_one(array('id'=>$id, 'status'=>99));
			//������
			$this->table_name = $this->table_name.'_data';
			$r2 = $this->get_one(array('id'=>$id));
			if($r2) {
				return array_merge($r,$r2);
			} else {
				return $r;
			}
		}
		return true;
	}

	/**
	* @���·���������ֵ
	*
	* @param $catid ����ID
	* @param $action ���� add/delete
	* @param $cache �Ƿ���»���
	**/
	private function update_category_items($catid,$action = 'add',$cache = 0) {
		$this->category_db = pc_base::load_model('category_model');
		if($action=='add') {
			$this->category_db->update(array('items'=>'+=1'),array('catid'=>$catid));
		}  else {
			$this->category_db->update(array('items'=>'-=1'),array('catid'=>$catid));
		}
		if($cache) $this->cache_items();
	}

	/**
	*
	* @���·�������������
	*
	**/
	public function cache_items() {
		$datas = $this->category_db->select(array('modelid'=>$this->modelid),'catid,items',10000);
		$array = array();
		foreach ($datas as $r) {
			$array[$r['catid']] = $r['items'];
		}
		setcache('category_items_'.$this->modelid, $array,'yp');
	}
}
?>
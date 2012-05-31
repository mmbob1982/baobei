<?php
class yp_update {
	var $modelid;
	var $fields;
	var $data;

    function __construct($modelid,$id) {
		$this->modelid = $modelid;
		$this->fields = getcache('model_field_'.$modelid,'model');
		$this->id = $id;
    }
	function update($data) {
		$info = array();
		$this->data = $data;
		foreach($data as $field=>$value) {
			if(!isset($this->fields[$field])) continue;
			$func = $this->fields[$field]['formtype'];
			$info[$field] = method_exists($this, $func) ? $this->$func($field, $value) : $value;
		}
	}
function editor($field, $value) {
	$attachment_db = pc_base::load_model('attachment_model');
	$attachment_db->api_update($GLOBALS['downloadfiles'],'c-'.$this->data['catid'].'-'.$this->id,1);

	return $value;
}	function posid($field, $value) {
		if(!empty($value) && is_array($value)) {
			if($_GET['a']=='add') {
				$position_data_db = pc_base::load_model('position_data_model');
				$textcontent = array();
				foreach($value as $r) {
					if($r!='-1') {
						if(empty($textcontent)) {
							foreach($this->fields AS $_key=>$_value) {
								if($_value['isposition']) {
									$textcontent[$_key] = $this->data[$_key];
								}
							}
							$textcontent = array2string($textcontent);
						}

						$position_data_db->insert(array('id'=>$this->id,'catid'=>$this->data['catid'],'posid'=>$r,'module'=>'content','modelid'=>$this->modelid,'data'=>$textcontent,'listorder'=>$this->id));
					}
				}
			} else {
				$posids = array();
				$catid = $this->data['catid'];
				$push_api = pc_base::load_app_class('push_api','admin');
				foreach($value as $r) {
					if($r!='-1') $posids[] = $r;
				}
				$textcontent = array();
				foreach($this->fields AS $_key=>$_value) {
					if($_value['isposition']) {
						$textcontent[$_key] = $this->data[$_key];
					}
				}
				//��ɫѡ��Ϊ������ ���������ȡֵ
				$textcontent['style'] = $_POST['style_color'] ? strip_tags($_POST['style_color']) : '';
				$textcontent['inputtime'] = strtotime($textcontent['inputtime']);
				if($_POST['style_font_weight']) $textcontent['style'] = $textcontent['style'].';'.strip_tags($_POST['style_font_weight']);
				$push_api->position_update($this->id, $this->modelid, $catid, $posids, $textcontent, '', 0, 'yp_content_model');
			}
		}
	}

 } 
?>
	function linkpc($field, $value) {
		$setting = string2array($this->fields[$field]['setting']);
		$datas = getcache($setting['linkpcid'],'linkboxs');
		$infos = $datas['data'];
		if($setting['showtype']==1) {
			$result = get_linkpc($value, $setting['linkpcid'], $setting['space'], 1);
		} elseif($setting['showtype']==2) {
			$result = $value;
		} else {
			$result = get_linkpc($value, $setting['linkpcid'], $setting['space'], 2);
		}
		return $result;
	}


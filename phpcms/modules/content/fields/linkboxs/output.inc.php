	function linkboxs($field, $value) {
		$setting = string2array($this->fields[$field]['setting']);
		$datas = getcache($setting['linkboxsid'],'linkboxs');
		$infos = $datas['data'];
		if($setting['showtype']==1) {
			$result = get_linkboxs($value, $setting['linkboxsid'], $setting['space'], 1);
		} elseif($setting['showtype']==2) {
			$result = $value;
		} else {
			$result = get_linkboxs($value, $setting['linkboxsid'], $setting['space'], 2);
		}
		return $result;
	}


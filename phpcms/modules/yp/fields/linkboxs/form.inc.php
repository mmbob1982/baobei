	function linkboxs($field, $value, $fieldinfo) {
		$setting = string2array($fieldinfo['setting']);
		$linkboxsid = $setting['linkboxsid'];
		return menu_linkboxs($linkboxsid,$field,$value,$setting);
	}

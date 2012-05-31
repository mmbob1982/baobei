	function linkpc($field, $value, $fieldinfo) {
		$setting = string2array($fieldinfo['setting']);
		$linkpcid = $setting['linkpcid'];
		return menu_linkpc($linkpcid,$field,$value,$setting);
	}

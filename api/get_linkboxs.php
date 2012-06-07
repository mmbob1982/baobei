<?php
/**
 * 9ask
 * lujinfa
 * 2011-06-07
 * 获取联动多选菜单接口
 * linkboxs
 */
defined('IN_PHPCMS') or exit('No permission resources.');
if( !$_REQUEST['act'])  showmessage(L('error'));

switch($_REQUEST['act']) {
	case 'ajax_getlist':
		ajax_getlist();
	break;

	case 'ajax_getpath':
		ajax_getpath($_REQUEST['parentid'],$_REQUEST['keyid'],$_REQUEST['callback']);
	break;
	case 'ajax_gettopparent':
		ajax_gettopparent($_REQUEST['linkageid'],$_REQUEST['keyid'],$_REQUEST['callback']);
	break;
    case 'ajax_category':
		ajax_getcategory();
	break;
}
function ajax_getcategory() {

	$category_title =  isset($_REQUEST['category_title']) && trim($_REQUEST['category_title']) ? trim($_REQUEST['category_title']) :'';
    $category_extend =  isset($_REQUEST['category_extend']) && trim($_REQUEST['category_extend']) ? trim($_REQUEST['category_extend']) :'';
    $category_moduleid =  isset($_REQUEST['category_moduleid']) && trim($_REQUEST['category_moduleid']) ? trim($_REQUEST['category_moduleid']) :'';
    $category_deep =  isset($_REQUEST['category_deep']) && trim($_REQUEST['category_deep']) ? trim($_REQUEST['category_deep']) :'';
    $cat_id =  isset($_REQUEST['cat_id']) && trim($_REQUEST['cat_id']) ? trim($_REQUEST['cat_id']) :'';
    $catid =  isset($_REQUEST['catid']) && trim($_REQUEST['catid']) ? trim($_REQUEST['catid']) :'';

    $category_title = convert($category_title, 'UTF-8', DT_CHARSET);
		$category_extend = isset($category_extend) ? stripslashes($category_extend) : '';
		$category_moduleid = isset($category_moduleid) ? intval($category_moduleid) : 1;
		if(!$category_moduleid) exit;
		$category_deep = isset($category_deep) ? intval($category_deep) : 0;
		$cat_id= isset($cat_id) ? trim($cat_id) : '';

		echo get_category_select($category_title, $catid, $category_moduleid, $category_extend, $category_deep, $cat_id);

}

function convert($str, $from = 'utf-8', $to = 'gb2312') {
	if(!$str) return '';
	if(strtolower($from) == strtolower($to)) return $str;
	$from = str_replace('gbk', 'gb2312', strtolower($from));
	$to = str_replace('gbk', 'gb2312', strtolower($to));
	if($from == $to) return $str;
	$tmp = array();
	if(function_exists('iconv')) {
		if(is_array($str)) {
			foreach($str as $key => $val) {
				$tmp[$key] = iconv($from, $to."//IGNORE", $val);
			}
			return $tmp;
		} else {
			return iconv($from, $to."//IGNORE", $str);
		}
	} else if(function_exists('mb_convert_encoding')) {
		if(is_array($str)) {
			foreach($str as $key => $val) {
				$tmp[$key] = mb_convert_encoding($val, $to, $from);
			}
			return $tmp;
		} else {
			return mb_convert_encoding($str, $to, $from);
		}
	} else {
		//require_once DT_ROOT.'/include/convert.func.php';
		return dconvert($str, $to, $from);
	}
}

function dconvert($str, $from = 'utf-8', $to = 'gb2312') {
	$from = str_replace('utf-8', 'utf8', $from);
	$to = str_replace('utf-8', 'utf8', $to);
	$tmp = file(PHPCMS_PATH.'/phpcms/libs/data/table/gb-unicode.table');
	if(!$tmp) return $str;
	$table = array();
	while(list($key, $value) = each($tmp)) {
		if($from == 'utf8') {
			$table[hexdec(substr($value, 7, 6))]=substr($value, 0, 6);
		} else {
			$table[hexdec(substr($value, 0, 6))] = substr($value, 7 , 6);
		}
	}
	unset($tmp);
	$dstr = '';
	if($from == 'utf8') {
		$len = strlen($str);
		$i = 0;
		while($i < $len) {
			$c = ord(substr( $str, $i++, 1 ));
			switch($c >> 4) {
				case 0: case 1: case 2: case 3: case 4: case 5: case 6: case 7:
					$dstr .= substr( $str, $i-1, 1);
					break;
				case 12: case 13:
					$char2 = ord( substr( $str, $i++, 1));
					$char3 = $table[(($c & 0x1F) << 6) | ($char2 & 0x3F)];
					$dstr .= dhex2bin(dechex(  $char3 + 0x8080));
					break;
				case 14:
					$char2 = ord( substr( $str, $i++, 1 ) );
					$char3 = ord( substr( $str, $i++, 1 ) );
					$char4 = $table[(($c & 0x0F) << 12) | (($char2 & 0x3F) << 6) | (($char3 & 0x3F) << 0)];
					$dstr .= dhex2bin(dechex($char4 + 0x8080));
					break;
			}
		}
	} else {
		while($str) {
			if(ord(substr($str, 0, 1)) > 127) {
				$utf8 = dch2utf8(hexdec($table[hexdec(bin2hex(substr($str,0,2)))-0x8080]));
				$dutf8 = strlen($utf8);
				for($i = 0; $i < $dutf8; $i += 3) {
					$dstr .= chr(substr($utf8, $i,3));
				}
				$str = substr($str, 2, strlen($str));
			} else {
				$dstr .= substr($str, 0, 1);
				$str = substr($str, 1, strlen($str));
			}
		}
	}
	unset($table);
	return $dstr;
}

function dhex2bin($hexdata) {
	$bindata = '';
	$dhexdata = strlen($hexdata);
	for($i = 0; $i < $dhexdata; $i += 2) {
		$bindata .= chr(hexdec(substr($hexdata, $i, 2)));
	}
	return $bindata;
}

function dch2utf8($c) {
	$str = '';
	if ($c < 0x80) {
		$str .= $c;
	} else if ($c < 0x800) {
		$str .= (0xC0 | $c>>6);
		$str .= (0x80 | $c & 0x3F);
	} else if ($c < 0x10000) {
		$str .= (0xE0 | $c>>12);
		$str .= (0x80 | $c>>6 & 0x3F);
		$str .= (0x80 | $c & 0x3F);
	} else if ($c < 0x200000) {
		$str .= (0xF0 | $c>>18);
		$str .= (0x80 | $c>>12 & 0x3F);
		$str .= (0x80 | $c>>6 & 0x3F);
		$str .= (0x80 | $c & 0x3F);
	}
	return $str;
}
/**
 * 获取地区列表
 */
function ajax_getlist() {

	$keyid = intval($_GET['keyid']);
	$datas = getcache($keyid,'linkage');
	$infos = $datas['data'];
	$where_id = isset($_GET['parentid']) ? $_GET['parentid'] : intval($infos[$_GET['linkageid']]['parentid']);
	$parent_menu_name = ($where_id==0) ? $datas['title'] :$infos[$where_id]['name'];
	foreach($infos AS $k=>$v) {
		if($v['parentid'] == $where_id) {
			$s[]=iconv(CHARSET,'utf-8',$v['linkageid'].','.$v['name'].','.$v['parentid'].','.$parent_menu_name);
		}
	}
	if(count($s)>0) {
		$jsonstr = json_encode($s);
		echo $_GET['callback'].'(',$jsonstr,')';
		exit;
	} else {
		echo $_GET['callback'].'()';exit;
	}
}

/**
 * 获取地区父级路径路径
 * @param $parentid 父级ID
 * @param $keyid 菜单keyid
 * @param $callback json生成callback变量
 * @param $result 递归返回结果数组
 * @param $infos
 */
function ajax_getpath($parentid,$keyid,$callback,$result = array(),$infos = array()) {
	$keyid = intval($keyid);
	$parentid = intval($parentid);
	if(!$infos) {
		$datas = getcache($keyid,'linkage');
		$infos = $datas['data'];
	}
	if(array_key_exists($parentid,$infos)) {
		$result[]=iconv(CHARSET,'utf-8',$infos[$parentid]['name']);
		return ajax_getpath($infos[$parentid]['parentid'],$keyid,$callback,$result,$infos);
	} else {
		if(count($result)>0) {
			krsort($result);
			$jsonstr = json_encode($result);
			echo $callback.'(',$jsonstr,')';
			exit;
		} else {
			$result[]=iconv(CHARSET,'utf-8',$datas['title']);
			$jsonstr = json_encode($result);
			echo $callback.'(',$jsonstr,')';
			exit;
		}
	}
}
/**
 * 获取地区顶级ID
 * Enter description here ...
 * @param  $linkageid 菜单id
 * @param  $keyid 菜单keyid
 * @param  $callback json生成callback变量
 * @param  $infos 递归返回结果数组
 */
function ajax_gettopparent($linkageid,$keyid,$callback,$infos = array()) {
	$keyid = intval($keyid);
	$linkageid = intval($linkageid);
	if(!$infos) {
		$datas = getcache($keyid,'linkage');
		$infos = $datas['data'];
	}
	if($infos[$linkageid]['parentid']!=0) {
		return ajax_gettopparent($infos[$linkageid]['parentid'],$keyid,$callback,$infos);
	} else {
		echo $callback.'(',$linkageid,')';
		exit;
	}
}
?>

<?php
/**
 *  global.func.php 公共函数库
 *
 * @copyright			(C) 2005-2010 PHPCMS
 * @license				http://www.phpcms.cn/license/
 * @lastmodify			2010-6-1
 */

/**
 * 返回经addslashes处理过的字符串或数组
 * @param $string 需要处理的字符串或数组
 * @return mixed
 */
function new_addslashes($string){
	if(!is_array($string)) return addslashes($string);
	foreach($string as $key => $val) $string[$key] = new_addslashes($val);
	return $string;
}

/**
 * 返回经stripslashes处理过的字符串或数组
 * @param $string 需要处理的字符串或数组
 * @return mixed
 */
function new_stripslashes($string) {
	if(!is_array($string)) return stripslashes($string);
	foreach($string as $key => $val) $string[$key] = new_stripslashes($val);
	return $string;
}

/**
 * 返回经htmlspecialchars处理过的字符串或数组
 * @param $obj 需要处理的字符串或数组
 * @return mixed
 */
function new_html_special_chars($string) {
	if(!is_array($string)) return htmlspecialchars($string);
	foreach($string as $key => $val) $string[$key] = new_html_special_chars($val);
	return $string;
}
/**
 * 安全过滤函数
 *
 * @param $string
 * @return string
 */
function safe_replace($string) {
	$string = str_replace('%20','',$string);
	$string = str_replace('%27','',$string);
	$string = str_replace('%2527','',$string);
	$string = str_replace('*','',$string);
	$string = str_replace('"','&quot;',$string);
	$string = str_replace("'",'',$string);
	$string = str_replace('"','',$string);
	$string = str_replace(';','',$string);
	$string = str_replace('<','&lt;',$string);
	$string = str_replace('>','&gt;',$string);
	$string = str_replace("{",'',$string);
	$string = str_replace('}','',$string);
	$string = str_replace('\\','',$string);
	return $string;
}



/**
 * 过滤ASCII码从0-28的控制字符
 * @return String
 */
function trim_unsafe_control_chars($str) {
	$rule = '/[' . chr ( 1 ) . '-' . chr ( 8 ) . chr ( 11 ) . '-' . chr ( 12 ) . chr ( 14 ) . '-' . chr ( 31 ) . ']*/';
	return str_replace ( chr ( 0 ), '', preg_replace ( $rule, '', $str ) );
}

/**
 * 格式化文本域内容
 *
 * @param $string 文本域内容
 * @return string
 */
function trim_textarea($string) {
	$string = nl2br ( str_replace ( ' ', '&nbsp;', $string ) );
	return $string;
}

/**
 * 将文本格式成适合js输出的字符串
 * @param string $string 需要处理的字符串
 * @param intval $isjs 是否执行字符串格式化，默认为执行
 * @return string 处理后的字符串
 */
function format_js($string, $isjs = 1) {
	$string = addslashes(str_replace(array("\r", "\n", "\t"), array('', '', ''), $string));
	return $isjs ? 'document.write("'.$string.'");' : $string;
}

/**
 * 转义 javascript 代码标记
 *
 * @param $str
 * @return mixed
 */
 function trim_script($str) {
	if(is_array($str)){
		foreach ($str as $key => $val){
			$str[$key] = trim_script($val);
		}
 	}else{
 		$str = preg_replace ( '/\<([\/]?)script([^\>]*?)\>/si', '&lt;\\1script\\2&gt;', $str );
		$str = preg_replace ( '/\<([\/]?)iframe([^\>]*?)\>/si', '&lt;\\1iframe\\2&gt;', $str );
		$str = preg_replace ( '/\<([\/]?)frame([^\>]*?)\>/si', '&lt;\\1frame\\2&gt;', $str );
		$str = preg_replace ( '/]]\>/si', ']] >', $str );
 	}
	return $str;
}
/**
 * 获取当前页面完整URL地址
 */
function get_url() {
	$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	$php_self = $_SERVER['PHP_SELF'] ? safe_replace($_SERVER['PHP_SELF']) : safe_replace($_SERVER['SCRIPT_NAME']);
	$path_info = isset($_SERVER['PATH_INFO']) ? safe_replace($_SERVER['PATH_INFO']) : '';
	$relate_url = isset($_SERVER['REQUEST_URI']) ? safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.safe_replace($_SERVER['QUERY_STRING']) : $path_info);
	return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}
/**
 * 字符截取 支持UTF8/GBK
 * @param $string
 * @param $length
 * @param $dot
 */
function str_cut($string, $length, $dot = '...') {
	$strlen = strlen($string);
	if($strlen <= $length) return $string;
	$string = str_replace(array(' ','&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array('∵',' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
	$strcut = '';
	if(strtolower(CHARSET) == 'utf-8') {
		$length = intval($length-strlen($dot)-$length/3);
		$n = $tn = $noc = 0;
		while($n < strlen($string)) {
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t <= 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) {
				break;
			}
		}
		if($noc > $length) {
			$n -= $tn;
		}
		$strcut = substr($string, 0, $n);
		$strcut = str_replace(array('∵', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), array(' ', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), $strcut);
	} else {
		$dotlen = strlen($dot);
		$maxi = $length - $dotlen - 1;
		$current_str = '';
		$search_arr = array('&',' ', '"', "'", '“', '”', '—', '<', '>', '·', '…','∵');
		$replace_arr = array('&amp;','&nbsp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;',' ');
		$search_flip = array_flip($search_arr);
		for ($i = 0; $i < $maxi; $i++) {
			$current_str = ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
			if (in_array($current_str, $search_arr)) {
				$key = $search_flip[$current_str];
				$current_str = str_replace($search_arr[$key], $replace_arr[$key], $current_str);
			}
			$strcut .= $current_str;
		}
	}
	return $strcut.$dot;
}



/**
 * 获取请求ip
 *
 * @return ip地址
 */
function ip() {
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
		$ip = getenv('HTTP_CLIENT_IP');
	} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
		$ip = getenv('REMOTE_ADDR');
	} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
}

function get_cost_time() {
	$microtime = microtime ( TRUE );
	return $microtime - SYS_START_TIME;
}
/**
 * 程序执行时间
 *
 * @return	int	单位ms
 */
function execute_time() {
	$stime = explode ( ' ', SYS_START_TIME );
	$etime = explode ( ' ', microtime () );
	return number_format ( ($etime [1] + $etime [0] - $stime [1] - $stime [0]), 6 );
}

/**
* 产生随机字符串
*
* @param    int        $length  输出长度 
* @param    string     $chars   可选的 ，默认为 0123456789
* @return   string     字符串
*/
function random($length, $chars = '0123456789') {
	$hash = '';
	$max = strlen($chars) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}

/**
* 将字符串转换为数组
*
* @param	string	$data	字符串
* @return	array	返回数组格式，如果，data为空，则返回空数组
*/
function string2array($data) {
	if($data == '') return array();
	@eval("\$array = $data;");
	return $array;
}
/**
* 将数组转换为字符串
*
* @param	array	$data		数组
* @param	bool	$isformdata	如果为0，则不使用new_stripslashes处理，可选参数，默认为1
* @return	string	返回字符串，如果，data为空，则返回空
*/
function array2string($data, $isformdata = 1) {
	if($data == '') return '';
	if($isformdata) $data = new_stripslashes($data);
	return addslashes(var_export($data, TRUE));
}

/**
* 转换字节数为其他单位
*
*
* @param	string	$filesize	字节大小
* @return	string	返回大小
*/
function sizecount($filesize) {
	if ($filesize >= 1073741824) {
		$filesize = round($filesize / 1073741824 * 100) / 100 .' GB';
	} elseif ($filesize >= 1048576) {
		$filesize = round($filesize / 1048576 * 100) / 100 .' MB';
	} elseif($filesize >= 1024) {
		$filesize = round($filesize / 1024 * 100) / 100 . ' KB';
	} else {
		$filesize = $filesize.' Bytes';
	}
	return $filesize;
}
/**
* 字符串加密、解密函数
*
*
* @param	string	$txt		字符串
* @param	string	$operation	ENCODE为加密，DECODE为解密，可选参数，默认为ENCODE，
* @param	string	$key		密钥：数字、字母、下划线
* @param	string	$expiry		过期时间
* @return	string
*/
function sys_auth($string, $operation = 'ENCODE', $key = '', $expiry = 0) {
	$key_length = 4;
	$key = md5($key != '' ? $key : pc_base::load_config('system', 'auth_key'));
	$fixedkey = md5($key);
	$egiskeys = md5(substr($fixedkey, 16, 16));
	$runtokey = $key_length ? ($operation == 'ENCODE' ? substr(md5(microtime(true)), -$key_length) : substr($string, 0, $key_length)) : ''; 
	$keys = md5(substr($runtokey, 0, 16) . substr($fixedkey, 0, 16) . substr($runtokey, 16) . substr($fixedkey, 16));
	$string = $operation == 'ENCODE' ? sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$egiskeys), 0, 16) . $string : base64_decode(substr($string, $key_length));
	
	$i = 0; $result = '';
	$string_length = strlen($string);
	for ($i = 0; $i < $string_length; $i++){
		$result .= chr(ord($string{$i}) ^ ord($keys{$i % 32}));
	}
	if($operation == 'ENCODE') {
		return $runtokey . str_replace('=', '', base64_encode($result));
	} else {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$egiskeys), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	}
}
/**
* 语言文件处理
*
* @param	string		$language	标示符
* @param	array		$pars	转义的数组,二维数组 ,'key1'=>'value1','key2'=>'value2',
* @param	string		$modules 多个模块之间用半角逗号隔开，如：member,guestbook
* @return	string		语言字符
*/
function L($language = 'no_language',$pars = array(), $modules = '') {
	static $LANG = array();
	static $LANG_MODULES = array();
	static $lang = '';
	if(defined('IN_ADMIN')) {
		$lang = SYS_STYLE ? SYS_STYLE : 'zh-cn';
	} else {
		$lang = pc_base::load_config('system','lang');
	}
	if(!$LANG) {
		require_once PC_PATH.'languages'.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.'system.lang.php';
		if(defined('IN_ADMIN')) require_once PC_PATH.'languages'.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.'system_menu.lang.php';
		if(file_exists(PC_PATH.'languages'.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.ROUTE_M.'.lang.php')) require PC_PATH.'languages'.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.ROUTE_M.'.lang.php';
	}
	if(!empty($modules)) {
		$modules = explode(',',$modules);
		foreach($modules AS $m) {
			if(!isset($LANG_MODULES[$m])) require PC_PATH.'languages'.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.$m.'.lang.php';
		}
	}
	if(!array_key_exists($language,$LANG)) {
		return $language;
	} else {
		$language = $LANG[$language];
		if($pars) {
			foreach($pars AS $_k=>$_v) {
				$language = str_replace('{'.$_k.'}',$_v,$language);
			}
		}
		return $language;
	}
}

/**
 * 模板调用
 * 
 * @param $module
 * @param $template
 * @param $istag
 * @return unknown_type
 */
function template($module = 'content', $template = 'index', $style = '') {
	
	if(strpos($module, 'plugin/')!== false) {
		$plugin = str_replace('plugin/', '', $module);
		return p_template($plugin, $template,$style);
	}
	$module = str_replace('/', DIRECTORY_SEPARATOR, $module);
	if(!empty($style) && preg_match('/([a-z0-9\-_]+)/is',$style)) {
	} elseif (empty($style) && !defined('STYLE')) {
		if(defined('SITEID')) {
			$siteid = SITEID;
		} else {
			$siteid = param::get_cookie('siteid');
		}
		if (!$siteid) $siteid = 1;
		$sitelist = getcache('sitelist','commons');
		if(!empty($siteid)) {
			$style = $sitelist[$siteid]['default_style'];
		}
	} elseif (empty($style) && defined('STYLE')) {
		$style = STYLE;
	} else {
		$style = 'default';
	}
	if(!$style) $style = 'default';
	$template_cache = pc_base::load_sys_class('template_cache');
	$compiledtplfile = PHPCMS_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_template'.DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.php';
	if(file_exists(PC_PATH.'templates'.DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html')) {
		if(!file_exists($compiledtplfile) || (@filemtime(PC_PATH.'templates'.DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html') > @filemtime($compiledtplfile))) {	
			$template_cache->template_compile($module, $template, $style);
		}
	} else {
		$compiledtplfile = PHPCMS_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_template'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.php';
		if(!file_exists($compiledtplfile) || (file_exists(PC_PATH.'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html') && filemtime(PC_PATH.'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html') > filemtime($compiledtplfile))) {
			$template_cache->template_compile($module, $template, 'default');
		} elseif (!file_exists(PC_PATH.'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html')) {
			showmessage('Template does not exist.'.DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html');
		}
	}
	return $compiledtplfile;
}

/**
 * 输出自定义错误
 * 
 * @param $errno 错误号
 * @param $errstr 错误描述
 * @param $errfile 报错文件地址
 * @param $errline 错误行号
 * @return string 错误提示
 */

function my_error_handler($errno, $errstr, $errfile, $errline) {
	if($errno==8) return '';
	$errfile = str_replace(PHPCMS_PATH,'',$errfile);
	if(pc_base::load_config('system','errorlog')) {
		error_log('<?php exit;?>'.date('m-d H:i:s',SYS_TIME).' | '.$errno.' | '.str_pad($errstr,30).' | '.$errfile.' | '.$errline."\r\n", 3, CACHE_PATH.'error_log.php');
	} else {
		$str = '<div style="font-size:12px;text-align:left; border-bottom:1px solid #9cc9e0; border-right:1px solid #9cc9e0;padding:1px 4px;color:#000000;font-family:Arial, Helvetica,sans-serif;"><span>errorno:' . $errno . ',str:' . $errstr . ',file:<font color="blue">' . $errfile . '</font>,line' . $errline .'<br /><a href="http://faq.phpcms.cn/?type=file&errno='.$errno.'&errstr='.urlencode($errstr).'&errfile='.urlencode($errfile).'&errline='.$errline.'" target="_blank" style="color:red">Need Help?</a></span></div>';
		echo $str;
	}
}

/**
 * 提示信息页面跳转，跳转地址如果传入数组，页面会提示多个地址供用户选择，默认跳转地址为数组的第一个值，时间为5秒。
 * showmessage('登录成功', array('默认跳转地址'=>'http://www.phpcms.cn'));
 * @param string $msg 提示信息
 * @param mixed(string/array) $url_forward 跳转地址
 * @param int $ms 跳转等待时间
 */
function showmessage($msg, $url_forward = 'goback', $ms = 1250, $dialog = '', $returnjs = '', $is_ajax=false) {
	if($is_ajax){
		echo ($msg);
		exit;
	}
	
	if(defined('IN_ADMIN')) {
		include(admin::admin_tpl('showmessage', 'admin'));
	} else {
		include(template('content', 'message'));
	}
	exit;
}
/**
 * 查询字符是否存在于某字符串
 * 
 * @param $haystack 字符串
 * @param $needle 要查找的字符
 * @return bool
 */
function str_exists($haystack, $needle)
{
	return !(strpos($haystack, $needle) === FALSE);
}

/**
 * 取得文件扩展
 * 
 * @param $filename 文件名
 * @return 扩展名
 */
function fileext($filename) {
	return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
}

/**
 * 加载模板标签缓存
 * @param string $name 缓存名
 * @param integer $times 缓存时间
 */
function tpl_cache($name,$times = 0) {
	$filepath = 'tpl_data';
	$info = getcacheinfo($name, $filepath);
	if (SYS_TIME - $info['filemtime'] >= $times) {
		return false;
	} else {
		return getcache($name,$filepath);
	}
}

/**
 * 写入缓存，默认为文件缓存，不加载缓存配置。
 * @param $name 缓存名称
 * @param $data 缓存数据
 * @param $filepath 数据路径（模块名称） caches/cache_$filepath/
 * @param $type 缓存类型[file,memcache,apc]
 * @param $config 配置名称
 * @param $timeout 过期时间
 */
function setcache($name, $data, $filepath='', $type='file', $config='', $timeout=0) {
	pc_base::load_sys_class('cache_factory','',0);
	if($config) {
		$cacheconfig = pc_base::load_config('cache');
		$cache = cache_factory::get_instance($cacheconfig)->get_cache($config);
	} else {
		$cache = cache_factory::get_instance()->get_cache($type);
	}

	return $cache->set($name, $data, $timeout, '', $filepath);
}

/**
 * 读取缓存，默认为文件缓存，不加载缓存配置。
 * @param string $name 缓存名称
 * @param $filepath 数据路径（模块名称） caches/cache_$filepath/
 * @param string $config 配置名称
 */
function getcache($name, $filepath='', $type='file', $config='') {
	pc_base::load_sys_class('cache_factory','',0);
	if($config) {
		$cacheconfig = pc_base::load_config('cache');
		$cache = cache_factory::get_instance($cacheconfig)->get_cache($config);
	} else {
		$cache = cache_factory::get_instance()->get_cache($type);
	}
	return $cache->get($name, '', '', $filepath);
}

/**
 * 删除缓存，默认为文件缓存，不加载缓存配置。
 * @param $name 缓存名称
 * @param $filepath 数据路径（模块名称） caches/cache_$filepath/
 * @param $type 缓存类型[file,memcache,apc]
 * @param $config 配置名称
 */
function delcache($name, $filepath='', $type='file', $config='') {
	pc_base::load_sys_class('cache_factory','',0);
	if($config) {
		$cacheconfig = pc_base::load_config('cache');
		$cache = cache_factory::get_instance($cacheconfig)->get_cache($config);
	} else {
		$cache = cache_factory::get_instance()->get_cache($type);
	}
	return $cache->delete($name, '', '', $filepath);
}

/**
 * 读取缓存，默认为文件缓存，不加载缓存配置。
 * @param string $name 缓存名称
 * @param $filepath 数据路径（模块名称） caches/cache_$filepath/
 * @param string $config 配置名称
 */
function getcacheinfo($name, $filepath='', $type='file', $config='') {
	pc_base::load_sys_class('cache_factory');
	if($config) {
		$cacheconfig = pc_base::load_config('cache');
		$cache = cache_factory::get_instance($cacheconfig)->get_cache($config);
	} else {
		$cache = cache_factory::get_instance()->get_cache($type);
	}
	return $cache->cacheinfo($name, '', '', $filepath);
}

/**
 * 生成sql语句，如果传入$in_cloumn 生成格式为 IN('a', 'b', 'c')
 * @param $data 条件数组或者字符串
 * @param $front 连接符
 * @param $in_column 字段名称
 * @return string
 */
function to_sqls($data, $front = ' AND ', $in_column = false) {
	if($in_column && is_array($data)) {
		$ids = '\''.implode('\',\'', $data).'\'';
		$sql = "$in_column IN ($ids)";
		return $sql;
	} else {
		if ($front == '') {
			$front = ' AND ';
		}
		if(is_array($data) && count($data) > 0) {
			$sql = '';
			foreach ($data as $key => $val) {
				$sql .= $sql ? " $front `$key` = '$val' " : " `$key` = '$val' ";	
			}
			return $sql;
		} else {
			return $data;
		}
	}
}

/**
 * 分页函数
 * 
 * @param $num 信息总数
 * @param $curr_page 当前分页
 * @param $perpage 每页显示数
 * @param $urlrule URL规则
 * @param $array 需要传递的数组，用于增加额外的方法
 * @return 分页
 */
function pages($num, $curr_page, $perpage = 20, $urlrule = '', $array = array(),$setpages = 10) {
	if(defined('URLRULE') && $urlrule == '') {
		$urlrule = URLRULE;
		$array = $GLOBALS['URL_ARRAY'];
	} elseif($urlrule == '') {
		$urlrule = url_par('page={$page}');
	}
	$multipage = '';
	if($num > $perpage) {
		$page = $setpages+1;
		$offset = ceil($setpages/2-1);
		$pages = ceil($num / $perpage);
		if (defined('IN_ADMIN') && !defined('PAGES')) define('PAGES', $pages);
		$from = $curr_page - $offset;
		$to = $curr_page + $offset;
		$more = 0;
		if($page >= $pages) {
			$from = 2;
			$to = $pages-1;
		} else {
			if($from <= 1) {
				$to = $page-1;
				$from = 2;
			}  elseif($to >= $pages) { 
				$from = $pages-($page-2);  
				$to = $pages-1;  
			}
			$more = 1;
		} 
		$multipage .= '<a class="a1">'.$num.L('page_item').'</a>';
		if($curr_page>0) {
			// 此处修改上一页是0的BUG，周泉。2011-7-2
			if($curr_page>1) {
				$multipage .= ' <a href="'.pageurl($urlrule, $curr_page-1, $array).'" class="a1">'.L('previous').'</a>';
			}
			if($curr_page==1) {
				$multipage .= ' <span>1</span>';
			} elseif($curr_page>6 && $more) {
				$multipage .= ' <a href="'.pageurl($urlrule, 1, $array).'">1</a>..';
			} else {
				$multipage .= ' <a href="'.pageurl($urlrule, 1, $array).'">1</a>';
			}
		}
		for($i = $from; $i <= $to; $i++) { 
			if($i != $curr_page) { 
				$multipage .= ' <a href="'.pageurl($urlrule, $i, $array).'">'.$i.'</a>'; 
			} else { 
				$multipage .= ' <span>'.$i.'</span>'; 
			} 
		} 
		if($curr_page<$pages) {
			if($curr_page<$pages-5 && $more) {
				$multipage .= ' ..<a href="'.pageurl($urlrule, $pages, $array).'">'.$pages.'</a> <a href="'.pageurl($urlrule, $curr_page+1, $array).'" class="a1">'.L('next').'</a>';
			} else {
				$multipage .= ' <a href="'.pageurl($urlrule, $pages, $array).'">'.$pages.'</a> <a href="'.pageurl($urlrule, $curr_page+1, $array).'" class="a1">'.L('next').'</a>';
			}
		} elseif($curr_page==$pages) {
			$multipage .= ' <span>'.$pages.'</span> <a href="'.pageurl($urlrule, $curr_page, $array).'" class="a1">'.L('next').'</a>';
		} else {
			$multipage .= ' <a href="'.pageurl($urlrule, $pages, $array).'">'.$pages.'</a> <a href="'.pageurl($urlrule, $curr_page+1, $array).'" class="a1">'.L('next').'</a>';
		}
			$multipage .='<input type="text" size="3" id="sach"><a onclick="sdomain()" class="a1">Go</a>';

	$multipage .='
<script language="javascript" type="text/javascript">
	function sdomain(){
		var url="'.pageurl($urlrule, '###', $array).'";
		var p=$("#sach").val();
		var temp = url.replace(/###/g, p);
    	//window.location.href = temp;
		this.location.href = temp;
	}
</script>';
	}

	//$multipage .= $urlrule;

	return $multipage;
}
/**
 * 返回分页路径
 * 
 * @param $urlrule 分页规则
 * @param $page 当前页
 * @param $array 需要传递的数组，用于增加额外的方法
 * @return 完整的URL路径
 */
function pageurl($urlrule, $page, $array = array()) {
	if(strpos($urlrule, '~')) {
		$urlrules = explode('~', $urlrule);
		$urlrule = $page < 2 ? $urlrules[0] : $urlrules[1];
	}
	$findme = array('{$page}');
	$replaceme = array($page);
	if (is_array($array)) foreach ($array as $k=>$v) {
		$findme[] = '{$'.$k.'}';
		$replaceme[] = $v;
	}
	$url = str_replace($findme, $replaceme, $urlrule);
	$url = str_replace(array('http://','//','~'), array('~','/','http://'), $url);
	return $url;
}

/**
 * URL路径解析，pages 函数的辅助函数
 *
 * @param $par 传入需要解析的变量 默认为，page={$page}
 * @param $url URL地址
 * @return URL
 */
function url_par($par, $url = '') {
	if($url == '') $url = get_url();
	$pos = strpos($url, '?');
	if($pos === false) {
		$url .= '?'.$par;
	} else {
		$querystring = substr(strstr($url, '?'), 1);
		parse_str($querystring, $pars);
		$query_array = array();
		foreach($pars as $k=>$v) {
			$query_array[$k] = $v;
		}
		$querystring = http_build_query($query_array).'&'.$par;
		$url = substr($url, 0, $pos).'?'.$querystring;
	}
	return $url;
}

/**
 * 判断email格式是否正确
 * @param $email
 */
function is_email($email) {
	return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}

/**
 * iconv 编辑转换
 */
if (!function_exists('iconv')) {
	function iconv($in_charset, $out_charset, $str) {
		$in_charset = strtoupper($in_charset);
		$out_charset = strtoupper($out_charset);
		if (function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($str, $out_charset, $in_charset);
		} else {
			pc_base::load_sys_func('iconv');
			$in_charset = strtoupper($in_charset);
			$out_charset = strtoupper($out_charset);
			if ($in_charset == 'UTF-8' && ($out_charset == 'GBK' || $out_charset == 'GB2312')) {
				return utf8_to_gbk($str);
			}
			if (($in_charset == 'GBK' || $in_charset == 'GB2312') && $out_charset == 'UTF-8') {
				return gbk_to_utf8($str);
			}
			return $str;
		}
	}
}

/**
 * 代码广告展示函数
 * @param intval $siteid 所属站点
 * @param intval $id 广告ID
 * @return 返回广告代码
 */
function show_ad($siteid, $id) {
	$siteid = intval($siteid);
	$id = intval($id);
	if(!$id || !$siteid) return false;
	$p = pc_base::load_model('poster_model');
	$r = $p->get_one(array('spaceid'=>$id, 'siteid'=>$siteid), 'disabled, setting', '`id` ASC');
	if ($r['disabled']) return '';
	if ($r['setting']) {
		$c = string2array($r['setting']);
	} else {
		$r['code'] = '';
	}
	return $c['code'];
}

/**
 * 获取当前的站点ID
 */
function get_siteid() {
	static $siteid;
	if (!empty($siteid)) return $siteid;
    $_siteid= !empty($_REQUEST['siteid'])?trim(intval($_REQUEST['siteid'])):0;
    if($_siteid>0)
    {
        return $_siteid;
    }
    unset($_siteid);
	if (defined('IN_ADMIN')) {
		if ($d = param::get_cookie('siteid')) {
			$siteid = $d;
		} else {
			return 1;
		}
	} else {
		$data = getcache('sitelist', 'commons');
		$site_url = SITE_PROTOCOL.SITE_URL;
		foreach ($data as $v) {
			if ($v['url'] == $site_url.'/') $siteid = $v['siteid'];
		}
	}
	if (empty($siteid)) $siteid = 1;
	return $siteid;
}

/**
 * 获取用户昵称
 * 不传入userid取当前用户nickname,如果nickname为空取username
 * 传入field，取用户$field字段信息
 */
function get_nickname($userid='', $field='') {
	$return = '';
	if(is_numeric($userid)) {
		$member_db = pc_base::load_model('member_model');
		$memberinfo = $member_db->get_one(array('userid'=>$userid));
		if(!empty($field) && $field != 'nickname' && isset($memberinfo[$field]) &&!empty($memberinfo[$field])) {
			$return = $memberinfo[$field];
		} else {
			$return = isset($memberinfo['nickname']) && !empty($memberinfo['nickname']) ? $memberinfo['nickname'].'('.$memberinfo['username'].')' : $memberinfo['username'];
		}
	} else {
		if (param::get_cookie('_nickname')) {
			$return .= '('.param::get_cookie('_nickname').')';
		} else {
			$return .= '('.param::get_cookie('_username').')';
		}
	}
	return $return;
}

/**
 * 获取用户信息
 * 不传入$field返回用户所有信息,
 * 传入field，取用户$field字段信息
 */
function get_memberinfo($userid, $field='') {
	if(!is_numeric($userid)) {
		return false;
	} else {
		static $memberinfo;
		if (!isset($memberinfo[$userid])) {
			$member_db = pc_base::load_model('member_model');
			$memberinfo[$userid] = $member_db->get_one(array('userid'=>$userid));
		}
		if(!empty($field) && !empty($memberinfo[$userid][$field])) {
			return $memberinfo[$userid][$field];
		} else {
			return $memberinfo[$userid];
		}
	}
}

/**
 * 通过 username 值，获取用户所有信息
 * 获取用户信息
 * 不传入$field返回用户所有信息,
 * 传入field，取用户$field字段信息
 */
function get_memberinfo_buyusername($username, $field='') {
	if(empty($username)){return false;}
	static $memberinfo;
	if (!isset($memberinfo[$username])) {
		$member_db = pc_base::load_model('member_model');
		$memberinfo[$username] = $member_db->get_one(array('username'=>$username));
	}
	if(!empty($field) && !empty($memberinfo[$username][$field])) {
		return $memberinfo[$username][$field];
	} else {
		return $memberinfo[$username];
	}
}

/**
 * 获取用户头像，建议传入phpssouid
 * @param $uid 默认为phpssouid 
 * @param $is_userid $uid是否为v9 userid，如果为真，执行sql查询此用户的phpssouid
 * @param $size 头像大小 有四种[30x30 45x45 90x90 180x180] 默认30
 */
function get_memberavatar($uid, $is_userid='', $size='30') {
	if($is_userid) {
		$db = pc_base::load_model('member_model');
		$memberinfo = $db->get_one(array('userid'=>$uid));
		if(isset($memberinfo['phpssouid'])) {
			$uid = $memberinfo['phpssouid'];
		} else {
			return false;
		}
	}
	
	pc_base::load_app_class('client', 'member', 0);
	define('APPID', pc_base::load_config('system', 'phpsso_appid'));
	$phpsso_api_url = pc_base::load_config('system', 'phpsso_api_url');
	$phpsso_auth_key = pc_base::load_config('system', 'phpsso_auth_key');
	$client = new client($phpsso_api_url, $phpsso_auth_key);
	$avatar = $client->ps_getavatar($uid);
	if(isset($avatar[$size])) {
		return $avatar[$size];
	} else {
		return false;
	}
}
/**
 * ip判断城市
 * wanguochao
 * 2011-06-2
 */

function get_real_city() {		
	/* $cip=get_real_ip();
	$ipku_db = pc_base::load_model('ipku_model');
	$cdata =$ipku_db->select("start<=$cip order by start desc limit 1");     
    $real_city['c'] = $cdata['0']['city'];	
	$city_cache = getcache('1','linkage');
	$city_c = $city_cache['data'][$cdata['0']['cid']];
	$city_s = $city_cache['data'][$city_c['parentid']]['name'];
	$real_city['s'] = $city_s;
    $real_city['areaid'] = $cdata[0]['cid']; */
	//上面为之前的2012.04.27
	
	$ip=ip();
// 	$ip = '222.173.27.117';
	//获取ip所在地区
	$ipcity = pc_base::load_sys_class('IPCity');
	$ipcity->GetCityByIP($ip);
	//地区转码
	pc_base::load_sys_func('iconv');
	$province = $ipcity->Province;
	$province != '未知' && $province = iconv('gbk', CHARSET, $province);
	$city = iconv('gbk', CHARSET, $ipcity->City);

	//匹配改地区对应的linkageid
	$city_cache = getcache('1','linkage');
	$city_cache = $city_cache['data'];
	
	$province_id = $city_id = 0;
	
	if ($province != '未知'){
		//匹配省	
		foreach ($city_cache as $v){
			if (empty($v['parentid'])){
				if (strpos($v['name'], $province) !== false){
					$province_id = $v['linkageid'];
					break;
				}
			}
		}
		//匹配市
		foreach ($city_cache as $v){
			if ($v['parentid'] == $province_id){
				if (strpos($v['name'], $city) !== false){
					$city_id = $v['linkageid'];
					break;
				}
			}
		}
	}
	unset($city_cache);
	//构造返回数组
	$real_city = array(
		's' => $province,
		'c' => $city,
		's_areaid' => $province_id,
		'areaid' => $city_id,		
	);
	
	return $real_city;
}

/**
 * 调用关联菜单
 * @param $linkageid 联动菜单id
 * @param $id 生成联动菜单的样式id
 * @param $defaultvalue 默认值
 */
function get_real_ip(){
	$ip=false;
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
		$ip=$_SERVER["HTTP_CLIENT_IP"];
	}
	if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ips=explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
		if ($ip){
			array_unshift($ips,$ip);
			$ip=FALSE;
		}
		for($i=0;$i<count($ips);$i++){
			if (!eregi("^(10│172.16│192.168).",$ips[$i])){
				$ip=$ips[$i];
				break;
			}
		}
	}
	$ip=$ip?$ip:$_SERVER['REMOTE_ADDR'];
	//$ip='124.132.34.55';
	list($ip1,$ip2,$ip3,$ip4)=explode(".",$ip); 
	return $ip1*pow(256,3)+$ip2*pow(256,2)+$ip3*256+$ip4;
}

function menu_linkage($linkageid = 0, $id = 'linkid', $defaultvalue = 0) {
	$linkageid = intval($linkageid);
	$datas = array();
	$datas = getcache($linkageid,'linkage');
	$infos = $datas['data'];
	
	if($datas['style']=='1') {
		$title = $datas['title'];	
		$container = 'content'.random(3).date('is');
		if(!defined('DIALOG_INIT_1')) {
			define('DIALOG_INIT_1', 1);
			$string .= '<script type="text/javascript" src="'.JS_PATH.'dialog.js"></script>';
			//TODO $string .= '<link href="'.CSS_PATH.'dialog.css" rel="stylesheet" type="text/css">';
		}
		if(!defined('LINKAGE_INIT_1')) {
			define('LINKAGE_INIT_1', 1);
			$string .= '<script type="text/javascript" src="'.JS_PATH.'linkage/js/pop.js"></script>';
		}
		$var_div = $defaultvalue && (ROUTE_A=='edit' || ROUTE_A=='account_manage_info'  || ROUTE_A=='info_publish' || ROUTE_A=='orderinfo') ? menu_linkage_level($defaultvalue,$linkageid,$infos) : $datas['title'];
		$var_input = $defaultvalue && (ROUTE_A=='edit' || ROUTE_A=='account_manage_info'  || ROUTE_A=='info_publish') ? '<input type="hidden" name="info['.$id.']" value="'.$defaultvalue.'">' : '<input type="hidden" name="info['.$id.']" value="">';
		$string .= '<div name="'.$id.'" value="" id="'.$id.'" class="ib">'.$var_div.'</div>'.$var_input.' <input type="button" name="btn_'.$id.'" class="button" value="'.L('linkage_select').'" onclick="open_linkage(\''.$id.'\',\''.$title.'\','.$container.',\''.$linkageid.'\')">';
		$string .= '<script type="text/javascript">';
		$string .= 'var returnid_'.$id.'= \''.$id.'\';';
		$string .= 'var returnkeyid_'.$id.' = \''.$linkageid.'\';';
		$string .=  'var '.$container.' = new Array(';
		foreach($infos AS $k=>$v) {
			if($v['parentid'] == 0) {
				$s[]='new Array(\''.$v['linkageid'].'\',\''.$v['name'].'\',\''.$v['parentid'].'\')';
			} else {
				continue;
			}
		}
		$s = implode(',',$s);
		$string .=$s;
		$string .= ')';
		$string .= '</script>';
		
	} elseif($datas['style']=='2') {
		if(!defined('LINKAGE_INIT_1')) {
			define('LINKAGE_INIT_1', 1);
			$string .= '<script type="text/javascript" src="'.JS_PATH.'linkage/js/jquery.ld.js"></script>';
		}
		$default_txt = '';
		if($defaultvalue) {
				$default_txt = menu_linkage_level($defaultvalue,$linkageid,$infos);
				$default_txt = '["'.str_replace(' > ','","',$default_txt).'"]';
		}
		$string .= $defaultvalue && (ROUTE_A=='edit' || ROUTE_A=='account_manage_info'  || ROUTE_A=='info_publish') ? '<input type="hidden" name="info['.$id.']"  id="'.$id.'" value="'.$defaultvalue.'">' : '<input type="hidden" name="info['.$id.']"  id="'.$id.'" value="">';

		for($i=1;$i<=$datas['setting']['level'];$i++) {
			$string .='<select class="pc-select-'.$id.'" name="'.$id.'-'.$i.'" id="'.$id.'-'.$i.'" width="100"><option value="">请选择菜单</option></select> ';
		}

		$string .= '<script type="text/javascript">
					$(function(){
						var $ld5 = $(".pc-select-'.$id.'");					  
						$ld5.ld({ajaxOptions : {"url" : "'.APP_PATH.'api.php?op=get_linkage&act=ajax_select&keyid='.$linkageid.'"},defaultParentId : 0,style : {"width" : 120}})	 
						var ld5_api = $ld5.ld("api");
						ld5_api.selected('.$default_txt.');
						$ld5.bind("change",onchange);
						function onchange(e){
							var $target = $(e.target);
							var index = $ld5.index($target);
							$("#'.$id.'-'.$i.'").remove();
							$("#'.$id.'").val($ld5.eq(index).show().val());
							index ++;
							$ld5.eq(index).show();								}
					})
		</script>';
			
	} else {
		$title = $defaultvalue ? $infos[$defaultvalue]['name'] : $datas['title'];	
		$colObj = random(3).date('is');
		$string = '';
		if(!defined('LINKAGE_INIT')) {
			define('LINKAGE_INIT', 1);
			$string .= '<script type="text/javascript" src="'.JS_PATH.'linkage/js/mln.colselect.js"></script>';
			if(defined('IN_ADMIN')) {
				$string .= '<link href="'.JS_PATH.'linkage/style/admin.css" rel="stylesheet" type="text/css">';
			} else {
				$string .= '<link href="'.JS_PATH.'linkage/style/css.css" rel="stylesheet" type="text/css">';
			}
		}
		$string .= '<input type="hidden" name="info['.$id.']" value="1"><div id="'.$id.'"></div>';
		$string .= '<script type="text/javascript">';
		$string .= 'var colObj'.$colObj.' = {"Items":[';
		
		foreach($infos AS $k=>$v) {
			$s .= '{"name":"'.$v['name'].'","topid":"'.$v['parentid'].'","colid":"'.$k.'","value":"'.$k.'","fun":function(){}},';
		}
	
		$string .= substr($s, 0, -1);
		$string .= ']};';
		$string .= '$("#'.$id.'").mlnColsel(colObj'.$colObj.',{';
		$string .= 'title:"'.$title.'",';
		$string .= 'value:"'.$defaultvalue.'",';
		$string .= 'width:100';
		$string .= '});';
		$string .= '</script>';
	}
	return $string;
}

/**
 * 联动菜单层级
 */

function menu_linkage_level($linkageid,$keyid,$infos,$result=array()) {
	if(array_key_exists($linkageid,$infos)) {
		$result[]=$infos[$linkageid]['name'];
		return menu_linkage_level($infos[$linkageid]['parentid'],$keyid,$infos,$result);
	}
	krsort($result);
	return implode(' > ',$result);
}

/**
 * 通过catid获取显示菜单完整结构
 * @param  $menuid 菜单ID
 * @param  $cache_file 菜单缓存文件名称
 * @param  $cache_path 缓存文件目录
 * @param  $key 取得缓存值的键值名称
 * @param  $parentkey 父级的ID
 * @param  $linkstring 链接字符
 */
function menu_level($menuid, $cache_file, $cache_path = 'commons', $key = 'catname', $parentkey = 'parentid', $linkstring = ' > ', $result=array()) {
	$menu_arr = getcache($cache_file, $cache_path);
	if (array_key_exists($menuid, $menu_arr)) {
		$result[] = $menu_arr[$menuid][$key];
		return menu_level($menu_arr[$menuid][$parentkey], $cache_file, $cache_path, $key, $parentkey, $linkstring, $result);
	}
	krsort($result);
	return implode($linkstring, $result);
}
/**
 * 通过id获取显示联动菜单
 * @param  $linkageid 联动菜单ID
 * @param  $keyid 菜单keyid
 * @param  $space 菜单间隔符
 * @param  $tyoe 1 返回间隔符链接，完整路径名称 3 返回完整路径数组，2返回当前联动菜单名称，4 直接返回ID
 * @param  $result 递归使用字段1
 * @param  $infos 递归使用字段2
 */
function get_linkage($linkageid, $keyid, $space = '>', $type = 1, $result = array(), $infos = array()) {
	if($space=='' || !isset($space))$space = '>';
	if(!$infos) {
		$datas = getcache($keyid,'linkage');
		$infos = $datas['data'];
	}
	if($type == 1 || $type == 3 || $type == 4) {
		if(array_key_exists($linkageid,$infos)) {
			$result[]= ($type == 1) ? $infos[$linkageid]['name'] : (($type == 4) ? $linkageid :$infos[$linkageid]);
			return get_linkage($infos[$linkageid]['parentid'], $keyid, $space, $type, $result, $infos);
		} else {
			if(count($result)>0) {
				krsort($result);
				if($type == 1 || $type == 4) $result = implode($space,$result);
				return $result;
			} else {
				return $result;
			}
		}
	} else {
		return $infos[$linkageid]['name'];
	}			
}
/**
 * IE浏览器判断
 */

function is_ie() {
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if((strpos($useragent, 'opera') !== false) || (strpos($useragent, 'konqueror') !== false)) return false;
	if(strpos($useragent, 'msie ') !== false) return true;
	return false;
}


/**
 * 文件下载
 * @param $filepath 文件路径
 * @param $filename 文件名称
 */

function file_down($filepath, $filename = '') {
	if(!$filename) $filename = basename($filepath);
	if(is_ie()) $filename = rawurlencode($filename);
	$filetype = fileext($filename);
	$filesize = sprintf("%u", filesize($filepath));
	if(ob_get_length() !== false) @ob_end_clean();
	header('Pragma: public');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: pre-check=0, post-check=0, max-age=0');
	header('Content-Transfer-Encoding: binary');
	header('Content-Encoding: none');
	header('Content-type: '.$filetype);
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	header('Content-length: '.$filesize);
	readfile($filepath);
	exit;
}

/**
 * 判断字符串是否为utf8编码，英文和半角字符返回ture
 * @param $string
 * @return bool
 */
function is_utf8($string) {
	return preg_match('%^(?:
					[\x09\x0A\x0D\x20-\x7E] # ASCII
					| [\xC2-\xDF][\x80-\xBF] # non-overlong 2-byte
					| \xE0[\xA0-\xBF][\x80-\xBF] # excluding overlongs
					| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
					| \xED[\x80-\x9F][\x80-\xBF] # excluding surrogates
					| \xF0[\x90-\xBF][\x80-\xBF]{2} # planes 1-3
					| [\xF1-\xF3][\x80-\xBF]{3} # planes 4-15
					| \xF4[\x80-\x8F][\x80-\xBF]{2} # plane 16
					)*$%xs', $string);
}

/**
 * 组装生成ID号
 * @param $modules 模块名
 * @param $contentid 内容ID
 * @param $siteid 站点ID
 */
function id_encode($modules,$contentid, $siteid) {
	return urlencode($modules.'-'.$contentid.'-'.$siteid);
}

/**
 * 解析ID
 * @param $id 评论ID
 */
function id_decode($id) {
	return explode('-', $id);
}

/**
 * 对用户的密码进行加密
 * @param $password
 * @param $encrypt //传入加密串，在修改密码时做认证
 * @return array/password
 */
function password($password, $encrypt='') {
	$pwd = array();
	$pwd['encrypt'] =  $encrypt ? $encrypt : create_randomstr();	
	$pwd['password'] = md5(md5(trim($password)).$pwd['encrypt']);
	return $encrypt ? $pwd['password'] : $pwd;
}
/**
 * 生成随机字符串
 * @param string $lenth 长度
 * @return string 字符串
 */
function create_randomstr($lenth = 6) {
	return random($lenth, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
}

/**
 * 检查密码长度是否符合规定
 *
 * @param STRING $password
 * @return 	TRUE or FALSE
 */
function is_password($password) {
	$strlen = strlen($password);
	if($strlen >= 6 && $strlen <= 20) return true;
	return false;
}

 /**
 * 检测输入中是否含有错误字符
 *
 * @param char $string 要检查的字符串名称
 * @return TRUE or FALSE
 */
function is_badword($string) {
	$badwords = array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n","#");
	foreach($badwords as $value){
		if(strpos($string, $value) !== FALSE) {
			return TRUE;
		}
	}
	return FALSE;
}

/**
 * 检查用户名是否符合规定
 *
 * @param STRING $username 要检查的用户名
 * @return 	TRUE or FALSE
 */
function is_username($username) {
	$strlen = strlen($username);
	if(is_badword($username) || !preg_match("/^[a-zA-Z0-9_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]+$/", $username)){		
		return false;
	} elseif ( 20 < $strlen || $strlen < 2 ) {
		return false;
	}
	return true;
}

/**
 * 检查id是否存在于数组中
 * 
 * @param $id
 * @param $ids
 * @param $s
 */
function check_in($id, $ids = '', $s = ',') {
	if(!$ids) return false;
	$ids = explode($s, $ids);
	return is_array($id) ? array_intersect($id, $ids) : in_array($id, $ids);
}

/**
 * 对数据进行编码转换
 * @param array/string $data       数组
 * @param string $input     需要转换的编码
 * @param string $output    转换后的编码
 */
function array_iconv($data, $input = 'gbk', $output = 'utf-8') {
	if (!is_array($data)) {
		return iconv($input, $output, $data);
	} else {
		foreach ($data as $key=>$val) {
			if(is_array($val)) {
				$data[$key] = array_iconv($val, $input, $output);
			} else {
				$data[$key] = iconv($input, $output, $val);
			}
		}
		return $data;
	}
}

/**
 * 生成缩略图函数
 * @param  $imgurl 图片路径
 * @param  $width  缩略图宽度
 * @param  $height 缩略图高度
 * @param  $autocut 是否自动裁剪 默认裁剪，当高度或宽度有一个数值为0是，自动关闭
 * @param  $smallpic 无图片是默认图片路径
 */
function thumb($imgurl, $width = 100, $height = 100 ,$autocut = 1, $smallpic = 'nopic.gif') {
	global $image;
	$upload_url = pc_base::load_config('system','upload_url');
	$upload_path = pc_base::load_config('system','upload_path');		
	if(empty($imgurl)) return IMG_PATH.$smallpic;
	$imgurl_replace= str_replace($upload_url, '', $imgurl);		
	if(!extension_loaded('gd') || strpos($imgurl_replace, '://')) return $imgurl;
	if(!file_exists($upload_path.$imgurl_replace)) return IMG_PATH.$smallpic;
	
	list($width_t, $height_t, $type, $attr) = getimagesize($upload_path.$imgurl_replace);
	if($width>=$width_t || $height>=$height_t) return $imgurl;
	
	$newimgurl = dirname($imgurl_replace).'/thumb_'.$width.'_'.$height.'_'.basename($imgurl_replace);
	
	if(file_exists($upload_path.$newimgurl)) return $upload_url.$newimgurl;
	
	if(!is_object($image)) {
		pc_base::load_sys_class('image','','0');
		$image = new image(1,0);
	}
	return $image->thumb($upload_path.$imgurl_replace, $upload_path.$newimgurl, $width, $height, '', $autocut) ? $upload_url.$newimgurl : $imgurl;
}

/**
 * 水印添加
 * @param $source 原图片路径
 * @param $target 生成水印图片途径，默认为空，覆盖原图
 * @param $siteid 站点id，系统需根据站点id获取水印信息
 */
function watermark($source, $target = '',$siteid) {
	global $image_w;
	if(empty($source)) return $source;
	if(!extension_loaded('gd') || strpos($source, '://')) return $source;
	if(!$target) $target = $source;
	if(!is_object($image_w)){
		pc_base::load_sys_class('image','','0');
		$image_w = new image(0,$siteid);
	}
		$image_w->watermark($source, $target);
	return $target;
}

/**
 * 当前路径 
 * 返回指定栏目路径层级
 * @param $catid 栏目id
 * @param $symbol 栏目间隔符
 */
function catpos($catid, $symbol=' > '){
	$category_arr = array();
	$siteids = getcache('category_content','commons');
	$siteid = $siteids[$catid];
	$category_arr = getcache('category_content_'.$siteid,'commons');
	if(!isset($category_arr[$catid])) return '';
	$pos = '';
	$siteurl = siteurl($category_arr[$catid]['siteid']);
	$arrparentid = array_filter(explode(',', $category_arr[$catid]['arrparentid'].','.$catid));
	foreach($arrparentid as $catid) {
		$url = $category_arr[$catid]['url'];
		if(strpos($url, '://') === false) $url = $siteurl.$url;
		$pos .= '<a href="'.$url.'">'.$category_arr[$catid]['catname'].'</a>'.$symbol;
	}
	return $pos;
}

/**
 * 根据catid获取子栏目数据的sql语句
 * @param string $module 缓存文件名
 * @param intval $catid 栏目ID
 */

function get_sql_catid($file = 'category_content_1', $catid = 0, $module = 'commons') {
	$category = getcache($file,$module);
	$catid = intval($catid);
	if(!isset($category[$catid])) return false;
	return $category[$catid]['child'] ? " `catid` IN(".$category[$catid]['arrchildid'].") " : " `catid`=$catid ";
}

/**
 * 获取子栏目
 * @param $parentid 父级id 
 * @param $type 栏目类型
 * @param $self 是否包含本身 0为不包含
 * @param $siteid 站点id
 */
function subcat($parentid = NULL, $type = NULL,$self = '0', $siteid = '') {
	if (empty($siteid)) $siteid = get_siteid();
	$category = getcache('category_content_'.$siteid,'commons');
	foreach($category as $id=>$cat) {
		if($cat['siteid'] == $siteid && ($parentid === NULL || $cat['parentid'] == $parentid) && ($type === NULL || $cat['type'] == $type)) $subcat[$id] = $cat;
		if($self == 1 && $cat['catid'] == $parentid && !$cat['child'])  $subcat[$id] = $cat;
	}
	return $subcat;
}

/**
 * 获取内容地址
 * @param $catid   栏目ID
 * @param $id      文章ID
 * @param $allurl  是否以绝对路径返回
 */
function go($catid,$id, $allurl = 0) {
	static $category;
	if(empty($category)) {
		$siteids = getcache('category_content','commons');
		$siteid = $siteids[$catid];
		$category = getcache('category_content_'.$siteid,'commons');
	}
	$id = intval($id);
	if(!$id || !isset($category[$catid])) return '';
	$modelid = $category[$catid]['modelid'];
	if(!$modelid) return '';
	$db = pc_base::load_model('content_model');
	$db->set_model($modelid);
	$r = $db->get_one(array('id'=>$id), '`url`');
	if (!empty($allurl)) {
		if (strpos($r['url'], '://')===false) {
			if (strpos($category[$catid]['url'], '://') === FALSE) {
				$site = siteinfo($category[$catid]['siteid']);
				$r['url'] = substr($site['domain'], 0, -1).$r['url'];
			} else {
				$r['url'] = $category[$catid]['url'].$r['url'];
			}
		}
	}
	
	return $r['url'];
}

/**
 * 将附件地址转换为绝对地址
 * @param $path 附件地址
 */
function atturl($path) {
	if(strpos($path, ':/')) {
		return $path;
	} else {
		$sitelist = getcache('sitelist','commons');
		$siteid =  get_siteid();
		$siteurl = $sitelist[$siteid]['domain'];
		$domainlen = strlen($sitelist[$siteid]['domain'])-1;
		$path = $siteurl.$path;
		$path = substr_replace($path, '/', strpos($path, '//',$domainlen),2);
		return 	$path;
	}
}

/**
 * 判断模块是否安装
 * @param $m	模块名称
 */
function module_exists($m = '') {
	if ($m=='admin') return true;
	$modules = getcache('modules', 'commons');
	$modules = array_keys($modules);
	return in_array($m, $modules);
}

/**
 * 生成SEO
 * @param $siteid       站点ID
 * @param $catid        栏目ID
 * @param $title        标题
 * @param $description  描述
 * @param $keyword      关键词
 */
function seo($siteid, $catid = '', $title = '', $description = '', $keyword = '') {
	if (!empty($title))$title = strip_tags($title);
	if (!empty($description)) $description = strip_tags($description);
	if (!empty($keyword)) $keyword = str_replace(' ', ',', strip_tags($keyword));
	$sites = getcache('sitelist', 'commons');
	$site = $sites[$siteid];
	$cat = array();
	if (!empty($catid)) {
		$siteids = getcache('category_content','commons');
		$siteid = $siteids[$catid];
		$categorys = getcache('category_content_'.$siteid,'commons');
		$cat = $categorys[$catid];
		$cat['setting'] = string2array($cat['setting']);
	}
	$seo['site_title'] =isset($site['site_title']) && !empty($site['site_title']) ? $site['site_title'] : $site['name'];
	$seo['keyword'] = !empty($keyword) ? $keyword : $site['keywords'];
	$seo['description'] = isset($description) && !empty($description) ? $description : (isset($cat['setting']['meta_description']) && !empty($cat['setting']['meta_description']) ? $cat['setting']['meta_description'] : (isset($site['description']) && !empty($site['description']) ? $site['description'] : ''));
	$seo['title'] =  (isset($title) && !empty($title) ? $title.' - ' : '').(isset($cat['setting']['meta_title']) && !empty($cat['setting']['meta_title']) ? $cat['setting']['meta_title'].' - ' : (isset($cat['catname']) && !empty($cat['catname']) ? $cat['catname'].' - ' : ''));
	foreach ($seo as $k=>$v) {
		$seo[$k] = str_replace(array("\n","\r"),	'', $v);
	}
	return $seo;
}

/**
 * 获取站点的信息
 * @param $siteid   站点ID
 */
function siteinfo($siteid) {
	static $sitelist;
	if (empty($sitelist)) $sitelist  = getcache('sitelist','commons');
	return isset($sitelist[$siteid]) ? $sitelist[$siteid] : '';
}

/**
 * 生成CNZZ统计代码
 */

function tjcode() {
	if(!module_exists('cnzz')) return false;
	$config = getcache('cnzz', 'commons');
	if (empty($config)) {
		return false;
	} else {
		return '<script src=\'http://pw.cnzz.com/c.php?id='.$config['siteid'].'&l=2\' language=\'JavaScript\' charset=\'gb2312\'></script>';
	}
}

/**
 * 生成标题样式
 * @param $style   样式
 * @param $html    是否显示完整的STYLE
 */
function title_style($style, $html = 1) {
	$str = '';
	if ($html) $str = ' style="';
	$style_arr = explode(';',$style);
	if (!empty($style_arr[0])) $str .= 'color:'.$style_arr[0].';';
	if (!empty($style_arr[1])) $str .= 'font-weight:'.$style_arr[1].';';
	if ($html) $str .= '" ';
	return $str;
}

/**
 * 获取站点域名
 * @param $siteid   站点id
 */
function siteurl($siteid) {
	static $sitelist;
	if(!$siteid) return WEB_PATH;
	if(empty($sitelist)) $sitelist = getcache('sitelist','commons');
	return substr($sitelist[$siteid]['domain'],0,-1);
}
/**
 * 生成上传附件验证
 * @param $args   参数
 * @param $operation   操作类型(加密解密)
 */

function upload_key($args) {
	$pc_auth_key = md5(pc_base::load_config('system','auth_key').$_SERVER['HTTP_USER_AGENT']);
	$authkey = md5($args.$pc_auth_key);
	return $authkey;
}

/**
 * 文本转换为图片
 * @param string $txt 图形化文本内容
 * @param int $fonttype 无外部字体时生成文字大小，取值范围1-5
 * @param int $fontsize 引入外部字体时，字体大小
 * @param string $font 字体名称 字体请放于phpcms\libs\data\font下
 * @param string $fontcolor 字体颜色 十六进制形式 如FFFFFF,FF0000
 */
function string2img($txt, $fonttype = 5, $fontsize = 16, $font = '', $fontcolor = 'FF0000',$transparent = '1') {
	if(empty($txt)) return false;
	if(function_exists("imagepng")) {
		$txt = urlencode(sys_auth($txt));
		$txt = '<img src="'.APP_PATH.'api.php?op=creatimg&txt='.$txt.'&fonttype='.$fonttype.'&fontsize='.$fontsize.'&font='.$font.'&fontcolor='.$fontcolor.'&transparent='.$transparent.'" align="absmiddle">';
	}
	return $txt;
}

/**
 * 获取phpcms版本号
 */
function get_pc_version($type='') {
	$version = pc_base::load_config('version');
	if($type==1) {
		return $version['pc_version'];
	} elseif($type==2) {
		return $version['pc_release'];
	} else {
		return $version['pc_version'].' '.$version['pc_release'];
	}
}
/**
 * 运行钩子（插件使用）
 */
function runhook($method) {
	$time_start = getmicrotime();
	$data  = '';
	$getpclass = FALSE;
	$hook_appid = getcache('hook','plugins');
	if(!empty($hook_appid)) {
		foreach($hook_appid as $appid => $p) {
			$pluginfilepath = PC_PATH.'plugin'.DIRECTORY_SEPARATOR.$p.DIRECTORY_SEPARATOR.'hook.class.php';
			$getpclass = TRUE;		
			include_once $pluginfilepath;
		}
		$hook_appid = array_flip($hook_appid);
		if($getpclass) {
			$pclass = new ReflectionClass('hook'); 
			foreach($pclass->getMethods() as $r) {
				$legalmethods[] = $r->getName(); 
			}
		}
		if(in_array($method,$legalmethods)) {
			foreach (get_declared_classes() as $class){
			   $refclass = new ReflectionClass($class);
			   if($refclass->isSubclassOf('hook')){
				  if ($_method = $refclass->getMethod($method)) {
						  $classname = $refclass->getName();
						if ($_method->isPublic() && $_method->isFinal()) {			
							plugin_stat($hook_appid[$classname]);
							$data .= $_method->invoke(null);						
						}
					}
			   }
			}
		}
		return $data;
	}
}

function getmicrotime() {
	list($usec, $sec) = explode(" ",microtime()); 
	return ((float)$usec + (float)$sec); 
}
 
/**
 * 插件前台模板加载
 * Enter description here ...
 * @param unknown_type $module
 * @param unknown_type $template
 * @param unknown_type $style
 */
function p_template($plugin = 'content', $template = 'index',$style='default') {
	if(!$style) $style = 'default';
	$template_cache = pc_base::load_sys_class('template_cache');
	$compiledtplfile = PHPCMS_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_template'.DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.'plugin'.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR.$template.'.php';

	if(!file_exists($compiledtplfile) || (file_exists(PC_PATH.'plugin'.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$template.'.html') && filemtime(PC_PATH.'plugin'.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$template.'.html') > filemtime($compiledtplfile))) {
		$template_cache->template_compile('plugin/'.$plugin, $template, 'default');
	} elseif (!file_exists(PC_PATH.'plugin'.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$template.'.html')) {
		showmessage('Template does not exist.'.DIRECTORY_SEPARATOR.'plugin'.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR.$template.'.html');
	}

	return $compiledtplfile;
}
/**
 * 读取缓存动态页面
 */
function cache_page_start() {
	$relate_url = isset($_SERVER['REQUEST_URI']) ? safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.safe_replace($_SERVER['QUERY_STRING']) : $path_info);
	define('CACHE_PAGE_ID', md5($relate_url));
	$contents = getcache(CACHE_PAGE_ID, 'page_tmp/'.substr(CACHE_PAGE_ID, 0, 2));
	if($contents && intval(substr($contents, 15, 10)) > SYS_TIME) {
		echo substr($contents, 29);
		exit;
	}
	if (!defined('HTML')) define('HTML',true);
	return true;
}
/**
 * 写入缓存动态页面
 */
function cache_page($ttl = 360, $isjs = 0) {
	if($ttl == 0 || !defined('CACHE_PAGE_ID')) return false;
	$contents = ob_get_contents();
	
	if($isjs) $contents = format_js($contents);
	$contents = "<!--expiretime:".(SYS_TIME + $ttl)."-->\n".$contents;
	setcache(CACHE_PAGE_ID, $contents, 'page_tmp/'.substr(CACHE_PAGE_ID, 0, 2));
}

/**
 * selfcat: 获取当前栏目信息用于在模板中任意一个地方取得任意一个分类的信息
 * lujinfa:2010-11-12
 * @param $module
 * @param $parentid
 * @param $type
 * 返回为：二维数组
 */
function selfcat($catid = 0, $type = NULL,$self = '0', $siteid = '') {
	if (empty($siteid)) $siteid = get_siteid();
	$category = getcache('category_content_'.$siteid,'commons');
	foreach($category as $id=>$cat) 
	{
		if($cat['siteid'] == $siteid && ($catid === NULL || $cat['catid'] == $catid) && ($type === NULL || $cat['type'] == $type)) $subcat[$id] = $cat;
		if($self == 1 && $cat['catid'] == $catid)  $subcat[$id] = $cat;
	}
	unset($category,$siteid);
	return $subcat;
}
/**
 * get_cat_parent_one
 * 得到当前分类的父类的信息
 * lujinfa
 * 2011-05-25
 * @param $catid
 */
function get_cat_parent_one($catid=0,$siteid=0)
{
	if(!$catid)
	{
		return false;
	}
	if ($siteid <= 0) $siteid = get_siteid();
	$category = getcache('category_content_'.$siteid,'commons');
	foreach($category as $id=>$cat) 
	{
		if($cat['catid']==$catid)
		{
			$parentcat = get_cat_one($cat['parentid'],$siteid);
			
			break;
		}
	}
	unset($category,$siteid,$catid);
	
	return $parentcat;
}


/**
 * get_cat_one:得到当前一个分的信息
 * lujinfa
 * 2011-05-25
 * 
 * @param $catid
 * 返回为一维数组
 */
function get_cat_one($catid=0,$siteid=0)
{
	if(!$catid)
	{
		return false;
	}
	if ($siteid <=0) $siteid = get_siteid();
	$category = getcache('category_content_'.$siteid,'commons');
	$get_cat=array();
	foreach($category as $id=>$cat) 
	{
		//if($cat['parentid']==$catid)
		if($cat['catid']==$catid)
		{
			$get_cat = $cat;
			break;
		}
	}
	unset($category,$siteid,$catid);
	return $get_cat;
}

/**
 * get_cat_sub:得到当前一个分类的子类
 * lujinfa
 * 2011-05-25
 * 
 * @param $catid
 * 返回为二维数组
 */
function get_cat_sub($catid=0,$siteid=0)
{
	if ($siteid <=0 ) $siteid = get_siteid();
	$category = getcache('category_content_'.$siteid,'commons');
	$get_cat=array();
	foreach($category as $id=>$cat) 
	{
		if($cat['parentid']==$catid)
		{
			$get_cat[$cat['catid']] = $cat;
			//break;
		}
	}
	unset($category,$siteid,$catid);
	return $get_cat;
}

/**
 * get_city_yle_ask_data:得到一级城市列表
 * wanguochao
 * 2011-05-25
 * 
 * 返回值为html代码
 */
function get_city_yle_ask_data($catid=11,$cid=0)
{
	$city = getcache('1','linkage');
	$city = $city[data];
	$city = array_slice($city,0,33);
    $site_id = get_siteid();
    $get_city = '';
	foreach($city as $key=>$value) 
	{
		$get_city = $get_city.'<a href="/ask/list-'.$cid.'-'.$value[linkageid].'-0-1.html" title="'.$value[name].'法律咨询" target="_blank" >'.$value[name].'</a> ';
	}
    unset($city,$site_id,$catid);
    return $get_city;
}


/**
 * get_city_top:得到一级城市列表
 * wanguochao
 * 2011-07-15
 * 
 * 返回值为html代码
 */
function get_city_top()
{
	$city = getcache('1','linkage');
	$city = $city[data];
	$city = array_slice($city,0,33);
    $get_city = '';
	foreach($city as $key=>$value) 
	{
		$get_city = $get_city.'<li style="padding-left:5px;padding-right:5px;float:left;width:65px;"><input class="checkbox2" type="checkbox" value="'.$value["linkageid"].'" name="chengshi[]"> '.$value[name].'</li>';
	}
    return $get_city;
}


/**
 * get_fenlei_d:得到等级分类列表
 * wanguochao
 * 2011-06-8
 * 
 * @param $get_fenlei
 * 返回值为html代码
 */
function get_fenlei_d($fenlei=3365){
	$fenlei = getcache($fenlei,'linkage');
	$fenlei = $fenlei[data];
	foreach($fenlei as $key=>$value) {
		if ($value['parentid']==0){
           $get_fenlei = $get_fenlei.'<li><a href="javascript:void(0)" onclick="scid('.$value[linkageid].');">'.$value[name].'</a></li>';
		}
	}
    unset($fenlei);
	return $get_fenlei;
}
/**
 * get_fenlei_search:头部查询下拉列表
 * wanguochao
 * 2011-06-24
 * 
 * @param $get_fenlei
 * 返回值为html代码
 */
function get_fenlei_search($fenlei=3365){
	$fenlei = getcache($fenlei,'linkage');
	$fenlei = $fenlei[data];
	$numb = 0;
	foreach($fenlei as $key=>$value) {
		if ($value['parentid']==0){
			if($numb!=1){
				$get_fenlei = $get_fenlei.
			      '<input type="hidden" name="s_cid" id="s_cid" value="'.$value[linkageid].'" /><div id="top_search"><div class="select"><span id="jq_serflip"  class="selected" onclick=selectMeau("#jq_serflip","#selList","#jq_serflip")>'.$value[name].'</span><div id="selList" class="list" style="display:none;" ><ul>';
			}
           $get_fenlei = $get_fenlei.'<li><a href="javascript:void(0)" onclick="scid('.$value[linkageid].');">'.$value[name].'</a></li>';
		   $numb = 1;
		}
	}
	$get_fenlei = $get_fenlei.'</ul><div><img src="'.APP_PATH.'statics/jiuwen_falv/images/lawyer/b_line.gif" alt="" /></div></div></div>';
    unset($fenlei,$numb);
	return $get_fenlei;
}

function get_fenlei_c($fenlei=3365,$param_name='list_professional'){
	$fenlei = getcache($fenlei,'linkage');
	$fenlei = $fenlei[data];
	$get_fenlei = $get_fenlei.'<select name="'.$param_name.'" id="list_professional" class="list" size="8"  style="display:none">';
	foreach($fenlei as $key=>$value) {
		if ($value['parentid']==0){
           $get_fenlei = $get_fenlei.'<option value='.$value[linkageid].'>'.$value[name].'</option>';
		}
	}
	$get_fenlei = $get_fenlei.'</select>';
    unset($fenlei);
	return $get_fenlei;
}

/**
 * get_fenlei_data:得到分类列表 专题页
 * wanguochao
 * 2011-05-25
 * 
 * @param $fenlei
 * 返回值为html代码
 */
function get_fenlei_data($fenlei=3365,$catid=11){
	$fenlei = getcache($fenlei,'linkage');
	$fenlei = $fenlei[data];
    $site_id = get_siteid();
	foreach($fenlei as $key=>$value) {
		if ($value['parentid']==0){
		    $get_fenlei = $get_fenlei.'<dl class="cate-dl">
              <dt><a href="/ask/list-'.$value[linkageid].'-0-0-1.html" title="'.$value['name'].'" target="_blank">'.$value['name'].'</a></dt><dd>';
                foreach($fenlei as $key1=>$value1){
				     if ($value1['parentid']==$value['linkageid']){
		             $get_fenlei = $get_fenlei.' <a href="/ask/list-'.$value1[linkageid].'-0-0-1.html" title="'.$value1[name].'法律咨询" target="_blank">'.$value1[name].'</a>';
					 }
				}
           $get_fenlei = $get_fenlei.'</dd></dl>';
		}
	}
    unset($fenlei,$site_id);
	return $get_fenlei;
}

/**
 * get_fenlei_data:得到分类列表 专题页
 * wanguochao
 * 2011-05-25
 * 
 * @param $fenlei
 * 返回值为html代码
 */
function get_fenlei_one_url($fenlei=3365,$catid=0){
    if(!$catid)
    {
        return false;
    }
    $fenlei = getcache($fenlei,'linkage');
    $fenlei = $fenlei['data'];
    $site_id = get_siteid();
    $return_url='';
    foreach($fenlei as $key=>$value) 
    {
        if ($value['linkageid']==$catid)
        {
           $return_url= '/ask/list-'.$value['linkageid'].'-0-0-1.html';
                    
        }
    }
    unset($fenlei,$site_id,$catid);
    return $return_url;
}

/**
 * get_fenlei_one:获取一个分类名称
 * wanguochao
 * 2011-07-14
 * 
 * @param $fenlei
 * 返回值为html代码
 */
function get_fenlei_one($fenlei=3365,$cid=0){
    if(!$cid)
    {
        return false;
    }
    $fenlei = getcache($fenlei,'linkage');
    $fenlei = $fenlei['data'][$cid]['name'];
    return $fenlei;
}


/**
 * get_city:得到分类列表 列表页
 * wanguochao
 * 2011-05-25
 * 
 * @param $fenlei
 * 返回值为html代码
 */
function get_fenlei_data_l($fenlei=3365,$catid=11){
	$fenlei = getcache($fenlei,'linkage');
	$fenlei = $fenlei[data];
    $site_id  =get_siteid();
	foreach($fenlei as $key=>$value) {
		             $get_fenlei = $get_fenlei.' <a href="/lvshi/lawyer-'.$value[linkageid].'-0-1.html" title="'.$value[name].'"  target="_blank">'.$value[name].'</a>';
	}
    unset($fenlei,$site_id);
	return $get_fenlei;
}


function get_fenlei_ask($fenlei=3365,$catid=11,$zone=0){
	$fenlei = getcache($fenlei,'linkage');
	$fenlei = $fenlei[data];
    $site_id  =get_siteid();
    $get_fenlei ='';
	foreach($fenlei as $key=>$value) {
		             $get_fenlei = $get_fenlei.' <a href="/ask/list-'.$value[linkageid].'-'.$zone.'-0-1.html" title="'.$value[name].'法律咨询"  target="_blank">'.$value[name].'</a>';
	}
    unset($fenlei,$site_id,$catid);
	return $get_fenlei;
}



function get_fenlei_lawyer($fenlei=3365,$catid=11){
	$fenlei = getcache($fenlei,'linkage');
	$fenlei = $fenlei[data];
    $site_id  =get_siteid();
    $get_fenlei ='';
	foreach($fenlei as $key=>$value) {
		             $get_fenlei = $get_fenlei.' <a href="/ask/list-'.$value[linkageid].'-0-0-1.html" title="'.$value[name].'"  target="_blank">'.$value[name].'</a>';
	}
    unset($fenlei,$site_id,$catid);
	return $get_fenlei;
}


/**
 * get_city_index_lawyer_data:得到一级城市列表:
 * 用于律师地区数据的显示
 * wanguochao
 * 2011-05-25
 *
 * 返回值为html代码
 */
function get_city_index_lawyer_data($catid=11,$maxi=10,$nui=33)
{
	$city = getcache('1','linkage');
	$city = $city[data];
	$city = array_slice($city,0,$nui);
    $get_city = '';
    $i=1;
    $max_i=$maxi;
    $site_id=get_siteid();
	foreach($city as $key=>$value)
	{
	    $city_name =  iconv("UTF-8","GB2312",$value['name']);
        if(strripos($city_name,iconv("UTF-8","GB2312",'省')))
        {
             	$value['tname'] =str_replace(iconv("UTF-8","GB2312",'省'),'',$city_name);
        }
	    elseif(strripos($city_name,iconv("UTF-8","GB2312",'市')))
        {
             $value['tname'] =str_replace(iconv("UTF-8","GB2312",'市'),'',$city_name);
        }
        else
        {
           $value['tname'] = $city_name;
        }
        $value['tname'] =    iconv("GB2312","UTF-8",	$value['tname']) ;
        $li='';
        $bli='';
        if($i==1)
        {
             $li='<li>';
        }
        if($i==$max_i || $key==(sizeof($city)-1))
        {
             $bli='</li>';
        }
        $get_city = $get_city.$li.'<a href="/lvshi/zg-lawyer-0-'.$value[linkageid].'-1.html" title="'.$value['name'].'" target="_blank" title="'.$value['tname'].'律师法律在线咨询">'.$value['tname'].'</a>'.$bli;
	    if($i<$max_i)
        {
           $i++;
        }
        else
        {
              $i=1;
        }
    }
    unset($city,$max_i,$i,$bli,$li);
    return $get_city;
}

/**
 * get_fenlei_lawyer_data:得到分类列表 专题页
 * 用于律师地区数据的显示
 * wanguochao
 * 2011-05-25
 *
 * @param $fenlei
 * 返回值为html代码
 */
function get_fenlei_lawyer_data($fenlei=3365,$catid=11){
	$fenlei = getcache($fenlei,'linkage');
	$fenlei = $fenlei[data];
    $get_fenlei = '';
    $site_id=get_siteid();
	foreach($fenlei as $key=>$value) {
		if ($value['parentid']==0){
		    $get_fenlei = $get_fenlei.'<dl class="cate-dl">
              <dt><a href="/lvshi/lawyer-'.$value[linkageid].'-0-1.html" title="九问律师网'.$value['name'].'法律在线咨询" target="_blank">'.$value['name'].'类相关问题</a></dt><dd>';
                foreach($fenlei as $key1=>$value1){
				     if ($value1['parentid']==$value['linkageid']){
		             $get_fenlei = $get_fenlei.'<a href="/lvshi/lawyer-'.$value1[linkageid].'-0-1.html" title="九问律师网'.$value1['name'].'法律在线咨询" target="_blank">'.$value1[name].'</a>';
					 }
				}
           $get_fenlei = $get_fenlei.'</dd></dl>';
		}
	}
    unset($fenlei,$catid);
	return $get_fenlei;
}

/**
 * @param int $areaid
 * @param int $num
 * @param string $tpl
 * @return void
 */
function get_auto_area_lawyer_data($areaid=0,$num=6,$tpl='',$where='1=1',$linkid='3365')
{
	    $connect_array = '';
	    $siteid = get_siteid();
	    
	    /**
         * ip库替换为纯真ip库
         * weihan
         * 2012.04.27
         */
        /* $cip=get_real_ip();
         $ipku_db = pc_base::load_model('ipku_model');
        $cdata =$ipku_db->select("start<=$cip order by start desc limit 1");
        $defaultvalue = $cdata['0']['cid']; */
        $real_city = get_real_city();
        $defaultvalue = $real_city['areaid'];
        //<-----------------------------------
        
        $good_cache = getcache($linkid,'linkage');

        $member_db = pc_base::load_model('member_model');
        //根据站点得到专家模型id
		$e_modelid = pc_base::get_model_key_site_list('e',$siteid);
		//--
        $member_db->set_model($e_modelid);
        $connect_array = "`areaids` like '%,".$defaultvalue.",%'";
        $get_member_list = $member_db->select($connect_array, 'rname,phone,userid,city,good,username',$num, 'userid');
        $member_list=array();
        if(is_array($get_member_list) && count($get_member_list)>0)
        {

            foreach($get_member_list as $k=>$val)
            {
               $_avatar=APP_PATH.'phpsso_server/uploadfile/avatar/1/1/';
               $_avatar .= $val['userid'].'/180x180.jpg';
               if(!url_exists($_avatar))
               {
                 $_avatar = APP_PATH.'phpsso_server/statics/images/member/nophoto.gif';
               }
              $val['avatar'] = $_avatar;
              $val['good'] = explode(",", $val['good']);
              $val['goods'] = $good_cache['data'][$val['good']['1']]['name'];

               $member_list[]= $val;

            }
        }
        unset($get_member_list);
        return $member_list;
}

function url_exists($url) 
{
	$head=@get_headers($url);
	if(is_array($head)) 
	{
		return true;
	}
	return false;

}
/**
 * get_city:得到一级城市列表
 * wanguochao
 * 2011-05-25
 *
 * 返回值为html代码
 */
function get_city_sub_list($areaid=1)
{
	$city = getcache(1,'linkage');
	$city = $city[data];
    $return_string='';
	//$i=0;
    //var
	//$city = array_slice($city,0,33);
	foreach($city as $key=>$value)
	{
		//$i++;
		//echo $i;
		//echo $areaid.'<br/>';
		echo $value['parentid'];
        if($value['parentid']==$areaid)
        {
             if($key!=(sizeof($city)-1))
             {
                 $return_string .= $value['linkageid'].',' ;
             }
            else
            {
                 $return_string .= $value['linkageid'] ;
            }
        }
	}
    unset($city);
    return $return_string;
}



/**
 * get_city:得到一级城市列表
 * wanguochao
 * 2011-08-19
 *
 * 返回值为html代码
 */
function get_city_sub_lista($areaid=1,$link=1)
{
	$city = getcache($link,'linkage');
	$city = $city[data];
    $return_string='';
	//$i=0;
    //var
	//$city = array_slice($city,0,33);
	if($city[$areaid]['zid']!=0){
    $citya = ','.$city[$areaid]['zid'].',';
	}
	if($city[$areaid]['parentid']&&$city[$areaid]['parentid']!=$city[$areaid]['zid']){
		$cityb = $city[$areaid]['parentid'].',';	
	}
	if($city[$areaid]['linkageid']!=$city[$areaid]['zid']){
	$cityc = $city[$areaid]['linkageid'].',';
	}
	//echo '<br/>'.$city[$areaid]['zid'].'-'.$city[$areaid]['parentid'].'-'.$city[$areaid]['linkageid'].'<br/>';
	$return_string = $citya.$cityb.$cityc;
    unset($city);
    return $return_string;
}

/**
 * get_fenlei_ku_lawyer:得到分类列表 律师库页
 * wanguochao
 * 2011-06-11
 * 
 * @param $get_fenlei
 * 返回值为html代码
 */
function get_fenlei_ku_lawyer($fenlei=3365,$catid=11){
	$fenlei = getcache($fenlei,'linkage');
	$fenlei = $fenlei[data];
    $site_id = get_siteid();
	foreach($fenlei as $key=>$value) {
		if ($value['parentid']==0){
		    $get_fenlei = $get_fenlei.'<dl class="cate-dl">
              <dt><a href="/lvshi/lawyer-'.$value[linkageid].'-0-1.html" title="'.$value['name'].'律师专家" target="_blank">'.$value['name'].'相关律师</a></dt><dd>';
                foreach($fenlei as $key1=>$value1){
				     if ($value1['parentid']==$value['linkageid']){
		             $get_fenlei = $get_fenlei.' <a href="/lvshi/lawyer-'.$value1[linkageid].'-0-1.html" title="'.$value1[name].'律师专家" target="_blank">'.$value1[name].'</a>';
					 }
				}
           $get_fenlei = $get_fenlei.'</dd></dl>';
		}
	}
    unset($fenlei,$site_id,$catid);
	return $get_fenlei;
}
/**
 * 生成人性化日期
 * Enter description here ...
 * @param unknown_type $timestamp
 */
function timeinterval($timestamp) {
    $format=array('秒钟前','分钟前','小时前');
    if(is_numeric($timestamp)){
         $i=SYS_TIME-$timestamp;
         switch($i){
            case 60>$i: $str=$i.$format[0];break;
            case 3600>$i: $str=round ($i/60).$format[1];break;
            case 86400>$i: $str=round ($i/3600).$format[2];break;
            case $i>86400: $str=date('m-d', $timestamp);break;
        }
     }
     unset($timestamp,$format,$i);
     return $str;
}

/**
 * 构造筛选URL
 */
function structure_filters_url($fieldname,$array=array(),$type = 1,$modelid) {
	if(empty($array)) {
		$array = $_GET;
	} else {
		$array = array_merge($_GET,$array);
	}
	//TODO
	$fields = getcache('model_field_'.$modelid,'model');
	ksort($fields);
	$urlpars='';
	foreach ($fields as $_v=>$_k) {
		if($_k['filtertype'] || $_k['rangetype']) {
			if ($urlpars=='') { $urlpars = '?'.$_v.'={$'.$_v.'}'; }
			else { $urlpars .= '&'.$_v.'={$'.$_v.'}'; }
		}
	}
	//后期增加伪静态等其他url规则管理，apache伪静态支持9个参数
	//$urlrule =APP_PATH.'/ask/category-area/{$catid}-{$city}/&page={$page}'.$urlpars ;

	//根据get传值构造URL
	if (is_array($array)) foreach ($array as $_k=>$_v) {
		if($_k=='page') $_v=1;
		if($type == 1) if($_k==$fieldname) continue;
		$_findme[] = '/{\$'.$_k.'}/';
		$_replaceme[] = $_v;
	}
     //type 模式的时候，构造排除该字段名称的正则
	if($type==1) $filter = '(?!'.$fieldname.'.)';
	$_findme[] = '/{\$'.$filter.'([a-z0-9_]+)}/';
	$_replaceme[] = '';
	$urlrule = preg_replace($_findme, $_replaceme, $urlrule);
    unset($fieldname,$array,$fields);
	return 	$urlrule;
}

/**
 * 构造筛选时候的sql语句
 */
function structure_filters_sql($modelid,$cityid='') {
	$sql = $fieldname = $min = $max = '';
	$fieldvalue = array();
	$modelid = intval($modelid);
	$model =  getcache('model','commons');
	$fields = getcache('model_field_'.$modelid,'model');
	$fields_key = array_keys($fields);
	//TODO

	$sql = '`status` = \'99\'';
	if(intval($cityid)!=0)  $sql .= ' AND `city`=\''.$cityid.'\'';
	foreach ($_GET as $k=>$r) {
		if(in_array($k,$fields_key) && intval($r)!=0 && ($fields[$k]['filtertype'] || $fields[$k]['rangetype'])) {
			if($fields[$k]['formtype'] == 'linkage') {
				$datas = getcache($fields[$k]['linkageid'],'linkage');
				$qasks = $datas['data'];
				if($qasks[$r]['arrchildid']) {
					$sql .=  ' AND `'.$k.'` in('.$qasks[$r]['arrchildid'].')';
				}
			} elseif($fields[$k]['rangetype']) {
				if(is_numeric($r)) {
					$sql .=" AND `$k` = '$r'";
				} else {
					$fieldvalue = explode('_',$r);
					$min = intval($fieldvalue[0]);
					$max = $fieldvalue[1] ? intval($fieldvalue[1]) : 999999;
					$sql .=" AND `$k` >= '$min' AND  `$k` < '$max'";
				}
			} else {
				$sql .=" AND `$k` = '$r'";
			}
		}
	}
	return $sql;
}

/**
 * 生成分类信息中的筛选菜单
 * @param $field   字段名称
 * @param $modelid  模型ID
 */
function filters($field,$modelid,$diyarr = array()) {
	$fields = getcache('model_field_'.$modelid,'model');
	$options = empty($diyarr) ?  explode("\n",$fields[$field]['options']) : $diyarr;
	$field_value = intval($_GET[$field]);
	foreach($options as $_k) {
		$v = explode("|",$_k);
		$k = trim($v[1]);
		$option[$k]['name'] = $v[0];
		$option[$k]['value'] = $k;
		$option[$k]['url'] = structure_filters_url($field,array($field=>$k),2,$modelid);
		$option[$k]['menu'] = $field_value == $k ? '<em>'.$v[0].'</em>' : '<a href='.$option[$k]['url'].'>'.$v[0].'</a>' ;
	}
	$all['name'] = '全部';
	$all['url'] = structure_filters_url($field,array($field=>''),2,$modelid);
	$all['menu'] = $field_value == '' ? '<em>'.$all['name'].'</em>' : '<a href='.$all['url'].'>'.$all['name'].'</a>';

	array_unshift($option,$all);
	return $option;
}

/**
 * 通过指定keyid形式显示所有联动菜单
 * @param  $keyid 菜单主id
 * @param  $linkageid  联动菜单id
 * @param  $toppatentid 父级菜单id
 * @param  $modelid 模型id
 * @param  $fieldname  字段名称
 * @param  $showall 是否显示全部
 */
function show_linkage($keyid, $linkageid = 0, $toppatentid = '', $modelid = '', $fieldname='zone' ,$showall = 1) {
	$datas = $qasks =array();
	$keyid = intval($keyid);
	$linkageid = intval($linkageid);
	$urlrule = structure_filters_url($fieldname,$array,1,$modelid);
	if($keyid == 0 || $linkageid == 0) return false;
	$datas = getcache($keyid,'linkage');
	$qasks = $datas['data'];
	$linkageid_tmp = $qasks[$linkageid]['child'] ? $linkageid : $qasks[$linkageid]['parentid'];
	if($linkageid_tmp == $toppatentid) $linkageid_tmp = $linkageid;
	if(is_array($qasks) && !empty($qasks)) {
		foreach ($qasks as $k => $v) {
			if($v['parentid'] != $linkageid_tmp) {
				unset($qasks[$k]);
				continue;
			}
			$url = preg_replace('/{\$'.$fieldname.'}/', $v['linkageid'], $urlrule);
			$url = str_replace(array('http://','//','~'), array('~','/','http://'), $url);
			$qasks[$k]['url'] = $url;
		}
	}
	if($toppatentid == $linkageid) $linkageid_tmp = '';
	if($showall && !empty($qasks)) array_unshift($qasks,array('name'=>'全部','url'=>preg_replace('/{\$'.$fieldname.'}/', $linkageid_tmp, $urlrule),'linkageid'=>$linkageid_tmp));
	return $qasks;
}
/**
 * 获取联动菜单层级
 * @param  $keyid     联动菜单分类id
 * @param  $linkageid 菜单id
 * @param  $leveltype 获取类型 parentid 获取父级id child 获取时候有子栏目 arrchildid 获取子栏目数组
 */
function get_linkage_level($keyid,$linkageid,$leveltype = 'parentid') {
	$child_arr = $childs = array();
	$leveltypes = array('parentid','child','arrchildid','arrchildqask');
	$datas = getcache($keyid,'linkage');
	$qasks = $datas['data'];
	if (in_array($leveltype, $leveltypes)) {
		if($leveltype == 'arrchildqask') {
			$child_arr = explode(',',$qasks[$linkageid]['arrchildid']);
			foreach ($child_arr as $r) {
				$childs[] = $qasks[$r];
			}
			return $childs;
		} else {
			return $qasks[$linkageid][$leveltype];
		}
	}
}


/**
 * 根据box类型字段获取显示名称
 * @param $field 字段名称
 * @param $value 字段值
 * @param $modelid 字段所在模型id
 */
function box($field, $value, $modelid='') {
	$fields = getcache('model_field_'.$modelid,'model');
	extract(string2array($fields[$field]['setting']));
	$options = explode("\n",$fields[$field]['options']);
	foreach($options as $_k) {
		$v = explode("|",$_k);
		$k = trim($v[1]);
		$option[$k] = $v[0];
	}
	$string = '';
	switch($fields[$field]['boxtype']) {
			case 'radio':
				$string = $option[$value];
			break;

			case 'checkbox':
				$value_arr = explode(',',$value);
				foreach($value_arr as $_v) {
					if($_v) $string .= $option[$_v].' 、';
				}
			break;

			case 'select':
				$string = $option[$value];
			break;

			case 'multiple':
				$value_arr = explode(',',$value);
				foreach($value_arr as $_v) {
					if($_v) $string .= $option[$_v].' 、';
				}
			break;
		}
			return $string;
}

/**
 * 获取信息配置缓存参数
 * @param $key 信息模型参数参数
 * @param $filename 字段值 缓存文件名称，默认为qask_setting
 */
function getqaskcache($key, $filename = 'qask_setting') {
	$qasks = getcache($filename,'commons');
	if(is_array($qasks) && !empty($qasks) && array_key_exists($key, $qasks)) {
		if($key == 'qask_modelid') {
			$model =  getcache('model','commons');
			$modelids = explode(',', $qasks[$key]);
			if(is_array($modelids)) {
				foreach($modelids as $m) {
					$models[$m] = $model[$m];
				}
			}
			return $models;
		}
		return  $qasks[$key];
	}
}

/**
 * 获取信息配置城市信息
 * @param $key 城市编号，通常为城市拼音名称
 * @param $qask 获取数据类型
 * @param $showall 是否显示所有
 */
function getcity($key ='', $qask = '', $filename = 'qask_citys', $showall = '0') {
	$citys = $current_city = array();
	$citys = getcache($filename,'commons');
	$key = strtolower(trim($key));
	if(is_array($citys) && !empty($citys) && !$showall && $qask) {
		if(array_key_exists($key, $citys)) {
		    return  $citys[$key][$qask];
		} else {
			$current_city = current($citys);
			return $current_city[$qask];
		}

	} else {
		return $citys;
	}
}

function getlocalqask($ip) {
	pc_base::load_sys_func('iconv');
	$ip_area = pc_base::load_sys_class('ip_area');
	$qask['name'] = $ip_area->getcity($ip);
	$name = CHARSET == 'gbk' ? $qask['name'] : iconv('utf-8','gbk',$qask['name']);
	$letters = gbk_to_pinyin($name);
	$qask['pinyin'] =strtolower(implode('', $letters));
	return $qask;
}



/**
	 *  多级联动并多选组件
	 *  lujinfa 2011-06-03
	 *  linkboxs
	 *             ,' id="cate_input_1" size="2" style="height:80px;width:160px;"'
	 **/
function menu_linkboxs($linkboxsid = 1,$name = 'catid',$cates=',', $setting,$title = '', $catid = 0, $extend = ' id="cate_input_1" size="2" style="height:80px;width:160px;"', $deep = 0) {

	global $cat_id;
	if($cat_id) {
		$cat_id++;
	} else {
		$cat_id = 1;
	}
    $input_cates= $cates;
    if(!is_array($cates) && $cates!='')
    {
        $cates = explode(',',$cates);
        foreach( $cates as $k=>$v)
        {
            if( !$v )
            {
                 unset( $cates[$k] );
            }
        }
    }
    if($cates=='')
    {
        $input_cates=',';
    }
	$catid = intval($catid);
	$deep = intval($deep);
    $linkboxsid = intval($linkboxsid);
	$datas = array();
	$datas = getcache($linkboxsid,'linkage');
    $_domain=str_replace('http://www.','',APP_PATH);
    $_domain=str_replace('/','',$_domain);
	$select = '
<script type="text/javascript">
//document.domain = "'.$_domain.'";
var DTPath = "'.APP_PATH.'";
var SKPath = "'.CSS_PATH.'";
var CKPrex = "9ask_";
</script>
<div id="catesch"></div>
              <div id="cate_'.$name.'">';
	$select .= '<input name="'.$name.'" id="catid_'.$name.'" type="hidden" value="'.$catid.'"/>';
	$select .= '<span id="load_category_'.$name.'">'.get_category_select($title, $catid, $linkboxsid, $extend, $deep, $name).'</span>
	';
	$select .= '<script type="text/javascript">
	';
	if($cat_id == 1) $select .= 'var category_moduleid = new Array;
	';
	$select .= 'category_moduleid['."'".$name."'".']="'.$linkboxsid.'";
	';
	if($cat_id == 1) $select .= 'var category_title = new Array;
	';
	$select .= 'category_title['."'".$name."'".']=\''.$title.'\';';
	if($cat_id == 1) $select .= 'var category_extend = new Array;
	';
	$select .= 'category_extend['."'".$name."'".']=\''.$extend.'\';';
	if($cat_id == 1) $select .= 'var category_catid = new Array;
	';
	$select .= 'category_catid['."'".$name."'".']=\''.$catid.'\';';
	if($cat_id == 1) $select .= 'var category_deep = new Array;
	';
	$select .= 'category_deep['."'".$name."'".']=\''.$deep.'\';
	';
	$select .= '</script>';
	if($cat_id == 1) $select .= '<script type="text/javascript" src="'.JS_PATH.'linkboxs/category.js"></script>';
    
    if($setting['most']<=0)
    {
        $setting['most'] = 1;
    }
    $cate_max=$setting['most'];
    $select .='</div>
              <input type="button" value=" 添加↓ " class="btn" onclick="addcate('.$cate_max.','."'".$name."'".')"/>
              <input type="button" value=" ×删除 " class="btn" onclick="delcate('."'".$name."'".');"/>
              &nbsp;最多可添加 <strong class="f_red">'.$cate_max.'</strong> 个'.$datas['title'].' <br/>
              <select name="cates_'.$name.'" id="cates_'.$name.'" size="2" style="height:100px;width:380px;margin-top:5px;"> ';

               if(is_array($cates))
               {
                   foreach($cates as $c =>$cval)
                    {
                        foreach($datas['data'] AS $list_key=>$list_var)
                        {
                            if($list_var['linkageid']==$cval)
                            {
                                $fullname = public_get_linkboxs_fullname($cval, $datas);
                                 $fullname = substr($fullname, 0, -1);
                                $select .='<option value="'.$cval.'">'.$fullname.'</option>';
                            }
                        }
                    }
               }
               $select .='</select>
              <input type="hidden" name="info['.$name.']" value="'.$input_cates.'" id="'.$name.'"/>';
              //<input type="hidden" name="most_'.$name.'" value="'.$cate_max.'" id="most_'.$name.'"/>';
    unset($linkboxsid,$name,$datas);
	return $select;
}

function get_category_select($title = '', $catid = 0, $linkboxsid = 1, $extend = '', $deep = 0, $name)
{
    global $CATEGORY, $DCAT;
	$CATBAK = $CATEGORY ? $CATEGORY : array();

    $linkboxsid = intval($linkboxsid);
	$datas = array();
	$datas = getcache($linkboxsid,'linkage');
	$CATEGORY = $datas['data'];


	$parents = array();
	$cid = $catid;
    //echo "<br>$catid:". $CATEGORY[$catid]['child']."--".var_dump($CATEGORY[$catid]);
	if($catid && $CATEGORY[$catid]['child'])
    {
        $parents[] = $catid;
    }
    //$parents[] = $catid;
	while($catid) {
		if($CATEGORY[$cid]['parentid']) {
			$parents[] = $cid = $CATEGORY[$cid]['parentid'];
		} else {
			break;
		}
	}

	$parents[] = 0;
	$parents = array_reverse($parents);
	$select = '';

	foreach($parents as $k=>$v) {
		if($deep && $deep <= $k) break;

		$select .= '<select onchange="load_category(this.value, '."'".$name."'".');" '.$extend.'>';
		if($title) $select .= '<option value="0">'.$title.'</option>';
		foreach($CATEGORY as $c) {
			if($c['parentid'] == $v) {
				$selectid = isset($parents[$k+1]) ? $parents[$k+1] : $catid;
				$selected = $c['linkageid'] == $selectid ? ' selected' : '';
				$select .= '<option value="'.$c['linkageid'].'"'.$selected.'>'.$c['name'].'</option>';
			}
		}
		$select .= '</select> ';
	}
	$CATEGORY = $CATBAK;
    unset($datas,$parents,$CATEGORY,$CATBAK);
	return $select;
}



/**
 *  多级联动并多选组件
 *  lujinfa 2011-06-03
 *  linkboxs
 *
 * 联动菜单层级
 */

function menu_linkboxs_one_level($linkboxsid,$keyid,$infos,$result=array()) {
	if(array_key_exists($linkboxsid,$infos)) {
		$result[]=$infos[$linkboxsid]['name'];
		return menu_linkboxs_level($infos[$linkboxsid]['parentid'],$keyid,$infos,$result);
	}
	krsort($result);
	return implode(' > ',$result);
}

/**
 *  多级联动并多选组件
 *  lujinfa 2011-06-03
 *  linkboxs
 *
 * 通过catid获取显示菜单完整结构
 * @param  $menuid 菜单ID
 * @param  $cache_file 菜单缓存文件名称
 * @param  $cache_path 缓存文件目录
 * @param  $key 取得缓存值的键值名称
 * @param  $parentkey 父级的ID
 * @param  $linkstring 链接字符
 */
function menu_linkboxs_level($menuid, $cache_file, $cache_path = 'commons', $key = 'catname', $parentkey = 'parentid', $linkstring = ' > ', $result=array()) {
	$menu_arr = getcache($cache_file, $cache_path);
	if (array_key_exists($menuid, $menu_arr)) {
		$result[] = $menu_arr[$menuid][$key];
		return menu_one_level($menu_arr[$menuid][$parentkey], $cache_file, $cache_path, $key, $parentkey, $linkstring, $result);
	}
	krsort($result);
	return implode($linkstring, $result);
}
/**
 *  多级联动并多选组件
 *  lujinfa 2011-06-03
 *  linkboxs
 *
 * 联动菜单层级

 * 通过id获取显示联动菜单
 * @param  $linkboxsid 联动菜单ID
 * @param  $keyid 菜单keyid
 * @param  $space 菜单间隔符
 * @param  $tyoe 1 返回间隔符链接，完整路径名称 3 返回完整路径数组，2返回当前联动菜单名称，4 直接返回ID
 * @param  $result 递归使用字段1
 * @param  $infos 递归使用字段2
 */
function get_linkboxs($linkboxsid, $keyid, $space = '>', $type = 1, $result = array(), $infos = array()) {
	if($space=='' || !isset($space))$space = '>';
	if(!$infos) {
		$datas = getcache($keyid,'linkboxs');
		$infos = $datas['data'];
	}
    $return_str ='';
	if($type == 1 || $type == 3 || $type == 4) {

		   $return_str .=   '' ;

    if(!is_array($cates) && $cates!='')
    {
        $cates = explode(',',$cates);
        foreach( $cates as $k=>$v)
        {
            if( !$v )
            {
                 unset( $cates[$k] );
            }
        }
    }

	}
    else
    {
		return $infos[$linkboxsid]['name'];
	}
}

/*
 * 9ask lujinfa 2011-06-07
 * 得到联动多选菜单名字包括父级
 * 通过linkageid获取名字路径
 */
 function public_get_linkboxs_fullname($linkageid,  $linkagelist) {
    $fullname = '';
    if($linkagelist['data'][$linkageid]['parentid'] != 0) {
        $fullname = public_get_linkboxs_fullname($linkagelist['data'][$linkageid]['parentid'], $linkagelist);
    }
    //所在地区名称
    $return = $fullname.$linkagelist['data'][$linkageid]['name'].'/';
     unset($linkageid,$fullname,$linkagelist);
    return $return;
}

 /**
  * 9ask lujinfa 2011-06-07
  * 得到 联动多选菜单的id包括父级的控制器
 * 通过linkageid获取名字路径
 */
 function public_get_linkboxs_fullid_c($cates=1,  $linkagelist=array()) {
     $return = ',';
     echo "<br>():".$cates;
     if(!is_array($cates) && $cates!='')
    {
        $cates = explode(',',$cates);
        foreach( $cates as $k=>$v)
        {
            if( !$v )
            {
                 unset( $cates[$k] );
            }
            else{
            	// 过滤返回值','，周泉，2011-6-17
                if (public_get_linkboxs_fullid($v,$linkagelist)!=',') {
					$return .= public_get_linkboxs_fullid($v,$linkagelist);
				}
                
            }
        }
    }
    else
    {
        $cates = intval($cates) ;
        $return .= public_get_linkboxs_fullid($cates,$linkagelist);
    }
     unset($cates,$linkagelist);
    return $return;
}
 /*
  * 9ask lujinfa 2011-06-07
  * 得到 联动多选菜单的id包括父级
 * 通过linkageid获取名字路径
 */
 function public_get_linkboxs_fullid($linkageid,  $linkagelist) {
    $fullname = '';
     echo "<Br>****:".$linkageid;
    if($linkagelist['data'][$linkageid]['parentid'] != 0) {
        $fullname = public_get_linkboxs_fullid($linkagelist['data'][$linkageid]['parentid'], $linkagelist);
    }
    //所在地区名称
    $return = $fullname.$linkagelist['data'][$linkageid]['linkageid'].',';
    unset($linkageid,$fullname,$linkagelist);
    return $return;
}

/**
 * @function:userurl  实现对用户个人网站url自动生成的函数
 * @param  $username
 * @param string $qstring
 * @param string $domain
 * @param int $site_id
 * @return mixed|string
 */
function userurl($username, $qstring = '', $domain = '',$site_id=0) {
    $URL = '';
    if($site_id<=0)
    {
      $site_id=get_siteid();
    }

    $data = getcache('sitelist', 'commons');
    if($domain=='')
    {
        if(is_array($data) && count($data)>0)
        {
            foreach($data AS $k=>$val)
            {
                if($val['siteid']==$site_id)
                {
                    $domain =  $val['domain'];
                    continue;
                }
            }
        }
    }
    unset($data);
	if($username)
    {
		if($domain) {
			$URL = $domain ? $domain.'' : APP_PATH;
			if($qstring) {
				parse_str($qstring, $q);
				if($q)
                {
                    $URL .= 'index.php?';
                    if(!isset($q['m'])) {
                       $q['m']='member';
                    }
                    if(!isset($q['c'])) {
                       $q['c']='homepage';
                    }
                    if(!isset($q['a'])) {
                       $q['a']='index';
                    }
                    if(!isset($q['username'])) {
                       $q['username']=$username;
                    }
                    if(!isset($q['siteid'])) {
                       $q['siteid']=$site_id;
                    }
                    $i = 0;
                    foreach($q as $k=>$v) {
                        $v = urlencode($v);
                        $URL .= ($i++ == 0 ? '' : '&').$k.'='.$v;
                    }

				}
                else{
                    $URL .='home/'.$username;
                }
			}
            else
            {
               $URL .='home/'.$username;
            }
		}
        else
        {
			$URL = APP_PATH.'index.php?m=member&c=homepage{a}&username='.$username.'&siteid='.$site_id;
			if($qstring)
            {
                parse_str($qstring, $q);
                if(!isset($q['a']))
                {
                    $URL =str_replace('{a}','&a=index',$URL);
                    $URL = $URL.'&'.$qstring;
                }
                else
                {
                     $i = 0;
                    foreach($q as $k=>$v)
                    {
                        $v = urlencode($v);
                       if($k!='a')
                       {
                            $URL .= ($i++ == 0 ? '' : '&').$k.'='.$v;
                       }
                       else{
                            $_a = ($i++ == 0 ? '' : '&').$k.'='.$v;
                            $URL =str_replace('{a}',$_a,$URL);
                            unset($_a);
                       }

                    }
                }
            }
		}
	}
    else{

    }
	return $URL;
}

/**
  * 9ask lujinfa 2011-06-07
  * 得到 联动多选菜单的id包括父级的控制器
 * 通过linkageid获取名字路径
 */
/**
 * @param int $cates
 * @param array $linkagelist
 * @param  $linkageid
 * @param  $type
 * @return string
 */
 function public_get_linkboxs_fullname_c($cates=1,  $linkagelist=array(),$linkboxsid='3365',$type='a') {
     $return = '';
     if(!is_array($linkagelist) || count($linkagelist)<=0)
     {
         //echo "<br>--->";
         $linkboxsid = intval($linkboxsid);
        $linkagelist = getcache($linkboxsid,'linkage');
         unset($datas);
     }
     if(!is_array($cates) && $cates!='')
    {
        $cates = explode(',',$cates);
        foreach( $cates as $k=>$v)
        {
            if( !$v )
            {
                 unset( $cates[$k] );
            }
            else{
                //echo "<br>v:".$v;
                //echo "<br>linkagelist:".$linkagelist;
                $return .= get_linkage_name($v,$linkagelist,$type);
            }
        }
    }
    else
    {
        $cates = intval($cates) ;
        $return .= get_linkage_name($cates,$linkagelist,$type);
    }
    unset($linkagelist,$type,$linkageid,$site_id,$cates,$linkboxsid);
    return $return;
}
/*
 * 9ask
 * lujinfa
 * 2011-06-07
 * 通过linkageid获取单个分类名字路径
 */
function get_linkage_name($linkageid,  $linkagelist,$type) {
    $site_id  =get_siteid();
    //所在地区名称
    $return = $linkagelist['data'][$linkageid]['name'];
    if($return!='')
    {
        if($type=='a')
        {
            $return = '<a href="'.get_site_url($site_id).'lvshi/lawyer-'.$linkageid.'-0-1.html" title="'.$return.'"  target="_blank">'.$return.'</a>';
        }
        elseif($type=='z')
        {
            $return = '<a href="'.get_site_url($site_id).'lvshi/lawyer-'.$linkageid.'-0-1.html" title="'.$return.'"  target="_blank">['.$return.']</a>';

        }
        elseif($type=='n')
        {
          $return = $return;
        }
        elseif($type=='s')
        {
          $return = $return.',';
        }
        elseif($type=='>')
        {
          $return = $return.'>';
        }
        else
        {
            $return = $return.'>';
        }
    }
    unset($linkagelist,$type,$linkageid,$site_id);
    return $return;
}

/**
 * 提到一个站眯的url
 * @param int $siteid
 * @return string
 */
function get_site_url($siteid=0) {

    if(!$siteid)
    {
        $siteid  =get_siteid();
    }
    $data = getcache('sitelist', 'commons');
    $domain = '';
    foreach ($data as $v)
    {
        if ($v['siteid'] == $siteid)
        {
            $domain = $v['domain'];
            continue;
        }
    }
    return $domain;
}

/**
 * 提到一个站眯的url
 * @param int $siteid
 * @return string
 */
function get_site_name($siteid=0) {

    if(!$siteid)
    {
        $siteid  =get_siteid();
    }
    $data = getcache('sitelist', 'commons');
    $domain = '';
    foreach ($data as $v)
    {
        if ($v['siteid'] == $siteid)
        {
            $domain = $v['name'];
            continue;
        }
    }
    unset($data);
    return $domain;
}
/**
 * 提到一个站眯的url
 * @param int $siteid
 * @return string
 */
function get_site_info($siteid=0) {

    if(!$siteid)
    {
        $siteid  =get_siteid();
    }
    $data = getcache('sitelist', 'commons');
    $siteinfo= '';
    foreach ($data as $v)
    {
        if ($v['siteid'] == $siteid)
        {
            $siteinfo = $v;
            continue;
        }
    }
    unset($data,$siteid);
    return $siteinfo;
}

/**
 * 关键数据防注入方法
 * @param  $str
 * @return mixed
 */
function dowith_sql($str)
{
   $str = str_replace("and","",$str);
   $str = str_replace("execute","",$str);
   $str = str_replace("update","",$str);
   $str = str_replace("count","",$str);
   $str = str_replace("chr","",$str);
   $str = str_replace("mid","",$str);
   $str = str_replace("master","",$str);
   $str = str_replace("truncate","",$str);
   $str = str_replace("char","",$str);
   $str = str_replace("declare","",$str);
   $str = str_replace("select","",$str);
   $str = str_replace("create","",$str);
   $str = str_replace("delete","",$str);
   $str = str_replace("insert","",$str);
   $str = str_replace("'","",$str);
   $str = str_replace('"',"",$str);
   $str = str_replace(" ","",$str);
   $str = str_replace("or","",$str);
   $str = str_replace("=","",$str);
   $str = str_replace("%20","",$str);
   return $str;
}

/**
 * 地区普通样式多级联动（地区使用）
 * @param string $title
 * @param int $areaid
 * @param string $extend
 * @param int $deep
 * @param int $id
 * @return string
 */
function get_area_select($title = '', $areaid = 0, $extend = '', $deep = 0, $id = 1) {

    global $AREA;
    $linkagelist = getcache(1,'linkage');
    $AREA =  $linkagelist['data'];
    unset($linkagelist);
	$parents = array();
	$aid = $areaid;
	if($areaid && $AREA[$areaid]['child']){
       $parents[] = $areaid;
    }
	while($areaid) {
		if($AREA[$aid]['parentid']) {
			$parents[] = $aid = $AREA[$aid]['parentid'];
		} else {
			break;
		}
	}
	$parents[] = 0;
	$parents = array_reverse($parents);
	$select = '';
	foreach($parents as $k=>$v) {
		if($deep && $deep <= $k) break;
		$select .= '<select onchange="load_area(this.value, '.$id.');" '.$extend.'>';
		if($title) $select .= '<option value="0">'.$title.'</option>';
		foreach($AREA as $a) {
			if($a['parentid'] == $v) {
				$selectid = isset($parents[$k+1]) ? $parents[$k+1] : $areaid;
				$selected = $a['linkageid'] == $selectid ? ' selected' : '';
				$select .= '<option value="'.$a['linkageid'].'"'.$selected.'>'.$a['name'].'</option>';
			}
		}
		$select .= '</select> ';
	}
    unset($linkagelist,$AREA,$areaid,$linkid,$title,$extend,$deep,$id);
	return $select;
}
/**
 * 地区普通样式多级联动（地区使用）
 * @param string $name
 * @param string $title
 * @param int $areaid
 * @param string $extend
 * @param int $deep
 * @return string
 */
function ajax_area_select($name = 'areaid', $title = '', $areaid = 0, $extend = '', $deep = 0) {
	global $area_id;
	if($area_id)
    {
		$area_id++;
	} else {
		$area_id = 1;
	}
	$areaid = intval($areaid);
	$deep = intval($deep);
	$select = '';
	$select .= '<input name="'.$name.'" id="areaid_'.$area_id.'" type="hidden" value="'.$areaid.'"/>';
	$select .= '<span id="load_area_'.$area_id.'">'.get_area_select($title, $areaid, $extend, $deep, $area_id).'</span>';
	$select .= '<script type="text/javascript">';
	if($area_id == 1) $select .= 'var area_title = new Array;';
	$select .= 'area_title['.$area_id.']=\''.$title.'\';';
	if($area_id == 1) $select .= 'var area_extend = new Array;';
	$select .= 'area_extend['.$area_id.']=\''.$extend.'\';';
	if($area_id == 1) $select .= 'var area_areaid = new Array;';
	$select .= 'area_areaid['.$area_id.']=\''.$areaid.'\';';
	if($area_id == 1) $select .= 'var area_deep = new Array;';
	$select .= 'area_deep['.$area_id.']=\''.$deep.'\';';
	$select .= '</script>';
	if($area_id == 1) $select .= '<script type="text/javascript" src="'.JS_PATH.'area/area.js"></script>';
    unset($areaid,$linkid,$title,$extend,$deep);
	return $select;
}

/**
 * 地区普通样式多级联动（地区使用）
 * @param string $title
 * @param int $specialtyid
 * @param string $extend
 * @param int $deep
 * @param int $id
 * @return string
 */

function get_specialty_select($linkid=3365,$title = '', $specialtyid = 0, $extend = '', $deep = 0, $id = 1) {

    global $specialty;
    $linkagelist = getcache($linkid,'linkage');
    $specialty =  $linkagelist['data'];
    unset($linkagelist);
	$parents = array();
	$aid = $specialtyid;
	if($specialtyid && $specialty[$specialtyid]['child']){
       $parents[] = $specialtyid;
    }
	while($specialtyid) {
		if($specialty[$aid]['parentid']) {
			$parents[] = $aid = $specialty[$aid]['parentid'];
		} else {
			break;
		}
	}
	$parents[] = 0;
	$parents = array_reverse($parents);
	$select = '';
	foreach($parents as $k=>$v) {
		if($deep && $deep <= $k) break;
		$select .= '<select size="7" height="18" style="width:150px;" onchange="load_specialty(this.value, '.$id.');" '.$extend.'>';
		if($title) $select .= '<option value="0">'.$title.'</option>';
		foreach($specialty as $a) {
			if($a['parentid'] == $v) {
				$selectid = isset($parents[$k+1]) ? $parents[$k+1] : $specialtyid;
				$selected = $a['linkageid'] == $selectid ? ' selected' : '';
				$select .= '<option value="'.$a['linkageid'].'"'.$selected.'>'.$a['name'].'</option>';
			}
		}
		$select .= '</select> ';
	}
    unset($linkagelist,$parents,$linkid,$title,$specialtyid,$extend,$deep);
	return $select;
}
/**
 * 地区普通样式多级联动（地区使用）
 * @param string $name
 * @param string $title
 * @param int $specialtyid
 * @param string $extend
 * @param int $deep
 * @return string
 */
function ajax_specialty_select($linkid=3365,$name = 'specialtyid', $title = '', $specialtyid = 0, $extend = '', $deep = 0) {
	global $specialty_id;
	if($specialty_id)
    {
		$specialty_id++;
	} else {
		$specialty_id = 1;
	}
	$specialtyid = intval($specialtyid);
	$deep = intval($deep);
	$select = '';
	$select .= '<input name="'.$name.'" id="specialtyid_'.$specialty_id.'" type="hidden" value="'.$specialtyid.'"/>';
	$select .= '<span id="load_specialty_'.$specialty_id.'">'.get_specialty_select($linkid,$title, $specialtyid, $extend, $deep, $specialty_id).'</span>';
	$select .= '<script type="text/javascript">';
    if($specialty_id == 1) $select .= 'var linkid ='.$linkid.';';
	if($specialty_id == 1) $select .= 'var specialty_title = new Array;';
	$select .= 'specialty_title['.$specialty_id.']=\''.$title.'\';';
	if($specialty_id == 1) $select .= 'var specialty_extend = new Array;';
	$select .= 'specialty_extend['.$specialty_id.']=\''.$extend.'\';';
	if($specialty_id == 1) $select .= 'var specialty_specialtyid = new Array;';
	$select .= 'specialty_specialtyid['.$specialty_id.']=\''.$specialtyid.'\';';
	if($specialty_id == 1) $select .= 'var specialty_deep = new Array;';
	$select .= 'specialty_deep['.$specialty_id.']=\''.$deep.'\';';

	$select .= '</script>';
	if($specialty_id == 1) $select .= '<script type="text/javascript" src="'.JS_PATH.'specialty/specialty.js"></script>';

    unset($linkid,$name,$title,$specialtyid,$extend,$deep);
	return $select;
}

/**
 * 判断是否是专家用户
 */

function bn_member($modelid=10){
    $bn_member = '18,26,28,30,32,34,36,38,40';
    $bn_member = explode(",",$bn_member);
    foreach($bn_member as $r) {
		if($r == $modelid){
			$pnasd = 1;
		}
     }
    unset($bn_member);
    return $pnasd;
}
/**
 * 头部站点导航
 */

function get_sallsite(){
	$pnasd = '';
    $sallsite = getcache('sitelist','commons');  
    foreach($sallsite as $r) {
		if(!empty($r['siteid'])&&$r['siteid']!=1) {
			$name = str_replace('九问','',$r['name']);
			$name = str_replace('网','',$name);
			$pnasd = $pnasd.'<li><a href="'.$r['domain'].'">'.$name.'</a></li>';
		}
     }
    unset($sallsite,$siteid);
    return $pnasd;
}


function get_allsite(){
	$pnasd = '';
    $sallsite = getcache('sitelist','commons');  
    foreach($sallsite as $r) {
		if(!empty($r['siteid'])&&$r['siteid']!=1) {
			$domain = $r['domain'];
			$name = str_replace('九问','',$r['name']);
			$name = str_replace('网','',$name);
			$pnasd = $pnasd.'<li><a href="javascript:void(0)" onclick=sdomain("'.$domain.'");>'.$name.'</a></li>';
		}
     }
     unset($sallsite,$siteid);
    return $pnasd;
}
/**
 * 当前站点名称
 */
function get_allsite_one($siteid){
	$pnasd = '';
    $sallsite = getcache('sitelist','commons');  
    foreach($sallsite as $r) {
		if($r['siteid'] == $siteid) {
			$name = str_replace('九问','',$r['name']);
			$name = str_replace('网','',$name);
		}
     }
    unset($sallsite,$siteid,$pnasd);
    return $name;
}
function tdate($time, $type = 3, $friendly=1) {
    global $setting;
    $format[] = $type & 2 ? (!empty($setting['date_format']) ? $setting['date_format'] : 'Y-n-j') : '';
    //$format[] = $type & 1 ? (!empty($setting['time_format']) ? $setting['time_format'] : 'H:i') : '';
    $timeoffset = $setting['time_offset'] * 3600 + $setting['time_diff'] * 60;
    $timestring = gmdate(implode(' ', $format), $time + $timeoffset);
    if ($friendly) {
        $time = time() - $time;
        if ($time <= 24 * 3600) {
            if ($time > 3600) {
                $timestring = intval($time / 3600) . '小时前';
            } elseif ($time > 60) {
                $timestring = intval($time / 60) . '分钟前';
            } elseif ($time > 0) {
                $timestring = $time . '秒前';
            } else {
                $timestring = '现在前';
            }
        }
    }
    unset($time,$type,$friendly);
    return $timestring;
}
/*
*获取单个地区
*/
function getone_city($zone)
{
	$city = getcache('1','linkage');
	$city = $city['data'][$zone]['name'];
    return $city;
}

//整理分享
function mkshare($share) {
	$share['body_data'] = unserialize($share['body_data']);

	//body
	$searchs = $replaces = array();
	if($share['body_data']) {
		foreach (array_keys($share['body_data']) as $key) {
			$searchs[] = '{'.$key.'}';
			$replaces[] = $share['body_data'][$key];
		}
	}
	$share['body_template'] = str_replace($searchs, $replaces, $share['body_template']);
	preg_match_all('/href="(.*?)"/', $share['body_template'], $match);
	$share['url'] = $match[1][0];
	return $share;
}


/**
 * added by weihan
 * 2012.02.17
 */



function menu_linkpc($linkpcid = 0, $id = 'linkpc', $defaultvalue = 0, $setting='') {
	//获取域名
	$_domain=str_replace('http://www.','',APP_PATH);
	$_domain=str_replace('/','',$_domain);
	
	$string = "<script type=\"text/javascript\">
					        //document.domain = \"{$_domain}\";
							var DTPath = '".APP_PATH."';
							var SKPath = '".CSS_PATH."';
							var CKPrex = \"9ask_\";
							var Try = {
								these: function() {
									var returnValue;
									for (var i = 0; i < arguments.length; i++) {var lambda = arguments[i]; try {returnValue = lambda(); break;} catch (e) {}}
									return returnValue;
								}
							}
					</script>
			        ".ajax_area_select("info[{$id}]", '请选择',$defaultvalue, '', 2)."			        
			        <script type=\"text/javascript\">
						load_area({$defaultvalue}, 1);
					</script>
			        ";
	
	return $string;
}

/**
 * 联动菜单层级
 */

function menu_linkpc_level($linkpcid,$keyid,$infos,$result=array()) {
	if(array_key_exists($linkpcid,$infos)) {
		$result[]=$infos[$linkpcid]['name'];
		return menu_linkpc_level($infos[$linkpcid]['parentid'],$keyid,$infos,$result);
	}
	krsort($result);
	return implode(' > ',$result);
}
//<-------------------------------------
/**
 * 通过id获取显示联动菜单
 * @param  $linkpcid 联动菜单ID
 * @param  $keyid 菜单keyid
 * @param  $space 菜单间隔符
 * @param  $tyoe 1 返回间隔符链接，完整路径名称 3 返回完整路径数组，2返回当前联动菜单名称，4 直接返回ID
 * @param  $result 递归使用字段1
 * @param  $infos 递归使用字段2
 */
function get_linkpc($linkpcid, $keyid, $space = '>', $type = 1, $result = array(), $infos = array()) {
	if($space=='' || !isset($space))$space = '>';
	if(!$infos) {
		$datas = getcache($keyid,'linkage');
		$infos = $datas['data'];
	}
	if($type == 1 || $type == 3 || $type == 4) {
		if(array_key_exists($linkpcid,$infos)) {
			$result[]= ($type == 1) ? $infos[$linkpcid]['name'] : (($type == 4) ? $linkpcid :$infos[$linkpcid]);
			return get_linkpc($infos[$linkpcid]['parentid'], $keyid, $space, $type, $result, $infos);
		} else {
			if(count($result)>0) {
				krsort($result);
				if($type == 1 || $type == 4) $result = implode($space,$result);
				return $result;
			} else {
				return $result;
			}
		}
	} else {
		return $infos[$linkpcid]['name'];
	}
}

/**
 * 通过此串， 可以获取到用户的头像
 * added by weihan
 * 2012.02.22
 * @param int $uid	用户在ucenter中的id
 * @param string $size	头像尺寸，共三个值 'big', 'middle', 'small'
 */
function avatarImgSrc($uid, $size='small'){
	return UCENTER_URL. "avatar.php?uid={$uid}&size={$size}";
}
//<-----------------------------------------------------
/**
 *获取用户的的个人信息等用户的积分
 *2012.3.2 
 *@param int $uid 用户在ucenter中的id
 */
function usermessage($uid){

		$db = pc_base::load_model('member_model');
		$memberinfo = $db->get_one(array('userid'=>$uid));
		return $memberinfo;
	

}
//<-------

/**
 * 企业黄页
 * 根据站点id， 以及类型: 4,企业模型, 5,其他模型
 * 获取相应的模型id
 * @param int $siteid
 * @param int $type
 * @return int $modelid
 */
function getYpModelidBySiteid($siteid, $type=4){
	$model_cache_arr = getcache('yp_model','model');
	
	foreach ($model_cache_arr as $model_arr){
		if ($model_arr['type'] == $type && $model_arr['siteid'] == $siteid){
			return $model_arr['modelid'];
		}
	}
}

/**
 *获取当前分类下的所有分类方法
 *2012.3.31 
 *@param int $catid 分类id
 *@param array $category 分类数组
 */
function get_maincat($catid, $category, $level = -1) {
	$cat = array();
	foreach($category as $c) {
		if($level >= 0 && $c['level'] != $level) continue;
		if($c['parentid'] == $catid && $c['catid'] != $catid) $cat[] = $c;
	}
	return $cat;
}

/**
 *获取当前地区下所有地区方法
 *2012.3.31 
 *@param int $areaid 地区id
 *@param array $area 地区数组
 */
function get_mainarea($areaid, $area) {
	$are = array();
	foreach($area as $c) {
		if($c['parentid'] == $areaid && $c['areaid'] != $areaid) $are[] = $c;
	}
	return $are;
}

/**
 * 根据点评id获取点评分数
 * added by weihan
 * 2012.04.05
 * @param int $dianping_id
 */
function getDianpingScore($dianping_id){
// 	var_dump($dianping_id);exit;
	$dianping_db = pc_base::load_model('dianping_model');
	$dianping_arr = $dianping_db->get_one(array('dianpingid'=>$dianping_id));
	if (empty($dianping_arr)){
		return 0;
	}

	$scores = $ii = 0;
	foreach ($dianping_arr as $k=>$v){
		if (strpos($k, 'data') !== false && !empty($v)){
			$scores += $v;
			$ii += 1;
		}
	}
	
	$avg = floor($scores / $dianping_arr['dianping_nums'] / $ii / 5 * 100) ;
	return $avg;
}


/**
 * 九问律师列表页
 * added by weihan
 * 2012.04.18
 * 
 * ------------------------------------->
 */

/**
 * 九问律师， 构造受理地区
 * @param int $areas_status
 * @param string $areas
 * @return string $str
 */
function areas_status($areas_status,$areas){
	$str = '';
	if ($areas_status == 0){
		$str = '受理全国';
	}elseif ($areas_status == 1){
		$str = '只受理'. $areas;
	}elseif ($areas_status == 2){
		$str = '只拒绝'. $areas;
	}
	
	return $str;
}

/**
 * 根据用户名获取接听时间设置，并缓存
 * @param string $username
 * @return array $dayconfig_arr
 */
function getDayConfig($username){
	if (empty($username))return;
	
	//读取缓存，
	$cache_name = 'dayconfig_'. $username;
	$dayconfig_arr = getcache($cache_name, 'timeout');
	
	//缓存中没有，读取数据库，并缓存
	if (empty($dayconfig_arr)){
		$db = pc_base::load_model('dayconfig_model');
		$dayconfig_arr = $db->select(array('username'=>$username));
		
		setcache($cache_name, $dayconfig_arr, 'timeout', 'file', '', 3600);
	}
	
	return $dayconfig_arr;
}

/**
 * 判断当前时间，是否接听电话
 * @param string $username
 * @param int $xingqi
 * @return array $dayconfig_return
 */
function checkIsLessonByDayconfig($username, $xingqi=0){
	//默认返回值
	$dayconfig_return = array(
		'is_lesson' => 0,
		'str' => '全天不接听',		
	);
	
	$dayconfig_arr = getDayConfig($username);
	
	if (empty($dayconfig_arr)){
		return $dayconfig_return;
	}
	
	//今天是一星期中的第几天
	empty($xingqi) && $xingqi = date('N', SYS_TIME);
	
	//获取今天的配置
	$dayconfig = array();
	foreach ($dayconfig_arr as $k=>$v){
		if ($v['day'] == 's'.$xingqi){
			$dayconfig = $v;
			break;
		}
	}
	if (empty($dayconfig)){
		return $dayconfig_return;
	}
	
	//接听
	if ($dayconfig['day_status'] == 1){
		$dayconfig_return['is_lesson'] = 1;
		//全天接听
		if ($dayconfig['day_type'] == 1){
			$dayconfig_return['str'] = '全天接听';
		}
		//按时段接听
		else {
			$starttime = strtotime($dayconfig['starttime']);
			$endtime = strtotime($dayconfig['endtime']);
			
			//判断时段是否允许接听
			if (SYS_TIME < $starttime || SYS_TIME > $endtime){
				//不允许接听
				$dayconfig_return['is_lesson'] = 0;
				$dayconfig_return['str'] = date('H:i', $starttime). '-'. date('H:i', $endtime);
			}else{
				$dayconfig_return['str'] = date('H:i', $starttime). '-'. date('H:i', $endtime);
			}
			
		}
	}
	return $dayconfig_return;
}

/**
 * 获取周几
 * @param int $time
 * @return string $str
 */
function getWeekdayByTime($time=0){
	empty($time) && $time = SYS_TIME;
	
	$str = '周';
	$xingqi = date('N', $time);
	switch ($xingqi){
		case 1: $str .= '一';break;
		case 2: $str .= '二';break;
		case 3: $str .= '三';break;
		case 4: $str .= '四';break;
		case 5: $str .= '五';break;
		case 6: $str .= '六';break;
		case 7: $str .= '日';break;
	}
	return $str;
}

/**
 * 格式化数字， 
 * @param int $num
 * @return string
 */
function number_format_lvshi($num){
	return number_format($num, 0, '.', ',');
}
//<--------------------------------------------------------------
/**
 * get_fenlei_lawyer2012_data:得到分类列表 专题页
 * 用于律师地区数据的显示
 * lujinfa
 * 2012-04-20
 *
 * @param $fenlei
 * 返回值为html代码
 */
function get_fenlei_lawyer2012_data($fenlei=3365,$catid=11){
	$fenlei = getcache($fenlei,'linkage');
	$fenlei = $fenlei[data];
    $get_fenlei = '';
    $site_id=get_siteid();
	foreach($fenlei as $key=>$value) {
		if ($value['parentid']==0){
		    $get_fenlei = $get_fenlei.'<dl class="cate-dl">
              <dt><a href="/lvshi/zg-lawyer-'.$value[linkageid].'-0-1.html" title="九问律师网'.$value['name'].'法律在线咨询" target="_blank">'.$value['name'].'类相关问题</a></dt><dd>';
                foreach($fenlei as $key1=>$value1){
				     if ($value1['parentid']==$value['linkageid']){
		             $get_fenlei = $get_fenlei.'<a href="/lvshi/zg-lawyer-'.$value1[linkageid].'-0-1.html" title="九问律师网'.$value1['name'].'法律在线咨询" target="_blank">'.$value1[name].'</a>';
					 }
				}
           $get_fenlei = $get_fenlei.'</dd></dl>';
		}
	}
    unset($fenlei,$catid);
	return $get_fenlei;
}

/**
 * 分站广告数据获取函数
 * @param int $siteid
 * @param int $area_id
 * @param int $space_id
 * @param int $num
 * @return array 广告数组
 */
function substation_ads($siteid, $area_id, $space_id, $num=10){
	$poster_db = pc_base::load_model('poster_model');
	
	$cache=getcache('poster_'.$space_id.'_'.$area_id.'_'.$siteid,'timeout');
	if(!$cache){
		$cache=$poster_db->show_poster($siteid,$space_id,$area_id,$num);
		setcache('poster_'.$space_id.'_'.$area_id.'_'.$siteid,$cache, $filepath='timeout', $type='file', $config='',$timeout=3600);
	}
	ksort($cache);
	foreach ($cache as $k => $rs) {
		if ($rs['setting']) {
			$rs['setting'] = string2array($rs['setting']);
			$cache[$k] = $rs;
		} else {
			unset($cache[$k]);
		}
	}
	
	return $cache;
}


/**
 * 地区普通样式多级联动（地区使用）
 * @param string $title
 * @param int $specialtyid
 * @param string $extend
 * @param int $deep
 * @param int $id
 * @return string
 */

function get_linkage_select($linkid=3365,$name='specialtyid',$title = '', $specialtyid = 0, $extend = '', $deep = 0, $id = 1) {

    global $specialty;
    $linkagelist = getcache($linkid,'linkage');
    $specialty =  $linkagelist['data'];
    unset($linkagelist);
    $parents = array();
    $aid = $specialtyid;

    $parents[] = 0;
    $parents = array_reverse($parents);
    $select = '';
    $select .= '<select name="'.$name.'" size="1" style="width:80px;"  '.$extend.'>';
 ;
        if($title) $select .= '<option value="0">'.$title.'</option>';
        foreach($specialty as $a) {
            if($a['parentid'] == 0) {
                $selectid = $specialtyid;
                $selected = $a['linkageid'] == $selectid ? ' selected' : '';
                $select .= '<option value="'.$a['linkageid'].'"'.$selected.'>'.$a['name'].'</option>';
                if($a['child']>0)
                {
                    $select .=get_sun_linkage_select($a['linkageid'],$specialty,$selectid);
                }
            }


    }
    $select .= '</select> ';
    unset($linkagelist,$parents,$linkid,$title,$specialtyid,$extend,$deep);
    return $select;
}
function get_sun_linkage_select($parentid=0,$linkagelist,$selectid)
{
    $select='';
    foreach($linkagelist as $a) {
        if($a['parentid'] == $parentid) {
           // $selectid = isset($parents[$k+1]) ? $parents[$k+1] : $specialtyid;
           // echo "<Br>---------------------";
            $selected = $a['linkageid'] == $selectid ? ' selected' : '';
            $select .= '<option value="'.$a['linkageid'].'"'.$selected.'>||--'.$a['name'].'</option>';
        }
    }
    unset($linkagelist);
   // echo $select;
    return $select;
}
?>

<?php
/**
 * ·ÖÕ¾¿ØÖÆÆ÷
 */
defined('IN_PHPCMS') or exit('No permission resources.');

$sub = $_GET['sub'];
$sub_arr = array('clothes', 'yun', 'toys', 'qinju', 'car', 'food', 'yong', 'xihu', 'shoes', 'tz');
!in_array($sub, $sub_arr) && $sub = 'clothes';

$sub_file = 'sub'. DIRECTORY_SEPARATOR. 'sub_'. $sub. '.php';
require_once $sub_file;

//
class sub extends sub_ {
	
}
?>
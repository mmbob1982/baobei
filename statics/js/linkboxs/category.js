/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
var cat_id;
var isIE = (document.all && window.ActiveXObject && !window.opera) ? true : false;
var isChrome = navigator.userAgent.indexOf('Chrome') != -1;
var DMURL = document.location.protocol+'//'+location.hostname+(location.port ? ':'+location.port : '')+'/';
var AJPath = (DTPath.indexOf('://') == -1 ? DTPath : (DTPath.indexOf(DMURL) == -1 ? DMURL : DTPath))+'api.php';
if(isIE) try {document.execCommand("BackgroundImageCache", false, true);} catch(e) {}
var xmlHttp;
var Try = {
	these: function() {
		var returnValue;
		for (var i = 0; i < arguments.length; i++) {var lambda = arguments[i]; try {returnValue = lambda(); break;} catch (e) {}}
		return returnValue;
	}
}
var sele_obj = null;

var L= new Array();
var _tem_m=0;
L['max_mode']				= '最多可选6种经营模式';
L['max_cate']				= '最多可添加6个分类';
L['choose_category']		= '请选择分类';
L['category_chosen']		= '已添加过此分类';
function makeRequest(queryString, php, func, method) {
	xmlHttp = Try.these(
		function() {return new XMLHttpRequest()},
		function() {return new ActiveXObject('Msxml2.XMLHTTP')},
		function() {return new ActiveXObject('Microsoft.XMLHTTP')}
	);	
	method = (typeof method == 'undefined') ? 'post' : 'get';
	if(func) xmlHttp.onreadystatechange = eval(func);
	xmlHttp.open(method, method == 'post' ? php : php+'?'+queryString, true);
	xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlHttp.send(method == 'post' ? queryString : null);
}

function load_category(catid, id) {
	cat_id = id; category_catid[id] = catid;
	makeRequest('op=get_linkboxs&act=ajax_category&category_title='+category_title[id]+'&category_moduleid='+category_moduleid[id]+'&category_extend='+category_extend[id]+'&category_deep='+category_deep[id]+'&cat_id='+cat_id+'&catid='+catid+'&callback=1', AJPath, 'into_category');
}
function into_category() {
	//alert(xmlHttp.responseText+'78787878');
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {

		$('#catid_'+cat_id)[0].value = category_catid[cat_id];
		//alert('catid_'+cat_id+'***'+category_catid[cat_id]);
		if(xmlHttp.responseText)
		{
			//alert('catid_'+cat_id+'***'+category_catid[cat_id]);
		//	alert('catid_'+xmlHttp.responseText);
			var ctx = xmlHttp.responseText;
		//	$('#load_category_'+cat_id).append($(ctx));
		
			//删除右侧
			var indez = $(sele_obj).index();
			var size = $('#load_category_'+cat_id+' select').length;
			if(size-1 > indez){
				for(i=indez+1; i< size; i++){
					$('#load_category_'+cat_id+' select:eq('+i+')').css('display', 'none')
				}
			}
			
			//
			$(sele_obj).after($(ctx));
		}
	}
}


function check_mode(c, m) {
	var mode_num = 0; var e = $('com_mode').getElementsByTagName('input');	
	for(var i=0; i<e.length; i++) {if(e[i].checked) mode_num++;}
	if(mode_num > m) {confirm(lang(L['max_mode'], [m])); c.checked = false;}
}
function addop(id, v, t) 
{
	var op = document.createElement("option"); 
		op.value = v; 
		op.text = t; 
		$('#'+id)[0].options.add(op);
}
function delop(id) {
	var s = -1;
	for(var i = 0; i < $('#'+id)[0].options.length; i++) {if($('#'+id)[0].options[i].selected) {s = i; break;}}
	if(s == -1) {alert(L['choose_category']); $('#'+id)[0].focus();} else {$('#'+id)[0].remove(s);}
}
function addcate(m,catid) {
	var v = $('#catid_'+catid)[0].value; 
	var l = $('#cates_'+catid)[0].options.length;
	
	
	if(l >= m) 
	{
		alert('最多可添加'+m+'个分类'); 
		return;
	}
	for(var i = 0; i < l; i++) 
	{
		if($('#cates_'+catid)[0].options[i].value == v) 
		{
			alert(L['category_chosen']); 
			return;
		}
	}
	var e = $('#cate_'+catid)[0].getElementsByTagName('select'); 
	var c = s = '';
	for(var i = 0; i < e.length; i++) 
	{
		if(e[i].value) 
		{
			s = e[i].options[e[i].selectedIndex].innerHTML; 
			c += s + '/'; 
			s = '';
		}
	}
	if(c)
	{
		c = c.replace('&amp;', '&'); 
		c = c.substring(0, c.length-1); 
		addop('cates_'+catid, v, c); 
		$('#'+catid)[0].value = $('#'+catid)[0].value ? $('#'+catid)[0].value+v+',' : ','+v+',';
	} 
	else 
	{
		alert(L['choose_category']);
	}
}
function delcate(catid) 
{
	var s = -1;
	for(var i = 0; i < $('#cates_'+catid)[0].options.length; i++) 
	{
		if($('#cates_'+catid)[0].options[i].selected) 
		{
			s = i; break;
		}
	}
	if(s == -1) 
	{
		alert(L['choose_category']); 
		$('#cates_'+catid)[0].focus();
	} 
	else
	{
		$('#'+catid)[0].value = $('#'+catid)[0].value.replace(','+$('#cates_'+catid)[0].options[s].value+',', ',');
	 	$('#cates_'+catid)[0].remove(s);
	 }
}

var isBrowser = function(version) {
	if (typeof version == 'undefiend')
	return false;
	version = version.toUpperCase();
	var isIE = !!window.ActiveXObject;
	var isIE6 = isIE && !window.XMLHttpRequest;
	var isIE8 = isIE && !!document.documentMode;
	var isIE7 = isIE && !isIE6 && !isIE8;
	if (isIE) {
		if (isIE6) {
			return version === 'IE6';
		} else if (isIE8) {
			return version === 'IE8';
		} else if (isIE7) {
			return version === 'IE7';
		}
	}else {
		return version === 'FF';
	}
}
document.writeln('<script type="text/javascript" src="http://www.baobei360.com/_Public/_js/jquery-1.3.2.min.js"></script>');
document.writeln('<script type="text/javascript" src="/_Public/_js/My97DatePicker/WdatePicker.js"></script>');
document.writeln('<script type="text/javascript" src="http://www.baobei360.com/_Public/_js/swfobject/swfobject.js"></script>');
document.writeln('<script type="text/javascript" src="http://www.baobei360.com/_Public/_js/easyslider1.5/js/easySlider1.5.js"></script>');
document.writeln('<script type="text/javascript" src="http://www.baobei360.com/_Public/_js/jquery.CheckAll.js"></script>');
document.writeln('<script type="text/javascript" src="http://www.baobei360.com/_Public/_js/jquery.LoadImage.js"></script>');
document.writeln('<script type="text/javascript" src="http://www.baobei360.com/_Public/_js/jquery.Cookie.js"></script>');
if (isBrowser("IE6")){
	document.writeln('<script type="text/javascript" src="http://www.baobei360.com/_Public/_js/DD_belatedPNG_0.0.8a.min.js"></script>');
}
function getEvent(event) {
	var ev = event || window.event;
	if (!ev) {
		var c = this.getEvent.caller;
		while (c) {
			ev = c.arguments[0];
			if (ev && (Event == ev.constructor || MouseEvent  == ev.constructor)) {
				break;
			}
			c = c.caller;
		}
	}
	return ev;
}

function CopyToClipboard(txt) {   
	if(window.clipboardData) {   
		window.clipboardData.clearData();   
		window.clipboardData.setData("Text", txt);   
	} else if(navigator.userAgent.indexOf("Opera") != -1) {   
		window.location = txt;   
	} else if (window.netscape) {   
		try {   
			netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");   
		} catch (e) {   
			alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将'signed.applets.codebase_principal_support'设置为'true'");   
		}   
		var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);   
		if (!clip)   
		return;   
		var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);   
		if (!trans)   
		return;   
		trans.addDataFlavor('text/unicode');   
		var str = new Object();   
		var len = new Object();   
		var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);   
		var copytext = txt;   
		str.data = copytext;   
		trans.setTransferData("text/unicode",str,copytext.length*2);   
		var clipid = Components.interfaces.nsIClipboard;   
		if (!clip)   
		return false;   
		clip.setData(trans,null,clipid.kGlobalClipboard);   
	} 
	alert("复制成功！");
}

//生成GUID
function Guid(options) {
  this.options = options || {};
  this.chars = this.options.chars || Guid.constants.alphanumerics;
  this.epoch = this.options.epoch || Guid.constants.epoch1970;
  this.counterSequenceLength = this.options.counterSequenceLength || 1;
  this.randomSequenceLength = this.options.randomSequenceLength || 2;
}
Guid.prototype.generate = function() {
  var now = (new Date()).getTime() - this.epoch;
  var guid = this.baseN(now);
  this.counterSeq = (now==this.lastTimestampUsed ? this.counterSeq+1 : 1);
  guid += this.counterSeq;
  for (var i=0; i<this.randomSequenceLength; i++) {
    guid += this.chars.charAt(Math.floor(Math.random() * this.chars.length));
  }
  this.lastTimestampUsed = now;
  return guid;
}
Guid.prototype.baseN = function(val) {
  if (val==0) return "";
  var rightMost = val % this.chars.length;
  var rightMostChar = this.chars.charAt(rightMost);
  var remaining = Math.floor(val / this.chars.length);
  return this.baseN(remaining) + rightMostChar;
}

Guid.constants = {};
Guid.constants.numbers = "0123456789";
Guid.constants.alphas = "abcdefghijklmnopqrstuvwxyz";
Guid.constants.lowerAlphanumerics = "0123456789abcdefghijklmnopqrstuvwxyz";
Guid.constants.alphanumerics = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
Guid.constants.base85 = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#$%&()*+-;<=>?@^_`{|}~";
Guid.constants.epoch1970 = (new Date(0));
Guid.constants.epoch = function(year) { return (new Date("Jan 1 " + year)).getTime(); }

guid = new Guid();

function ShowFlash(swfUrlStr,widthStr,heightStr,flashvarsObj,parObj,attObj){
	var newguid = guid.generate();
	//swfUrlStr, replaceElemIdStr, widthStr, heightStr, swfVersionStr, xiSwfUrlStr, flashvarsObj, parObj, attObj, callbackFn
	flashvarsObj
	var params = {
		menu: "false",
		wmode: "opaque", //opaque,transparent,window
		allowFullScreen: true,
		Quality: "high",
		flashvars:flashvarsObj
    };  
	flashvarsObj=false;
	var widthStr=(widthStr==null || widthStr=="") ? null:widthStr;
	var heightStr=(heightStr==null || heightStr=="") ? null:heightStr;
	var flashvarsObj=(flashvarsObj==null || flashvarsObj=="") ? null:flashvarsObj;
	var parObj=(parObj==null || parObj=="") ? params:parObj;
	var attObj=(attObj==null || attObj=="") ? null:attObj;
	document.write("<div id='"+newguid+"'></div>");
	swfobject.embedSWF(swfUrlStr, newguid, widthStr, heightStr, "9.0.0", "../_js/swfobject/expressInstall.swf", flashvarsObj, parObj, attObj);
}

var flag=false; 
function DrawImage(ImgD,MaxWidth,MaxHeight){ 
	var image=new Image(); 
	//var MaxWidth = 120
	//var MaxHeight = 120
	image.src=ImgD.src; 
	if(image.width>0 && image.height>0){ 
		flag=true; 
		if(image.width/image.height>= MaxWidth/MaxHeight){ 
			if(image.width>MaxWidth){
				ImgD.width=MaxWidth; 
				ImgD.height=(image.height*MaxWidth)/image.width; 
			}else{ 
				ImgD.width=image.width;
				ImgD.height=image.height; 
			} 
			//ImgD.alt=image.width+"x"+image.height; 
		}else{ 
			if(image.height>MaxHeight){
			ImgD.height=MaxHeight; 
			ImgD.width=(image.width*MaxHeight)/image.height; 
			}else{ 
			ImgD.width=image.width;
			ImgD.height=image.height; 
			} 
			//ImgD.alt=image.width+"x"+image.height; 
		} 
	}
}

function AddLastTextBox(obj){
	function CheckLastVal(){
		if($.trim($("input[name="+obj+"]:last").val())!=''){
			$("input[name="+obj+"]:last").after($(this).clone());
			$("input[name="+obj+"]:last").val('');
			$("input[name="+obj+"]:last").bind("keyup",CheckLastVal);
			$("input[name="+obj+"]").bind("focus",CheckLastVal);
			$("input[name="+obj+"]").bind("blur",DelLastVal);
		}
	}
	
	function DelLastVal(){
		if ($.trim($(this).val())=='' && $("input[name="+obj+"]").index($(this))+1!=$("input[name="+obj+"]").size()){
			$(this).remove();
		}
	}
	
	$("input[name="+obj+"]:last").bind("keyup",CheckLastVal);
	$("input[name="+obj+"]").bind("focus",CheckLastVal);
	$("input[name="+obj+"]").bind("blur",DelLastVal);
}

function DisplayPic(obj,src){
	if (/(\.jpg|\.jpeg|\.gif|\.bmp|\.png)$/gi.test(src)){
		$(obj).find("img").attr("src",src);
		$(obj).show();
	}else{
		$(obj).hide();
	}
}

function TabChange(tabTit,tabBody,mouseTime,autoTime){
	var t = 0;
	var count = 0; 
	var Pos=-1;
	var mouseTimeID=null;
	var autoTimeID=null;
	if (mouseTime=="" || mouseTime==null){mouseTime=0;}
	if (autoTime=="" || autoTime==null){autoTime=0;}
	
	count = $(tabTit).size();
	
	function ChangeTab(){
		
		if (Pos>=count) return;
		$(tabTit).each(function(index,domEle){
			if (index==Pos){
				$(this).addClass("select");	
			}else{
				$(this).removeClass("select");
			}
		});	
		$(tabBody).filter(":visible").fadeOut(0).parent().children().eq(Pos).fadeIn(0);
		if (autoTime>0 && mouseTimeID==null){autoTimeID=window.setTimeout(Auto,autoTime);}
	}
	
	function Auto(){  
		Pos = Pos >= (count-1) ? 0 : Pos+1;   
		ChangeTab();
	}
	Auto();
	
	$(tabTit).bind("mouseover",function(){
		Pos=$(tabTit).index(this);
		
		mouseTimeID=window.setTimeout(ChangeTab,mouseTime);
		window.clearTimeout(autoTimeID);
	});
	
	$(tabTit).bind("mouseout",function(){
		window.clearTimeout(mouseTimeID);
		mouseTimeID=null;
		if (autoTime>0 && mouseTimeID==null){autoTimeID=window.setTimeout(Auto,autoTime);}
	});
}

function doZoom(size){
	document.getElementById("NewsBody").style.fontSize = size+"px";
	if (size=="12"){
		document.getElementById("fontSmall").style.color = "#f00"
		document.getElementById("fontMiddle").style.color = "#999"
		document.getElementById("fontBig").style.color = "#999"
	}else if (size=="14"){
		document.getElementById("fontSmall").style.color = "#999"
		document.getElementById("fontMiddle").style.color = "#f00"
		document.getElementById("fontBig").style.color = "#999"
	}else if (size=="16"){
		document.getElementById("fontSmall").style.color = "#999"
		document.getElementById("fontMiddle").style.color = "#999"
		document.getElementById("fontBig").style.color = "#f00"
	}
}

function CopyURL(){
	var myHerf=top.location.href;
	var title=document.title;
	var tempLink=title + "\n" + myHerf;
	CopyToClipboard(tempLink); 
}

function closeWindow(){
	window.opener=null;
	window.open('','_self');
	window.close();
}

var isIE = (document.all) ? true : false;
var Class = {
	create: function() {
		return function() { this.initialize.apply(this, arguments); }
	}
}
var Extend = function(destination, source) {
	for (var property in source) {
		destination[property] = source[property];
	}
}
var Bind = function(object, fun) {
	return function() {
		return fun.apply(object, arguments);
	}
}
var RevealTrans = Class.create();
RevealTrans.prototype = {
	initialize: function(container, options) {
		this._img = document.createElement("img");
		this._a = document.createElement("a");
		this._timer = null;//计时器
		this.Index = 0;//显示索引
		this._onIndex = -1;//当前索引
		this.SetOptions(options);
		this.Auto = !!this.options.Auto;
		this.Pause = Math.abs(this.options.Pause);
		this.Duration = Math.abs(this.options.Duration);
		this.Transition = parseInt(this.options.Transition);
		this.List = this.options.List;
		this.onShow = this.options.onShow;
		
		//初始化显示区域
		this._img.style.visibility = "hidden";//第一次变换时不显示红x图
		this._img.style.width = this._img.style.height = "100%"; this._img.style.border = 0;
		this._img.onmouseover = Bind(this, this.Stop);
		this._img.onmouseout = Bind(this, this.Start);
		isIE && (this._img.style.filter = "revealTrans()");
		this._a.target = "_blank";
		document.getElementById(container).appendChild(this._a).appendChild(this._img);
	},
	//设置默认属性
	SetOptions: function(options) {
		this.options = {//默认值
			Auto:		true,//是否自动切换
			Pause:		3000,//停顿时间(微妙)
			Duration:	1,//变换持续时间(秒)
			Transition:	23,//变换效果(23为随机)
			List:		[],//数据集合,如果这里不设置可以用Add方法添加
			onShow:		function(){}//变换时执行
		};
		Extend(this.options, options || {});
	},
	Start: function() {
		clearTimeout(this._timer);
		//如果没有数据就返回
		if(!this.List.length) return;
		//修正Index
		if(this.Index < 0 || this.Index >= this.List.length){ this.Index = 0; }
		//如果当前索引不是显示索引就设置显示
		if(this._onIndex != this.Index){ this._onIndex = this.Index; this.Show(this.List[this.Index]); }
		//如果要自动切换
		if(this.Auto){this._timer = setTimeout(Bind(this, function(){ this.Index++; this.Start(); }), this.Duration * 1000 + this.Pause); }
	},
	//显示
	Show: function(list) {
		if(isIE){ //设置变换参数
			with(this._img.filters.revealTrans){
				Transition = this.Transition; Duration = this.Duration; apply(); play();
			}
		}
		this._img.style.visibility = ""; //设置图片属性
		this._img.src = list.img; this._img.alt = list.text;
		!!list["url"] ? (this._a.href = list["url"]) : this._a.removeAttribute("href"); //设置链接
		this.onShow();//附加函数
	},
	//添加变换对象
	Add: function(sIimg, sText, sUrl) {
		this.List.push({ img:sIimg, text:sText, url:sUrl });
	},
	//停止
	Stop: function() {
		clearTimeout(this._timer);
	}
};

/*显示Flash动画*/
/*Swf(路径,影片ID,宽,高,变量,窗口模式)*/
var __SwfIndex = 0;
function Swf(Url,W,H,FlashVars,Wmode,ID){
	if (ID==null){
		ID = "Swf_"+(__SwfIndex++);
		document.writeln('<div id="'+ID+'" style="line-height:'+H+'px; width:'+W+'px; height:'+H+'px; text-align:center;">Flash Loading...</div>');
	}
	var flashvars = false;
	var params = {
		menu: "false",
		allowFullScreen: "true",
		wmode: Wmode!=null ? Wmode : "Opaque",
		flashvars: FlashVars!=null ? FlashVars : ""
	};
	var attributes = {
		id: "mySwfContent",
		name: "mySwfContent"
	};
	swfobject.embedSWF(Url,ID,W,H,"9.0.0","expressInstall.swf",flashvars,params,attributes);  
}

/*显示Flash动画(无边框)*/
/*ShowFlashAll(路径,宽,高,变量,背景色,窗口模式,是否显示菜单,影片ID,质量,是否全屏)*/
function ShowFlashAll(Url,W,H,FlashVars,BgColor,Wmode,Menu,ID,Quality,AllowFullScreen) {
		var W=(W==null || W=="") ? null:W;
	var H=(H==null || H=="") ? null:H;
	var FlashVars=(FlashVars==null || FlashVars=="") ? null:FlashVars;
	var BgColor=(BgColor==null || BgColor=="") ? null:BgColor;
	var Wmode=(Wmode==null || Wmode=="") ? "opaque":Wmode;
	var Menu=(Menu==null || Menu=="") ? false:Menu;
	var ID=(ID==null || ID=="") ? null:ID;
	var Quality=(Quality==null || Quality=="") ? "high":Quality;
	var AllowFullScreen=(AllowFullScreen==null || AllowFullScreen=="") ? true:AllowFullScreen;
	
	var FlashObj='';
	if (!isBrowser('FF')){
		FlashObj="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,2,8'";
	}else{
		FlashObj='<object type="application/x-shockwave-flash" data="'+ Url +'" width="'+ W +'" height="'+ H +'">';
	}
	FlashObj+=W!=null ? " width='" + W + "'":"";
	FlashObj+=H!=null ? " height='" + H + "'":"";
	FlashObj+=ID!=null ? " ID='"+ ID + "'":"";
	FlashObj+=">"

	FlashObj+=Url!=null ? "<param name='movie' value='"+ Url + "' />":"";
	FlashObj+=BgColor!=null ? "<param name='bgcolor' value='"+ BgColor + "' />":"";
	FlashObj+=Wmode!=null ? "<param name='wmode' value='"+ Wmode + "' />":''; //opaque,transparent,window
	FlashObj+=Menu!=null ? "<param name='menu' value='"+ Menu + "' />":"";
	FlashObj+=FlashVars!=null ? "<param name='FlashVars' value='"+ FlashVars + "' />":"";
	FlashObj+=Quality!=null ? "<param name='quality' value='"+ Quality + "' />":"";
	FlashObj+=AllowFullScreen!=null ? "<param name='allowFullScreen' value='"+ AllowFullScreen + "' />":"";

	FlashObj+="<embed";
	FlashObj+=Url!=null ? " src='"+ Url + "'":"";
	FlashObj+=W!=null ? " width='"+ W + "'":"";
	FlashObj+=H!=null ? " height='"+ H + "'":"";
	FlashObj+=ID!=null ? " id='"+ ID + "'":"";
	FlashObj+=BgColor!=null ? " bgcolor='"+ BgColor + "'":"";
	FlashObj+=Wmode!=null ? " wmode='"+ Wmode + "'":"";
	FlashObj+=Menu!=null ? " menu='"+ Menu + "'":"";
	FlashObj+=FlashVars!=null ? " FlashVars='"+ FlashVars + "'":"";
	FlashObj+=Quality!=null ? " quality='"+ Quality + "'":"";
	FlashObj+=AllowFullScreen!=null ? " allowFullScreen='"+ AllowFullScreen + "'":"";
	FlashObj+="></embed>";
	FlashObj+='<param name="swfversion" value="9,0,2,8" />';
	FlashObj+='</object>';
	document.write(FlashObj);
	//Swf(Url,W,H,FlashVars,Wmode);
}


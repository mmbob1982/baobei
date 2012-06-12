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
document.writeln('<script type="text/javascript" src="http://www.baobei360.com/_Public/_js/jquery-1.4.4.min.js"></script>');
document.writeln('<script type="text/javascript" src="http://www.baobei360.com/_Public/_js/swfobject/swfobject.js"></script>');
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

/*关闭窗口*/
function closeWindow(){window.opener=null;window.open('','_self');window.close();}
/*复制地址*/
function CopyURL(){var myHerf=top.location.href;var title=document.title;var tempLink=title + "\n" + myHerf;CopyToClipboard(tempLink);}
/*复制到剪切板*/
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

function TabChange(tabTit,tabBody,posIndex,mouseTime,playTime,eventType){
	var inte=false;
	var mouseTimeID=null;
	var playTimeID=null;
	var _posIndex = -1;
	if (posIndex=="" || posIndex==null) {
		 _posIndex = posIndex;
	}
	
	if (mouseTime=="" || mouseTime==null){mouseTime=0;}
	if (playTime=="" || playTime==null){playTime=0;}
	if (eventType=="" || eventType==null){eventType="mouseover";}
	
	var count = $(tabTit).size();
	
	function ChangeTab(){
		window.clearTimeout(playTimeID);
		if (posIndex>=count) return;
		$(tabTit).each(function(index,domEle){
			(index==_posIndex) ? $(this).addClass("select") : $(this).removeClass("select");
		});	
		$(tabBody).hide().eq(_posIndex).show();
	}
	
	function Play(){
		if (playTime>0 || !inte){
			inte=true;
			_posIndex = _posIndex >= (count-1) ? 0 : _posIndex+1;
			ChangeTab();
			playTimeID=window.setTimeout(Play,playTime);
		}
	}
	
	Play();
	
	if (eventType=="click"){
		$(tabTit).bind("click",function(){
			_posIndex = $(this).index()
			ChangeTab();
		}).bind("mouseover",function(){
			window.clearTimeout(playTimeID);
		}).bind("mouseout",function(){
			if (playTime>0 && mouseTimeID==null){playTimeID=window.setTimeout(Play,playTime);}
		});
	}else{
		$(tabTit).bind("mouseover",function(){
			_posIndex=$(this).index();
			mouseTimeID=window.setTimeout(ChangeTab,mouseTime);
			window.clearTimeout(playTimeID);
		}).bind("mouseout",function(){
			if (playTime>0){playTimeID=window.setTimeout(Play,playTime);}
		});
	}
	$(tabBody).bind("mouseover",function(){
		window.clearTimeout(playTimeID);
	}).bind("mouseout",function(){
		if (playTime>0){playTimeID=window.setTimeout(Play,playTime);}
	});
}



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

/*显示Flash动画*/
/*ShowFlashAll(路径,宽,高,变量,背景色,窗口模式,是否显示菜单,影片ID,质量,是否全屏)*/
function ShowFlashAll(Url,W,H,FlashVars,BgColor,Wmode,Menu,ID,Quality,AllowFullScreen) {
	var W=(W==null || W=="") ? null:W;
	var H=(H==null || H=="") ? null:H;
	var FlashVars=(FlashVars==null || FlashVars=="") ? null:FlashVars;
	var BgColor=(BgColor==null || BgColor=="") ? null:BgColor;
	var Wmode=(Wmode==null || Wmode=="") ? "window":Wmode;
	var Menu=(Menu==null || Menu=="") ? false:Menu;
	var ID=(ID==null || ID=="") ? null:ID;
	var Quality=(Quality==null || Quality=="") ? "high":Quality;
	var AllowFullScreen=(AllowFullScreen==null || AllowFullScreen=="") ? true:AllowFullScreen;
	
	var FlashObj=null;
	FlashObj="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,2,8'";
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
	FlashObj+="</object>";
	document.write(FlashObj);
}


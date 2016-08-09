<html lang="en">

<!-- 
Smart developers always View Source. 

This application was built using Adobe Flex, an open source framework
for building rich Internet applications that get delivered via the
Flash Player or to desktops via Adobe AIR. 

Learn more about Flex at http://flex.org 
// -->

<head>
  <meta http-equiv="pragma" content="no-cache" />
<script language="javascript" src="js/getID.js"></script>


 
<script type="text/javascript">
function GetCookie(){ 
	var cookieString = new String(document.cookie);
	var arr_cookieString = new Array();  
	arr_cookieString = cookieString.split(";"); 
	for(i=0; i <arr_cookieString.length; i++){ 
		if ( arr_cookieString[i].indexOf('pageurl=') != -1 ){
			//alert(arr_cookieString[i]);
			pageurl = arr_cookieString[i].replace('pageurl=', '');
			pageurl = pageurl.replace('ss.html', 's.html');
			//alert(pageurl);
			//return arr_cookieString[i];
			return pageurl;
		}
	}
	
	//return '';
	
/*	var cookieHeader = "pageurl=";
	var beginPosition = cookieString.indexOf(cookieHeader)
	if (beginPosition != -1){
		alert(cookieString.substring(beginPosition + cookieHeader.length));
		alert(cookieString);
		return cookieString.substring(beginPosition + cookieHeader.length) ;
	}
	else{
		return '' ;
	}	*/
}

		
function getIDSafe(){

var Url=top.window.location.href;
if(window.parent!=undefined)
{
   Url=window.parent.location.href;
}

var u,g,StrBack='';
if(arguments[arguments.length-1]=="#")
   u=Url.split("#");
else
   u=Url.split("?");
if (u.length==1) g='';
else g=u[1];
if(g!=''){
   gg=g.split("&");
   var MaxI=gg.length;
   str = arguments[0]+"=";
   for(i=0;i<MaxI;i++){
      if(gg[i].indexOf(str)==0) {
        StrBack=gg[i].replace(str,"");
        break;
      }
   }
}
return StrBack;
}

function addFavorite()
{
    favUrl = window.location.host;
    if (document.all){
        window.external.addFavorite('http://'+ favUrl +'/s.html','Evony-Free forever');
    }
    else if (window.sidebar){
        window.sidebar.addPanel('Evony-Free forever', 'http://'+ favUrl +'/s.html', "");
    }
}

function getGuid() {
		pageurl = GetCookie('pageurl');
		var queryStr = pageurl.substring(pageurl.indexOf("?") + 1);
        var params = queryStr.split("&");
        var pos;
        var paramKey;
        var paramValue;
        for(var i = 0; i < params.length; i++) {
            pos = params[i].indexOf("=");
            if (pos == -1) { continue; }
            
            paramKey = params[i].substring(0, pos);
            paramValue = params[i].substring(pos + 1);
            
            if (paramKey.toLowerCase() == "guid") {
                return unescape(paramValue.replace(/\+/g, " "));
            }
        }
    }



function SetIeTitle(strTitle)
{  
    window.parent.down.location.href="2.html?"+strTitle;
}

function getPageUrl()
{
	pageurl = GetCookie('pageurl');
	if ( pageurl != '' ){
		return unescape(pageurl);
	}else{
		var strParentUrl=window.parent.location.href;
		
		var iIndex=strParentUrl.indexOf("757365726e616d653d");
		
		if(iIndex>0)
		{ 
			return unescape(strParentUrl);
		}
		var strUrl=window.location.href; 
		return unescape(strUrl);
	}
}

function getCID(name) {
		pageurl = GetCookie('pageurl');
		var queryStr = pageurl.substring(pageurl.indexOf("?") + 1);
        var params = queryStr.split("&");
        var pos;
        var paramKey;
        var paramValue;
        for(var i = 0; i < params.length; i++) {
            pos = params[i].indexOf("=");
            if (pos == -1) { continue; }
            
            paramKey = params[i].substring(0, pos);
            paramValue = params[i].substring(pos + 1);
            
            if (paramKey.toLowerCase() == name) {
                return unescape(paramValue.replace(/\+/g, " "));
            }
        }

    }
	
/**
 * @desc   返回父窗口的url
 * @author Snow
 * @date   2009-05-11 11:34
 */
function getFatherPageUrl() {
    var strParentUrl=window.parent.location.href;
    return unescape(strParentUrl);
}

// -- 隐藏加载时的flash

var flv_load_state  = false;
function hiddenFloatFlv() {
    flv_load_state  = true;
    var obj_flv_float_frame = document.getElementById('flv_float_frame');
    obj_flv_float_frame.innerHTML   = '';
    obj_flv_float_frame.style.display    = 'none';
	document.getElementById('foot').style.display = 'block';

    resetSize()
}

function processHandler(p_finished_bytes,p_total_finished_bytes) {
    var finish_per  = 0;
    var obj_loading_percentage      = document.getElementById('loading_percentage');
	var obj_loading_percentage_etext      = document.getElementById('loading_percentage_etext');
    if (0 != p_finished_bytes && 0 != p_total_finished_bytes) {
        finish_per  = parseInt((p_finished_bytes/p_total_finished_bytes) * 100);
        obj_loading_percentage.innerHTML    = ''+finish_per+'%, '+p_finished_bytes+' / '+p_total_finished_bytes+' bytes';
		obj_loading_percentage_etext.innerHTML    = "It will take a little longer to load the first time. Next time it will be instant!";
    } 
    
    if (p_finished_bytes == p_total_finished_bytes) {
       hiddenFloatFlv();
    }
    
}


function ChBgColor()
{
     document.bgColor="000000";
}


</script>



<style>
body { margin: 0px; overflow:hidden }
.foot{ clear:both; text-align:center; font:normal 10px Tahoma, Geneva, sans-serif;display: none;}
.foot a:link, .foot a:visited{ text-decoration:none}
.foot a:hover{color:#ccc; }
</style>


<script language="JavaScript" type="text/javascript">
<!--
// -----------------------------------------------------------------------------
// Globals
// Major version of Flash required
var requiredMajorVersion = 9;
// Minor version of Flash required
var requiredMinorVersion = 0;
// Minor version of Flash required
var requiredRevision = 0;
// -----------------------------------------------------------------------------

function resetSize () {
    if (!flv_load_state) {
        return false;
    }
    var w = document.body.clientWidth;
    var h = document.body.clientHeight;
    
    var rate = 7 / 12;
    var currentRate = h / w;
    var civonyClient = document.getElementById ( "dmrpg" );
    var rateStr = 0;
    if ( currentRate > rate ) {
        civonyClient.width = w;
        civonyClient.height = w * rate;
        rateStr = 1;
    } else {

        civonyClient.width = h / rate;
        civonyClient.height = h;
    }
    //alert ( 'body: ' + document.body.clientWidth + " X " + document.body.clientHeight + "\r\n civony: " + civonyClient.width + ' * ' + civonyClient.height);
}

window.onresize = resetSize ;

function OnTimerResize()
{
    setTimeout("OnTimerResize()",1500);
    
    var w = document.body.clientWidth;
    var h = document.body.clientHeight; 
    var civonyClient = document.getElementById ( "Civony" );
    var w_c = civonyClient.width;
    var h_c = civonyClient.height;

    if ( ( w == w_c && h < h_c ) || ( h == h_c && w < w_c ) || ( w != w_c && h != h_c ) ){
        resetSize();
    }
    
}

setTimeout("OnTimerResize()",1500);

if (window.attachEvent) {
    window.attachEvent("onload", resetSize);
} else {
    window.addEventListener("DOMContentLoaded", resetSize, false);
}
// -->
</script>
</head>

<body bgcolor="c28b56" style=" text-align:center;">

<div name="flv_frame" id="flv_frame" style="">
<script language="JavaScript" type="text/javascript">
<!--
// Version check for the Flash Player that has the ability to start Player Product Install (6.0r65)
var hasProductInstall = DetectFlashVer(6, 0, 65);

// Version check based upon the values defined in globals
var hasRequestedVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);

//var flash_width     = 1200;//document.body.clientWidth;
//var flash_height    = 700;//document.body.clientHeight;

    var w = document.body.clientWidth;
    var h = document.body.clientHeight;
    
    var rate = 7 / 12;
    var currentRate = h / w;
    if ( currentRate > rate ) {
        flash_width = w;
        flash_height = w * rate;

    } else {
        flash_width = h / rate;
        flash_height = h;
    }

    
    
if ( hasProductInstall && !hasRequestedVersion ) {
    // DO NOT MODIFY THE FOLLOWING FOUR LINES
    // Location visited after installation is complete if installation is required
    var MMPlayerType = (isIE == true) ? "ActiveX" : "PlugIn";
    var MMredirectURL = window.location;
    document.title = document.title.slice(0, 47) + " - Flash Player Installation";
    var MMdoctitle = document.title;

    AC_FL_RunContent(
        "src", "playerProductInstall",
        "FlashVars", "MMredirectURL="+MMredirectURL+'&MMplayerType='+MMPlayerType+'&MMdoctitle='+MMdoctitle+"",
        "width", 1200,
        "height", 700,
        "align", "top",
        "id", "Civony",
        "quality", "high",
        "bgcolor", "#c28b56",
        "name", "Civony",
        "allowScriptAccess","always",
        "type", "application/x-shockwave-flash",
        "pluginspage", "http://www.adobe.com/go/getflashplayer"
    );
} else if (hasRequestedVersion) {
    // if we've detected an acceptable version
    // embed the Flash Content SWF when all tests are passed
    AC_FL_RunContent(
            "src", "http://caching.evony.com/EvonyClient190.swf?ver=20090729_0190",
            "width", 1,
            "height", 1,
            "align", "top",
            "id", "Civony",
            "quality", "high",
            "bgcolor", "#c28b56",
            "name", "Civony",
            //"wmode", "Transparent",
            "allowScriptAccess","always",
            "type", "application/x-shockwave-flash",
            "pluginspage", "http://www.adobe.com/go/getflashplayer"
    );
  } else {  // flash is too old or we can't detect the plugin
    var alternateContent = 'Alternate HTML content should be placed here. '
    + 'This content requires the Adobe Flash Player. '
    + '<a href=http://www.adobe.com/go/getflash/>Get Flash</a>';
    document.write(alternateContent);  // insert non-flash content
  }

// -->
</script>
<noscript>
<table width="100%" height="100%" border="1" cellpadding="0" cellspacing="0">
<tr>
<td align="center" valign="middle">


<div style="z-index:-1">
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
            id="Civony" width="1200" height="700"
            codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
            <param name="movie" value="http://caching.evony.com/EvonyClient190.swf?ver=20090729_0190" />
            <param name="quality" value="high" />
             <param name="wmode" value="transparent">
            <param name="bgcolor" value="#869ca7" />
            <param name="allowScriptAccess" value="always" />
            <embed src="http://caching.evony.com/EvonyClient190.swf?ver=20090729_0190" quality="high" bgcolor="#869ca7" width="1200" height="700" name="Civony" align="middle"
                play="true"
                loop="false"
                quality="high"
                wmode="transparent" 
                allowScriptAccess="always"
                type="application/x-shockwave-flash"
                pluginspage="http://www.adobe.com/go/getflashplayer">
            </embed>
    </object>
</div>

</td>
</tr>
</table>
</noscript>
<div>
  <div class="foot" name="foot" id="foot">
    <p>Copyright ©2009 Evony, LLC. All rights reserved. </p> 
  </div>
</div>
</div>

<div name="flv_float_frame" id="flv_float_frame">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td align="center" valign="middle">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
            id="Civony" width="400" height="260"
            codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
            <param name="movie" value="http://caching.evony.com/fla/logo1.swf" />
            <param name="quality" value="high" />
             <param name="wmode" value="transparent">
            <param name="bgcolor" value="#869ca7" />
            <param name="allowScriptAccess" value="always" />
            <embed src="http://caching.evony.com/fla/logo1.swf" quality="high" bgcolor="#869ca7" width="400" height="260" name="Civony"
                play="true"
                loop="false"
                quality="high"
                wmode="transparent"
                allowScriptAccess="always"
                type="application/x-shockwave-flash"
                pluginspage="http://www.adobe.com/go/getflashplayer">
            </embed>
    </object>
    
    <div class="loading_data" name="loading_data" id="loading_data" style="font-family:Times new roman;color:#0404e3;font-size:18px;">
<div>Loading <span name="loading_percentage" id="loading_percentage"></span>, please wait.<br/><span name="loading_percentage_etext" id="loading_percentage_etext"></span>
</div>
    </div>
</td></tr></table>
</div>
</body>

<!-- 广告转化跟踪代码 -->
<script language="JavaScript" type="text/javascript">
function trackAdv(tUrl)
{
    var u=new Image(1,1);
    u.src = tUrl;
    u.onload = function(){
    }
}


    <!-- Google Code for singup Conversion Page -->
    var google_conversion_id;
    var google_conversion_language = "en_US";
    var google_conversion_format = "3";
    var google_conversion_color = "ffffff";
    var google_conversion_label;
//default google5
    google_conversion_id=1034562079;
    google_conversion_label="6KOrCP35mAEQn9So7QM";

    //-->

    var tmp = getIDSafe('adv');
    var adva ;
    var adv="";
    if(tmp!=undefined)
    {
        adva = getIDSafe('adv').split ('#');
        adv=adva[0];
    }        
</script>
<script language="JavaScript" src="/sEvonyAdvS2.php?t=1"></script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<!-- This's google analytics code -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pcall = (("https:" == document.location.protocol) ? "https://" : "http://");
document.write(unescape("%3Cscript src='" + pcall + "anchor.tmlatn.com/roi/22.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
function OnCreatedTwoCities(accountName)
{
	tUrl = "IngameCreatedTwoCitiesByUser"+accountName;
	pageTracker._trackPageview (tUrl);
	trackAdv("http://pay.evony.com/Other/outputheader.php?email="+accountName);
}
function callByIngameBuy(orderid,total,itemid,itemname,itemcategory,itemprice,itemnum){
    pageTracker._trackPageview("/IngameBuySuccessful");
    t = parseInt(total);
    t = t/100;
  pageTracker._addTrans(
    orderid,                        
    "GameBuy",                      
    t,
    "0",                            
    "0",                            
    "",                             
    "",                             
    ""                              
  );
  p = parseInt(itemprice);
  p = p/100;
  itemid = window.location.host;
  pageTracker._addItem(
    orderid,                                 
    itemid,                                  
    itemname,                                
    itemcategory,                            
    p,                               
    itemnum                                  
  );
  
  pageTracker._trackTrans();
}

function callByIngameUse(itemid,itemname,itemcategory,itemprice){
    pageTracker._trackPageview("/IngameUseSuccessful");
    t = parseInt(itemprice);
    t = t/100;
    orderid = "2";
  pageTracker._addTrans(
    orderid,                        
    "GameUse",                      
    t,
    "0",                            
    "0",                            
    "",                             
    "",                             
    ""                              
  );
  p = parseInt(itemprice);
  p = p/100;
  pageTracker._addItem(
    orderid,                                 
    itemid,                                  
    itemname,                                
    itemcategory,                            
    p,                               
    1
  );
  
  pageTracker._trackTrans();
}
</script>
<script type="text/javascript" src="/sEvonyAdvS2.php?t=2"></script>

<script type="text/javascript">
try { 
var pageTracker = _gat._getTracker("UA-8579166-1");
pageTracker._setDomainName(".evony.com");
pageTracker._setAllowLinker(true);
pageTracker._setAllowHash(false);
pageTracker._trackPageview ();
} catch(err) {}
//callByIngameBuy("1234",500.99,"4321","name test","category test",509.99,5);
</script>

<!-- This's google analytics code end-->

</html>
 

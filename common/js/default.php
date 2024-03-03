<script language="javascript">
		  <!--

function GoPage(code) {
	if ( !code )						{	window.location = "/";	}
	
	
	else if ( code == "main" )			{	window.location = "<?=$main?>";		}
	
	
	//1. 회사소개
	else if ( code == "info01" )		{	window.location = "<?=$info01?>"; }  // 인사말
	else if ( code == "info02" )		{	window.location = "<?=$info02?>"; }  // 찾아오시는 길

	//2. 개인회생파산
	else if ( code == "bankrupt01" )		{	window.location =  "<?=$bankrupt01?>"; } // 
	else if ( code == "bankrupt02" )		{	window.location =  "<?=$bankrupt02?>"; } //
	else if ( code == "bankrupt03" )		{	window.location =  "<?=$bankrupt03?>"; } //
	else if ( code == "bankrupt04" )		{	window.location =  "<?=$bankrupt04?>"; } //
	else if ( code == "bankrupt05" )		{	window.location =  "<?=$bankrupt05?>"; } //
	else if ( code == "bankrupt06" )		{	window.location =  "<?=$bankrupt06?>"; } // 
		
	//3. 고액채무자회생
	else if ( code == "liable01" )		{	window.location = "<?=$liable01?>"; } //  
	else if ( code == "liable02" )		{	window.location = "<?=$liable02?>"; } //  
	else if ( code == "liable03" )		{	window.location = "<?=$liable03?>"; } // 
	else if ( code == "liable04" )		{	window.location = "<?=$liable04?>"; } // 
	
	//4. 면책누락채무
	else if ( code == "exemption01" )		{	window.location = "<?=$exemption01?>"; } // 
	
	//5. 고객센터
	else if ( code == "cus01" )		{	window.location = "<?=$cus01?>"; } // 
	else if ( code == "cus02" )		{	window.location = "<?=$cus02?>"; } //
	else if ( code == "cus03" )		{	window.location = "<?=$cus03?>"; } //
	else if ( code == "cus04" )		{	window.location = "<?=$cus04?>"; } //  
	
	
	else if ( code == "sitemap" )		{	window.location = "<?=$sitemap?>"; } // 






}


function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function open_win(val, wname, wopt, menu) {
	var newopt = "", wHeight = 0, wWidth = 0;
	if (wopt != undefined) {
		var woptlist = wopt.replace(/ /g, "").split(",");
		for (var i in woptlist) {
			if (woptlist[i].match(/^height=/i)) {
				wHeight = parseInt(woptlist[i].substr(7),10);
				if (!isNaN(wHeight)) newopt += "top=" + Math.floor((screen.availHeight - wHeight) / 2) + ",";
			}
			if (woptlist[i].match(/^width=/i)) {
				wWidth = parseInt(woptlist[i].substr(6),10);
				if (!isNaN(wWidth)) newopt += "left=" + Math.floor((screen.availWidth - wWidth) / 2) + ",";
			}
		}
	}

	url = val + "?" + menu;
	window.open(url, wname, newopt + wopt); 
} 

// 레이어 스크롤 되는 소스
var bNetscape4plus = (navigator.appName == "Netscape" && navigator.appVersion.substring(0,1) >= "4");
var bExplorer4plus = (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.substring(0,1) >= "4");
function CheckUIElements(){
        var yMenuFrom, yMenuTo, yButtonFrom, yButtonTo, yOffset, timeoutNextCheck;

        if ( bNetscape4plus ) { 
                yMenuFrom   = document["divMenu"].top;
                yMenuTo     = top.pageYOffset + 62;
        }
        else if ( bExplorer4plus ) {
                yMenuFrom   = parseInt (divMenu.style.top, 10);
                yMenuTo     = document.body.scrollTop + 230;//레이어의 top값은 페이지 열었을때 슬라이딩 시작점이고 여기 옆에 숫자는 최종적으로 탑으로부터 도착하는 곳
        }

        timeoutNextCheck = 0;

        if ( Math.abs (yButtonFrom - (yMenuTo + 152)) < 6 && yButtonTo < yButtonFrom ) {
                setTimeout ("CheckUIElements()", timeoutNextCheck);
                return;
        }

        if ( yButtonFrom != yButtonTo ) {
                yOffset = Math.ceil( Math.abs( yButtonTo - yButtonFrom ) / 10 );
                if ( yButtonTo < yButtonFrom )
                        yOffset = -yOffset;

                if ( bNetscape4plus )
                        document["divLinkButton"].top += yOffset;
                else if ( bExplorer4plus )
                        divLinkButton.style.top = parseInt (divLinkButton.style.top, 10) + yOffset;

                timeoutNextCheck = 10;
        }
        if ( yMenuFrom != yMenuTo ) {
                yOffset = Math.ceil( Math.abs( yMenuTo - yMenuFrom ) / 20 );
                if ( yMenuTo < yMenuFrom )
                        yOffset = -yOffset;

                if ( bNetscape4plus )
                        document["divMenu"].top += yOffset;
                else if ( bExplorer4plus )
                        divMenu.style.top = parseInt (divMenu.style.top, 10) + yOffset;

                timeoutNextCheck = 10;
        }

        setTimeout ("CheckUIElements()", timeoutNextCheck);
}

function OnLoad()
{
        var y;
        if ( top.frames.length )
        if ( bNetscape4plus ) {
                document["divMenu"].top = top.pageYOffset + 50;//웹에 띄웠을때 시작점
                document["divMenu"].visibility = "visible";
        }
        else if ( bExplorer4plus ) {
                divMenu.style.top = document.body.scrollTop + 230;//웹에 띄웠을때 시작점
                divMenu.style.visibility = "visible";
        }
        CheckUIElements();
        return true;
}

//-->

//팝업
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->

var iframeids=["myframe"] // iframe 에 사용할 ID 를 지정 해 주세요 

var iframehide="yes" 

function resizeCaller() { 
var dyniframe=new Array() 
for (i=0; i<iframeids.length; i++){ 
if (document.getElementById) 
resizeIframe(iframeids[i]) 
if ((document.all || document.getElementById) && iframehide=="no"){ 
var tempobj=document.all? document.all[iframeids[i]] : document.getElementById(iframeids[i]) 
tempobj.style.display="block" 
} 
} 
} 

function resizeIframe(frameid){ 
var currentfr=document.getElementById(frameid) 
if (currentfr && !window.opera){ 
currentfr.style.display="block" 
if (currentfr.contentDocument && currentfr.contentDocument.body.offsetHeight) //ns6 syntax 
currentfr.height = currentfr.contentDocument.body.offsetHeight; 
else if (currentfr.Document && currentfr.Document.body.scrollHeight) //ie5+ syntax 
currentfr.height = currentfr.Document.body.scrollHeight; 
if (currentfr.addEventListener) 
currentfr.addEventListener("load", readjustIframe, false) 
else if (currentfr.attachEvent) 
currentfr.attachEvent("onload", readjustIframe) 
} 
} 

function readjustIframe(loadevt) { 
var crossevt=(window.event)? event : loadevt 
var iframeroot=(crossevt.currentTarget)? crossevt.currentTarget : crossevt.srcElement 
if (iframeroot) 
resizeIframe(iframeroot.id); 
} 

function loadintoIframe(iframeid, url){ 
if (document.getElementById) 
document.getElementById(iframeid).src=url 
} 

if (window.addEventListener) 
window.addEventListener("load", resizeCaller, false) 
else if (window.attachEvent) 
window.attachEvent("onload", resizeCaller) 
else 
window.onload=resizeCaller 

</script>
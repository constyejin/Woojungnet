<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {font-size: 12px}
-->
</style>
<script language='javascript' src='Object.js'></script>
<link rel="stylesheet" href="/css/admin.css" type="text/css">
<link rel="stylesheet" href="/css/style.css" type="text/css">
<title>SKRCAUTO</title>

<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<style type="text/css">
<!--
.style4 {color: #0033CC}
-->
</style>
<?
if(!$pno) $c1 = '<font color="#0066FF">';
if($pno==1) $c2 = '<font color="#0066FF">';
if($pno==2) $c3 = '<font color="#0066FF">';
if($pno==3) $c4 = '<font color="#0066FF">';
if($pno==4) $c5 = '<font color="#0066FF">';
if($pno==5) $c6 = '<font color="#0066FF">';
if($pno==6) $c7 = '<font color="#0066FF">';
?>
<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0">
<table cellpadding="10" cellspacing="0"  width='100%' align='center' >
  <tr>
    <td height="30" align="center" bgcolor="2159e7" style="border-bottom:1px solid #909090"><span class="style1">폐차관리</span></td>
  </tr>
   <tr>
    <td style="padding-left:15px;" align="left" valign="top" class='b_line b style2'><span id="Menu1"><a href="/manage/Sale10/Sale_list4.php"><img src="/images/dot.gif" border="0" /><?=$c4?>입고등록</font></a></span> </td>
  </tr>
  <tr>
    <td align="left" valign="top" class='b_line b style2' style="padding-left:15px;"><span id="Menu2"><a href="/manage/Sale10/Sale_list.php"><img src="/images/dot.gif" border="0" /><?=$c1?>입고관리</font></a></span> </td>
  </tr>
  <tr>
    <td align="left" valign="top" class='b_line b style2' style="padding-left:15px;"><span id="Menu2"><a href="/manage/Sale10/Sale_list5.php"><img src="/images/dot.gif" border="0" /><?=$c5?>업체관리</font></a></span> </td>
  </tr>
  <tr>
	<td height="20"></td>
  </tr>
  <tr>
    <td height="30" align="center" bgcolor="2159e7" style="border-bottom:1px solid #909090"><span class="style1">결제관리</span></td>
  </tr>
 <tr>
    <td align="left" valign="top" class='b_line b style2' style="padding-left:15px;"><span id="Menu2"><a href="/manage/Sale10/Sale_list7.php"><img src="/images/dot.gif" border="0" /><?=$c7?>결제요청목록</font></a></span> </td>
  </tr>
 <tr>
    <td align="left" valign="top" class='b_line b style2' style="padding-left:15px;"><span id="Menu2"><a href="/manage/Sale10/Sale_list6.php"><img src="/images/dot.gif" border="0" /><?=$c6?>일일결제내역</font></a></span> </td>
  </tr>
 <tr>
    <td align="left" valign="top" class='b_line b style2' style="padding-left:15px;"><span id="Menu2"><a href="/manage/Sale10/Sale_list2.php"><img src="/images/dot.gif" border="0" /><?=$c2?>미결(잔액남음)</font></a></span> </td>
  </tr>
   <tr>
    <td align="left" valign="top" class='b_line b style2' style="padding-left:15px;"><span id="Menu2"><a href="/manage/Sale10/Sale_list3.php"><img src="/images/dot.gif" border="0" /><?=$c3?>초과결제목록</font></a></span> </td>
  </tr>
  <!--tr>
    <td style="padding-left:15px;" align="left" valign="top" class='b_line b style2'><span id="Menu1"><a href="/manage/Sale10/Sale_list4.php"><img src="/images/dot.gif" border="0" /><?=$c4?>입고등록</font></a></span> </td>
  </tr-->
  <tr>
    <td height="7"></td>
  </tr>
  <tr>
</table>
</body>
</html>
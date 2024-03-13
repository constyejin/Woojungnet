<?
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';

if($loginUsort != "admin" && $loginUsort != "admin2" && $loginUsort != "superadmin"){
	movepage("/index.php", "관리자 로그인이 필요합니다.");
	MsgMov("관리자 로그인이 필요합니다.","/index.php");
	exit;
}

$salehigh = str_replace(",", "", $salehigh);
$salelow = str_replace(",", "", $salelow);

$sang1=str_replace(",","",$sang1);
$sang2=str_replace(",","",$sang2);
$sang3=str_replace(",","",$sang3);
$sang4=str_replace(",","",$sang4);
$sang5=str_replace(",","",$sang5);
$charge01=str_replace(",","",$charge01);
$charge02=str_replace(",","",$charge02);
$charge03=str_replace(",","",$charge03);
$charge04=str_replace(",","",$charge04);
$charge05=str_replace(",","",$charge05);
$charge06=str_replace(",","",$charge06);
$charge07=str_replace(",","",$charge07);
$charge08=str_replace(",","",$charge08);

$bankno=$bankno1."/".$bankno2."/".$bankno3;

if($_SESSION["login_id"]=="drg1038"){
	$sql_sms=" sms_certify='$sms_certify', ";
}

$sql="update js_webconfig set 
			$sql_sms 
			admin_ip='$admin_ip',
			saleper1='$saleper1', 
			saleper2='$saleper2', 
			recom_ok='$recom_ok',
			bankno='$bankno',
			shop_onlineno='$shop_onlineno',
			extitle='$extitle',
			shop_cname='$shop_cname',
			homeurl='$homeurl',
			shop_name='$shop_name',
			owner_name='$owner_name',
			office_num='$office_num',
			webmaster='$webmaster',
			com_num='$com_num',
			fax_num='$fax_num',
			admin_email='$admin_email',
			webmaster_mail='$webmaster_mail',
			address='$address',
			jeju='$jeju',
			transport='$transport',
			average_m='$average_m',
			milageper='$milageper',
			join_milage='$join_milage',
			meach='$meach',
			login_point='$login_point',
			can_milage='$canuse',
			 inload_1='$inload1',
			inload_2='$inload2',
			 inload_3='$inload3',
			inload_4='$inload4',
			 inload_5='$inload5',
			inload_6='$inload6',
			sms_id='$sms_id',
			sms_pass='$sms_pass',
			sang1='$sang1',
			sang2='$sang2',
			sang3='$sang3',
			sang4='$sang4',
			sang5='$sang5',
			sale_percent='$salepercent',
			sale_percent1='$salepercent1',
			sale_highprice='$salehigh',
			sale_lowprice='$salelow',
			sale_memo='$salememo', 
			charge01='$charge01', 
			charge02='$charge02', 
			charge03='$charge03', 
			charge04='$charge04', 
			charge05='$charge05', 
			charge06='$charge06', 
			charge07='$charge07', 
			charge08='$charge08' 

	where no='1'";


mysql_query($sql) or die(mysql_error());
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
alert('수정되었습니다.');
history.back();
//-->
</SCRIPT>
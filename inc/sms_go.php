<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include $dir.'/lib/session.php';
include $dir.'/lib/basicdb.class.php';
include $dir.'/lib/scriptAlert.class.php';

$db		= new basicdb();
$script = new scriptAlert();

$data=mysql_fetch_array(mysql_query("select * from js_webconfig where no=1"));
$sms_f=str_replace("-","",$data[sms_number]);
$sms_p=$sms_1.$sms_2.$sms_3;
$sms_p2=$sms_1."-".$sms_2."-".$sms_3;

$query="insert into sms_list set 
				sms_number='$data[sms_number]', 
				sms_go='$sms_p2', 
				memo='$memo', 
				ip='$_SERVER[REMOTE_ADDR]', 
				regdate=now()
				";
mysql_query($query) or die(mysql_error());
?>

<form method="post" name="sendsms" action="http://cpsms.skysms.co.kr/cpsms/cp_sms_send.php">
<input type="hidden" name="cpuserid" value="<?=$data[sms_id]?>">
<input type="hidden" name="passwd" value="<?=$data[sms_pass]?>">
<input type="hidden" name="destination" value="<?=$sms_f?>">
<input type="hidden" name="callback" value="<?=$sms_p?>">
<input type="hidden" name="body" value="<?=$memo?>">  <!--내용-->
<input type="hidden" name="reserve_date" value=""> <!-- 예약전송일 경우, 전송일시를 입력하세요. -->
<input type="hidden" name="return_url" value="http://<?=$_SERVER['SERVER_NAME']?>">
<input type="hidden" name="cpdata1" value="">
<input type="hidden" name="cpdata2" value="">
<input type="hidden" name="cpdata3" value="">
</form>

<SCRIPT LANGUAGE="JavaScript">
alert('SMS가 발송되었습니다.');
document.sendsms.submit();
</SCRIPT>

<?
$db->dbclose();
?>
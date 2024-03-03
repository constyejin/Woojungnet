<?php
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';


	$sSQL .= "	update sms set						
				number='$number', 
				auto1='$auto1',
				auto2='$auto2',
				auto3='$auto3', 
				auto4='$auto4', 
				auto5='$auto5'
				where idx='1'
			";
	$result = mysql_query($sSQL);

		MsgMov("수정 되었습니다.","sms.php");
?>
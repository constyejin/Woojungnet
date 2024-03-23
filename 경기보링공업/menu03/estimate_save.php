<?
include "../inc/header.php";

if(!$con_name||!$con_phone||!$spam_input){
	msg('고객명, 연락처, 스팸방지 숫자를 입력해 주세요.');
	exit;
}

if(preg_match('/[0-9]/',$con_name)>0 || preg_match('/[a-zA-Z]/',$con_name) > 0){
	msg('이름은 한글로 입력해 주세요.');
	exit;
}

$query="insert into consult set 
consult_name='$con_name', 
consult_phone='$con_phone', 
consult_email='$con_email', 
consult_memo='$con_memo', 
consult_model='$con_model', 
consult_year='$con_year', 
consult_regdate=now() 
";
mysql_query($query);
alert_p('견적신청 되었습니다.','/');
?>
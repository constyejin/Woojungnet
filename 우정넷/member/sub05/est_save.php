<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";?>

<?
if(!$est_mobile1&&!$est_mobile2&&!$est_mobile3){
	exit;
}

$est_mobile=$est_mobile1."-".$est_mobile2."-".$est_mobile3;


if($_POST[idx]){
	$query="update user set 
	".$upfile_2."
	user_type1='$type1', 
	user_type2='$type2', 
	user_type3='$type3', 
	com_name='$_POST[com_name]', 
	mobile='$mobile', 
	co_date='$co_date', 
	op_date='$op_date', 
	ftp_id='$ftp_id', 
	ftp_pass='$ftp_pass', 
	db_id='$db_id', 
	db_pass='$db_pass', 
	virtual_url='$virtual_url', 
	memo='$memo', 
	portfolio='$portfolio', 
	host_type='$host_type', 
	pay_type='$pay_type', 
	tax_bill='$tax_bill', 
	pay_date='$pay_date', 
	cost1='$cost1', 
	cost2='$cost2', 
	cost3='$cost3', 
	cost4='$cost4', 
	cost5='$cost5'  
	where idx='$_POST[idx]'
	";
	mysql_query($query);
	msg("수정완료");
}else{
	$query="insert into est set 
	est_name='$est_name', 
	est_mobile='$est_mobile', 
	type1='$type1', 
	pay='$pay', 
	type2='$type2', 
	site1='$site1', 
	site2='$site2', 
	site3='$site3', 
	memo='$memo', 
	regdate=now()  
	";
	mysql_query($query)or die(mysql_error()); 
	alert_p("온라인견전문의가 등록 되었습니다.","/");
}
?>


<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
$k=10-$_POST[idx];

$user_mobile=$_POST[user_mobile1][$k]."-".$_POST[user_mobile2][$k]."-".$_POST[user_mobile3][$k];

if($_POST[idx]){
	$query="update member set 
	user_name='".$_POST[user_name][$k]."', 
	user_id='".$_POST[user_id][$k]."', 
	user_pass='".$_POST[user_pass][$k]."', 
	user_mobile='$user_mobile' 
	where idx='$_POST[idx]'
	";
	mysql_query($query);
	msg("수정완료");
    echo "<script language='JavaScript'> parent.document.location.reload(); </script>";
}else{
	$query="insert into user set 
	$upfile_2
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
	cost5='$cost5', 
	user_id='$_SESSION[user_id]', 
	regdate=now()  
	";
	mysql_query($query);
	alert_p("등록완료","sub01.php");
}
?>


<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
if($plan_type=="1"){
	$pday=$pday1;
	$pmonth="";
}else if($plan_type=="2"){
	$pday=$pday2;
}

if($_POST[idx]){
	$query="update plan set 
	plan_type='$plan_type', 
	pmonth='$pmonth', 
	pday='$pday', 
	title='$_POST[title]', 
	memo='$memo'   
	where idx='$_POST[idx]'
	";
	mysql_query($query);
	alert_p("수정완료","sub01.php");
}else{
	$query="insert into plan set 
	plan_type='$plan_type', 
	pmonth='$pmonth', 
	pday='$pday', 
	title='$_POST[title]', 
	memo='$memo',   
	user_id='$_SESSION[user_id]', 
	regdate=now()  
	";
	mysql_query($query);
	alert_p("등록완료","sub01.php");
}
?>


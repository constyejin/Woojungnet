  
<?
	include"../inc/Func.php";
	$connect = dbconn();

$qry = "select count(userNick) from woojung_member where userNick = '$_POST[userNick2]'";
$res = mysql_query($qry);
$row = mysql_fetch_row($res);
$num_nicname = $row[0];
if($num_nicname==0){
	echo '<script>	parent.join.nicchk_value.value="1";parent.document.getElementById("u_nicname_check").innerHTML="[사용가능]";</script>';
//	alert_message('사용할 수 있습니다.');
}else{
	echo '<script>	parent.join.nicchk_value.value="0";parent.document.getElementById("u_nicname_check").innerHTML="[사용불가]";</script>';
//	alert_message('사용할 수 없습니다.');
}
?> 
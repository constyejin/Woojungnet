  
<?
	include"../inc/Func.php";
	$connect = dbconn();


$qry = "select count(userId) from woojung_member where userId = '$userId'";
$res = mysql_query($qry,$connect);
$row = mysql_fetch_row($res);
$id_check = $row[0];
echo $qry ;

echo $id_check ;
if($id_check==0&&strlen($userId)>5){
	echo '<script>	parent.join.idchk_value.value="1";parent.document.getElementById("u_id_check").innerHTML="[사용가능]";</script>';
//	alert_message('사용할 수 있습니다.');
}else{
	echo '<script>	parent.join.idchk_value.value="0";parent.document.getElementById("u_id_check").innerHTML="[사용불가1]";</script>';
//	alert_message('사용할 수 없습니다.');
}
?> 
<?
	include "../../inc/Func.php";
	$connect = dbconn();

	if($loginUsort == "superadmin" || $loginUsort == "admin" || $loginUsort == "admin1" || $loginUsort == "admin2" || $loginUsort == "admin3" || $loginUsort == "jisajang2" ){
		if($loginId!="drg1038"){
			$row = mysql_fetch_array(mysql_query("SELECT * FROM woojung_member WHERE userId='$loginId'"));
			$query="insert into admin_log set 
			userId='$row[userId]', 
			userName='$row[name]', 
			userCode='$row[code]', 
			ip='".$_SERVER['REMOTE_ADDR']."', 
			regdate=now()
			";
			mysql_query($query) or die(mysql_error()); 
		}
		echo "<script>parent.location.href='/manage/Sale02/Sale_list.php';</script>";
	}

?>
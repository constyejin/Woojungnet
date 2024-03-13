<?
	include_once "../inc/header.php"; 
	$connect = dbconn();
	
	$dir = $_SERVER['DOCUMENT_ROOT'];
	include $dir.'/lib/scriptAlert.class.php';
	$script = new scriptAlert();
	
	if(!$_POST['wc_idx']) $script->alert('idx값이 존재하지않습니다');
	

	$sql = " insert into woojung_car_comment (wc_idx, wcc_memo, wcc_regdate, wcc_userid, wcc_username) values (";
	$sql .= " '{$wc_idx}', '{$caringMemo}', now() , '$loginId', '$loginName')";

	$result = mysql_query($sql, $connect) or die(mysql_error());
	if(!$result){
		msg("메모 추가시 오류가 발생했습니다. 잠시후 다시 시도해주세요!");
	}
	$qry = "select * from woojung_car where wc_idx = '$wc_idx'  ";
	$row = mysql_fetch_array(mysql_query($qry));
	if($row[wc_prog_cgood]=="Y"){
		$connect = mysql_connect("175.125.94.172","kaic_r","q1w2e3r4") or die("에러 : 디비 연결 오류 입니다."); 
		mysql_select_db("kaic",$connect) or die("에러 : 데이터 베이스 선택 오류 입니다."); 
		$result = mysql_query($sql, $connect) or die(mysql_error());
	}
	
	ParentReload();
	exit;
?>
<?
	include_once "../inc/header.php"; 
	$connect = dbconn();
	
	$dir = $_SERVER['DOCUMENT_ROOT'];
	include $dir.'/lib/scriptAlert.class.php';
	$script = new scriptAlert();
	
	
	if(!$_REQUEST['wc_idx'])$script->alert('idx값이 존재하지않습니다');
	if(!$_REQUEST['wcc_idx'])$script->alert('idx값이 존재하지않습니다');
	
	$dsql = "delete from woojung_car_comment where wc_idx=".$wc_idx." and  wcc_idx=".$wcc_idx;
	$result = mysql_query($dsql, $connect) or die(mysql_error());
	if(!$result){
		msg("삭제시 오류가 발생했습니다. 잠시후 다시 시도해주세요!");
	}else{
		$script->alert("해당 코멘트가 삭제 되었습니다.");
		exit;
	}

	@mysql_close($connect);

?>
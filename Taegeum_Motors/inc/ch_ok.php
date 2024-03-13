<?php 
include $_SERVER['DOCUMENT_ROOT']."/lib/session.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/basicdb.class.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/scriptAlert.class.php";


$db		= new basicdb();
$script = new scriptAlert();

$mode = $_POST['wc_idx'];
if(!$mode)$script->alert('잘못된 접근입니다');


if($wc_idx) {

		$sql = "update woojung_car set ";
		$sql.= " ch_ok			= '1' ";
		$sql.= " where wc_idx = '$wc_idx' ";
		
		$result = $db->query($sql);
}

?>
<script>
	alert("발급에 성공하였습니다");
//	parent.window.close();
//parent.document.location.href="/mypage/sub04.php";
</script>
<?
$db->dbclose();
?>

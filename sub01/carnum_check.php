<? 
	include $_SERVER['DOCUMENT_ROOT']."/inc/Func.php";
	$connect = dbconn();
	
	#아이디를 찾아 보자
	$result = Row_string("SELECT * FROM woojung_car WHERE wc_no = '$carno'");
	if(!$result){
?>
<script>
	alert('등록가능한 차량번호 입니다.');
</script>
<?
	} else {
?>
<script>
	alert('중복된 차량번호 입니다.');
</script>
<?
	}
	
?>

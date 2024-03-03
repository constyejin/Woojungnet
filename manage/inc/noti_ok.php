<?
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';

$query="update js_webconfig set noti='$noti' where no=1";
mysql_query($query);
?>

<script>
alert('수정완료');
</script>
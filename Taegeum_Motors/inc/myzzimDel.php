<?
include_once '../lib/session.php'; 

$sql="select * from car_zzim where no='".$_POST["no"]."' and userid='".$_POST['userid']."'";
$que=mysql_query($sql);
$row=mysql_fetch_array($que);
if($row[idx]){
	@mysql_query("delete from car_zzim where no='".$_POST["no"]."' and userid='".$_POST['userid']."'");
	echo "<script>alert('찜목록에서 삭제되었습니다.');parent.location.reload();</script>";
	exit;
} else {
	echo "<script>alert('오류.');</script>";
	exit;
}
?>
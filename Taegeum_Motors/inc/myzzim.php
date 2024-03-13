<?
include_once '../lib/session.php'; 

$sql="select * from car_zzim where no='".$_POST["no"]."' and userid='".$_POST['userid']."'";
$que=mysql_query($sql);
$row=mysql_fetch_array($que);
if(!$row[idx]){
	@mysql_query("insert into car_zzim values('','".$_POST['userid']."','".$_POST["no"]."',now())");
	echo "<script>alert('찜목록에 저장되었으며 마이페이지에서 확인가능합니다.');parent.location.reload();</script>";
	exit;
} else {
	echo "<script>alert('이미 찜하신 목록입니다.');</script>";
	exit;
}
?>
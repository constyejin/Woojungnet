<?
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';


$sql = "select imgfile from home_main where idx = ".$idx;
$r = mysql_query($sql);
$data = mysql_fetch_assoc($r);

@unlink("$dir/mainimg/".$data["imgfile"]);


$query="delete from home_main where idx=$idx ";
mysql_query($query)or die(mysql_error());
?>

<script>
history.back();
</script>
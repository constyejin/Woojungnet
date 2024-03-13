<?
include $_SERVER['DOCUMENT_ROOT']."/inc/lib.php";

// 카운터
include_once $_SERVER[DOCUMENT_ROOT]."/inc/counter.php";
if(!$_SESSION[counter_ip]){
	$_SESSION[counter_ip]=$_SERVER['REMOTE_ADDR'];
	$sql_ip="select * from counter where counter_ip='$_SESSION[counter_ip]' and counter_date='".date("Y-m-d")."' ";
	$result_ip=mysql_query($sql_ip);
	$data_ip=mysql_fetch_array($result_ip);
	if(!$data_ip[idx]){
		$query_ip="insert into counter set counter_ip='$_SESSION[counter_ip]' , counter_date='".date("Y-m-d")."'";
		mysql_query($query_ip);
	}
}

$web_config=sql_fetch("select * from web_config where idx=1 ");
?>

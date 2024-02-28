<?
/*
	2008-09-04 김은성
	공통 파일 인클루드
*/

ini_set("session.gc_maxlifetime", "43200");

// 공통 함수
require_once $_SERVER['DOCUMENT_ROOT']. "/lib/config.php";


// 공통 함수
require_once LIB_ROOT. "/func.php";

// 공통 배열 관련
require_once LIB_ROOT. "/code.php";



// Session 관련
require_once HTML_ROOT. "/lib/session_main.php";


session_start();

dbconn();

// 종료일 지나면 구분4 완료로
$nowDate = date("YmdHi");
$sql_end="select * from woojung_car as a left join woojung_car_go as b on a.wc_idx = b.wcg_wcidx where a.wc_gubun4='2' and concat(REPLACE (b.wc_go_end_date, '-', ''), b.wc_go_end_hh , b.wc_go_end_mm) <= '$nowDate' ";
$result_end=mysql_query($sql_end)or die(mysql_error()); 
while($data_end=mysql_fetch_array($result_end)){
	$query="update woojung_car set wc_gubun4='3' where wc_idx='$data_end[wc_idx]' ";
	mysql_query($query) or die(mysql_error()); 
}

if($pc){
	$_SESSION[pc_ok]="1";
}


$mobileBrower = '/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/';
if(preg_match($mobileBrower, $_SERVER['HTTP_USER_AGENT'])) {
	if($_SESSION[pc_ok]!="1"){
		echo "<script>location.href='http://m.skrcauto.co.kr/';</script>";
	}
} else {
	$dataType = 'pc';
}

?>

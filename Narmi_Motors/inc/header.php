<?
include $_SERVER['DOCUMENT_ROOT']."/inc/lib.php";

// д╚©Нем
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
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="/front/src/js/script.js"></script>
  <script src="/inc/script.js"></script>

  <!-- swiper.js -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
  
  <link rel="stylesheet" href="/front/src/css/style.css">
  <title><?=$web_config[web_sitename]?></title>
  <?=$web_config[web_meta]?>
</head>
<body>
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>

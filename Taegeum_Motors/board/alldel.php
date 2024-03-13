<?
require "../lib/config.php";
require "$setup/dbconn.php";
require "$setup/lib.php";

?>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Incaron</title>
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/common/css/base.css?v=221208"/>

	<link rel="stylesheet" type="text/css" href="/common/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="/common/css/add_style.css?v=2212081209"/>  <!-- 2022.11.25 css추가  -->
	<link rel="stylesheet" type="text/css" href="/common/css/incaron_style.css"/>  <!-- 2022.11.25 css추가  -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	
	<!-- swiper.js css-->
	<link
		rel="stylesheet"
		href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
	/>
	<!-- swiper.js js-->
	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <script src="/common/js/incaron_ui.js"></script>
  <script src="/common/js/front.js"></script>
</head>
<?

function movepage($url,$memo="",$nam="") {
	global $connect;

		$memo=str_replace("<br>","\\n",$memo);
		if ($url=="goback") { 
			echo "<script language='javascript'>";
			if ($memo) echo "alert('$memo');";
			echo "history.back();</script>";
		} elseif ($url=="close") {
			echo "<script language='javascript'>";
			if ($memo) echo "alert('$memo');";
			echo "window.close();</script>";
		} elseif ($url=="goback2") {
			echo "<script language='javascript'>";
			if ($memo) echo "alert('$memo');";
			echo "history.go(-2);</script>";
		} elseif ($url=="alert") {
		} elseif ($memo!="") echo "<script language='javascript'> alert('$memo'); </script>";

		if($connect) @mysql_close($connect);

		if ($nam=="top") echo "<script language='javascript'> top.location.href='$url';</script>";
		elseif ($url&&$url!="goback"&&$url!="goback2") echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
		
		if ($nam=="close") echo "<script language='javascript'> window.close();</script>";
		exit;
}

//접근 체크
//if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("잘못된 접근입니다.");

$no = $_POST[chk];
$id = $_POST[id];
$url = $_POST[url];


	
	$sql="delete from $id where no in (". @implode($no, ",") .")";
	@mysql_query($sql);

	movepage("board.php?id=".$id,"삭제 되었습니다.");
?>

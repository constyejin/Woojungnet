<?php
	
	include ($_SERVER['DOCUMENT_ROOT']."/inc/Func.php");
	$connect = dbconn();

	$query = iconv("UTF-8","CP949",$_POST["p_auct_idx"]); //DB가 EUC-KR의 경우 요청값이 UTF-8로 넘어온 것을 EUC-KR로 변환 
	$auct_idx = $_POST["p_auct_idx"]; // DB가 UTF-8의 경우는 그냥 받아서 처리하면됩니다. 


	$info = Row_string("select max(bid_price) as bid_price from woojung_bid where auct_key='$auct_idx'"); 	
	//echo "select max(bid_price) as bid_price from woojung_bid where auct_key='$auct_idx'";
	echo number_format($info[bid_price]);
?>
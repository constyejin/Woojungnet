<?
// 공통 함수
require "../lib/config.php";
require "$setup/dbconn.php";
require "$setup/lib.php";

$sql="select * from woojung_view where user_id='$loginId' ";

$result=mysql_query($sql);
$data=mysql_fetch_array($result);

$Qry = "SELECT * FROM 	woojung_car  as a
		left join woojung_member as b  on a.wc_mem_idx = b.idx 
		left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx	
		WHERE wc_idx=$data[car_no] ";

$query = mysql_query($Qry);
$row = mysql_fetch_array($query);

if($row[wc_gubun2]!="5"){
	$MaxQuery = mysql_query("select * from woojung_bid  where auct_idx = '$row[wc_orderno]' order by bid_price desc ");
}else{
	$MaxQuery = mysql_query("select * from woojung_bid  where auct_idx = '$row[wc_orderno]' order by bid_price asc ");
}
$selMax = mysql_fetch_array($MaxQuery);
$total_count=$selMax[bid_price];

echo $total_count;
?>

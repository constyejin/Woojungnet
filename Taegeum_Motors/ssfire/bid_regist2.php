<?

$dir = $_SERVER['DOCUMENT_ROOT'];
include $dir.'/lib/session.php';
include $dir.'/lib/basicdb.class.php';
include $dir.'/lib/scriptAlert.class.php';

$db		= new basicdb();
$script = new scriptAlert();

$mode = $_POST['mode'];
if(!$mode)$script->alert('잘못된 접근입니다');
if($mode == 'bid_regist'){
	if(!$_POST['idx'])$script->alert('idx값이 존재하지않습니다');
}

companyUpOnly();

if(!$user_level && (!$loginId || $_SESSION["loginUsort"]=="indi" || $_SESSION["loginUsort"]=="company1" || $_SESSION["loginUsort"]=="company2" || $_SESSION["loginUsort"]=="premium1" || $_SESSION["loginUsort"]=="premium3" || $_SESSION["loginUsort"]=="premium4") ){
	echo "<script>alert('사용 권한이 없습니다.');history.back();</script>";
	exit;
}

if(!$_POST[goSale]){
	$script->alertWin("입찰 유형을 선택해 주세요");
	exit;
}

if($mode == 'regist') {

	$qry ="select * from woojung_car as a 
			left join woojung_car_go as b on a.wc_idx = b.wcg_wcidx	
			where wc_idx = '$_POST[idx]'";
	
	$query = $db->query($qry);
	$row	= mysql_fetch_object($query);
	
	
	$now_date		= date("YmdHi");
	$end_time		= $row->wc_go_end_date;
	$year			= cutStr($end_time,0,4);
	$month			= cutStr($end_time,5,2);
	$day			= cutStr($end_time,8,2);
	$hour			= $row->wc_go_end_hh;
	$min			= $row->wc_go_end_mm;
	$last_end_date = $year.$month.$day.$hour.$min;


	if($now_date >= $last_end_date)
	{
		if(1){
			$script->alertWin("입찰이 종료되었습니다.");
		}
	}

	
	if($_POST['goSale']){
		$sale_type				= $_POST['goSale'];
	}else{
		$sale_type				= $row->wc_go_type;
	}	

	$bid_price				= str_replace(',','',$_POST['c_bid_price']);		// 입찰금액
	$bid_total_price		= str_replace(',','',$_POST['bid_total_price']);	// 기타비용(견인비등) 금액
	$succ_bid_sub_price		= str_replace(',','',$_POST['succ_bid_sub_price']); // 낙찰수수료
	$succ_etc_total_price	= str_replace(',','',$_POST['seo_price']); // 서류대행비
	$sang_price			= str_replace(',','',$_POST['sang_price']);		 // 상사이전비 
	$vat_price			= str_replace(',','',$_POST['vat_bid_price']);		 // 법인부가세
	$last_bid_price			= str_replace(',','',$_POST['last_bid_price']);		 // 낙찰시 결재하실 합계금액 
	
	
	$bid_rcpt_sort_date = date("YmdHis", mktime());

	
	$selQuery = $db->query("select * from woojung_bid  where auct_idx = '$row->wc_orderno' and userId = '".$_SESSION["loginId"]."' and sale_type='$sale_type' ");
	$selRow = mysql_fetch_row($selQuery);
	
	$query = mysql_query("select * from woojung_member where userId = '".$_SESSION["loginId"]."' limit 1");
	$member_new = mysql_fetch_array($query);
	
	// 입찰로그
	$sql = "insert into woojung_bid_log set ";
	$sql.= " auct_key			= '$row->wc_idx',";
	$sql.= " auct_idx			= '$row->wc_orderno',";
	$sql.= " userId				= '".$_SESSION["loginId"]."',";
	$sql.= " name				= '".$_SESSION["loginName"]."',";
	$sql.= " sale_type			= '$sale_type',";
	$sql.= " bid_price			= '$bid_price',";
	$sql.= " bid_total_price		= '$bid_total_price',";
	$sql.= " succ_bid_sub_price  = '$succ_bid_sub_price',";
	$sql.= " succ_etc_total_price = '$succ_etc_total_price',";
	$sql.= " sang_price  = '$sang_price',";
	$sql.= " vat_price  = '$vat_price',";
	$sql.= " total_price  = '$last_bid_price',";
	$sql.= " bid_rcpt_sort_date  = '$bid_rcpt_sort_date',";
	$sql.= " bid_name='$member_new[ceo_name]', ";
	$sql.= " bid_company='$member_new[company_name]', ";
	$sql.= " rdate			    = now()";
	$result = $db->query($sql);

	if(!$selRow[0])
	{	
			
		$sql = "insert into woojung_bid set ";
		$sql.= " auct_key			= '$row->wc_idx',";
		$sql.= " auct_idx			= '$row->wc_orderno',";
		$sql.= " userId				= '".$_SESSION["loginId"]."',";
		$sql.= " name				= '".$_SESSION["loginName"]."',";
		$sql.= " sale_type			= '$sale_type',";
		$sql.= " bid_price			= '$bid_price',";
		$sql.= " bid_total_price		= '$bid_total_price',";
		$sql.= " succ_bid_sub_price  = '$succ_bid_sub_price',";
		$sql.= " succ_etc_total_price = '$succ_etc_total_price',";
		$sql.= " sang_price  = '$sang_price',";
		$sql.= " vat_price  = '$vat_price',";
		$sql.= " total_price  = '$last_bid_price',";
		$sql.= " bid_rcpt_sort_date  = '$bid_rcpt_sort_date',";
		$sql.= " bid_name='$member_new[ceo_name]', ";
		$sql.= " bid_company='$member_new[company_name]', ";
		$sql.= " rdate			    = now()";
		
		$opener_bid_price = number_format($bid_price);
	
	
	
		$result = $db->query($sql);
	}
	else
	{
		$sql = "update woojung_bid set ";
		$sql.= " auct_key			= '$row->wc_idx',";
		$sql.= " auct_idx			= '$row->wc_orderno',";
		$sql.= " userId				= '".$_SESSION["loginId"]."',";
		$sql.= " name				= '".$_SESSION["loginName"]."',";
		$sql.= " sale_type			= '$sale_type',";
		$sql.= " bid_price			= '$bid_price',";
		$sql.= " bid_total_price		= '$bid_total_price',";
		$sql.= " succ_bid_sub_price  = '$succ_bid_sub_price',";
		$sql.= " succ_etc_total_price = '$succ_etc_total_price',";
		$sql.= " sang_price  = '$sang_price',";
		$sql.= " vat_price  = '$vat_price',";
		$sql.= " total_price  = '$last_bid_price',";
		$sql.= " bid_rcpt_sort_date  = '$bid_rcpt_sort_date',";
		$sql.= " bid_name='$member_new[ceo_name]', ";
		$sql.= " bid_company='$member_new[company_name]', ";
		$sql.= " rdate			    = now()";
		$sql.= " where auct_idx = '$row->wc_orderno' and userId = '".$_SESSION["loginId"]."' and sale_type='$sale_type' ";
		
		$opener_bid_price = number_format($bid_price);
	
		
	
		$result = $db->query($sql);
	}

	$msg = "입찰";
	$url = "opener.window.document.getElementById('my_bid_price').innerHTML = '".$opener_bid_price."';";
	
	if($result){
?>
<script>
	alert("<?=$msg?>에 성공하였습니다");
	parent.document.location.reload();
</script>
<?
	}else{
		$script->alertWin($msg."에 실패하였습니다");
	}
	
}			

$db->dbclose();
?>


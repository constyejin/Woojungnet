<?
include_once "../inc/header.php"; 
$connect = dbconn();

$ownernum = $ownernum1."-".$ownernum2;
$commnum = $commnum1."-".$commnum2;
$ownerphone = $ownerphone1."-".$ownerphone2."-".$ownerphone3;
$outphone = $outphone1."-".$outphone2."-".$outphone3;
$carym = $carym1."-".$carym2;
$progday = $progday1."-".$progday2."-".$progday3;
$stokeday= $stokeday1."-".$stokeday2."-".$stokeday3;
if($mode == "reg" || $mode == "mod"){
		if($mode == "reg") $sql = "insert into cardata1 set"; 
		if($mode == "mod") $sql = "update cardata1 set"; 
		
		if($mode == "reg"){
			$sql .= " set_idx1	  = '".$_SESSION[loginComNo]."',
					  set_idx2	  = '".$_SESSION[loginChargeNo]."',
					  regdate	  = '".time()."',
					  state	  = '1',";
		}

		$sql .= " carname	  = '$carname',
				carnum		  = '$carnum',
				carym	  = '$carym',
				oil	  = '$oil',
				sale_idx	  = '$sale_idx',
				charge	  = '$charge',
				saletype  = '$saletype',
				owner	  = '$owner',
				ownernum	  = '$ownernum',
				commname	  = '$commname',
				commnum	  = '$commnum',
				ownerphone	  = '$ownerphone',
				ownertype	  = '$ownertype',
				outcom	  = '$outcom',
				outphone	  = '$outphone',
				outadd	  = '$outadd',
				outetc	  = '$outetc',
				stokeor	  = '$stokeor',
				stoketype	  = '$stoketype',
				numpan	  = '$numpan',
				collateral	  = '$collateral',
				junkcar	  = '$junkcar',
				stokeday	  = '$stokeday',
				progday	  = '$progday',
				reglicence	  = '$reglicence',
				seize	  = '$seize',
				consulnum	  = '$consulnum',
				carbody	  = '".str_replace(",","",$carbody)."'";
				if($mode == "mod"){
					$sql .= ", moddate	  = '".time()."'"; 
					$sql .= " where idx=$caridx"; 
				}
				mysql_query($sql);
				//echo $sql."<br><br>";
				//exit;
if($mode == "reg"){
	$insert_idx = mysql_insert_id();
	for($i=1;$i<7;$i++){
		if(${"admcom_idx".$i} && ${"company".$i} && ${"callpay".$i}){
				$sql = "insert into cardata2 set 
				cardata_idx	  = '".$insert_idx."',
				admcom_idx		  = '".${"admcom_idx".$i}."',
				company	  = '".${"company".$i}."',
				payinfo	  = '".${"payinfo".$i}."',
				callpay	  = '".str_replace(",","",${"callpay".$i})."',
				cardiv	  = '".${"cardiv".$i}."',
				paydiv  = '1',
				cregdate	  = '".time()."'";
				mysql_query($sql);
				$totalcount = qrow("select count(idx) from cardata2 where admcom_idx='".${"admcom_idx".$i}."' and paydiv=1");
				$sumdivpay = qrow("select sum(callpay) from cardata2 where admcom_idx='".${"admcom_idx".$i}."' and paydiv=1");
				$sql2="update admcom set compay='$totalcount[0]',compay2='$sumdivpay[0]' where idx='".${"admcom_idx".$i}."' ";
				mysql_query($sql2);
				//echo $sql."<br>";
		}//end if
	}//end for
	//exit;
	$page = "Sale_list.php";
}
if($mode == "mod"){
	for($i=1;$i<=count($cardata2_idx);$i++){
		if(${"admcom_idx".$i} && ${"company".$i} && ${"callpay".$i}){
				$sql = "update cardata2 set 
				admcom_idx		  = '".${"admcom_idx".$i}."',
				company	  = '".${"company".$i}."',
				payinfo	  = '".${"payinfo".$i}."',
				callpay	  = '".str_replace(",","",${"callpay".$i})."',
				cardiv	  = '".${"cardiv".$i}."',
				cregdate	  = '".time()."' where idx=".$cardata2_idx[$i-1]."";
				mysql_query($sql);
				$totalcount = qrow("select count(idx) from cardata2 where admcom_idx='".${"admcom_idx".$i}."' and paydiv=1");
				$sumdivpay = qrow("select sum(callpay) from cardata2 where admcom_idx='".${"admcom_idx".$i}."' and paydiv=1");
				$sql2="update admcom set compay='$totalcount[0]',compay2='$sumdivpay[0]' where idx='".${"admcom_idx".$i}."' ";
				mysql_query($sql2);
				//echo $sql."<br><br>";
		}else{
			$sql="select * from cardata2 where idx='".$cardata2_idx[$i-1]."'";
			$data=qassoc($sql);
			mysql_query("delete from cardata2 where idx = '".$cardata2_idx[$i-1]."'");
			$totalcount = qrow("select count(idx) from cardata2 where admcom_idx='".$data[admcom_idx]."' and paydiv=1");
			$sumdivpay = qrow("select sum(callpay) from cardata2 where admcom_idx='".$data[admcom_idx]."' and paydiv=1");
			$sql2="update admcom set compay='$totalcount[0]',compay2='$sumdivpay[0]' where idx='".$data[admcom_idx]."' ";
			mysql_query($sql2);
		}
	}//end for

	for(;$i<7;$i++){
		if(${"admcom_idx".$i} && ${"company".$i} && ${"callpay".$i}){
				$sql = "insert into cardata2 set 
				cardata_idx	  = '".$caridx."',
				admcom_idx		  = '".${"admcom_idx".$i}."',
				company	  = '".${"company".$i}."',
				payinfo	  = '".${"payinfo".$i}."',
				callpay	  = '".str_replace(",","",${"callpay".$i})."',
				cardiv	  = '".${"cardiv".$i}."',
				cregdate	  = '".time()."'";
				mysql_query($sql);
				$totalcount = qrow("select count(idx) from cardata2 where admcom_idx='".${"admcom_idx".$i}."' and paydiv=1");
				$sumdivpay = qrow("select sum(callpay) from cardata2 where admcom_idx='".${"admcom_idx".$i}."' and paydiv=1");
				$sql2="update admcom set compay='$totalcount[0]',compay2='$sumdivpay[0]' where idx='".${"admcom_idx".$i}."' ";
				mysql_query($sql2);
				//echo $sql."<br><br>";
		}//end if
	}//end for
$page = "/admin/viewpay.php?caridx=$caridx";

}
	//exit;
}
//exit(var_dump("$caridx"));
if($mode == "paycancel"){
	mysql_query("update cardata2 set paydiv=1, paydate='',admbank='' WHERE idx='$idx2'");
	$sql="select * from cardata2 where idx='$idx2'";
	$data=qassoc($sql);
	$totalcount = qrow("select count(idx) from cardata2 where admcom_idx='".$data[admcom_idx]."' and paydiv=1");
	$sumdivpay = qrow("select sum(callpay) from cardata2 where admcom_idx='".$data[admcom_idx]."' and paydiv=1");
	$sql2="update admcom set compay='$totalcount[0]',compay2='$sumdivpay[0]' where idx='".$data[admcom_idx]."' ";
	mysql_query($sql2);
	$query="delete from day_result where admcom_idx='$data[admcom_idx]' ";
	mysql_query($query);
	$page = "/admin/pop_pay.php?caridx=$caridx";	
}


if($mode == "status"){
	mysql_query("update cardata1 set state='$sno' where idx='$idx'");
	$page = '/admin/calculate.php';	
}

if($mode=='alldel'){
	if(!$check){MsgMov("선택된것이 없습니다.","/admin/calculate.php");exit;}
		for($i=0;$i<count($check);$i++){
			$k=0;
			$qry = "SELECT * FROM cardata2 WHERE cardata_idx = '$check[$i]' ";
			$result=mysql_query($qry);
			while ($data5 = mysql_fetch_assoc($result)){
				$adi[$k]=$data5[admcom_idx];
				$k++;
			}
			mysql_query("delete from cardata1 WHERE idx = '$check[$i]'");
			mysql_query("delete from cardata2 WHERE cardata_idx = '$check[$i]'");
			for($k=0;$k<count($adi);$k++){
				$totalcount = mysql_fetch_array(mysql_query("select count(idx) from cardata2 where admcom_idx='".$adi[$k]."' and paydiv=1"));
				$sumdivpay = mysql_fetch_array(mysql_query("select sum(callpay) from cardata2 where admcom_idx='".$adi[$k]."' and paydiv=1"));
				$sql2="update admcom set compay='$totalcount[0]',compay2='$sumdivpay[0]' where idx='".$adi[$k]."' ";
				mysql_query($sql2);
			}
		}
		$page = 'Sale_list.php';	
}

if($mode == "memo"){
	mysql_query("insert into memo set memo='$contents',name='".$_SESSION[loginCharge]."',mdiv1=2,regdate='".time()."'");
	 $page = "/admin/comm_02.php";	
}
if($mode == "memodelete"){
	mysql_query("delete from memo where idx = '$midx'");
 $page = "/admin/comm_02.php";	
}

if($mode == "memoadd"){
	mysql_query("insert into memo set memo='$contents',name='".$_SESSION[loginCharge]."',mdiv1=1,mdiv2='$mdiv2',regdate='".time()."'");
	if($mod) $page = "/admin/viewpay_re.php?caridx=$mdiv2";
	else $page = "/admin/viewpay.php?caridx=$mdiv2";	
}
if($mode == "memodel"){
	mysql_query("delete from memo where idx = '$midx'");
	if($mod) $page = "/admin/viewpay_re.php?caridx=$mdiv2";
	else $page = "/admin/viewpay.php?caridx=$mdiv2";	
}
if($mode == "del"){
	mysql_query("delete from admcom where idx = '$idx'");
}
dbclose();
?>
<?if(!$page){
$page = 'Sale_list.php';	
}
?>
<script>
		parent.document.location.href=('<?=$page?>');
</script>


<?php
include $_SERVER['DOCUMENT_ROOT']."/lib/common.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/basicdb.class.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/scriptAlert.class.php"; 

if($loginId){  //로그인했을때만
 
	$script = new scriptAlert();
	$db		= new basicdb();
	$connect = dbconn();

	$wc_idx = $_REQUEST['wc_idx'];



if(!$wc_idx)
{
	$script->alert("잘못된 정보입니다");
	exit;
      
}
 


	// 출품자 정보를 불러온다.
	$Qry = "SELECT a.*, 
				b.team_code, b.team_name, b.team_subname, b.team_subname_etc ,
				b.company_tel, b.tel, b.pcs, b.fax, b.company_name, 
				b.company_sort, b.company_subsort , b.usort , c.* , d.bid_sort_date 
			FROM woojung_car as a 
				left join woojung_member as b  on a.wc_mem_idx = b.idx 
				left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx					
				left join woojung_bid as d on a.wc_idx = d.auct_key					
			WHERE a.wc_idx = '$wc_idx' ";

	$row = Row_string($Qry);

	$Qry2 = "SELECT * 
			FROM  woojung_bid 			
			WHERE auct_key = '$wc_idx' and bid_sort='Y' ";
	$row2 = Row_string($Qry2);

	// 제휴 회원이라면
	if( substr($row['usort'], 0, 3) == "com" ){
		$companyNm = $row[team_name];
		$companysubNm = $row[team_subname];
		$wc_mem_etc = $row[wc_mem_etc];	
		$companyInfo = $companyNm ." / ".$companysubNm;
	}else{ // 일반출품 or 구매회원
		$companyInfo = "";
		$wc_mem_etc = $row[wc_mem_etc];		
	}

	//낙찰자 구해오기
	$sql_bid=mysql_query("select * from woojung_bid where bid_sort='Y' and auct_key = '$wc_idx'");
//	echo "select * from woojung_bid where bid_sort='Y' and auct_key = '$wc_idx'";
	$bid=mysql_fetch_array($sql_bid);
//	echo $bid[userId];
    $sale_type = $bid[sale_type];
	if($bid[userId]){
		//낙찰자 회원정보 구해오기
		$bid_mem=mysql_fetch_array(mysql_query("select * from woojung_member where userId='".$bid[userId]."'"));
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/> 
<!--meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>경매품의서</title> 
<link rel='stylesheet' href='/common/css/adm_style.css' type='text/css'> 
<link rel='stylesheet' href='/common/css/admin_style.css' type='text/css'>
<script language="javascript" src="/common/js/default.js"></script>
 
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}

-->
</style>
 <body leftmargin="20" topmargin="10" marginwidth="20"  > 
<table width="100%"  border="0"  align="center">
	<tr align="center" bgcolor="#FFFFFF"> 
	   
		<td align="left" bgcolor="#FFFFFF" width="50%"> <span style='font-size:17px;'><strong>SKRC AUTO</strong></span> </td> 
	  <td align="right" bgcolor="#FFFFFF" width="50%"><a href="javascript:winprint();"> 인쇄하기</a></td> 
	</tr>  	 
</table>
<table width="100%"  border="0"  align="center">
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF" colspan="12" class="style5 style1"> 차량정산서  
		 </td> 
	</tr>  	
	<tr>
	  <td height="2" bgcolor="#666666"></td>
	</tr> 
	<tr>
	  <td height="15">&nbsp;</td>
	</tr> 
<?
if($row[car_cate]){
	$team_cate=mysql_fetch_array(mysql_query("select * from team_cate where idx='".$row[car_cate]."'"));
	$car_cate=$team_cate["name"];
} else {
	$car_cate="X";
}
if($row[car_cate2]){
	$team_cate2=mysql_fetch_array(mysql_query("select * from team_cate where idx='".$row[car_cate2]."'"));
	$car_cate2=$team_cate2["name"];
}
?>
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF" colspan="12" class="style7">
		<span class="style7"><strong>
		  <?=$row[wc_no]?> ㅣ  <?=$row[wc_model]?>  <?=$row[wc_model2]?"/ ".$row[wc_model2]:""?>  ㅣ <?=$car_cate?><?=$car_cate2?" / ".$car_cate2:""?>   ㅣ <?=$row[in_name]?>
		  </strong></span>
		 </td> 
	</tr> 
</table>

<font style="padding-left:5px;padding-top:15px;"><span class="style7"><strong>* 낙찰자정보</strong></span>  
<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#cccccc" >        
    <colgroup>
        <col width="8%">
        <col width="8%">
        <col width="8%">
        <col width="8%">
        <col width="8%"> 
        <col width="8%">
        <col width="8%">
        <col width="8%">
        <col width="8%">
        <col width="8%">
        <col width="8%">
        <col width="8%"> 
    </colgroup>    
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#f6f6f6" colspan="4" >낙찰자상호명</td>
		<td align="center" bgcolor="#f6f6f6" colspan="4" >낙찰일자</td>
		<td align="center" bgcolor="#f6f6f6" colspan="4" >낙찰유형</td> 
	</tr>  
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF"  colspan="4" ><?=$bid_mem[company_name]?></td>
		<td align="center" bgcolor="#FFFFFF"  colspan="4" ><?=substr($row2[bid_sort_date],0,10)?></td>
		<td align="center" bgcolor="#FFFFFF"  colspan="4" ><strong><?=WriteArrHTML('select', 'Sale', $ArrgoSale, $sale_type, '', '' , 'direct', '' );?></strong></td> 
	</tr> 
</table>
<br>
<font style="padding-left:5px;padding-top:15px;"><span class="style7"><strong>* 입출금정산</strong></span>  
<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#cccccc" >        
    <colgroup>
        <col width="20%">
        <col width="30%">
        <col width="20%">
        <col width="30%">
    </colgroup> 
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#f6f6f6">구분</td>
		<td align="center" bgcolor="#f6f6f6">입금금액</td>
		<td align="center" bgcolor="#f6f6f6" >구분</td>
		<td align="center" bgcolor="#f6f6f6" >출금금액</td> 
	</tr>
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF" >낙찰금액</td>
		<td align="center" bgcolor="#FFFFFF"  ><?=number($row[wc_accepted_priceA])?></td>
		<td align="center" bgcolor="#FFFFFF" >차대비</td>
		<td align="center" bgcolor="#FFFFFF"><?=number($row[wc_pay_cost1])?></td>
	</tr> 
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF" >부가세</td>
		<td align="center" bgcolor="#FFFFFF"><?=number($row[wc_accepted_priceB])?></td>
		<td align="center" bgcolor="#FFFFFF" >부가세</td>
		<td align="center" bgcolor="#FFFFFF" ><?=number($row[wc_pay_cost6])?></td>
	</tr> 
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF" >수수료</td>
		<td align="center" bgcolor="#FFFFFF"  ><?=number($row[wc_accepted_priceC])?></td>
		<td align="center" bgcolor="#FFFFFF" >기타비용</td>
		<td align="center" bgcolor="#FFFFFF" ><?=number($row[wc_pay_cost5])?></td>
	</tr> 
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF">대지급금</td>
		<td align="center" bgcolor="#FFFFFF">
		<?=number($row[wc_accepted_priceD])?>
		</td>
		<td align="center" bgcolor="#FFFFFF"  >대지급금</td>
		<td align="center" bgcolor="#FFFFFF" ><?=number($row[wc_pay_cost2]+$row[wc_pay_cost3]+$row[wc_pay_cost4])?></td>
	</tr> 
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF"  >상사이전비</td>
		<td align="center" bgcolor="#FFFFFF" ><?=number($row[wc_accepted_priceE])?></td>
		<td align="center" bgcolor="#FFFFFF"><?=$row[wc_pay_title7]?></td>
		<td align="center" bgcolor="#FFFFFF" ><?=number($row[wc_pay_cost7])?></td>
	</tr> 
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF" >서류대행비</td>
		<td align="center" bgcolor="#FFFFFF" ><?=number($row[wc_accepted_priceF])?></td>
		<td align="center" bgcolor="#FFFFFF" ></td>
		<td align="center" bgcolor="#FFFFFF" ></td>
	</tr> 
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF" >기타비용</td>
		<td align="center" bgcolor="#FFFFFF" ><?=number($row[wc_accepted_priceG])?></td>
		<td align="center" bgcolor="#FFFFFF" ></td>
		<td align="center" bgcolor="#FFFFFF" ></td>
	</tr> 
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#f6f6f6">입금합계</td>
		<td align="center" bgcolor="#FFFFFF"><strong>
		<?=number( $row[wc_accepted_priceA] + $row[wc_accepted_priceB] + $row[wc_accepted_priceC] + $row[wc_accepted_priceD]+ $row[wc_accepted_priceE]+$row[wc_accepted_priceF]+$row[wc_accepted_priceG] )?>	
        </strong>
		</td>
		<td align="center" bgcolor="#f6f6f6" >출금합계</td>
		<td align="center" bgcolor="#FFFFFF"><strong>
		<?=number( $row[wc_pay_cost1] + $row[wc_pay_cost2] + $row[wc_pay_cost3]+ $row[wc_pay_cost4]+ $row[wc_pay_cost5]+ $row[wc_pay_cost6]+ $row[wc_pay_cost7]  )?>	</strong>
		</td>
	</tr>
</table>
<br>

<font style="padding-left:5px;padding-top:15px;"><span class="style7"><strong>* 입금내역</strong></span>  
 <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#cccccc" >        
    <colgroup>
        <col width="20%">
        <col width="20%">
        <col width="*">
    </colgroup> 
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#f6f6f6">입금일자</td>
		<td align="center" bgcolor="#f6f6f6">입금금액</td>
		<td align="center" bgcolor="#f6f6f6">입금처</td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF"><?=substr($row[im_date],0,10)?></td>
		<td align="center" bgcolor="#FFFFFF">
		<?=number( $row[wc_accepted_priceA] + $row[wc_accepted_priceB] + $row[wc_accepted_priceC] + $row[wc_accepted_priceD]+ $row[wc_accepted_priceE]+$row[wc_accepted_priceF]+$row[wc_accepted_priceG] )?>	
        </td>
		<td align="center" bgcolor="#FFFFFF"><?=$bid_mem[company_name]?></td>
	</tr> 
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF">&nbsp;</td>
		<td align="center" bgcolor="#FFFFFF"></td>
		<td align="center" bgcolor="#FFFFFF"></td>
	</tr> 
</table>
<br>
<font style="padding-left:5px;padding-top:15px;"><span class="style7"><strong>* 출금내역</strong></span>  
<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#cccccc" >        
	<colgroup>	
		<col width="20%">
		<col width="20%">
		<col width="*">
	</colgroup> 
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#f6f6f6" style="height:30px;">결제일자</td>
		<td align="center" bgcolor="#f6f6f6">출금금액</td>
		<td align="center" bgcolor="#f6f6f6" >출금구분 및 내역</td>
	</tr>
	<? 
	 $cnt_count = 0;
	 if($row[wc_pay_cost1] > 0){?>
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF" style="height:30px;"><?=$row[wc_pay_date1]?></td>
		<td align="center" bgcolor="#FFFFFF" ><?=number($row[wc_pay_cost1])?></td>
		<td align="center" bgcolor="#FFFFFF"  >
		차대비 
		</td>
	</tr> 
	<?
		$cnt_count++;  
	 }
     ?>
	<?  
	 if($row[wc_pay_cost6] > 0){?>
	 <tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF" style="height:30px;"><?=$row[wc_pay_date6]?></td>
		<td align="center" bgcolor="#FFFFFF" ><?=number($row[wc_pay_cost6])?></td>
		<td align="center" bgcolor="#FFFFFF"  > 
		부가세  
		</td>
	</tr> 
	<?
		$cnt_count++;  
	 }
     ?>
	<?  
	 if($row[wc_pay_cost5] > 0){?>
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF" style="height:30px;"><?=$row[wc_pay_date5]?></td>
		<td align="center" bgcolor="#FFFFFF" ><?=number($row[wc_pay_cost5])?></td>
		<td align="center" bgcolor="#FFFFFF"  >
		기타비용 
		</td>
	</tr> 
	<?
		$cnt_count++;  
	 }
     ?>
	<?  
	 if($row[wc_pay_cost2] > 0){?>
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF" style="height:30px;"><?=$row[wc_pay_date2]?></td>
		<td align="center" bgcolor="#FFFFFF" ><?=number($row[wc_pay_cost2])?></td>
		<td align="center" bgcolor="#FFFFFF"  > 
		대지급급 
		</td>
	</tr> 
	<?
		$cnt_count++;  
	 }
     ?>
	<?  
	 if($row[wc_pay_cost3] > 0){?>
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF" style="height:30px;"><?=$row[wc_pay_date3]?></td>
		<td align="center" bgcolor="#FFFFFF" ><?=number($row[wc_pay_cost3])?></td>
		<td align="center" bgcolor="#FFFFFF"  > 
		<?=$row[wc_pay_title5]?>  
		</td>
	</tr> 
	<?
		$cnt_count++;  
	 }
     ?>
	<?  
	 if($row[wc_pay_cost4] > 0){?>
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF"  style="height:30px;"><?=$row[wc_pay_date4]?></td>
		<td align="center" bgcolor="#FFFFFF"  ><?=number($row[wc_pay_cost4])?></td>
		<td align="center" bgcolor="#FFFFFF"  > 
		<?=$row[wc_pay_title6]?> 
		</td>
	</tr> 
	<?
		$cnt_count++;  
	 } 
	 ?>
	<?  
	 if($row[wc_pay_cost7] > 0){?>
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF" style="height:30px;"><?=$row[wc_pay_date7]?></td>
		<td align="center" bgcolor="#FFFFFF" ><?=number($row[wc_pay_cost7])?></td>
		<td align="center" bgcolor="#FFFFFF"  > 
		<?=$row[wc_pay_title7]?>  
		</td>
	</tr> 
	<?
		$cnt_count++;  
	 } 
	 for($i = $cnt_count ; $i < 7 ; $i++){
     ?>
	<tr align="center" bgcolor="#FFFFFF"> 
		<td align="center" bgcolor="#FFFFFF"  style="height:30px;">&nbsp;</td>
		<td align="center" bgcolor="#FFFFFF" ></td>
		<td align="center" bgcolor="#FFFFFF"  ></td>
	</tr>
     <?
	 }
	 ?>

</table>
<br>

<font style="padding-left:5px;padding-top:15px;"><span class="style7"><strong>* 특이사항</strong></span> 
<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#cccccc" > 
	<tr align="center" bgcolor="#FFFFFF">  
 		 <td style="font-size:10pt;height:60px;">
			 
		 </td> 
	</tr>  	 
</table> 
<br> 
 <script type="text/javascript">
<!--
 function winprint(){
	window.print();
}
//-->
</script>
 <?
	}  //로그인
?>
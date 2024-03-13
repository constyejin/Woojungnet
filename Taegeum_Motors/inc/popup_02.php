<?
include $_SERVER['DOCUMENT_ROOT']."/lib/common.php";
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
$connect = dbconn();


if($loginId){  //로그인했을때만

	$member = Row_string("SELECT * FROM woojung_member WHERE userId = '$loginId'");

	if($sale_type){
		$wh=" and sale_type='$sale_type' ";
	}

	$query = "select count(*) from woojung_bid  WHERE auct_key = '$auct_idx' $wh order by total_price";  
	$result = mysql_query($query, $connect);  
	$temp = mysql_fetch_array($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	

	$auction = Row_string("SELECT * FROM woojung_car WHERE wc_idx = '$auct_idx'");

	$sql_bid=mysql_query("select * from woojung_bid where bid_sort='Y' and auct_key = '$auct_idx'");
	$bid=mysql_fetch_array($sql_bid);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='stylesheet' href='/common/css/adm_style.css' type='text/css'> 
<link rel='stylesheet' href='/common/css/admin_style.css' type='text/css'>
<title>입찰자 명단</title>
 
<style type="text/css">
<!--


.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<script language="JavaScript" src="/common/js/manage_default.js"></script>

<script>
function check(ids){  
	for(var j=0; j<document.myform.elements.length; j++)
	{
		if(document.myform.elements[j].type=='checkbox')
		{
			if(document.myform.elements[j].value == ids)
			{
				if(document.myform.elements[j].checked)
				{
					document.myform.elements[j].checked = "checked";
				}
				else
				{
					document.myform.elements[j].checked = "";
				}
			}
			else
			{
				document.myform.elements[j].checked = "";		    		
			}
		}
	}
}
function ch4() {
	for(i=0; i<document.all.outer.length; i++) {
		document.all.outer[i].checked = true;
	}
}
function outer(ids){  
	for(var j=0; j<document.myform.elements.length; j++)
	{
		if(document.myform.elements[j].type=='checkbox')
		{
			if(document.myform.elements[j].value == ids)
			{
				if(document.myform.elements[j].checked)
				{
					document.myform.elements[j].checked = "checked";
				}
				else
				{
					document.myform.elements[j].checked = "";
				}
			}
			else
			{
				document.myform.elements[j].checked = "";		    		
			}
		}
	}
}
function del(auct_idx, wc_idx){
	if(confirm("해당 자료를 삭제하시겠습니까?")){
	 location.href="auction_go.php?auct_idx="+auct_idx+"&wc_idx="+wc_idx;
	}
}

function ChgbidPrice(){
	var obj = document.myform;
	if(confirm("입찰자 전체 금액이 수정됩니다. \n\n수정하시는 입찰 금액만 수정하셔야 합니다.  \n\n수정된 입찰금액을 적용하시겠습니까?")){
		obj.mode.value = "bidprice";
		obj.submit();
	}

}
</script>
</head>
<body>

<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
<iframe name="HiddenFrm2" id="HiddenFrm2" style="display:none;"></iframe>
<form name="ibform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="ib_ok.php">
<input type="hidden" name="wc_idx" value="<?=$auct_idx?>">
</form>


<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="215" align="center" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
		<td width="608" height="30" align="left" valign="middle"><strong>⊙입찰자보기</strong>  </td>
        <td width="192" height="30" align="right" valign="middle"><a href="javascript:window.print()" >인쇄하기</a> / 

<?
	$Qry = "SELECT a.*, 
				b.team_code, b.team_name, b.team_subname, b.team_subname_etc ,
				b.company_tel, b.tel, b.pcs, b.fax, b.company_name, 
				b.company_sort, b.company_subsort , b.usort , c.*
			FROM woojung_car as a 
				left join woojung_member as b  on a.wc_mem_idx = b.idx 
				left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx					
			WHERE a.wc_idx = '$auct_idx' ";

	$row = Row_string($Qry);


	$team_cate=mysql_fetch_array(mysql_query("select * from team_cate where idx='".$row[car_cate]."'"));
	$car_cate=$team_cate["name"];
?>
		<a href="javascript:self.close();">창닫기</a></td>   
		</tr>
      <tr>
        <td height="2" colspan="2" align="left" valign="middle" bgcolor="#666666"></td>
        </tr>
      <tr>
        <td height="70" colspan="2" align="left" valign="middle" style="line-height:20px;font-weight:bold;">
		<?=substr($auction[wc_regdate],0,10)?>ㅣ <?=WriteArrHTML('checkbox', '', ${"Arrgubun3_".$auction[wc_gubun2]}, $auction[wc_gubun3], '', 0, 'direct', '', '', '');?> ㅣ <? WriteArrHTML('radio', 'wc_go_type', $ArrgoSale, $row[wc_go_type], '', '' , 'direct', ''); ?> ㅣ <?=$car_cate?> ㅣ <?=$auction[jnumber]?> ㅣ <?=$row[in_name]?>
		<br>
		<?=$auction[wc_orderno]?> ㅣ <?=$auction[wc_no]?> ㅣ <?=$auction[wc_model]?> ㅣ <?=substr($auction[wc_age],0,4)?>년 <?=substr($auction[wc_age],4,2)?>월 ㅣ <?=$row[wc_fual]?> ㅣ <?=number($row[wc_cc])?>cc ㅣ <?=number($row[wc_mileage])?>km
		</td>
        </tr>
      <tr>
        <td height="1" colspan="2" align="left" valign="middle" bgcolor="#CCCCCC"></td>
        </tr>
      <tr>
        <td height="10" colspan="2" align="left" valign="middle" ></td>
      </tr>
    </table>
      <table width="800" border="0" cellpadding="0" cellspacing="1" bgcolor="cccccc">
        <tr>
          <td width="96" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3"><strong>입찰회사명</strong></span></td>
          <td width="90" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3"><strong>담당자연락처</strong></span></td>
          <td width="123" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3"><strong>입찰일자</strong></span></td>
<? if($loginUsort == "superadmin" || $loginUsort == "admin1"|| $loginUsort == "admin2"|| $loginUsort == "admin3") { ?>
          <td width="83" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3"><strong>입찰유형</strong></span></td>
          <td width="104" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3"><strong>입찰총액</strong></span></td>
          <td width="74" align="center" valign="middle" bgcolor="#f6f6f6"><strong>입찰금액</strong></td>
          <td width="42" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3"><strong>낙찰</strong></span></td>
          <td width="51" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3"><strong>삭제</strong></span></td>
          <? } ?>        
		</tr>
        <form name="myform" action="auction_go.php" method="post">
        <input type="hidden" name="mode" value="update">  
        <input type="hidden" name="auct_idx" value="<?=$auct_idx?>">  
		 
		 <?
      if($total_article > 0){
			$arr = Fetch_string("SELECT * FROM woojung_bid  WHERE auct_key = '$auct_idx' $wh group by userId order by bid_price desc, bid_rcpt_sort_date desc, idx desc" );
			for($i=0;$i<count($arr);$i++){
				$j = $i +1;
				$userid = $arr[$i][userId];
				$info = Row_string("SELECT * FROM woojung_member WHERE userId  = '$userid'");
				$info_com = Row_string("SELECT * FROM recruit WHERE code  = '$info[code]'");
				if($info[name])
				{
					
				}
				else
				{
					$info = Row_string("SELECT * FROM woojung_member_out WHERE userId  = '$userid' limit 1" );
				}			
				
				$co = mysql_fetch_row(mysql_query("SELECT count(*) FROM woojung_bid  WHERE userId='".$arr[$i][userId]."' and auct_key='".$arr[$i][auct_key]."' $wh " ));
				if($co[0]=="2"){
					$sql="SELECT * FROM woojung_bid  WHERE userId='".$arr[$i][userId]."' and auct_key='".$arr[$i][auct_key]."' and sale_type='2' $wh ";
					$result=mysql_query($sql);
					$data1=mysql_fetch_array($result);
					$sql2="SELECT * FROM woojung_bid  WHERE userId='".$arr[$i][userId]."' and auct_key='".$arr[$i][auct_key]."' and sale_type='1' $wh ";
					$result2=mysql_query($sql2);
					$data2=mysql_fetch_array($result2);
				}
			
				if($arr[$i][bid_rcpt_sort_date])
				{
					$rcpt_date = substr($arr[$i][bid_rcpt_sort_date],0,4).'-'.substr($arr[$i][bid_rcpt_sort_date],4,2).'-'.substr($arr[$i][bid_rcpt_sort_date],6,2).' '.substr($arr[$i][bid_rcpt_sort_date],8,2).':'.substr($arr[$i][bid_rcpt_sort_date],10,2).':'.substr($arr[$i][bid_rcpt_sort_date],12,2);
					
				}
				else
				{
					
					$rcpt_date = '';
				}
				
				$temp = explode("-",$info[ssn]);

	  ?>
        
        <tr align="center">
		<?	if($co[0]=="2"){ ?>
		 <input type="hidden" name="wcb_idx[]" value="<?=$data1[idx]?>">  
		 <input type="hidden" name="wcb_idx[]" value="<?=$data2[idx]?>">  
		<? }else{ ?>
		 <input type="hidden" name="wcb_idx[]" value="<?=$arr[$i][idx]?>">  
		<? } ?>
          <td width="96" height="40" align="center" valign="middle" bgcolor="#FFFFFF" rowspan="2">
		  <?
			  echo $info[company_name]."<br>".$info[company_no]."<br>".$info[ceo_name];
		  ?>		  </td>
          <td width="114" height="40" align="center" valign="middle" bgcolor="#FFFFFF" rowspan="2">
		  <?
			echo $info[name];
			if($loginUsort == "superadmin"){
			  echo "<br>".$info[pcs];
			}else{
			  echo "<br>".substr($info[pcs],0,-4)."****";
			}
		  ?>		  </td>
		  <td width="123" height="40" align="center" valign="middle" bgcolor="#FFFFFF">
<?
	if($co[0]=="2"){
		echo substr($data1[bid_rcpt_sort_date],0,4).'-'.substr($data1[bid_rcpt_sort_date],4,2).'-'.substr($data1[bid_rcpt_sort_date],6,2).' '.substr($data1[bid_rcpt_sort_date],8,2).':'.substr($data1[bid_rcpt_sort_date],10,2).':'.substr($data1[bid_rcpt_sort_date],12,2);
	}elseif($arr[$i][sale_type]=="2"){
		echo $rcpt_date;
	}
?>		  </td>


<? if($loginUsort == "superadmin" || $loginUsort == "admin1"|| $loginUsort == "admin2"|| $loginUsort == "admin3") { ?>
          <td width="93" height="40" align="center" valign="middle" bgcolor="#FFFFFF">
		  명의이전		  </td> 
          <td width="70" height="40" align="center" valign="middle" bgcolor="#FFFFFF" >
		  <?
		  if($co[0]=="2"){
			echo number_format($data1[total_price]);
		  } else if($arr[$i][sale_type]=="2"){
			echo number_format($arr[$i][total_price]);
		  }
		  ?>
		  </td>
          <td width="74" align="center" valign="middle" bgcolor="#FFFFFF">
<?
	if($co[0]=="2"){
?>
		  <input type="text" name="bid_price[]" value="<?=number_format($data1[bid_price])?>" size=12 class="priceText" onKeyUp="javascript:calculation5(this);" />
<?
	}elseif($arr[$i][sale_type]=="2"){
?>
			<input type="text" name="bid_price[]" value="<?=number_format($arr[$i][bid_price])?>" size=12 class="priceText" onKeyUp="javascript:calculation5(this);" />
<?
	}
?>		  </td>
          <td width="42" height="40" align="center" valign="middle" bgcolor="#FFFFFF">
<?
	if($co[0]=="2"){
?>
			<input type="checkbox" name="check[]" id="check[]" value="<?=$data1[idx]?>" <?if($data1[bid_sort] == 'Y'){?> checked = "checked"<?}?>onclick="check(<?=$data1[idx]?>);ch4();" />
<?
	}elseif($arr[$i][sale_type]=="2"){
?>
			<input type="checkbox" name="check[]" id="check[]" value="<?=$arr[$i][idx]?>" <?if($arr[$i][bid_sort] == 'Y'){?> checked = "checked"<?}?>onclick="check(<?=$arr[$i][idx]?>);ch4();" />
<?
	}
?>		  </td>
          <td width="51"  align="center" valign="middle" bgcolor="#FFFFFF">
<?
if($loginUsort=="superadmin"||$loginUsort=="admin1"||$loginUsort=="admin2"){
	if($co[0]=="2"){
?>
		<a href="javascript:del(<?=$auct_idx?>, <?=$data1[idx]?>);" class="style1"><img src="/images/x.jpg" style="border:0px;"></a>
 <?
	}elseif($arr[$i][sale_type]=="2"){
?>
         <a href="javascript:del(<?=$auct_idx?>, <?=$arr[$i][idx]?>);" class="style1"><img src="/images/x.jpg" style="border:0px;"></a>
<?
	}
}
?>		  </td>
         
<?
} 
?>
        </tr>
		<tr>
		  <td width="123" height="40" align="center" valign="middle" bgcolor="#FFFFFF">
<?
	if($co[0]=="2"){
		echo substr($data2[bid_rcpt_sort_date],0,4).'-'.substr($data2[bid_rcpt_sort_date],4,2).'-'.substr($data2[bid_rcpt_sort_date],6,2).' '.substr($data2[bid_rcpt_sort_date],8,2).':'.substr($data2[bid_rcpt_sort_date],10,2).':'.substr($data2[bid_rcpt_sort_date],12,2);
	}elseif($arr[$i][sale_type]=="1"){
		echo $rcpt_date;
	}
?>		  </td>

			
<? if($loginUsort == "superadmin" || $loginUsort == "admin1"|| $loginUsort == "admin2"|| $loginUsort == "admin3") { ?>
			<td width="93" height="40" align="center" valign="middle" bgcolor="#FFFFFF">
			폐차</td>
          <td width="70" height="40" align="center" valign="middle" bgcolor="#FFFFFF" >
		  <?
		  if($co[0]=="2"){
			echo number_format($data2[total_price]);
		  } else if($arr[$i][sale_type]=="1"){
			echo number_format($arr[$i][total_price]);
		  }
		  ?>
		  </td>
          <td width="74" align="center" valign="middle" bgcolor="#FFFFFF">
<?
	if($co[0]=="2"){
?>
		  <input type="text" name="bid_price[]" value="<?=number_format($data2[bid_price])?>" size=12 class="priceText" onKeyUp="javascript:calculation5(this);" />
<?
	}elseif($arr[$i][sale_type]=="1"){
?>
			<input type="text" name="bid_price[]" value="<?=number_format($arr[$i][bid_price])?>" size=12 class="priceText" onKeyUp="javascript:calculation5(this);" />
<?
	}
?>		  </td>
          <td width="42" height="40" align="center" valign="middle" bgcolor="#FFFFFF">
<?
	if($co[0]=="2"){
?>
			<input type="checkbox" name="check[]" id="check[]" value="<?=$data2[idx]?>" <?if($data2[bid_sort] == 'Y'){?> checked = "checked"<?}?>onclick="check(<?=$data2[idx]?>);ch4();" />
<?
	}elseif($arr[$i][sale_type]=="1"){
?>
			<input type="checkbox" name="check[]" id="check[]" value="<?=$arr[$i][idx]?>" <?if($arr[$i][bid_sort] == 'Y'){?> checked = "checked"<?}?>onclick="check(<?=$arr[$i][idx]?>);ch4();" />
<?
	}
?>		  </td>
          <td width="51"  align="center" valign="middle" bgcolor="#FFFFFF">
<?
if($loginUsort=="superadmin"||$loginUsort=="admin1"||$loginUsort=="admin2"){
	if($co[0]=="2"){
?>
		<a href="javascript:del(<?=$auct_idx?>, <?=$data2[idx]?>);" class="style1"><img src="/images/x.jpg" style="border:0px;"></a>
 <?
	}elseif($arr[$i][sale_type]=="1"){
?>
         <a href="javascript:del(<?=$auct_idx?>, <?=$arr[$i][idx]?>);" class="style1"><img src="/images/x.jpg" style="border:0px;"></a>
<?
	}
}
?>		  </td>
<?
} 
?>
        </tr>
        <?}}
        else
        {?>
        	<td height="38" colspan="10" align="center" bgcolor="#FFFFFF"><span class="style4">검색된 자료가 없습니다.</span></td>	
       <?	}?>
      </table>

<? if($loginUsort == "superadmin" || $loginUsort == "admin1" || $loginUsort == "admin2" || $loginUsort == "admin3") { ?>

      <table width="700" border="0" cellspacing="0" cellpadding="0" align="right">
        <tr>
          <td height="5" colspan="2" align="left" valign="top"></td>
        </tr>
<?if($loginUsort=="superadmin"|| $loginUsort == "admin1"|| $loginUsort == "admin2"){?>
        <tr>
        	
			<td width="572" height="30" align="right" valign="middle">
				<input type="button" style="width:105;color:#000000; cursor:pointer; background-color:#d9e8fe; color:#144a9a; border:#636563 1px solid; padding:5 3 3 3; font-weight:bold" value="낙찰자결정/변경" border="0" onclick="document.myform.submit();"/>
				<input type="button" value="입찰금액수정" style="width:105;cursor:pointer;background-color: #ffecec;color: #ff0000;border: #ff0000 1px solid; font-weight:bold" onClick="ChgbidPrice();" />
			</td>
		</tr>
<?}?>
<?if($loginUsort=="superadmin"){?>
<?}?>
        <tr>
          <td height="35" colspan="2" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
        	<?$row2 = Row_string("SELECT * FROM woojung_bid WHERE auct_idx='$auct_idx' and bid_sort = 'Y'");
        	if($row2[idx])
        	{
        	?>
        
          <td height="27" colspan="2" align="center" valign="top"><strong>최종낙찰자 :</strong><?=substr($row2[name],0,4)?>  /  <?=substr($row2[bid_sort_date],0,4)?>년 <?=substr($row2[bid_sort_date],4,2)?>월 <?=substr($row2[bid_sort_date],6,2)?>일 <strong>금액 :</strong> <span class="style4"><?=number_format($row2[bid_price])?></span>원 으로 결정되었습니다.</td>
          	<?
          	}?>
        </tr>
        <tr>
          <td colspan="2" align="right" valign="top" style="padding-right:10px;">&nbsp;</td>
        </tr>
	  </table>

<? } ?>
  </tr>
</table>

</body>
</html>
<?
	}  //로그인
?>
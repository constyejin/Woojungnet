<?
include_once ($_SERVER['DOCUMENT_ROOT']."/lib/common.php");
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
$connect = dbconn();

if($loginId){  //로그인했을때만

$query = "select count(*) from woojung_bid  WHERE auct_key = '$auct_idx' order by total_price";  
$result = mysql_query($query, $connect);  
$temp = mysql_fetch_array($result);  
$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	

$auction = Row_string("SELECT * FROM woojung_car WHERE wc_idx = '$auct_idx'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>입찰자 명단</title>
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link rel='stylesheet' href='/admin/counter/_style.css' type='text/css'>
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
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="215" align="center" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <!--tr>
      	<td height="40" align="left" valign="middle">
          <input type="submit" name="Submit2223322" value="낙찰자용" class="buttona33" onClick="javascript:location.href='/inc/popup_02.php?auct_idx=<?=$auct_idx?>'">
          <input type="submit" name="Submit2223322" value="출품자용" class="button33" onClick="javascript:location.href='/inc/popup_02_2.php?auct_idx=<?=$auct_idx?>'">
         
       </td>
      </tr-->  
      <tr> 
		<td height="30" align="left" valign="middle"><strong>⊙낙찰자명단 (접수번호 : <?=$auction[wc_orderno]?> / 차량번호 : <?=$auction[wc_no]?> / 모델명 : <?=$auction[wc_model]?>)</strong>  </td>
        <td width="100" height="30" align="right" valign="middle"><!--input type="button" style="color:#000000; cursor:pointer; background-color:#FFFFFF; color:#084573; border:#636563 1px solid; padding:5 3 5 3; font-weight:bold"  value="인쇄하기"--><a href="window.print()" >인쇄하기</a></td>   
		</tr>
    </table>
      <table width="800" border="0" cellpadding="0" cellspacing="1" bgcolor="cccccc">
        <tr>
          <!--td width="31" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3">NO</span></td-->
          <td width="61" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3">이름</span></td>
          <!--td width="90" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3">주민번호</span></td-->
          <td  height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3">주소</span></td>
          <td width="84" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3">휴대전화</span></td>
          <td width="75" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3">입찰금액</span></td>
          <td width="61" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3">입찰유형</span></td>
<? if($loginUsort == "superadmin" || $loginUsort == "admin") { ?>
          <td width="80" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3">입찰일</span></td>
          <td width="40" height="30" align="center" valign="middle" bgcolor="#f6f6f6" style="display:none"><span class="style3">노출</span></td>
          <td width="40" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3">낙찰</span></td>
          <td width="40" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3">삭제</span></td>
<? } ?>        
		</tr>
        <form name="myform" action="auction_go.php" method="post">
        <input type="hidden" name="mode" value="update">  
        <input type="hidden" name="auct_idx" value="<?=$auct_idx?>">  
         <?
      if($total_article > 0){
			$arr = Fetch_string("SELECT * FROM woojung_bid  WHERE auct_key = '$auct_idx' order by bid_price desc" );
			for($i=0;$i<count($arr);$i++){
				$j = $i +1;
				$userid = $arr[$i][userId];
				$info = Row_string("SELECT * FROM woojung_member WHERE userId  = '$userid'");
				if($info[name])
				{
					
				}
				else
				{
					$info = Row_string("SELECT * FROM woojung_member_out WHERE userId  = '$userid' limit 1" );
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
		 <input type="hidden" name="wcb_idx[]" value="<?=$arr[$i][idx]?>">  
          <!--td width="31" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><?=$j?></td-->
          <td width="61" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><?=$info[name]?></td>
<? if($i < 3) { ?>

          <!--td width="90" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><?=$temp[0]."-".$temp[1]?></td-->
<? } else { ?>
          <td width="90" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><?=$temp[0]."-*******"?></td>
<? } ?>		  
		  <td  height="40" align="center" valign="middle" bgcolor="#FFFFFF"><?=$info[addr1]." " .$info[addr2] ?></td>
          <td width="84" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><?=$info[pcs]?></td>
          <td width="75" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type="text" name="bid_price[]" value="<?=number_format($arr[$i][bid_price])?>" size=12 class="priceText" onKeyup="javascript:calculation5(this);"></td>
		  <td width="61" height="40" align="center" valign="middle" bgcolor="#FFFFFF">
		  <?
		  WriteArrHTML('radio', 'goSale', $ArrgoSale, $arr[$i][sale_type], '', '' , 'direct', '');
		  ?>
		  
		  
		  </td>


<? if($loginUsort == "superadmin" || $loginUsort == "admin") { ?>
          <td width="80" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><?=$rcpt_date?></td>
          <td width="40" height="40" align="center" valign="middle" bgcolor="#FFFFFF" style="display:none">
            <input disabled type="checkbox" name="outer" id="outer[]" value="<?=$arr[$i][idx]?>" <?if($arr[$i][outer_sort] == 'Y'){?> checked = "checked"<?}?>onclick="javascript:outer(<?=$arr[$i][idx]?>)" />
		  </td>
          <td width="40" height="40" align="center" valign="middle" bgcolor="#FFFFFF">
            <input type="checkbox" name="check[]" id="check[]" value="<?=$arr[$i][idx]?>" <?if($arr[$i][bid_sort] == 'Y'){?> checked = "checked"<?}?>onclick="check(<?=$arr[$i][idx]?>);ch4();" />
		  </td>
          <td width="40" height="40" align="center" valign="middle" bgcolor="#FFFFFF">
            <a href="javascript:del(<?=$auct_idx?>, <?=$arr[$i][idx]?>);" class="style1">X</a>          </td>
<? } ?>
        </tr>
        <?}}
        else
        {?>
        	<td height="38" colspan="13" align="center" bgcolor="#FFFFFF"><span class="style4">검색된 자료가 없습니다.</span></td>	
       <?	}?>
      </table>

<? if($loginUsort == "superadmin" || $loginUsort == "admin") { ?>

      <table width="700" border="0" cellspacing="0" cellpadding="0" align="right">
        <tr>
          <td height="5" colspan="2" align="left" valign="top"></td>
        </tr>
        <tr>
        	
          <td width="468" height="30" align="right" valign="middle" style="padding-right:10px;">낙찰자선택및변경 / 입찰금액변경시 반드시 해당버튼을 눌러주세요.</td>
		  <td width="232" align="right" valign="middle"> 
			<input type="submit"  style="width:105;color:#000000; cursor:pointer; background-color:#FFFFFF; color:#ff0000; border:#636563 1px solid; padding:5 3 3 3; font-weight:bold"" value="낙찰자결정/변경" border="0" />
			<input type="button" name="input" value="입찰금액수정" style="width:105;color:#000000; cursor:pointer; background-color:#FFFFFF; color:#ff0000; border:#636563 1px solid; padding:5 3 3 3; font-weight:bold" onClick="ChgbidPrice()" />          </td>
        </tr>
        <tr>        
          <td height="30" colspan="2" align="right" valign="middle" style="padding-right:10px;">&nbsp;</td>
	    </tr>
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
          <td colspan="2" align="right" valign="top" style="padding-right:10px;">
            <input type="button" name="button" id="button" value="창닫기" onClick="javascript:self.close();" style="cursor:pointer; background-color:#FFFFFF; color:#084573; border:#636563 1px solid; padding:5 3 3 3; font-weight:bold"/></td>
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
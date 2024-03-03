<?
include_once ($_SERVER['DOCUMENT_ROOT']."/lib/common.php");
include $_SERVER['DOCUMENT_ROOT'].'/admin/admin_global.php';
$connect = dbconn();

if($loginId){  //로그인했을때만

	$member = Row_string("SELECT * FROM woojung_member WHERE userId = '$loginId'");

	$state = mysql_fetch_array(mysql_query("select * from woojung_bidadmin where auct_key='".$auct_idx."'"));

	if($state[ad_state]=="N"){
		$auct_idx="";
	}

	$query = "select count(*) from woojung_bid  WHERE auct_key = '$auct_idx' order by total_price";  
	//echo $query;
	$result = mysql_query($query, $connect);  
	//echo $result;
	$temp = mysql_fetch_array($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	


	$auction = Row_string("SELECT * FROM woojung_car WHERE wc_idx = '$auct_idx'");

	$sql_bid=mysql_query("select * from woojung_bid where bid_sort='Y' and auct_key = '$auct_idx'");
	$bid=mysql_fetch_array($sql_bid);
?>

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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>입찰자 명단</title>
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link rel='stylesheet' href='/admin/counter/_style.css' type='text/css'>
<style type="text/css">
<!--
.style3 {font-weight: bold}
.style4 {font-weight: bold}
-->
</style>
</head>

<body>
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
  
  
    <td height="215" align="center" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
<!--<td width="100" height="30" align="left" valign="middle"><input type="button" style="height:30;color:#000000"  value="인쇄하기" onclick="window.print()"></td>/-->    
		<td height="50" align="left" valign="middle"><strong>⊙입찰자명단</strong> (접수번호 : <strong><?=$auction[wc_orderno]?></strong> / 차량번호 : <strong><?=$auction[wc_no]?></strong> / 차량이름 : <strong><?=$auction[wc_model]?></strong>)<br>
		  (접수일자 :  <strong><?=substr($auction[wc_regdate],0,10)?></strong>  /  매각방식 : <strong><?=WriteArrHTML('checkbox', '', ${"Arrgubun3_".$auction[wc_gubun2]}, $auction[wc_gubun3], '', 0, 'direct', '', '', '');?></strong>  / 낙찰일시 : <strong><?=substr($bid[bid_sort_date],0,10)?></strong> / 보험사접수번호 : <strong><?=$auction[jnumber]?></strong>)</td>
        <td width="100" height="30" align="left" valign="middle"><a href="javascript:window.print()" >인쇄하기</a></td>   
		</tr>
    </table>
      <table width="800" border="0" cellpadding="0" cellspacing="1" bgcolor="cccccc">
        <tr>
          <!--td width="31" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3">NO</span></td-->
          <td width="93" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3"><strong>낙찰회원사</strong></span></td>
          <td width="104"  height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3"><strong>회사전화</strong></span></td>
          <td width="96" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3"><strong>입찰자</strong></span></td>
          <td width="114" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3"><strong>휴대전화</strong></span></td>
          <td width="123" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><span class="style3"><strong>입찰일자</strong></span></td>
<? if($loginUsort == "superadmin" || $loginUsort == "admin") { ?>
          <td width="93" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><strong>입찰유형</strong></td>
          <td width="74" align="center" valign="middle" bgcolor="#f6f6f6"><strong>입찰금액</strong></td>
          <td width="42" height="30" align="center" valign="middle" bgcolor="#f6f6f6"><strong>낙찰</strong></td>
          <? } ?>        
		</tr>
        <form name="myform" action="auction_go.php" method="post">
        <input type="hidden" name="mode" value="update">  
        <input type="hidden" name="auct_idx" value="<?=$auct_idx?>">  
         <?
         
      if($total_article > 0){
				
				
/*				
		  		$arr = Fetch_string("SELECT * FROM woojung_bid  WHERE auct_key = '$auct_idx' order by total_price" );
*/
		  		$arr = Fetch_string("SELECT * FROM woojung_bid  WHERE auct_key = '$auct_idx' order by bid_price desc" );
				for($i=0;$i<count($arr);$i++){
					$j = $i +1;
					$userid = $arr[$i][userId];
				$info = Row_string("SELECT * FROM woojung_member WHERE userId  = '$userid'");
				$info_com = Row_string("SELECT * FROM recruit WHERE code  = '$info[code]'");

					$admin_bid=mysql_fetch_array(mysql_query("select * from woojung_bidadmin where idx='".$arr[$i][idx]."'"));
				
					if($admin_bid[ad_price]>0){
						$arr[$i][bid_price] = $admin_bid[ad_price];
					} else {
						$arr[$i][bid_price] = $arr[$i][bid_price];
					}

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

				$pcsstring = explode("-",$info[pcs]);

		  ?>
        
        <tr align="center">
		 <input type="hidden" name="wcb_idx[]" value="<?=$arr[$i][idx]?>">  
          <!--td width="31" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><?=$j?></td-->
          <td width="93" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><span style="display:none">
            <input disabled type="checkbox" name="outer" id="outer[]" value="<?=$arr[$i][idx]?>" <?if($arr[$i][outer_sort] == 'Y'){?> checked = "checked"<?}?>onclick="javascript:outer(<?=$arr[$i][idx]?>)" />
          </span><span class="style3"><?=$info[company]?></span></td>
		  <td  height="40" align="center" valign="middle" bgcolor="#FFFFFF"><?=$info_com[phone]?></td>
          <td width="96" height="40" align="center" valign="middle" bgcolor="#FFFFFF">
		  <?
		  if($member[code]=="chamoa01"||$member[code]==$info[code]){
			  //echo $info[name];
			  echo "***";
		  }else{
			  echo "***";
		  }
		  ?>		  </td>
          <td width="114" height="40" align="center" valign="middle" bgcolor="#FFFFFF">
		  <?
		  if($member[code]=="chamoa01"||$member[code]==$info[code]){
			  echo "***";
		  }else{
			  echo "***";
		  }
		  ?>		  </td>
		  <td width="123" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><?=$rcpt_date?></td>


<? if($loginUsort == "superadmin" || $loginUsort == "admin") { ?>
          <td width="93" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><?
		  WriteArrHTML('radio', 'goSale', $ArrgoSale, $arr[$i][sale_type], '', '' , 'direct', '');
		  ?></td> 
          <td width="74" align="center" valign="middle" bgcolor="#FFFFFF">
          <input type="text" name="bid_price[]" value="<?=number_format($arr[$i][bid_price])?>" size=12 class="priceText" onKeyUp="javascript:calculation5(this);" /></td>
          <td width="42" height="40" align="center" valign="middle" bgcolor="#FFFFFF">
          <input type="checkbox" name="check[]" id="check[]" value="<?=$arr[$i][idx]?>" <?if($arr[$i][bid_sort] == 'Y'){?> checked = "checked"<?}?>onclick="check(<?=$arr[$i][idx]?>);ch4();" />		  </td>
          <? } ?>
        </tr>
        
        <?}}
        else
        {?>
        	
        	<td height="38" colspan="9" align="center">검색된 자료가 없습니다.</td>	
        	
        	
       <?	}?>
        
      </table>

<? if($loginUsort == "superadmin" || $loginUsort == "admin") { ?>

      <table width="700" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5" colspan="2" align="left" valign="top"></td>
        </tr>
        <tr>
         <!-- <td height="25" align="right" valign="middle" style="padding-right:10px;">낙찰자 변경시 반드시 ‘변경하기’ 버튼을 눌러주세요.</td>
		  <td width="400" align="left" valign="middle"> 
			<input type="image"  src="../image/admin_action_popup_b.gif"  border="0" />
		  
		  <input type="button" name="" value="입찰금액수정" style="height:30;color:#000000" onClick="ChgbidPrice()">

		  <input type="button" name="outer_mode" value="외부노출수정" style="height:30;color:#000000" onclick="javascript:document.myform.submit();">

          </td>-->
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
          <td colspan="2" align="right" valign="top" style="padding-right:10px;"><input type="submit" name="button" id="button" value="창닫기" class="button33" style="cursor:pointer; background-color:#FFFFFF; color:#084573; border:#636563 1px solid; padding:5 3 3 3; font-weight:bold" onClick="javascript:self.close();"/></td>
        </tr>
	  </table>

<? } ?>

<!--
      </table></td>
-->  
  </tr>
</table>

</body>
</html>

<?
}   //로그인했을때만
?>
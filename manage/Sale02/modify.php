<? 
include_once "../inc/header.php"; 
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
$form_mode="modify";

include $_SERVER['DOCUMENT_ROOT'].'/lib/phpfun.class.php';
$phpfun = new phpfun();

	
	$href = "page=$page"; 
	$href .= "&gubun1=$gubun1&gubun2=$gubun2&gubun3=$gubun3&gubun4=$gubun4&p=$p&admidx=$admidx&searchKey=$searchKey&end_3=$end_3&tm=$tm&ed=$ed&wtime=$wtime"; 
	$href .= "&start_date=$start_date&end_date=$end_date&car_cate=$car_cate&car_cate2=$car_cate2&wc_made=$wc_made&code=$code&in_name=$in_name&wc_go_type=$wc_go_type&listpage=$listpage";
?>

<script type="text/javascript" src="/common/js/form.js"></script>

<?
	$qry = "select * from woojung_car as a 
			left join woojung_car_go as b on a.wc_idx = b.wcg_wcidx 		
			where a.wc_idx = '$wc_idx'  ";

	
	$row = Row_string($qry);

	$sql_mem = "SELECT * FROM woojung_member WHERE userId = '$row[wc_mem_id]'";	
	$row_mem = Row_string($sql_mem);


	$aucSQL = "select  idx, name, userId, auc_orderno  from woojung_bid where auct_key='$wc_idx' and bid_sort='Y' ";
	$arow = Row_string($aucSQL);

	

	$aucidx	 = $arow[idx];

	$aucNo	 = $arow[auc_orderno];
	if($aucidx && $aucNo){ // 낙찰자가 있을경우
		$aucName = $arow[name];
		$aucId	 = $arow[userId];
		$aucInfo = $aucName ."($aucId)";
	}

 ?>
  
   <?
     if($listpage == "1"){
	  $return_url = "/manage/Sale02/Sale_list.php";
	  }else if($listpage == "2"){
	  $return_url = "/manage/Sale04/Suc_list.php";
	  }else if($listpage == "3"){
	  $return_url = "/manage/Sale03/Sale_list.php";
	  }else if($listpage == "4"){
	  $return_url = "/manage/Sale03/Sale_list2.php";
	  }else{
	  $return_url = "/manage/Sale04/Suc_list02.php";
	  }	
  ?>

<script language="javascript">

function ChkAuction(){
	
	var obj = document.outForm;
	obj.submit();

}

</script>


<form name="outForm" method="post" action="/manage/Sale02/update.php" enctype="multipart/form-data" >
<input type="hidden" name="mode" value="<?php echo $form_mode?>">
<input type="hidden" name="wc_idx" value="<?=$wc_idx?>">
<input type="hidden" name="wc_go_idx" value="<?=$row[wc_go_idx]?>">
<input type="hidden" name="aucidx" value="<?=$aucidx?>">
<input type="hidden" name="aucorderNo" value="<?=$aucNo?>">
<input type="hidden" name="href" value="<?=$href?>">

<table width="970" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><table width="900" border="0" cellspacing="0" cellpadding="0">
       <tr>
  <td height="20" align="left" style="color:#333399"> 
    <?
     if($listpage == "1"){
	  echo "<font size='-4'> ▶ </font>위치 :    접수대장 &gt;  수정하기"; 
	  }else{
	  echo "<font size='-4'> ▶ </font>위치 :    낙찰대장 &gt;  수정하기";
	  }	
  ?>  
      </td>
       </tr>
<tr><td  height="1" bgcolor="#333399"> </td></tr>
<tr><td  height="20"> </td></tr>

        <tr> 
          <td height="40" align="center"><input type="button" name="Submit222222" value="목록보기" class="button44" onclick="window.location='<?=$return_url ?>?<?=$href?>'" style="cursor:pointer; background-color:#e7f5ff; color:#084573; border:#084573 1px solid; padding:5 3 3 3; " />
            &nbsp;
            <input type="button" name="button222322" value="수정하기" class="button33" onClick="ChkAuction();" style="cursor:pointer; background-color:#fae3e3; color:#ff0000; border:#ff0000 1px solid; padding:5 3 3 3;"></td>
          </tr>
      </table>
	  
	  
	  </td>
  </tr>
                <?
	// 출품자 정보를 불러온다.
	$Qry = "SELECT a.*, 
				b.team_code, b.team_name, b.team_subname, b.team_subname_etc ,
				b.company_tel, b.tel, b.pcs, b.fax, b.company_name, 
				b.company_sort, b.company_subsort , b.usort , c.*
			FROM woojung_car as a 
				left join woojung_member as b  on a.wc_mem_id = b.userId  
				left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx 			
			WHERE a.wc_idx = '$wc_idx'  ";

	$row = Row_string($Qry);
	$mem_info = Row_string("SELECT * FROM woojung_member WHERE userId  = '$row[wc_mem_id]'");
	$com = Row_string("SELECT * FROM recruit WHERE code  = '$mem_info[code]'");
	

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
	


	// 총 입찰자를 구해온다.
	$aucCSQL = "select  count(idx) as Cnt  from woojung_bid where auct_key='$wc_idx'  ";
	$aCrow = Row_string($aucCSQL);
	$aucCnt	 = $aCrow[Cnt];

	// 낙찰자 정보를 구해온다
	$aucSQL = "select  *  from woojung_bid where auct_key='$wc_idx' and bid_sort='Y' ";
	$arow = Row_string($aucSQL);
	$aucidx	 = $arow[idx];
	$aucNo	 = $arow[auc_orderno];

	if($aucidx){ // 낙찰자가 있을경우

		$aucName = $arow[name];
		$aucId	 = $arow[userId];
		$aucInfo = $aucName;
		$aucDate = $arow[bid_sort_date];
		$wc_auction_date = $row[wc_auction_date];
		

		$info = Row_string("SELECT * FROM woojung_member WHERE userId  = '$aucId'");
		if($info[name]){	
		}else{
			$info = Row_string("SELECT * FROM woojung_member_out WHERE userId  = '$aucId' limit 1" );
		}	
		$nak = Row_string("SELECT * FROM recruit WHERE code  = '$info[code]'");
		
		$sale_type = $arow[sale_type];
		$bid_price = $arow[bid_price];
		$bid_total_price = $arow[bid_total_price];
		$succ_bid_sub_price = $arow[succ_bid_sub_price];
		$succ_etc_total_price = $arow[succ_etc_total_price];
		$succ_consult_price = $arow[succ_consult_price];
		$total_price = $arow[total_price];

	}

 ?>
<tr> 
    <td align="center"> <table width="900" border="0" cellspacing="0" cellpadding="0">


		  <tr> 
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="2">
              <? include_once "$dir/manage/inc/table01_modify.php";?>            </td>
          </tr>
          <tr> 
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="2">
              <? include_once "$dir/manage/inc/table02_modify.php";?>            </td>
          </tr>
          <tr> 
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr> 
             <td colspan="2"> 
						 
            <?
			//정산금액
			include_once "$dir/manage/inc/table04_modify.php";?>
			</td>
          </tr>
         
          
          
          <tr> 
            <td colspan="2">&nbsp;</td>
          </tr>
      	</table>
			</td>
  </tr>
 
  <tr> 
    <td colspan="2" height="40" align="center">
    <input type="button" name="Submit" value="목록보기" class="button44" onclick="window.location='<?=$return_url ?>?<?=$href?>'" style="cursor:pointer; background-color:#e7f5ff; color:#084573; border:#084573 1px solid; padding:5 3 3 3; " />
      &nbsp;
    <input type="button" name="button" value="수정하기" class="button33" onClick="ChkAuction();" style="cursor:pointer; background-color:#fae3e3; color:#ff0000; border:#ff0000 1px solid; padding:5 3 3 3;" /></td>

  </tr>
  <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>

  

</table>	</form>
<? include_once "../inc/footer.php";?>

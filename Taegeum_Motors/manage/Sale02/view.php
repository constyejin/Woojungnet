<? 	
	include_once "../inc/header.php"; 
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
	
	$href = "page=$page"; 
	$href .= "&gubun1=$gubun1&gubun2=$gubun2&gubun3=$gubun3&gubun4=$gubun4&p=$p&admidx=$admidx&searchKey=$searchKey&end_3=$end_3&tm=$tm&ed=$ed&wtime=$wtime"; 
	$href .= "&start_date=$start_date&end_date=$end_date&car_cate=$car_cate&car_cate2=$car_cate2&wc_made=$wc_made&code=$code&in_name=$in_name&wc_go_type=$wc_go_type&listpage=$listpage";
?>
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
	
	$dongbu_send = Row_string("SELECT * FROM receive WHERE conten like '%$row[wc_idx]%' and conten not like '%EUC-KR%' order by idx desc ");

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
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

<div id="PrintArea"  >


<table width="970" border="0" cellspacing="0" cellpadding="0">

  <tr> 
    <td align="center">
	
	<table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
  <td height="20" colspan="2" align="left" style="color:#333399">
  <?
     if($listpage == "1"){
	  echo "<font size='-4'> ▶ </font>위치 :    접수대장 &gt;  상세보기"; 
	  }else{
	  echo "<font size='-4'> ▶ </font>위치 :    낙찰대장 &gt;  상세보기";
	  }	
  ?>  
  
  </td></tr>
<tr><td  height="1" bgcolor="#333399" colspan="2"> </td></tr>
<tr><td  height="20" colspan="2"> </td></tr>

        <tr> 
          <td width="520" height="40" align="left"><? 
			// 팝업창	
			include_once "$dir/inc/btn_list.php";?></td>
          <td width="235" align="right"> 
      <input type="button" name="Submit222222" value="목록보기" class="button44" onClick="window.location='<?=$return_url ?>?<?=$href?>'" style="cursor:pointer; background-color:#e7f5ff; color:#084573; border:#084573 1px solid; padding:5 3 3 3; "> 
      <input type="submit" name="Submit222322" value="수정하기" class="button33" onClick="window.location='modify.php?wc_idx=<?=$wc_idx?>&<?=$href?>'" style="cursor:pointer; background-color:#ffecec; color:#ff0000; border:#ff0000 1px solid; padding:5 3 3 3;">
	  </td>
        </tr>
      </table>
	  
	  
	  </td>
  </tr>
  <tr> 
    <td align="center"> 
	
		
	<table width="900" border="0" cellspacing="0" cellpadding="0">

        <tr> 
          <td> 
            <?
			// 진행메모장
	  if($loginUsort != "jisajang2"){
			include_once "$dir/manage/inc/table88.php";
	  }
			?>          </td>
        </tr>
		  
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td> 
            <? 
			// 진행방식
			include_once "$dir/manage/inc/table01.php";?>          </td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
<?
if($loginUsort == "superadmin"  ){
?>
         <tr> 
            <td colspan="2" align="left"><span class="title"><img src="/manage/img/icon_1.jpg" class="bullet" /> <strong>구분 변경내용</strong></span></td>
          </tr>
		<tr> 
          <td colspan="2">
			<table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0;text-align:center;" class="table-style">
			<colgroup>
				<col style="width: auto;">
				<col style="width: 20%;">
				<col style="width: 20%;">
				<col style="width: 20%;">
			</colgroup>
				<tr>
					<td bgcolor="f6f6f6" class="table-th">일시</td><td bgcolor="f6f6f6">변경전</td><td bgcolor="f6f6f6">변경후</td><td bgcolor="f6f6f6">이름</td>
				</tr>

<?
		$sql_log="select * from woojung_car_log where wc_idx='$wc_idx' order by regdate desc ";
		$result_log=mysql_query($sql_log);
		while($data_log=mysql_fetch_array($result_log)){
			$sql_log2="select pcs,name from woojung_member where idx='$data_log[user_id]' ";
			$que_log2=mysql_query($sql_log2);
			$data_log2=mysql_fetch_array($que_log2);
?>
				<tr>
					<td bgcolor="FFFFFF" style="height:25px;"><?=$data_log[regdate]?></td>
					<td bgcolor="FFFFFF"><?=WriteArrHTML('select', 'o_gubun4', $Arrgubun4, $data_log[o_gubun4], '', '' , 'direct' , '');?></td>
					<td bgcolor="FFFFFF"><?=WriteArrHTML('select', 'ch_gubun4', $Arrgubun4, $data_log[ch_gubun4], '', '' , 'direct' , '');?></td>
					<td bgcolor="FFFFFF"><?=$data_log2[name]?></td>
				</tr>
<?
		}
?>
			</table>		  </td>
        </tr>
<?
}
?>

		<tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td> 
            <? 
			// 문서함
			include_once "$dir/manage/inc/table03.php";?>          </td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>

          <tr> 
            <td>
            <?
						// 차량정보
			include_once "$dir/manage/inc/table02.php";
			?>
			</td>
        </tr>
        
         <tr> 
          <td> 
            <?
			//낙찰결정 정산금액
			  if($loginUsort != "jisajang2"){
					include_once "$dir/manage/inc/table04.php";
			  }
			?></td>
		</tr>
		<tr> 
          <td>&nbsp;</td>
        </tr>

      </table></td>
  </tr>

  <tr> 
    <td height="40" align="center"> 
       <input type="button" name="Submit222222" value="목록보기" class="button44" onClick="window.location='<?=$return_url?>?<?=$href?>'" style="cursor:pointer; background-color:#e7f5ff; color:#084573; border:#084573 1px solid; padding:5 3 3 3;"> &nbsp;
      <input type="submit" name="Submit222322" value="수정하기" class="button33" onClick="window.location='modify.php?wc_idx=<?=$wc_idx?>&<?=$href?>'" style="cursor:pointer; background-color:#FFFFFF; color:#ff0000; border:#ff0000 1px solid; padding:5 3 3 3;">
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>

<? include_once "../inc/footer.php";?>

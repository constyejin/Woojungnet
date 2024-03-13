<?
$admin_bid=mysql_fetch_array(mysql_query("select * from woojung_bidadmin where idx='".$aucidx."'"));
if($admin_bid[ad_price]>0){
	$ccprice = $admin_bid[ad_price];
	$minusK=$row[wc_accepted_priceA]-$ccprice;
	//$totalK=$row[wc_tot_priceK]-$minusK;
	$totalK=$row[wc_tot_priceK];
} else {
	$ccprice = $row[wc_accepted_priceA];
	$totalK=$row[wc_tot_priceK];
}
?>
<table width="900" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
  <tr>
    <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" class="bullet" /> <strong>낙찰정보</strong></td>
  </tr>
  <tr>
    <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" class="table-style">
    <colgroup>
      <col style="width: 120px;">
      <col style="width: auto;">
    </colgroup>
	      <tr>
        <td class="table-th" bgcolor="f6f6f6">입찰자정보</td>
        <td colspan="3" valign="middle" bgcolor="#FFFFFF" style="padding-left:10px;" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="40%" align="left"><font color="#0000FF">*</font> <font color="#FF0000"><strong>
              <?=$aucCnt?>
              </strong></font> <font color="#0000FF">명의 입찰자가 
                존재합니다.</font></td>
			<td><input type="button" name="Submit222332" value="입찰자보기" class="button33"  onclick="window.open('/inc/popup_02.php?auct_idx=<?=$wc_idx?>','auction','width=900, height=530, scrollbars=yes');" style="cursor:pointer; background-color:#e7f5ff; color:#084573; border:#084573 1px solid; padding:5 3 3 3;"></td>
            <td width="45%" align="left"><img src="../img/imgv2.gif" width="75" height="19" onclick="nak_sms('<?=$info[pcs]?>');" style="cursor:pointer;"/></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td class="table-th" rowspan="2" bgcolor="f6f6f6">최종낙찰자</td>
        <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="margin: 1px 0;" class="table-style">
          <colgroup>
            <col style="width: 16%;" />
            <col style="width: 11%;" />
            <col style="width: 16%;" />
            <col style="width: 17%;" />
            <col style="width: 16%;" />
            <col style="width: 24%;" />
          </colgroup>
          <tr bgcolor="f6f6f6">
            <td class="table-th" bgcolor="f6f6f6">업체명</td>
            <td class="table-th" bgcolor="f6f6f6">이름</td>
            <td class="table-th" bgcolor="f6f6f6">휴대전화</td>
            <td class="table-th" bgcolor="f6f6f6">입찰유형</td>
            <td class="table-th" bgcolor="f6f6f6">낙찰금액</td>
            <td class="table-th" bgcolor="f6f6f6">낙찰일자</td>
          </tr>
          <tr align="center" bgcolor="#FFFFFF">
            <td><?=$info[company_name]?></td>
            <td height="20"><?=$aucInfo?></td>
            <td><?=$info[pcs]?></td>
            <td><?=WriteArrHTML('select', 'Sale', $ArrgoSale, $sale_type, '', '' , 'direct', '' );?></td>
            <td><?=number($bid_price)?></td>
            <td><?=$aucDate?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="20" colspan="3" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$info[post1]?>
          -
          <?=$info[post2]?>
              <?=$info[addr1]?>
              <?=$info[addr2]?>        </td>
      </tr>
    </table></td>
  </tr>
</table>
<br>

<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" class="bullet">  
      <strong>낙찰정산</strong></td>
	<td style="text-align:right;">낙찰금입금확인일자: <?=substr($row[im_date],0,10)?></td>
  </tr>
  <tr> 
    <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="1" bordercolor="b2b2b2" bgcolor="b2b2b2" style="padding:0px;" class="table-style">
  <colgroup>
    <col style="width:12%;"/>
    <col style="width:12%;"/>
    <col style="width:12%;"/>
    <col style="width:12%;"/>
    <col style="width:12%;"/>
    <col style="width:12%;"/>
    <col style="width:12%;"/>
    <col style="width:12%;"/>
  </colgroup>
      <tr align="center" bgcolor="f6f6f6">
        <td class="table-th" >낙찰금액</td>
        <td class="table-th" >부가세</td>
        <td class="table-th" >낙찰수수료</td>
        <td class="table-th" >대지급금</td>
        <td class="table-th" >상사이전비</td>
        <td class="table-th" >서류대행비</td>
        <td class="table-th" >기타비용</td>
        <td class="table-th" >입금합계</td>
      </tr>
      <tr align="center" bgcolor="#FFFFFF">
        <td height="25"><?=number($row[wc_accepted_priceA])?></td>
        <td><?=number($row[wc_accepted_priceB])?></td>
        <td><?=number($row[wc_accepted_priceC])?></td>
        <td><?=number($row[wc_accepted_priceD])?></td>
        <td><?=number($row[wc_accepted_priceE])?></td>
        <td><?=number($row[wc_accepted_priceF])?></td>
        <td><?=number($row[wc_accepted_priceG])?></td>
        <td><?=number( $row[wc_accepted_priceA] + $row[wc_accepted_priceB] + $row[wc_accepted_priceC] + $row[wc_accepted_priceD] + $row[wc_accepted_priceE] + $row[wc_accepted_priceF] + $row[wc_accepted_priceG] )?></td>
      </tr>
    </table></td>
  </tr>
</table><br />

<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" class="bullet">  
      <strong>출품정산</strong></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0px;" class="table-style">
    <colgroup>
      <col style="width:10%;" />
      <col style="width:10%;" />
      <col style="width:10%;" />
      <col style="width:10%;" />
      <col style="width:10%;" />
      <col style="width:10%;" />
    </colgroup>
      <tr align="center" bgcolor="f6f6f6">
        <td class="table-th">출품자</td>
        <td class="table-th">낙찰금액</td>
        <td class="table-th">대지급금공제</td>
        <td class="table-th">기타공제</td>
        <td class="table-th">기타더함</td>
        <td class="table-th">지급합계</td>
      </tr>
      <tr align="center" bgcolor="#FFFFFF">
        <td height="20"><?=$row[wc_mem_name]?></td>
        <td height="20"><?=number($ccprice)?></td>
        <td><?=number($row[wc_gale_priceH])?></td>
        <td><?=number($row[wc_etc1_priceI])?></td>
        <td><?=number($row[wc_etc2_priceJ])?></td>
        <td><?=number($totalK)?></td>
      </tr>
    </table>
    </td>
  </tr>
</table><br />

<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="20" class="title"><div align="left"><img src="/manage/img/icon_1.jpg" class="bullet"> 
        <strong>지급요청내역</strong></div></td>
</tr>
  <tr> 
    <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" class="table-style">
    <colgroup>
      <col style="width:25px" />
      <col style="width:77px" />
      <col style="width:97px" />
      <col style="width:auto" />
      <col style="width:160px" />
    </colgroup>
      <tr bgcolor="f6f6f6">
        <td class="table-th">NO</td>
        <td class="table-th">출금구분</td>
        <td class="table-th">금액</td> 
        <td class="table-th">비고(입금계좌및내역등)</td>
        <td class="table-th">지급일자</td> 
      </tr> 
      <tr align="center" bgcolor="#FFFFFF">
        <td height="23">
		   1
		</td>
        <td height="23">
		   차대비
		</td> 
        <td height="23">
		   <?=number($row[wc_pay_cost1])?>
		</td> 
        <td height="23">
		  <?=$row[wc_pay_memo1]?>
		</td>
        <td height="23">
		  <?=$row[wc_pay_date1]?>
		</td>
      </tr>  
      <tr align="center" bgcolor="#FFFFFF">
        <td height="23">
		   2
		</td>
        <td height="23">
		   부가세 
		</td> 
        <td height="23">
		   <?=number($row[wc_pay_cost6])?>
		</td> 
        <td height="23">
		   <?=$row[wc_pay_memo6]?>
		</td>
        <td height="23">
		   <?=$row[wc_pay_date6]?>
		</td>
      </tr> 
      <tr align="center" bgcolor="#FFFFFF">
        <td height="23">
		   3
		</td>
        <td height="23">
		   기타비용 
		</td> 
        <td height="23">
		  <?=number($row[wc_pay_cost5])?>
		</td> 
        <td height="23">
		  <?=$row[wc_pay_memo5]?>
		</td>
        <td height="23">
		   <?=$row[wc_pay_date5]?>
		</td>
      </tr> 
      <tr align="center" bgcolor="#FFFFFF">
        <td height="23">
		   4
		</td>
        <td height="23">
		   대지급금 
		</td> 
        <td height="23">
		   <?=number($row[wc_pay_cost2])?>
		</td> 
        <td height="23">
		   <?=$row[wc_pay_memo2]?>
		</td>
        <td height="23">
	 	   <?=$row[wc_pay_date2]?>
		</td>
      </tr> 
      <tr align="center" bgcolor="#FFFFFF">
        <td height="23">
		   5
		</td>
        <td height="23">
		   <?=$row[wc_pay_title5]?>
		</td> 
        <td height="23">
		   <?=number($row[wc_pay_cost3])?>
		</td> 
        <td height="23">
		  <?=$row[wc_pay_memo3]?>
		</td>
        <td height="23">
		   <?=$row[wc_pay_date3]?>
		</td>
      </tr> 
      <tr align="center" bgcolor="#FFFFFF">
        <td height="23">
		   6
		</td>
        <td height="23">
		   <?=$row[wc_pay_title6]?>
		</td> 
        <td height="23">
		   <?=number($row[wc_pay_cost4])?>
		</td> 
        <td height="23">
		   <?=$row[wc_pay_memo4]?>
		</td>
        <td height="23">
		   <?=$row[wc_pay_date4]?>
		</td>
      </tr> 
      <tr align="center" bgcolor="#FFFFFF">
        <td height="23">
		   7
		</td>
        <td height="23">
		   <?=$row[wc_pay_title7]?>
		</td> 
        <td height="23">
		   <?=number($row[wc_pay_cost7])?>
		</td> 
        <td height="23">
		   <?=$row[wc_pay_memo7]?>
		</td>
        <td height="23">
		   <?=$row[wc_pay_date7]?>
		</td>
      </tr> 
      <tr align="center" bgcolor="f6f6f6">
        <td class="table-th" colspan="2" bgcolor="f6f6f6" >
		   지급합계
		</td> 
        <td height="23" colspan="4" align="left"  style="padding-left:20px;">
		&nbsp; <?=number( $row[wc_pay_cost1] + $row[wc_pay_cost2] + $row[wc_pay_cost3] + $row[wc_pay_cost4] + $row[wc_pay_cost5] + $row[wc_pay_cost6] + $row[wc_pay_cost7] )?>
		   &nbsp; 
		</td>  
      </tr> 
</table>
    <br />

<!--
<table width="780" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle>  <strong>차대비</strong></td>
  </tr>
  <tr> 
    <td><table width="780" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0">
    <tr> 
          <td width="100" height="23" align="center" bgcolor="f6f6f6">지급일자</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_date1]?></td>
          <td align="center" bgcolor="f6f6f6">은행명</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_bank1]?></td>
        </tr>
        <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">계좌번호</td>
          <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_bank_no1]?></td>
          <td width="100" align="center" bgcolor="f6f6f6">예 금 주</td>
          <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 
            <?=$row[wc_pay_bank_name1]?>          </td>
        </tr>
       <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">비용지급</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=num_ys($row[wc_pay_cost1])?> 원 / 메모:<?=$row[wc_pay_memo1]?></td>
        </tr>
         </table>
    </td>
   </tr>
 </table></br>
 <table width="780" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle>  <strong>대지급금1</strong></td>
  </tr>
  <tr> 
    <td><table width="780" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0">
    <tr> 
          <td width="100" height="23" align="center" bgcolor="f6f6f6">지급일자</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_date2]?></td>
          <td align="center" bgcolor="f6f6f6">은행명</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_bank2]?></td>
        </tr>
        <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">계좌번호</td>
          <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_bank_no2]?></td>
          <td width="100" align="center" bgcolor="f6f6f6">예 금 주</td>
          <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 
            <?=$row[wc_pay_bank_name2]?>          </td>
        </tr>
       <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">비용지급</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=num_ys($row[wc_pay_cost2])?> 원 / 메모:<?=$row[wc_pay_memo2]?></td>
        </tr>
        </table>
    </td>
   </tr>
 </table></br>
 
 <table width="780" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle>  <strong>대지급금2</strong></td>
  </tr>
  <tr> 
    <td><table width="780" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0">
    <tr> 
          <td width="100" height="23" align="center" bgcolor="f6f6f6">지급일자</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_date3]?></td>
          <td align="center" bgcolor="f6f6f6">은행명</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_bank3]?></td>
        </tr>
        <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">계좌번호</td>
          <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_bank_no3]?></td>
          <td width="100" align="center" bgcolor="f6f6f6">예 금 주</td>
          <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 
            <?=$row[wc_pay_bank_name3]?>          </td>
        </tr>
       <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">비용지급</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=num_ys($row[wc_pay_cost3])?> 원 / 메모:<?=$row[wc_pay_memo3]?></td>
        </tr>
        </table>
    </td>
   </tr>
 </table><br />

 <table width="780" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" align="absmiddle" /> <strong>대지급금3</strong></td>
   </tr>
   <tr>
     <td><table width="780" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0">
         <tr>
           <td width="100" height="23" align="center" bgcolor="f6f6f6">지급일자</td>
           <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_date4]?></td>
           <td align="center" bgcolor="f6f6f6">은행명</td>
           <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_bank4]?></td>
         </tr>
         <tr>
           <td height="23" align="center" bgcolor="f6f6f6">계좌번호</td>
           <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_bank_no4]?></td>
           <td width="100" align="center" bgcolor="f6f6f6">예 금 주</td>
           <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_bank_name4]?>
           </td>
         </tr>
         <tr>
           <td height="23" align="center" bgcolor="f6f6f6">비용지급</td>
           <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=num_ys($row[wc_pay_cost4])?>
             원 / 메모:
              <?=$row[wc_pay_memo4]?></td>
         </tr>
     </table></td>
   </tr>
 </table><br />
 
 <table width="780" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" align="absmiddle" /> <strong>기타비용</strong></td>
   </tr>
   <tr>
     <td><table width="780" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0">
         <tr>
           <td width="100" height="23" align="center" bgcolor="f6f6f6">지급일자</td>
           <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_date5]?></td>
           <td align="center" bgcolor="f6f6f6">은행명</td>
           <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_bank5]?></td>
         </tr>
         <tr>
           <td height="23" align="center" bgcolor="f6f6f6">계좌번호</td>
           <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_bank_no5]?></td>
           <td width="100" align="center" bgcolor="f6f6f6">예 금 주</td>
           <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[wc_pay_bank_name5]?>
           </td>
         </tr>
         <tr>
           <td height="23" align="center" bgcolor="f6f6f6">비용지급</td>
           <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=num_ys($row[wc_pay_cost5])?>
             원 / 메모:
              <?=$row[wc_pay_memo5]?></td>
         </tr>
     </table></td>
   </tr>
 </table>
 <p>&nbsp;</p>
-->
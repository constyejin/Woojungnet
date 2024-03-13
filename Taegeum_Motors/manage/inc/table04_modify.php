<table width="900" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" align="absmiddle" /> <strong>낙찰정보</strong></td>
  </tr>
  <tr>
    <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0">
  
	      <tr>
        <td width="100" height="23" align="center" bgcolor="f6f6f6" class="table-th">입찰자정보</td>
        <td colspan="3" valign="middle" bgcolor="#FFFFFF" style="padding-left:10px;" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="55%" align="left"><font color="#0000FF">*</font> <font color="#FF0000"><strong>
              <?=$aucCnt?>
              </strong></font> <font color="#0000FF">명의 입찰자가 
                존재합니다.</font></td>
            <td width="45%" align="left"><img src="../img/imgv2.gif" width="75" height="19" onclick="nak_sms('<?=$info[pcs]?>');" style="cursor:pointer;"/></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td rowspan="2" align="center" bgcolor="f6f6f6" class="table-th">최종낙찰자</td>
        <td height="50" colspan="3" bgcolor="#FFFFFF" style="padding:5 10 5 10"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2">
          <tr bgcolor="f6f6f6">
            <td class="table-th" width="16%" align="center" bgcolor="f6f6f6">업체명</td>
            <td class="table-th" width="11%" height="20" align="center" bgcolor="f6f6f6">이름</td>
            <td class="table-th" width="16%" align="center" bgcolor="f6f6f6">휴대전화</td>
            <td class="table-th" width="17%" align="center" bgcolor="f6f6f6">입찰유형</td>
            <td class="table-th" width="16%" align="center" bgcolor="f6f6f6">낙찰금액</td>
            <td class="table-th" width="24%" align="center" bgcolor="f6f6f6">낙찰일자</td>
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

<?
$admin_bid=mysql_fetch_array(mysql_query("select * from woojung_bidadmin where idx='".$aucidx."'"));
if($admin_bid[ad_price]>0){
	$ccprice = $admin_bid[ad_price];
	$minusK=$row[wc_accepted_priceA]-$ccprice;
	$totalK=$row[wc_tot_priceK]-$minusK;
} else {
	$ccprice = $row[wc_accepted_priceA];
	$totalK=$row[wc_tot_priceK];
}
?>
 
<script>
function AddComma(num)             {          
	var regexp =  /\B(?=(\d{3})+(?!\d))/g;     
	return num.toString().replace(regexp, ',');            
}
  
	function allsum(){
	var val1 = document.getElementsByName('wc_pay_cost1')[0].value.replaceAll(",", "");
	var val2 = document.getElementsByName('wc_pay_cost2')[0].value.replaceAll(",", "");
	var val3 = document.getElementsByName('wc_pay_cost3')[0].value.replaceAll(",", "");
	var val4 = document.getElementsByName('wc_pay_cost4')[0].value.replaceAll(",", "");
	var val5 = document.getElementsByName('wc_pay_cost5')[0].value.replaceAll(",", "");
	var val6 = document.getElementsByName('wc_pay_cost6')[0].value.replaceAll(",", "");
	var val7 = document.getElementsByName('wc_pay_cost7')[0].value.replaceAll(",", "");
    //alert(parseFloat(val1));
    //alert(parseInt(val1)+parseInt(val2)+parseInt(val3)+parseInt(val4)+parseInt(val5)+parseInt(val6));
    if(val1 == "") val1 = 0;
    if(val2 == "") val2 = 0;
    if(val3 == "") val3 = 0;
    if(val4 == "") val4 = 0;
    if(val5 == "") val5 = 0;
    if(val6 == "") val6 = 0;
    if(val7 == "") val7 = 0;
	var  varsum = parseInt(val1)+parseInt(val2)+parseInt(val3)+parseInt(val4)+parseInt(val5)+parseInt(val6)+parseInt(val7);
    //alert(varsum);

	var nData = AddComma(varsum); 
    document.getElementById('wc_pay_cost_sum').value =  nData; 
	}
</script>
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="20" class="title"><div align="left"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle> 
        <strong>낙찰정산</strong></div></td>
  </tr>
  <tr> 
    <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0; border:1px solid #FF0000">
      <tr align="center" bgcolor="f6f6f6">
        <td height="23"  >낙찰금액</td>
        <td >부가세</td>
        <td >낙찰수수료</td>
        <td >대지급금</td>
        <td >상사이전비</td>
        <td >서류대행비</td>
        <td >기타비용</td>
        <td >입금합계</td>
      </tr>

      <tr align="center" bgcolor="#FFFFFF">
        <td height="23" width="100" ><input style="width: 100px"  name="wc_accepted_priceA" type="text"  id="wc_accepted_priceA" onkeyup="javascript:calculation1(wc_accepted_priceA);calculation(wc_insure_priceG);txtWrite('txt_wc_accepted_priceA', this.value);" value="<?=$row[wc_accepted_priceA] ? number($row[wc_accepted_priceA]) : '0';?>" size="15" /></td>
        <td height="23" ><input style="width: 100px"  name="wc_accepted_priceB" type="text"  id="wc_accepted_priceB" onkeyup="javascript:calculation1(wc_accepted_priceB);calculation(wc_insure_priceG);txtWrite('txt_wc_accepted_priceB', this.value);" value="<?=$row[wc_accepted_priceB] ? number($row[wc_accepted_priceB]) : '0';?>" size="15" /></td>
        <td height="23" ><input style="width: 100px"  name="wc_accepted_priceC" type="text"  id="wc_accepted_priceC" onkeyup="javascript:calculation1(wc_accepted_priceC);calculation(wc_insure_priceG);txtWrite('txt_wc_accepted_priceC', this.value);" value="<?=$row[wc_accepted_priceC] ? number($row[wc_accepted_priceC]) : '0';?>" size="15" /></td>
        <td height="23" ><input style="width: 100px"  name="wc_accepted_priceD" type="text"  id="wc_accepted_priceD" onkeyup="javascript:calculation1(wc_accepted_priceD);calculation(wc_insure_priceG);txtWrite('txt_wc_accepted_priceD', this.value);" value="<?=$row[wc_accepted_priceD] ? number($row[wc_accepted_priceD]) : '0';?>" size="15" /></td>
        <td height="23" ><input style="width: 100px"  name="wc_accepted_priceE" type="text"  id="wc_accepted_priceE" onkeyup="javascript:calculation1(wc_accepted_priceE);calculation(wc_insure_priceG);txtWrite('txt_wc_accepted_priceE', this.value);" value="<?=$row[wc_accepted_priceE] ? number($row[wc_accepted_priceE]) : '0';?>" size="15" /></td>
        <td height="23" ><input style="width: 100px"  name="wc_accepted_priceF" type="text"  id="wc_accepted_priceF" onkeyup="javascript:calculation1(wc_accepted_priceF);calculation(wc_insure_priceG);txtWrite('txt_wc_accepted_priceF', this.value);" value="<?=$row[wc_accepted_priceF] ? number($row[wc_accepted_priceF]) : '0';?>" size="15" /></td>
        <td height="23" ><input style="width: 100px"  name="wc_accepted_priceG" type="text"  id="wc_accepted_priceG" onkeyup="javascript:calculation1(wc_accepted_priceG);calculation(wc_insure_priceG);txtWrite('txt_wc_accepted_priceG', this.value);" value="<?=$row[wc_accepted_priceG] ? number($row[wc_accepted_priceG]) : '0';?>" size="15" /></td>
        <td><!-- 사용자가 입력하는게 아니고 프로그램으로 자동계산 금액이 보여지면 됨 F= A-(B+C+D+E)-->
            <input style="width: 100px"  name="wc_accepted_priceS" type="text" id="wc_accepted_priceS" style='width:90;' onkeyup="javascript:calculation1(wc_accepted_priceF);" value="<?=number( $row[wc_accepted_priceA] + $row[wc_accepted_priceB] + $row[wc_accepted_priceC] + $row[wc_accepted_priceD] + $row[wc_accepted_priceE] + $row[wc_accepted_priceF] + $row[wc_accepted_priceG] )?>" size="15" readonly="readonly" /></td>
      </tr>
</table>
    <br />

<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="20" class="title"><div align="left"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle> 
        <strong>출품정산</strong></div></td>
</tr>
  <tr> 
    <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0px;">
      <tr align="center" bgcolor="f6f6f6">
        <td height="23">출품자</td>
        <td height="23">낙찰금액</td>
        <td>대지급금공제</td>
        <td>기타공제</td>
        <td>기타더함</td>
        <td>지급합계</td>
      </tr>
      <tr align="center" bgcolor="#FFFFFF">
        <td height="23"><span id="txt_wc_accepted_priceA"><?=$row[wc_mem_name]?></span> </td>
        <td height="23"><span id="txt_wc_accepted_priceA">
          <?=number($ccprice)?>
        </span> </td>
        <td><input  name="wc_gale_priceH" type="text" id="wc_gale_priceH" style='width:90;' onkeyup="javascript:calculation(wc_gale_priceH);" value="<?=$row[wc_gale_priceH] ? number($row[wc_gale_priceH]) : '0';?>" size="17" /></td>
        <td><input  name="wc_etc1_priceI" type="text" id="wc_etc1_priceI" style='width:90;' onkeyup="javascript:calculation(wc_etc1_priceI);" value="<?=$row[wc_etc1_priceI] ? number($row[wc_etc1_priceI]) : '0';?>" size="17" /></td>
        <td><input  name="wc_etc2_priceJ" type="text" id="wc_etc2_priceJ" style='width:90;' onkeyup="javascript:calculation(wc_etc2_priceJ);" value="<?=$row[wc_etc2_priceJ] ? number($row[wc_etc2_priceJ]) : '0';?>" size="17" /></td>
        <td><!-- 사용자가 입력하는게 아니고 프로그램으로 자동계산 금액이 보여지면 됨 K= A-(G+H+I)+J-->
            <input  name="wc_tot_priceK" type="text" id="wc_tot_priceK" style='width:90;' value="<?=number($totalK)?>" size="17" readonly="readonly" />
        </td>
      </tr>
    </table>
        </td>
      </tr>
    </table>
      <br />



<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="20" class="title"><div align="left"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle> 
        <strong>지급요청내역</strong></div></td>
  </tr>
  <tr> 
    <td>
      <table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0; border:1px solid #FF0000">
        <tr align="center" bgcolor="f6f6f6">
          <td width="25" height="23">NO</td>
          <td height="23" width="77">출금구분</td>
          <td height="23" width="97">금액</td> 
          <td height="23">비고(입금계좌및내역등)</td>
          <td height="23" width="180">지급일자</td> 
        </tr> 
        <tr align="center" bgcolor="#FFFFFF">
          <td height="23">
            1
          </td>
          <td height="23">
            차대비
          </td> 
          <td height="23">
            <input type="text" value="<?=number($row[wc_pay_cost1])?>"  name="wc_pay_cost1" style='width:120px;margin: 0 15px;' onkeyup="javascript:calculation(wc_pay_cost1);allsum();"/>
          </td> 
          <td height="23">
            <input  name="wc_pay_memo1" type="text" style='width:350px;' value="<?=$row[wc_pay_memo1]?>" />
          </td>
          <td height="23">
            <input  name="wc_pay_date1" type="text" style='width:80px;' value="<?=$row[wc_pay_date1]?>" size="14" id="wc_pay_date1">
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
            <input type="text" value="<?=number($row[wc_accepted_priceB])?>"  name="wc_pay_cost6" style='width:120px;margin: 0 15px;' onkeyup="javascript:calculation(wc_pay_cost6);allsum();"/>
          </td> 
          <td height="23">
            <input  name="wc_pay_memo6" type="text" style='width:350px;' value="<?=$row[wc_pay_memo6]?>" />
          </td>
          <td height="23">
            <input type="text" value="<?=$row[wc_pay_date6]?>"  name="wc_pay_date6" style='width:80px;' id="wc_pay_date6">
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
            <input type="text" value="<?=number($row[wc_pay_cost5])?>"  name="wc_pay_cost5" style='width:120px;margin: 0 15px;' onkeyup="javascript:calculation(wc_pay_cost5);allsum();"/>
          </td> 
          <td height="23">
            <input  name="wc_pay_memo5" type="text" style='width:350px;' value="<?=$row[wc_pay_memo5]?>" />
          </td>
          <td height="23">
            <input type="text" value="<?=$row[wc_pay_date5]?>"  name="wc_pay_date5"  style='width:80px;' id="wc_pay_date5">
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
            <input type="text" value="<?=number($row[wc_pay_cost2])?>"  name="wc_pay_cost2" style='width:120px;margin: 0 15px;' onkeyup="javascript:calculation(wc_pay_cost2);allsum();"/>
          </td> 
          <td height="23">
            <input  name="wc_pay_memo2" type="text" style='width:350px;' value="<?=$row[wc_pay_memo2]?>" />
          </td>
          <td height="23">
            <input type="text" value="<?=$row[wc_pay_date2]?>"  name="wc_pay_date2"  style='width:80px;' id="wc_pay_date2">
          </td>
        </tr> 
        <tr align="center" bgcolor="#FFFFFF">
          <td height="23">
            5
          </td>
          <td height="23">
            <input type="text" value="<?=$row[wc_pay_title5]?>"  name="wc_pay_title5" style='width:120px;margin: 0 15px;' /> 
          </td> 
          <td height="23">
            <input type="text" value="<?=number($row[wc_pay_cost3])?>"  name="wc_pay_cost3" style='width:120px;margin: 0 15px;' onkeyup="javascript:calculation(wc_pay_cost3);allsum();"/>
          </td> 
          <td height="23">
            <input  name="wc_pay_memo3" type="text" style='width:350px;' value="<?=$row[wc_pay_memo3]?>" />
          </td>
          <td height="23">
            <input type="text" value="<?=$row[wc_pay_date3]?>"  name="wc_pay_date3"  style='width:80px;' id="wc_pay_date3">
          </td>
        </tr> 
        <tr align="center" bgcolor="#FFFFFF">
          <td height="23">
            6
          </td>
          <td height="23">
            <input type="text" value="<?=$row[wc_pay_title6]?>"  name="wc_pay_title6" style='width:120px;margin: 0 15px;'  /> 
          </td> 
          <td height="23">
            <input type="text" value="<?=number($row[wc_pay_cost4])?>"  name="wc_pay_cost4" style='width:120px;margin: 0 15px;' onkeyup="javascript:calculation(wc_pay_cost4);allsum();"/>
          </td> 
          <td height="23">
            <input  name="wc_pay_memo4" type="text" style='width:350px;' value="<?=$row[wc_pay_memo4]?>" />
          </td>
          <td height="23">
            <input type="text" value="<?=$row[wc_pay_date4]?>"  name="wc_pay_date4"  style='width:80px;' id="wc_pay_date4">
          </td>
        </tr> 
        <tr align="center" bgcolor="#FFFFFF">
          <td height="23">
            7
          </td>
          <td height="23">
            <input type="text" value="<?=$row[wc_pay_title7]?>"  name="wc_pay_title7" style='width:120px;margin: 0 15px;'  /> 
          </td> 
          <td height="23">
            <input type="text" value="<?=number($row[wc_pay_cost7])?>"  name="wc_pay_cost7" style='width:120px;margin: 0 15px;' onkeyup="javascript:calculation(wc_pay_cost7);allsum();"/>
          </td> 
          <td height="23">
            <input  name="wc_pay_memo7" type="text" style='width:350px;' value="<?=$row[wc_pay_memo7]?>" />
          </td>
          <td height="23">
            <input type="text" value="<?=$row[wc_pay_date7]?>"  name="wc_pay_date7"  style='width:80px;' id="wc_pay_date7">
          </td>
        </tr> 
      <tr align="center" bgcolor="f6f6f6">
        <td height="23" colspan="2" bgcolor="f6f6f6">
          지급합계
        </td> 
        <td height="23" colspan="3" align="left" >
          &nbsp; <input type="text" value="<?=number( $row[wc_pay_cost1] + $row[wc_pay_cost2] + $row[wc_pay_cost3] + $row[wc_pay_cost4] + $row[wc_pay_cost5] + $row[wc_pay_cost6] + $row[wc_pay_cost7] )?>" style="border:none;border-right:0px; border-top:0px; boder-left:0px; boder-bottom:0px;background-color: f6f6f6" id="wc_pay_cost_sum" >
            &nbsp; 
        </td>  
      </tr> 
  </table>
        </td>
      </tr>
    </table>
      <br />

<!--
<table width="780" border="0" cellspacing="0" cellpadding="0">
<tr> 
  <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle> <strong>차대비</strong></td>
</tr>
  <tr> 
    <td><table width="780" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0; border:1px solid #FF0000">
   
        <tr> 
          <td  width="100px" height="23" align="center" bgcolor="f6f6f6">지급일자</td>
          <td align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input type="text" value="<?=$row[wc_pay_date1]?>"  name="wc_pay_date1" style='width:90;' onclick="Calendar(wc_pay_date1)"> 
            <a class="hand" onclick="Calendar(wc_pay_date1)">[날짜선택]</a></td>
          <td align="center" bgcolor="f6f6f6">은 행 명</td>
          <td align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input value="<?=$row[wc_pay_bank1]?>"  name="wc_pay_bank1" type="text"  class="input" id="wc_pay_bank1" size="20"/></td>
        </tr>
        <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">계좌번호</td>
          <td width="280" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input value="<?=$row[wc_pay_bank_no1]?>"  name="wc_pay_bank_no1" type="text"  class="input" id="wc_pay_bank_no1"  size="30"/></td>
          <td width="100" align="center" bgcolor="f6f6f6">예 금 주</td>
          <td width="275" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"> <input value="<?=$row[wc_pay_bank_name1]?>"  name="wc_pay_bank_name1" type="text"  class="input" id="wc_pay_bank_name1" size="20"/></td>
        </tr>
        <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">비용지급</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"> <input type="text" value="<?=$row[wc_pay_cost1] ? number($row[wc_pay_cost1]) : '0';?>"  name="wc_pay_cost1" style='width:90;' onkeyup="javascript:calculation(wc_pay_cost1);"/>
            원 &nbsp;&nbsp;메모 
            :
              <input  name="wc_pay_memo1" type="text" style='width:490;' value="<?=$row[wc_pay_memo1]?>" size="74" /></td>
        </tr>

      </table>
</td></tr></table><br />
<table width="780" border="0" cellspacing="0" cellpadding="0">
<tr> 
  <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle> <strong>대지급금1</strong></td>
</tr>
  <tr> 
    <td><table width="780" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0;border:1px solid #FF0000">
   
        <tr> 
          <td  width="100px" height="23" align="center" bgcolor="f6f6f6">지급일자</td>
          <td align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input type="text" value="<?=$row[wc_pay_date2]?>"  name="wc_pay_date2" style='width:90;' onclick="Calendar(wc_pay_date2)"> 
            <a class="hand" onclick="Calendar(wc_pay_date2)">[날짜선택]</a></td>
          <td align="center" bgcolor="f6f6f6">은 행 명</td>
          <td align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input value="<?=$row[wc_pay_bank2]?>"  name="wc_pay_bank2" type="text"  class="input" id="wc_pay_bank2" size="20"/></td>
        </tr>
        <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">계좌번호</td>
          <td width="280" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input value="<?=$row[wc_pay_bank_no2]?>"  name="wc_pay_bank_no2" type="text"  class="input" id="wc_pay_bank_no2"  size="30"/></td>
          <td width="100" align="center" bgcolor="f6f6f6">예 금 주</td>
          <td width="275" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"> <input value="<?=$row[wc_pay_bank_name2]?>"  name="wc_pay_bank_name2" type="text"  class="input" id="wc_pay_bank_name2" size="20"/></td>
        </tr>
        <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">비용지급</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"> <input type="text" value="<?=$row[wc_pay_cost2] ? number($row[wc_pay_cost2]) : '0';?>"  name="wc_pay_cost2" style='width:90;' onkeyup="javascript:calculation(wc_pay_cost2);"/>
            원 &nbsp;&nbsp;메모 
            :
              <input  name="wc_pay_memo2" type="text" style='width:490;' value="<?=$row[wc_pay_memo2]?>" size="74" /></td>
        </tr>

      </table>
</td></tr></table>
<br />
 
<table width="780" border="0" cellspacing="0" cellpadding="0">
<tr> 
  <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle> <strong>대지급금2</strong></td>
</tr>
  <tr> 
    <td><table width="780" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0">
   
        <tr> 
          <td  width="100px" height="23" align="center" bgcolor="f6f6f6">지급일자</td>
          <td align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input type="text" value="<?=$row[wc_pay_date3]?>"  name="wc_pay_date3" style='width:90;' onclick="Calendar(wc_pay_date3)"> 
            <a class="hand" onclick="Calendar(wc_pay_date3)">[날짜선택]</a></td>
          <td align="center" bgcolor="f6f6f6">은 행 명</td>
          <td align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input value="<?=$row[wc_pay_bank3]?>"  name="wc_pay_bank3" type="text"  class="input" id="wc_pay_bank3" size="20"/></td>
        </tr>
        <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">계좌번호</td>
          <td width="280" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input value="<?=$row[wc_pay_bank_no3]?>"  name="wc_pay_bank_no3" type="text"  class="input" id="wc_pay_bank_no3"  size="30"/></td>
          <td width="100" align="center" bgcolor="f6f6f6">예 금 주</td>
          <td width="275" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"> <input value="<?=$row[wc_pay_bank_name3]?>"  name="wc_pay_bank_name3" type="text"  class="input" id="wc_pay_bank_name3" size="20"/></td>
        </tr>
        <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">비용지급</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"> <input type="text" value="<?=$row[wc_pay_cost3] ? number($row[wc_pay_cost3]) : '0';?>"  name="wc_pay_cost3" style='width:90;' onkeyup="javascript:calculation(wc_pay_cost3);"/>
            원 &nbsp;&nbsp;메모 
            :
              <input  name="wc_pay_memo3" type="text" style='width:490;' value="<?=$row[wc_pay_memo3]?>" size="74" /></td>
        </tr>

      </table>
</td></tr></table>
<br />
<table width="780" border="0" cellspacing="0" cellpadding="0">
<tr> 
  <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle><strong>대지급금3</strong></td>
</tr>
  <tr> 
    <td><table width="780" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0">
   
        <tr> 
          <td  width="100px" height="23" align="center" bgcolor="f6f6f6">지급일자</td>
          <td align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input type="text" value="<?=$row[wc_pay_date4]?>"  name="wc_pay_date4" style='width:90;' onclick="Calendar(wc_pay_date4)"> 
            <a class="hand" onclick="Calendar(wc_pay_date4)">[날짜선택]</a></td>
          <td align="center" bgcolor="f6f6f6">은 행 명</td>
          <td align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input value="<?=$row[wc_pay_bank4]?>"  name="wc_pay_bank4" type="text"  class="input" id="wc_pay_bank3" size="20"/></td>
        </tr>
        <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">계좌번호</td>
          <td width="280" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input value="<?=$row[wc_pay_bank_no4]?>"  name="wc_pay_bank_no4" type="text"  class="input" id="wc_pay_bank_no4"  size="30"/></td>
          <td width="100" align="center" bgcolor="f6f6f6">예 금 주</td>
          <td width="275" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"> <input value="<?=$row[wc_pay_bank_name4]?>"  name="wc_pay_bank_name4" type="text"  class="input" id="wc_pay_bank_name4" size="20"/></td>
        </tr>
        <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">비용지급</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"> <input type="text" value="<?=$row[wc_pay_cost4] ? number($row[wc_pay_cost4]) : '0';?>"  name="wc_pay_cost4" style='width:90;' onkeyup="javascript:calculation(wc_pay_cost4);"/>
            원 &nbsp;&nbsp;메모 
            :
              <input  name="wc_pay_memo4" type="text" style='width:490;' value="<?=$row[wc_pay_memo4]?>" size="74" /></td>
        </tr>

      </table>
</td></tr></table>
<br />
 
<table width="780" border="0" cellspacing="0" cellpadding="0">
<tr> 
  <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle> <strong>기타비용</strong></td>
</tr>
  <tr> 
    <td><table width="780" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0">
   
        <tr> 
          <td  width="100px" height="23" align="center" bgcolor="f6f6f6">지급일자</td>
          <td align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input type="text" value="<?=$row[wc_pay_date5]?>"  name="wc_pay_date5" style='width:90;' onclick="Calendar(wc_pay_date5)"> 
            <a class="hand" onclick="Calendar(wc_pay_date5)">[날짜선택]</a></td>
          <td align="center" bgcolor="f6f6f6">은 행 명</td>
          <td align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input value="<?=$row[wc_pay_bank5]?>"  name="wc_pay_bank5" type="text"  class="input" id="wc_pay_bank3" size="20"/></td>
        </tr>
        <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">계좌번호</td>
          <td width="280" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"><input value="<?=$row[wc_pay_bank_no5]?>"  name="wc_pay_bank_no5" type="text"  class="input" id="wc_pay_bank_no5"  size="30"/></td>
          <td width="100" align="center" bgcolor="f6f6f6">예 금 주</td>
          <td width="275" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"> <input value="<?=$row[wc_pay_bank_name5]?>"  name="wc_pay_bank_name5" type="text"  class="input" id="wc_pay_bank_name5" size="20"/></td>
        </tr>
        <tr> 
          <td height="23" align="center" bgcolor="f6f6f6">비용지급</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding:1 0 0 10; padding-left:10px;"> <input type="text" value="<?=$row[wc_pay_cost5] ? number($row[wc_pay_cost5]) : '0';?>"  name="wc_pay_cost5" style='width:90;' onkeyup="javascript:calculation(wc_pay_cost5);"/>
            원 &nbsp;&nbsp;메모 
            :
              <input  name="wc_pay_memo5" type="text" style='width:490;' value="<?=$row[wc_pay_memo5]?>" size="74" /></td>
        </tr>

      </table>
</td></tr></table>

-->
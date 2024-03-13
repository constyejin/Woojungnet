<style>
.imgs {margin:5px;border:1px solid #E6E6E6;}
</style>

<table width="900" border="0" cellspacing="0" cellpadding="0">
		</tr>
		  <tr> 
            <td align="left">
				<table style="width:100%;"><tr><td><span class="title"><img src="/manage/img/icon_1.jpg" class="bullet" /> <strong>진행구분</strong></span></td>
				</tr></table>
          </tr>
          <tr> 
          <td> <table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" class="table-style">
            <colgroup>
              <col style="width: 120px;">
              <col style="width: 330px;">
              <col style="width: 120px;">
              <col style="width: 330px;">
            </colgroup>
              <tr> 
                <td bgcolor="f6f6f6" class="table-th">접수일자</td>
                <td align="left" bgcolor="#FFFFFF" style=" padding-left:10px;"> 
                  <?
                  if($row[add_number]==1){
                    echo $row[wc_regdate];
                  }else{
                    echo $row[moddate];
                  }
                  ?>
                </td>
                <td class="table-th" bgcolor="f6f6f6">접수번호</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 
                  <?=$row[wc_orderno]?>                </td>
              </tr> 
              <tr> 
                <td class="table-th" bgcolor="f6f6f6">구 분</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><b> 
                  <?
                      //== /lib/code.php 안에 있음
                      WriteArrHTML('select', 'gubun2', $Arrgubun2, $row[wc_gubun2], $onscript, '' , 'direct', '');
                  ?> &gt;                       <span id='SearchGubun3'> 
                                          <?
                      //== /lib/code.php 안에 있음
                      if($row[wc_gubun2]) WriteArrHTML('select', 'gubun3', ${"Arrgubun3_".$row[wc_gubun2]}, $row[wc_gubun3], '', '' , 'direct', '');
                  ?>
                                        </span>  
                                          &gt; <?
                      //== /lib/code.php 안에 있음
                      WriteArrHTML('select', 'gubun4', $Arrgubun4, $row[wc_gubun4], '', '' , 'direct' , '');
                  ?>    </b>                  
                </td>
                <td class="table-th" bgcolor="f6f6f6" >내부담당자</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[in_name]?><b>				</td>
              </tr>

              <tr> 
          <td class="table-th" bgcolor="f6f6f6">경매시작가</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=number($row[wc_go_first_price])?></td>
          <td class="table-th" bgcolor="f6f6f6">매각유형</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">

<?
		//== /lib/code.php 안에 있음
		WriteArrHTML('radio', 'wc_go_type', $ArrgoSale, $row[wc_go_type], '', '' , 'direct', '');
?>		</td>
        </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6">비용정산</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">

<?
		//== /lib/code.php 안에 있음
		WriteArrHTML('radio', 'wc_go_cost_type', $ArrgoCost, $row[wc_go_cost_type], '', '' , 'direct', '');
?></td>
          <td class="table-th" bgcolor="#f6f6f6">상사이전비</td>
          <td  align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?if($row[sang_type]=="1"){echo "적용";}else{echo "미적용";}?></td>
        </tr>
        <tr>    
          <td class="table-th" bgcolor="f6f6f6">부가세적용</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><? if($row[vat]=="1"){echo "일반차량";}else if($row[vat]=="2"){echo "법인차량";} ?></td>
       </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6">입찰시작일</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?if($row[wc_go_start_date]!="" && $row[wc_go_start_date]!="--"){?><?=sReplace('date2', $row[wc_go_start_date]);?> <?=$row[wc_go_start_hh]?>시 <?=$row[wc_go_start_mm]?>분<?}?></td>
          <td class="table-th" bgcolor="f6f6f6">입찰종료일</td>
          <td valign="middle" bgcolor="#FFFFFF" style="padding-left:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="58%" align="left" valign="middle"><?if($row[wc_go_end_date]!="" && $row[wc_go_start_date]!="--"){?><?=sReplace('date2', $row[wc_go_end_date]);?>
                  <?=$row[wc_go_end_hh]?>
                  시
                  <?=$row[wc_go_end_mm]?>
                분 <?}?></td>
                <td width="42%" align="left" valign="top">
				        </td>
              </tr>
            </table></td>
        </tr>
        <tr>    
          <td class="table-th" bgcolor="f6f6f6">메 모</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><?=nl2br($row[wc_go_etc])?></td>
       </tr>


            </table></td>
        </tr>
</table>

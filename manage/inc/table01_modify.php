<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 
<script language="javascript" type="text/javascript">
 $(document).ready(function() {

  //******************************************************************************
  // 상세검색 달력 스크립트
  //******************************************************************************
  var clareCalendar = {
   monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
   dayNamesMin: ['일','월','화','수','목','금','토'],
   weekHeader: 'Wk',
   dateFormat: 'yy-mm-dd', //형식(20120303)
   autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
   changeMonth: true, //월변경가능
   changeYear: true, //년변경가능
   showMonthAfterYear: true, //년 뒤에 월 표시
   buttonImageOnly: true, //이미지표시
   buttonText: '달력선택', //버튼 텍스트 표시
   buttonImage: '/images/icon_data.gif', //이미지주소
   showOn: "both", //엘리먼트와 이미지 동시 사용(both,button)
   yearRange: '2010:<?=date("Y")+1?>' //1990년부터 2020년까지
  };
  $("#sdate").datepicker(clareCalendar);
  $("#edate").datepicker(clareCalendar);
  $("#adate").datepicker(clareCalendar);
  $("#bdate").datepicker(clareCalendar);
  $("#cdate").datepicker(clareCalendar);
  $("#jdate").datepicker(clareCalendar);
  $("#wc_pay_date1").datepicker(clareCalendar);
  $("#wc_pay_date2").datepicker(clareCalendar);
  $("#wc_pay_date3").datepicker(clareCalendar);
  $("#wc_pay_date4").datepicker(clareCalendar);
  $("#wc_pay_date5").datepicker(clareCalendar);
  $("#wc_pay_date6").datepicker(clareCalendar);
  $("#wc_pay_date7").datepicker(clareCalendar);

  $("#im_date").datepicker(clareCalendar);
  

  $("img.ui-datepicker-trigger").attr("style","margin-left:5px; vertical-align:middle; cursor:pointer;"); //이미지버튼 style적용
  $("#ui-datepicker-div").hide(); //자동으로 생성되는 div객체 숨김  
 });
</script>
<style>
.ui-datepicker select.ui-datepicker-month{ width:30%;  }
.ui-datepicker select.ui-datepicker-year{ width:40%; }
</style>

<table>
          <tr> 
            <td class="title"><div align="left"><img src="/manage/img/icon_1.jpg" class="bullet" /> <strong>진행구분</strong></div></td>
          </tr>
           <tr> 
            <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" class="table-style">
            <colgroup>
              <col style="width: 120px;">
              <col style="width: 330px;">
              <col style="width: 120px;">
              <col style="width: 330px;">
            </colgroup>
              <tr> 
                <td class="table-th" align="center" bgcolor="f6f6f6" >접수일자</td>
                <td align="left" bgcolor="#FFFFFF" style=" padding-left:10px;"> 
                  <?=$row[wc_regdate]?>                </td>
                <td class="table-th" bgcolor="f6f6f6" >접수번호</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 
                  <?=$row[wc_orderno]?>
                </td>
              </tr>
              <tr> 
                <td class="table-th" bgcolor="f6f6f6" >구 분</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 
    <?
		//== /lib/code.php 안에 있음
		//WriteArrHTML('select', 'gubun1', $Arrgubun1, $row[wc_gubun1], '', '' , 'all' );

		//if($row[wc_gubun1] != "2"){
?>
<?

		//== /lib/code.php 안에 있음
		$onscript = "onchange=\"if(this.value)CallsubGubun('SearchGubun3','select', 'gubun3', this.value, '".$row[wc_gubun3]."', '', '', 'all', '::선택::');\"";
		WriteArrHTML('select', 'gubun2', $Arrgubun2, $row[wc_gubun2], $onscript, '' , 'all');
?>


	<span id='SearchGubun3'>
<?
		//== /lib/code.php 안에 있음
		WriteArrHTML('select', 'gubun3', ${"Arrgubun3_".$row[wc_gubun2]}, $row[wc_gubun3], '', '' , 'all');
?>
	</span>

<?
		//== /lib/code.php 안에 있음
		$onscript = "onclick=\"if(!document.outForm.gubun3.value){alert('구분을 선택해 주세요.');this.options[0].selected=true;}\"";
		WriteArrHTML('select', 'gubun4', $Arrgubun4, $row[wc_gubun4], $onscript, '' , 'all' );
		//}
?>                  </td>
                <td class="table-th" bgcolor="f6f6f6" >내부담당자</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                    <select name="in_name">
                      <option value="">:: 선택 ::</option>
                <?
                      $qry = "SELECT * FROM woojung_admin order by orderval asc,   waidx asc "; 
                      $arr = Fetch_string($qry);

                    for($i=0;$i<count($arr);$i++){	
                ?>
                        <option value="<?=$arr[$i][waname]?>" <?=$arr[$i][waname]==$row[in_name]?"selected":""?>><?=$arr[$i][waname]?></option>
                <?
                    }
                ?>
					          </select>
                </td>
              </tr>
              <tr> 
                <td class="table-th" bgcolor="f6f6f6" >경매시작가</td>
                <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> <input type="text" value="<?=num_ys($row[wc_go_first_price])?>"  name="wc_go_first_price" style='width:150;' onKeyup="javascript:calculation5(wc_go_first_price);">          </td>
                <td class="table-th" bgcolor="f6f6f6" >매각유형</td>
                <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;">

      <?
          if(!$row[wc_go_type])$row[wc_go_type]="3";
          //== /lib/code.php 안에 있음
          WriteArrHTML('radio', 'wc_go_type', $ArrgoSale, $row[wc_go_type], '', '' , 'all', '');
      ?>		</td>
              </tr>
              <tr> 
                <td class="table-th" bgcolor="f6f6f6" >비용정산</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            
      <?
          //== /lib/code.php 안에 있음
          WriteArrHTML('radio', 'wc_go_cost_type', $ArrgoCost, $row[wc_go_cost_type]?$row[wc_go_cost_type]:'2', '', '' , 'all', '');
      ?></td>
                <td class="table-th" bgcolor="#f6f6f6" >상사이전비</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input name="sang_type" type="radio" id="radio" value="1"  <?if($row[sang_type]=="1"||!$wc_idx) echo "checked";?>/> 적용
                <input type="radio" name="sang_type" id="radio2" value="" <?if($row[sang_type]==""&&$wc_idx) echo "checked";?>/> 미적용</td>
              </tr>
              <tr>    
                <td class="table-th" bgcolor="f6f6f6" >부가세적용</td>
                <td colspan="3" align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><input name="vat" type="radio" id="radio6" value="1"  <?if($row[vat]=="1"||!$wc_idx) echo "checked";?>/>
              일반차량 
              <input name="vat" type="radio" id="radio7" value="2"  <?if($row[vat]=="2") echo "checked";?>/> 법인차량 <font color="#FF0000">(법인차량으로 선택시 부가세가 합산되어 청구됩니다)</font></td>
            </tr>
                    <tr>
                <td class="table-th" bgcolor="f6f6f6" >입찰시작일</td>
                <td colspan="3" align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><input  name="wc_go_start_date" type="text" style='width:80px;' value="<?=$row[wc_go_start_date]?$row[wc_go_start_date]:date("Y-m-d")?>" size="14" id="sdate"> 
                  
                  시간 
                  <select  name="wc_go_start_hh" style="min-width: 0;">
            <?
              for($i=0 ; $i < 25 ; $i++){
                if($i < 10) $ii ="0".$i;
                else  $ii = $i;

                if($row[wc_go_start_hh] == $ii) $sel = "selected";
                else $sel="";
            ?>
                    <option value="<?=$ii?>" <?=$sel?>><?=$i?>시</option>
                  <?
              }
            ?>
                  </select>
                  시 
                  <select  name="wc_go_start_mm" style="min-width: 0;">
            <?
              for($i=0 ; $i < 60 ; $i++){
                if($i < 10) $ii = "0".$i;
                else  $ii = $i;

                if($row[wc_go_start_mm] == $ii) $sel = "selected";
                else $sel="";
            ?>
                    <option value="<?=$ii?>" <?=$sel?>><?=$ii?>분</option>
                <?
              }
            ?>  
                  </select>
                  분</td>
              </tr>
                    <tr>
                <td class="table-th" bgcolor="f6f6f6" >입찰종료일</td>
                <td colspan="3" align="left" valign="middle" bgcolor="#FFFFFF"  style="padding-left:10px;"><input  name="wc_go_end_date" type="text" style='width:80px;' value="<?=$row[wc_go_end_date]?>" size="12" id="edate"> 
                  시간 
                <select  name="wc_go_end_hh" style="min-width: 0;">
            <?
              for($i=0 ; $i < 25 ; $i++){
                if($i < 10) $ii ="0".$i;
                else  $ii = $i;

                if($row[wc_go_end_hh] == $ii) $sel = "selected";
                else $sel="";
            ?>
                    <option value="<?=$ii?>" <?=$sel?>><?=$i?>시</option>
                  <?
              }
            ?>
                  </select>
                  시 
                  <select   name="wc_go_end_mm" style="min-width: 0;">
            <?
              for($i=0 ; $i < 60 ; $i++){
                if($i < 10) $ii = "0".$i;
                else  $ii = $i;

                if($row[wc_go_end_mm] == $ii) $sel = "selected";
                else $sel="";
            ?>
                    <option value="<?=$ii?>"  <?=$sel?>><?=$ii?>분</option>
                <?
              }
            ?>  
                  </select>
                분 <font color="#FF0000"><? //최종변경:2016-12-01 12:00 / 홍길동 ?></font>
                  <input type="button" value=" 09:30 " onClick="tim(1)" class="btn-lightblue ml-10">
                  <input type="button" value=" 10:30 " onClick="tim(2)" class="btn-lightblue">
                  <input type="button" value=" 12:30 " onClick="tim(5)" class="btn-lightblue">
                  <input type="button" value=" 13:30 " onClick="tim(3)" class="btn-lightblue">
                  <input type="button" value=" 15:30 " onClick="tim(4)" class="btn-lightblue">
                </td>
              </tr>
          <tr>
                <td class="table-th" bgcolor="f6f6f6" >메 모</td>
                <td colspan="3" align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><textarea  name="wc_go_etc" rows="3" style='width:95%;'><?=$row[wc_go_etc]?></textarea></td>
            </tr>
              </table></td>
          </tr>
          
</table>
<script>
function tim(a){
	if(a==1){
		document.outForm.wc_go_end_hh.options[9].selected="true";
		document.outForm.wc_go_end_mm.options[30].selected="true";
	}else if(a==2){
		document.outForm.wc_go_end_hh.options[10].selected="true";
		document.outForm.wc_go_end_mm.options[30].selected="true";
	}else if(a==3){
		document.outForm.wc_go_end_hh.options[13].selected="true";
		document.outForm.wc_go_end_mm.options[30].selected="true";
	}else if(a==4){
		document.outForm.wc_go_end_hh.options[15].selected="true";
		document.outForm.wc_go_end_mm.options[30].selected="true";
	}else if(a==5){
		document.outForm.wc_go_end_hh.options[12].selected="true";
		document.outForm.wc_go_end_mm.options[30].selected="true";
	}
}
</script>

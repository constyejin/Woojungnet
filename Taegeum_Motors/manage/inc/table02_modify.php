<script language="JavaScript" type="text/javascript">
function si_chk(z){ 
	var tmp = z.options[z.selectedIndex].value; 
	document.outForm.car_name.options[0].selected="true";
	gufrm.location.href = "/manage/inc/gu.php?tmp="+tmp;  
} 
function car_chk(z){ 
	var tmp = z.options[z.selectedIndex].value; 
	document.outForm.car_cate2.options[0].selected="true";
	gufrm.location.href = "/admin/inc/car.php?tmp="+tmp;  
} 
</script>
<?
if($row[wc_made]){
?>
<style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>

<iframe name="gufrm" style="display:none;" src="/manage/inc/gu.php?tmp=<?=$row[wc_made]?>"></iframe>
<?}else{?>
<iframe name="gufrm" style="display:none;" src=""></iframe>
<?}?>
<table>
  <tr> 
    <td class="title"><div align="left"><img src="/manage/img/icon_1.jpg" class="bullet"/> 
        <strong>출품자정보</strong></div></td>
</tr>
  <tr> 
    <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2"  class="ex table-style" style="padding:0px;">
    <colgroup>
      <col style="width: 120px;">
      <col style="width: 330px;">
      <col style="width: 120px;">
      <col style="width: 330px;">
    </colgroup>
     <tr>
              <td class="table-th" bgcolor="f6f6f6">신청구분</td>
              <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left: 10px;">
               <input type='radio' name='calltype' value='폐차'  <?if($row[calltype]=="폐차") echo "checked"; ?>  >
                폐차 
              <input type='radio' name='calltype' value='명의이전'    <?if($row[calltype]=="명의이전") echo "checked"; ?>> 명의이전 <input type='radio' name='calltype' value='폐차/이전'    <?if($row[calltype]=="폐차/이전") echo "checked"; ?>> 폐차/이전 
              </td>
      </tr>   <tr>
              <td class="table-th" bgcolor="f6f6f6">사고유형</td>
              <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left: 10px;">
			<?
			//== /lib/code.php 안에 있음
			WriteArrHTML('checkbox', 'acctype[]', $ArrcarAcc, $row[acctype], '', 7, 'all', '');
		   ?> 
			</td>
      </tr>
        <tr > 
          <td class="table-th" bgcolor="f6f6f6">신 청 자</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> <input name="call_name" type="text" id="call_name" value="<?=$row[wc_mem_name]?$row[wc_mem_name]:$loginName?>" size="20" class="input" required="required" hname='신 청 자' /> <font style="color:red">(<?=grade_sort($row_mem['usort'])?>)</font>
          </td>
          <td class="table-th" bgcolor="f6f6f6">일반전화</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 


		  <?
		  if($wc_idx){
				if($row[company_tel] && $row[company_tel]!="--"){
					$tel = $row[company_tel];
				}else if($row[wc_mem_phone] && $row[wc_mem_phone]!="--"){
					$tel = $row[wc_mem_phone];
				}else if($row[wc_owner_tel] && $row[wc_owner_tel]!="--"){
					$tel = $row[wc_owner_tel];
				}
			}else {
				$tel = $row[tel];
			}

		  $arrphone = explode("-", $tel);
		  ?>
            <input name="call_tel" type="text"  class="input" value="<?=$arrphone[0]?>" size="7" maxlength="4"/>
            - 
            <input name="call_tel2" type="text"  class="input" id="call_tel22" value="<?=$arrphone[1]?>" size="7" maxlength="4"/>
            - 
          <input name="call_tel3" type="text"  class="input" id="call_tel32" value="<?=$arrphone[2]?>" size="7" maxlength="4"/></td>
      </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6">업체명</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
<?
	// 제휴 회원이라면
	echo $row[company_name];
	if($row[wc_mem_mobile] == ""){
		$arrPcs = explode("-", $row[pcs]);
	}else{
		$arrPcs = explode("-", $row[wc_mem_mobile]);
	}

	if($row[wc_mem_fax] == ""){
		$arrFax = explode("-", $row[fax]);
	}else{
		$arrFax = explode("-", $row[wc_mem_fax]);
	}

	$arrclerkTel = explode("-", $row[wc_clerkTel]);

	$botel = explode("-", $row[botel]);

?>			</td>
          <td class="table-th" bgcolor="f6f6f6">휴대전화</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
            <input name="call_pcs1" type="text"  class="input" id="call_pcs1" value="<?=$arrPcs[0]?>" size="7" maxlength="4" required="required" hname='휴대전화' >
            - 
            <input name="call_pcs2" type="text" class="input" id="call_pcs2" value="<?=$arrPcs[1]?>" size="7" maxlength="4" required="required" hname='휴대전화' />
            - 
            <input name="call_pcs3" type="text"  class="input" id="call_pcs3" value="<?=$arrPcs[2]?>" size="7" maxlength="4" required="required" hname='휴대전화' />		  </td>
      </tr>
      <!--tr> 
          <td class="table-th" bgcolor="f6f6f6">보상담당자</td>
		  <td height="20" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
			<input type="text" name="bodam" style='width:150;' value="<?=$row[bodam]?>"></td>
			<td class="table-th" bgcolor="f6f6f6">연락처</td>
			<td height="20" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
			<input name="botel1" type="text"  value="<?=$botel[0]?>" size="7" maxlength="4" >
            - 
            <input name="botel2" type="text" value="<?=$botel[1]?>" size="7" maxlength="4" >
            - 
            <input name="botel3" type="text"  value="<?=$botel[2]?>" size="7" maxlength="4" ></td>
      </tr> 
      <tr> 
		<td class="table-th" bgcolor="f6f6f6">조직명</td>
		<td height="20" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
		<input type="text" name="orm" style='width:150;' value="<?=$row[orm]?>"></td>
		<td class="table-th" height="20" align="center" bgcolor="f6f6f6">직책</td>
		<td height="20" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="orm2" style='width:150;' value="<?=$row[orm2]?>"></td>
      </tr--> 
      <tr>
	    <td class="table-th" width="100" bgcolor="f6f6f6">제휴사접수번호</td>
	    <td height="23" align="left" bgcolor="#FFFFFF" style="padding-left: 10px;"><input type="text" name="jnumber" style='width:150;' value="<?=$row[jnumber]?>"/></td>
		<td class="table-th" bgcolor="f6f6f6">담보</td>
		<td height="20" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type='radio' name='dambo1' value='자차'  <?if($row[dambo1]=="자차") echo "checked"; ?> /> 자차 <input type='radio' name='dambo1' value='대물'  <?if($row[dambo1]=="대물") echo "checked"; ?> />  대물 </td>
	  </tr>
<?
	$dambo3 = explode("/", $row[dambo3]);
?>
      <tr> 
		<td class="table-th" bgcolor="f6f6f6">은행명</td>
		<td height="20" colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
		은행
		<input type="text" name="dambo3_1" style='width:100px;' value="<?=$dambo3[0]?>">            
		/ 계좌번호            
		<input type="text" name="dambo3_2" style='width:180px;' value="<?=$dambo3[1]?>"/> 
		예금주 
		<input type="text" name="dambo3_3" style='width:180px;' value="<?=$dambo3[2]?>"/></td>
        </tr> 
    </table></td>
  </tr>
 </table>
<br>

<?
if($row[wc_made]){
?>
<style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>

<iframe name="gufrm" style="display:none;" src="/admin/inc/gu.php?tmp=<?=$row[wc_made]?>"></iframe>
<?}else{?>
<iframe name="gufrm" style="display:none;" src=""></iframe>
<?}?>
<table>
 
  <tr> 
    <td class="title"><div align="left"><img src="/manage/img/icon_1.jpg" class="bullet" /> 
        <strong>차량정보</strong></div></td>
</tr>
<script>
	function check_num_Window(){		
		var frm = document.outForm;
		var id = frm.carno.value;
		
		if(!frm.carno.value){		
			alert("차량번호를 입력해주세요");
			frm.carno.focus();
			return;
		}
		
		document.getElementById("HiddenFrm").src="/manage/inc/carnum_check.php?carno="+id;
	}	

</script>
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
  <tr> 
    <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" class="ex table-style">
    <colgroup>
      <col style="width: 120px;">
      <col style="width: 330px;">
      <col style="width: 120px;">
      <col style="width: 330px;">
    </colgroup>
<tr > 
	<td class="table-th" bgcolor="f6f6f6">차량번호</td>
	<td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input name="carno" type="text"  class="input"  value="<?=$row[wc_no]?>" size="20" maxlength="50"/>
    <span style="padding:10 0 0 5">  <input type="button" value="중복확인" class="Submit2222222" onClick="check_num_Window();" style="cursor:pointer; background-color:#f9e9e9; color:#ff0000; border:#636563 1px solid; padding:5 3 3 3; font-size:12px; height:20px; width:70px;"/><input type="hidden" name="carno_c" value="0"></td>
  <td class="table-th" bgcolor="f6f6f6" >보 험 사</td>
  <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
    <select name="car_cate" onchange="car_chk(this)">
			  <option value="" selected>:: 선택 ::</option>
			   <?
			   $team_cate_sql=mysql_query("select * from team_cate where depth='1'");
			   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
			   <option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$row[car_cate]){ echo "selected"; }?>><?=$team_cate["name"]?></option>
			   <?}?>
	  </select>
    <select name="car_cate2">
      <option value="" selected="selected">:: 팀명 ::</option>
<?
if($row[car_cate2]){
	$team_cate_sql=mysql_query("select * from team_cate where code='$row[car_cate]'");
	while($team_cate=mysql_fetch_array($team_cate_sql)){
?>
				<option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$row[car_cate2]){ echo "selected"; }?>>
				<?=$team_cate["name"]?>
				</option>
<?
	}
}
?>
    </select></td>        
        </tr>
		<tr > 
			<td class="table-th" bgcolor="f6f6f6">차대번호</td>
			<td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input name="wc_prog_area_price" type="text"  class="input"  value="<?=$row[wc_prog_area_price]?>" size="42" maxlength="100"/>
			</td>
		  <td class="table-th" bgcolor="f6f6f6">전손/분손</td>
		  <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input name="evalAmt_type" type="radio" value="전손" <? if($row[evalAmt_type]=="전손"){echo "checked";} ?>/> 전손 <input name="evalAmt_type" type="radio" value="분손" <? if($row[evalAmt_type]=="분손"){echo "checked";} ?>/> 분손 <input type="radio" name="evalAmt_type" value="일반" <?if($row[evalAmt_type]=="일반") echo "checked";?>> 일반</td>
    </tr> 
    <tr > 
      <td class="table-th" bgcolor="f6f6f6">제조사</td>
      <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 
			<select name="made" onchange="si_chk(this)">
			<option value="" selected>:: 제조사 ::</option>
<?
	$sql="select * from cate2 where depth='1' ";
	$result_made=mysql_query($sql);
	while($data_made=mysql_fetch_array($result_made)){
	?>
				<option value="<?=$data_made[idx]?>" <?if($row[wc_made]==$data_made[idx]) echo "selected";?>><?=$data_made[name]?></option>
	<?
	}
?>
			</select>
			</td>
          <td class="table-th" bgcolor="f6f6f6">모 델 명</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
			<select name="car_name">
			<option value="" selected>:: 모델명 ::</option>
<?
	if($row[wc_made]){
		$sql="select * from cate2 where code='$row[wc_made]' order by name asc";
		$result_made=mysql_query($sql);
		while($data_made=mysql_fetch_array($result_made)){
	?>
				<option value="<?=$data_made[name]?>" <?if($row[wc_model]==$data_made[name]) {echo "selected";}?>><?=$data_made[name]?></option>
	<?
		}
	}
?>
			</select>
          <input type="text" name="car_name2"  value="<?=$row[wc_model2]?>" style='width:150px;'  />           </td>
      </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6">년식(등록일)</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input name="car_year_yy" type="text"  size="5" value="<?=substr($row[wc_age],0,4)?>"/>
          년
          <select name="car_year_mm" class="form_select">
			<option value="">::월::</option>
			<? for($i=1;$i<=12;$i++){ ?>
			<option value="<?=sprintf("%02d",$i)?>" <?if(sprintf("%02d",$i)==substr($row[wc_age],4,2)){ echo "selected"; }?>><?=$i?>월</option>
			<? } ?>
		  </select>
          &nbsp;&nbsp;&nbsp;&nbsp;예: 2014 년 01 월
		  </td>
          <td class="table-th" bgcolor="f6f6f6">변 속 기</td>
          <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">  
			<select name="trans">
			<option value="" selected>:: 변속기 ::</option>
<?
$sql="select * from cate where code='1' ";
$result_made=mysql_query($sql);
while($data_made=mysql_fetch_array($result_made)){
?>
			<option value="<?=trim($data_made[name])?>" <?if(trim($row[wc_trans])==trim($data_made[name])) echo "selected";?>><?=$data_made[name]?></option>
<?
}
?>
			</select>
			</td>
      </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6" >연 료</td>
          <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> 
			<select name="fual">
			<option value="" selected>:: 연료 ::</option>
<?
$sql="select * from cate where code='2' ";
$result_made=mysql_query($sql);
while($data_made=mysql_fetch_array($result_made)){
?>
			<option value="<?=$data_made[name]?>" <?if($row[wc_fual]==$data_made[name]) echo "selected";?>><?=$data_made[name]?></option>
<?
}
?>
			</select> 
			</td>
          <td class="table-th" bgcolor="f6f6f6">배 기 량</td>
          <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> <input type="text" name="carcc" value="<?=num_ys($row[wc_cc])?>" style='width:100;' onKeyup="javascript:calculation5(carcc);">
            cc </td>
      </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6">주행거리</td>
          <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> <input type="text" name="carmile"  value="<?=num_ys($row[wc_mileage])?>" style='width:100;' onKeyup="javascript:calculation5(carmile);">
            km</td>
          <td class="table-th" bgcolor="f6f6f6">세전출고가</td>
          <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> <input type="text" name="carprice" value="<?=num_ys($row[wc_price])?>" style='width:100;' onKeyup="javascript:calculation5(carprice);">
            원 </td>
      </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6">예상수리비</td>
          <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> <input type="text" name="carcost"  value="<?=num_ys($row[wc_cost])?>"  style='width:100;' onKeyup="javascript:calculation5(carcost);">
            원 </td>
          <td class="table-th" bgcolor="f6f6f6">사고발생일</td>
          <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> <input type="text" id="jdate" name="caraccdate" value="<?=$row[wc_acc_date]?>" style='width:100;' > 
           </td>
      </tr>
      
        <tr> 
          <td class="table-th" bgcolor="f6f6f6">발생비용</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF"  style="padding-left:10px;">
			<input  name="wc_go_cost" type="text" id="wc_go_cost" style='width:100px;'   value="<?=num_ys($row[wc_go_cost])?>" class="read-only" onkeyup="javascript:calculation5(wc_go_cost);" />원 / 견인비,보관비,기타등</td>
      </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6">차량설명</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF"  style="padding:2px 10px; "><textarea name="car_memo" id="car_memo" style='width:95%;' rows="10" wrap="hard"><?=$row[wc_damage]?></textarea></td>
      </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6">입고일자</td>
          <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><input type="text" name="wrhsDate" value="<?=$row[wrhsDate]?>" style='width:50%;' />
            <span class="style1">예:2014-01-01</span></td>
          <td class="table-th" bgcolor="f6f6f6">보관장소1</td>
          <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> <input type="text" name="moveKeepReq" value="<?=$row[moveKeepReq]?>" style='width:90%;'>          </td>
      </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6">보관지역</td>
          <td align="left" bgcolor="#FFFFFF" class="ex2"  style="padding-left:10px;">
		<?
		//== /lib/code.php 안에 있음
		WriteArrHTML('select', 'area1', $ArrcarPlace , $row[wc_keep_area1], '', '' , 'all', '::선택::' );
		?>
		  </td>
          <td class="table-th" bgcolor="f6f6f6">보관장소2</td>
          <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> 
		<input type="text" name="place1" value="<?=$row[wc_keep_place1]?>" style='width:90%;'>          </td>
      </tr>
<?
	$wc_keep_tel1 = explode("-", $row[wc_keep_tel1]);
?>
		<tr> 
          <td class="table-th" bgcolor="f6f6f6">보관소연락처</td>
          <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;">
		  <input name="wc_keep_tel_1" type="text"  value="<?=$wc_keep_tel1[0]?>" style='width:15%;'>
		  - <input name="wc_keep_tel_2" type="text"  value="<?=$wc_keep_tel1[1]?>" style='width:20%;'>
		  - <input name="wc_keep_tel_3" type="text"  value="<?=$wc_keep_tel1[2]?>" style='width:20%;'>
		  </td>
          <td class="table-th" bgcolor="f6f6f6">담 당 자</td>
          <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> <input type="text" name="keep_name1" value="<?=$row[wc_keep_name1]?>" style='width:90%;'>          </td>
      </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6">소유형태</td>
          <td colspan="3" align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> 

		<?
			//== /lib/code.php 안에 있음
			WriteArrHTML('radio', 'ArrcarOwner', $ArrcarOwner, $row[wc_ownertype], '', '', 'all', '');
		   ?>		   </td>
      </tr>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6">차 주 명</td>
          <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> <input name="owner_name" type="text"  class="input" id="owner_name" value="<?=$row[wc_owner]?>" size="35"/></td>
          <td class="table-th" bgcolor="f6f6f6">차주연락처</td>
          <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> 
		  
	<?
	 $arrownertel = explode("-", $row[wc_owner_tel]);
	?>		  
		  
		  <input name="owner_tel1" type="text"  class="input" id="owner_tel1" value="<?=$arrownertel[0]?>" size="7" maxlength="4"/>
            - 
            <input name="owner_tel2" type="text"  class="input" id="owner_tel2" value="<?=$arrownertel[1]?>" size="7" maxlength="4"/>
            - 
            <input name="owner_tel3" type="text"  class="input" id="owner_tel3" value="<?=$arrownertel[2]?>" size="7" maxlength="4"/>          </td>
      </tr>
		<tr> 
          <td class="table-th" bgcolor="f6f6f6">사진등록<br> </td>
          <td colspan="3" align="left" bgcolor="#FFFFFF"  style="padding:5 10 5 10"><table width="98%" height="71" border="0" class="ex2">
              <tr> 
                <td height="33" style="padding-left:10px;"><input type="button" value="사진파일찾기" class="btn-lightblue" onClick="window.open('/manage/inc/FileUpload3.php?wc_idx=<?=$wc_idx?>','Upload','width=1200, height=1000');" style="cursor:pointer;"/></td>
              </tr>
            </table></td>
      </tr>
      </table></td>
  </tr>

</table>


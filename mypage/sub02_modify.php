<?include "../inc/header.php" ?>
<?
	$qry = "select * from woojung_car2 as a 
			left join woojung_car_go as b on a.wc_idx = b.wcg_wcidx 		
			where a.wc_idx = '$wc_idx'  ";

	
	$row = mysql_fetch_array(mysql_query($qry));
?>
<? $menuNow ="?pageNum=1&subNum=1"; ?>

<script language="JavaScript" src="/admin/inc/default.js"></script>
<script language="JavaScript" type="text/javascript">
function si_chk(z){ 
	var tmp = z.options[z.selectedIndex].value; 
	document.outForm.car_name.options[0].selected="true";
	gufrm.location.href = "/admin/inc/gu.php?tmp="+tmp;  
} 
</script>
<?
if($row[wc_made]){
?>
<iframe name="gufrm" style="display:none;" src="/admin/inc/gu.php?tmp=<?=$row[wc_made]?>"></iframe>
<?}else{?>
<iframe name="gufrm" style="display:none;" src=""></iframe>
<?}?>

<!-- 마이페이지독립 css -->
<style type="text/css">
.join_img_body { position:relative;  margin-top:40px; }
.join_area p {text-align:left; margin:10px 0;}
.join_img_body table.join_form tr th { background:#f7f7f7; border:1px solid #666666; font-weight:normal; }
.join_img_body table.join_form tr td { text-align:center; padding:2px 2px 2px 2px; color:#000000; border:1px solid #949294;}
input[type=text] { padding:1px 1px 1px 1px; border:1px solid #008ad9; height:17px; }
.join_img_body table.join_form tr td  table { padding:0; margin:0; }
.join_img_body table.join_form tr td  table tr td { padding:0; margin:0; border:none; padding:2px 2px 2px 2px; }
..join_area p.s_title { font-size:10pt; font-weight:bold; }
.style1 {font-weight: bold}
</style>



<div id="new_wrap">

	<div id="main_wrap">
		<div id="cha_contents">
			<!-- login -->
			<div id="con_left">
<?include "../inc/login.php";?>
				<!-- 좌측 서브 메뉴 start -->
<?include "mypage_menu.php";?>
				<!-- 좌측 서브 메뉴 end -->
			</div>
			<div id="con_right">
				<h1><img src="/images/img_sub1.jpg"></h1>
				<table width="760" border="0" cellspacing="0" cellpadding="0">
					<tr> 
						<td height="1"></td>
					</tr>
					<tr> 
						<td height="38" align="left" valign="bottom"><img src="/images/img_mypage_2_bar.gif" /></td>
					</tr>
				</table>	
			<!--컨텐츠 부분-->
			  <table>
				  <tr> 
					<td>&nbsp;</td>
				  </tr>
				  <tr> 
					<td height="7"></td>
				  </tr>
				  <!--출품자정보-->
				  <tr> 
    <td class="title"><img src="/admin/img/icon02.gif" width="15" height="15" ALIGN=absmiddle> 
      출품자정보</td>
  </tr>
<form name="outForm" method="post" action="sub02_update.php" enctype="multipart/form-data" onsubmit="return ChkAuction()">
<input type="hidden" name="mode" value="modify">
<input type="hidden" name="wc_idx" value="<?=$wc_idx?>">
<input type="hidden" name="wc_go_idx" value="<?=$row[wc_go_idx]?>">
<input type="hidden" name="aucidx" value="<?=$aucidx?>">
<input type="hidden" name="aucorderNo" value="<?=$aucNo?>">
<input type="hidden" name="href" value="<?=$href?>">
  <tr> 
    <td><table width="780"  class="ex">
    <tr>
    <td width="96" height="20" align="center"  bgcolor="f6f6f6">진행상태</td>
    <td colspan="3"  style="padding-left:10px;">          <input type="radio" name="calltype" id="radio" value="대기" <?if($row[calltype]=="대기") echo "checked"; ?>/>
    대기
          <input type="radio" name="calltype" id="radio2" value="판매" <?if($row[calltype]=="판매") echo "checked"; ?>/>
          판매
          <input type="radio" name="calltype" id="radio3" value="완료" <?if($row[calltype]=="완료") echo "checked"; ?>/>
          완료</td>

    </tr>
        <tr > 
          <td bgcolor="f6f6f6" align="center">담 당 자</td>
          <td width="286" style="padding-left:10px;"><input name="call_name" type="text" id="call_name" value="<?=$row[wc_mem_name]?$row[wc_mem_name]:$loginName?>" size="20" class="input" required="required" hname='신 청 자' />          </td>
          <td width="90" align="center" bgcolor="f6f6f6">일반전화</td>
          <td width="288" style="padding-left:10px;"> 


		  <?
			if($row[company_tel] && $row[company_tel]!="--"){
				$tel = $row[company_tel];
			}else if($row[wc_mem_phone] && $row[wc_mem_phone]!="--"){
				$tel = $row[wc_mem_phone];
			}else if($row[wc_owner_tel] && $row[wc_owner_tel]!="--"){
				$tel = $row[wc_owner_tel];
			}else {
				$tel = $row[tel];
			}

		  $arrphone = explode("-", $tel);
		  ?>
            <input name="call_tel" type="text"  class="input" value="<?=$arrphone[0]?>" size="7" maxlength="4"/>
            - 
            <input name="call_tel2" type="text"  class="input" id="call_tel22" value="<?=$arrphone[1]?>" size="7" maxlength="4"/>
            - 
            <input name="call_tel3" type="text"  class="input" id="call_tel32" value="<?=$arrphone[2]?>" size="7" maxlength="4"/>          </td>
      </tr>
        <tr> 
          <td  align="center" bgcolor="f6f6f6">업 체 명</td>
          <td style="padding-left:10px;"><input name="wc_adminName" type="text" id="wc_adminName" value="<?=$row[wc_adminName]?>" size="20" class="input" required="required" hname='업체명' />
<?
			
	// 제휴 회원이라면
	if( substr($row['usort'], 0, 3) == "com" ){
		$companyNm = $row[team_name];
		$companysubNm = $row[team_subname];
		echo $companyNm ."/". $companysubNm;
	}	





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



?>		  </td>
          <td align="center" bgcolor="f6f6f6">휴대전화</td>

	
          <td style="padding-left:10px;">
          
		  
		  
            <input name="call_pcs1" type="text"  class="input" id="call_pcs1" value="<?=$arrPcs[0]?>" size="7" maxlength="4" required="required" hname='휴대전화' >
            - 
            <input name="call_pcs2" type="text" class="input" id="call_pcs2" value="<?=$arrPcs[1]?>" size="7" maxlength="4" required="required" hname='휴대전화' />
            - 
            <input name="call_pcs3" type="text"  class="input" id="call_pcs3" value="<?=$arrPcs[2]?>" size="7" maxlength="4" required="required" hname='휴대전화' />		  </td>
        </tr>
        <tr> 
          <td align="center" bgcolor="f6f6f6">이 메 일</td>
          <td style="padding-left:10px;"><input type="text" name="wc_mem_etc" style='width:150;' value="<?=$row[wc_mem_etc]?>"></td>
          <td align="center" bgcolor="f6f6f6">팩스번호</td>
         <td style="padding-left:10px;"><input name="fax1" type="text"  value="<?=$arrFax[0]?>" size="7" maxlength="4" >
            - 
            <input name="fax2" type="text" value="<?=$arrFax[1]?>" size="7" maxlength="4" >
            - 
            <input name="fax3" type="text"  value="<?=$arrFax[2]?>" size="7" maxlength="4" ></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td class="title"><img src="/admin/img/icon02.gif" width="15" height="15" ALIGN=absmiddle> 
      차량정보</td>
  </tr>
<script>
	function check_num_Window(){		
		var frm = document.outForm;
		var id = frm.carno.value;
		
		if(!frm.carno.value){		
			alert("차량번호를 입력해주세요");
			frm.userId.focus();
			return;
		}
		
		document.getElementById("HiddenFrm").src="/sub05/carnum_check.php?carno="+id;
	}	

</script>
<iframe name="HiddenFrm" style="display:none;"></iframe>
  <tr> 
    <td><table width="780" class="ex">
<tr > 
          <td width="97" align="center" bgcolor="f6f6f6">차량번호</td>
			<td width="294" style="padding-left:10px;">
				<input name="carno" type="text"  class="input"  value="<?=$row[wc_no]?>" size="20" maxlength="50"/>
				 <span style="padding:10 0 0 5">  
				
			</td>
              <td  width="91" align="center" bgcolor="f6f6f6">판매가격</td>
          <td  style="padding-left:10px;" width="293"> 
		  <input type="text" name="wc_price"  value="<?=number($row[wc_price])?>"  style='width:100;' onKeyup="javascript:calculation5(wc_price);">
            원 
		</td>
      </tr>
        <tr > 
          <td align="center" bgcolor="f6f6f6">제조사</td>
          <td style="padding-left:10px;"> 
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
          <td align="center" bgcolor="f6f6f6">모 델 명</td>
          <td style="padding-left:10px;">
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
          <span style="padding:3 0 0 5">
          <input type="text" name="car_name2"  value="<?=$row[wc_model2]?>" style='width:100;' onkeyup="javascript:calculation5(carmile);" />
          </span></td>
      </tr>
        <tr> 
          <td align="center" bgcolor="f6f6f6">년 식</td>
        <td style="padding-left:10px;"><table cellspacing="0" cellpadding="0" class="ex2">
<tr> 
                <td width="40" align="left" valign="middle"> 
                  <?=$phpfun->holic_year('car_year_yy',substr($row[wc_age],0,4))?> 년</td>
                <td width="40" align="left" valign="middle"> 
                  <?=$phpfun->holic_month2('car_year_mm',substr($row[wc_age],4,2))?> 월</td>
                <td width="20" align="left" valign="middle"></td>
          </tr>
            </table></td>
          <td align="center" bgcolor="f6f6f6">변 속 기</td>
          <td style="padding-left:10px;">  
			<select name="trans">
			<option value="" selected>:: 변속기 ::</option>
<?
$sql="select * from cate where code='1' ";
$result_made=mysql_query($sql);
while($data_made=mysql_fetch_array($result_made)){
?>
			<option value="<?=$data_made[name]?>" <?if($row[wc_trans]==$data_made[name]) echo "selected";?>><?=$data_made[name]?></option>
<?
}
?>
			</select>
		  
		</td>
      </tr>
        <tr> 
          <td  align="center" bgcolor="f6f6f6">연 료</td>
          <td  style="padding-left:10px;"> 
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
          <td align="center" bgcolor="f6f6f6">배 기 량</td>
          <td  style="padding-left:10px;"> <input type="text" name="carcc" value="<?=number($row[wc_cc])?>" style='width:100;' onKeyup="javascript:calculation5(carcc);">
            cc </td>
      </tr>
        <tr> 
          <td  align="center" bgcolor="f6f6f6">주행거리</td>
          <td  style="padding-left:10px;"> <input type="text" name="carmile"  value="<?=number($row[wc_mileage])?>" style='width:100;' onKeyup="javascript:calculation5(carmile);">
            km</td>
          <td align="center" bgcolor="f6f6f6">사고유무</td>
          <td  style="padding-left:10px;"> 
			<input type="radio" name="caraccdate" value="무사고" <?if($row[wc_acc_date]=="무사고") echo "checked";?>>무사고  
			<input type="radio" name="caraccdate" value="사고있음" <?if($row[wc_acc_date]=="사고있음") echo "checked";?>>사고있음
		  </td>
      </tr>
        <tr> 
          <td align="center" bgcolor="f6f6f6">기본옵션</td>
          <td colspan="3"  style="padding-left:10px;">

			<?
			//== /lib/code.php 안에 있음
			WriteArrHTML('checkbox', 'carOption[]', $ArrcarOption, $row[wc_option], '', 6, 'all', '');
		   ?>		   </td>
      </tr>
        <tr> 
          <td height="60" align="center" bgcolor="f6f6f6">추가옵션</td>
          <td colspan="3" style="padding:5px 10px 5px 10px; ">
			<textarea name="carOptionadd" rows="3" style="width:95%; border:1px solid #008ad9;"><?=$row[wc_option_add]?></textarea>
		  </td>
      </tr>
        <tr> 
          <td height="156" align="center" bgcolor="f6f6f6">설명문구</td>
         <td colspan="3" style="padding:5px 10px 5px 10px; "><textarea name="car_memo" id="car_memo" style="width:95%;border:1px solid #008ad9;" rows="10" wrap="hard"><?=$row[wc_damage]?></textarea></td>
      </tr>
		
		<tr> 
          <td  align="center" bgcolor="f6f6f6">사 진(24장)<br> </td>
          <td colspan="3"  style="padding:5 10 5 10"><table width="98%" height="71" border="0" class="ex2">
              <tr> 
                <td height="33"><a href="#" onClick="window.open('../admin/inc/FileUpload2.php?wc_idx=<?=$wc_idx?>','Upload','width=700, height=860');">사진등록/수정</a></td>
              </tr>
            </table></td>
      </tr>
     
		
	        
      </table>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
			  
			  <tr>
						<td width="266" valign="top" align="center">
					      <a href="/mypage/sub02.php"><img src="/images/bt05.jpg" border="0" /></a>&nbsp;&nbsp;<img src="/images/bt06.jpg" border="0" onclick="document.outForm.submit();" style="cursor:pointer;"/></td>
		</tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>

</table>



			</div>
		</div>
	</div>
	<!-- footer -->
	<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>

</body>
</html>


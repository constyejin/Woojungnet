<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?> 

<script language="JavaScript" src="/admin/inc/default.js"></script>
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

</head>
<body>



<div id="new_wrap">

<?
$idx = $_GET['idx'];
if(!$idx)$mode = 'regist';
else $mode = 'modify';
if ($__lib['limit_ext'] != ''){
	preg_match('/[.]+('.str_replace(';', '|', $__lib['limit_ext']).')+/i', $_FILES['upfile']['name'], $mc);
}

if($loginId){
	$row = mysql_fetch_array(mysql_query("SELECT * FROM woojung_member WHERE userId='$loginId'"));
	if($row[idx]) {
		$call_line = 'user';
		$post = $row[post1].'-'.$row[post2];
	} else {
		$call_line = '';
		$post = '';
	}
	$telarr = explode('-',$row[tel]);
	$pcsarr = explode('-',$row[pcs]); 
	$faxarr = explode('-',$row[fax]); 
	$emailarr = explode('@',$row[email]);
	$zipcode1 = $row[post1];
	$zipcode2 = $row[post2];

	//dbclose($connect);
}else{
	echo "<script>alert('로그인후 사용 가능합니다.');location.href='/login/login.php';</script>";
}
?>
<script type="text/javascript">
function out_submit(){

	f=document.outForm;

	if(f.carno_c.value!='1'){
		alert('차량번호 중복확인을 해주세요');
		return false;
	}

	if(f.car_year_yy.value){
		if(f.car_year_yy.value.length != 4){
			alert('년식의 연도는 4자리로 입력해 주세요.');
			return false;
		}
	}

	return true;
}

function moveInput(sort) {
	if(sort == 'tel1') {
		$('call_tel2').focus();
	} else if(sort == 'tel2') {
		if($F('call_tel2').length >=4)$('call_tel3').focus();
	
	} else if(sort == 'pcs1') {
		$('call_pcs2').focus();
	} else if(sort == 'pcs2') {
		if($F('call_pcs2').length >=4)$('call_pcs3').focus();
	}
}

</script>
<div id="contents_basic">
    <!-- 1:자동차리스트 -->
    <div class="co_car_all">
			<div class="sub-visual">
				<div class="sub-text">
					<p class="catch-phrase">
					차량등록
					</p>
					<p class="description-text">
						공정한 온라인경공매시스템으로  신속, 정확한 정보를 제공합니다.
					</p>
				</div>
			</div>

        
        	<div class="div_basic">

			<div class="tab_type01">
				<ul>
					<li class="on"><a href="sub01_1.php"><span>차량등록</span></a></li>
					<li><a href="sub01_2.php"><span>사진추가</span></a></li>
					<li><a href="sub01_3.php"><span>차량상담</span></a></li>
				</ul>
			</div> 
				
			  <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <form name='outForm' method='post' action='car_info_update.php' enctype="multipart/form-data" onsubmit='return out_submit();'>
          <input type="hidden" name="mode" id="mode" value="<?=$mode?>">
          <input type="hidden" name="wc_idx" value="<?=$wc_idx?>">
          <input type="hidden" name="wc_go_idx" value="">
          <input type="hidden" name="aucidx" value="<?=$aucidx?>">
          <input type="hidden" name="aucorderNo" value="<?=$aucNo?>">
          <input type="hidden" name="href" value="<?=$href?>">
          <input type="hidden" name="hidFileName"/>
				  <tr> 
					<td height="10" align="center">
					 <table  style="width:1200px" border="0" cellpadding="0" cellspacing="0"> 
                            <tr> 
					          <td>
<script language="JavaScript" type="text/javascript">
function si_chk(z){ 
	var tmp = z.options[z.selectedIndex].value; 
	document.outForm.car_name.options[0].selected="true";
	gufrm.location.href = "/manage/inc/gu.php?tmp="+tmp;  
} 
function car_chk(z){ 
	var tmp = z.options[z.selectedIndex].value; 
	document.outForm.car_cate2.options[0].selected="true";
	gufrm.location.href = "/manage/inc/car.php?tmp="+tmp;  
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

<iframe name="gufrm" style="display:none;" src="/admin/inc/gu.php?tmp=<?=$row[wc_made]?>"></iframe>
<?}else{?>
<iframe name="gufrm" style="display:none;" src=""></iframe>
<?}?>
<table>
  <tr> 
    <td class="title"  height="40"><div align="left"><img src="/images/icon.jpg" ALIGN=absmiddle> 
        <strong style="font-size:14px;">출품자정보</strong></div>
    </td>
  </tr>
  <tr> 
    <td>
		<div class="widcen_1200">
			<table class="join_form form-table">
			<colgroup>
        <col style="width: 180px;">
        <col style="width: 420px;">
        <col style="width: 180px;">
        <col style="width: auto;">
      </colgroup>
           <tr>
              <th>신청구분</td>
							<td colspan="3">
							<ul class="radio-list">
								<li>
									<input type='radio' name='calltype' value='폐차'>
									<span class="radio-label">폐차</span>
								</li>
								<li>
									<input type='radio' name='calltype' value='명의이전'>
									<span class="radio-label">명의이전</span>
								</li>
								<li>
									<input type='radio' name='calltype' value='폐차/이전' >
									<span class="radio-label">폐차/이전</span>
								</li>
							</ul>


							</td>
						</tr>
						<tr>
              <th>사고유형</td>
              <td colspan="3">
			<?
			//== /lib/code.php 안에 있음
			WriteArrHTML('checkbox', 'acctype[]', $ArrcarAcc, $row[acctype], '', 7, 'all', '');
		   ?> 
         </td>
      </tr>
        <tr > 
          <th>신 청 자</td>
          <td> <input name="call_name" type="text" id="call_name" value="<?=$row[wc_mem_name]?$row[wc_mem_name]:$loginName?>" size="20"  class="form_control" required="required" hname='신 청 자' class="form_control"/> <font style="color:red">(<?=grade_sort($row_mem['usort'])?>)</font>
          </td>
          <th>일반전화</td>
          <td> 


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
            <input name="call_tel" type="text"   class="form_control" value="<?=$arrphone[0]?>" size="7" maxlength="4"/>
            - 
            <input name="call_tel2" type="text"   class="form_control" id="call_tel22" value="<?=$arrphone[1]?>" size="7" maxlength="4"/>
            - 
          <input name="call_tel3" type="text"   class="form_control" id="call_tel32" value="<?=$arrphone[2]?>" size="7" maxlength="4"/></td>
      </tr>
        <tr> 
          <th>업체명</td>
          <td>
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
?>
			</td>
          <th>휴대전화</td>
          <td>
            <input name="call_pcs1" type="text"   class="form_control" id="call_pcs1" value="<?=$arrPcs[0]?>" size="7" maxlength="4" required="required" hname='휴대전화' >
            - 
            <input name="call_pcs2" type="text"  class="form_control" id="call_pcs2" value="<?=$arrPcs[1]?>" size="7" maxlength="4" required="required" hname='휴대전화' />
            - 
            <input name="call_pcs3" type="text"   class="form_control" id="call_pcs3" value="<?=$arrPcs[2]?>" size="7" maxlength="4" required="required" hname='휴대전화' />		  </td>
      </tr> 
      <!--tr> 
		<th>보상담당자</td>
		<td>
		<input type="text" name="bodam" style='width:150;' value="<?=$row[bodam]?>" class="form_control"></td>
		<th>연락처</td>
		<td><input name="botel1" type="text"  value="<?=$botel[0]?>" size="7" maxlength="4" class="form_control"> - <input name="botel2" type="text" value="<?=$botel[1]?>" size="7" maxlength="4" class="form_control"> - <input name="botel3" type="text"  value="<?=$botel[2]?>" size="7" maxlength="4" class="form_control"></td>
      </tr> 
      <tr> 
		<th>조직명</td>
		<td>
		<input type="text" name="orm" style='width:150;' value="<?=$row[orm]?>"  class="form_control"></td>
		<th>직책</td>
		<td><input type="text" name="orm2" style='width:150;' value="<?=$row[orm2]?>"  class="form_control"></td>
      </tr--> 
      <tr>
	    <th>제휴사접수번호</td>
	    <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;background:#FFFFFF"><input type="text" name="jnumber" style='width:150;' value="<?=$row[jnumber]?>"  class="form_control"/></td>
		<th style="">담보</td>
		<td>
			<ul class="radio-list">
				<li>
					<input type='radio' name='dambo1' value='자차'  <?if($row[dambo1]=="자차") echo "checked"; ?> />
					<span class="radio-label" style="margin-right: 5px;">자차</span>
				</li>
				<li>
					<input type='radio' name='dambo1' value='대물'  <?if($row[dambo1]=="대물") echo "checked"; ?> /> 
					<span class="radio-label">대물</span></td></tr>
				</li>
			</ul>

<?
	$dambo3 = explode("/", $row[dambo3]);
?>
      <tr> 
          <th>은행명</td>
<td colspan="3">
              은행
              <input type="text" name="dambo3_1" style='width:100px;' value="<?=$dambo3[0]?>"  class="form_control">            
              / 계좌번호            
             <input type="text" name="dambo3_2" style='width:180px;' value="<?=$dambo3[1]?>"  class="form_control"/> 
              예금주 
              <input type="text" name="dambo3_3" style='width:180px;' value="<?=$dambo3[2]?>"  class="form_control"/></td>
        </tr> 
    </table></td>
  </tr>
 </table>
							  </td>
                             </tr>      
				      </table>
					  </td>
				  </tr>
				  <tr> 
					<td height="10"></td>
				  </tr>
				  <!--출품자정보-->
				  <tr> 
					<td align="center">
						<table  style="width:1200px" border="0" cellpadding="0" cellspacing="0"> 
                            <tr> 
								<td>
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
    <td class="title" height="40"><div align="left"><img src="/images/icon.jpg" ALIGN=absmiddle> 
        <strong style="font-size:14px;">차량정보</strong></div></td>
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
    <td>
		<div class="widcen_1200">
			<table class="join_form form-table">
			<colgroup>
				<col style="width: 180px;">
				<col style="width: 420px;">
				<col style="width: 180px;">
				<col style="width: auto;">
			</colgroup>
  <tr > 
	<th>차량번호</th>
	<td><input name="carno" type="text"   class="form_control"  value="<?=$row[wc_no]?>" size="20" maxlength="50"/>
    <span style="padding:10 0 0 5"> 
      <input type="button" value="중복확인" class="Submit2222222 btn-default-table" onClick="check_num_Window();"/>
      
      <input type="hidden" name="carno_c" value="0">
    </td>
    <th>보 험 사</th>
<td>
<select name="car_cate" onChange="car_chk(this)" class="form_select">
			  <option value="" selected>:: 선택 ::</option>
			   <?
			   $team_cate_sql=mysql_query("select * from team_cate where depth='1'");
			   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
			   <option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$row[car_cate]){ echo "selected"; }?>><?=$team_cate["name"]?></option>
			   <?}?>
	  </select>
            <!--  <select name="car_cate2" class="form_select">
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
    </select> -->
		</td>        
      </tr>
        <tr > 
          <th>차대번호</th>
          <td><input name="wc_prog_area_price" type="text"   class="form_control"  value="<?=$row[wc_prog_area_price]?>" size="40" maxlength="50"/></td>
          <th>전손/분손</th>
          <td>
			<ul class="radio-list">
				<li>
					<input name="evalAmt_type" type="radio" value="전손" <? if($row[evalAmt_type]=="전손"){echo "checked";} ?>/>
					<span class="radio-label">전손</span>  
				</li>
				<li>
					<input name="evalAmt_type" type="radio" value="분손" <? if($row[evalAmt_type]=="분손"){echo "checked";} ?>/>
					<span class="radio-label">분손</span> 
				</li>
				<li>
					<input name="evalAmt_type" type="radio" value="일반" <? if($row[evalAmt_type]=="일반"){echo "checked";} ?>/>
					<span class="radio-label">일반</span>
				</li>
			</ul>
			</td>
      </tr>
        <tr > 
          <th>제조사</th>
          <td> 
			<select name="made" class="form_select" onChange="si_chk(this)">
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
          <th>모 델 명</th>
          <td>
			<select name="car_name" class="form_select">
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
          <input type="text" name="car_name2"  value="<?=$row[wc_model2]?>" style='width:150px;'   class="form_control" />           </td>
      </tr>
        <tr> 
          <th>년식(등록일)</th>
        <td><input name="car_year_yy" type="text"  size="5" value="<?=substr($row[wc_age],0,4)?>"  class="form_control" maxlength="4"/>
          년
          <select name="car_year_mm" class="form_select">
			<option value="">::월::</option>
			<? for($i=1;$i<=12;$i++){ ?>
			<option value="<?=sprintf("%02d",$i)?>"><?=$i?>월</option>
			<? } ?>
		  </select>
          &nbsp;&nbsp;&nbsp;&nbsp;예: 2014 년 01 월</td>
          <th>변 속 기</th>
          <td>  
			<select name="trans" class="form_select">
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
          <th>연 료</th>
          <td> 
			<select name="fual" class="form_select">
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
          <th>배 기 량</th>
          <td> <input type="text" name="carcc" style='width:100;' onKeyup="javascript:comma(this);" class="form_control">
            cc </td>
      </tr>
        <tr> 
          <th>주행거리</th>
          <td> <input type="text" name="carmile"  style='width:100;' onKeyup="javascript:comma(this);" class="form_control">
            km</td>
          <th>세전출고가</th>
          <td> <input type="text" name="carprice" style='width:100;' onKeyup="javascript:comma(this);" class="form_control">
            원 </td>
      </tr>
        <tr> 
          <th>예상수리비</th>
          <td> <input type="text" name="carcost"  style='width:100;' onKeyup="javascript:comma(this);" class="form_control">
            원 </td>
          <th>사고발생일</th>
          <td> <input type="text" id="jdate" name="caraccdate" value="<?=$row[wc_acc_date]?>" style='width:100;' class="form_control"> 
           </td>
      </tr>
      
        <tr> 
          <th>발생비용</th>
          <td colspan="3">
            <input  name="wc_go_cost" type="text" id="wc_go_cost" class="form_control" onKeyup="javascript:comma(this);"/>원 / 견인비,보관비,기타등</td>
      </tr> 
        <tr> 
          <th height="156">차량설명</td>
          <td colspan="3"><textarea name="car_memo" id="car_memo" class="form_control" style='width:95%;' rows="10" wrap="hard" ><?=$row[wc_damage]?></textarea></td>
      </tr> 
        <tr> 
          <th>보관지역</th>
          <td align="left" bgcolor="#FFFFFF" class="ex2"  style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;"> 
		 <? 
		//== /lib/code.php 안에 있음
		WriteArrHTML('select', 'area1', $ArrcarPlace , $row[wc_keep_area1], '', '' , 'all', '::선택::' );
?>
</td>
          <th style="">보관장소</td>
          <td> 
		<input type="text" name="moveKeepReq" value="<?=$row[moveKeepReq]?>" style='width:90%;' class="form_control">          </td>
      </tr>
        <tr> 
          <th>보관소연락처</th>
          <td>
		  
		  <!--<input name="wc_keep_tel1" type="text"  value="<?=$row[wc_keep_tel1]?>" style='width:50%;' class="form_control">-->

			<input type="text" name="wc_keep_tel_1" class="form_control" value="" size="7" maxlength="4"/>
			- 
			<input type="text" name="wc_keep_tel_2" class="form_control" value="" size="7" maxlength="4"/>
			- 
			<input type="text" name="wc_keep_tel_3" class="form_control" value="" size="7" maxlength="4"/>


		  </td>
          <th style="">담 당 자</th>
          <td> <input type="text" name="keep_name1" value="<?=$row[wc_keep_name1]?>" style='width:90%;' class="form_control">          </td>
      </tr>
        <tr> 
          <th>소유형태</th>
          <td colspan="3"> 

		<?
			//== /lib/code.php 안에 있음
			WriteArrHTML('radio', 'ArrcarOwner', $ArrcarOwner, $row[wc_ownertype], '', '', 'all', '');
		   ?>		   </td>
      </tr>
        <tr> 
          <th>차 주 명</th>
          <td> <input name="owner_name" type="text"   class="form_control" id="owner_name" value="<?=$row[wc_owner]?>" size="35"/></td>
          <th>차주연락처</th>
          <td> 
		  
	<?
	 $arrownertel = explode("-", $row[wc_owner_tel]);
	?>		  
		  
		  <input name="owner_tel1" type="text"   class="form_control" id="owner_tel1" value="<?=$arrownertel[0]?>" size="7" maxlength="4"/>
            - 
            <input name="owner_tel2" type="text"   class="form_control" id="owner_tel2" value="<?=$arrownertel[1]?>" size="7" maxlength="4"/>
            - 
            <input name="owner_tel3" type="text"   class="form_control" id="owner_tel3" value="<?=$arrownertel[2]?>" size="7" maxlength="4"/>          </td>
      </tr>
		<tr> 
          <th>사진등록</th>
          <td colspan="3">
					<input type="button" value="사진등록 및 수정" class="Submit2222222 btn-default-table" onClick="window.open('/manage/inc/FileUpload3.php?wc_idx=<?=$wc_idx?>','Upload','width=1200, height=1000');"/>
					</td>
      </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>

</table>
 
								<? //include "../admin/inc/table01_modify.php";?>
								
								</td><!-- 출픔자정보 -->
						  </tr>             
							
						       
							          
							<tr> 
								<td height="8"></td>
							</tr>
							<tr> 
								<td style="padding-left: 15px;">* 신청접수의 각 항목을 기입 후 신청해주시면, 업무담당자가 확인후 연락을 드립니다.<br /></td>
							</tr>
							<tr> 
								<td height="12"></td>
							</tr>
							<tr> 
								<td align="center">
									<table width="500" align="center">
										<tr> 
											<td width="266"  valign="top" align="center" style="padding-bottom:50px;">
                        <a href="javascript:void(0)" onClick="document.outForm.submit();" style="display:inline-block; color:#fff"><div style="" class="user-btn Scor-font-500">차량등록하기</div></a>
                      </td>
									  </tr>
									</table>
							  </td>
							</tr>
							<tr> 
								<td> 
								<!-- [End] lib 객체 생성 (폼태그안에 들어가면 안됨!) -->
								</td>
							</tr></form>
						</table>
                    </td>
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

<script type="text/javascript">
function auctionView(idx) {
	window.location.href="sub02_1_view.php?idx="+idx;
}
</script>

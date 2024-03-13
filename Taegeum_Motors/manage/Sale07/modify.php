<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';

	if($loginUsort != "superadmin" && $loginUsort != "admin1" && $loginUsort != "admin2" ){
		movepage("/index.php", "권한이 없습니다.");
		MsgMov("권한이 없습니다.","/index.php");
		exit;
	}

	if(!$No){
		err_msg("잘못된 접근 입니다.");
	}

	$href = "page=$page&Search_mode=$Search_mode&Search_text=$Search_text&list_sort=$list_sort";  

	
	$row = Row_string("SELECT * FROM woojung_member WHERE idx='$No'");

	$com = Row_string("SELECT * FROM recruit WHERE code  = '$row[code]'");

	$tmp = explode("-",$row[ssn]); $ssn1 = $tmp[0]; $ssn2 = $tmp[1];
	$tmp = explode("-",$row[tel]); $tel1 = $tmp[0]; $tel2 = $tmp[1]; $tel3 = $tmp[2];
	$tmp = explode("-",$row[fax]); $fax1 = $tmp[0]; $fax2 = $tmp[1]; $fax3 = $tmp[2];
	$tmp = explode("-",$row[pcs]); $pcs1 = $tmp[0]; $pcs2 = $tmp[1]; $pcs3 = $tmp[2];
	$tmp = explode("@",$row[email]); $email1 = $tmp[0]; $email2 = $tmp[1];
	$zipcode1 = $row[post1]; $zipcode2 = $row[post2]; $address = $row[addr1]; $address_ext = $row[addr2];	
	$tmp = explode("-",$row[company_no]); $company_no1 = $tmp[0]; $company_no2 = $tmp[1]; $company_no3 = $tmp[2];
	$tmp = explode("-",$row[company_tel]); $company_tel1 = $tmp[0]; $company_tel2 = $tmp[1]; $company_tel3 = $tmp[2];
	$tmp = explode("-",$row[company_post]); $czipcode1 = $tmp[0]; $czipcode2 = $tmp[1];
	$tmp = explode("-",$row[ceo_ssn]); $ceo_ssn1 = $tmp[0]; $ceo_ssn2 = $tmp[1];


	if( strpos($row[usort], 'premiu') !== false ){
		$pre_rdate = $row[pre_rdate];		
	}else{
		$pre_rdate = $row[rdate];			
	}

	$list = "[";
	$arr2 = Fetch_string("select * from team_cate where depth=2 order by idx desc");
	for($i=0;$i<count($arr2);$i++){
		$list.= "{'code':'".$arr2[$i][code]."','name':'".$arr2[$i][name]."'},"; 
	}
	$list.= "]";


	if($row[emailSend] == "yes"){
		$emailSend = "[수신]";
	}else{
		$emailSend = "[아니오]";
	}
	
?>

<script>
function win_open(ret){
	window.open('/member/post.php?ret='+ret,'zipcode','width=550,height=500,scrollbars=yes');
}

function check_nicname_Window(){			
		var f = document.join;
		if((f.userNick.value.length < 2) || (f.userNick.value.length > 12)){
			f.nicchk_value.value="0";
			document.getElementById("u_nicname_check").innerHTML="[사용불가]";
		}else{
			f.action="/login/join_nicname_chk1.php";
			f.target="iFrm";
			f.submit();
			f.target="";
		}
	}
</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

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
  $("#mdate").datepicker(clareCalendar);
   $("#edate").datepicker(clareCalendar);
  $("#adate").datepicker(clareCalendar);
   $("#bdate").datepicker(clareCalendar);
   $("img.ui-datepicker-trigger").attr("style","margin-left:5px; vertical-align:middle; cursor:pointer;"); //이미지버튼 style적용
  $("#ui-datepicker-div").hide(); //자동으로 생성되는 div객체 숨김  
 });
</script>
<style>
.ui-datepicker select.ui-datepicker-month{ width:30%;  }
.ui-datepicker select.ui-datepicker-year{ width:40%; }
</style>


<iframe name="iFrm" id="iFrm" width=0 height=0 src="about:blank"></iframe>
<form name="join" method="post" onsubmit="return form_check()">
<input type="hidden" name="nicchk_value" value="1" />
<input type="hidden" name="usort_change" value="0" />
<input type="hidden" name="href" value="<?=$href?>">

<table width="900" border="0" cellspacing="0" cellpadding="0">
 <tr> 
    <td align="center"><table width="900" border="0" cellspacing="0" cellpadding="0"><tr>
      <td align="center"><table width="900" border="0" cellspacing="0" cellpadding="0">
       <tr>
  <td height="20" colspan="2" align="left" style="color:#333399"> <font size="-4"> ▶ </font>위치 : 회원관리 &gt;회원정보수정</td></tr>
<tr><td  height="1" bgcolor="#333399" colspan="2"> </td></tr>
<tr>
  <td  height="20" colspan="2"></td></tr>
  <tr> 
    <td align="center"> <table width="900" border="0" cellspacing="0" cellpadding="0">
          <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="#ffffff" style="padding:0 0 0 0">
		  <!--	        <tr> 
            <td height="20" class="title" align="left"><img src="/admin/img/icon02.gif" width="15" height="15" ALIGN=absmiddle> 
              접수회원사</td>
          </tr>
					<tr> 

              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6">접수회원사</td>
                <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
				<select name="code" onchange="document.getElementById('com_code').innerHTML=this.value;">
					<option value="">==경매업체==</option>
<?
$sql_com="select * from recruit where 1 ";
$result_com=mysql_query($sql_com);
while($data_com=mysql_fetch_array($result_com)){
?>
					<option value="<?=$data_com[code]?>" <? if($row[code]==$data_com[code])echo "selected"; ?>><?=$data_com[company]?></option>
<?
}
?>
				</select>
				</td>
                <td width="100" align="center" bgcolor="f6f6f6">코드번호</td>
                <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;" id="com_code">
				<?=$com[code]?>
				</td>
              </tr>
              <tr> 
                <td width="100" height="20" align="center" bgcolor="f6f6f6">회사전화</td>
                <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$com[phone]?></td>
                <td width="100" align="center" bgcolor="f6f6f6">팩스번호</td>
                <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$com[fax]?></td>
              </tr>
							<tr> 
                <td width="100" height="20" align="center" bgcolor="f6f6f6">담당자</td>
                <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$com[name]?></td>
                <td width="100" align="center" bgcolor="f6f6f6">담당자핸드폰</td>
                <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$com[mobile2]?></td>
              </tr>
            </table></td>
        </tr>
				<tr>
					<td height="10"></td>
				</tr>
				-->
          <tr> 
            <td height="20" class="title" align="left"><img src="/admin/img/icon02.gif" width="15" height="15" ALIGN=absmiddle /> 
              <strong>기본정보</strong></td>
          </tr>
          <tr> 
            <td> <table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="dadada" style="padding:0 0 0 0" class="table-style">
                <tr> 
                  <td width="100" height="23" align="center" bgcolor="f6f6f6" class="table-th">이 름</td>
                  <td width="280" bgcolor="#FFFFFF" style="padding-left:10px;" align="left"> 
                    <?=$row[name]?>
                  </td>
                  <td width="100" align="center" bgcolor="f6f6f6" class="table-th">아 이 디</td>
                  <td width="275" bgcolor="#FFFFFF" style="padding-left:10px;"align="left"> 
                    <?=$row[userId]?>
                  </td>
                </tr>
                <tr> 
                  <td height="23" align="center" bgcolor="f6f6f6" class="table-th">닉 
                    네 임</td>
                  <td bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><input name="u_nicname" type="text" class="input" id="userNick" value="<?=$row[userNick]?>"maxlength="10" onkeyup="document.join.nicchk_value.value='0';"> <a href="javascript:check_nicname_Window()">중복확인</a> <span id="u_nicname_check" style="color:red"></span></td>
                  <td align="center" bgcolor="f6f6f6" class="table-th">비밀번호</td>
                  <td bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><input name="userPw" type="text" id="userPw" size="20" class="input" /></td>
                </tr>
                <tr> 
                  <td height="23" align="center" bgcolor="f6f6f6" class="table-th">가입일자</td>
                  <td bgcolor="#FFFFFF" style="padding-left:10px;"  align="left">
				  <?=$row[rdate]?>     
                  </td>
                  <td align="center" bgcolor="f6f6f6" class="table-th">입찰권한</td>
                  <td bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><input type="radio" name="power" value="1" style="vertical-align:middle;" <? if($row[power]=="1"||!$row[power])echo "checked"; ?>>폐차&nbsp;&nbsp;&nbsp;<input type="radio" name="power" value="2" style="vertical-align:middle;" <? if($row[power]=="2")echo "checked"; ?>>이전&nbsp;&nbsp;&nbsp;<input type="radio" name="power" value="3" style="vertical-align:middle;" <? if($row[power]=="3")echo "checked"; ?>>폐차/이전</td>
                </tr>
                <tr> 
                  <td height="23" align="center" bgcolor="f6f6f6" class="table-th">등급변경일</td>
                  <td bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><input name="mdate" id="mdate" type="text" value="<?=$row[mdate]?>" size="15"  readonly /> 
                  </td>
                  <td align="center" bgcolor="f6f6f6" class="table-th">회원등급</td>
                  <td bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><select name="usort" size="1" id="usort" onchange="change_usort()">
                      <option >==선택==</option>
                      <option value="indi" <? if($row[usort] == 'indi'){?> selected="selected" <? } ?>>일반회원</option>
                      <option value="company1" <? if($row[usort] == 'company1'){?> selected="selected" <? } ?>>제휴회원</option>
                      <option value="premium1" <? if($row[usort] == 'premium1'){?> selected="selected" <? } ?>>입찰대기</option>
                      <option value="premium2" <? if($row[usort] == 'premium2'){?> selected="selected" <? } ?>>입찰승인</option>
					  <option value="jisajang" <? if($row[usort] == 'jisajang'){?> selected="selected" <? } ?>>프리미엄</option>
                      <option value="premium3" <? if($row[usort] == 'premium3'){?> selected="selected" <? } ?>>입찰종료</option>
                      <option value="premium4" <? if($row[usort] == 'premium4'){?> selected="selected" <? } ?>>입찰중지</option>
<?
if($loginUsort == "admin1"||$loginUsort == "admin2"||$loginUsort == "superadmin" ){
?>
                      <option value="admin" <? if($row[usort] == 'admin'){?> selected="selected" <? } ?>>일반관리자</option>
<?
}
?>
<?
if($loginUsort == "admin2"||$loginUsort == "superadmin" ){
?>
                      <option value="admin1" <? if($row[usort] == 'admin1'){?> selected="selected" <? } ?>>중간관리자</option>
<?
}
?>
<?
if($loginUsort == "superadmin" ){
?>
                      <option value="admin2" <? if($row[usort] == 'admin2'){?> selected="selected" <? } ?>>최고관리자</option>
<?
}
?>
<?
if($loginUsort == "superadmin" ){
?>
                      <option value="superadmin" <? if($row[usort] == 'superadmin'){?> selected="selected" <? } ?>>슈퍼관리자</option>
<?
}
?>
                    </select></td>
                </tr>
                <tr> 
                  <td height="23" align="center" bgcolor="f6f6f6" class="table-th">대표전화</td>
                  <td bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><span> 
                    <input name="tel1" type="text" class="input" size="3" maxlength="3"  hname='일반전화' value="<?=$tel1?>"/>
                    - 
                    <input name="tel2" maxlength="4" type="text" class="input" size="5"   hname='일반전화' value="<?=$tel2?>"/>
                    - 
                    <input name="tel3" maxlength="4" type="text" class="input" size="5"  hname='일반전화'  value="<?=$tel3?>"/>
                    </span></td>
                  <td align="center" bgcolor="f6f6f6" class="table-th">휴대전화</td>
                  <td bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><span>
                    <input name="pcs1" type="text" class="input" size="3" maxlength="3"  hname='일반전화'  value="<?=$pcs1?>"/>
                    - 
                    <input name="pcs2" maxlength="4" type="text" class="input" size="5"   hname='일반전화'  value="<?=$pcs2?>"/>
                    - 
                    <input name="pcs3" maxlength="4" type="text" class="input" size="5"  hname='일반전화'  value="<?=$pcs3?>"/>
                    </span></td>
                </tr>
                <tr> 
                  <td height="23" align="center" bgcolor="f6f6f6" class="table-th">회사전화</td>
                  <td bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><span>
                    <input name="company_tel1" id="company_tel1" type="text" class="input" size="3" maxlength="3"  value="<?=$company_tel1?>"/>
                    - 
                    <input name="company_tel2" id="company_tel5" maxlength="4" type="text" class="input" size="5"   value="<?=$company_tel2?>"/>
                    - 
                    <input name="company_tel3" id="company_tel6" maxlength="4" type="text" class="input" size="5" value="<?=$company_tel3?>"/>
                    </span></td>
                  <td align="center" bgcolor="f6f6f6" class="table-th">팩스번호</td>
                  <td bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><span>
                    <input name="fax1" type="text" class="input" id="fax1"  value="<?=$fax1?>" size="3" maxlength="3"/>
                    - 
                    <input name="fax2" type="text" class="input" id="fax2"   value="<?=$fax2?>" size="5" maxlength="4"/>
                    - 
                    <input name="fax3" type="text" class="input" id="fax3" value="<?=$fax3?>" size="5" maxlength="4"/>
                    </span></td>
                </tr>
                <tr> 
                  <td height="23" align="center" bgcolor="f6f6f6" class="table-th">이 메 일</td>
                  <td bgcolor="#FFFFFF" style="padding-left:10px;" colspan="3" align="left">
                    <input name="email1" type="text" class="input" size="15"  hname='이메일'  value="<?=$email1?>"/ style='width:100;'> @<span style="padding-left: 5px;padding-top: 2px;"> <input name="email2" type="text" class="input" size="20"   hname='이메일'  value="<?=$email2?>"/ style='width:120;'>
					메일로 수신 
                    <input name="emailSend" type="radio" value="yes" <? if($row[emailSend] == 'yes'){?> checked <? } ?>/>
                    예 
                    <input name="emailSend" type="radio" value="no" <?=$checkedno?> <? if($row[emailSend] == 'no'){?> checked <? } ?>/>
                    아니오  </td>
                  
                    </td>
                </tr>
                <tr> 
                  <td height="23" align="center" bgcolor="f6f6f6" class="table-th">주 소</td>
                  <td colspan="3" bgcolor="#FFFFFF" style="padding-left:10px;" align="left">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 5px;margin-bottom: 5px;">
                      <tr> 
                        <td height="23" style="padding-bottom: 5px">
                          <input name="zipcode" type="text" class="input" id="zipcode" value="<?=$zipcode1?>" size="10"/>
                          <a href="javascript:openDaumPostcode()" style='cursor:hand'>  우편번호</a>
                        </td>
                      </tr>
                      <tr> 
                        <td height="23" style="padding-bottom: 5px"><input name="address" id="address" type="text" class="input" size="70" hname='주소'   value="<?=$address?>" readonly/></td>
                      </tr>
                      <tr> 
                        <td height="23"><input name="address_ext" id="address_ext" type="text" class="input" size="70" hname='나머지주소'  value="<?=$address_ext?>"/></td>
                      </tr>
                    </table></td>
                </tr>
				 
			   <tr> 
                  <td height="23" align="center" bgcolor="f6f6f6" class="table-th">메 모</td>
                  <td colspan="3" bgcolor="#FFFFFF" style="padding-left:10px;" align="left"> 
				  <input name="memo" type="text" size="100" class="input" value="<?=$row[memo]?>">               
                  </td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
          </tr>
          <? if($row[usort] == 'company1' || $row[usort] == 'company2'){ ?>
          <tr> 
            <td height="23" class="title" align="left"><img src="/admin/img/icon02.gif" width="15" height="15" ALIGN=absmiddle> 
              제휴회원 </td>
          </tr>
          <tr> 
            <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="dadada" style="padding:0 0 0 0">
                <!--tr> 
                  <td height="20" align="center" bgcolor="f6f6f6">회 사 명</td>
                  <td colspan="3" bgcolor="#FFFFFF" style="padding-left:10px;"><span>
                    <input name="company_name" id="company_name"  type="text" class="input"  value="<?=$row[company_name]?>"/>
                    * 보험회사명 및 지점명이 선택되어 있을 시 기입하지 마세요. </span></td>
                </tr-->
                <tr> 
                  <td width="105" height="20" align="center" bgcolor="f6f6f6">업체명</td>
                  <td width="300" bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><span>
                    <select name="team_name" id="team_name" onchange="CallsubTeam(this.value, '');">
                      <option value="0">=======선택=======</option>
                      <?						 		
						 		$arr = Fetch_string("SELECT * FROM team_cate WHERE depth=1 ORDER BY idx DESC");								
								for($i=0;$i<count($arr);$i++){
								//if(!$team_name){	
								
								
						 ?>
                      <? //} else { ?>
                      <option value="<?=$arr[$i][name]?>|<?=$arr[$i][idx]?>" <? if( $arr[$i][name]."|".$arr[$i][idx] == $team_name){?> selected="selected" <? } ?>> 
                      <?=$arr[$i][name]?>
                      </option>
                      <?// }
						 
						 }?>
                    </select>
                    </span> </td>
                  <td width="100" align="center" bgcolor="f6f6f6">팀 명</td>
                  <td width="270" bgcolor="#FFFFFF" style="padding-left:10px;" align="left">
				 

				 <?
					 
				// echo trim($row[team_code]) ."==". trim($row[team_name]) ."==". trim($row[team_subname]);


				 ?>
				  

	<span id="teamsub">
		 
	  </span>

					</td>
                </tr>
                <tr> 
                  <td height="20" align="center" bgcolor="f6f6f6">기 타</td>
                  <td colspan="3" bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><input type="text" name="team_subname_etc" style='width:200;'></td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
          </tr>
          <? } ?>
          <?if($row[usort] == 'premium1' || $row[usort] == 'premium2' || $row[usort] == 'premium3' || $row[usort] == 'premium4' || $row[usort] == 'jisajang' || $row[usort] == 'admin'|| $row[usort] == 'superadmin') {?>
          <tr> 
            <td height="20" class="title" align="left"><img src="/admin/img/icon02.gif" width="15" height="15" ALIGN=absmiddle > 
              <strong>사업자정보</strong></td>
          </tr>
          <tr> 
            <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="dadada" style="padding:0 0 0 0" class="table-style">
                <tr> 
                  <td width="100" height="23" align="center" bgcolor="f6f6f6" class="table-th">업 체</td>
                  <td width="280" bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><span>
                    <input name="company_name" hname="상호(단체명)" type="text" class="input" value="<?=$row[company_name]?>" style="width:280px" />
                    </span> </td>
                  <td width="100" align="center" bgcolor="f6f6f6" class="table-th">사업자번호</td>
                  <td width="275" bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><span>
                    <input name="company_no1" id="company_no1" maxlength="3" hname="사업자번호"   type="text" class="input" size="5" value="<?=$company_no1?>"/>
                    -<span style="padding-left: 5px;padding-top: 2px;"> 
                    <input name="company_no2" id="company_no2" type="text" class="input" size="5" hname="사업자번호"  value="<?=$company_no2?>" maxlength="2"/>
                    </span>-<span style="padding-left: 5px;padding-top: 2px;"> 
                    <input name="company_no3" id="company_no3" type="text" class="input" size="8" hname="사업자번호"  value="<?=$company_no3?>" maxlength="5"/>
                    </span></span></td>
                </tr>
                <tr> 
                  <td width="100" height="23" align="center" bgcolor="f6f6f6" class="table-th">대 
                    표</td>
                  <td width="280" bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><span>
                    <input name="ceo_name" type="text" class="input" hname="대표자명"  value="<?=$row[ceo_name]?>" style="width:280px"/>
                    </span></td>
                  <td width="100" align="center" bgcolor="f6f6f6" class="table-th">법인등록번호</td>
                  <td width="275" bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><span>
                    <input name="ceo_ssn1" type="text" class="input" id="ceo_ssn1" value="<?=$ceo_ssn1?>" size="10" maxlength="6"   hname="주민번호"/>
                    </span> - <span>
                    <input name="ceo_ssn2" type="text" class="input" id="ceo_ssn2" value="<?=$ceo_ssn2?>" size="10" maxlength="7"   hname="주민번호"/>
                    </span></td>
                </tr>
                <tr> 
                  <td width="100" height="23" align="center" bgcolor="f6f6f6" class="table-th">업 태</td>
                  <td width="280" bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><span>
                    <input name="company_sort" id="company_sort" type="text" class="input" hname="업태"  value="<?=$row[company_sort]?>" style="width:280px"/>
                    </span></td>
                  <td width="100" align="center" bgcolor="f6f6f6" class="table-th">종 목</td>
                  <td width="275" bgcolor="#FFFFFF" style="padding-left:10px;" align="left"><span>
                    <input name="company_subsort" id="company_subsort" type="text" class="input" hname="종목"  value="<?=$row[company_subsort]?>"/>
                    </span></td>
                </tr>
                <tr> 
                  <td height="23" align="center" bgcolor="f6f6f6" class="table-th">사업장주소</td>
                  <td colspan="3" bgcolor="#FFFFFF" style="padding-left:10px;" align="left">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;margin-bottom:5px;">
                      <tr> 
                        <td height="23" style="padding-bottom:5px;"><span>
                          <input name="czipcode" type="text" class="input" id="czipcode1" value="<?=$row[company_post]?>" size="5"/>
                          </span>   <a href="javascript:openDaumPostcode2()" style='cursor:hand'>  우편번호</a>
                        </td>
                      </tr>
                      <tr> 
                        <td height="23" style="padding-bottom:5px;"><input name="caddress" type="text" id="company_addr1" value="<?=$row[company_addr1]?>" size="70" class="input"></td>
                      </tr>
                      <tr> 
                        <td height="23"><input name="caddress_ext" type="text" id="company_addr2" value="<?=$row[company_addr2]?>" size="70" class="input"></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td height="23" align="center" bgcolor="f6f6f6" class="table-th">업종구분</td>
                  <td bgcolor="#FFFFFF" style="padding-left:10px;" align="left" colspan="3">
				  <select name="upjong" size="1" id="upjong" onchange="change_upjongs()">
                <option value="">==업종별구분==</option>
                <option value="폐차업자" <? if($row[upjong] == '폐차업자'){?> selected="selected" <? } ?>>폐차업자</option>
                <option value="자동차정비" <? if($row[upjong] == '자동차정비'){?> selected="selected" <? } ?>>자동차정비</option>
                <option value="중고부품업" <? if($row[upjong] == '중고부품업'){?> selected="selected" <? } ?>>중고부품업</option>
                <option value="자동차무역" <? if($row[upjong] == '자동차무역'){?> selected="selected" <? } ?>>자동차무역</option>
                <option value="매매상사" <? if($row[upjong] == '매매상사'){?> selected="selected" <? } ?>>매매상사</option>
                <option value="딜러" <? if($row[upjong] == '딜러'){?> selected="selected" <? } ?>>딜러</option>
                <option value="기타" <? if($row[upjong] == '기타'){?> selected="selected" <? } ?>>기타</option></select>
				  </td>
				</tr>
              </table></td>
          </tr> <? } ?>
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table></td>
  </tr>
  <tr> 
    <td height="40" align="center"> <input type="button" name="Submit222223" value="목록보기" class="button44 btn-blue" onClick="window.location='Member_list.php?<?=$href?>'"> &nbsp;<input type="submit" name="Submit2222222" value="수정하기" class="button33 btn-red-sm">
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<script type="text/javascript">

function code_choices1() {	
	var c_name = document.getElementById('company_name').value;
	

	if(!c_name){
		if(document.join.team_name.value != 0){
			document.join.action = "<?=$PHP_SELF?>?No=<?=$No?>";
			document.join.submit();
		}
	} else {
		alert("회사명 또는 보험 회사명 둘중 한가지만 입력 가능 합니다.");
		document.join.team_name.value = '0';
		return false;
	}

}

function change_usort(){
	document.join.usort_change.value = 1;
}

function change_upjongs(){
	document.join.upjong_change.value = 1;
}

function form_check(){
	usval=document.getElementById('usort').options[document.getElementById('usort').selectedIndex].value;
	if((usval=="premium2"||usval=="jisajang"||usval=="jisajang2")&&(document.join.mdate.value==""||document.join.mdate.value=="0000-00-00")){
		alert("등급변경일을 입력해 주세요.");
		return false;
	}else if(document.join.nicchk_value.value == 0){
		alert("닉네임 중복확인해주세요.");
		return false;
	}else if(document.join.power[0].checked==false&&document.join.power[1].checked==false&&document.join.power[2].checked==false){
		alert("입찰권한을 선택해 주세요.");
		return false;
	}else{
		document.join.action = "proc.php?Mode=Modify&No=<?=$row[idx]?>";
		document.join.submit();
	}
}

function code_choice1(subName) {	
	
	//alert('fdsaf');
	var ccc =  document.getElementById('company_name');
	var c_name = document.getElementById('company_name');
	var t_name = document.getElementById('team_name');
	var tv_name = document.getElementById('team_name').value;

	if(c_name.value){
	//	alert("회사명을 직접입력하였으므로, 보험사를 선택할 수 없습니다.");
		//t_name.value = 0;
		//return false;
	}

		
/*
	if(t_name.value != 0 || t_name.value ==""){		
		t_name.readOnly = true;
		c_name.readOnly = true;
	}else{		
		t_name.readOnly = false;
		c_name.readOnly = false;
	}
*/


	if(ccc.value == ''){	
		
		var sub_list = <?=$list?>;			
		var codearr = tv_name.split('|');	
		var code = codearr[1];			
	
		
		var tag = "<select name='team_subname' id='team_subname'>";	
		var flag = 1;	
		for(var i=0; i<sub_list.length -1; i++) {
			
			if(code == sub_list[i].code) {

				if(sub_list[i].name == subName){
					
					tag+="<option value='"+sub_list[i].name+"' selected>"+sub_list[i].name+"</option>";			
				}else{
					tag+="<option value='"+sub_list[i].name+"'>"+sub_list[i].name+"</option>";
				}
				flag = 2;			
			} 		
		}	


		if(flag == '1') tag+="<option value=''>해당지점없음</option>";
		//document.getElementById('team_span').innerHTML = tag;
		
		//document.getElementById('select_company_name').value = 1;
	} 	
}

var please_wait = null;

function CallsubTeam(idx, subidx) {
	var url = "../../inc/ncompany_ajax.php?idx="+idx;
    if ( ! document.getElementById) {
          return false;
    }


	document.getElementById('teamsub').innerText = "로딩중입니다.";


    //if (please_wait != null) {
    //      document.getElementById(target).innerHTML = please_wait;
    //}

    if (window.ActiveXObject) {
          link = new ActiveXObject("Microsoft.XMLHTTP");
    } else if (window.XMLHttpRequest) {
          link = new XMLHttpRequest();
    }

    if (link == undefined) {
          return false;
    }
    link.onreadystatechange = function() { response(url, subidx); }
    link.open("GET", url, true);
    link.send(null);
}

function response(url, subidx) {
    if (link.readyState == 4) {
         
		 if (link.status == 200)
		 {
			 var ReturnVal = link.responseText;
			 if (ReturnVal != "")
			 {
			
			 splitReturn = ReturnVal.split(',');
			 var html = "<select name='team_subname'>\n";
				html += "<option value=''>==소속선택==</option>\n";
				
				var sel;
				for (var i=0; i < splitReturn.length ; i++ )
				{

					if(subidx == splitReturn[i]){
						sel = "selected";
					}else{
						sel = "";	
					}
					html += "<option value='"+ splitReturn[i] +"'  "+ sel +">"+splitReturn[i]+"</option>\n";
				}

				 html += "</select>\n";


				 document.getElementById('teamsub').innerHTML = html;
				 document.getElementById('team_subname_etc').value = "";
				 document.getElementById('team_subname_etc').readOnly = true;
				 document.getElementById('team_subname_etc').style.background = "#f3f3f3";

			}else{

				document.getElementById('teamsub').innerText = " 소속없음 ";
				document.getElementById('team_subname_etc').value = "";
				document.getElementById('team_subname_etc').readOnly = false;
				document.getElementById('team_subname_etc').style.background = "#ffffff";
				
			}
		 }
    }
}


</script>


<?



// 로그인된 회원이고 팀명이 있다면
if($loginId &&  $row[team_code]){	

	echo "<script>
			CallsubTeam('".$row[team_name]."|".$row[team_code]."', '".trim($row[team_subname])."');
		  </script>";

	
	echo "<script>
			document.getElementById('team_name').value='".$row[team_name]."|".$row[team_code]."';
			//code_choice1('".$row[team_subname]."');
			//document.getElementById('company_name').value='';
			//document.getElementById('company_name').readOnly = true;
		  </script>";
}
?>
<? include_once "../inc/footer.php";?>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
	function openDaumPostcode() {
       new daum.Postcode({
            oncomplete: function(data) {
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    fullAddr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    fullAddr = data.jibunAddress;
                }
                if(data.userSelectedType === 'R'){
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.join.zipcode.value = data.zonecode; //5자리 새우편번호 사용
                document.join.address.value = fullAddr;
                document.join.address_ext.focus();
            }
        }).open();
    }


	function openDaumPostcode2() {
       new daum.Postcode({
            oncomplete: function(data) {
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    fullAddr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    fullAddr = data.jibunAddress;
                }
                if(data.userSelectedType === 'R'){
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.join.czipcode.value = data.zonecode; //5자리 새우편번호 사용
                document.join.caddress.value = fullAddr;
                document.join.caddress_ext.focus();
            }
        }).open();
    }
</script>


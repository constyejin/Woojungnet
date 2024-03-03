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



	$sql = "SELECT * FROM woojung_member WHERE idx = '$No'";	
	$row = Row_string($sql);

	$com = Row_string("SELECT * FROM recruit WHERE code  = '$row[code]'");
	
	$tmp = explode("-",$row[mdate]);
	$now = mktime(0,0,0,$tmp[1],$tmp[2]-1,$tmp[0]+1);
	$EndDay = date("Y-m-d",$now);

	if( strpos($row[usort],'premium') !== false )  $pre_rdate = $row[pre_rdate];
	else $pre_rdate = "";

	if( strpos($row[usort],'premium') !== false )  $pre_mdate  = $row[pre_mdate];
	else $pre_mdate = "";

	if($pre_rdate && $pre_mdate){
		$predate = $pre_rdate."~".$pre_mdate;
	}else{
		$predate = $row[rdate];
	}


	if($row[emailSend] == "yes"){
		$emailSend = "[수신]";
	}else{
		$emailSend = "[아니오]";
	}


	
?>
<style type="text/css">
  .style1 {color: #FFFFFF}
</style>

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
   yearRange: '2010:2020' //1990년부터 2020년까지
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

<iframe name="hiddenframe" style="display:none;"></iframe>


<table width="970" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><table width="900" border="0" cellspacing="0" cellpadding="0"><tr>
      <td align="center"><table width="900" border="0" cellspacing="0" cellpadding="0">
       <tr>
  <td height="20" colspan="2" align="left" style="color:#333399"> <font size="-4"> ▶ </font>위치 : 회원관리 &gt; 상세보기 </td></tr>
<tr><td  height="1" bgcolor="#333399" colspan="2"> </td></tr>
<tr>
  <td  height="20" colspan="2"></td></tr>


  <tr> 
    <td align="center"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="40" align="left">
          <input type="submit" name="Submit" value="입찰목록" class="button33 btn-blue" onclick="javascript:window.open('./nmypage04.php?pop_id=<?=$row[userId]?>','aa','width=1000,height=500,scrollbars=yes')" />
          <input type="submit" name="Submit2223322" value="출품목록" class="button33 btn-blue" onClick="javascript:window.open('./nmypage02.php?pop_id=<?=$row[userId]?>','aa','width=1000,height=500,scrollbars=yes')" />
          <input type="submit" name="Submit2223322" value="관심목록" class="button33 btn-blue" onClick="javascript:window.open('./nmypage09.php?pop_id=<?=$row[userId]?>','aa','width=1000,height=500,scrollbars=yes')" />
          <input type="submit" name="Submit2223322" value="낙찰목록" class="button33 btn-blue" onClick="javascript:window.open('./nmypage05.php?pop_id=<?=$row[userId]?>','aa','width=1000,height=500,scrollbars=yes')" />          </td>
          <td width="300" align="right"><input type="submit" name="Submit222222" value="목록보기" class="button44 btn-blue" onClick="window.location='Member_list.php?<?=$href?>'" > 
            <input type="submit" name="Submit222322" value="수정하기" class="button33 btn-red-sm" onClick="window.location='modify.php?No=<?=$row[idx]?>&<?=$href?>'"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td align="center"> <table width="900" border="0" cellspacing="0" cellpadding="0">
	<!--
        <tr> 
          <td height="20" align="left" class="title"><img src="/admin/img/icon_1.jpg" ALIGN=absmiddle> 
            <strong>접수회원사</strong></td>
        </tr>
				 <tr> 
          <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0">
              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6">접수회원사</td>
                <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$com[company]?></td>
                <td width="100" align="center" bgcolor="f6f6f6">코드번호</td>
                <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$com[code]?></td>
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
          <td>&nbsp;</td>
        </tr>-->
        <tr> 
          <td align="left"><span class="title"><img src="/manage/img/icon_1.jpg" class="bullet" /> <strong>기본정보</strong></span></td>
        </tr>
        <tr> 
          <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0" class="table-style">
              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">이름/회사</td>
                <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[name]?> / <?=$row[company_name]?>                </td>
                <td width="100" align="center" bgcolor="f6f6f6" class="table-th">아 이 디</td>
                <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[userId]?>                </td>
              </tr>
              <tr> 
                <td width="100" height="20" align="center" bgcolor="f6f6f6" class="table-th">닉 
                  네 임</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[userNick]?>                </td>
                <td width="100" align="center" bgcolor="f6f6f6" class="table-th">비밀번호</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[userPw]?> <?=$row[pw_mod_date]!="0000-00-00 00:00:00"?" / ".substr($row[pw_mod_date],0,10)." 변경":""?>               </td>
              </tr>
              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">가 입 일</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[rdate]?>
                </td>
                <td align="center" bgcolor="f6f6f6" class="table-th">입찰권한</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$arr_power[$row[power]]?>                </td>
                </tr>
              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">등급변경일</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$predate?>                </td>
                <td align="center" bgcolor="f6f6f6" class="table-th">회원등급</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=grade_sort($row[usort])?>                </td>
              </tr>
              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">대표전화</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[tel]?>                </td>
                <td align="center" bgcolor="f6f6f6" class="table-th">휴대전화</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[pcs]?>                </td>
              </tr>
              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">회사전화</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[company_tel]?>                </td>
                <td align="center" bgcolor="f6f6f6" class="table-th">팩스번호</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[fax]?>                </td>
              </tr>
              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">이메일</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                 <?=$row[email]?>
                  &nbsp; 
                  <?=$emailSend?>                 </td>
                <td align="center" bgcolor="f6f6f6" class="table-th">최근접속일</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[loginTime]?></td>
              </tr>
              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">로그인수</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=number_format($row[logincnt])?></td>
                <td align="center" bgcolor="f6f6f6" class="table-th">탈퇴일자</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row[out_date]?></td>
              </tr>
              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">주 소</td>
                <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">[ 
                  <?=$row[post1]?>
                  ] &nbsp;&nbsp; 
                  <?=$row[addr1]?>
                  &nbsp; 
                  <?=$row[addr2]?>                </td>
              </tr>
			   <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">메모</td>
                <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 
                <?=$row[memo]?>                </td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
		<?
	  
	  if($row[usort] == 'company1' || $row[usort] == 'company2' ){ 
		  
		  
		  
		  if($row[team_name] && $row[team_code]){
			$team_name = $row[team_name];
		  }else{
			$team_name = $row[company_name];
		  }

	
		 
		  
		  ?>
        <tr> 
          <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle > 
            <strong>제휴회원</strong></td>
        </tr>
        <tr> 
          <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0">
              <tr> 
                <td width="100" height="20" align="center" bgcolor="f6f6f6" class="table-th">업체명</td>
                <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$team_name?>                </td>
                <td width="100" align="center" bgcolor="f6f6f6" class="table-th">팀 명</td>
                <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[team_subname]?>                </td>
              </tr>
              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">기 타</td>
                <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
		<? } ?>
          <? if($row[usort] == 'premium1' || $row[usort] == 'premium2' || $row[usort] == 'premium3' || $row[usort] == 'premium4' || $row[usort] == 'jisajang' || $row[usort] == 'admin'|| $row[usort] == 'superadmin') {
				

		  $arrcompany_post = explode("-", $row[company_post]);
		  $company_post1 = $arrcompany_post[0];
		  $company_post2 = $arrcompany_post[1];


		  $tmp = explode("-",$row[ceo_ssn]); 
		  $ceo_ssn1 = $tmp[0];
		  $ceo_ssn2 = $tmp[1];
		  
		  ?>
        <tr> 
          <td height="20" align="left" class="title"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle > 
            <strong>사업자정보</strong></td>
        </tr>
        <tr> 
          <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0" class="table-style">
              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">업 체</td>
                <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[company_name]?>                </td>
                <td width="100" align="center" bgcolor="f6f6f6" class="table-th">사업자번호</td>
                <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[company_no]?>                </td>
              </tr>
              <tr> 
                <td width="100" height="20" align="center" bgcolor="f6f6f6" class="table-th">대 
                  표 자</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[ceo_name]?>                </td>
                <td width="100" align="center" bgcolor="f6f6f6" class="table-th">법인등록번호</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$ceo_ssn1?>
                  -
                  <?=$ceo_ssn2?>                </td>
              </tr>
              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">업 태</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[company_sort]?>                </td>
                <td align="center" bgcolor="f6f6f6" class="table-th">종 목</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                  <?=$row[company_subsort]?>                </td>
              </tr>
              <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">사업장주소</td>
                <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">[ 
                  <?=$company_post1?>
                  - 
                  <?=$company_post2?>
                  ] &nbsp;&nbsp; 
                  <?=$row[company_addr1]?>
                  &nbsp; 
                  <?=$row[company_addr2]?>                </td>
              </tr>
			   <tr> 
                <td height="20" align="center" bgcolor="f6f6f6" class="table-th">업종구분</td>
                <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"> 
                 <?=$row[upjong]?>                </td>
                </tr>
            </table></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
		<?

	
	if($row[usort] == 'premium2' || $row[usort] == 'premium3' || $row[usort] == 'premium4' || $row[usort] == 'jisajang' ) { ?>
        <!--tr> 
          <td height="23" align="left" class="title"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle> 
            <strong>년회비</strong></td>
        </tr>
        <tr> 
          <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0">
              <tr> 
                <td height="23" align="center" bgcolor="#FFFFFF"> 
				 <script>
				function YearPayCheck(){
					var frm = document.yearpay;
					if(!frm.req_date.value){
						alert("년회비 납부일자를 선택해주세요");
						return;
					}
					if(!frm.year_money.value){
						alert("금액을 입력해주세요.");
						return;
					}
					frm.target = "hiddenframe";
					frm.action = "fee_proc.php";
					frm.submit();
				}
			</script>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <form name="yearpay" method="post">

				<input type="hidden" name="userId" value="<?=$row[userId]?>" />
				<input type="hidden" name="No" value="<?=$No?>" />
				<input type="hidden" name="Mode" value="year" />
				<input type="hidden" name="cfdate" value="<?=$row[mdate]?>" /><tr> 
                      <td width="170" style="padding:0 0 0 10"> <input name="req_date" type="text" id="edate" size="15"  readonly="readonly" style='width:100;'/>
                        </td>
                      <td width="170" style="padding:0 0 0 10">금액 
                        <input name="year_money" type="text" id="year_money" size="15" class="input" style='width:100;'/>
                        원</td>
                      <td style="padding:0 0 0 10">비고 
                        <input type="text" name="year_memo" size="33"  class="input" style='width:300;'/> 
                        <input type="submit" name="Submit22232" value="입력" class="button3" onClick="javascript:YearPayCheck()" style="cursor:pointer; background-color:#FFFFFF; color:#084573; border:#636563 1px solid; padding:2 3 0 3; font-weight:bold"></td>
                    </tr></form>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="5"> </td>
        </tr>
        <tr> 
          <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr class="sbtitle"> 
                <td width="100" align="center" background="/admin/img/titlebg01.gif" ><span class="style1"> 
                  납부일자 </span></td>
                <td width="100" height="28" align="center" background="/admin/img/titlebg01.gif" ><span class="style1">납입액</span></td>
                <td align="center" background="/admin/img/titlebg01.gif"><span class="style1">비고/설명</span></td>
              </tr-->
              <!-- 반복되는 줄 시작 -->
			  <? 					
					$yarr = Fetch_string("SELECT * FROM y_fee WHERE userId = '$row[userId]' order by idx desc");	
				
				//echo "SELECT * FROM y_fee WHERE userId = '$row[userId]' order by idx desc";

					for($i=0;$i<count($yarr);$i++){
					if($yarr[$i][userId]){
					
				?>
              <tr style="padding:3 0 0 0;cursor:hand" onclick="location.href='view.php'" > 
                <td align="center" >
                  <?=$yarr[$i][cfdate]?>                </td>
                <td height="25" align="center">
                  <?=number_format($yarr[$i][fee])?>                </td>
                <td style="padding:0 0 0 10"> 
                  <?=$yarr[$i][memo]?>
                  <a href="fee_proc.php?No=<?=$yarr[$i][idx]?>&Mode=YDelete"><img src="../../image/admin_x_bu.gif" width="13" height="14" border="0" /></a>                </td>
              </tr>
			  <?  }}?>
              <!-- 반복되는 줄 끝 -->
            </table></td>
        </tr>
        <!--tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td height="23" align="left" class="title"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle> 
            <strong>보증금</strong></td>
        </tr>
        <tr> 
          <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:3 0 0 0">
              
			  <tr> 
                <td height="23" align="center" bgcolor="#FFFFFF"> <script>
				function bojung(){
					var frm = document.BFrm;
					if(!frm.req_date2.value){
						alert("보증금 납부일자를 선택해주세요");
						return;
					}
					if(!frm.BMoney.value){
						alert("금액을 입력해주세요.");
						return;
					}
					frm.target = "hiddenframe";
					frm.action = "fee_proc.php";
					frm.submit();
				}
			</script>
			
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <form name="BFrm" method="post">
               <input type="hidden" name="userId" value="<?=$row[userId]?>" />
                <input type="hidden" name="No" value="<?=$No?>" />
                <input type="hidden" name="Mode" value="bojung" /><tr> 
                      <td width="170" style="padding:0 0 0 10"> <input name="req_date2" type="text" id="mdate" size="15"  readonly="readonly" style='width:100;'/>
                        </td>
                      <td width="170" style="padding:0 0 0 10">금액 
                        <input name="BMoney" type="text" id="BMoney" size="15" class="input" style='width:100;'/>
                        원</td>
                      <td style="padding:0 0 0 10">비고 
                        <input name="memo" type="text" id="memo" size="33" class="input" style='width:300;'/> 
                        <input type="submit" name="Submit22232" value="입력" class="button3" onClick="javascript:bojung()" style="cursor:pointer; background-color:#FFFFFF; color:#084573; border:#636563 1px solid; padding:2 3 0 3; font-weight:bold"></td>
                    </tr></form>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="5"> </td>
        </tr>
        <tr> 
          <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr class="sbtitle"> 
                <td width="100" align="center" background="/admin/img/titlebg01.gif" ><span class="style1"> 
                  일자</span></td>
                <td width="100" height="28" align="center" background="/admin/img/titlebg01.gif" ><span class="style1">금액</span></td>
                <td align="center" background="/admin/img/titlebg01.gif"><span class="style1">비고/설명</span></td>
              </tr>
			  <? 					
					$garr = Fetch_string("SELECT * FROM guaranty WHERE userId = '$row[userId]'");														
					for($i=0;$i<count($garr);$i++){
					if($garr[$i][userId]){
					$total += $garr[$i][fee];
				?>
              <tr style="padding:3 0 0 0;cursor:hand" onclick="location.href='view.php'" > 
                <td align="center" > 
                  <?=$garr[$i][ipdate]?>                </td>
                <td height="25" align="center"> 
                  <?=number_format($garr[$i][fee])?>                </td>
                <td style="padding:0 0 0 10"> 
                  <?=$garr[$i][bigo]?>
                  <a href="fee_proc.php?No=<?=$garr[$i][idx]?>&Mode=GDelete"><img src="../../image/admin_x_bu.gif" width="13" height="14" border="0" /></a>                </td>
              </tr>
			   <? } }?>
              <!-- 반복되는 줄 시작 -->
              <!--tr style="padding:3 0 0 0;cursor:hand" onclick="location.href='view.php'" > 
                <td align="center" >합계</td>
                <td height="25" align="center"> 
                  <?=number_format($total)?>                </td>
                <td colspan="2" align="center">&nbsp;</td>
              </tr-->
              <!-- 반복되는 줄 끝 -->
            </table></td>
        </tr>
        <!--tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td height="23" align="left" class="title"><img src="/manage/img/icon_1.jpg" ALIGN=absmiddle> 
            <strong>입찰제한정보</strong></td>
        </tr>
        <tr> 
          <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:3 0 0 0">
              <tr> 
                <td height="23" align="center" bgcolor="#FFFFFF"> <script>
				function panalty1(){
					var frm = document.penalty;
					if(!frm.req_date3.value){
						alert("년회비 납부일자를 선택해주세요");
						return;
					}
					if(!frm.subject.value){
						alert("내용을 입력해주세요.");
						return;
					}
					if(!frm.act.value){
						alert("조치내용을 입력해주세요.");
						return;
					}
					frm.target = "hiddenframe";
					frm.action = "fee_proc.php";
					frm.submit();
				}
			</script>
                 
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <form name="penalty" method="post">
              <input type="hidden" name="userId" value="<?=$row[userId]?>" />
                <input type="hidden" name="No" value="<?=$No?>" />
                <input type="hidden" name="Mode" value="penalty" /> <tr> 
                      <td width="170" style="padding:0 0 0 10"> <input name="req_date3" type="text" id="adate" size="15"  readonly="readonly" />
                        </td>
                      <td width="240" style="padding:0 0 0 10">내용 
                        <input name="subject" type="text" id="subject" size="25" class="input" style='width:200;'/> 
                      </td>
                      <td style="padding:0 0 0 10">비고 
                        <input name="act" type="text" id="act" size="25" class="input" style='width:200;'/> 
                        <input type="submit" name="Submit22232" value="입력" class="button3" onClick="javascript:panalty1()" style="cursor:pointer; background-color:#FFFFFF; color:#084573; border:#636563 1px solid; padding:2 3 0 3; font-weight:bold"></td>
                    </tr></form>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="5"> </td>
        </tr>
        <tr> 
          <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr class="sbtitle"> 
                <td width="100" height="28" align="center" background="/admin/img/titlebg01.gif" ><span class="style1"> 
                  일자 </span></td>
                <td width="300" align="center" background="/admin/img/titlebg01.gif" ><span class="style1">내용</span></td>
                <td align="center" background="/admin/img/titlebg01.gif"><span class="style1">비고</span></td>
              </tr-->
              <!-- 반복되는 줄 시작 -->
			   <? 					
					$parr = Fetch_string("SELECT * FROM penalty WHERE userId = '$row[userId]'");														
					for($i=0;$i<count($parr);$i++){
					if($parr[$i][userId]){					
				?>
              <tr style="padding:3 0 0 0;cursor:hand" onclick="location.href='view.php'" > 
                <td height="25" align="center" >
                  <?=$parr[$i][date]?>                </td>
                <td align="center">
                  <?=$parr[$i][subject]?>                </td>
                <td style="padding:0 0 0 10"> 
                  <?=$parr[$i][act]?>
                  <a href="fee_proc.php?No=<?=$parr[$i][idx]?>&Mode=PDelete"><img src="../../image/admin_x_bu.gif" width="13" height="14" border="0" /></a>                </td>
              </tr>
			  <? }} ?>
              <!-- 반복되는 줄 끝 -->
            </table></td>
        </tr><? } 
			}?>
        <tr> 
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="40" align="center"><input type="submit" name="Submit22222" value="목록보기" class="button44 btn-blue" onClick="window.location='Member_list.php?<?=$href?>'">&nbsp; 
      <input type="submit" name="Submit22232" value="수정하기" class="button33 btn-red-sm" onClick="window.location='modify.php?No=<?=$row[idx]?>&<?=$href?>'"></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>

<? include_once "../inc/footer.php";?>

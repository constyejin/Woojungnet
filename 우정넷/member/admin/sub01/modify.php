<?
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";

if($mno){
	$member=mysql_fetch_array(mysql_query("select * from cmorder where idx='".$mno."'"));
	$sql_l=mysql_fetch_array(mysql_query("select * from licence_exam where idx='".$member[li_idx]."'"));
	$lic=mysql_fetch_array(mysql_query("select * from licence where idx='".$sql_l[li_idx]."'"));
	if($sql_l[state]=="1"){
		$lic_state="필기";
	} else {
		$lic_state="직무";
	}
	$addr=explode("|",$member[cmoaddress]);	
	$tele=explode("-",$member[mTel]);	
	$email=explode("@",$member[cmoemail]);	
	$tele=explode("-",$member[cmophone]);	
	$mobile=explode("-",$member[cmohp]);	
	$ymd=explode("-",$member[ymd]);	
}

if($mode=="modify"){
	$cmoaddress=$cmoaddress1."|".$cmoaddress2;
	$cmoemail=$cmoemail1."@".$cmoemail2;
	$ymd=$ymd1."-".$ymd2."-".$ymd3;
	$cmohp=$cmohp1."-".$cmohp2."-".$cmohp3;
	$cmophone=$cmophone1."-".$cmophone2."-".$cmophone3;
	$cmopost=$cmopost;
	
	$add[]="cmoname='".$_POST[cmoname]."'";
	$add[]="cmoname2='".$_POST[cmoname2]."'";
	$add[]="ymd='".$ymd."'";
	$add[]="cmoemail='".$cmoemail."'";
	$add[]="cmophone='".$cmophone."'";
	$add[]="cmohp='".$cmohp."'";
	$add[]="cmopost='".$cmopost."'";
	$add[]="cmoaddress='".$cmoaddress."'";
	$add[]="cmosm='".$cmosm."'";
	$add[]="bank_idx='".$bank_idx."'";
	$add[]="in_name='".$in_name."'";

	for($i=0;$i<sizeof($add);$i++){
		if($i) $proc_list.=",$add[$i]";
		else $proc_list=$add[$i];
	}

	$sql="update cmorder set $proc_list where idx='".$mno."'";
	mysql_query($sql);
	echo "<script>alert('변경되었습니다.');top.location.href='/admin/sub01/modify.php?mno=".$mno."';</script>";
	exit;
}

?>
<link rel="stylesheet" href="/css/admin.css" type="text/css">
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<script>
			function write_func(){
				var f=document.join;
				if(!f.cmoname.value){
					alert('이름을 입력하세요');
					return;
				}
				if(!f.cmoemail1.value || !f.cmoemail2.value){
					alert('이메일을 입력하세요');
					return;
				}
				if(!f.cmophone1.value || !f.cmophone2.value || !f.cmophone3.value){
					alert('전화번호를 입력하세요');
					return;
				}
				if(!f.cmohp1.value || !f.cmohp2.value || !f.cmohp3.value){
					alert('핸드폰번호을 입력하세요');
					return;
				}
				f.submit();
			}
</script>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
	function openDaumPostcode() {
       new daum.Postcode({
            oncomplete: function(data) {
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    fullAddr = data.roadAddress;

                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    fullAddr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                if(data.userSelectedType === 'R'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.join.cmopost.value = data.zonecode; //5자리 새우편번호 사용
                document.join.cmoaddress1.value = fullAddr;

                // 커서를 상세주소 필드로 이동한다.
                document.join.cmoaddress2.focus();
            }
        }).open();
    }
</script>


<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" height='100%'>
	<tr>
		<td valign='top'>
			<!--로고 & 탑메뉴-->
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width='130' align='center' valign="top" style='font-size:14px;'><? include "$DOCUMENT_ROOT/admin/inc/sm_sub01_01.php";?></td>
                <td width="1" height="750" valign="top" bgcolor="d7d7d7"><img src="../img/sb.gif" width="1" height="1" /></td>
                <td valign="top" style='padding:10px;'><table width="1000" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td><img src='../img/icon.gif' alt=""> 위치 : 계정관리 &gt;계정관리</td>
                      </tr>
                      </table>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="top" style="border-top:1px solid #d9d9d9;"><TABLE border="0" cellSpacing="1" cellPadding="5" width="100%" bgColor="#dadada">
		  <form name='join' method='POST' enctype="multipart/form-data" style="margin:0px;">
			<input type="hidden" name="mode" value="modify">
			<input type="hidden" name="mno" value="<?=$mno?>">
                    <TR>
                      <TD width="12%" align="center" bgColor="#f6f6f6">한글이름</TD>
                      <TD width="36%" bgColor="#ffffff"><label for="textfield"></label>
                            <input name="cmoname" type="text" value="<?=$member[cmoname]?>" id="textfield"></TD>
                      <TD align="center" bgColor="#f6f6f6">생년월일</TD>
                      <TD bgColor="#ffffff"><input name="ymd1" value="<?=$ymd[0]?>" type="text" id="textfield2" size="4">
                        년
                        <input name="ymd2" value="<?=$ymd[1]?>" type="text" id="textfield2" size="2">
                        월
                        <input name="ymd3" value="<?=$ymd[2]?>" type="text" id="textfield2" size="2">
                        일</TD>
                    </TR>
                    <TR>
                      <TD align="center" bgColor="#f6f6f6">e-mail</TD>
                      <TD colspan="3" bgColor="#ffffff"><input name="cmoemail1" value="<?=$email[0]?>" type="text" id="textfield5" size="13">
                        @
                        <label for="select3">
    <input name="cmoemail2" value="<?=$email[1]?>" type="text" id="textfield6" size="23">
  </label></TD>
                      </TR>
                    <TR>
                      <TD align="center" bgColor="#f6f6f6">전화번호</TD>
                      <TD bgColor="#ffffff"><table  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><label for="textfield7"></label>
                            <input name="cmophone1" value="<?=$tele[0]?>" type="text" id="textfield7" style="width:40px;" maxlength="4"></td>
                          <td width="10" align="center">-</td>
                          <td><label for="textfield7"></label>
                            <input name="cmophone2" value="<?=$tele[1]?>" type="text" id="textfield7" style="width:40px;" maxlength="4"></td>
                          <td width="10" align="center">-</td>
                          <td><label for="textfield7"></label>
                            <input name="cmophone3" value="<?=$tele[2]?>" type="text" id="textfield7" style="width:40px;" maxlength="4"></td>
                        </tr>
                      </table></TD>
                      <TD align="center" bgColor="#f6f6f6">휴대전화</TD>
                       <TD bgColor="#ffffff"><table  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><label for="textfield7"></label>
                            <input name="cmohp1" value="<?=$mobile[0]?>" type="text" id="textfield10" style="width:40px;" maxlength="4"></td>
                          <td width="10" align="center">-</td>
                          <td><label for="textfield7"></label>
                            <input name="cmohp2" value="<?=$mobile[1]?>" type="text" id="textfield11" style="width:40px;" maxlength="4"></td>
                          <td width="10" align="center">-</td>
                          <td><label for="textfield7"></label>
                            <input name="cmohp3" value="<?=$mobile[2]?>" type="text" id="textfield12" style="width:40px;" maxlength="4"></td>
                        </tr>
                      </table></TD>
                    </TR>
                    <TR>
                      <TD align="center" bgColor="#f6f6f6">주소</TD>
                      <TD colspan="3" bgColor="#ffffff"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="25"><label for="textfield7"></label>
                                <input type="text" name="cmopost" value="<?=$member[cmopost]?>" id="textfield7" style="width:80px;">
                              
						
                              <span style="padding-left:3px">
                                <input name="input2" type="button" style="padding-top:2px;" value="우편번호" onClick="openDaumPostcode()" class="btn_blue">
                              </span></td>
                          </tr>
                          <tr>
                            <td height="25"><input name="cmoaddress1" value="<?=$addr[0]?>" type="text" id="textfield8" style="width:80%"></td>
                          </tr>
                          <tr>
                            <td height="25"><input name="cmoaddress2" value="<?=$addr[1]?>" type="text" id="textfield9"  style="width:80%">
                              상세주소</td>
                          </tr>
                      </table></TD>
                    </TR>
                    <TR>
                      <TD align="center" bgcolor="#f6f6f6">직무교육비</TD>
                      <TD bgcolor="#ffffff" colspan="3"><LABEL><?=number_format($member[cmosprice])?>원</LABEL></TD>
                      </TR>
                    <TR>
                      <TD align="center" bgcolor="#f6f6f6">결제방법</TD>
                      <TD bgcolor="#ffffff" colspan="3"><TABLE border="0" cellspacing="0" cellpadding="0">
                        <TBODY>
                          <TR>
                          <td valign="bottom"><input type="radio" name="cmosm" value="1" <? if($member[cmosm]=="1")echo "checked"; ?>></td>
                          <td>무통장</td>
                          <td valign="bottom"><input type="radio" name="cmosm" value="2" <? if($member[cmosm]=="2")echo "checked"; ?>></td>
                            <TD>신용카드</TD>
                          </TR>
                        </TBODY>
                      </TABLE></TD>
                      </TR>
                    <TR>
                      <TD align="center" bgcolor="#f6f6f6">계좌번호</TD>
                      <TD bgcolor="#ffffff" colspan="3">
					  <SELECT name="bank_idx" onChange="document.subfrm.submit();">
						<?
							$sql_bank="select * from config_bank where b_type='2' order by idx";
							$result_bank=mysql_query($sql_bank);
							$i=1;
							while ($data_bank = mysql_fetch_assoc($result_bank)){	
						?>
                            <option value="<?=$data_bank[idx]?>" <? if($data_bank[idx]==$member[bank_idx])echo "selected"; ?>><?=$data_bank[b_name]?>/ <?=$data_bank[b_number]?>/ <?=$data_bank[b_rname]?></option>
						<?
							}
						?>
                      </SELECT>
					  </TD>
                      </TR>
                    <TR>
                      <TD align="center" bgcolor="#f6f6f6">입금자명</TD>
                      <TD bgcolor="#ffffff" colspan="3"><INPUT name="in_name"  type="text" value="<?=$member[in_name]?>"></TD>
                      </TR>
                 <TR>
                    <td bgcolor="#FFFFFF" colspan="5" valign="top" style="padding-top:20px;" align="center">
					<input name="input2" type="button" class="btn_blue" value="목록보기" onClick="window.location='sub01.php'">&nbsp;
                   <input name="input" type="button" class="btn_pink" value="수정하기" onClick="write_func()"></td>
                  </TR>
				  </form>
                </TABLE>
                </tr>
              <tr>
                <td bgcolor='dddddd' height='1' colspan='3'></td>
              </tr>
            </table>
	      <!--/로고 & 탑메뉴-->		
		</td>
  </tr>
	<tr>
		<td height='100%'>
			<!--body-->			
			<!--/body-->
		</td>
	</tr>
</table>
</body>
</html>


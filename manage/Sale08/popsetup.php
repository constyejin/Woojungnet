<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';

//DB명 세팅
$dbname="js_popup";

$widthx="700";

if ($eno) {
	$data=mysql_fetch_array(mysql_query("select * from js_popup where pop_no='$eno'"));
	$subtext="수정";
} else $subtext="등록";

?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function check_submit(){
	return true;
}

function del(no){	
	if(confirm('삭제후 복원 불가능 합니다.\n\n정말 삭제하시겠습니까?')){
		location.href = "./popsetup.php?&action=popsetup&mode=del&idx="+no;
	}
}



//-->
</SCRIPT>


<?
	if($mode == "del" && $idx){

		$dSQL = "Delete From js_popup Where pop_no=". $idx;
		$rIns = mysql_query($dSQL);
		if($rIns){
			MsgMov("삭제되었습니다.","./popsetup.php");
		}
	}
?>
<table width="970" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td>
      <table width="900" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20" align="left" style="color:#333399"> <font size="-4"> ▶ </font>위치 : 팝업설정 &gt; 새로등록</td>
          </tr>
        <tr> 
            <td width="602" height="1" colspan="2" bgcolor="#333399"></td>
        </tr>
        <tr> 
          <td height="20">&nbsp;</td>
        </tr>  
        <tr> 
          <td align="left" ><img src="/manage/img/icon02.gif" width="15" height="15" align=absmiddle /> <strong>팝업설정</strong></td>
        </tr>
      </table>
    </td>
  </tr>

  <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr> 
    <td align="left"> 
    <table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="dadada" >
<iframe name="HiddenFrm" style="display:none;"></iframe>
      <form name="popup" method=post action="./popsetup_ok.php?program=popact" enctype='multipart/form-data' onsubmit="return check_submit()" target="HiddenFrm"  >
          <input type="hidden" value="<?=$eno?>" name="eno">
          <input type="hidden" value="<?=$qcommon?>" name="qcommon">
        
        <col width=15%>
        <col width=35%>
        <col width=15%>
        <col width=35%>
        <tr> 
          <td width="100" height="30" align="center" bgcolor="#f6f6f6" class="table-th">활 성 화</td>
          <td align="left" bgcolor="#ffffff" style="padding-left:10px;"><input type=radio name="pop_app" value="1" style="border:0" <?=check_selected($data[pop_app],1)?>>
            적용 
            <input type=radio name="pop_app" value="0" style="border:0" <?=check_selected($data[pop_app],2)?>>
            미적용 </td>
          <td align="center" bgcolor="#f6f6f6" class="table-th">스크롤바</td>
          <td align="left" bgcolor="#ffffff"  style="padding-left:10px;"><input type="radio" style="border:0" value="1" name="pop_scroll" <?=check_selected($data[pop_scroll],1)?>>
            적용 
            <input type="radio" style="border:0" value="0" name="pop_scroll" <?=check_selected($data[pop_scroll],2)?>>
          미적용</td>
        </tr>
        <?if ($eno) {?>
        <tr> 
          <td height="30" align="center" bgcolor="#f6f6f6">창사이즈</td>
          <td colspan=3 align="left" bgcolor="#ffffff"  style="padding-left:10px;"> 가로 : 
            <input type="text" name="pop_x" size=4 maxlength=4 style="height:20" value="<?=$data[pop_x]?>">
            픽셀(pixel) &nbsp;&nbsp; 세로 : 
            <input type="text" name="pop_y" size=4 maxlength=4 style="height:20" value="<?=$data[pop_y]?>">
            픽셀(pixel) </td>
        </tr>
        <?}?>
        <tr> 
          <td height="30" align="center" bgcolor="#f6f6f6" class="table-th">창 위 치</td>
          <td colspan=3 align="left" bgcolor="#ffffff"  style="padding-left:10px;"> 왼쪽으로부터 : 
            <input type="text" name="pop_left" size=4 maxlength=4 style="height:20" value="<?=$data[pop_left]?>">
            픽셀(pixel) &nbsp;&nbsp; 위로부터 : 
            <input type="text" name="pop_right" size=4 maxlength=4 style="height:20" value="<?=$data[pop_right]?>">
            픽셀(pixel) </td>
        </tr>
        <tr> 
          <td height="30" align="center" bgcolor="#f6f6f6" class="table-th">팝업창 제목</td>
          <td colspan=3 align="left"  bgcolor="#ffffff"  style="padding-left:10px;"><input type=text name="pop_subject" style="width:99%" value="<?=$data[pop_subject]?>"></td>
        </tr>
        <tr> 
          <td height="30" align="center" bgcolor="#f6f6f6" class="table-th">링크주소</td>
          <td colspan=3 align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><input type=text name="pop_link" style="width:400px" value="<?=$data[pop_link]?>">
            <font color=red> http:// </font> 를 붙이세요</td>
        </tr>
        <tr> 
          <td height="30" align="center" bgcolor="#f6f6f6" class="table-th">이 미 지</td>
          <td colspan=3 align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"> <input type=file name="pop_file1" style="width:99%"> 
            <?if ($data[pop_image1]){?>
            <BR>
            <?=$data[pop_image1]?>
            <input type=checkbox name="delete1" value="<?=$data[pop_image1]?>" style="border:0">
            삭제하기 
            <?}?>
          </td>
        </tr>
        <tr> 
          <td height="30" align="center" bgcolor="#f6f6f6" class="table-th">기타옵션</td>
          <td colspan=3 align="left" bgcolor="#fffff"  style="padding-left:10px;"> <input type="checkbox" name="pop_newwin" value="1" style=border:0 <?=check_selected($data[pop_newwin],1)?> <?=!$eno?"checked":""?>>
            새창으로링크 
            <input type="checkbox" name="pop_oneday" value="1" style=border:0 <?=check_selected($data[pop_oneday],1)?> <?=!$eno?"checked":""?>>
            하루동안창열지않음사용 
            <input type="checkbox" name="pop_close" value="1" style=border:0 <?=check_selected($data[pop_close],1)?> <?=!$eno?"checked":""?>>
            창닫기버튼 </td>
        </tr>
      </table>
      <BR> <CENTER>
        <input type="submit" class="button33 btn-red-sm" value="<?=$subtext?>하기" >
        <input name="button" type=button class="button44 btn-blue" onclick="location.href='poplist.php'" value="목록보기" >
        <input name="button" type=button class="button33 btn-black" onclick="del(<?=$eno?>)" value="삭제하기" class="">
      </CENTER></form></td>
  </tr>
  <?
  // 230109 이미지 노출
  if($eno){ ?>
  <tr>
    <td height="30" align="left"><img src="/manage/img/icon02.gif" width="15" height="15" align="absmiddle" /> <strong>미리보기</strong> </td>
  </tr>
  <tr>
    <td align="left"><table width="900" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #dadada">
      <tr>
        <td height="300" align="center"><? if($data[pop_image1]){ ?><img src="/images/popup/<?=$data[pop_image1]?>" ><? } ?></td>
      </tr>
    </table></td>
  </tr>
<? } 
// 230109 이미지 노출
?>
  <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<CENTER>
</CENTER>

<?
function check_selected($value,$kinds){

	switch ($kinds){
	case 1:
	if ($value) $ret="checked";
	else $ret="";
	break;
	case 2:
	if ($value) $ret="";
	else $ret="checked";
	break;
	}
	return $ret;
}
//foot();
?>
<? include_once "../inc/footer.php";?>

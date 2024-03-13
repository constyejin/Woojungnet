<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';



//DB명 세팅
$dbname="js_popup";

if (!$page) $page=1; //초기 페이지 설정
$nperpage=15;
$nperblock=10;
$dataname="bu";

if ($ps) $add[]="$ps='1'";

$add[]="site_code='$site_code'";
$addq[]="pop_no desc";

include "$dir/incCmd/list_inc.php";
?>
<script>
	function all_check(){
		var lng =  document.getElementsByName('check[]');
		if(document.f.allcheck.checked == true){
			for(i=0;i<lng.length;i++){
				lng[i].checked = true;
			}
		} else {
			for(i=0;i<lng.length;i++){
				lng[i].checked = false;
			}
		}
	}
	function delete_member(){
		var j=0;
		var obj = document.getElementsByName('check[]');
		for(var i=0;i < obj.length ; i++){
			if(obj[i].checked == true){
				j++;
				break;
			}
		}
		
		if(j == 0){
			alert("선택된 자료가 없습니다.");
			return;
		}

		result = confirm("한번 삭제하신 자료는 복구 불가능 합니다.\n정말 삭제 하시겠습니까??");
		if(result){
			
			document.f.submit();
		}
	}
</script>

<table width="970" border="0" cellspacing="0" cellpadding="0">

  <tr> 
    <td colspan="2" class="title">
      <table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="20" align="left" style="color:#333399"> <font size="-4"> ▶ </font>위치 : 팝업설정 &gt; 팝업설정리스트</td>
        </tr>
        <tr> 
          <td width="602" height="1" colspan="2" bgcolor="#333399"></td>
        </tr>
        <tr> 
          <td height="20">&nbsp;</td>
        </tr>  
        <tr> 
          <td align="left" class="title"><img src="/manage/img/icon02.gif" width="15" height="15" align=absmiddle /> <strong>팝업설정</strong></td>
          <td width="107" class="title">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>


  <tr> 
    <td colspan="3" align="left">
      <table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="20" align="right"> 
            <!-- <td align=right><input type="button" value="새로등록" onclick="location.href='<?=$PHP_SELF?>?<?=$qcommon?>&program=<?=$program?>&action=popsetup'"> -->
            <input type="button" onclick="location.href='./popsetup.php'" value="신규등록" class="button44" style="cursor:pointer; background-color:#fae3e3; color:#ff0000; border:#ff0000 1px solid; padding:3 3 3 3; height:23px; margin-bottom:10px; "> 
          </td>
        </tr>
        <tr> 
          <td>
<form name="f" action="proc.php" method="post">
<input type="hidden" name="mode" value="delete">
<input type="hidden" name="page" value="<?=$page?>">
			<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="dadada" align="center" style="text-align:center" >
              <col style="width:5%">
              <col style="width:12%">
              <col style="width:12%">
              <col style="width:auto">
              <col style="width:8%">
              <col style="width:8%">
              <col style="width:8%">
              <col style="width:8%">
              <tr align="center" height="30"> 
                <td width="5%" bgcolor="#f6f6f6"><input type="checkbox" name="allcheck" id="allcheck" onclick="all_check()" /></td>
                <td bgcolor="#f6f6f6">No</td>
                <td bgcolor="#f6f6f6">Pic</td>
                <td bgcolor="#f6f6f6">제 목</td>
                <td bgcolor="#f6f6f6">적 용</td>
                <td bgcolor="#f6f6f6">스크롤</td>
                <td bgcolor="#f6f6f6">하루적용</td>
                <td bgcolor="#f6f6f6">창닫기</td>
              </tr>
              <?
			  while (${$dataname}=mysql_fetch_array(${"result_".$dataname})){
			//		$size=getimagesize($_SERVER['DOCUMENT_ROOT']."/data/".$bu[pop_image1]);
			//		echo $size[0];
			  ?>
              <tr height="30" bgcolor="<?=$bgCol?>" style="cursor: hand; padding:3 0 0 0;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''" > 
                <td align="center" bgcolor="#FFFFFF"><input type="checkbox" name="check[]" value="<?=$bu[pop_no]?>"/></td>
                <td bgcolor="#FFFFFF" onclick="location.href='./popsetup.php?program=popsetup&action=popsetup&eno=<?=$bu[pop_no]?>'">
                  <?=$article_num--;?>                </td>
                <td bgcolor="#FFFFFF" onclick="location.href='./popsetup.php?program=popsetup&action=popsetup&eno=<?=$bu[pop_no]?>'"><img src="/images/popup/<?=$bu[pop_image1]?>" width=80></td>
                <td align=left bgcolor="#FFFFFF" onclick="location.href='./popsetup.php?program=popsetup&action=popsetup&eno=<?=$bu[pop_no]?>'">
                  <?=$bu[pop_subject]?>                </td>
                <td bgcolor="#FFFFFF" onclick="location.href='./popsetup.php?program=popsetup&action=popsetup&eno=<?=$bu[pop_no]?>'">
                  <?=textout($bu[pop_app])?>                </td>
                <td bgcolor="#FFFFFF" onclick="location.href='./popsetup.php?program=popsetup&action=popsetup&eno=<?=$bu[pop_no]?>'">
                  <?=textout($bu[pop_scroll])?>                </td>
                <td bgcolor="#FFFFFF" onclick="location.href='./popsetup.php?program=popsetup&action=popsetup&eno=<?=$bu[pop_no]?>'">
                  <?=textout($bu[pop_oneday])?>                </td>
                <td bgcolor="#FFFFFF" onclick="location.href='./popsetup.php?program=popsetup&action=popsetup&eno=<?=$bu[pop_no]?>'">
                  <?=textout($bu[pop_close])?>                </td>
              </tr>
              <?}?>
            </table>
</form>
			</td>
        </tr>
        <tr>
          <td height="50"><span style="padding-bottom:5px">
            <input type="button" value="선택삭제" class="button44" onclick="javascript:delete_member()" style="cursor:pointer; background-color:#FFFFFF; border:1px #636563 solid; padding:5 3 3 3; font-weight:bold" />
          </span></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
<br>
<CENTER><?list_number();?></CENTER>

<?
//foot();

function textout($str){
	if ($str) $ret="○";
	else $ret="Ｘ";
	return $ret;
}
?>
<? include_once "../inc/footer.php";?>

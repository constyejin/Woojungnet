
<script language="javascript">
	
	function CommentDel(i, j){
		if(confirm("해당 코멘트를 삭제 하시겠습니까?")){
			location.href = "/manage/inc/commentdel.php?wc_idx="+i+"&wcc_idx="+j;
		}
	}

</script>

<table width="900" border="0" cellspacing="0" cellpadding="0" style="word-break:break-all">
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
<form name="frmingMemo" method="post" action="/manage/inc/comment_exe.php" target="HiddenFrm">
<input type="hidden" name="wc_idx" value="<?=$wc_idx?>">
<input type="hidden" name="page" value="<?=$PHP_SELF?>">
  <tr> 
    <td height="20" align="left"  class="title"><img src="/manage/img/icon_1.jpg" class="bullet">  
      <strong>진행메모장</strong>(접수차량의 진행상태를 남기세요. 관리자만 볼수 있습니다.)</td>
  </tr>
  <tr> 
    <td>
	
	  <table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" class="table-style">
      <colgroup>
        <col style="width:120px">
        <col style="width:auto">
      </colgroup>
      <tr> 
        <td bgcolor="f6f6f6" class="table-th">메 모 </td>
        <td align="left" valign="middle" bgcolor="#FFFFFF" style=" padding-left:10px;" >
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="92%"><textarea name="caringMemo" cols="3" style="width:97%;border:1px solid #008ad9;" align="absmiddle"></textarea></td>
            <td width="8%"><input type="submit" value="등록" class="button44 btn-red" /></td>
          </tr>
        </table></td>
      </tr>

<?
if($wc_idx){

	$ccSQL = "Select wcc_idx, wc_idx, wcc_memo, wcc_regdate, wcc_username  From woojung_car_comment Where wc_idx='$wc_idx' order by wcc_idx desc";
	$ccRow = Fetch_string($ccSQL);
	
		for($i=0;$i<count($ccRow);$i++){

			if($ccRow[$i][wcc_regdate]){
?>
        <tr> 
          <td class="table-th" bgcolor="f6f6f6"><?=substr($ccRow[$i][wcc_regdate],0,16)?></td>
          <td align="left" bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$ccRow[$i][wcc_username]?> | <?=$ccRow[$i][wcc_memo]?> <a href="javascript:CommentDel(<?=$ccRow[$i][wc_idx]?>, <?=$ccRow[$i][wcc_idx]?>)">[삭제]</a></td>
        </tr>
<?
			}
		}
}?>

      </table>
	  
	  
	  </td>
  </tr>
  </form>
</table>

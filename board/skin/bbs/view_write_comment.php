<style>
	.bbutton{
		background-color:#0066CC;
		color: #ffffff; 
	}
</style>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<?if($data["a_comment_level"] && $_SESSION["login_id"]){ ?>
<form name='commentForm' method='post' action="comment_ok.php">
<!-- 삭제하면 안되요.. -->
<input type="hidden" name="no" value='<?=$no?>'>
<input type="hidden" name="id" value='<?=$id?>'>
<input type="hidden" name="comm_mode" value='write'>
<input type="hidden" name="comment_name" value='<?=$_SESSION["login_name"]?>'>
  <tr>
	<td colspan="3">&nbsp;</td>
  </tr>
  <tr>
	<td colspan="3">
<table  width="98%"  border="0"  cellspacing="0" cellpadding="4" class="viewtable">
	<tr onclick="document.write.c_content.rows=document.write.c_content.rows+2" style="cursor:hand">
	  <td colspan="3" class="topline" height="30px"><img src="../board/img/ico_down.gif" /> 간단한 댓글을 남기세요 / 로그인 후에 글쓰기권한이 주어집니다.</td>
	</tr>
	<tr>
	  <td width="14%" style="text-align:center" bgcolor="#EFEFEF"><?=$_SESSION["login_name"]?></td>
	  <td width="78%"><textarea name="comment_memo" cols="20" rows="3" style="width:97%; height:55px;" class='input'></textarea></td>
	  <td width="8%" align="right"><input type="submit" value="등록" class="bbutton" style="width: 100%;"/></td>
	</tr>
</table>
<!--		<table width="711" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td style="padding:0 0 10 10"><img src="../board/skin/bbs/img/btn_down.gif" style="vertical-align:middle"> &nbsp;간단한 코멘트를 남기세요. / 타인의 비방글은 이유없이 삭제됩니다.</td>
		</tr>
		<tr>
		  <td style="border:1px solid #dcdcdc">
		  <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#EFEFEF">
			  <tr>
				<td width="100" align="center" style='color:#7c6b56'><strong>미리내홈쇼핑</strong></td>
				<td><textarea name="comment_memo" cols="20" rows="3" style="font-family:굴림체; font-style:normal; font-size:9pt; padding:3px; width:100%; border:1px solid ##d3c6b8"></textarea></td>
				<td width="100" height=40><input type="submit" style="height:100%;cursor:hand;width:100%;border:solid 1;background-color:#FFF8F4" value="등 록"></td>
			  </tr>
			</table>
			</td>
		</tr>
	  </table> -->
	 </td>
  </tr>
  <tr>
	<td colspan="3">&nbsp;</td>
  </tr>
  </form>
<?}?>
<table  width="100%"  border="0"  cellspacing="0" cellpadding="4" class="viewtable" style="margin-top:-15px;">
<?
$comment_sql="select * from ".$id."_comments where board_idx='".$no."' order by c_idx desc";
$comment_que=mysql_query($comment_sql);
while($comment=mysql_fetch_array($comment_que)){
?>
	<tr>
	  <td width="14%" align="center"><?=$comment[name]?></td>
	  <td width="86%" height="30"><?=nl2br($comment["content"])?>  [<?=date("Y-m-d",$comment["date"])?>] 
		<?if($comment[id]==$_SESSION["login_id"] || $_SESSION["login_level"]=="1"){ ?>
	  <a href="./comment_ok.php?no=<?=$no?>&id=<?=$id?>&comm_mode=delete&c_idx=<?=$comment["c_idx"]?>"><img src="../board/img/ico_close.gif"  /></a>
		<?} else { echo "&nbsp;"; }?>	  </td>
  </tr>
<!--  <tr>
	<td height="28" colspan="2" style="padding-top:5px">&nbsp;&nbsp;<strong><font color='#5e7ea2'><?=$comment["name"]?></font></strong> <?=date("Y-m-d",$comment["date"])?></td>
	<td width="8%" height="28" align="right" style="cursor:pointer;padding-top:5px; color:#FF0000; font-size:11px; padding-right:10px">
		<?if($comment[id]==$_SESSION["login_id"]){ ?>
		<a href="./comment_ok.php?no=<?=$no?>&id=<?=$id?>&comm_mode=delete&c_idx=<?=$comment["c_idx"]?>"><font color="red">[삭제]</font></a>
		<?} else { echo "&nbsp;"; }?>
	</td>
  </tr>
  <tr>
	<td height="28" colspan="3" style="color:#555555">&nbsp;&nbsp;<?=nl2br($comment["content"])?></td>
  </tr>
  <tr align="center">
	<td height="1" colspan="3" bgcolor="#d3c6b8"></td>
  </tr> -->
<?}?>

</table>
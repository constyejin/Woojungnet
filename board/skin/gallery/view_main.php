<script type="text/Javascript"> 
<!-- 
/* 이미지 크기에 맞게 새창 열기*/ 
var imgObj = new Image(); 
function showImgWin(imgName) { 
  imgObj.src = imgName; 
  setTimeout("createImgWin(imgObj)", 100); 
} 
function createImgWin(imgObj) { 
  if (! imgObj.complete) { 
    setTimeout("createImgWin(imgObj)", 100); 
    return; 
  } 
  imgwin = window.open("", "imageWin","width=" + imgObj.width + ",height=" + imgObj.height + ",scrollbars=yes"); 
  imgwin.document.write("<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>"); 
  imgwin.document.write("<html><head><meta http-equiv='Content-Type' content='text/html; charset=euc-kr' />"); // ? utf-8? 
  imgwin.document.write("<title>큰이미지</title>");  // 새창 페이지 제목 
  imgwin.document.write("</head><body style='margin:0px;padding:0px'>"); 
  imgwin.document.write("<img src='" + imgObj.src + "' style='cursor:pointer; border: 1px solid #DDDDDD;' onclick='self.close();' alt='이미지를 클릭하시면 창이 닫힙니다.' />"); 
  imgwin.document.write("</body><html>"); 
  imgwin.document.title = imgObj.src; 
} 
//--> 
</script>
<style type="text/css">
.viewtable { border-collapse:collapse; margin-top:30px; }
.viewtable th {background-color:#d8c8b3;}
.viewtable th.topline, .viewtable td.topline {border-top:2px solid #362e2b;}
.viewtable th,.viewtable td {border-bottom:1px solid #655a4a;}
.viewtable td p{line-height:18px; padding:5px 0;}
input.bbutton {border:1px solid #877c6b; text-align:center; background-color:#a7866b; width:60px; height:65px;
					color:#ffffff; padding:0px; cursor:hand;}
.bbsbg{background-color:#e6d8c6;border:1px solid #877c6b; }
</style>

<?
if(basename(__FILE__)==basename($_SERVER["PHP_SELF"])) die(__FILE__." ....");

mysql_query("update $id set ref=ref+1 where no='".$no."'");

$p_qry = "  select * from $id where no='$no' ";
$p_res = mysql_query($p_qry) or die(mysql_error());
$view = mysql_fetch_array($p_res);

if($_SESSION[login_level]=="1"){
	$modify_a="<a href='".$_SERVER['PHP_SELF']."?mode=write&sub_mode=edit&id=".$id."&no=".$no."'>";
	$delete_a="<a href='delete_ok.php?mode=delete&id=".$id."&no=".$no."' onclick='return confirm('정말 삭제하시겠습니까?')'>";
}

$tmp_file_num=explode(",",$view['files']);
$tmp_org_name=explode(",",$view[nfiles]);
for ($i=0;$i<sizeof($tmp_file_num);$i++){
	if ($tmp_file_num[$i]!="")
	{ 
		//gif,jpg 그림파일체크 
		$tmp_img=explode(".",$tmp_file_num[$i]);
		if (($tmp_img[1]=="jpg")||($tmp_img[1]=="gif")||($tmp_img[1]=="bmp")) {
			$img_files[]=$tmp_file_num[$i];
		} else {
			$files.="<img src=\"/img/icon/disk.gif\" style=\"vertical-align:middle\"> <strong>첨부파일 : </strong><a href=\"download.php?no=$view[no]&num=$i&db=$id\">  <font color=darkred>".$tmp_org_name[$i]."</font></a>&nbsp;<br>"; $chk_blank++;
		}
	}
}
if ($img_files) {
	for ($i=0;$i<sizeof($img_files);$i++){
	  $size=GetImageSize($_SERVER[DOCUMENT_ROOT]."/board/data/$id/$img_files[$i]");
	  if ($size[0] > 640 ) {
	  $img_width = 640; // 본문에 표시될 이미지 가로 크기 조정 (단위:픽셀)
	  $img_height=$size[1]*$img_width/$size[0];
	  } else  {
		  $img_width=$size[0];
		  $img_height=$size[1];
	  }
	$view_e.="<center><a href=\"javascript:showImgWin('/board/data/$id/$img_files[$i]')\"><img src=\"/board/data/$id/$img_files[$i]\" width='$img_width' height='$img_height' galleryimg=no></a></center><br>";
	}
}
$view_e.=$view[memo];
?>




<style type="text/css">
.th_txt{align:center; font-weight:bold; color:#758ea3; background:#ebf4fb; text-align:center; height:28px;}
.mg20{margin:20px 0;}
.bg_f{background-color:#ffffff;}
</style>	


          <table  width="98%"  border="0"  cellspacing="0" cellpadding="4" class="viewtable">
			  <tr>
				<th width="13%" class="topline"><b>제목</b></th>
				<td width="22%" class="topline" colspan="5" ><?=$view[subject]?></td>
			  </tr>			 
			  <tr>
				<th align="center"><b>이름</b></th>
				<td ><?=$view[name]?></td>
				<th width="13%" align="center"><b>등록일</b></th>
				<td width="22%" ><?=date("Y-m-d",$view["date"])?></td>
				<th width="13%" align="center"><b>조회</b></th>
				<td width="7%"  ><?=$view[ref]?></td>
			  </tr>			  

			  <tr>
				<td height="300" colspan="6" valign="top"  >
               <br />
		<?=$files?>
		<?=nl2br($view_e)?>
			   </td>
			  </tr>
		  </table>

<br />			
<center>
<!--<input type="image" src="../board/img/btn/btn_answer.gif" class="imgbt1" onclick="javascript:location.href='comment.php';" /> -->

		<?if($modify_a){?>
			<?=$modify_a?><img src="../board/img/btn/btn_edit.gif" class="imgbt1"onclick="javascript:location.href='edit.php';" /></a> 
		<?}?>
		<?if($delete_a){?>
			<a href='delete_ok.php?mode=delete&id=<?=$id?>&no=<?=$no?>' onclick='return confirm("정말 삭제하시겠습니까?")'><img src="../board/img/btn/btn_delete.gif" class="imgbt1"onClick="" /></a> 
		<?}?>
<input type="image" src="../board/img/btn/btn_list.gif" class="imgbt1"onClick="location.href='<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>'" />

</center>
<br />



<?
if($no){
	$prev=mysql_fetch_array(mysql_query("select * from $id where no<'".$no."' order by no desc limit 1"));
	$next=mysql_fetch_array(mysql_query("select * from $id where no>'".$no."' order by no asc limit 1"));
}
?>


<table  width="98%"  border="0"  cellspacing="0" cellpadding="4" class="viewtable">
	<tr>
	  <th width="14%" class="topline">이전글</th>
	  <td class="topline"><?if($prev[0]){ ?><a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>&mode=view&no=<?=$prev[0]?>&passed="><?=$prev[subject]?></a><? } ?></td>
	</tr>
	<tr>
	  <th>다음글</th>
	  <td><?if($next[0]){ ?><a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>&mode=view&no=<?=$next[0]?>&passed="><?=$next[subject]?></a><? } ?></td>
	</tr>
</table>



			    <!-- 본문끝 -->


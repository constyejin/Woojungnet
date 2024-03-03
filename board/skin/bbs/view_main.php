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
<?
if(basename(__FILE__)==basename($_SERVER["PHP_SELF"])) die(__FILE__." ....");

mysql_query("update $id set ref=ref+1 where no='".$no."'");

$p_qry = "  select * from $id where no='$no' ";
$p_res = mysql_query($p_qry) or die(mysql_error());
$view = mysql_fetch_array($p_res);

$mem_qry = "  select * from woojung_member where idx='$view[midx]' ";
$mem_re = mysql_query($mem_qry) or die(mysql_error());
$mem_info = mysql_fetch_array($mem_re);

if($cookie_user_no==$view["midx"]){
	$modify_a="<a href='".$_SERVER['PHP_SELF']."?mode=write&sub_mode=edit&id=".$id."&no=".$no."'>";
	$delete_a="<a href='delete_ok.php?mode=delete&id=".$id."&no=".$no."'>";
} else {
	if($view["userno"]=="GUEST"){
//		$modify_a="<a href='".$_SERVER['PHP_SELF']."?mode=pwchk&id=".$id."&no=".$no."'>";
		$modify_a="<a href='".$_SERVER['PHP_SELF']."?mode=write&sub_mode=edit&id=".$id."&no=".$no."'>";
		$delete_a="<a href='delete_ok.php?mode=delete&id=".$id."&no=".$no."'>";
	} else {
//		$modify_a="<a href='#' onclick=\"javascript:alert('다른 회원의글은 수정하실수 없습니다');\">";
		$modify_a="";
		$delete_a="";
	}
}
if($_SESSION[login_level]<=3){
	$modify_a="<a href='".$_SERVER['PHP_SELF']."?mode=write&sub_mode=edit&id=".$id."&no=".$no."'>";
	$delete_a="<a href='delete_ok.php?mode=delete&id=".$id."&no=".$no."'>";
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
			$files.="<strong>첨부파일 : </strong><a href=\"download.php?no=$view[no]&num=$i&db=$id\">  <font color=darkred>".$tmp_org_name[$i]."</font></a>&nbsp;<br>"; $chk_blank++;
		}
	}
}
if ($img_files) {
	for ($i=0;$i<sizeof($img_files);$i++){
	  $size=GetImageSize($_SERVER[DOCUMENT_ROOT]."/board/data/$id/$img_files[$i]");
	  if ($size[0] > 1100 ) {
	  $img_width = 1100; // 본문에 표시될 이미지 가로 크기 조정 (단위:픽셀)
	  $img_height=$size[1]*$img_width/$size[0];
	  } else  {
		  $img_width=$size[0];
		  $img_height=$size[1];
	  }
	$view_e.="<center><a href=\"javascript:showImgWin('/board/data/$id/$img_files[$i]')\"><img src=\"/board/data/$id/$img_files[$i]\" width='$img_width' height='$img_height' galleryimg=no><a/></center><br>";
	}
}
$view_e.=$view[memo];
?>
<style type="text/css">
.viewtable { border-collapse:collapse; margin-top:30px; }
.viewtable th {background-color:#EFEFEF; height:50px; vertical-align:central;}
.viewtable th.topline, .viewtable td.topline {border-top:2px solid #000000;vertical-align:central;font-size:13px;}
.viewtable th,.viewtable td {border-bottom:1px solid #D8D8D8;font-size:13px;}
.viewtable td {text-align:left; padding-left:7px; vertical-align:central;font-size:13px;}
.viewtable td p{line-height:18px; padding:5px 0;}
input.bbutton {border:1px solid #D8D8D8; text-align:center; background-color:#0066CC; width:60px; height:65px;
					color:#ffffff; padding:0px; }
.bbsbg{background-color:#D8D8D8;border:1px solid #EFEFEF; }
.wid { min-height:300px;}
</style>
<style type="text/css">
.th_txt{align:center; font-weight:bold; color:#758ea3; background:#ebf4fb; text-align:center; height:28px;}
.mg20{margin:20px 0;}
.bg_f{background-color:#ffffff;}
.button-wrap{ display: flex; justify-content:center;}
.button-wrap .center > a{ margin: 0 5px;}
.btn-blue{
	display:inline-flex; justify-content: center; align-items:center;border: 2px solid #0066CC; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color:#0066CC;"
}
.btn-red{
	display: inline-flex;justify-content: center;align-items: center;border: 2px solid #cc3535;border-radius: 20px;min-width: 80px;height: 32px;font-size: 12px;font-weight: 600;color: #cc3535;
}
.btn-black{
	display:inline-flex; justify-content: center; align-items:center;border: 2px solid #000000; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color:#000000; 
}
</style>	



          <table  width="98%"  border="0"  cellspacing="0" cellpadding="4" class="viewtable">
			  <tr>
				<th width="13%" class="topline"><b>제목</b></th>
				<td width="22%" class="topline" colspan="5" ><strong style="font-size:15px;"><?=$view[subject]?></strong></td>
			  </tr>			 
			  <tr>
				<th align="center"><b>이름</b></th>
				<td ><?=$mem_info[userNick]?></td>
				<th width="13%" align="center"><b>등록일</b></th>
				<td width="22%" ><?=date("Y-m-d",$view["date"])?></td>
				<th width="13%" align="center"><b>조회</b></th>
				<td width="7%"  ><?=$view[ref]?></td>
			  </tr>			  

			  <tr>
				<td height="300" colspan="6" valign="top" class="wid">
               <br />
		<?=$files?>
		<?=nl2br($view_e)?>
			   </td>
			  </tr>
		  </table>
<br />

<div class="button-wrap">
		<div class="center">

			<?if($_SESSION[login_level]<4){?>
			<a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>&mode=write&sub_mode=answer&no=<?=$no?>">
				<!--<img src="../board/img/btn/btn_answer.gif" class="imgbt1" />-->
				<span class="btn-blue">답글쓰기</span>
			</a>
			<? } ?>
			<?if($modify_a){?>
				<?=$modify_a?>
				<!--<img src="../board/img/btn/btn_edit.gif" class="imgbt1"onclick="javascript:location.href='edit.php';" />-->
				<span onclick="javascript:location.href='edit.php';" class="btn-red">수정하기</span>
			</a> 
			<?}?>
			<?if($delete_a){?>
				<!--<a href='delete_ok.php?mode=delete&id=<?=$id?>&no=<?=$no?>' onclick='return confirm("정말 삭제하시겠습니까?")'><img src="../board/img/btn/btn_delete.gif" class="imgbt1"onClick="" /></a>-->
				<a href='delete_ok.php?mode=delete&id=<?=$id?>&no=<?=$no?>' onclick='return confirm("정말 삭제하시겠습니까?")' class="btn-black">
				삭제하기
				</a>
			<?}?>
			<!--<input type="image" src="../board/img/btn/btn_list.gif" class="imgbt1"onClick="location.href='<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>'" />-->
			<a onClick="location.href='<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>'" href="javascript:void(0)" class="btn-blue">
			목록보기
			</a>
		</div>
</div>
<br />

<?
	if($data[a_comment_level]){
		include_once "$_SERVER[DOCUMENT_ROOT]/board/skin/".$data[a_skinname]."/view_write_comment.php";
	}
?>


<!-- 내용 -->
<?
if($no){
	$prev=mysql_fetch_array(mysql_query("select * from $id where bdiv='0' and no<'".$no."' order by no desc limit 1"));
	$next=mysql_fetch_array(mysql_query("select * from $id where bdiv='0' and no>'".$no."' order by no asc limit 1"));
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

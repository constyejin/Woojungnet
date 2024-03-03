<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";

if($no){
	mysql_query("update $id set ref=ref+1 where no='".$no."'");

	$p_qry = "  select * from $id where no='$no' ";
	$p_res = mysql_query($p_qry) or die(mysql_error());
	$view = mysql_fetch_array($p_res);

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
		  if ($size[0] > 690 ) {
		  $img_width = 690; // 본문에 표시될 이미지 가로 크기 조정 (단위:픽셀)
		  $img_height=$size[1]*$img_width/$size[0];
		  } else  {
			  $img_width=$size[0];
			  $img_height=$size[1];
		  }
		$view_e.="<center><a href=\"javascript:showImgWin('/board/data/$id/$img_files[$i]')\"><img src=\"/board/data/$id/$img_files[$i]\" width='$img_width' height='$img_height' galleryimg=no><a/></center><br>";
		}
	}
	$view_e.=$view[memo];
}else{
	exit;
}
?>
  <div class="add-car">
    <section class="title-wrap">
      <h2>고객센터</h2>
    </section>
    <section class="tab-wrap wide-type">
      <ul>
        <li class="tab<?=$id=="notice"?' active':''?>">
          <a href="/board/board.php?id=notice">공지사항</a>
        </li>
        <li class="tab<?=$id=="qna"?' active':''?>">
          <a href="/board/board.php?id=qna">질문과답변</a>
        </li>
        <li class="tab<?=$id=="data"?' active':''?>">
          <a href="/board/board.php?id=data">자료실</a>
        </li>
        <li class="tab">
          <a href="/sub01/sub01_3.php?id=">1:1상담</a>
        </li>
      </ul>
    </section>
    <section class="board-notice">
      <div class="board-notice-view">
        <div class="header">
          <div class="title"><?=$view[subject]?></div>
          <div class="content-info">
            <span class="name"><?=$view[name]?></span>
            <span class="date"><?=date("Y-m-d",$view["date"])?></span>
            <span class="read">조회 <?=$view[ref]?></span>
          </div>
        </div>

        <div class="content-view">
		<?=$files?>
		<?=nl2br($view_e)?>
        </div>

        <div class="btn-group align-c">
          <div class="center">
		  <? if($cookie_user_no==$view["midx"]||$_SESSION[login_level]<=3){ ?>
            <button type="button" class="btn btn-outline-red btn-sm btn-round" onclick="board_write.php?id=<?=$id?>&no=<?=$no?>">수정하기</button>
			<? } ?>
            <a href="javascript:history.back();" class="btn btn-outline-primary btn-sm btn-round">목록보기</a>
          </div>
        </div>
<?
if($no){
	$prev=mysql_fetch_array(mysql_query("select * from $id where bdiv='0' and no<'".$no."' order by no desc limit 1"));
	$next=mysql_fetch_array(mysql_query("select * from $id where bdiv='0' and no>'".$no."' order by no asc limit 1"));
}
?>

        <div class="table-style preview-list">
          <ul>
            <li>
              <div class="th">이전글</div>
              <div class="td">
                <p class="title">
                  <?if($prev[0]){ ?><a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>&mode=view&no=<?=$prev[0]?>&passed="><?=$prev[subject]?></a><? } ?>
                </p>
              </div>
            </li>
            <li>
              <div class="th">다음글</div>
              <div class="td">
                <p class="title">
                  <?if($next[0]){ ?><a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>&mode=view&no=<?=$next[0]?>&passed="><?=$next[subject]?></a><? } ?>
                </p>
              </div>
            </li>
          </ul>
        </div>

        
      </div>
    </section>
  </div>

  
<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>
</html>
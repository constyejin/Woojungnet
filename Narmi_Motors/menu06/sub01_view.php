<?
include "../inc/header.php";
include "../inc/menu_sub.php";

if(!$id) $id="notice";
$web_table=sql_fetch("select * from web_table where table_id='$id' order by idx desc ");

if($web_table[table_view]>$_SESSION[login_level]){
	alert("권한이 없습니다.","/");
	exit;
}

$image_sub=sql_fetch("select * from image_sub where sub_type='sub' and sub_menu='고객센터' order by idx desc ");
$query="update board set board_hits=board_hits+1 where idx=$idx ";
mysql_query($query);
$board_view=sql_fetch("select * from board where idx='$idx' ");
$board_view_pre=sql_fetch("select * from board where idx<$idx order by idx desc ");
$board_view_next=sql_fetch("select * from board where idx>$idx order by idx asc ");
if($board_view[board_file1]){
	$board_file1=explode("||",$board_view[board_file1]);
	for($i=0;$i<count($board_file1);$i++){
		$bf=explode(".",$board_file1[$i]);
		$ext=$bf[count($bf)-1];
		if(strtolower($ext)=="jpg"||strtolower($ext)=="png"||strtolower($ext)=="gif"||strtolower($ext)=="jpeg"){
			$memo_img.='<br><img src="/images/board/'.$board_file1[$i].'">';
		}else{
			$memo_down.='<span class="label">다운로드 : </span><a href="sub01_down.php?files='.$board_file1[$i].'" class="link">'.$board_file1[$i].'</a><br>';
		}
	}
}
?>
  <div class="sub-visual">
    <!-- 서브비주얼 -->
    <img src="/images/img/<?=$image_sub[sub_file]?>" alt="">
    <!-- <div class="title">
      <p class="catch-phrase">대한민국의 운송장비의 성공신화 !!</p>
      <p class="sub-text">화물차! 특장차! 캠핑카! 책임있고 오랜경험을 고객님들과 함께 합니다. </p>
      <p class="third-text">TEL  1588-1277  , FAX  02-794-3300</p>
    </div> -->
  </div>
  <div class="content-wrap sub">
    <div class="anchor-wrap">
      <a href="#" class="anchor"></a>
    </div>
    <section class="notice-list">
      <div class="container">
        <div class="notice-detail-header">
          <div class="label">제목</div>
          <div class="dd title"><?=$board_view[board_title]?></div>
          <div class="label">이름</div>
          <div class="dd name"><?=$board_view[board_name]?></div>
          <div class="label">등록일</div>
          <div class="dd name"><?=substr($board_view[regdate],0,10)?></div>
          <div class="label">조회</div>
          <div class="dd name"><?=$board_view[board_hits]?></div>
        </div>

        <div class="notice-detail-body">
          <p class="download">
		  <?=$memo_down?>
          </p>
		  <?=$memo_img?>
          <?=$board_view[board_memo]?>
        </div>

        <div class="notice-detail-footer">
          <div class="btn-wrap">
		  <? if($web_table[table_write]<=$_SESSION[login_level]){ ?>
            <a href="sub01_write.php?idx=<?=$idx?>" class="btn btn-outline-red btn-round sm">수정하기</a>
		  <? } ?>
            <a href="sub01.php?id=<?=$id?>" class="btn btn-outline-secondary btn-round sm">목록보기</a>
          </div>
        </div>

        <div class="notice-detail-nav">
          <div class="label">이전글</div>
          <div class="dd title"><a href="sub01_view.php?idx=<?=$board_view_pre[idx]?>"><?=$board_view_pre[board_title]?></a></div>
          <div class="label">다음글</div>
          <div class="dd title"><a href="sub01_view.php?idx=<?=$board_view_next[idx]?>"><?=$board_view_next[board_title]?></a></div>
        </div>
      </div>
    </section>
  </div>
<?
include "../inc/consult_form.php";
include "../inc/footer.php";
?>

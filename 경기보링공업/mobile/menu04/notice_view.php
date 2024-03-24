<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<?
if(!$id) $id="notice";
$web_table=sql_fetch("select * from web_table where table_id='$id' order by idx desc ");

if($web_table[table_view]<$_SESSION[login_level]){
	alert("권한이 없습니다.","/");
	exit;
}

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

<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/menu04/style/notice_narmi.css">

<main class="notice">
  <section>
    <h2 class="sub-title">공지사항</h2>

    <div class="content-wrap sub">
      <div class="anchor-wrap">
        <a href="#" class="anchor"></a>
      </div>
      <section class="notice-list">
        <div class="container">
          <div class="notice-view-top sm-only">
            <p class="menu-path"><a href="/">홈</a> > 공지사항</p>
            <p class="top-list-btn">
              <a href="/menu04/notice_list.php">목록보기 LIST</a>
            </p>
          </div>

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
            <p class="download"><?=$memo_down?></p>
		  <?=$memo_img?>
          <?=$board_view[board_memo]?>
          </div>

          <div class="post-btn-box lg-only">
            <button class="post-btn show-list-btn">
              <a href="/menu04/notice_list.php">목록보기</a>
            </button>
		  <? if($web_table[table_write]>=$_SESSION[login_level]&&$_SESSION[login_level]){ ?>
            <button class="post-btn register-btn">
              <a href="/menu04/notice_write.php?idx=<?=$idx?>">수정하기</a>
            </button>
		  <? } ?>
          </div>

          <div class="notice-detail-nav">
            <div class="label">이전글</div>
            <div class="dd title"><a href="sub01_view.php?idx="></a></div>
            <div class="label">다음글</div>
            <div class="dd title"><a href="sub01_view.php?idx="></a></div>
          </div>
        </div>
      </section>
   </div>

  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

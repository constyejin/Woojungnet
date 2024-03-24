<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<?
if(!$id) $id="notice";
$web_table=sql_fetch("select * from web_table where table_id='$id' order by idx desc ");

$page_row=$web_table[table_list];
$page_scale=10;
if(!$page) $page=1;
$page_start=($page-1)*$page_row;

if($s_text) $where .= " and (board_name like '%$s_text%' or board_title like '%$s_text%') ";
$image_sub=sql_fetch("select * from image_sub where sub_type='sub' and sub_menu='고객센터' order by idx desc ");
$board_list=sql_list("select * from board where board_id='$id' $where order by board_notice desc, idx desc limit  $page_start, $page_row");
$total_count=sql_total("select count(*) as cnt from board where board_id='$id' $where ");
$list_num=$total_count-$page_start;
?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/menu04/style/notice.css">

<main class="notice">
  <section>
    <p class="menu-path sm-only"><a href="/">홈</a> > 공지사항</p>
    <h2 class="sub-title">공지사항</h2>
    
<form name="sform" method="get" enctype="multipart/form-data" action="notice_list.php">
      <div class="search-box lg-only">
        <input type="text" name="s_text" value="<?=$s_text?>">
        <i class="fa-solid fa-magnifying-glass"></i>
      </div>
</form>

<form name="lform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="/manage/inc/alldel.php">
<input type="hidden" name="db_name" value="board">
      <div class="post-wrap">
        <ul class="post-main-list lg-only">
  <? if($_SESSION[login_level]>="10"&&$_SESSION[login_level]<="40"){ ?>
          <li class="post-chk"><input type="checkbox" id="all-check"></li>
  <? } ?>
          <li class="post-num">번호</li>
          <li class="post-title">제목</li>
          <li class="post-name">이름</li>
          <li class="post-date">등록일</li>
          <li class="post-see">조회</li>
        </ul>

<? 
for($i=0;$i<count($board_list);$i++){
	if($board_list[$i][board_notice]=="Y"){
		$not='<span class="emphas">공지</span>';
		$list_num--;
	}else{
		$not=$list_num--;
	}
	if($board_list[$i][board_file1]){
		$fil='<span class="icon-file"></span>';
	}else{
		$fil="";
	}
?>
        <ul class="post-item lg-only">
  <? if($_SESSION[login_level]>="10"&&$_SESSION[login_level]<="40"){ ?>
          <li class="post-chk"><input type="checkbox" id="check<?=$i?>" name="checkidx[]" value="<?=$board_list[$i][idx]?>"></li>
  <? } ?>
          <li class="post-num"><?=$not?></li>
          <li class="post-title"><a class="post-link" href="notice_view.php?idx=<?=$board_list[$i][idx]?>"><?=$board_list[$i][board_title]?></a></li>
          <li class="post-name"><?=$board_list[$i][board_name]?></li>
          <li class="post-date"><?=substr($board_list[$i][regdate],0,10)?></li>
          <li class="post-see"><?=number_zero($board_list[$i][board_hits])?></li>
        </ul>

        <div class="sm-only">
          <div class="post-item">
            <p class="post-title">
              <a class="post-link" href="notice_view.php?idx=<?=$board_list[$i][idx]?>"><?=$board_list[$i][board_title]?>
              </a>
            </p>
            <div>
              <p class="post-num"><?=$not?></p>
              <p><?=$board_list[$i][board_name]?></p>
              <p class="post-date"><?=substr($board_list[$i][regdate],0,10)?></p>
              <p class="post-see">조회<span><?=number_zero($board_list[$i][board_hits])?></span>회</p>
            </div>
          </div>
        </div>
<? } ?>
      </div>

      <div class="pagenation">
        <!--div class="pagenation-icons prev">
          <a href=""></a>
          <a href=""></a>
        </div>

        <ol class="pagenation-list">
          <li class="active"><a href="">1</a></li>
        </ol>

        <div class="pagenation-icons next">
          <a href=""></a>
          <a href=""></a>
        </div-->
<? echo paging_f($page, $page_row, $page_scale, $total_count, $ext); ?>               
      </div>

      <div class="post-btn-list lg-only">
  <? if($_SESSION[login_level]>="10"&&$_SESSION[login_level]<="40"){ ?>
        <button class="post-btn select-del-btn" type="button" onclick="all_del();">
          선택삭제
        </button>
        <button class="post-btn register-btn" type="button">
            <a href="/menu04/notice_write.php">글쓰기</a>
        </button>
  <? } ?>
      </div>
    </form>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

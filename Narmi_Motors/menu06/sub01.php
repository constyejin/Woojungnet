<?
include "../inc/header.php";
include "../inc/menu_sub.php";

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
  <div class="sub-visual">
    <!-- 서브비주얼 -->
    <img src="/images/img/<?=$image_sub[sub_file]?>" alt="">
    <!-- <div class="title">
      <p class="catch-phrase">대한민국의 운송장비의 성공신화 !!</p>
      <p class="sub-text">화물차! 특장차! 캠핑카! 책임있고 오랜경험을 고객님들과 함께 합니다. </p>
      <p class="third-text">TEL  1588-1277  , FAX  02-794-3300</p>
    </div> -->
  </div>
  <div class="content-wrap sub notice-list">
    <div class="anchor-wrap">
      <a href="#" class="anchor"></a>
    </div>
    <section class="notice">
      <div class="container">
        <p class="h2">
          <?=$web_table[table_title]?>
        </p>

        <div class="search-box">
          <div class="select-wrap">
            <!--select name="" id="">
              <option value="">제목</option>
              <option value="">작성일</option>
              <option value="">작성자</option>
            </select-->
          </div>
<form name="sform" method="get" enctype="multipart/form-data" action="sub01.php">
          <div class="input-wrap has-btn">
            <input type="text" name="s_text" value="<?=$s_text?>">
            <a href="" class="btn-search"></a>
          </div>
</form>
        </div>
  
        <div class="table">
<form name="lform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="/manage/inc/alldel.php">
<input type="hidden" name="db_name" value="board">
          <table>
            <colroup>
            <? if($_SESSION[login_level]=="3"){ ?>
              <col style="width: 80px;">
            <? } ?>
              <col style="width: 80px;">
              <col style="width: auto;">
              <col style="width: 10%;">
              <col style="width: 10%;">
              <col style="width: 10%;">
            </colgroup>
            <thead>
              <tr>
                <? if($_SESSION[login_level]=="3"){ ?>
                <th>
                  <div class="check-wrap">
                    <input type="checkbox" id="all-check">
                    <label for="all-check"></label>
                  </div>
                </th>
                <? } ?>
                <th>번호</th>
                <th>제목</th>
                <th>이름</th>
                <th>등록일</th>
                <th>조회</th>
              </tr>
            </thead>
            <tbody>
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
              <tr>
                <? if($_SESSION[login_level]=="3"){ ?>
                <td>
                  <div class="check-wrap">
                    <input type="checkbox" id="check<?=$i?>" name="checkidx[]" value="<?=$board_list[$i][idx]?>">
                    <label for="check<?=$i?>"></label>
                  </div>
                </td>
                <? } ?>
                <td><?=$not?></td>
                <td><a href="./sub01_view.php?idx=<?=$board_list[$i][idx]?>" class="ellipsis"><?=$board_list[$i][board_title]?></a><?=$fil?></td>
                <td><?=$board_list[$i][board_name]?></td>
                <td><?=substr($board_list[$i][regdate],0,10)?></td>
                <td><?=number($board_list[$i][board_hits])?></td>
              </tr>
<? } ?>
            </tbody>
          </table>
</form>
        </div>

        <div class="notice-list-bottom">
          <div class="prefix">
		  <? if($_SESSION[login_level]=="3"){ ?>
            <a href="javascript:all_del();" class="btn btn-outline-default btn-round sm">선택삭제</a>
		  <? } ?>
          </div>
          <div class="pagination">
<? echo paging_f($page, $page_row, $page_scale, $total_count, $ext); ?>               
          </div>
          <div class="suffix">
		  <? if($web_table[table_write]<=$_SESSION[login_level]){ ?>
            <a href="./sub01_write.php?id=<?=$id?>" class="btn btn-outline-red btn-round sm">글쓰기</a>
		  <? } ?>
          </div>
        </div>
      </div>
    </section>
  </div>
<?
include "../inc/consult_form.php";
include "../inc/footer.php";
?>

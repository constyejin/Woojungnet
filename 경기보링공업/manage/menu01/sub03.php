<?
include "../inc/header.php";
include "../inc/menu.php";

$popup=sql_list("select * from popup where 1=1 order by idx desc limit $page_start, $page_row");
$total_count=sql_total("select count(*) as cnt from popup where 1=1 ");
$list_num=$total_count-$page_start;
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>팝업설정</h2>
    </div>
    <div class="content-container">

      <div class="container-fluid popup-setting">
        <!-- 팝업 세팅 테이블-->
        <div class="row mt-5">
          <div class="col-12">
            <div class="table-topper">
              <div class="suffix">
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="location.href='sub03_write.php';">등록하기</button>
              </div>
            </div>
<form name="lform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="/manage/inc/alldel.php">
<input type="hidden" name="db_name" value="popup">
            <table class="table table-layout border-type mt-3 popup-list text-center">
              <colgroup>
                <col style="width: 50px;">
                <col style="width: 50px;">
                <col style="width: 180px;"> <!--이미지-->
                <col style="min-width: 230px;"> <!--제목링크-->
                <col style="width: 80px;">
                <col style="width: 80px;">
                <col style="width: 80px;">
                <col style="min-width: 120px;width: auto">

              </colgroup>
              <thead>
                <tr>
                  <th>
                    <input class="form-check-input" type="checkbox" value="" id="all-check">
                  </th>
                  <th>No</th>
                  <th>이미지</th>
                  <th>제목/링크주소</th>
                  <th>노출</th>
                  <th>스크롤</th>
                  <th>링크</th>
                  <th>노출기간</th>
                </tr>
              </thead>
              <tbody class="table-light">
<? for($i=0;$i<count($popup);$i++){ ?>
				<tr >
                  <td>
                    <input class="form-check-input" type="checkbox" value="<?=$popup[$i][idx]?>" name="checkidx[]">
                  </td>
                  <td onclick="location.href='./sub02_write.php?idx=<?=$popup[$i][idx]?>'"><?=$list_num--;?></td>
                  <td onclick="location.href='./sub02_write.php?idx=<?=$popup[$i][idx]?>'">
				  <? if($popup[$i][pop_file]){ ?>
                    <img src="/images/popup/<?=$popup[$i][pop_file]?>" alt="" style="height:100px;">
				  <? } ?>
                  </td>
                  <td class="link-and-title" onclick="location.href='./sub02_write.php?idx=<?=$popup[$i][idx]?>'">
                    <ul>
                      <li>
                        <p class="data-title">
                          <?=$popup[$i][pop_title]?>
                        </p>
                      </li>
                      <li>
                        <a href="" class="data-link">
                          <?=$popup[$i][pop_link]?>
                        </a>
                      </li>
                    </ul>
                  </td>
                  <td onclick="location.href='./sub02_write.php?idx=<?=$popup[$i][idx]?>'">
                    <?=$popup[$i][pop_view]?>
                  </td>
                  <td onclick="location.href='./sub02_write.php?idx=<?=$popup[$i][idx]?>'">
                    <?=$popup[$i][pop_scroll]?>
                  </td>
                  <td onclick="location.href='./sub02_write.php?idx=<?=$popup[$i][idx]?>'"><?=$array_pop_link_type[$popup[$i][pop_link_type]]?></td>
                  <td onclick="location.href='./sub02_write.php?idx=<?=$popup[$i][idx]?>'">
                    <div class="period">
					<? if($popup[$i][pop_view_type]=="1"){ ?>
                      <span class="start"><?=$popup[$i][pop_startday]?></span> ~ <span class="end"><?=$popup[$i][pop_endday]?></span>
					<? }else if($popup[$i][pop_view_type]=="2"){ ?>
						상시적용
					<? } ?>
                    </div>
                  </td>
                </tr>
<? } ?>
              </tbody>
            </table>
</form>
            <div class="table-footer">
              <div class="prefix">
                <button type="button" class="btn btn-outline-dark btn-sm" onclick="all_del()">선택삭제</button>
              </div>
              <div class="center">
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
<? echo paging($page, $page_row, $page_scale, $total_count, $ext); ?>               
                  </ul>
                </nav>
              </div>
              <div class="suffix">
              </div>
            </div>
          </div>
        </div>
        <!-- //팝업 세팅 테이블-->
      </div>
    </div>
  </div>
</body>
</html>
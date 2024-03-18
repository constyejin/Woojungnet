<?
include "../inc/header.php";
include "../inc/menu.php";

if($s_text) $where=" and (consult_name like '%$s_text%' or consult_phone like '%$s_text%' or consult_email like '%$s_text%')";
$consult=sql_list("select * from consult where 1=1 $where order by idx desc limit $page_start, $page_row ");
$total_count=sql_total("select count(*) as cnt from consult where 1=1 $where ");
$list_num=$total_count-$page_start;
?>
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub01_change_save.php">
<input type="hidden" name="idx" value="">
<input type="hidden" name="val" value="">
</form>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>견적신청</h2>
    </div>
    <div class="content-container">

      <div class="container-fluid contact-manage mb-5">
        <!-- 상담문의 테이블 -->
        <div class="row mt-5">
          <div class="col-12">
<form name="sform" method="post" enctype="multipart/form-data" action="sub01.php">
            <div class="table-topper mb-3">
              <div class="suffix">
                <input type="text" class="form-control search-input me-1" name="s_text" value="<?=$s_text?>">
                <button class="btn btn-outline-primary btn-sm">검색</button>
              </div>
            </div>
</form>
<form name="lform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="/manage/inc/alldel.php">
<input type="hidden" name="db_name" value="consult">
            <table class="table table-layout border-type text-center table-hover contact-list">
              <colgroup>
                <col style="width: 50px">
                <col style="width: auto">
                <col style="width: auto">
                <col style="width: auto">
                <col style="width: auto">
                <col style="width: auto">
                <col style="width: 100px">
              </colgroup>
              <thead class="table-light">
                <tr>
                  <th>
                    <input type="checkbox" class="form-check-input" id="all-check">
                  </th>
                  <th>No</th>
                  <th>등록일</th>
                  <th>이름</th>
                  <th>연락처</th>
                  <th>이메일</th>
                  <th>비고</th>
                </tr>
              </thead>
              <tbody>
<? for($i=0;$i<count($consult);$i++){ ?>
                <tr>
                  <td>
                    <input type="checkbox" class="form-check-input" value="<?=$consult[$i][idx]?>" name="checkidx[]">
                  </td>
                  <td onclick="location.href='./sub01_view.php?idx=<?=$consult[$i][idx]?>'"><?=$list_num--;?></td>
                  <td onclick="location.href='./sub01_view.php?idx=<?=$consult[$i][idx]?>'">
                    <?=substr($consult[$i][consult_regdate],0,10)?>
                  </td>
                  <td onclick="location.href='./sub01_view.php?idx=<?=$consult[$i][idx]?>'">
                    <?=$consult[$i][consult_name]?>
                  </td>
                  <td onclick="location.href='./sub01_view.php?idx=<?=$consult[$i][idx]?>'"><?=$consult[$i][consult_phone]?></td>
                  <td onclick="location.href='./sub01_view.php?idx=<?=$consult[$i][idx]?>'"><?=$consult[$i][consult_email]?></td>
                  <td>
                    <select class="form-select" aria-label="select" onchange="est_state_change('<?=$consult[$i][idx]?>',this.value);">
                      <option value="1" selected>접수</option>
                      <option value="2" <?=$consult[$i][consult_step]==2?"selected":""?>>확인</option>
                    </select>
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
        <!-- //상담문의 테이블 -->
      </div>
    </div>
  </div>
</body>
</html>
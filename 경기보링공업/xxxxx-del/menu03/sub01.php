<?
include "../inc/header.php";
include "../inc/menu.php";

if($t=="1") $where ="and cate_type1='화물차' ";
if($t=="2") $where ="and cate_type1='캠핑카' ";
if($idx) $mod_cate=sql_fetch("select * from category where idx='$idx' ");
$category=sql_list("select * from category where 1=1 $where order by cate_list asc ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>카테고리</h2>
    </div>

    <div class="content-container category-list">
      <div class="container-fluid">
        <div class="row mt-5">
          <div class="col-12">
            <!-- <p class="notice mb-1">* 대메뉴를 항상 먼저 선택후 서브메뉴를 입력하세요 </p> -->
            <!-- 선택옵션 테이블 -->
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub01_save.php">
<input type="hidden" name="mod_idx" value="<?=$idx?>">
<input type="hidden" name="del_idx" value="">
            <table class="table table-layout border-type">
              <colgroup>
                <col style="width: 180px;">
              </colgroup>
              <tbody class="table-light">
                <tr>
                  <th>
                    카테고리
                  </th>
                  <td>
                    <div class="form-group">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="cate_type1" value="화물차" id="category1" checked>
                        <label class="form-check-label" for="category1">
                          화물차
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="cate_type1" value="캠핑카" id="category2" <?=$mod_cate[cate_type1]=="캠핑카"?"checked":""?>>
                        <label class="form-check-label" for="category2">
                          캠핑카
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <span class="label">서브 메뉴명</span>
                      <input type="text" class="form-control sub-menu-title" name="cate_type2" value="<?=$mod_cate[cate_type2]?>">
                    </div>

                    <div class="form-group">
                      <span class="label">정렬</span>
                      <select class="form-select" aria-label="select" name="cate_list">
                        <option value="" selected="">정렬</option>
						<? for($i=1;$i<=20;$i++){ ?>
                        <option value="<?=$i?>" <?=$mod_cate[cate_list]==$i?"selected":""?>><?=$i?></option>
						<? } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.wform.submit();">등록하기</button>
                    </div>

                  </td>
                </tr>
              </tbody>
            </table>
</form>
            <!-- <div class="table-footer mt-3 justify-content-center">
              <div class="center">
                <button type="button" class="btn btn-outline-secondary btn-sm">등록하기</button>
              </div>
            </div> -->
            <!-- //선택옵션 테이블 -->


          </div>
        </div>
      </div>

      <div class="container-fluid mb-5">
        <!-- 카테고리 테이블 -->
        <div class="row mt-5">
          <div class="col-12">
            <div class="table-topper">
              <ul class="filter">
                <li><a href="sub01.php" <?=!$t?'class="active"':''?>>전체보기</a></li>
                <li><a href="sub01.php?t=1" <?=$t=="1"?'class="active"':''?>>화물차</a></li>
                <li><a href="sub01.php?t=2" <?=$t=="2"?'class="active"':''?>>캠핑카</a></li>
              </ul>
              <span class="notice">
                * 카테고리를 클릭하시어 내용을 넣어주세요
              </span>
            </div>
            <table class="table table-layout border-type text-center table-hover">
              <colgroup>
                <col style="width: 100px">
                <col style="width: 80px">
                <col style="width: auto">
                <col style="width: 150px">
                <col style="width: 150px">
              </colgroup>
              <thead class="table-light">
                <tr>
                  <th>정렬순서</th>
                  <th>코드</th>
                  <th>카테고리</th>
                  <th>메인노출</th>
                  <th>비고</th>
                </tr>
              </thead>
              <tbody>
<? for($i=0;$i<count($category);$i++){ ?>
                <tr>
                  <td><?=$category[$i][cate_list]?></td>
                  <td><?=$category[$i][cate_code]?></td>
                  <td>
                    <a href="./sub01_write.php?idx=<?=$category[$i][idx]?>">
                      <?=$category[$i][cate_type1]?>><?=$category[$i][cate_type2]?>
                    </a>
                  </td>
                  <td><?=$category[$i][cate_view]?></td>
                  <td>
                    <button class="btn btn-outline-secondary btn-sm" onclick="location.href='sub01.php?idx=<?=$category[$i][idx]?>';">수정</button>
                    <button class="btn btn-outline-dark btn-sm" onclick="board_del('<?=$category[$i][idx]?>');">삭제</button>
                  </td>
                </tr>
<? } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- //카테고리 테이블 -->
      </div>

    </div>
  </div>
</body>
</html>
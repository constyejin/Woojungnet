<?
include "../inc/header.php";
include "../inc/menu.php";

if($idx) $mod_sub=sql_fetch("select * from image_sub where idx='$idx' ");
$image_sub=sql_list("select * from image_sub where sub_type='menu' order by idx desc ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>메뉴이미지</h2>
    </div>
    <div class="content-container menu-image-list">
      <div class="container-fluid">
        <div class="row mt-5">
          <div class="col-12">
            <div class="table-topper">
              <span class="notice">
                메뉴클릭시 상단에 고정으로 나타나는 이미지 입니다
              </span>
            </div>
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub04_save.php">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="del_idx" value="">
<input type="hidden" name="sub_type" value="menu">
            <table class="table table-layout border-type main-visual">
              <colgroup>
                <col style="width: 12%">
                <col style="width: auto">
                <!-- <col style="width: 15%"> -->

              </colgroup>
              <tbody class="table-light">
                <tr>
                  <th class="label">대메뉴</th>
                  <td>
                    <div class="row">
                      <div class="col-3">
                        <select class="form-select" aria-label="select" name="sub_menu">
                          <option value="" selected="">메뉴선택</option>
                          <option value="회사소개" <?=$mod_sub[sub_menu]=="회사소개"?"selected":""?>>회사소개</option>
                          <option value="화물차" <?=$mod_sub[sub_menu]=="화물차"?"selected":""?>>화물차</option>
                          <option value="캠핑카" <?=$mod_sub[sub_menu]=="캠핑카"?"selected":""?>>캠핑카</option>
                          <option value="출고차량" <?=$mod_sub[sub_menu]=="출고차량"?"selected":""?>>출고차량</option>
                          <option value="부품구매" <?=$mod_sub[sub_menu]=="부품구매"?"selected":""?>>부품구매</option>
                          <option value="고객센터" <?=$mod_sub[sub_menu]=="고객센터"?"selected":""?>>고객센터</option>
                        </select>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th class="label">이미지파일</th>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <input class="form-control" type="file" id="formFile" name="upfile">
                      </div>
                      <div class="col-auto d-flex align-items-center">
                        <div class="form-text">크기: 460 * 245 gif/jpg/png</div>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
</form>
            <div class="table-footer mt-3 justify-content-center">
              <div class="center">
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.wform.submit();">등록하기</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid mb-5">
        <!-- 카테고리 테이블 -->
        <div class="row mt-5">
          <div class="col-12">
            <table class="table table-layout border-type text-center table-hover">
              <colgroup>
                <col style="width: 120px">
                <col style="width: auto">
                <col style="width: 200px">
              </colgroup>
              <thead class="table-light">
                <tr>
                  <th>대메뉴</th>
                  <th>이미지</th>
                  <th>비고</th>
                </tr>
              </thead>
              <tbody>
<? for($i=0;$i<count($image_sub);$i++){ ?>
                <tr>
                  <td><?=$image_sub[$i][sub_menu]?></td>
                  <td>
				  <? if($image_sub[$i][sub_file]){ ?>
                    <img src="/images/img/<?=$image_sub[$i][sub_file]?>" alt="메뉴 이미지" style="width:460px;height:245px;">
				  <? } ?>
                  </td>
                  <td>
                    <button class="btn btn-outline-secondary btn-sm" onclick="location.href='sub04.php?idx=<?=$image_sub[$i][idx]?>';">수정</button>
                    <button class="btn btn-outline-dark btn-sm" onclick="board_del('<?=$image_sub[$i][idx]?>');">삭제</button>
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
<?
include "../inc/header.php";
include "../inc/menu.php";

if(!$search_type1) $search_type1="화물차";
if(!$search_type2) $search_type2="섀시캡";
if($search_type1) $where.=" and st_type1='$search_type1' ";
if($search_type2) $where.=" and st_type2='$search_type2' ";
if($idx) $mod_st=sql_fetch("select * from image_structure where idx='$idx' ");
$image_st=sql_list("select * from image_structure where 1=1 $where order by st_list asc ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>구조 이미지</h2>
    </div>
    <div class="content-container dimession-image">
      <div class="container-fluid">
        <div class="row mt-5">
          <div class="col-12">
            <div class="table-topper">
              <span class="notice">
                화물차/캠핑카 페이지에 노출되는 슬라이드 이미지입니다
              </span>
            </div>
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub05_save.php">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="del_idx" value="">
            <table class="table table-layout border-type main-visual">
              <colgroup>
                <col style="width: 12%">
                <col style="width: auto">
              </colgroup>
              <tbody class="table-light">
                <!--tr>
                  <th class="label">정렬</th>
                  <td colspan="3">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="st_list" value="1" id="arrange1" checked>
                      <label class="form-check-label" for="arrange1">
                        1
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="st_list" value="2" id="arrange2" <?=$mod_st[st_list]=="2"?"selected":""?>>
                      <label class="form-check-label" for="arrange2">
                        2
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="st_list" value="3" id="arrange2" <?=$mod_st[st_list]=="3"?"selected":""?>>
                      <label class="form-check-label" for="arrange2">
                        3
                      </label>
                    </div>
                  </td>
                </tr-->
                <tr>
                  <th class="label">차량구분</th>
                  <td colspan="3">
                    <div class="row">
                      <div class="col-2">
                        <select class="form-select" aria-label="select" name="st_type1" onchange="ch_type(this.value,'4');">
                          <option value="" selected="">=대구분=</option>
                          <option value="화물차" <?=$mod_st[st_type1]=="화물차"?"selected":""?>>화물차</option>
                          <option value="캠핑카" <?=$mod_st[st_type1]=="캠핑카"?"selected":""?>>캠핑카</option>
                        </select>
                      </div>
                      <div class="col-2">
                        <select class="form-select" aria-label="select" name="st_type2">
                          <option value="" selected="">=소구분=</option>
                        </select>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>타이틀</th>
                  <td>
                    <div class="row">
                      <div class="col-3">
                        <input type="text" class="form-control" name="st_title" value="<?=$mod_st[st_title]?>">
                      </div>
                      <div class="col-5">
                        <p class="form-text">예: 나르미 1톤 롱바디</p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th class="label">이미지파일1</th>
                  <td colspan="3">
                    <div class="row">
                      <div class="col-6">
                        <input class="form-control" type="file" id="formFile" name="upfile1">
                      </div>
                      <div class="col-auto d-flex align-items-center">
                        <div class="form-text">크기: 815 * 490 (gif/jpg/png)</div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th class="label">이미지파일2</th>
                  <td colspan="3">
                    <div class="row">
                      <div class="col-6">
                        <input class="form-control" type="file" id="formFile" name="upfile2">
                      </div>
                      <div class="col-auto d-flex align-items-center">
                        <div class="form-text">크기: 815 * 490 (gif/jpg/png)</div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th class="label">이미지파일3</th>
                  <td colspan="3">
                    <div class="row">
                      <div class="col-6">
                        <input class="form-control" type="file" id="formFile" name="upfile3">
                      </div>
                      <div class="col-auto d-flex align-items-center">
                        <div class="form-text">크기: 815 * 490 (gif/jpg/png)</div>
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
        <!-- 구조이미지 테이블 -->
        <div class="row mt-5">
          <div class="col-12">
            <div class="table-topper filter">
              <div class="select-group">
<form name="lform" method="post" enctype="multipart/form-data" action="sub05.php">
                <select class="form-select" aria-label="select" name="search_type1" onchange="document.lform.submit();">
                  <option value="" selected="">=대메뉴=</option>
                  <option value="화물차" <?=$search_type1=="화물차"?"selected":""?>>화물차</option>
                  <option value="캠핑카" <?=$search_type1=="캠핑카"?"selected":""?>>캠핑카</option>
                </select>
                <select class="form-select" aria-label="select" name="search_type2" onchange="document.lform.submit();">
                  <option value="" selected="">=소메뉴=</option>
<?
if($search_type1){
	$mod_car_cate=sql_list("select * from category where cate_type1='$search_type1' order by cate_list asc ");
	for($i=0;$i<count($mod_car_cate);$i++){ 
?>
                          <option value="<?=$mod_car_cate[$i][cate_type2]?>" <?=$search_type2==$mod_car_cate[$i][cate_type2]?"selected":""?>><?=$mod_car_cate[$i][cate_type2]?></option>
<?
	} 
}
?>
                </select>
</form>
              </div>
            </div>
            <table class="table table-layout border-type text-center table-hover image-list">
              <colgroup>
                <col style="width: auto">
                <col style="width: 200px">
              </colgroup>
              <thead class="table-light">
                <tr>
                  <th>이미지</th>
                  <th>비고</th>
                </tr>
              </thead>
              <tbody>
<? for($i=0;$i<count($image_st);$i++){ ?>
                <tr>
                  <td>
                    <div class="category-tag">
                      <span class="title"><?=$image_st[$i][st_title]?></span> | <span class="category"><?=$image_st[$i][st_type1]?> > <?=$image_st[$i][st_type2]?></span>
                      <button onclick="window.open('./sub05_popup.php?idx=<?=$image_st[$i][idx]?>','_blank','height=700, width=1400, top=100, left=100','popup')" class="btn btn-outline-primary btn-sm">적용된이미지보기</button>
                    </div>
					<? if($image_st[$i][st_file1]){ ?>
                    <img src="/images/img/<?=$image_st[$i][st_file1]?>" alt="메뉴 이미지" style="width:814px;height:489px;">
					<? } ?>
					<? if($image_st[$i][st_file2]){ ?>
                    <img src="/images/img/<?=$image_st[$i][st_file2]?>" alt="메뉴 이미지" style="width:814px;height:489px;">
					<? } ?>
					<? if($image_st[$i][st_file3]){ ?>
                    <img src="/images/img/<?=$image_st[$i][st_file3]?>" alt="메뉴 이미지" style="width:814px;height:489px;">
					<? } ?>
                  </td>
                  <td>
                    <button class="btn btn-outline-secondary btn-sm" onclick="location.href='sub05.php?idx=<?=$image_st[$i][idx]?>';">수정</button>
                    <button class="btn btn-outline-dark btn-sm" onclick="board_del('<?=$image_st[$i][idx]?>');">삭제</button>
                  </td>
                </tr>
<? } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- //구조이미지 테이블 -->
      </div>

    </div>
  </div>
</body>
</html>
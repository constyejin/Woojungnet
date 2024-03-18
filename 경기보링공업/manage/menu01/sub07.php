<?
include "../inc/header.php";
include "../inc/menu.php";

if($idx) $mod_main=sql_fetch("select * from image_main where idx='$idx' ");
$image_main=sql_list("select * from image_main where 1=1 order by main_list asc ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>메인이미지</h2>
    </div>
    <div class="content-container">

      <div class="container-fluid main-manage mt-5">
        <!-- 이미지등록 및 관리 -->
        <div class="row">
          <div class="col-12">
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub07_save.php">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="del_idx" value="">
            <table class="table table-layout border-type main-visual">
              <colgroup>
                <col style="width: 12%">
                <col style="width: auto">
                <!-- <col style="width: 15%"> -->

              </colgroup>
              <tbody class="table-light">
                <tr>
                  <th class="label">노출여부</th>
                  <td>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="main_view" value="Y" id="exhibit1" checked>
                      <label class="form-check-label" for="exhibit1">
                        노출
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="main_view" value="N" id="exhibit2" <?=$mod_main[main_view]=="N"?"checked":""?>>
                      <label class="form-check-label" for="exhibit2">
                        감춤
                      </label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th class="label">정렬순서</th>
                  <td>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="main_list" value="1" id="exhibitionOrder1" checked>
                      <label class="form-check-label" for="exhibitionOrder1">
                        1
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="main_list" value="2" id="exhibitionOrder2" <?=$mod_main[main_list]=="2"?"checked":""?>>
                      <label class="form-check-label" for="exhibitionOrder2">
                        2
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="main_list" value="3" id="exhibitionOrder2" <?=$mod_main[main_list]=="3"?"checked":""?>>
                      <label class="form-check-label" for="exhibitionOrder2">
                        3
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="main_list" value="4" id="exhibitionOrder2" <?=$mod_main[main_list]=="4"?"checked":""?>>
                      <label class="form-check-label" for="exhibitionOrder2">
                        4
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="main_list" value="5" id="exhibitionOrder2" <?=$mod_main[main_list]=="5"?"checked":""?>>
                      <label class="form-check-label" for="exhibitionOrder2">
                        5
                      </label>
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
                        <div class="form-text">크기:2000*950 (gif/jpg/ jpeg/png)</div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th class="label">링크주소</th>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="main_link" value="<?=$mod_main[main_link]?>">
                      </div>
                      <div class="col-auto d-flex align-items-center">
                        <div class="form-text">ex) http://naver.com</div>
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
        <!-- //이미지등록 및 관리 -->

        <!-- 이미지 목록 -->
        <div class="row mt-5">
          <div class="col-12">
            <table class="table table-layout border-type img-list">
              <colgroup>
                <col style="width: 12%">
                <col style="width: auto">
                <col style="width: 70px">
                <col style="width: 150px">
              </colgroup>
              <thead>
                <th>정렬번호</th>
                <th>이미지</th>
                <th>노출</th>
                <th>비고</th>
              </thead>
              <tbody class="table-light">
<? for($i=0;$i<count($image_main);$i++){ ?>
                <tr>
                  <td><?=$image_main[$i][main_list]?></td>
                  <td>
				  <? if($image_main[$i][main_file]){ ?>
                    <img src="/mainimg/<?=$image_main[$i][main_file]?>" style="width:750px;height:280px;">
				  <? } ?>
                  </td>
                  <td><?=$image_main[$i][main_view]?></td>
                  <td>
                    <button class="btn btn-outline-secondary btn-sm" onclick="location.href='sub07.php?idx=<?=$image_main[$i][idx]?>';">수정</button>
                    <button class="btn btn-outline-dark btn-sm" onclick="board_del('<?=$image_main[$i][idx]?>');">삭제</button>
                  </td>
                </tr>
<? } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- //이미지 목록 -->


      </div>
    </div>
  </div>
</body>
</html>
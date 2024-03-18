<?
include "../inc/header.php";
include "../inc/menu.php";

include "../inc/calendar.php";

if($idx) $popup=sql_fetch("select * from popup where idx=$idx ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>팝업설정</h2>
    </div>
    <div class="content-container">

      <div class="container-fluid popup-setting mb-5">
        <!-- 팝업설정 등록 테이블 -->
        <div class="row mt-5">
          <div class="col-10">
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub03_save.php">
<input type="hidden" name="idx" value="<?=$popup[idx]?>">
            <table class="table table-layout border-type mt-1 popup-write">
              <colgroup>
                <col style="width: 150px;">
                <col style="width: auto;">
                <col style="width: 150px;">
              </colgroup>
              <tbody class="table-light">
                <tr>
                  <th>팝업제목</th>
                  <td colspan="3">
                    <input type="text" class="form-control" id="" placeholder="" name="pop_title" value="<?=$popup[pop_title]?>">
                  </td>
                </tr>
                <tr>
                  <th>적용여부</th>
                  <td>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="pop_view" id="exhibit1" checked="" value="O">
                      <label class="form-check-label" for="exhibit1" >
                        노출
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="pop_view" id="exhibit2" value="X" <?=$popup[pop_view]=="X"?"checked":""?>>
                      <label class="form-check-label" for="exhibit2">
                        감춤
                      </label>
                    </div>
                  </td>
                  <th>스크롤</th>
                  <td>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="pop_scroll" id="scrollable1" value="yes" checked="">
                      <label class="form-check-label" for="scrollable1">
                        사용
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="pop_scroll" id="scrollable2" value="no" <?=$popup[pop_scroll]=="no"?"checked":""?>>
                      <label class="form-check-label" for="scrollable2">
                        미사용
                      </label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>노출기간</th>
                  <td colspan="3">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="pop_view_type" id="exhibitPeriod1" checked="" style="margin-top: 12px" value="1">
                      <label class="exhibit-period">
                        <input type="date" class="form-control" id="sdate" placeholder="" name="pop_startday" value="<?=$popup[pop_startday]?>">
                        <span class="icon-calendar ms-1"></span>
                        <span class="bridge">~</span>
                        <input type="date" class="form-control" id="exhibitPeriodEnd" placeholder="" name="pop_endday" value="<?=$popup[pop_endday]?>">
                        <span class="icon-calendar ms-1"></span>
                        <span class="unit">까지</span>
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="pop_view_type" id="exhibitPeriod2" value="2" <?=$popup[pop_view_type]=="2"?"checked":""?>>
                      <label class="form-check-label" for="exhibitPeriod2" >
                        상시적용
                      </label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>팝업크기</th>
                  <td colspan="3">
                    <ul class="popup-size">
                      <li>
                        <span class="label-sm">가로</span>
                        <div class="data-pixel">
                          <input type="text" class="form-control" id="" placeholder="" name="pop_width" value="<?=$popup[pop_width]?>">
                        </div>
                        픽셀
                      </li>
                      <li>
                        <span class="label-sm">세로</span>
                        <div class="data-pixel">
                          <input type="text" class="form-control" id="" placeholder="" name="pop_height" value="<?=$popup[pop_height]?>">
                        </div>
                        픽셀
                      </li>
                    </ul>
                  </td>
                </tr>
                <tr>
                  <th>팝업위치</th>
                  <td colspan="3">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="pop_position" id="exhibit1" checked="" value="L">
                      <label class="form-check-label" for="exhibit1">
                        좌측
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="pop_position" id="exhibit2" value="C" <?=$popup[pop_position]=="C"?"checked":""?>>
                      <label class="form-check-label" for="exhibit2">
                        중앙
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="pop_position" id="exhibit2" value="R" <?=$popup[pop_position]=="R"?"checked":""?>>
                      <label class="form-check-label" for="exhibit2">
                        우측
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="pop_position" id="exhibit2"  value="E" <?=$popup[pop_position]=="E"?"checked":""?>>
                      <label class="form-check-label" for="exhibit2">
                        기타
                      </label>
                    </div>
                    <ul class="popup-position">
                      <li>
                        <span class="label-sm">좌측으로부터</span>
                        <div class="data-pixel">
                          <input type="text" class="form-control" id="" placeholder="" name="pop_left" value="<?=$popup[pop_left]?>">
                        </div>
                        픽셀
                      </li>
                      <li>
                        <span class="label-sm">위로부터</span>
                        <div class="data-pixel">
                          <input type="text" class="form-control" id="" placeholder="" name="pop_top" value="<?=$popup[pop_top]?>">
                        </div>
                        픽셀
                      </li>
                    </ul>
                  </td>
                  <!-- <td colspan="3">
                    <ul class="popup-size">
                      <li>
                        <span class="label-sm">가로</span>
                        <div class="data-pixel">
                          <input type="text" class="form-control" id="" placeholder="" value="900">
                        </div>
                        픽셀
                      </li>
                      <li>
                        <span class="label-sm">세로</span>
                        <div class="data-pixel">
                          <input type="text" class="form-control" id="" placeholder="" value="300">
                        </div>
                        픽셀
                      </li>
                    </ul>
                  </td> -->
                </tr>
                <tr>
                  <th>이미지</th>
                  <td colspan="3">
                    <div class="row align-items-center">
                      <div class="col-6">
                        <input type="file" class="form-control" id="inputGroupFile01" name="upfile">
                      </div>
                      <div class="col-auto d-flex align-items-center">
                        <div class="form-text">이미지명.jpg, gif, bmp </div>
                      </div>
                      <div class="col-auto">
					  <? if($popup[pop_file]){ ?>
                        <input class="form-check-input" type="checkbox" name="pop_file_del" value="Y" id="fileImgDelete">
                        <label class="form-check-label" for="fileImgDelete">삭제하기</label>
					  <? } ?>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>링크주소</th>
                  <td colspan="3">
                    <div class="row align-items-center">
                      <div class="col-6">
                        <input type="text" class="form-control" id="" placeholder="" name="pop_link" value="<?=$popup[pop_link]?>">
                      </div>
                      <div class="col-auto">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="pop_link_type" value="1" id="exhibit1" checked="" <?=$popup[pop_link_type]=="1"?"checked":""?>>
                          <label class="form-check-label" for="exhibit1">
                            바로링크
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="pop_link_type" value="2" id="exhibit2" <?=$popup[pop_link_type]=="2"?"checked":""?>>
                          <label class="form-check-label" for="exhibit2">
                            새창링크
                          </label>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>기타옵션</th>
                  <td colspan="3">
                    <div class="etc-option">
                      <select class="form-select" aria-label="Default select example" name="pop_etc">
                        <option value="1" selected>1일</option>
                        <option value="7" <?=$popup[pop_etc]=="7"?"selected":""?>>7일</option>
                      </select>
                      <label class="form-check-label">
                        동안 창 보지않기
                      </label>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
</form>
            <div class="table-footer mt-5 justify-content-center">
              <div class="center">
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.wform.submit();">등록하기</button>
                <button type="button" class="btn btn-outline-primary btn-sm ms-2" onclick="history.back();">목록보기</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5">
		<? if($popup[pop_file]){ ?>
          <div class="col-10">
            <h3>미리보기</h3>
            <div class="popup-preview"><img src="/images/popup/<?=$popup[pop_file]?>" alt=""></div>
          </div>
		<? } ?>

        </div>
        <!-- //팝업설정 등록 테이블 -->
      </div>
    </div>
  </div>
</body>
</html>
<?
include "../inc/header.php";
include "../inc/menu.php";

if($idx) $mod_color=sql_fetch("select * from option_color where idx='$idx' ");
$option_color1=sql_list("select * from option_color where color_type='1' and del='N' $where order by idx desc ");
$option_color2=sql_list("select * from option_color where color_type='2' and del='N' $where order by idx desc ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>색상옵션</h2>
    </div>
    <div class="content-container color-options">
      <div class="container-fluid additional-options-form">
        <!-- 색상옵션 테이블 -->
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub02_save.php">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="del_idx" value="">
        <table class="table table-layout border-type mt-5">
          <colgroup>
            <col style="width: 180px;">
            <col style="width: auto">
            <col style="width: 180px;">
            <col style="width: auto">
          </colgroup>
          <tbody class="table-light">
            <tr>
              <th>
                내외장선택
              </th>
              <td>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="color_type" value="1" id="exterior1" checked>
                  <label class="form-check-label" for="exterior1">
                    외장색상
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="color_type" value="2" id="interior2" <?=$mod_color[color_type]=="2"?"checked":""?>>
                  <label class="form-check-label" for="interior2">
                    내장색상
                  </label>
                </div>
              </td>
              <th>
                선택차량
              </th>
              <td>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" id="vehicleOption1" name="color_type1" value="Y" <?=$mod_color[color_type1]=="Y"?"checked":""?>>
                  <label class="form-check-label" for="vehicleOption1">
                    화물차
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" id="vehicleOption2" name="color_type2" value="Y" <?=$mod_color[color_type2]=="Y"?"checked":""?>>
                  <label class="form-check-label" for="vehicleOption2">
                    캠핑카
                  </label>
                </div>
              </td>
            </tr>
            <tr>
              <th>
                칼라명
              </th>
              <td colspan="3">
                <div class="row">
                  <div class="col-3">
                    <input type="text" class="form-control" name="color_name" value="<?=$mod_color[color_name]?>">
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>이미지</th>
              <td colspan="3">
                <div class="row">
                  <div class="col-8">
                    <input type="file" class="form-control" name="upfile">
                  </div>
                  <div class="col-auto">
                    <div class="form-text">파일형식: gif/jpg/png</div>
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
        <!-- //색상옵션 테이블 -->
      </div>
      <div class="container-fluid">
        <div class="row mt-5 mb-5 ">
          <div class="col-12">
            <h3>외장색상</h3>
            <div class="color-list-wrap">
              <ul>
<? for($i=0;$i<count($option_color1);$i++){ ?>
                <li>
                  <div class="img-wrap color-chip" style="background-image: url('/images/opt/<?=$option_color1[$i][color_file]?>');">
                  </div>
                  <div class="color-name">
                    <span class="name">
                      <?=$option_color1[$i][color_name]?><br>
					  <?=$option_color1[$i][color_type1]=="Y"&&$option_color1[$i][color_type2]=="Y"?"화물차 | 캠핑카":""?>
                      <?=$option_color1[$i][color_type1]=="Y"&&$option_color1[$i][color_type2]==""?"화물차":""?>
                      <?=$option_color1[$i][color_type1]==""&&$option_color1[$i][color_type2]=="Y"?"캠핑카":""?>
                    </span>
                    <div class="btn-wrap">
                      <button class="btn btn-outline-secondary btn-sm" onclick="location.href='sub02.php?idx=<?=$option_color1[$i][idx]?>';">수정</button>
                      <button class="btn btn-outline-dark btn-sm" onclick="board_del('<?=$option_color1[$i][idx]?>');">삭제</button>
                    </div>
                  </div>
                </li>
<? } ?>
              </ul>
            </div>
          </div>
          <div class="col-12 mt-5">
            <h3>내장색상</h3>
            <div class="color-list-wrap interior">
              <ul>
<? for($i=0;$i<count($option_color2);$i++){ ?>
                <li>
                  <div class="img-wrap color-chip" style="background-image: url('/images/opt/<?=$option_color2[$i][color_file]?>');">
                  </div>
                  <div class="color-name">
                    <span class="name">
                      <?=$option_color2[$i][color_name]?><br>
					  <?=$option_color2[$i][color_type1]=="Y"&&$option_color2[$i][color_type2]=="Y"?"화물차 | 캠핑카":""?>
                      <?=$option_color2[$i][color_type1]=="Y"&&$option_color2[$i][color_type2]==""?"화물차":""?>
                      <?=$option_color2[$i][color_type1]==""&&$option_color2[$i][color_type2]=="Y"?"캠핑카":""?>
                    </span>
                    <div class="btn-wrap">
                      <button class="btn btn-outline-secondary btn-sm" onclick="location.href='sub02.php?idx=<?=$option_color2[$i][idx]?>';">수정</button>
                      <button class="btn btn-outline-dark btn-sm" onclick="board_del('<?=$option_color2[$i][idx]?>');">삭제</button>
                    </div>
                  </div>
                </li>
<? } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
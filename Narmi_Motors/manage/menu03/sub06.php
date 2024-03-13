<?
include "../inc/header.php";
include "../inc/menu.php";

if($idx) $mod_cer=sql_fetch("select * from image_certificate where idx='$idx' ");
$image_cer=sql_list("select * from image_certificate where 1=1 $where order by cer_list asc ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>인증서등록</h2>
    </div>
    <div class="content-container certification">
      <div class="container-fluid">
        <!-- 인증서등록 테이블 -->
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub06_save.php">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="del_idx" value="">
        <table class="table table-layout border-type mt-5">
          <colgroup>
            <col style="width: 180px;">
            <col style="width: auto">
          </colgroup>
          <tbody class="table-light">
            <tr>
              <th>
                정렬순서
              </th>
              <td>
                <div class="row">
                  <div class="col-2">
                    <select class="form-select" aria-label="select" name="cer_list">
                      <option value="" selected="">=정렬순서=</option>
                      <option value="1" <?=$mod_cer[cer_list]=="1"?"selected":""?>>1</option>
                      <option value="2" <?=$mod_cer[cer_list]=="2"?"selected":""?>>2</option>
                      <option value="3" <?=$mod_cer[cer_list]=="3"?"selected":""?>>3</option>
                      <option value="4" <?=$mod_cer[cer_list]=="4"?"selected":""?>>4</option>
                      <option value="5" <?=$mod_cer[cer_list]=="5"?"selected":""?>>5</option>
                      <option value="6" <?=$mod_cer[cer_list]=="6"?"selected":""?>>6</option>
                      <option value="7" <?=$mod_cer[cer_list]=="7"?"selected":""?>>7</option>
                      <option value="8" <?=$mod_cer[cer_list]=="8"?"selected":""?>>8</option>
                      <option value="9" <?=$mod_cer[cer_list]=="9"?"selected":""?>>9</option>
                      <option value="10" <?=$mod_cer[cer_list]=="10"?"selected":""?>>10</option>
                    </select>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>인증서명</th>
              <td>
                <div class="row input-wrap">
                  <div class="col-3">
                    <input type="text" class="form-control" name="cer_title" value="<?=$mod_cer[cer_title]?>">
                  </div>
                  <div class="col-3">
                    <div class="form-text">
                      예: 사업자등록증
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>이미지</th>
              <td>
                <div class="row">
                  <div class="col-5">
                    <input type="file" class="form-control" name="upfile">
                  </div>
                  <div class="col-auto">
                    <div class="form-text">크기:가로 1000px 이하 (gif/jpg/png)</div>
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
        <!-- //인증서등록 테이블 -->
      </div>
      <div class="container-fluid">
        <div class="row mt-5 mb-5 ">
          <div class="col-12">
            <h3>등록된 인증서</h3>
            <div class="certification-list-wrap">
              <ul>
<? for($i=0;$i<count($image_cer);$i++){ ?>
                <li>
                  <div class="img-wrap">
                    <a href="" class="toggle-layer-pop">
					<? if($image_cer[$i][cer_file]){ ?>
                      <img src="/images/img/<?=$image_cer[$i][cer_file]?>" alt="인증서이미지" onclick="document.getElementById('l_pop').src='/images/img/<?=$image_cer[$i][cer_file]?>';">
					<? } ?>
                    </a>
                  </div>
                  <div class="vehicle-name">
                    <div class="name">
                      <span class="number">
                        <?=$image_cer[$i][cer_list]?>.
                      </span>
                      <?=$image_cer[$i][cer_title]?>
                    </div>
                    <div class="btn-wrap">
                      <button class="btn btn-outline-secondary btn-sm" onclick="location.href='sub06.php?idx=<?=$image_cer[$i][idx]?>';">수정</button>
                      <button class="btn btn-outline-dark btn-sm" onclick="board_del('<?=$image_cer[$i][idx]?>');">삭제</button>
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

  <!-- 레이어팝업 -->
  <div class="dim">
  </div>
  <div class="layer-pop certification-image-zoom">
    <a href="" class="btn-close">
      <span class="bar"></span>
      <span class="bar"></span>
    </a>
    <div class="body">
      <div class="img-wrap">
        <img src="../image/certi.png" alt="옵션사진" id="l_pop">
      </div>
    </div>
   
  </div>

</body>
</html>
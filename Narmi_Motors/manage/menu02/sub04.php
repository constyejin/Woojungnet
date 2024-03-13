<?
include "../inc/header.php";
include "../inc/menu.php";

$web_config=sql_fetch("select * from web_config where idx=1 ");

if($t=="1") $where.=" and ch_option='1' ";
if($t=="2") $where.=" and ch_option='2' ";
if($idx) $mod_choice=sql_fetch("select * from option_choice where idx='$idx' ");
$option_choice=sql_list("select * from option_choice where del='N' $where order by idx desc ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>선택옵션</h2>
    </div>
    <div class="content-container">
      <div class="container-fluid additional-options-form">
        <!-- 선택옵션 테이블 -->
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub04_save.php">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="del_idx" value="">
        <table class="table table-layout border-type mt-5">
          <colgroup>
            <col style="width: 180px;">
            <col style="width: auto;">
            <col style="width: 180px;">
            <col style="width: auto;">
          </colgroup>
          <tbody class="table-light">
            <tr>
              <th>
                옵션구분
              </th>
              <td>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="ch_option" value="1" id="option1" checked>
                  <label class="form-check-label" for="option1">
                    차량옵션
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="ch_option" value="2" id="option2" <?=$mod_choice[ch_option]=="2"?"checked":""?>>
                  <label class="form-check-label" for="option2">
                    특장옵션
                  </label>
                </div>
              </td>
              <th>
                해당차량
              </th>
              <td>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input check-md" id="vehicleOption1" name="ch_type1" value="Y" <?=$mod_choice[ch_type1]=="Y"?"checked":""?>>
                  <label class="form-check-label" for="vehicleOption1">
                    화물차
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input check-md" id="vehicleOption2" name="ch_type2" value="Y" <?=$mod_choice[ch_type2]=="Y"?"checked":""?>>
                  <label class="form-check-label" for="vehicleOption2">
                    캠핑카
                  </label>
                </div>
              </td>
            </tr>
            <tr>
              <th>
                부품명
              </th>
              <td>
                <input type="text" class="form-control" name="ch_name" value="<?=$mod_choice[ch_name]?>">
              </td>
              <th>
                가격
              </th>
              <td>
                <div class="row align-items-center">
                  <div class="col-8">
                    <input type="text" class="form-control" name="ch_price" id="number" value="<?=number($mod_choice[ch_price])?>">
                  </div>
                  <div class="col-auto">
                    <span class="unit">
                      원
                    </span>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>부품설명</th>
              <td colspan="3">
				<input type="text" class="form-control" name="ch_explain" value="<?=$mod_choice[ch_explain]?>">
              </td>
            </tr>
            <tr>
              <th>
                이미지
              </th>
              <td colspan="3">
                <input type="file" class="form-control" name="upfile">
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
        <!-- //선택옵션 테이블 -->

        

        <!-- 등록상품 테이블 -->
        <div class="row mt-5 mb-5 ">
          <div class="col-12">
            <div class="table-topper">
              <ul class="links">
                <li><a href="sub04.php" <?=!$t?'class="active"':''?>>전체보기</a></li>
                <li><a href="sub04.php?t=1" <?=$t=="1"?'class="active"':''?>>차량옵션</a></li>
                <li><a href="sub04.php?t=2" <?=$t=="2"?'class="active"':''?>>특장옵션</a></li>
              </ul>
            </div>
            <div class="first-options">
              <ul>
<? for($i=0;$i<count($option_choice);$i++){ ?>
                <li class="">
                  <div class="item-wrap">
                    <div class="img-wrap">
					<? if($option_choice[$i][ch_file]){ ?>
                      <img src="/images/opt/<?=$option_choice[$i][ch_file]?>" alt="옵션사진">
					<? } ?>
                    </div>
                    <div class="title"><?=$option_choice[$i][ch_name]?>
                      <a href="" class="tooltip toggle-layer-pop">
                        <span class="icon-tooptip" onclick="document.getElementById('l_pop1').innerHTML='<?=$option_choice[$i][ch_name]?>';document.getElementById('l_pop2').src='/images/opt/<?=$option_choice[$i][ch_file]?>';document.getElementById('l_pop3').innerHTML='<?=nl2br($option_choice[$i][ch_explain])?>';document.getElementById('l_pop4').innerHTML='<?=number($option_choice[$i][ch_price])?>원';">!</span>
                      </a>
                    </div>
                    <div class="price">
                      <?=number($option_choice[$i][ch_price])?>원
                    </div>
                  </div>
                  <div class="category-wrap">
                    <?=$option_choice[$i][ch_type1]=="Y"&&$option_choice[$i][ch_type2]=="Y"?"화물차 | 캠핑카":""?>
                    <?=$option_choice[$i][ch_type1]=="Y"&&$option_choice[$i][ch_type2]==""?"화물차":""?>
                    <?=$option_choice[$i][ch_type1]==""&&$option_choice[$i][ch_type2]=="Y"?"캠핑카":""?>
                  </div>
                  <div class="btn-wrap">
                    <button class="btn btn-outline-secondary btn-sm" onclick="location.href='sub04.php?idx=<?=$option_choice[$i][idx]?>';">수정</button>
                    <button class="btn btn-outline-dark btn-sm" onclick="board_del('<?=$option_choice[$i][idx]?>');">삭제</button>
                  </div>
                </li>
<? } ?>
                
              </ul>
            </div>
          </div>
        </div>
        <!-- //등록상품 테이블 -->
      </div>
    </div>
  </div>


  <!-- 레이어팝업 -->
  <div class="dim">
  </div>
  <div class="layer-pop">
    <a href="" class="btn-close">
      <span class="bar"></span>
      <span class="bar"></span>
    </a>
    <div class="body">
      <p class="title" id="l_pop1">중량짐용 후륜 현가장치</p>
      <div class="img-wrap">
        <img src="../image/img_vehicle_detail.png" alt="옵션사진" id="l_pop2">
      </div>
      <div class="text-wrap">
        <p id="l_pop3">
          중량짐을 주로 취급하는 고객들을 위해 판스프링을 5장에서 6장으로 추가보강하여 장시간 중량짐에도 견딜 수 있도록 후륜 서스펜션의 내구성을 높인 장치입니다.
        </p>
        <p class="sub-text">
          * 홈페이지의 사진과 설명은 참고용이며 실제 차량에 탑제되는 기능과 설명은 상이할 수 있으니 반드시 차량구입전에 업체와 상의 하여 주십시요.
        </p>
      </div>
      <div class="price-wrap">
        <div class="price" id="l_pop4">999,999,999원</div>
        <!-- <button class="btn btn-secondary">등록하기</button> -->
      </div>
    </div>
   
  </div>
</body>
</html>
<?
include "../inc/header.php";
include "../inc/menu.php";

if($idx){
	$mod_est=sql_fetch("select * from estimate where idx='$idx' ");
	$sale_car_trim=sql_fetch("select * from option_basic where idx='".$mod_est[trim_idx]."' ");
	$mod_car=sql_fetch("select * from sale_est where idx='$mod_est[car_idx]' ");
	$car_check3=explode("/" , $mod_est[est_choice1]);
	$car_check4=explode("/" , $mod_est[est_choice2]);
	if($mod_car[idx]){
		if($mod_car[car_color1]) $car_color1=sql_fetch("select * from option_color where idx='$mod_car[car_color1]' ");
		if($mod_car[car_color2]) $car_color2=sql_fetch("select * from option_color where idx='$mod_car[car_color2]' ");
		if($mod_car[car_img]) $car_img=explode("|:|" , $mod_car[car_img]);
		if($mod_car[car_basic]) $car_basic=explode("/" , $mod_car[car_basic]);
		if($mod_car[car_choice1]) $car_choice1=explode("/" , $mod_est[est_choice1]);
		if($mod_car[car_choice2]) $car_choice3=explode("/" , $mod_est[est_choice2]);
		if($mod_car[car_type1]=="화물차"){
			$ch_where="ch_type1";
			$color_where="color_type1";
			$basic_where="basic_type1";
		}
		if($mod_car[car_type1]=="캠핑카"){
			$ch_where="ch_type2";
			$color_where="color_type2";
			$basic_where="basic_type2";
		}
		$option_color1=sql_list("select * from option_color where color_type='1' and ".$color_where."='Y' order by idx desc ");
		$option_color2=sql_list("select * from option_color where color_type='2' and ".$color_where."='Y' order by idx desc ");
		$option_basic=sql_list("select * from option_basic where 1=1 and ".$basic_where."='Y' order by basic_list asc ");
		$option_choice1=sql_list("select * from option_choice where ch_option='1' and ".$ch_where."='Y' order by idx desc ");
		$option_choice3=sql_list("select * from option_choice where ch_option='2' and ".$ch_where."='Y' order by idx desc ");
	}
}
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>견적신청</h2>
    </div>
    <div class="content-container">
      <div class="content-wrap sub estimate-view">
        <div class="table-topper mt-5">
          <div class="prefix"></div>
          <div class="center">
            <!--a href="./sub02_write.php?idx=<?=$idx?>" class="btn btn-outline-secondary btn-sm">수정하기</a-->
            <a href="./sub02.php" class="btn btn-outline-primary btn-sm">목록보기</a>
          </div>
          <div class="suffix">
            <ul class="filter">
              <!--li><a href="javascript:if(confirm('출고차량 등록하시겠습니까?')){document.wform.submit();}">출고차량 등록</a></li-->
              <li><a href="javascript:window.open('./sub02_popup.php?idx=<?=$idx?>', '_blank', 'height=1000, width=840')"><i class="bi bi-printer"></i>견적서인쇄</a></li>
            </ul>
          </div>
        </div>
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub02_save.php">
<input type="hidden" name="out_idx" value="<?=$idx?>">
</form>
        <!-- 문서정보 -->
        <table class="table table-layout border-type">
          <colgroup>
            <col style="width: 100px;">
            <col style="width: 17%">
            <col style="width: 100px;">
            <col style="width: 17%">
            <col style="width: 100px;">
            <col style="width: 17%">
            <col style="width: 100px;">
            <col style="width: 17%">
          </colgroup>
          <tbody class="table-light">
            <tr>
              <th>
                문서
              </th>
              <td>
                <?=$mod_est[est_code]?>
              </td>
              <th>
                일자
              </th>
              <td>
                <?=substr($mod_est[est_regdate],0,10)?>[<?=substr($mod_est[est_regdate],11,2)?>:<?=substr($mod_est[est_regdate],14,2)?>]
              </td>
              <th>
                이름
              </th>
              <td>
                <span class="name">
                  <?=$mod_est[est_name]?>
                </span>
              </td>
              <th>
                연락처
              </th>
              <td>
                <span class="phone">
                  <?=$mod_est[est_phone]?>
                </span>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- //문서정보 -->

<? if($mod_car[idx]){ ?>
        <div class="container-border">
          <div class="container">
            <div class="location"><?=$mod_car[car_type1]?> > <?=$mod_car[car_type2]?></div>
            <section class="description">
              <p class="h2">
                <span class="brand">
                  <?=$sale_car_trim[basic_name]?>
                </span>
                <!--span class="model">
                  포터2
                </span-->
              </p>
              <!-- 슬라이더 -->
              <div class="swiper vehicle-detail-slide">
                <div class="swiper-wrapper">
				  <? for($i=0;$i<count($car_img);$i++){ ?>
                  <div class="swiper-slide">
                    <img src="/data/<?=$car_img[$i]?>" alt="차량상세이미지">
                  </div>
				  <? } ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
              </div>
      
              <!-- 썸네일 -->
              <div class="thumbnail-list">
                <ul>
				  <? for($i=0;$i<count($car_img);$i++){ ?>
                  <li <?=$i==0?'class="on"':''?>>
                    <a href="">
                      <div class="img-wrap">
                        <img src="/data/<?=$car_img[$i]?>" alt="차량상세이미지">
                      </div>
                    </a>
                  </li>
				  <? } ?>
                </ul>
              </div>
      
              <!-- 차량정보 탭 -->
              <div class="tab-wrap vehicle-info">
                <div class="tab-list">
                  <ul>
                    <li class="tab-item on"><a href="">기본설명</a></li>
                    <li class="tab-item"><a href="">부가설명</a></li>
                    <li class="tab-item"><a href="">카탈로그</a></li>
                    <li class="tab-item"><a href="">상세제원</a></li>
                  </ul>
                </div>
                <div class="tab-content-list">
                  <div class="tab-content on" data-tab="0">
                    <div class="info-text">
                      <?=nl2br($mod_car[car_explain])?>
                    </div>
                  </div>
                  <div class="tab-content" data-tab="1">
                    <div class="info-text">
                      <?=nl2br($mod_car[car_add])?>
                    </div>
                  </div>
                  <div class="tab-content" data-tab="2">
                    <div class="catalog">
                      <ul>
						<? if($mod_car[car_catalog1]){ ?>
                        <li>
                          <span class="label"><?=$mod_car[car_catalog1]?></span>
                          <div class="btn-wrap">
                            <button class="btn btn-outline-default btn-download">다운로드 <span class="icon-download"></span></button>
                          </div>
                        </li>
						<? } ?>
						<? if($mod_car[car_catalog2]){ ?>
                        <li>
                          <span class="label"><?=$mod_car[car_catalog2]?></span>
                          <div class="btn-wrap">
                            <button class="btn btn-outline-default btn-download">다운로드 <span class="icon-download"></span></button>
                          </div>
                        </li>
						<? } ?>
						<? if($mod_car[car_catalog3]){ ?>
                        <li>
                          <span class="label"><?=$mod_car[car_catalog3]?></span>
                          <div class="btn-wrap">
                            <button class="btn btn-outline-default btn-download">다운로드 <span class="icon-download"></span></button>
                          </div>
                        </li>
						<? } ?>
                      </ul>
                    </div>
                  </div>
                  <div class="tab-content" data-tab="3">
                    <div class="spec">
					  <? if($mod_car[car_file]){ ?>
                      <img src="/images/salecar/<?=$mod_car[car_file]?>" alt="">
					  <? } ?>
                    </div>
                  </div>
                </div>
              </div>
      
            </section>
      
            <section class="select-options">
              <!-- 리스트 -->
              <div class="option-list">
                <div class="option total-price">
                  <div class="topper-wrap">
                    <span class="label">총 차량 가격</span>
                    <p class="data price"><?=number($mod_est[est_price])?> <em>원</em></p>
                  </div>
                </div>
                <div class="option exterior-color">
                  <div class="topper-wrap">
                    <span class="label">외장색상</span>
                    <p class="data">
                      <?=$car_color1[color_name]?>
                    </p>
                  </div>
                  <div class="color-chip-list">
                    <ul>
                      <!-- 선택시 <li class="selected"> -->
                      <li class="selected">
                        <a href="">
                          <div class="color-chip" style="background-image: url(/images/opt/<?=$car_color1[color_file]?>);"></div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="option interior-color">
                  <div class="topper-wrap">
                    <span class="label">내장색상</span>
                    <p class="data"><?=$car_color2[color_name]?></p>
                  </div>
                  <div class="color-chip-list">
                    <ul>
                      <!-- 선택시 <li class="selected"> -->
                      <li class="selected">
                        <a href="">
                          <div class="color-chip" style="background-image: url(/images/opt/<?=$car_color2[color_file]?>);"></div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

                <!--트림-->
                <div class="option trim">
                  <div class="topper-wrap">
                    <span class="label">트림 선택</span>
                  </div>
                  <div class="trim-list" id="trim_bt">
		<button type="button" class="btn btn-round btn-outline-dark btn-sm on" ><?=$sale_car_trim[basic_price]?></button>
                  </div>
                </div>
                <!--//트림-->
              </div>
			  
  

              <!-- 옵션 탭 -->
              <div class="tab-wrap option-function">
                <div class="tab-list">
                  <ul>
                    <li class="tab-item on"><a href="">차량옵션</a></li>
                    <li class="tab-item"><a href="">특장옵션</a></li>
                  </ul>
                </div>
                <div class="tab-content-list">
                  <div class="tab-content on" data-tab="0">
                    <div class="first-options">
                      <ul>
                        <!-- 선택시 <li class="selected"> -->
<? for($i=0;$i<count($option_choice1);$i++){ ?>
<? if(in_array($option_choice1[$i][idx],$car_choice1)){ ?>
                        <li class="<?=in_array($option_choice1[$i][idx],$car_check3)?"selected":""?>">
                          <div class="item-wrap">
                            <div class="img-wrap">
							<input type="checkbox" class="form-check-input" name="car_check5[]" value="<?=$option_choice1[$i][idx]?>" <?=in_array($option_choice1[$i][idx],$car_check3)?"checked":""?> style="display:none;">
							<? if($option_choice1[$i][ch_file]){ ?>
							  <img src="/images/opt/<?=$option_choice1[$i][ch_file]?>" alt="옵션사진" >
							<? } ?>
                            </div>
                            <div class="title"><?=$option_choice1[$i][ch_name]?>
                              <a href="" class="tooltip toggle-layer-pop">
                                <span class="icon-tooptip" onclick="document.getElementById('pop_title').innerHTML='<?=$option_choice1[$i][ch_name]?>';document.getElementById('pop_img').src='/images/opt/<?=$option_choice1[$i][ch_file]?>';document.getElementById('pop_explain').innerHTML='<?=$option_choice1[$i][ch_explain]?>';document.getElementById('pop_price').innerHTML='<?=number($option_choice1[$i][ch_price])?>원';">!</span>
                              </a>
                            </div>
                            <div class="price">
                              <?=number($option_choice1[$i][ch_price])?>원
                            </div>
                          </div>
                        </li>
<? } ?>
<? } ?>
                      </ul>
                    </div>
                  </div>
                  <div class="tab-content" data-tab="1">
                    <div class="info-text">
                    <div class="first-options">
                      <ul>
                        <!-- 선택시 <li class="selected"> -->
<? for($i=0;$i<count($option_choice3);$i++){ ?>
<? if(in_array($option_choice3[$i][idx],$car_choice3)){ ?>
                        <li class="<?=in_array($option_choice3[$i][idx],$car_check4)?"selected":""?>">
                          <div class="item-wrap">
                            <div class="img-wrap">
							<input type="checkbox" class="form-check-input" name="car_check7[]" value="<?=$option_choice3[$i][idx]?>" <?=in_array($option_choice3[$i][idx],$car_check4)?"checked":""?> style="display:none;">
							<? if($option_choice3[$i][ch_file]){ ?>
							  <img src="/images/opt/<?=$option_choice3[$i][ch_file]?>" alt="옵션사진" >
							<? } ?>
                            </div>
                            <div class="title"><?=$option_choice3[$i][ch_name]?>
                              <a href="" class="tooltip toggle-layer-pop">
                                <span class="icon-tooptip" onclick="document.getElementById('pop_title').innerHTML='<?=$option_choice3[$i][ch_name]?>';document.getElementById('pop_img').src='/images/opt/<?=$option_choice3[$i][ch_file]?>';document.getElementById('pop_explain').innerHTML='<?=$option_choice3[$i][ch_explain]?>';document.getElementById('pop_price').innerHTML='<?=number($option_choice3[$i][ch_price])?>원';">!</span>
                              </a>
                            </div>
                            <div class="price">
                              <?=number($option_choice3[$i][ch_price])?>원
                            </div>
                          </div>
                        </li>
<? } ?>
<? } ?>
                      </ul>
                    </div>
                    </div>
                  </div>
                  <div class="tab-content" data-tab="2">
                    <div class="option-basic">
                      <ul>
					    <?
						for($i=0;$i<count($car_basic);$i++){ 
							  $basic_list=sql_fetch("select * from option_basic where idx='$car_basic[$i]' ");
						?>
                        <li><?=$basic_list[basic_name]?></li>
						<? } ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
<? } ?>
        <div class="table-footer justify-content-center">
          <div class="center">
            <!--a href="./sub02_write.php?idx=<?=$idx?>" class="btn btn-outline-secondary btn-sm">수정하기</a-->
            <a href="./sub02.php" class="btn btn-outline-primary btn-sm">목록보기</a>
          </div>
        </div>
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
      <p class="title" id="pop_title"></p>
      <div class="img-wrap">
        <img src="/images/img_vehicle_detail.png" alt="옵션사진" id="pop_img">
      </div>
      <div class="text-wrap">
        <p id="pop_explain">
        </p>
        <p class="sub-text">
          * 홈페이지의 사진과 설명은 참고용이며 실제 차량에 탑재되는 기능과 설명은 상이할수 있으니, 차량 구입전 카마스터를 통해 확인바랍니다.
        </p>
      </div>
      <div class="price-wrap">
        <div class="price" id="pop_price">원</div>
        <button class="btn btn-primary close-pop">창닫기</button>
      </div>
    </div>
   
  </div>
</body>
</html>
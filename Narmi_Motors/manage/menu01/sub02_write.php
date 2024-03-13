<?
include "../inc/header.php";
include "../inc/menu.php";

if($idx){
	$mod_est=sql_fetch("select * from estimate where idx='$idx' ");
	$sale_car_trim=sql_fetch("select * from option_basic where idx='".$mod_est[trim_idx]."' ");
	$mod_car=sql_fetch("select * from sale_est where idx='$mod_est[car_idx]' ");
	$mod_car_cate=sql_list("select * from category where cate_type1='$mod_car[car_type1]' order by cate_list asc ");
	$mod_car_trim_bt=sql_list("select * from sale_car_trim where car_idx='$idx' order by trim_list asc ");
	$mod_car_trim_new=sql_fetch("select * from sale_car_trim where idx='$mod_est[car_trim_idx]' ");
	$car_check3=explode("/" , $mod_est[est_choice1]);
	$car_check4=explode("/" , $mod_est[est_choice2]);
	
	$trim_option1=explode("/",$mod_car_trim_new[trim_option1]);
	$trim_option2=explode("/",$mod_car_trim_new[trim_option2]);
	if(count($trim_option1)>0){
		$qin=str_replace("/",",",$mod_car_trim_new[trim_option1]);
		$option_choice1_q2="and idx in (".$qin.")";
	}
	if(count($trim_option2)>0){
		$qin2=str_replace("/",",",$mod_car_trim_new[trim_option2]);
		$option_choice2_q2="and idx in (".$qin2.")";
	}
	
	if($mod_car[car_color1]) $car_color1=sql_fetch("select * from option_color where idx='$mod_car[car_color1]' ");
	if($mod_car[car_color2]) $car_color2=sql_fetch("select * from option_color where idx='$mod_car[car_color2]' ");
	if($mod_car[car_img]) $car_img=explode("|:|" , $mod_car[car_img]);
	if($mod_car[car_basic]) $car_basic=explode("/" , $mod_car[car_basic]);
	if($mod_car[car_choice1]) $car_choice1=explode("/" , $mod_car[car_choice1]);
	if($mod_car[car_choice2]) $car_choice2=explode("/" , $mod_car[car_choice2]);
	if($mod_car[car_type1]=="화물차"){
		$option_color1=sql_list("select * from option_color where color_type='1' and color_type1='Y' and del='N' order by idx desc ");
		$option_color2=sql_list("select * from option_color where color_type='2' and color_type1='Y' and del='N' order by idx desc ");
		$option_basic1=sql_list("select * from option_basic where basic_type1='Y' and del='N' order by basic_list asc ");
		$option_choice1=sql_list("select * from option_choice where ch_option='1' and ch_type1='Y' and del='N' ".$option_choice1_q2." order by idx desc ");
		$option_choice3=sql_list("select * from option_choice where ch_option='2' and ch_type1='Y' and del='N' ".$option_choice2_q2." order by idx desc ");
	}
	if($mod_car[car_type1]=="캠핑카"){
		$option_color1=sql_list("select * from option_color where color_type='1' and color_type2='Y' and del='N' order by idx desc ");
		$option_color2=sql_list("select * from option_color where color_type='2' and color_type2='Y' and del='N' order by idx desc ");
		$option_basic1=sql_list("select * from option_basic where basic_type2='Y' and del='N' order by basic_list asc ");
		$option_choice1=sql_list("select * from option_choice where ch_option='1' and ch_type2='Y' and del='N' ".$option_choice1_q2." order by idx desc ");
		$option_choice3=sql_list("select * from option_choice where ch_option='2' and ch_type2='Y' and del='N' ".$option_choice2_q2." order by idx desc ");
	}
}
?>
<script>
 
var upfile_num=1;
var num=0;
var img_count=0;

  function fileInfo(f){
    var file = f.files; // files 를 사용하면 파일의 정보를 알 수 있음
    // 파일의 갯수만큼 반복
    for(var i=0; i<file.length; i++){
       if(img_count==10){ alert('사진은 10개까지 등록 가능합니다.');break;  }
       
      var reader = new FileReader(); // FileReader 객체 사용
      reader.onload = function(rst){
		  if(img_count<10){
			$('#img_box').append('<img src="' + rst.target.result + '"width="95" height="82" id="num'+num+'" data-image="tmp'+num+'" class="imgs"><input type=hidden name="tmpfile[]" value="'+ num +'"  id="tmp'+num+'" class="imgnames">'); // append 메소드를 사용해서 이미지 추가
			// 이미지는 base64 문자열로 추가
			// 이 방법을 응용하면 선택한 이미지를 미리보기 할 수 있음
		  num++; img_count++; 
		  document.getElementById("img_count").innerHTML=img_count;
		  }else{
			  alert('사진은 10개까지 등록 가능합니다.');
		  }
      }
       
      reader.readAsDataURL(file[i]); // 파일을 읽는다
 
    }
	upfile_num++;
  }
 
 
$(document).on("click","#img_box .imgs",function(){
      $(this).remove();
	  dataimg = $(this).data('image');
		$("#"+dataimg).remove();
		img_count--;
    document.getElementById("img_count").innerHTML=img_count;
}); 

$(document).on("click","#img_del",function(){
	$(".imgs").remove();
	$(".imgnames").remove();
	img_count=0;
    document.getElementById("img_count").innerHTML=0;
}); 

function file_click(){
	document.getElementById('uf'+upfile_num).click();
}

function delete_member(){
		
	f=document.outForm;
	result = confirm("한번 삭제하신 자료는 복구 불가능 합니다 \n정말 삭제 하시겠습니까??");
	if(result){
		f.action="image_alldel.php";
		f.submit();
	}
	
}	

function all_check(ty){
	if(ty==1){
		var obj = document.getElementsByName('check_img[]');
		for(var i=0;i < obj.length ; i++){
			obj[i].checked = true;
		}
	} else {
		var obj = document.getElementsByName('check_img[]');
		for(var i=0;i < obj.length ; i++){
			obj[i].checked = false;
		}
	}
}
</script>

    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>견적서 수정</h2>
    </div>
    <div class="content-container">

      <div class="container-fluid add-product estimate-write">
        <div class="row">
          <div class="col-12">
            <div class="table-topper justify-content-center mt-5">
              <div class="center">
                <a href="" class="btn btn-outline-secondary btn-sm">등록하기</a>
                <a href="sub02.php" class="btn btn-outline-primary btn-sm">목록보기</a>
              </div>
            </div>
          </div>
        </div>
        <!-- 정보요약 -->
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
        <!-- //정보요약 -->

        <div class="row front-width">
          <div class="col-12">
            <div class="location">
              <?=$mod_car[car_type1]?> > <?=$mod_car[car_type2]?>
            </div>
          </div>
        </div>
        <!-- 기본정보 테이블 -->
        <div class="row border-right front-width">
          <div class="col-7">
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
          </div>
          <!-- 기본옵션 테이블 -->
          <div class="col-5">
            <section class="select-options select-one">
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
<? for($i=0;$i<count($option_color1);$i++){ ?>
                      <li class="<?=$option_color1[$i][idx]==$car_color1[idx]?"selected":""?>" id="outcolor1<?=$i?>">
                        <a href="" onclick="c_ch(<?=$i?>, this);">
                          <div class="color-chip" style="background-image: url(/images/opt/<?=$option_color1[$i][color_file]?>);" ></div>
                        </a>
                        <span class="color-name"><?=$option_color1[$i][color_name]?><?=$car_color1[car_color1]?></span>
                      </li>
<? } ?>
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
<? for($i=0;$i<count($option_color2);$i++){ ?>
                      <li class="<?=$option_color2[$i][idx]==$car_color2[idx]?"selected":""?>" id="outcolor3<?=$i?>">
                        <a href="" onclick="c_ch3(<?=$i?>);">
                          <div class="color-chip" style="background-image: url(/images/opt/<?=$option_color2[$i][color_file]?>);" ></div>
                        </a>
                        <span class="color-name"><?=$option_color2[$i][color_name]?></span>
                      </li>
<? } ?>
                    </ul>
                  </div>
                  <div class="option trim">
                    <div class="topper-wrap">
                      <span class="label">트림 선택</span>
                    </div>
                    <div class="trim-list" id="trim_bt">

		<button type="button" id="btn_ch<?=$mod_car_trim_one[idx]?>" class="btn btn-round btn-outline-dark btn-sm on" ><?=$sale_car_trim[basic_price]?></button>

                    </div>
                  </div>
                </div>
              </div>
      
              <!-- 옵션 탭 -->
              <div class="tab-wrap option-function">
                <div class="tab-list">
                  <ul>
                    <li class="tab-item on"><a href="">차량옵션</a></li>
                    <li class="tab-item"><a href="">특장옵션</a></li>
                    <!--li class="tab-item"><a href="">기본옵션</a></li-->
                  </ul>
                </div>
                <div class="tab-content-list">
                  <div class="tab-content on" data-tab="0">
                    <div class="first-options" id="choice1">
                      <ul>
<? for($i=0;$i<count($option_choice1);$i++){ ?>
                        <li class="<?=in_array($option_choice1[$i][idx],$car_check3)?"selected":""?>" id="oc<?=$i?>">
                          <div class="item-wrap" onclick="c_ch5(<?=$i?>,0,<?=$option_choice1[$i][ch_price]?>);">
                            <div class="img-wrap">
                              <img src="/images/opt/<?=$option_choice1[$i][ch_file]?>" alt="옵션사진" >
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
                      </ul>
                    </div>
                  </div>
                  <div class="tab-content" data-tab="1">
                    <div class="info-text">
                    <div class="first-options" id="choice3">
                      <ul>
                        <!-- 선택시 <li class="selected"> -->
<? for($i=0;$i<count($option_choice3);$i++){ ?>
                        <li class="<?=in_array($option_choice3[$i][idx],$car_check4)?"selected":""?>" id="oc3<?=$i?>">
                          <div class="item-wrap" onclick="c_ch7(<?=$i?>,0,<?=$option_choice3[$i][ch_price]?>);">
                            <div class="img-wrap">
                              <img src="/images/opt/<?=$option_choice3[$i][ch_file]?>" alt="옵션사진" >
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
                      </ul>
                    </div>
                    </div>
                  </div>
                  <div class="tab-content" data-tab="2">
                    <div class="first-options">
                      <ul>
					    <?
						for($i=0;$i<count($option_basic1);$i++){ 
						?>
                        <li>
                          <div class="row">
                            <div class="col-9">
                              <input type="checkbox" name="car_basic1[]" value="1" id="option01" class="form-check-input" <?=in_array($option_basic1[$i][idx],$car_basic)?"checked":""?>>
                              <label for="option01"><?=$option_basic1[$i][basic_name]?></label>
                            </div>
                            <div class="col-3">
                              <div class="align-r">
                                <?=number($option_basic1[$i][basic_price])?>원
                              </div>
                            </div>
                          </div>
                        </li>
						<? } ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
      
            </section>
          </div>
          <!-- //기본옵션 테이블 -->
          
        </div>
        <!-- //기본정보 테이블 -->


        <div class="table-footer justify-content-center mt-5 mb-5">
          <div class="center">
            <a href="" class="btn btn-outline-secondary btn-sm">등록하기</a>
            <a href="sub02.php" class="btn btn-outline-primary btn-sm">목록보기</a>
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
<?
include "../inc/header.php";
include "../inc/menu_sub.php";

$image_sub=sql_fetch("select * from image_sub where sub_type='sub' and sub_menu='화물차' order by idx desc ");
if($idx){
	$mod_car=sql_fetch("select * from sale_car where idx='$idx' ");
	$mod_car_name=sql_fetch("select * from option_basic where idx='".$mod_car[car_name]."' ");
	$mod_car_trim=sql_fetch("select * from sale_car_trim where car_idx='$idx' order by trim_list asc ");
	if($mod_car[car_color1]) $car_color1=explode("/",$mod_car[car_color1]);
	if($car_color1[0]) $mod_color1=sql_fetch("select * from option_color where idx='$car_color1[0]' ");
	if($mod_car[car_color2]) $car_color2=explode("/",$mod_car[car_color2]);
	if($car_color2[0]) $mod_color2=sql_fetch("select * from option_color where idx='$car_color2[0]' ");
	if(count($car_color1)>0){
		if($mod_car[car_color3]){
			$car_color=explode("/",$mod_car[car_color]);
			$car_color3=explode("/",$mod_car[car_color3]);
			unset($trim_l);unset($trim_l2);
			for($j=0;$j<count($car_color);$j++){
				if($car_color[$j]&&$car_color3[$j]){
				$trim_l[$car_color[$j]]=$car_color3[$j];
				}
			}
			asort($trim_l);
			$trim_l2=array_keys($trim_l);
			$trim_l2=implode(",",$trim_l2);
			$qin=str_replace("/",",",$mod_car[car_color1]);
				if($mod_car[car_type1]=="화물차"){
					if(count($trim_l)>0){
					$car_color1=sql_list("select * from option_color where color_type='1' and color_type1='Y' and del='N' and idx in (".$qin.") order by field (idx,".$trim_l2.")");
					}else{
					$car_color1=sql_list("select * from option_color where color_type='1' and color_type1='Y' and del='N' and idx in (".$qin.") order by idx desc ");
					}
				}else if($mod_car[car_type1]=="캠핑카"){
					if(count($trim_l)>0){
					$car_color1=sql_list("select * from option_color where color_type='1' and color_type2='Y' and del='N' and idx in (".$qin.") order by field (idx,".$trim_l2.")");
					}else{
					$car_color1=sql_list("select * from option_color where color_type='1' and color_type2='Y' and del='N' and idx in (".$qin.") order by idx desc ");
					}
				}
			$mod_color1=sql_fetch("select * from option_color where idx='".$car_color1[0][idx]."' ");
		}else{
			$qin=str_replace("/",",",$mod_car[car_color1]);
			if($mod_car[car_type1]=="화물차"){
				$car_color1=sql_list("select * from option_color where color_type='1' and color_type1='Y' and del='N' and idx in (".$qin.") order by idx desc ");
			}else if($mod_car[car_type1]=="캠핑카"){
				$car_color1=sql_list("select * from option_color where color_type='1' and color_type2='Y' and del='N' and idx in (".$qin.") order by idx desc ");
			}
		}
	}
	if($mod_car[car_check1]) $car_check1=explode("/" , $mod_car[car_check1]);
	$mod_color1=sql_fetch("select * from option_color where idx='".$car_check1[0]."' ");
	if($mod_car[car_check2]) $car_check2=explode("/" , $mod_car[car_check2]);
	$mod_color2=sql_fetch("select * from option_color where idx='".$car_check2[0]."' ");
	if($mod_car[car_img]) $car_img=explode("|:|" , $mod_car[car_img]);
	if($mod_car[car_basic]) $car_basic=explode("/" , $mod_car[car_basic]);
	if($trim_idx){
		$mod_car_trim_new=sql_fetch("select * from sale_car_trim where idx='$trim_idx' ");
		$mod_car_trim_name=sql_fetch("select * from option_basic where idx='$mod_car_trim_new[trim_idx]' ");
		$car_choice1=explode("/" , $mod_car_trim_new[trim_option1]);
		$car_choice3=explode("/" , $mod_car_trim_new[trim_option2]);
		$car_check3=explode("/" , $mod_car_trim_new[trim_option3]);
		$car_check4=explode("/" , $mod_car_trim_new[trim_option4]);

		if($mod_car[car_type1]=="화물차"){
			$choice1_l=sql_list("select * from option_choice where ch_option='1' and ch_type1='Y' and del='N' order by idx desc ");
			$choice2_l=sql_list("select * from option_choice where ch_option='2' and ch_type1='Y' and del='N' order by idx desc ");
		}else if($mod_car[car_type1]=="캠핑카"){
			$choice1_l=sql_list("select * from option_choice where ch_option='1' and ch_type2='Y' and del='N' order by idx desc ");
			$choice2_l=sql_list("select * from option_choice where ch_option='2' and ch_type2='Y' and del='N' order by idx desc ");
		}

		$car_list1=explode("/",$mod_car_trim_new[trim_list1]);
		for($j=0;$j<count($car_list1);$j++){
			$trim_list1_new=explode("|" , $car_list1[$j]);
			if($trim_list1_new[1]){
				$trim_l[$trim_list1_new[0]]=$trim_list1_new[1];
			}
		}
		asort($trim_l);
		$trim_l2=array_keys($trim_l);
		$trim_l2=implode(",",$trim_l2);
		if($trim_l2){
			$option_choice1_q2=" order by field (idx,".$trim_l2.") , idx desc ";
		}else{
			$option_choice1_q2=" order by idx desc ";
		}

		unset($trim_l);unset($trim_l2);
		$car_list2=explode("/",$mod_car_trim_new[trim_list2]);
		for($j=0;$j<count($car_list2);$j++){
			$trim_list2_new=explode("|" , $car_list2[$j]);
			if($trim_list2_new[1]){
				$trim_l[$trim_list2_new[0]]=$trim_list2_new[1];
			}
		}
		asort($trim_l);
		$trim_l2=array_keys($trim_l);
		$trim_l2=implode(",",$trim_l2);
		if($trim_l2){
			$option_choice2_q2=" order by field (idx,".$trim_l2.") , idx desc ";
		}else{
			$option_choice2_q2=" order by idx desc ";
		}
	}
	$trim_price=$mod_car_trim_new[trim_price]-$mod_car[car_price];
	if($mod_car[car_type1]=="화물차"){
		$option_color1=sql_list("select * from option_color where color_type='1' and color_type1='Y' and del='N' order by idx desc ");
		$option_color2=sql_list("select * from option_color where color_type='2' and color_type1='Y' and del='N' order by idx desc ");
		$option_choice1=sql_list("select * from option_choice where ch_option='1' and ch_type1='Y' and del='N'   ".$option_choice1_q2);
		$option_choice3=sql_list("select * from option_choice where ch_option='2' and ch_type1='Y' and del='N'  ".$option_choice2_q2);
	}
	if($mod_car[car_type1]=="캠핑카"){
		$option_color1=sql_list("select * from option_color where color_type='1' and color_type2='Y' and del='N' order by idx desc ");
		$option_color2=sql_list("select * from option_color where color_type='2' and color_type2='Y' and del='N' order by idx desc ");
		$option_choice1=sql_list("select * from option_choice where ch_option='1' and ch_type2='Y' and del='N'  ".$option_choice1_q2);
		$option_choice3=sql_list("select * from option_choice where ch_option='2' and ch_type2='Y' and del='N' ".$option_choice2_q2);
	}
	$sale_out=sql_list("select * from sale_out where car_state='1' and car_name='$mod_car[car_name]' order by idx desc ");
}

?>
<script>
function numberNullChk(obj){
	if(!obj){
		var val = 0;
	}else{
		 var re = /^$|,/g; 
         var val = obj.replace(re, ""); 
	}
	return val;
}
function addComma (str)
{
	 var input_str = str.toString();

	 if (input_str == '') return false;
	 input_str = parseInt(input_str.replace(/[^0-9]/g, '')).toString();
	 if (isNaN(input_str)) { return false; }

	 var sliceChar = ',';
	 var step = 3;
	 var step_increment = -1;
	 var tmp  = '';
	 var retval = '';
	 var str_len = input_str.length;

	 for (var i=str_len; i>=0; i--)
	 {
	  tmp = input_str.charAt(i);
	  if (tmp == sliceChar) continue;
	  if (step_increment%step == 0 && step_increment != 0) retval = tmp + sliceChar + retval;
	  else retval = tmp + retval;
	  step_increment++;
	 }

	 return retval;
}

var ch_price_sum=new Array();
ch_price_sum[0]=<?=$trim_price?>;

function c_ch5(num,trim,ch_price){
	var n=parseInt(numberNullChk(document.wform.car_price.value));
	if(!ch_price_sum[trim]) ch_price_sum[trim]=0;
	var c=document.getElementsByName("car_check5[]");
	if(c[num].checked == true){
		c[num].checked = false;
		ch_price_sum[trim]=parseInt(ch_price_sum[trim])-parseInt(ch_price);
	}else{
		c[num].checked = true;
		ch_price_sum[trim]=parseInt(ch_price_sum[trim])+parseInt(ch_price);
	}
	var nn=n+ch_price_sum[trim];
	document.wform.trim_price.value=nn;
	document.getElementById('c_price').innerHTML=addComma(nn)+' <em>원</em>';
	document.getElementById('float_write_3').innerHTML=addComma(nn);
}

function c_ch7(num,trim,ch_price){
	var n=parseInt(numberNullChk(document.wform.car_price.value));
	if(!ch_price_sum[trim]) ch_price_sum[trim]=0;
	var c=document.getElementsByName("car_check7[]");
	if(c[num].checked == true){
		c[num].checked = false;
		ch_price_sum[trim]=parseInt(ch_price_sum[trim])-parseInt(ch_price);
	}else{
		c[num].checked = true;
		ch_price_sum[trim]=parseInt(ch_price_sum[trim])+parseInt(ch_price);
	}
	var nn=n+ch_price_sum[trim];
	document.wform.trim_price.value=nn;
	document.getElementById('c_price').innerHTML=addComma(nn)+' <em>원</em>';
	document.getElementById('float_write_3').innerHTML=addComma(nn);
}

</script>

  
  <div class="sub-visual">
    <!-- 서브비주얼 -->
    <img src="/images/img/<?=$image_sub[sub_file]?>" alt="">
    <!-- <div class="title">
      <p class="catch-phrase">대한민국의 운송장비의 성공신화 !!</p>
      <p class="sub-text">화물차! 특장차! 캠핑카! 책임있고 오랜경험을 고객님들과 함께 합니다. </p>
      <p class="third-text">TEL  1588-1277 , FAX  02-794-3300</p>
    </div> -->
  </div>
  <div class="content-wrap sub store-detail">
    <div class="anchor-wrap">
      <a href="#" class="anchor"></a>
    </div>
    <section class="greeting-header">
      <div class="container">
        <div class="prefix">
          <div class="home">
            <a href="/" class="btn-home">
              <span class="icon-home"></span>
            </a>
          </div>
          <div class="location">
            <span>&gt;</span>
            <a href="/menu02/sub01.php"><span><?=$mod_car[car_type1]?></span></a>
            <span>&gt;</span>
            <span><?=$mod_car[car_type2]?></span>
          </div>
        </div>
        <div class="suffix">
          <a href="javascript:history.back();">
            <img src="/front/src/image/icon_menu_sm.jpg" alt="메뉴아이콘" class="icon">
            목록보기
          </a>
        </div>
      </div>
      
    </section>
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub01_save.php">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="trim_idx" value="<?=$trim_idx?>">
<input type="hidden" name="car_color1" value="<?=$option_color1[0][idx]?>">
<input type="hidden" name="car_color2" value="<?=$option_color2[0][idx]?>">
<input type="hidden" name="t_price" value="<?=$mod_car[car_price]?>">
<input type="hidden" name="car_price" value="<?=$mod_car[car_price]?>">
<input type="hidden" name="trim_price" value="<?=$mod_car_trim_new[trim_price]?>">
<input type="hidden" name="select_value" value="">
<input type="hidden" name="select_type" value="">
    <div class="container-border">
      <div class="container">
        <section class="description">
          <p class="h2">
            <span class="brand">
              <?=$mod_car_name[basic_name]?>
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
                <li class="tab-item on"><a href="">특장설명</a></li>
                <li class="tab-item"><a href="">차량설명</a></li>
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
                      <?=nl2br($mod_car_trim_new[trim_explain])?>
                </div>
              </div>
              <div class="tab-content" data-tab="2">
                <div class="catalog">
                  <ul>
						<? if($mod_car[car_catalog1]){ ?>
                        <li>
                          <span class="label"><?=$mod_car[car_catalog1]?></span>
                          <div class="btn-wrap">
                            <button type="button" class="btn btn-outline-default btn-download" onclick="location.href='/manage/inc/download_catalog.php?filename=<?=$mod_car[car_catalog1]?>';">다운로드 <span class="icon-download"></span></button>
                          </div>
                        </li>
						<? } ?>
						<? if($mod_car[car_catalog2]){ ?>
                        <li>
                          <span class="label"><?=$mod_car[car_catalog2]?></span>
                          <div class="btn-wrap">
                            <button type="button" class="btn btn-outline-default btn-download" onclick="location.href='/manage/inc/download_catalog.php?filename=<?=$mod_car[car_catalog2]?>';">다운로드 <span class="icon-download"></span></button>
                          </div>
                        </li>
						<? } ?>
						<? if($mod_car[car_catalog3]){ ?>
                        <li>
                          <span class="label"><?=$mod_car[car_catalog3]?></span>
                          <div class="btn-wrap">
                            <button type="button" class="btn btn-outline-default btn-download" onclick="location.href='/manage/inc/download_catalog.php?filename=<?=$mod_car[car_catalog3]?>';">다운로드 <span class="icon-download"></span></button>
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
  
          <p class="h3">
            해당차량관련 출고현황
            <a href="" class="btn-more">+ 더보기</a>
          </p>
          <!-- 차량출고현황 리스트 -->
          <div class="released-products">
            <ul>
<?
for($i=0;$i<count($sale_out);$i++){
	unset($car_img);
	if($sale_out[$i][car_img]) $car_img=explode("|:|" , $sale_out[$i][car_img]);
	$sale_out_trim=sql_fetch("select * from option_basic where idx='".$sale_out[$i][car_name]."' ");
	$list_car_trim=sql_fetch("select * from sale_out_trim where car_idx='".$sale_out[$i][idx]."' order by trim_list asc ");
?>
              <li>
                <a href="/menu04/sub01_view.php?idx=<?=$sale_out[$i][idx]?>&trim_idx=<?=$list_car_trim[idx]?>">
                  <div class="img-wrap">
				  <? if($car_img[0]){ ?>
                    <img src="/data/<?=$car_img[0]?>" alt="차량썸네일">
				  <? } ?>
                  </div>
                  <div class="title"><?=$sale_out_trim[basic_name]?></div>
                  <div class="price"><?=number($list_car_trim[trim_price])?>원</div>
                </a>
              </li>
<? } ?>
            </ul>
          </div>
        </section>
  
      <section class="select-options">
          <p class="h2">내차만들기(견적)</p>
          <!-- 리스트 -->
          <div class="option-list">
            <div class="option total-price">
              <div class="topper-wrap">
                <span class="label">총 차량 가격</span>
                <p class="data price" id="c_price"><?=number($mod_car_trim_new[trim_price])?> <em>원</em></p>
              </div>
            </div>
            <div class="option exterior-color">
              <div class="topper-wrap">
                <span class="label">외장색상</span>
                <p class="data" id="colorname1">
                  <?=$mod_color1[color_name]?>
                </p>
              </div>
              <div class="color-chip-list">
                <ul>
                      <!-- 선택시 <li class="selected"> -->
					  <? for($i=0;$i<count($car_color1);$i++){ 
					  $option_color1=sql_fetch("select * from option_color where idx='$car_color1[$i]' ");
					  ?>
                      <li <?=in_array($car_color1[$i][idx],$car_check1)?'class="selected"':""?>>
                        <a href="">
                          <div class="color-chip" style="background-image: url(/images/opt/<?=$car_color1[$i][color_file]?>);" onclick="document.wform.car_color1.value='<?=$car_color1[$i][idx]?>';document.getElementById('colorname1').innerHTML='<?=$car_color1[$i][color_name]?>';"></div>
                        </a>
                      </li>
					  <? } ?>
                </ul>
              </div>
            </div>
            <div class="option interior-color">
              <div class="topper-wrap">
                <span class="label">내장색상</span>
                <p class="data" id="colorname2"><?=$mod_color2[color_name]?></p>
              </div>
              <div class="color-chip-list">
                <ul>
					  <? for($i=0;$i<count($car_color2);$i++){ 
					  $option_color2=sql_fetch("select * from option_color where idx='$car_color2[$i]' ");
					  ?>
                      <li <?=in_array($option_color2[idx],$car_check2)?'class="selected"':""?>>
                        <a href="">
                          <div class="color-chip" style="background-image: url(/images/opt/<?=$option_color2[color_file]?>);" onclick="document.wform.car_color2.value='<?=$option_color2[idx]?>';document.getElementById('colorname2').innerHTML='<?=$option_color2[color_name]?>';"></div>
                        </a>
                      </li>
					  <? } ?>
                </ul>
              </div>
            </div>
            <div class="option trim">
              <div class="topper-wrap">
                <span class="label">트림 선택</span>
              </div>
              <div class="trim-list" id="trim_bt">
<?
		$trim_list=sql_list("select * from sale_car_trim where car_idx='$idx' order by trim_list asc ");
		for($i=0;$i<count($trim_list);$i++){
			if(!$trim_first) $trim_first=$trim_list[$i][trim_idx];
			$trim_name=sql_fetch("select * from option_basic where idx='".$trim_list[$i][trim_idx]."' ");
?>
                <button type="button" class="btn btn-round btn-outline-dark btn-sm <?=$trim_list[$i][idx]==$trim_idx?"on":""?>" onclick="location.href='sub01_view.php?idx=<?=$idx?>&trim_idx=<?=$trim_list[$i][idx]?>';"><?=$trim_name[basic_price]?></button>
<?
		}
?>
              </div>
            </div>
          </div>

              <script>
                // 클릭된 버튼 활성화
                // description: 위의 트림 리스트 불러온뒤 아래 스크립트 실행되게해야함
                $('#trim_bt button').on('click', function(e){
                  console.log($(this));
                  $(this).addClass('on').siblings('button').removeClass('on');
                })
              </script>
  
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

				<div class="first-options" id="choice<?=$sale_trim[$i][idx]?>" >
                  <ul>
<? $k=0; ?>
<? for($i=0;$i<count($option_choice1);$i++){ ?>
<? if(in_array($option_choice1[$i][idx],$car_choice1)){ ?>
                        <li class="<?=in_array($option_choice1[$i][idx],$car_check3)?"selected":""?>">
                          <div class="item-wrap" onclick="c_ch5(<?=$k?>,0,<?=$option_choice1[$i][ch_price]?>);">
                            <div class="img-wrap">
							<input type="checkbox" class="form-check-input" name="car_check5[]" value="<?=$option_choice1[$i][idx]?>" <?=in_array($option_choice1[$i][idx],$car_check3)?"checked":""?> style="display:none;">
							<? if($option_choice1[$i][ch_file]){ ?>
							  <img src="/images/opt/<?=$option_choice1[$i][ch_file]?>" alt="옵션사진" >
							<? } ?>
                            </div>
                            <div class="title"><?=$option_choice1[$i][ch_name]?>
                              <a href="" class="tooltip toggle-layer-pop">
                                <span class="icon-tooptip" onclick="document.getElementById('l_pop1').innerHTML='<?=$option_choice1[$i][ch_name]?>';document.getElementById('l_pop2').src='/images/opt/<?=$option_choice1[$i][ch_file]?>';document.getElementById('l_pop3').innerHTML='<?=nl2br($option_choice1[$i][ch_explain])?>';document.getElementById('l_pop4').innerHTML='<?=number($option_choice1[$i][ch_price])?>원';document.wform.select_value.value=<?=$i?>;document.wform.select_type.value=1;">!</span>
                              </a>
                            </div>
                            <div class="price">
                              <?=number($option_choice1[$i][ch_price])?>원
							  <input type="checkbox" class="form-check-input" name="car_check3[]" value="<?=$option_choice1[$i][idx]?>" style="display:none;">
                            </div>
                          </div>
                        </li>
<? $k++; ?>
<? } ?>
<? } ?>
                  </ul>
                </div>
              </div>
              <div class="tab-content" data-tab="1">
                <div class="info-text">
                    <div class="first-options" id="choice_<?=$sale_trim[$i][idx]?>" >
                      <ul>
                        <!-- 선택시 <li class="selected"> -->
<? $k=0; ?>
<? for($i=0;$i<count($option_choice3);$i++){ ?>
<? if(in_array($option_choice3[$i][idx],$car_choice3)){ ?>
                        <li class="<?=in_array($option_choice3[$i][idx],$car_check4)?"selected":""?>">
                          <div class="item-wrap" onclick="c_ch7(<?=$k?>,0,<?=$option_choice3[$i][ch_price]?>);">
                            <div class="img-wrap">
							<input type="checkbox" class="form-check-input" name="car_check7[]" value="<?=$option_choice3[$i][idx]?>" <?=in_array($option_choice3[$i][idx],$car_check4)?"checked":""?> style="display:none;">
							<? if($option_choice3[$i][ch_file]){ ?>
							  <img src="/images/opt/<?=$option_choice3[$i][ch_file]?>" alt="옵션사진" >
							<? } ?>
                            </div>
                            <div class="title"><?=$option_choice3[$i][ch_name]?>
                              <a href="" class="tooltip toggle-layer-pop">
                                <span class="icon-tooptip" onclick="document.getElementById('l_pop1').innerHTML='<?=$option_choice3[$i][ch_name]?>';document.getElementById('l_pop2').src='/images/opt/<?=$option_choice3[$i][ch_file]?>';document.getElementById('l_pop3').innerHTML='<?=nl2br($option_choice3[$i][ch_explain])?>';document.getElementById('l_pop4').innerHTML='<?=number($option_choice3[$i][ch_price])?>원';">!</span>
                              </a>
                            </div>
                            <div class="price">
                              <?=number($option_choice3[$i][ch_price])?>원
							  <input type="checkbox" class="form-check-input" name="car_check4[]" value="<?=$option_choice3[$i][idx]?>" style="display:none;">
                            </div>
                          </div>
                        </li>
<? $k++; ?>
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
  
          <!-- 견적 다운로드 -->
          <div class="estimate-download">
            <div class="topper-wrap">
              <span class="label">내차만들기 견적 다운로드</span>
            </div>
            <div class="form">
              <ul>
                <li>
                  <label>이름</label>
                  <div class="input-wrap">
                    <input type="text" name="est_name">
                  </div>
                </li>
                <li>
                  <label>연락처</label>
                  <div class="input-wrap">
                    <input type="text" name="est_phone">
                  </div>
                </li>
              </ul>
              <div class="check-wrap">
                <input type="checkbox" name="agree" id="agreeForNarmi" value="Y"/>
                <label for="agreeForNarmi">
                  나르미에게도 견적서가 제출됨에 동의합니다.
                </label>
              </div>
              <div class="btn-wrap">
                <button class="btn btn-secondary md">견적 다운로드</button>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </form>
  
<?
  include "../inc/consult_form.php";
?>
<div class="floating-bar">
  <div class="container">
    <span><?=$mod_car_name[basic_name]?> ㅣ </span><span><?=$mod_car_trim_name[basic_price]?> ㅣ </span>
    <span class="price-label">총차량가격</span>
    <span class="price" id="float_write_3"><?=number($mod_car_trim_new[trim_price])?></span><span class="price-unit">원</span>
  </div>
</div>
<?
  include "../inc/footer.php";
?>

  <!-- 레이어팝업 -->
  <div class="dim">
  </div>
  <div class="layer-pop">
    <a href="" class="btn-close" id="pop_close">
      <span class="bar"></span>
      <span class="bar"></span>
    </a>
    <div class="body">
      <p class="title" id="l_pop1"></p>
      <div class="img-wrap">
        <img src="/front/src/image/sample/img_vehicle_detail.png" alt="옵션사진" id="l_pop2">
      </div>
      <div class="text-wrap">
        <p id="l_pop3">
        </p>
        <p class="sub-text">
          * 홈페이지의 사진과 설명은 참고용이며 실제 차량에 탑재되는 기능과 설명은 상이할수 있으니, 차량 구입전 카마스터를 통해 확인바랍니다.
        </p>
      </div>
      <div class="price-wrap">
        <div class="price" id="l_pop4">원</div>
        <button class="btn btn-secondary btn-close-bottom" onclick="add_button()">창닫기</button>
      </div>
    </div>
   
  </div>
</body>
</html>

<script>
var arr_pr=new Array();
var arr_pr2=new Array();
<?
	for($i=0;$i<count($car_choice1);$i++){ 
		$option_choice1=sql_fetch("select * from option_choice where idx='$car_choice1[$i]' ");
?>
arr_pr[<?=$i?>]=<?=$option_choice1[ch_price]?>;
<? } ?>
<?
	for($i=0;$i<count($car_choice2);$i++){ 
		$option_choice2=sql_fetch("select * from option_choice where idx='$car_choice2[$i]' ");
?>
arr_pr2[<?=$i?>]=<?=$option_choice2[ch_price]?>;
<? } ?>

function c_ch3(num){
	var c=document.getElementsByName("car_check3[]");
	if(c[num].checked == true){
		c[num].checked = false;
		document.wform.t_price.value=parseInt(document.wform.t_price.value)-arr_pr[num];
		t_value=Number(document.wform.t_price.value);
		const formatValue=t_value.toLocaleString('ko-KR');
		document.getElementById('tot_price').innerHTML=formatValue+" <em>원</em>";
	}else{
		c[num].checked = true;
		document.wform.t_price.value=parseInt(document.wform.t_price.value)+arr_pr[num];
		t_value=Number(document.wform.t_price.value);
		const formatValue=t_value.toLocaleString('ko-KR');
		document.getElementById('tot_price').innerHTML=formatValue+" <em>원</em>";
	}
}

function c_ch4(num){
	var c=document.getElementsByName("car_check4[]");
	if(c[num].checked == true){
		c[num].checked = false;
		document.wform.t_price.value=parseInt(document.wform.t_price.value)-arr_pr2[num];
		t_value=Number(document.wform.t_price.value);
		const formatValue=t_value.toLocaleString('ko-KR');
		document.getElementById('tot_price').innerHTML=formatValue+" <em>원</em>";
	}else{
		c[num].checked = true;
		document.wform.t_price.value=parseInt(document.wform.t_price.value)+arr_pr2[num];
		t_value=Number(document.wform.t_price.value);
		const formatValue=t_value.toLocaleString('ko-KR');
		document.getElementById('tot_price').innerHTML=formatValue+" <em>원</em>";
	}
}

function add_button(){
	var type=document.wform.select_type.value;
	var num=document.wform.select_value.value;
	if(type=="1"){
		var c=document.getElementsByName("car_check3[]");
		if(c[num].checked == false){
			c[num].checked = true;
			document.wform.t_price.value=parseInt(document.wform.t_price.value)+arr_pr[num];
			t_value=Number(document.wform.t_price.value);
			const formatValue=t_value.toLocaleString('ko-KR');
			document.getElementById('tot_price').innerHTML=formatValue+" <em>원</em>";
		}
	}else if(type=="2"){
		var c=document.getElementsByName("car_check4[]");
		if(c[num].checked == false){
			c[num].checked = true;
			document.wform.t_price.value=parseInt(document.wform.t_price.value)+arr_pr[num];
			t_value=Number(document.wform.t_price.value);
			const formatValue=t_value.toLocaleString('ko-KR');
			document.getElementById('tot_price').innerHTML=formatValue+" <em>원</em>";
		}
	}
	document.getElementById('pop_close').click();
}
</script>

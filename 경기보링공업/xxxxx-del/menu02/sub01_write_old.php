<?
include "../inc/header.php";
include "../inc/menu.php";

if($idx){
	$mod_car=sql_fetch("select * from sale_car where idx='$idx' ");
	$mod_car_cate=sql_list("select * from category where cate_type1='$mod_car[car_type1]' order by cate_list asc ");
	$mod_car_trim_bt=sql_list("select * from sale_car_trim where car_idx='$idx' order by trim_list asc ");
	if($mod_car[car_type1]=="화물차"){
		$mod_car_trim=sql_list("select * from option_basic where del='N' and basic_type1='Y' and basic_price='' ");
	}
	if($mod_car[car_type1]=="캠핑카"){
		$mod_car_trim=sql_list("select * from option_basic where del='N' and basic_type2='Y' and basic_price='' ");
	}
	if($mod_car[car_color1]) $car_color1=explode("/",$mod_car[car_color1]);
	if($mod_car[car_color2]) $car_color2=explode("/",$mod_car[car_color2]);
	if($mod_car[car_img]) $car_img=explode("|:|" , $mod_car[car_img]);
	if($mod_car[car_basic]) $car_basic=explode("/" , $mod_car[car_basic]);
	if($mod_car[car_choice1]) $car_choice1=explode("/" , $mod_car[car_choice1]);
	if($mod_car[car_choice2]) $car_choice2=explode("/" , $mod_car[car_choice2]);
	if($mod_car[car_check1]) $car_check1=explode("/" , $mod_car[car_check1]);
	if($mod_car[car_check2]) $car_check2=explode("/" , $mod_car[car_check2]);
	if($mod_car[car_check3]) $car_check3=explode("/" , $mod_car[car_check3]);
	if($mod_car[car_check4]) $car_check4=explode("/" , $mod_car[car_check4]);
}
$option_color1=sql_list("select * from option_color where color_type='1' and color_type1='Y' and del='N' order by idx desc ");
$option_color1_1=sql_list("select * from option_color where color_type='1' and color_type2='Y' and del='N' order by idx desc ");
$option_color2=sql_list("select * from option_color where color_type='2' and color_type1='Y' and del='N' order by idx desc ");
$option_color2_1=sql_list("select * from option_color where color_type='2' and color_type2='Y' and del='N' order by idx desc ");
$option_basic1=sql_list("select * from option_basic where basic_type1='Y' and del='N' order by basic_list asc ");
$option_basic2=sql_list("select * from option_basic where basic_type2='Y' and del='N' order by basic_list asc ");
$option_choice1=sql_list("select * from option_choice where ch_option='1' and ch_type1='Y' and del='N' order by idx desc ");
$option_choice2=sql_list("select * from option_choice where ch_option='1' and ch_type2='Y' and del='N' order by idx desc ");
$option_choice3=sql_list("select * from option_choice where ch_option='2' and ch_type1='Y' and del='N' order by idx desc ");
$option_choice4=sql_list("select * from option_choice where ch_option='2' and ch_type2='Y' and del='N' order by idx desc ");
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

var old_idx;
function op_display(idx){
	if(old_idx){
		var old_n="choice"+old_idx;
		var old_n2="choice_"+old_idx;
		document.getElementById(old_n).style.display="none";
		document.getElementById(old_n2).style.display="none";
	}
	old_idx=idx;
	var op_n="choice"+idx;
	var op_n2="choice_"+idx;
	var op_n3="btn_ch"+idx;
	document.getElementById(op_n).style.display="block";
	document.getElementById(op_n2).style.display="block";
	if(!ch_price_sum[idx]) ch_price_sum[idx]=0;
	var n=parseInt(numberNullChk(document.wform.car_price.value));
	var nn=n+ch_price_sum[idx];
	document.getElementById('c_price').innerHTML=addComma(nn)+' <em>원</em>';
	document.getElementById('float_write_2').innerHTML=trim_name[idx];
}
var trim_name=new Array();
function trim_name_save(idx,trim_name_s){
	trim_name[idx]=trim_name_s;
}
</script>

	<!-- 본문 -->
    <div class="container-fluid title">
      <h2>차량등록</h2>
    </div>
    <div class="content-container">

      <div class="container-fluid add-product">
        <div class="row">
          <div class="col-12">
            <div class="table-topper justify-content-center mt-5">
              <div class="center">
                <a href="javascript:document.wform.submit();" class="btn btn-outline-secondary btn-sm">등록하기</a>
                <a href="./sub01.php" class="btn btn-outline-primary btn-sm">목록보기</a>
              </div>
            </div>
          </div>
        </div>
        <!-- 기본정보 테이블 -->
        <div class="row mt-5">
          <div class="col-7">
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub01_save.php">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="img_ad" value="">
<? for($i=1;$i<=10;$i++){ ?>
  <input type="file" accept="image/*" multiple onChange="fileInfo(this)" name="upfile[]" id="uf<?=$i?>" style="display:none;"/>
<? } ?>
            <h3 class="flex">기본정보
              <div class="filter">
                <input class="form-check-input" name="car_view" type="radio" id="show" <?=$mod_car[car_view]=="Y"||!$idx?"checked":"";?> value="Y">
                <label class="form-check-label" for="show">
                  노출
                </label>
                &nbsp;
                <input class="form-check-input" name="car_view" type="radio" id="hide" value="N" <?=$mod_car[car_view]=="N"?"checked":"";?>>
                <label class="form-check-label" for="hide">
                  감춤
                </label>
              </div>
            </h3>
			<table class="table table-layout border-type">
              <colgroup>
                <col style="width: 150px;">
                <col style="width: auto;">
              </colgroup>
              <tbody class="table-light">
                <tr>
                  <th>구분</th>
                  <td colspan="3">
                    <div class="row">
                      <div class="col-6">
                        <select class="form-select" aria-label="select" name="car_type1" onchange="ch_type(this.value,'1');">
                          <option value="" selected="">=대구분=</option>
                          <option value="화물차" <?=$mod_car[car_type1]=="화물차"?"selected":""?>>화물차</option>
                          <option value="캠핑카" <?=$mod_car[car_type1]=="캠핑카"?"selected":""?>>캠핑카</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <select class="form-select" aria-label="select" name="car_type2">
                          <option value="" selected="">=소구분=</option>
<? for($i=0;$i<count($mod_car_cate);$i++){ ?>
                          <option value="<?=$mod_car_cate[$i][cate_type2]?>" <?=$mod_car[car_type2]==$mod_car_cate[$i][cate_type2]?"selected":""?>><?=$mod_car_cate[$i][cate_type2]?></option>
<? } ?>
						</select>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>차량명</th>
                  <td>
                    <select class="form-select car-name-trim" name="car_name" onchange="ch_trim(this.value);">
                      <option>=== 차량명선택===</option>
<? for($i=0;$i<count($mod_car_trim);$i++){ ?>
                          <option value="<?=$mod_car_trim[$i][idx]?>" <?=$mod_car[car_name]==$mod_car_trim[$i][idx]?"selected":""?>><?=$mod_car_trim[$i][basic_name]?></option>
<? } ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <th>기본가격</th>
                  <td>
                    <div class="row align-items-center">
                      <div class="col-6">
                        <input type="text" class="form-control" name="car_price" value="<?=number($mod_car[car_price])?>" id="number" >
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
                  <th>기본설명</th>
                  <td colspan="3">
                    <textarea name="car_explain" id="" cols="30" rows="8" class="form-control"><?=$mod_car[car_explain]?></textarea>
                  </td>
                </tr>
                <tr>
                  <th>부가설명</th>
                  <td colspan="3">
                    <textarea name="car_add" id="" cols="30" rows="8" class="form-control"><?=$mod_car[car_add]?></textarea>
                  </td>
                </tr>
                <tr>
                  <th>카탈로그<br>PDF</th>
                  <td colspan="3">
                    <ul class="file-list">
                      <li>
                        <input type="file" class="form-control" name="car_catalog1">
						<? if($mod_car[car_catalog1]){ ?>
                        <p><span class="label">파일명: </span><?=$mod_car[car_catalog1]?></p>
						<? } ?>
                      </li>
                      <li>
                        <input type="file" class="form-control" name="car_catalog2">
						<? if($mod_car[car_catalog2]){ ?>
                        <p><span class="label">파일명: </span><?=$mod_car[car_catalog2]?></p>
						<? } ?>
                      </li>
                      <li>
                        <input type="file" class="form-control" name="car_catalog3">
						<? if($mod_car[car_catalog3]){ ?>
                        <p><span class="label">파일명: </span><?=$mod_car[car_catalog3]?></p>
						<? } ?>
                      </li>
                    </ul>
                  </td>
                </tr>
                <tr>
                  <th>상세제원<br><span>/ 가로 700</span></th>
                  <td colspan="2">
                    <ul class="file-list">
                      <li>
                        <input type="file" class="form-control" name="car_f">
						<? if($mod_car[car_file]){ ?>
                        <p><span class="label">파일명: </span><?=$mod_car[car_file]?></p>
						<? } ?>
                      </li>
                    </ul>
                  </td>
                </tr>

                <tr>
                  <th colspan="4">차량사진 <span>/ 크기 : 700 x 450 </span></th>
                </tr>
                <tr>
                  <td colspan="4">
                    <div class="img-upload-wrap">
                      <div class="topper">
                        <div class="prefix">
                          등록파일 :<span class="counter" id="img_count">0</span>/ <span class="total">10</span>개
                        </div>
                        <div class="suffix">
                          
                          <a href="javascript:file_click();" class="btn btn-outline-primary btn-sm">파일찾기</a>
                          <a href="javascript:void(0);" class="btn btn-outline-dark btn-sm" id="img_del">초기화</a>
                        </div>
                      </div>
                      <div class="image-upload-preview" id="img_box" style="overflow-y:scroll;">
                        <ul>
                        </ul>
                      </div>
                      <!--div class="btn-wrap align-c mt-1 mb-1">
                        <a href="javascript:void(0);" class="btn btn-outline-primary">파일업로드</a>
                      </div-->
                      <ul class="image-file-list">
<? for($i=0;$i<count($car_img);$i++){ ?>
						<li id="s_img_<?=$i?>">
                          <div class="check-wrap">
                            <input type="checkbox" class="form-check-input" id="img<?=$i+1?>" name="check_img[]" value="<?=$i?>" style="display:none;">
                            <span class="label"><?=$i+1?></span> 
                          </div>
                          <label for="img<?=$i+1?>">
                            <img src="/data/<?=$car_img[$i]?>" alt="차량사진">
                          </label>
                          <div class="btn-wrap align-c">
                            <span class="label" onclick="if(confirm('삭제하시겠습니까?')){document.getElementById('s_img_<?=$i?>').style.display='none';document.getElementById('img<?=$i+1?>').checked=true;document.wform.img_ad.value='Y';document.wform.submit();document.wform.img_ad.value='';}" style="cursor:pointer;">삭제</span>
                          </div>
                        </li>
<? } ?>
                     </ul>
<? /* if(count($car_img)>0){ 

					  <div class="btn-group">
                        <ul>
                          <li>
                            <a href="javascript:all_check(1);" class="btn btn-outline-primary btn-sm">전체선택</a>
                          </li>
                          <li>
                            <a href="javascript:all_check();" class="btn btn-outline-primary btn-sm">전체해제</a>
                          </li>
                          <!--li>
                            <button class="btn btn-outline-dark btn-sm">선택삭제</button>
                          </li-->
                        </ul>
                      </div>
<? } */ ?>
                    </div>
                  </td>
                </tr>


              </tbody>
            </table>
          </div>
          <!-- 기본옵션 테이블 -->
          <div class="col-5">
            <section class="select-options">
              <!-- 리스트 -->
              <div class="option-list">
                <div class="option total-price">
                  <div class="topper-wrap">
                    <span class="label">총차량가격</span>
                    <p class="data price" id="c_price">0 <em>원</em></p>
                  </div>
                </div>
                <div class="option exterior-color">
                  <div class="topper-wrap">
                    <span class="label">외장색상</span>
                  </div>
                  <div class="color-chip-list" id="color1">
                    <ul>
                      <!-- 선택시 <li class="selected"> -->
<? for($i=0;$i<count($option_color1);$i++){ ?>
                      <li class="<?=in_array($option_color1[$i][idx],$car_check1)?"selected":""?>">
                        <a href="" onclick="c_ch(<?=$i?>);">
                          <div class="color-chip" style="background-image: url(/images/opt/<?=$option_color1[$i][color_file]?>);" ></div>
                        </a>
                        <span class="color-name"><?=$option_color1[$i][color_name]?></span>
                        <div>
                          <input type="checkbox" class="form-check-input" name="car_color1[]" value="<?=$option_color1[$i][idx]?>" <?=in_array($option_color1[$i][idx],$car_color1)?"checked":""?>><input type="checkbox" class="form-check-input" name="car_check1[]" value="<?=$option_color1[$i][idx]?>" <?=in_array($option_color1[$i][idx],$car_check1)?"checked":""?> style="display:none;">
                          <input type="text" class="form-control order-number"/>
                        </div>
                      </li>
<? } ?>
                    </ul>
                  </div>
                  <div class="color-chip-list" id="color1_1">
                    <ul>
                      <!-- 선택시 <li class="selected"> -->
<? for($i=0;$i<count($option_color1_1);$i++){ ?>
                      <li class="<?=in_array($option_color1_1[$i][idx],$car_check1)?"selected":""?>">
                        <a href="">
                          <div class="color-chip" style="background-image: url(/images/opt/<?=$option_color1_1[$i][color_file]?>);" onclick="c_ch2(<?=$i?>);"></div>
                        </a>
                        <span class="color-name"><?=$option_color1_1[$i][color_name]?></span>
                        <input type="checkbox" class="form-check-input" name="car_color1_1[]" value="<?=$option_color1_1[$i][idx]?>" <?=in_array($option_color1_1[$i][idx],$car_color1)?"checked":""?>><input type="checkbox" class="form-check-input" name="car_check2[]" value="<?=$option_color1_1[$i][idx]?>" <?=in_array($option_color1_1[$i][idx],$car_check1)?"checked":""?> style="display:none;">
                      </li>
<? } ?>
                    </ul>
                  </div>
                </div>
                <div class="option interior-color">
                  <div class="topper-wrap">
                    <span class="label">내장색상</span>
                  </div>
                  <div class="color-chip-list" id="color2">
                    <ul>
                      <!-- 선택시 <li class="selected"> -->
<? for($i=0;$i<count($option_color2);$i++){ ?>
                      <li class="<?=in_array($option_color2[$i][idx],$car_check2)?"selected":""?>">
                        <input type="checkbox" class="form-check-input" name="car_color2[]" value="<?=$option_color2[$i][idx]?>" <?=in_array($option_color2[$i][idx],$car_color2)?"checked":""?>><input type="checkbox" class="form-check-input" name="car_check3[]" value="<?=$option_color2[$i][idx]?>" <?=in_array($option_color2[$i][idx],$car_check2)?"checked":""?> style="display:none;">
                        <a href="" onclick="c_ch3(<?=$i?>);">
                          <div class="color-chip" style="background-image: url(/images/opt/<?=$option_color2[$i][color_file]?>);" ></div>
                        </a>
                        <span class="color-name"><?=$option_color2[$i][color_name]?></span>
                      </li>
<? } ?>
                    </ul>
                  </div>
                  <div class="color-chip-list" id="color2_1">
                    <ul>
                      <!-- 선택시 <li class="selected"> -->
<? for($i=0;$i<count($option_color2_1);$i++){ ?>
                      <li class="<?=in_array($option_color2_1[$i][idx],$car_check2)?"selected":""?>">
                        <input type="checkbox" class="form-check-input" name="car_color2_1[]" value="<?=$option_color2_1[$i][idx]?>" <?=in_array($option_color2_1[$i][idx],$car_color2)?"checked":""?>><input type="checkbox" class="form-check-input" name="car_check4[]" value="<?=$option_color2_1[$i][idx]?>" <?=in_array($option_color2_1[$i][idx],$car_check2)?"checked":""?> style="display:none;">
                        <a href="">
                          <div class="color-chip" style="background-image: url(/images/opt/<?=$option_color2_1[$i][color_file]?>);" onclick="c_ch4(<?=$i?>);"></div>
                        </a>
                        <span class="color-name"><?=$option_color2_1[$i][color_name]?></span>
                      </li>
<? } ?>
                    </ul>
                  </div>
                  <div class="option trim">
                    <div class="topper-wrap">
                      <span class="label">트림 선택</span>
                    </div>
                    <div class="trim-list" id="trim_bt">
<?
if($idx){
	for($i=0;$i<count($mod_car_trim_bt);$i++){
		$mod_car_trim_one=sql_fetch("select * from option_basic where idx='".$mod_car_trim_bt[$i][trim_idx]."' ");
		echo '<button type="button" id="btn_ch'.$mod_car_trim_one[idx].'" class="btn btn-round btn-outline-dark btn-sm" onclick="op_display('.$mod_car_trim_one[idx].')">'.$mod_car_trim_one[basic_price].'</button> ';
		echo '<script>ch_price_sum['.$mod_car_trim_one[idx].']='.$mod_car_trim_bt[$i][trim_price].'</script>';
	}
}
?>
                    </div>
                  </div>
                </div>
              </div>
              
              <script>
                // 클릭된 버튼 활성화
                // description: 위의 트림 리스트 불러온뒤 아래 스크립트 실행되게해야함
				function btn_start(){
                $('#trim_bt button').on('click', function(e){
                  console.log($(this));
                  $(this).addClass('on').siblings('button').removeClass('on');
                })
				}
              </script>

      
              <!-- 옵션 탭 -->
              <div class="tab-wrap option-function">
                <div class="tab-list">
                  <ul>
                    <li class="tab-item on"><a href="">차량옵션</a></li>
                    <li class="tab-item"><a href="">특장옵션</a></li>
                    <!-- <li class="tab-item"><a href="">기본옵션</a></li> -->
                  </ul>
                </div>
                <div class="tab-content-list">
                  <div class="tab-content on" data-tab="0">
<?
$j1=0;
$sale_trim=sql_list("select * from option_basic where del='N' and basic_type1='Y' and basic_price!='' order by idx asc ");
for($i=0;$i<count($sale_trim);$i++){
	$mod_car_trim_list=sql_fetch("select * from sale_car_trim where car_idx='$idx' and trim_idx='".$sale_trim[$i][idx]."' ");
	$car_list1=explode("/",$mod_car_trim_list[trim_list1]);
?>
					<div class="first-options" id="choice<?=$sale_trim[$i][idx]?>" style="display:none;">
                      <ul>
                        <!-- 선택시 <li class="selected"> -->
<? for($k=0;$k<count($option_choice1);$k++){ ?>
                        <li class="<?=in_array($sale_trim[$i][idx]."|".$option_choice1[$k][idx],$car_check3)?"selected":""?>">
                          <div class="check-wrap">
                            <input type="checkbox" class="form-check-input" name="car_choice1[]" value="<?=$sale_trim[$i][idx]?>|<?=$option_choice1[$k][idx]?>" <?=in_array($sale_trim[$i][idx]."|".$option_choice1[$k][idx],$car_choice1)?"checked":""?> onclick=""><input type="checkbox" class="form-check-input" name="car_check5[]" value="<?=$sale_trim[$i][idx]?>|<?=$option_choice1[$k][idx]?>" <?=in_array($sale_trim[$i][idx]."|".$option_choice1[$k][idx],$car_check3)?"checked":""?> style="display:none;">
                            <input type="text" name="car_list1[]" class="form-control order-number" value="<?=$car_list1[$k]?>"> 
                          </div>
                          <div class="item-wrap">
                            <div class="img-wrap">
                              <img src="/images/opt/<?=$option_choice1[$k][ch_file]?>" alt="옵션사진" onclick="c_ch5(<?=$j1?>,<?=$sale_trim[$i][idx]?>,<?=$option_choice1[$k][ch_price]?>);">
                            </div>
                            <div class="title"><?=$option_choice1[$k][ch_name]?>
                              <a href="" class="tooltip toggle-layer-pop">
                                <span class="icon-tooptip">!</span>
                              </a>
                            </div>
                            <div class="price">
                              <?=number($option_choice1[$k][ch_price])?>원
                            </div>
                          </div>
                        </li>
<? $j1++;} ?>
                      </ul>
                    </div>
<? } ?>
<?
$j1=0;
$sale_trim=sql_list("select * from option_basic where del='N' and basic_type2='Y' and basic_price!='' order by idx asc ");
for($i=0;$i<count($sale_trim);$i++){
	$mod_car_trim_list=sql_fetch("select * from sale_car_trim where car_idx='$idx' and trim_idx='".$sale_trim[$i][idx]."' ");
	$car_list2=explode("/",$mod_car_trim_list[trim_list2]);
?>
					<div class="first-options" id="choice<?=$sale_trim[$i][idx]?>" style="display:none;">
                      <ul>
                        <!-- 선택시 <li class="selected"> -->
<? for($k=0;$k<count($option_choice2);$k++){ ?>
                        <li class="<?=in_array($sale_trim[$i][idx]."|".$option_choice2[$k][idx],$car_check3)?"selected":""?>">
                          <div class="check-wrap">
                            <input type="checkbox" class="form-check-input" name="car_choice2[]" value="<?=$sale_trim[$i][idx]?>|<?=$option_choice2[$k][idx]?>" <?=in_array($sale_trim[$i][idx]."|".$option_choice2[$k][idx],$car_choice1)?"checked":""?> onclick=""><input type="checkbox" class="form-check-input" name="car_check6[]" value="<?=$sale_trim[$i][idx]?>|<?=$option_choice2[$k][idx]?>" <?=in_array($sale_trim[$i][idx]."|".$option_choice2[$k][idx],$car_check3)?"checked":""?> style="display:none;">
                            <input type="text" name="car_list2[]" class="form-control order-number" value="<?=$car_list2[$k]?>">
                          </div>
                          <div class="item-wrap">
                            <div class="img-wrap">
                              <img src="/images/opt/<?=$option_choice2[$k][ch_file]?>" alt="옵션사진" onclick="c_ch6(<?=$j1?>,<?=$sale_trim[$i][idx]?>,<?=$option_choice2[$k][ch_price]?>);">
                            </div>
                            <div class="title"><?=$option_choice2[$k][ch_name]?>
                              <a href="" class="tooltip toggle-layer-pop">
                                <span class="icon-tooptip">!</span>
                              </a>
                            </div>
                            <div class="price">
                              <?=number($option_choice2[$k][ch_price])?>원
                            </div>
                          </div>
                        </li>
<? $j1++;} ?>
                      </ul>
                    </div>
<? } ?>
                  </div>
                  <div class="tab-content" data-tab="1">
<?
$j1=0;
$sale_trim=sql_list("select * from option_basic where del='N' and basic_type1='Y' and basic_price!='' order by idx asc ");
for($i=0;$i<count($sale_trim);$i++){
	$mod_car_trim_list=sql_fetch("select * from sale_car_trim where car_idx='$idx' and trim_idx='".$sale_trim[$i][idx]."' ");
	$car_list3=explode("/",$mod_car_trim_list[trim_list3]);
?>
                    <div class="first-options" id="choice_<?=$sale_trim[$i][idx]?>" style="display:none;">
                      <ul>
                        <!-- 선택시 <li class="selected"> -->
<? for($k=0;$k<count($option_choice3);$k++){ ?>
                        <li class="<?=in_array($sale_trim[$i][idx]."|".$option_choice3[$k][idx],$car_check4)?"selected":""?>">
                          <div class="check-wrap">
                            <input type="checkbox" class="form-check-input" name="car_choice3[]" value="<?=$sale_trim[$i][idx]?>|<?=$option_choice3[$k][idx]?>" <?=in_array($sale_trim[$i][idx]."|".$option_choice3[$k][idx],$car_choice2)?"checked":""?> onclick=""><input type="checkbox" class="form-check-input" name="car_check7[]" value="<?=$sale_trim[$i][idx]?>|<?=$option_choice3[$k][idx]?>" <?=in_array($sale_trim[$i][idx]."|".$option_choice3[$k][idx],$car_check4)?"checked":""?> style="display:none;">
                            <input type="text" name="car_list3[]" class="form-control order-number" value="<?=$car_list3[$k]?>">
                          </div>
                          <div class="item-wrap">
                            <div class="img-wrap">
                              <img src="/images/opt/<?=$option_choice3[$k][ch_file]?>" alt="옵션사진" onclick="c_ch7(<?=$j1?>,<?=$sale_trim[$i][idx]?>,<?=$option_choice3[$k][ch_price]?>);">
                            </div>
                            <div class="title"><?=$option_choice3[$k][ch_name]?>
                              <a href="" class="tooltip toggle-layer-pop">
                                <span class="icon-tooptip">!</span>
                              </a>
                            </div>
                            <div class="price">
                              <?=number($option_choice3[$k][ch_price])?>원
                            </div>
                          </div>
                        </li>
<? $j1++;} ?>
                      </ul>
                    </div>
<? } ?>
<?
$j1=0;
$sale_trim=sql_list("select * from option_basic where del='N' and basic_type2='Y' and basic_price!='' order by idx asc ");
for($i=0;$i<count($sale_trim);$i++){
	$mod_car_trim_list=sql_fetch("select * from sale_car_trim where car_idx='$idx' and trim_idx='".$sale_trim[$i][idx]."' ");
	$car_list4=explode("/",$mod_car_trim_list[trim_list4]);
?>
                   <div class="first-options" id="choice_<?=$sale_trim[$i][idx]?>" style="display:none;">
                      <ul>
                        <!-- 선택시 <li class="selected"> -->
<? for($k=0;$k<count($option_choice4);$k++){ ?>
                        <li class="<?=in_array($sale_trim[$i][idx]."|".$option_choice4[$k][idx],$car_check4)?"selected":""?>">
                          <div class="check-wrap">
                            <input type="checkbox" class="form-check-input" name="car_choice4[]" value="<?=$sale_trim[$i][idx]?>|<?=$option_choice4[$k][idx]?>" <?=in_array($option_choice4[$k][idx],$car_choice2)?"checked":""?> onclick=""><input type="checkbox" class="form-check-input" name="car_check8[]" value="<?=$sale_trim[$i][idx]?>|<?=$option_choice4[$k][idx]?>" <?=in_array($sale_trim[$i][idx]."|".$option_choice4[$k][idx],$car_check4)?"checked":""?> style="display:none;">
                            <input type="text" name="car_list4[]" class="form-control order-number" value="<?=$car_list4[$k]?>">
                          </div>
                          <div class="item-wrap">
                            <div class="img-wrap">
                              <img src="/images/opt/<?=$option_choice4[$k][ch_file]?>" alt="옵션사진" onclick="c_ch8(<?=$j1?>,<?=$sale_trim[$i][idx]?>,<?=$option_choice4[$k][ch_price]?>);">
                            </div>
                            <div class="title"><?=$option_choice4[$k][ch_name]?>
                              <a href="" class="tooltip toggle-layer-pop">
                                <span class="icon-tooptip">!</span>
                              </a>
                            </div>
                            <div class="price">
                              <?=number($option_choice4[$k][ch_price])?>원
                            </div>
                          </div>
                        </li>
<? $j1++;} ?>
                      </ul>
                    </div>
<? } ?>
                  </div>
                  <div class="tab-content" data-tab="2">
                    <div class="standard-option-list" id="basic1">
                      <ul>
<? for($i=0;$i<count($option_basic1);$i++){ ?>
                        <li>
                          <div class="row">
                            <div class="col-9">
                              <input type="checkbox" id="option01" class="form-check-input" name="car_basic1[]" value="<?=$option_basic1[$i][idx]?>" <?=in_array($option_basic1[$i][idx],$car_basic)?"checked":""?>>
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
                    <div class="standard-option-list" id="basic2">
                      <ul>
<? for($i=0;$i<count($option_basic2);$i++){ ?>
                        <li>
                          <div class="row">
                            <div class="col-9">
                              <input type="checkbox" id="option01" class="form-check-input" name="car_basic1[]" value="<?=$option_basic2[$i][idx]?>" <?=in_array($option_basic2[$i][idx],$car_basic)?"checked":""?>>
                              <label for="option01"><?=$option_basic2[$i][basic_name]?></label>
                            </div>
                            <div class="col-3">
                              <div class="align-r">
                                <?=number($option_basic2[$i][basic_price])?>원
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
          <div class="floating-bar on">
            <div class="container">
              <span id="float_write_1"></span> ㅣ <span id="float_write_2"></span> ㅣ <span>총차량가격</span> <span class="price">999,999,999</span>원
            </div>
          </div>
        </div>
        <!-- //기본정보 테이블 -->


        <div class="table-footer justify-content-center mt-5">
          <div class="center">
            <a href="javascript:document.wform.submit();" class="btn btn-outline-secondary btn-sm">등록하기</a>
            <a href="./product-list.html" class="btn btn-outline-primary btn-sm">목록보기</a>
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
      <p class="title">중량짐용 후륜 현가장치</p>
      <div class="img-wrap">
        <img src="../image/img_vehicle_detail.png" alt="옵션사진">
      </div>
      <div class="text-wrap">
        <p>
          중량짐을 주로 취급하는 고객들을 위해 판스프링을 5장에서 6장으로 추가보강하여 장시간 중량짐에도 견딜 수 있도록 후륜 서스펜션의 내구성을 높인 장치입니다.
        </p>
        <p class="sub-text">
          * 홈페이지의 사진과 설명은 참고용이며 실제 차량에 탑재되는 기능과 설명은 상이할수 있으니, 차량 구입전 카마스터를 통해 확인바랍니다.
        </p>
      </div>
      <div class="price-wrap">
        <div class="price">999,999,999원</div>
        <!-- <button class="btn btn-secondary">등록하기</button> -->
      </div>
    </div>
  </div>
</body>
</html>

<?
if($idx){
	if($mod_car[car_type1]=="화물차"){	echo '<script>document.getElementById("basic1").style.display="block";document.getElementById("basic2").style.display="none";document.getElementById("color1").style.display="block";document.getElementById("color1_1").style.display="none";document.getElementById("color2").style.display="block";document.getElementById("color2_1").style.display="none";</script>';
	}else if($mod_car[car_type1]=="캠핑카"){	echo '<script>document.getElementById("basic2").style.display="block";document.getElementById("basic1").style.display="none";document.getElementById("color1_1").style.display="block";document.getElementById("color1").style.display="none";document.getElementById("color2_1").style.display="block";document.getElementById("color2").style.display="none";</script>';
	}
}else{ echo '<script>document.getElementById("basic2").style.display="none";document.getElementById("basic1").style.display="none";document.getElementById("color1_1").style.display="none";document.getElementById("color1").style.display="none";document.getElementById("color2_1").style.display="none";document.getElementById("color2").style.display="none";</script>';
}
?>

<script>
function write_price(v){
	document.getElementById('c_price').innerHTML=v+' <em>원</em>';
}
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
function wr_price(trim,ch_price,th){
	var n=parseInt(numberNullChk(document.wform.car_price.value));
	if(!ch_price_sum[trim]) ch_price_sum[trim]=0;
	if(th.checked==true){
		ch_price_sum[trim]=parseInt(ch_price_sum[trim])+parseInt(ch_price);
	}else{
		ch_price_sum[trim]=parseInt(ch_price_sum[trim])-parseInt(ch_price);
	}
	//alert(ch_price);
	var nn=n+ch_price_sum[trim];
	document.getElementById('c_price').innerHTML=addComma(nn)+' <em>원</em>';
}

</script>
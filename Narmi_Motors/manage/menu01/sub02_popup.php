<?
include $_SERVER['DOCUMENT_ROOT']."/inc/lib.php";
?>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>관리자</title>
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <!-- bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- swiper.js -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <!-- admin css -->
  <link rel="stylesheet" href="/manage/src/css/style.css">

  <script src="/manage/src/js/script.js"></script>  
  <!-- add js  -->
  <script src="/manage/inc/script.js"></script>  

</head>
<body>
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
<?
$web_config=sql_fetch("select * from web_config where idx=1 ");
if($idx){
	$mod_est=sql_fetch("select * from estimate where idx='$idx' ");
	$mod_car=sql_fetch("select * from sale_est where idx='$mod_est[car_idx]' ");
	$mod_car_name=sql_fetch("select * from option_basic where idx='".$mod_car[car_name]."' ");
	$mod_car_trim_name=sql_fetch("select * from option_basic where idx='$mod_est[trim_idx]' ");
	if($mod_car[idx]){
		if($mod_car[car_color1]) $car_color1=sql_fetch("select * from option_color where idx='$mod_car[car_color1]' ");
		if($mod_car[car_color2]) $car_color2=sql_fetch("select * from option_color where idx='$mod_car[car_color2]' ");
		if($mod_car[car_img]) $car_img=explode("|:|" , $mod_car[car_img]);
		if($mod_car[car_basic]) $car_basic=explode("/" , $mod_car[car_basic]);
		if($mod_car[car_choice1]) $car_choice1=explode("/" , $mod_car[car_choice1]);
		if($mod_car[car_choice2]) $car_choice2=explode("/" , $mod_car[car_choice2]);
		for($i=0;$i<count($car_choice1);$i++){ 
			$mod_choice1=sql_fetch("select * from option_choice where idx='$car_choice1[$i]' ");
			$tot_c1+=$mod_choice1[ch_price];
		}
		for($i=0;$i<count($car_choice2);$i++){ 
			$mod_choice2=sql_fetch("select * from option_choice where idx='$car_choice2[$i]' ");
			$tot_c2+=$mod_choice2[ch_price];
		}
	}
}
?>
  <div class="narmi-admin">
    <div class="estimate-form-header align-r">
      <span class="data" onclick="window.print();" style="cursor:pointer;"><i class="bi bi-printer"></i> 인쇄/저장</span> | <span onclick="window.close();" style="cursor:pointer;">창닫기</span>
    </div>
    <!-- 차량견적서 본문 -->
    <div class="estimate-form">
      <div class="title-wrap">
        <h2>차량견적서 (내차만들기)</h2>
      </div>
      <div class="estimate-topper">
        <div class="user-basic-info">
          <ul>
            <li>
              <span class="label">문서:</span>
              <span class="data"><?=$mod_est[est_code]?></span>
            </li>
            <li>
              <span class="label">일자:</span>
              <span class="data"><?=substr($mod_est[est_regdate],0,10)?>[<?=substr($mod_est[est_regdate],11,2)?>:<?=substr($mod_est[est_regdate],14,2)?>]</span>
            </li>
            <li>
              <span class="label">이름:</span>
              <span class="data"><?=$mod_est[est_name]?></span>
            </li>
            <li>
              <span class="label">TEL:</span>
              <span class="data"><?=$mod_est[est_phone]?></span>
            </li>
          </ul>
        </div>
        <div class="company-info">
          <ul>
            <li>
              <span class="data"><?=$web_config[web_name]?>  | <?=$web_config[web_owner]?></span>
            </li>
            <li>
              <span class="data"><?=$web_config[web_number]?></span>
            </li>
            <li>
              <span class="data"><?=$web_config[web_address]?></span>
            </li>
            <li>
              <span class="data">TEL:<?=$web_config[web_phone]?>  FAX:<?=$web_config[web_fax]?></span>
            </li>
          </ul>
        </div>
      </div>
      <div class="estimate-body">
        <div class="vehicle-title">
          <?=$mod_car_name[basic_name]?>
          /
          <span class="label">총차량가격: </span>
          <span class="total-price"><?=number($mod_est[est_price])?></span>원
        </div>
      </div>
      <div class="estimate-body">
        <div class="left">
          
          <div class="vehicle-img">
            <img src="/data/<?=$car_img[0]?>" alt="프린트용 이미지">
          </div>
          
          
          
        </div>
        <div class="right">
          <!-- <div class="vehicle-title">
            <?=$mod_car[car_name]?>
            /
            <span class="label">총차량가격: </span>
            <span class="total-price"><?=number($mod_est[est_price])?></span>원
          </div> -->

          <!-- <div class="vehicle-total-price">
            <span class="label">총차량가격: </span>
            <span class="total-price"><?=number($mod_est[est_price])?></span>원
          </div> -->

          <div class="trims">
            <span class="label">트림선택: </span>
            <span><?=$mod_car_trim_name[basic_price]?></span>
          </div>

          <div class="colors">
            <ul>
              <li>
                <span class="label">외장색상: </span>
                <span class="data"><?=$car_color1[color_name]?></span>
              </li>
              <li>
                <span class="label">내장색상: </span>
                <span class="data"><?=$car_color2[color_name]?></span>
              </li>
            </ul>
          </div>

          
        </div>
      </div>
      <div class="estimate-body">
        <div class="options">
          <div class="additional-option1">
            <div class="topper">
              <h4>차량옵션</h4>
              <div class="price">
                <span class="label">합계:</span>
                <span class="data"><?=number($tot_c1)?>원</span>
              </div>
            </div>
            <div class="option-list">
              <ul>
        <?
        for($i=0;$i<count($car_choice1);$i++){ 
          $mod_choice1=sql_fetch("select * from option_choice where idx='$car_choice1[$i]' ");
        ?>
                <li>
                  <span class="option-name"><?=$mod_choice1[ch_name]?></span>
                  <span class="price"><?=number($mod_choice1[ch_price])?>원</span>
                </li>
        <? } ?>
              </ul>
            </div>
          </div>
          <div class="additional-option2">
            <div class="topper">
              <h4>특장옵션</h4>
              <div class="price">
                <span class="label">합계:</span>
                <span class="data"><?=number($tot_c2)?>원</span>
              </div>
            </div>
            <div class="option-list">
              <ul>
        <?
        for($i=0;$i<count($car_choice2);$i++){ 
          $mod_choice2=sql_fetch("select * from option_choice where idx='$car_choice2[$i]' ");
        ?>
                <li>
                  <span class="option-name"><?=$mod_choice2[ch_name]?></span>
                  <span class="price"><?=number($mod_choice2[ch_price])?>원</span>
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
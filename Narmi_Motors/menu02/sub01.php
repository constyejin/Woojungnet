<?
include "../inc/header.php";
include "../inc/menu_sub.php";

if(!$st){
	$category_default=sql_fetch("select * from category where cate_type1='화물차' order by cate_list asc ");
	$structure1=$category_default[cate_type2];
	$st=$category_default[idx];
}else{
	$category_default=sql_fetch("select * from category where idx=".$st." order by cate_list asc ");
	$structure1=$category_default[cate_type2];
}
$image_sub=sql_fetch("select * from image_sub where sub_type='sub' and sub_menu='화물차' order by idx desc ");
$structure=sql_fetch("select * from image_structure where st_type1='화물차' and st_type2='".$structure1."' ");
$sale_car=sql_list("select * from sale_car where car_type1='화물차' and car_type2='".$structure1."' and car_view='Y' order by idx desc ");
$category=sql_list("select * from category where cate_type1='화물차' order by cate_list asc ");
?>
  <div class="sub-visual">
    <!-- 서브비주얼 -->
    <img src="/images/img/<?=$image_sub[sub_file]?>" alt="">
    <!-- <div class="title">
      <p class="catch-phrase">대한민국의 운송장비의 성공신화 !!</p>
      <p class="sub-text">화물차! 특장차! 캠핑카! 책임있고 오랜경험을 고객님들과 함께 합니다. </p>
      <p class="third-text">TEL  1588-1277  , FAX  02-794-3300</p>
    </div> -->
  </div>
  <div class="content-wrap sub store-truck">
    <div class="anchor-wrap">
      <a href="#" class="anchor"></a>
    </div>
    <section class="category-tab">
      <div class="container">
        <!-- <h2>NARMI PRODUCTS</h2> -->
        <div class="location-wrap">
          <div class="home">
            <a href="/" class="btn-home">
              <span class="icon-home"></span>
            </a>
          </div>
          <div class="label">
            화물차
          </div>
        </div>
        <div class="tab-wrap">
          <ul>
<? for($i=0;$i<count($category);$i++){ ?>
            <li>
              <a href="sub01.php?st=<?=$category[$i][idx]?>" class="tab<?=$st==$category[$i][idx]?" active":""?>"><?=$category[$i][cate_type2]?></a>
            </li>
<? } ?>
            <!--li>
              <a href="" class="tab disabled">리프트</a>
            </li-->
          </ul>
        </div>
      </div>
    </section>
	<? if($structure[st_file1]||$structure[st_file2]||$structure[st_file3]){ ?>
    <section class="vehicle-slider-wrap">
      <p class="h3">
        <?=$structure[st_title]?>
      </p>
      <div class="swiper vehicle-slider">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
		  <? if($structure[st_file1]){ ?>
            <a href="">
              <img src="/images/img/<?=$structure[st_file1]?>" alt="">
            </a>
		  <? } ?>
          </div>
          <div class="swiper-slide">
		  <? if($structure[st_file2]){ ?>
            <a href="">
              <img src="/images/img/<?=$structure[st_file2]?>" alt="">
            </a>
		  <? } ?>
          </div>
          <div class="swiper-slide">
		  <? if($structure[st_file3]){ ?>
            <a href="">
              <img src="/images/img/<?=$structure[st_file3]?>" alt="">
            </a>
		  <? } ?>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </section>
	<? } ?>
    <section class="vehicle-list-wrap">
      <div class="container">
        <ul>
<?
for($i=0;$i<count($sale_car);$i++){
	unset($car_img);
	if($sale_car[$i][car_img]) $car_img=explode("|:|" , $sale_car[$i][car_img]);
	$sale_car_trim=sql_fetch("select * from option_basic where idx='".$sale_car[$i][car_name]."' ");
	$mod_car_trim=sql_fetch("select * from sale_car_trim where car_idx='".$sale_car[$i][idx]."' order by trim_list asc ");
?>
          <li>
            <div class="img-wrap">
              <img src="/data/<?=$car_img[0]?>" alt="차량이미지" onclick="location.href='sub01_view.php?idx=<?=$sale_car[$i][idx]?>&trim_idx=<?=$mod_car_trim[idx]?>';">
            </div>
            <div class="vehicle-name">
              <a href="./sub01_view.php?idx=<?=$sale_car[$i][idx]?>&trim_idx=<?=$mod_car_trim[idx]?>">
                <span class="name">
                  <?=$sale_car_trim[basic_name]?>
                </span>
                <!-- <div class="arrow-half-black">
                  <span class="bar top"></span>
                  <span class="bar bottom"></span>
                </div> -->
              </a>
            </div>
          </li>
<? } ?>
        </ul>
      </div>
    </section>
  </div>
<?
include "../inc/consult_form.php";
include "../inc/footer.php";
?>

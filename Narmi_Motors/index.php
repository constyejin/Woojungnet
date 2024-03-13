<?
include "./inc/header.php";

if (preg_match("(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)", $_SERVER['HTTP_USER_AGENT'])) {
}else{
include "./inc/popup.php";}

$is_main="ok";
include "./inc/menu_sub.php";
$category=sql_list("select * from category where cate_view='Y' order by cate_list asc ");
$image_main=sql_list("select * from image_main where 1=1 order by main_list asc ");
?>
  <div class="main-visual swiper">
    <!-- 메인비주얼 -->
    <div class="swiper-wrapper">
<? for($i=0;$i<count($image_main);$i++){ ?>
      <div class="swiper-slide">
        <img src="/images/img/<?=$image_main[$i][main_file]?>" alt="">
      </div>
<? } ?>
    </div>
    <!-- <span class="water-mark"></span> -->
  </div>
  <div class="content-wrap main">
    <div class="anchor-wrap">
      <a href="#" class="anchor"></a>
    </div>
    <section class="header">
      <div class="container">
        <h2>NARMI PRODUCTS</h2>
      </div>
    </section>
    <section class="products">
      <div class="container">
        <ul>
<? for($i=0;$i<count($category);$i++){ ?>
<?
	if($category[$i][cate_type1]=="화물차"){
		$main_l="/menu02/sub01.php?st=".$category[$i][idx];
	} else if($category[$i][cate_type1]=="캠핑카"){
		$main_l="/menu03/sub01.php?st=".$category[$i][idx];
	}else{
		$main_l="";
	}
?>
<? if($i==0||$i%2==0){ ?>
		  <li class="item">
            <div class="desc">
              <div class="product-name">
                <span class="text">
                  <?=$category[$i][cate_type2]?>
                </span>
                <a href="<?=$main_l?>" class="arrow">
                  <span class="top"></span>
                  <span class="md"></span>
                  <span class="bottom"></span>
                </a>
              </div>
              <p class="sub-text"><?=$category[$i][cate_title1]?><br><?=$category[$i][cate_title2]?></p>
              <p class="content-text">
                <?=nl2br($category[$i][cate_explain])?>
              </p>
            </div>
            <div class="img-area">
              <span class="vertical-label">NARMI MOTORS</span>
              <div class="img-wrap">
                <img src="/images/category/<?=$category[$i][cate_file]?>" alt="제품사진">
              </div>
              <div class="label">
                <a href="<?=$main_l?>" class="text">
                  PRODUCT VIEW
                </a>
                <span class="icon-arrow"></span>
              </div>
            </div>
            <!-- 모바일전용 라벨 -->
            <div class="label">
              <a href="<?=$main_l?>" class="text">
                PRODUCT VIEW
              </a>
            </div>
          </li>
<? } else { ?>
          <li class="item">
            <div class="desc">
              <div class="product-name">
                <span class="text">
                  <?=$category[$i][cate_type2]?>
                </span>
                <a href="<?=$main_l?>" class="arrow">
                  <span class="top"></span>
                  <span class="md"></span>
                  <span class="bottom"></span>
                </a>
              </div>
              <p class="sub-text"><?=$category[$i][cate_title1]?><br><?=$category[$i][cate_title2]?></p>
              <p class="content-text">
                <?=nl2br($category[$i][cate_explain])?>
              </p>
            </div>
            <div class="img-area">
              <span class="vertical-label">NARMI MOTORS</span>
              <div class="img-wrap">
                <img src="/images/category/<?=$category[$i][cate_file]?>" alt="제품사진">
              </div>
              <div class="label">
                <a href="<?=$main_l?>" class="text">
                  PRODUCT VIEW
                </a>
                <span class="icon-arrow"></span>
              </div>
            </div>
            <!-- 모바일전용 라벨 -->
            <div class="label">
              <a href="<?=$main_l?>" class="text">
                PRODUCT VIEW
              </a>
            </div>
          </li>
<? } ?>
<? } ?>
        </ul>
      </div>
    </section>
    <section class="wide-banner">
      <div class="container">
        <img src="./front/src/image/icon_logo_lg.png" alt="narmi 로고">
        <p class="banner-title">대한민국 운송장비의 성공 신화</p>
        <p class="banner-text">
          저희 나르미모터스(주)가 제공하는 제품은 안전성, 내구성, 경제성에 있어 세계 최고를 자랑하는 섀시와 완벽을 추구하는
          최고의 바디 품질로 고객의 안전성과 경제성은 물론, 수익 향상 기여에 이바지 할 것이라 확신합니다.
          나르미모터스(주)는 한국형 상용차의 새로운 패러다임을 제시하는 기업으로서 고객들의 마음까지 찾아가는
          맞춤형 서비스를 제공하기 위해 최선의 노력을 다하겠습니다.
        </p>
      </div>
    </section>

    <script>
      const swiper = new Swiper('.swiper', {
        autoplay: {
          delay: 4000,
        },
        allowTouchMove: false,
        effect: "fade",
        speed: 1000,
        loop: true,
      });
    </script>
<?
include "./inc/consult_form.php";
include "./inc/footer.php";
?>

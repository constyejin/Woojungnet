<?
include "../inc/header.php";

if($idx) $mod_st=sql_fetch("select * from image_structure where idx='$idx' ");
?>
  <div class="narmi-admin">
    <!-- 본문 -->
    <div class="container-fluid">
      <section class="vehicle-slider-wrap">
        <p class="h3">
          <?=$mod_st[st_title]?>
        </p>
        <div class="swiper vehicle-slider">
          <div class="swiper-wrapper">
			<? if($mod_st[st_file1]){ ?>
            <div class="swiper-slide">
              <a href="">
                <img src="/images/img/<?=$mod_st[st_file1]?>" alt="">
              </a>
            </div>
			<? } ?>
			<? if($mod_st[st_file2]){ ?>
            <div class="swiper-slide">
              <a href="">
                <img src="/images/img/<?=$mod_st[st_file2]?>" alt="">
              </a>
            </div>
			<? } ?>
			<? if($mod_st[st_file3]){ ?>
            <div class="swiper-slide">
              <a href="">
                <img src="/images/img/<?=$mod_st[st_file3]?>" alt="">
              </a>
            </div>
			<? } ?>
          </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </section>
    </div>
  </div>
  <script>
    function storeTruckSlider(){
      const swiper = new Swiper('.vehicle-slider', {
        loop: true,
        slidesPerView: 1,
        loopAdditionalSlides: 1,
        loopedSlides: 1,
        spaceBetween: 30,
        centeredSlides: true,
        pagination: {
          el: '.swiper-pagination',
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        breakpoints: {
          960:{
            slidesPerView: 'auto'
          }
        }
      })
    }
    storeTruckSlider();
  </script>
</body>
</html>
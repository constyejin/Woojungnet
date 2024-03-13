<?
include "../inc/header.php";
include "../inc/menu_sub.php";

$image_sub=sql_fetch("select * from image_sub where sub_type='sub' and sub_menu='회사소개' order by idx desc ");
$image_cer=sql_list("select * from image_certificate where 1=1 $where order by cer_list asc ");
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
  <div class="content-wrap sub greetings">
    <div class="anchor-wrap">
      <a href="#" class="anchor"></a>
    </div>
    <section class="greeting-header">
      <div class="container">
        <div class="prefix">
          <h2>인사말</h2>
        </div>
        <div class="suffix">
          <div class="home">
            <a href="./main.html" class="btn-home">
              <span class="icon-home"></span>
            </a>
          </div>
          <div class="location">
            회사소개 > 인사말
          </div>
        </div>
      </div>
    </section>
    <section class="greeting item">
      <div class="container">
        <div class="greeting-text">
          <span>안녕하세요</span><br>
          <span class="marker">1톤트럭 롱바디 특장전문</span><br>
          <span>나르미모터스입니다</span>
        </div>

        <div class="greet-img">
          <img src="/front/src/image/img_greet.png" alt="회사 인사말사진">
        </div>
      </div>
    </section>
    <section class="values item">
      <div class="container">
        <div class="left">
          <img src="/front/src/image/img_greet_logo.png" alt="나르미 로고">
        </div>
        <div class="right">
          <ul>
            <li>
              <p class="title">
                <span class="en">PARTNERSHIP</span>
                함께하는 운송 파트너
              </p>
              <p class="value-text">
                특장 전문 제작 전문 나르미모터스에서는 다양한 라인업을 보유하고 있어 맞춤형 차량 제작이 가능합니다.<br>
                고객들의 물음에 친절하게 다가가는 서비스 장인의 마음으로 함께하는 든든한 운송 파트너, 더 길어진 나르미 제품이 더 길게, 더 오래 고객의 곁을 지키겠습니다.
              </p>
            </li>
            <li>
              <p class="title">
                <span class="en">QUALITY</span>
                최고의 기술, 최고의 제품
              </p>
              <p class="value-text">
                최고의 기술력과 안전성으로 더 길게 더 오래, 그리고 더 안전하게 고객의 곁을 함께합니다.<br>
                나르미모터스의 특허 기술인 봄볼팅 공법으로 제작된 바디프레임은 선박이나 항공, 건축에서 사용되는 최상의 기술력입니다. 단계별 공정과 검수과정을 통해 한 번, 교통안전공단의 기준에 따른 엄격한 테스트 과정을 통해 또 한 번.<br>
                나르미모터스의 제품이 고객의 일상을 함께하는 만큼 소중한 고객을 지키기 위한 안전과의 타협은 불가능합니다.
              </p>
            </li>
            <li>
              <p class="title">
                <span class="en">EXPLORATION</span>
                오늘의 땀, 내일의 기쁨
              </p>
              <p class="value-text">
                혁신적인 시도와, 새로운 만남. 내일이 기대되는 나르미모터스 나르미의 작은 시도가 고객에게 기쁨이 될 수 있도록, 기업내부연구소 R&D팀에서는 내일의 기쁨을 연구합니다. 개별화물용 1.6T 증톤트럭, 7인승 콜밴 등 <br>
                고객이 필요로하는 나르미모터스의 제품에 ‘특별함’이 담길 수 있도록 항상 모험하겠습니다.
              </p>
            </li>
          </ul>
          <div class="promise-text">
            항상 많은 관심과 격려를 보내주시고 고객님들께 최상의 서비스를 제공할것을 약속드립니다.<br>- 나르미모터스 임직원 일동 -
          </div>
        </div>
      </div>
    </section>
    <section class="certification item">
      <div class="container">
        <p class="h3">
          인증서
        </p>
        <ul class="certi-list">
<? for($i=0;$i<count($image_cer);$i++){ ?>
          <li>
            <div class="img-wrap">
              <a href="" class="toggle-layer-pop">
                <img src="/images/img/<?=$image_cer[$i][cer_file]?>" alt="인증서 사진" onclick="document.getElementById('l_pop').src='/images/img/<?=$image_cer[$i][cer_file]?>';">
              </a>
            </div>
            <div class="cert-title">
              <?=$image_cer[$i][cer_title]?>
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
        <img src="/front/src/image/sample/certi.png" alt="옵션사진" id="l_pop">
      </div>
    </div>
   
  </div>


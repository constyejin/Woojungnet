<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
    <section class="slide lg-only">
      <div>
        <ul class="slide-img-list">
          <?
            $sql = "select * from image_main where main_view='Y' order by main_list asc";
            $result = mysql_query($sql);
            while ($data = mysql_fetch_array($result)) {
          ?>
          <li class="slide-img-item">
            <img src="/mainimg/<?= $data[main_file] ?>" alt="slide-img">
          </li>
          <?
            $k++;
          }
        ?>
        </ul>

        <div class="slide-fix-txt lg-only">
          <div class="slide-fix-txt-main">
            <p>자동차보링전문기업 !!! KGBORING</p>
            <p>신속,정확,안전한서비스를 약속드립니다</p>
          </div>
          <p class="slide-fix-txt-sub">오랜경험과 노하우로 고객님들께 최선을 다 하겠습니다</p>
        </div>
      </div>
    </section>

    <section class="main-img sm-only">
      <div class="main-img-box">
        <img src="/inc/assets/images/slide03.jpeg" alt="main-image">
      </div>

      <div class="slide-fix-txt">
        <div class="slide-fix-txt-main">
          <p>자동차엔진&#40;보링&#41;전문기업</p>
          <p>&#40;주&#41;<span>보링공업에서</span></p>
          <p>안전한서비스를 보장합니다</p>
        </div>
      </div>
    </section>

    <div class="main-bottom-menu sm-only">
      <ul>
        <li><a href="/menu01/intro.php/#map-sec">오시는길</a></li>
        <li><a href="/menu03/estimate.php">견적신청</a></li>
      </ul>
    </div>

    <script src="/inc/js/main-slide.js"></script>
    
<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

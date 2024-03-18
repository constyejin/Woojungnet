<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
    <section class="slide">
      <div>
        <ul class="slide-img-list">
          <?
            $sql = "select * from home_main where type='1' and view='Y' order by list_num asc";
            $result = mysql_query($sql);
            while ($data = mysql_fetch_array($result)) {
          ?>
          <li class="slide-img-item">
            <img src="/mainimg/<?= $data[imgfile] ?>" alt="slide-img">
          </li>
          <?
            $k++;
          }
        ?>
        </ul>

        <div class="slide-fix-txt">
          <div class="slide-fix-txt-main">
            <p>자동차엔진 !!! 경기보링공업에 맡겨주십시요</p>
            <p>신속,정확,안전한 서비스를 보장합니다</p>
          </div>
          <p class="slide-fix-txt-sub">오랜경험과 노하우로 고객님들께 최선을 다 하겠습니다</p>
        </div>
      </div>
    </section>

    <script src="/inc/js/main-slide.js"></script>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

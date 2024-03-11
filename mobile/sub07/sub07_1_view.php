<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/header.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/menu.php";

$idx = $wc_idx;
if ($wc_idx) {
  $qry = "select * from woojung_part where wc_idx = '$wc_idx'  ";
  $row = mysql_fetch_array(mysql_query($qry));
  $wc_car_img1 = explode("/", $row[wc_img_1]);
  $defaultFile = "/data/" . $wc_car_img1[0];
  $qry = "select * from woojung_member where userId = '$row[wc_mem_id]'  ";
  $row_m = mysql_fetch_array(mysql_query($qry));

  $cate1 = mysql_fetch_array(mysql_query("select * from cate2 where idx='" . $row[wc_made] . "'"));
  $cate3 = mysql_fetch_array(mysql_query("select * from cate3 where idx='" . $row[wc_trans] . "'"));

  // 오늘 본 상품 세션에 상품번호(p_no) 저장하기
  if (empty($_SESSION['VISIT'][0]) || is_null($_SESSION['VISIT'][0])) {
    $_SESSION['VISIT'][0] = $wc_idx;
  } elseif (!in_array($wc_idx, $_SESSION['VISIT'])) {
    $temp_p_no = $_SESSION['VISIT'][0];

    // 상품 밀기
    $_SESSION['VISIT'][0] = $wc_idx;
    $_SESSION['VISIT'][3] = $_SESSION['VISIT'][2];
    $_SESSION['VISIT'][2] = $_SESSION['VISIT'][1];
    $_SESSION['VISIT'][1] = $temp_p_no;
  }
}
?>

<section class="title-wrap">
  <h2>중고차량</h2>
</section>

<section class="view-detail">
  <div class="div_information">
    <span class="label">No :</span><span class="dd">24-0202552</span> &nbsp;/&nbsp;
    <span class="dd">싼타페</span> &nbsp;/&nbsp;
    <span class="dd">차량번호</span> &nbsp;/&nbsp;
    <span class="dd">사고이력</span> &nbsp;/&nbsp;
    <span class="dd">  년 월</span> &nbsp;/&nbsp;
    <span class="dd">자동/오토</span> &nbsp;/&nbsp;
    <span class="dd">하이브리드</span> &nbsp;/&nbsp;
    <span class="dd">cc</span> &nbsp;/&nbsp;
    <span class="dd">km</span>
  </div>
  
  <div class="car-image-slide bxslider">
      <?
    for ($i = 1; $i <= 60; $i++) {
      $fim = "wc_img_" . $i;
      $fileName = $row[$fim];
      $real_name = explode('/', $fileName);
      if (strlen($real_name[0]) == 0) {
        $fileName = '';
      } else {
        $fileName = $site_u[home_url] . "/data2/" . $real_name[0];
    ?>
        <div class="slide">
          <img src="<?= $fileName ?>" alt="">
        </div>
        <?
      }
    }
  ?>
  </div>

  <!-- thumbnail -->
  <!-- <div class="car-image-thumbnail">
    <?
    for ($i = 1; $i <= 60; $i++) {
      $fim = "wc_img_" . $i;
      $fileName = $row[$fim];
      $real_name = explode('/', $fileName);
      if (strlen($real_name[0]) > 0) {
        $fileName = $site_u[home_url] . "/data2/" . $real_name[0];
    ?>
      <div data-thumb="<?= $i ?>" class="thumb<?= $i == 1 ? ' on' : "" ?>">
          <img src="<?= $fileName ?>" alt="">
      </div>
      <?
    }
  }
  ?>
  </div> -->

    <div class="parts-description">
        <div class="table-style w-100">
            <ul>
                <li>
                    <div class="th">NO</div>
                    <div class="td"><?= $row[wc_orderno] ?></div>
                </li>
                <li>
                    <div class="th">차량명</div>
                    <div class="td"><?= $row['wc_mem_etc'] ?></div>
                </li>
                <li>
                    <div class="th">제조사</div>
                    <div class="td"><?= $cate1[name] ?> &gt; <?= $row[wc_model] ?></div>
                </li>
                <li>
                    <div class="th w-100">차량정보</div>
                </li>
                <li>
                    <div class="td align-c">
                        <span><?= $row[wc_age] ?></span> ㅣ <span><?= $row[wc_trans] ?></span> ㅣ
                        <span><?= $row[wc_fual] ?></span>
                        <br>
                        <br>
                        <span><?= number($row[wc_cc]) ?>cc</span> ㅣ <span><?= number($row[wc_mileage]) ?>km</span>
                        <br>
                        <br>
                        <span>전화문의</span>
                    </div>
                </li>
                <li>
                    <div class="td">
                        <?= $row[wc_option_add] ?>
                    </div>
                </li>
            </ul>
        </div>
        <div class="btn-group align-c">
            <div class="center">
                <a href="./sub07_1.php" class="btn btn-outline-primary btn-sm btn-round">목록보기</a>
            </div>
        </div>
    </div>
</section>


<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/footer.php";
?>
<script>
$(document).ready(function() {
  const bx = $('.car-image-slide').bxSlider({
      // mode: 'fade',
      // speed: 100,
      auto: false,
      autoControls: false,
      stopAutoOnClick: false,
      pager: true,
      pagerType: 'short',
      autoHover: false,
      controls: true,
      infiniteLoop: false,
      nextText: '>',
      prevText: '<',
      // onSlideAfter: function($slideElement, oldIndex, newIndex) {
      //     $('.car-image-thumbnail > div[data-thumb="' + (newIndex + 1) + '"]').addClass('on')
      //         .siblings().removeClass('on');

      // }
  });
  // $('.car-image-thumbnail > div').on('mouseenter', function(e) {
  //     var target = $(this).data('thumb');
  //     $(this).addClass('on').siblings().removeClass('on');
  //     bx.goToSlide(target - 1);
  // });
});
</script>

</body>

</html>

<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";

$idx=$wc_idx;
if($wc_idx){
	$qry = "select * from woojung_part where wc_idx = '$wc_idx'  ";
	$row = mysql_fetch_array(mysql_query($qry));
	$wc_car_img1 = explode("/",$row[wc_img_1]);
	$defaultFile = "/data/".$wc_car_img1[0];
	$qry = "select * from woojung_member where userId = '$row[wc_mem_id]'  ";
	$row_m = mysql_fetch_array(mysql_query($qry));

	$cate1=mysql_fetch_array(mysql_query("select * from cate2 where idx='".$row[wc_made]."'"));
	$cate3=mysql_fetch_array(mysql_query("select * from cate3 where idx='".$row[wc_trans]."'"));

	// 오늘 본 상품 세션에 상품번호(p_no) 저장하기
	if(empty($_SESSION['VISIT'][0]) || is_null($_SESSION['VISIT'][0])) {
		$_SESSION['VISIT'][0] = $wc_idx;
	} elseif(!in_array($wc_idx, $_SESSION['VISIT'])) {
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
    <h2>부품차량</h2>
  </section>
  <section class="view-detail">
    <div class="car-image-slide bxslider">
<?
for($i=1; $i<=8; $i++) {
	$fim="wc_img_".$i;
	$fileName = $row[$fim];
	$real_name = explode('/', $fileName);	
	if(strlen($real_name[0]) == 0)
	{
		$fileName = '';
	}
	else
	{
		$fileName = $site_u[home_url]."/data/".$real_name[0];
	}
?>
      <div class="slide"><img src="<?=$fileName?>" alt=""></div>
<?
  }
?>
    </div>
    <div class="car-image-thumbnail">
<?
for($i=1; $i<=8; $i++) {
	$fim="wc_img_".$i;
	$fileName = $row[$fim];
	$real_name = explode('/', $fileName);	
	if(strlen($real_name[0]) > 0)
	{
		$fileName = $site_u[home_url]."/data/".$real_name[0];
?>
      <div class="thumb<?=$i==1?' on':""?>">
        <img src="<?=$fileName?>" alt="">
      </div>
<?
	}
  }
?>
    </div>
    <div class="parts-description">
      <div class="table-style">
        <ul>
          <li>
            <div class="th">고유번호</div>
            <div class="td"><?=$row[wc_orderno]?></div>
          </li>
          <li>
            <div class="th">부품구분</div>
            <div class="td"><?=$cate3[name]?></div>
          </li>
          <li>
            <div class="th">제조/모델</div>
            <div class="td"><?=$cate1[name]?> &gt; <?=$row[wc_model]?></div>
          </li>
          <li>
            <div class="th">년식</div>
            <div class="td"><?=$row[wc_age]?></div>
          </li>
          <li>
            <div class="th">등급</div>
            <div class="td"><?=$row[wc_kind]?></div>
          </li>
          <li>
            <div class="th">재고</div>
            <div class="td"><?=$row[wc_mileage]!="1"?number($row[wc_cc])." 개":"재고없음"?></div>
          </li>
          <li>
            <div class="th">가격</div>
            <div class="td"><?=$row[wc_cost]!="1"?number($row[wc_keep_tel1])."원":"전화문의"?></div>
          </li>
        </ul>
      </div>
      <p class="notice">
        * 재고수량과 판매가격등은 판매자와 상의하세요.
      </p>

      <h2>상세설명</h2>
      <div class="description-text">
        <?=$row[wc_option_add]?>
      </div>
      <div class="btn-group align-c">
        <div class="center">
          <a href="./sub08_1.php" class="btn btn-outline-primary btn-sm btn-round">목록보기</a>
        </div>
      </div>
    </div>
  </section>


<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
  <script>
    $(document).ready(function() {
        $('.car-image-slide').bxSlider({
            auto: false,
            autoControls: false,
            stopAutoOnClick: false,
            pager: true,
            pagerType: 'short',
            autoHover: false,
            controls: true,
            infiniteLoop: false
        });
    });
  </script>

</body>
</html>
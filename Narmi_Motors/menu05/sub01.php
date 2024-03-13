<?
include "../inc/header.php";
include "../inc/menu_sub.php";

$web_config=sql_fetch("select * from web_config where idx=1 ");
$image_sub=sql_fetch("select * from image_sub where sub_type='sub' and sub_menu='부품구매' order by idx desc ");
$option_part=sql_list("select * from option_part where 1=1 $where order by part_list asc, idx desc ");
$total_count=sql_total("select count(*) as cnt from option_part where 1=1 $where ");
$list_num=$total_count-$page_start;
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
  <div class="content-wrap sub store-released">
    <div class="anchor-wrap">
      <a href="#" class="anchor"></a>
    </div>
    <section class="greeting-header">
      <div class="container">
        <div class="prefix">
        </div>
        <div class="suffix">
          <div class="home">
            <a href="./main.html" class="btn-home">
              <span class="icon-home"></span>
            </a>
          </div>
          <div class="location">
            <span>&gt;</span>
            <span>부품구매</span>
          </div>
        </div>
      </div>
    </section>
    <div class="container">
      <p class="h2">
        부품구매
      </p>
      <p class="sub-text">부품구매는 <span class="fc-naver">네이버 스마트스토어</span>에서 바로 구매가능합니다. <a href="<?=$web_config[web_smart]?>" class="btn btn-black sm" target="_blank">바로가기 +</a> </p>
      <div class="vehicle-list">
        <ul>
<? for($i=0;$i<count($option_part);$i++){ ?>
          <li>
            <a href="<?=$web_config[web_smart]?>" target="_blank">
              <div class="tag"><?=$list_num--;?></div>
              <div class="border-wrap">
                <div class="img-wrap">
                  <img src="/images/opt/<?=$option_part[$i][part_file]?>" alt="차량썸네일">
                </div>
                <div class="title"><?=$option_part[$i][part_name]?></div>
                <div class="price"><?=number($option_part[$i][part_price])?>원</div>
              </div>
            </a>
          </li>
<? } ?>
        </ul>
      </div>
      <div class="pagination">
<? echo paging_f($page, $page_row, $page_scale, $total_count, $ext); ?>               
      </div>
    </div>
  </div>
<?
include "../inc/consult_form.php";
include "../inc/footer.php";
?>

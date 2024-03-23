<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<?
if($wc_idx){
	$woojung_part=sql_fetch("select * from woojung_part where wc_idx='$wc_idx' ");
}
?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/inc/styles/form-table.css">
<link rel="stylesheet" href="/menu02/style/workStatus_view.css">
<!-- bxslider -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

<main class="work-status">
  <section>
    <h2 class="sub-title">작업현황
      <p>작업중이거나 작업이 완료된 차량정보입니다</p>
    </h2>
    <p class="top-list-btn">
      <a href="/menu02/workStatus_list.php">목록보기 LIST</a>
    </p>

    <form name="" method="" action="" enctype="">
      <div class="table-form">
        <ul class="car-title">
          <li class=""><?=$woojung_part[wc_mem_etc]?></li>
          <span>|</span>
          <li class=""><?=$woojung_part[wc_age]?></li>
          <span>|</span>
          <li class=""><?=number($woojung_part[wc_mileage])?>km</li>
        </ul>

        <ul>
          <li>
            <div class="car-image">
              <div class="img-wrap bxslider">
                <?
                $imgCnt = 0;
                for($i=1; $i<=60; $i++) {

                  $fim="wc_img_".$i;
                  $fileName = $woojung_part[$fim];
                  $real_name = explode('/', $fileName);	
                  
                  if(strlen($real_name[0]) == 0)
                  {
                    $fileName = '';
                    break;
                  }
                  else
                  {
                    $imgCnt++;
                    $fileName = $site_u[home_url]."/data/".$real_name[0];
                  }
                ?>
                <div data-hash="<?=$i?>" class="slide">
                  <img src="<?=$fileName?>" alt="차량이미지">
                </div> 
                <?
                  $cnt++;
                }	
                ?>

              </div>
            </div>

            <div class="img-list-wrap view-thumb lg-only">
              <div class="img-list">
                <div class="thum-btn-list">
                  <button class="prev-btn">
                    <i class="fa-solid fa-angle-left"></i>
                  </button>

                  <button class="next-btn">
                    <i class="fa-solid fa-angle-right"></i>
                  </button>
                </div>
                
                <ul> 
                <?
                $imgCnt = 0;
                for($i=1; $i<=60; $i++) {

                  $fim="wc_img_".$i;
                  $fileName = $woojung_part[$fim];
                  $real_name = explode('/', $fileName);	
                  
                  if(strlen($real_name[0]) == 0)
                  {
                    $fileName = '';
                    break;
                  }
                  else
                  {
                    $imgCnt++;
                    $fileName = $site_u[home_url]."/data/".$real_name[0];
                  }
                ?>
                  <li data-thumb="<?=$i?>">
                    <img src="<?=$fileName?>" alt="차량이미지 썸네일">
                  </li> 
                <?
                  $cnt++;
                }	
                ?>

                  <!--li data-thumb="2">
                    <img src="/inc/assets/images/slide01.jpeg" alt="차량이미지 썸네일">
                  </li--> 
                </ul>
              </div>
            </div>
          </li>
        </ul>

        <div class="work-status-table">
          <ul class="table-list border-top">
            <li class="table-title">차량명</li>
            <li class="table-content"><?=$woojung_part[wc_mem_etc]?></li>
          </ul>
          <ul class="table-list">
            <li class="table-title">년식</li>
            <li class="table-content">
              <span><?=$woojung_part[wc_age]?></span>
              <span>년</span>
            </li>
          </ul>
          <ul class="table-list">
            <li class="table-title">주행거리</li>
            <li class="table-content">
              <span><?=number($woojung_part[wc_mileage])?></span>
              <span>Km</span>
            </li>
          </ul>
          <ul class="table-list">
            <li class="table-title">작업비</li>
            <li class="table-content">
              <span><?=number($woojung_part[wc_keep_tel1])?></span>
              <span>원</span>
            </li>
          </ul>
          <ul class="table-list align-col">
            <li class="table-title">상세설명</li>
            <li class="table-content">
              <?=$woojung_part[wc_option_add]?>
            </li>
          </ul>
        </div>
      </div>
    </form>

    <div class="post-btn-box lg-only">
      <div>
        <button class="post-btn show-list-btn">
          <a href="/menu02/workStatus_list.php">목록보기</a>
        </button>
  <? if($_SESSION[login_level]>="10"&&$_SESSION[login_level]<="40"){ ?>
        <button class="post-btn register-btn">
          <a href="/menu02/workStatus_write.php?wc_idx=<?=$wc_idx?>">수정하기</a>
        </button>
  <? } ?>
      </div>
    </div>
  </section>
</main>

<script src="/inc/js/car-slide.js"></script>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

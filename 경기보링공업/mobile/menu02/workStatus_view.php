<? include $_SERVER['DOCUMENT_ROOT']."/mobile/inc/header.php"; ?>

<link rel="stylesheet" href="/mobile/menu02/style/workStatus_view.css">
<link rel="stylesheet" href="/inc/styles/form-table.css">
<!-- bxslider -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

<main class="work-status">
  <section>
    <div class="top-list-btn">
      <p class="menu-path"><a href="/mobile/index.php">홈</a> > 작업현황</p>
      <p>
        <a href="/mobile/menu02/workStatus_list.php">목록보기 LIST</a>
      </p>
    </div>

    <form name="" method="" action="" enctype="">
      <div class="table-form">
        <ul class="car-title">
          <li class="">테스트</li>
          <span>|</span>
          <li class="">2014</li>
          <span>|</span>
          <li class="">300,000km</li>
        </ul>

        <ul>
          <li>
            <div class="car-image">
              <div class="img-wrap bxslider">
                <div data-hash="" class="slide">
                  <img src="/inc/assets/images/slide01.jpeg" alt="차량이미지">
                </div> 

                <div data-hash="" class="slide">
                  <img src="/inc/assets/images/slide02-1.jpeg" alt="차량이미지">
                </div> 
              </div>
            </div>
          </li>
        </ul>

        <div class="work-status-table">
          <ul class="table-list border-top">
            <li class="table-title">차량명</li>
            <li class="table-content">테스트</li>
          </ul>
          <ul class="table-list">
            <li class="table-title">년식</li>
            <li class="table-content">
              <span>2014</span>
              <span>년</span>
            </li>
          </ul>
          <ul class="table-list">
            <li class="table-title">주행거리</li>
            <li class="table-content">
              <span>300,000</span>
              <span>Km</span>
            </li>
          </ul>
          <ul class="table-list">
            <li class="table-title">작업비</li>
            <li class="table-content">
              <span></span>
              <span>원</span>
            </li>
          </ul>
          <ul class="table-list align-col">
            <li class="table-title">상세설명</li>
            <li class="table-content">
              상세설명
            </li>
          </ul>
        </div>
      </div>
    </form>
  </section>
</main>

<script src="/inc/js/car-slide.js"></script>
<? include $_SERVER['DOCUMENT_ROOT']."/mobile/inc/footer.php"; ?>

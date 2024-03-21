<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/inc/styles/form-table.css">
<link rel="stylesheet" href="/menu02/style/workStatus_view.css">
<!-- bxslider -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

<main class="work-status">
  <section>
    <h2 class="sub-title lg-only">작업현황</h2>
    <div class="list-link">
      <p class="lg-only">작업중이거나 작업이 완료된 차량정보입니다</p>
      <p class="menu-path sm-only"><a href="/">홈</a> > 작업현황</p>
      <p>
        <a href="/menu02/workStatus_list.php">목록보기 LIST</a>
      </p>
    </div>

    <form name="" method="" action="" enctype="">
      <div class="table-form">
        <ul class="car-title">
          <li class="">그렌저2.4</li>
          <span>|</span>
          <li class="">2015</li>
          <span>|</span>
          <li class="">100,000km</li>
        </ul>

        <ul class="">
          <li>
            <div class="car-image">
              <div class="img-wrap bxslider">
                <div data-hash="1" class="slide">
                  <img src="/inc/assets/images/road.jpeg" alt="차량이미지">
                </div> 

                <div data-hash="2" class="slide">
                  <img src="/inc/assets/images/slide01.jpeg" alt="차량이미지">
                </div> 
              </div>
            </div>

            <div class="img-list-wrap view-thumb">
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
                  <li data-thumb="1">
                    <img src="/inc/assets/images/road.jpeg" alt="차량이미지 썸네일">
                  </li> 

                  <li data-thumb="2">
                    <img src="/inc/assets/images/slide01.jpeg" alt="차량이미지 썸네일">
                  </li> 
                </ul>
              </div>
            </div>
          </li>
        </ul>

        <ul class="table-list border-top">
          <li class="table-title">차량명</li>
          <li class="table-content">그렌저2.4</li>
        </ul>

        <ul class="table-list">
          <li class="table-title">년식</li>
          <li class="table-content">
            <span>2015</span>
            <span>년</span>
          </li>
        </ul>

        <ul class="table-list">
          <li class="table-title">주행거리</li>
          <li class="table-content">
            <span>100,000</span>
            <span>Km</span>
          </li>
        </ul>

        <ul class="table-list">
          <li class="table-title">작업비</li>
          <li class="table-content">
            <span>999,999</span>
            <span>원</span>
          </li>
        </ul>

        <ul class="table-list align-col">
          <li class="table-title">상세설명</li>
          <li class="table-content">
            <p>상세설명 : 1</p>
            <p>상세설명 : 2</p>
            <p>상세설명 : 3</p>
            <p>상세설명 : 4</p>
            <p>상세설명 : 5</p>
          </li>
        </ul>
      </div>
    </form>

    <div class="post-btn-box lg-only">
      <div>
        <button class="post-btn show-list-btn">
          <a href="/menu02/workStatus_list.php">목록보기</a>
        </button>
        <button class="post-btn register-btn">
          <a href="/menu02/workStatus_modify.php">수정하기</a>
        </button>
      </div>
    </div>
  </section>
</main>

<script src="/inc/js/car-slide.js"></script>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

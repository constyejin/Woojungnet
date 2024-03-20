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
    <h2 class="sub-title">작업현황</h2>
    <div class="sub-txt">
      <p>작업중이거나 작업이 완료된 차량정보입니다</p>
      <p>
        <a href="/menu02/workStatus_list.php">목록보기 LIST</a>
      </p>
    </div>

    <form name="" method="" action="" enctype="">
      <table>
        <thead>
          <tr class="item-title table-lg-box">
            <th colspan="2">
              <span>그렌저2.4</span>|
              <span>2015</span>|
              <span> 100,000km</span>
            </th>
          </tr>

          <tr class="item-img">
            <td colspan="2" style="padding:0; border:none;">
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
            </td>
          </tr>
        </thead>

        <tbody>
          <tr>
            <th>차량명</th>
            <td>그렌저2.4</td>
          </tr>

          <tr>
            <th>년식</th>
            <td class="sm-input">
              <span>2015</span>
              <span>년</span>
            </td>
          </tr>

          <tr>
            <th>주행거리</th>
            <td class="sm-input">
              <span>100,000km</span>
              <span>Km</span>
            </td>
          </tr>

          <tr>
            <th>작업비</th>
            <td class="sm-input">
              <span></span>
              <span>원</span>
            </td>
          </tr>

          <tr class="table-lg-box">
            <th colspan="2"">상세설명</th>
          </tr>

          <tr class="item-description">
            <td colspan="2">
              <p>상세설명 : 1</p>
              <p>상세설명 : 2</p>
              <p>상세설명 : 3</p>
              <p>상세설명 : 4</p>
              <p>상세설명 : 5</p>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="post-btn-box">
        <div>
          <button class="post-btn show-list-btn">
            <a href="/menu02/workStatus_list.php">목록보기</a>
          </button>
          <button class="post-btn register-btn">
            <a href="/menu02/workStatus_modify.php">수정하기</a>
          </button>
        </div>
      </div>
    </form>
  </section>
</main>

<script src="/inc/js/car-slide.js"></script>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

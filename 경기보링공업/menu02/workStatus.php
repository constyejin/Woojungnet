<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
  <link rel="stylesheet" href="./workStatus.css">
    <section class="main-banner">
      <div>
        <img src="/inc/assets/images/slide02.jpeg" alt="slide-img01">

        <div class="main-banner-txt">
          <div>
            <p>자동차엔진 !!! 경기보링공업에 맡겨주십시요</p>
            <p>신속,정확,안전한 서비스를 보장합니다</p>
          </div>
          <p>오랜경험과 노하우로 고객님들께 최선을 다 하겠습니다</p>
        </div>
      </div>
    </section>

    <main class="work-status">
      <section>
        <h2 class="sub-title">작업현황</h2>
        <form action="" method="">
          <ul class="work-status-list">
            <li class="work-status-item">
              <div class="work-status-chk">
                <input type="checkbox" name="" value="">
                <span>5</span>
              </div>

              <a href="./workStatus_view.html">
                <div class="work-status-img">
                  <img src="/inc/assets/images/slide01.jpeg" alt="">
                </div>
                <b>2018 BMW</b>
              </a>
            </li>
            
            <li class="work-status-item">
              <div class="work-status-chk">
                <input type="checkbox" name="" value="">
                <span>4</span>
              </div>

              <a href="./workStatus_view.html">
                <div class="work-status-img">
                  <img src="/inc/assets/images/slide01.jpeg" alt="">
                </div>
                <b>2018 BMW</b>
              </a>
            </li>

            <li class="work-status-item">
              <div class="work-status-chk">
                <input type="checkbox" name="" value="">
                <span>3</span>
              </div>

              <a href="./workStatus_view.html">
                <div class="work-status-img">
                  <img src="/inc/assets/images/slide01.jpeg" alt="">
                </div>
                <b>2018 BMW</b>
              </a>
            </li>

            <li class="work-status-item">
              <div class="work-status-chk">
                <input type="checkbox" name="" value="">
                <span>2</span>
              </div>
              
              <a href="./workStatus_view.html">
                <div class="work-status-img">
                  <img src="/inc/assets/images/slide01.jpeg" alt="">
                </div>
                <b>2018 BMW</b>
              </a>
            </li>

            <li class="work-status-item">
              <div class="work-status-chk">
                <input type="checkbox" name="" value="">
                <span>1</span>
              </div>

              <a href="./workStatus_view.html">
                <div class="work-status-img">
                  <img src="/inc/assets/images/slide01.jpeg" alt="">
                </div>
                <b>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt, ducimus.</b>
              </a>
            </li>
          </ul>
        </form>
      </section>

      <section class="work-status-control">
        <button class="post-btn select-del-btn">선택삭제</button>

        <div class="pagenation">
          <div>
            <a href="">
              <i class="fa-solid fa-angles-left"></i>
            </a>
            <a href="">
              <i class="fa-solid fa-angle-left"></i>
            </a>
          </div>

          <ol>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
          </ol>

          <div>
            <a href="">
              <i class="fa-solid fa-angle-right"></i>
            </a>
            <a href="">
              <i class="fa-solid fa-angles-right"></i>
            </a>
          </div>
        </div>

        <button class="post-btn register-btn">
          <a href="./workStaus_register.html">등록하기</a>
        </button>
      </section>
    </main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>

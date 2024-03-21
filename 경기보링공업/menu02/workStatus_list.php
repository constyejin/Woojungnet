<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/menu02/style//workStatus.css">

<main class="work-status">
  <section>
    <p class="menu-path sm-only"><a href="/">홈</a> > 작업현황</p>
    <h2 class="sub-title">작업현황
      <p class="sm-only">작업중이거나 작업이 완료된 차량정보입니다</p>
    </h2>
    <form action="" method="">
      <ul class="work-status-list">
        <li class="work-status-item">
          <div class="work-status-chk lg-only">
            <input type="checkbox" name="" value="">
            <span>3</span>
          </div>

          <a href="/menu02/workStatus_view.php">
            <div class="work-status-img">
              <img src="/inc/assets/images/slide01.jpeg" alt="">
            </div>
            <b>소나타차차ㅏ타</b>
          </a>
        </li>

        <li class="work-status-item">
          <div class="work-status-chk lg-only">
            <input type="checkbox" name="" value="">
            <span>2</span>
          </div>

          <a href="/menu02/workStatus_view.php">
            <div class="work-status-img">
              <img src="/inc/assets/images/slide01.jpeg" alt="">
            </div>
            <b>2022 BMWWWW</b>
          </a>
        </li>

        <li class="work-status-item">
          <div class="work-status-chk lg-only">
            <input type="checkbox" name="" value="">
            <span>1</span>
          </div>

          <a href="/menu02/workStatus_view.php">
            <div class="work-status-img">
              <img src="/inc/assets/images/slide01.jpeg" alt="">
            </div>
            <b>2018 BMW</b>
          </a>
        </li>
      </ul>
    </form>
  </section>

  <section class="work-status-control">
    <button class="post-btn select-del-btn lg-only">선택삭제</button>

    <div class="pagenation">
      <div class="pagenation-icons prev">
        <a href=""></a>
        <a href=""></a>
      </div>

      <ol class="pagenation-list">
        <li class="active"><a href="">1</a></li>
        <li><a href="">2</a></li>
        <li><a href="">3</a></li>
      </ol>

      <div class="pagenation-icons next">
        <a href=""></a>
        <a href=""></a>
      </div>
    </div>

    <button class="post-btn register-btn lg-only">
      <a href="/menu02/workStaus_write.php">등록하기</a>
    </button>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

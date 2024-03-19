<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/menu02/style//workStatus.css">

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
    <button class="post-btn select-del-btn">선택삭제</button>

    <div class="pagenation">
      <div class="pagenation-icons">
        <a href="">
          <i class="fa-solid fa-angles-left"></i>
        </a>
        <a href="">
          <i class="fa-solid fa-angle-left"></i>
        </a>
      </div>

      <ol class="pagenation-list">
        <li class="active"><a href="">1</a></li>
        <li><a href="">2</a></li>
        <li><a href="">3</a></li>
      </ol>

      <div class="pagenation-icons">
        <a href="">
          <i class="fa-solid fa-angle-right"></i>
        </a>
        <a href="">
          <i class="fa-solid fa-angles-right"></i>
        </a>
      </div>
    </div>

    <button class="post-btn register-btn">
      <a href="/menu02/workStaus_write.php">등록하기</a>
    </button>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

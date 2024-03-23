<? include $_SERVER['DOCUMENT_ROOT']."/mobile/inc/header.php"; ?>
<link rel="stylesheet" href="/mobile/menu02/style//workStatus.css">

<main class="work-status">
  <section>
    <p class="menu-path"><a href="/mobile/index.php">홈</a> > 작업현황</p>
    <h2 class="sub-title">작업현황
      <p>작업중이거나 작업이 완료된 차량정보입니다</p>
    </h2>

    <form name="f" action="proc.php" method="post" target="HiddenFrm">
      <input type="hidden" name="mode" value="delete">
      <ul class="work-status-list">
        <li class="work-status-item">
          <a href="/mobile/menu02/workStatus_view.php">
            <div class="work-status-img">
              <img src="/inc/assets/images/slide01.jpeg" alt="">
            </div>
            <b>Title</b>
          </a>
        </li>

        <li class="work-status-item">
          <a href="/mobile/menu02/workStatus_view.php">
            <div class="work-status-img">
              <img src="/inc/assets/images/slide01.jpeg" alt="">
            </div>
            <b>Title</b>
          </a>
        </li>
      </ul>
    </form>
  </section>

  <section class="work-status-control">
    <div class="pagenation">
      <ol class="pagenation-list">
        <li class="active">1</li>
      </ol>
    </div>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/mobile/inc/footer.php"; ?>

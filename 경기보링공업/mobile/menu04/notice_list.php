<? include $_SERVER['DOCUMENT_ROOT']."/mobile/inc/header.php"; ?>

<link rel="stylesheet" href="/mobile/menu04/style/notice.css">

<main class="notice">
  <section>
    <p class="menu-path"><a href="/">홈</a> > 공지사항</p>
    <h2 class="sub-title">공지사항</h2>

    <form name="lform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="/manage/inc/alldel.php">
      <input type="hidden" name="db_name" value="board">
      <div class="post-wrap">
        <div class="post-item">
          <a class="post-link" href="/mobile/menu04/notice_view.php">
            <p class="post-title">Test</p>
            <div>
              <p class="post-num">9999</p>
              <p>(주)경기보링공업</p>
              <p class="post-date">2024-03-24</p>
              <p class="post-see">조회<span>20</span>회</p>
            </div>
          </a>
        </div>

        <div class="post-item">
          <a class="post-link" href="/mobile/menu04/notice_view.php">
            <p class="post-title">Post</p>
            <div>
              <p class="post-num">123</p>
              <p>(주)경기보링공업</p>
              <p class="post-date">2024-03-21</p>
              <p class="post-see">조회<span>352</span>회</p>
            </div>
          </a>
        </div>
      </div>

      <div class="pagenation">
        <ol class="pagenation-list">
          <li class="active">1</li>
        </ol>
      </div>
    </form>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/mobile/inc/footer.php"; ?>


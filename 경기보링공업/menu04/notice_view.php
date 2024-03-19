<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/menu04/style/notice_narmi.css">

<main class="notice">
  <section>
    <h2 class="sub-title">공지사항</h2>

    <div class="content-wrap sub">
      <div class="anchor-wrap">
        <a href="#" class="anchor"></a>
      </div>
      <section class="notice-list">
        <div class="container">
          <div class="notice-detail-header">
            <div class="label">제목</div>
            <div class="dd title">Test</div>
            <div class="label">이름</div>
            <div class="dd name">나르미모터스</div>
            <div class="label">등록일</div>
            <div class="dd name">2023-06-07</div>
            <div class="label">조회</div>
            <div class="dd name">15</div>
          </div>

          <div class="notice-detail-body">
            <p class="download"></p>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque, repudiandae. Est, distinctio! Laudantium quod esse a, ipsa numquam in repellat porro, officia voluptate corporis eveniet neque dolor quas at dolorum?</p>        
          </div>

          <div class="post-btn-box">
            <button class="post-btn show-list-btn">
              <a href="/menu04/notice_list.php">목록보기</a>
            </button>
            <button class="post-btn register-btn">
              <a href="/menu04/notice_modify.php">수정하기</a>
            </button>
          </div>

          <div class="notice-detail-nav">
            <div class="label">이전글</div>
            <div class="dd title"><a href="sub01_view.php?idx="></a></div>
            <div class="label">다음글</div>
            <div class="dd title"><a href="sub01_view.php?idx="></a></div>
          </div>
        </div>
      </section>
   </div>

  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

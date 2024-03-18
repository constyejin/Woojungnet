<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/menu04/style/notice.css">

<main class="notice">
  <section>
    <h2 class="sub-title">공지사항</h2>
    
    <form name="" method="" action="" enctype="">
      <div class="search-box">
        <h4>공지사항</h4>
        <div class="search-box-right">
          <select name="" id="">
            <option value="">제목</option>
            <option value="">번호</option>
            <option value="">이름</option>
            <option value="">등록일</option>
          </select>
          <div class="serach">
            <input type="text">
            <button>검색</button>
          </div>
        </div>
      </div>

      <div class="post-wrap">
        <ul class="post-list">
          <li class="post-main">
            <ul>
              <li class="post-chk"><input type="checkbox"></li>
              <li class="post-num">번호</li>
              <li class="post-title">제목</li>
              <li class="post-name">이름</li>
              <li class="post-date">등록일</li>
              <li class="post-see">조회</li>
            </ul>
          </li>

          <li class="post-item">
            <span class="post-chk"><input type="checkbox"></span>
            <p class="post-num">2</p>
            <p class="post-title"><a href="">테스트</a></p>
            <p class="post-name">admin</p>
            <p class="post-date">2024.03.17</p>
            <p class="post-see">4</p>
          </li>

          <li class="post-item">
            <span class="post-chk"><input type="checkbox"></span>
            <p class="post-num">1</p>
            <p class="post-title"><a href="">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero blanditiis voluptatibus soluta mollitia quia ab est. Officia praesentium cum distinctio!</a></p>
            <p class="post-name">admin124</p>
            <p class="post-date">2024.03.17</p>
            <p class="post-see">133</p>
          </li>
        </ul>
      </div>

      <div class="post-btn-list">
        <button class="post-btn select-del-btn">
          선택삭제
        </button>
        <button class="post-btn register-btn">
            <a href="">글쓰기</a>
        </button>
      </div>
    </form>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

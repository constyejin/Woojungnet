<? include $_SERVER['DOCUMENT_ROOT']."/mobile/inc/header.php"; ?>

<link rel="stylesheet" href="/inc/styles/form-table.css">
<link rel="stylesheet" href="/mobile/menu03/style/estimate.css">

<main class="estimate">
  <section>
    <p class="menu-path"><a href="/">홈</a> > 견적신청</p>
    <h2 class="sub-title">견적신청
      <p>아래 내용을 남겨주시면 신속하게 보링전문상담원이 연락을 드립니다.</p>
    </h2>

    <form name="con_form" method="post" enctype="multipart/form-data" target="HiddenFrm" action="estimate_save.php" onsubmit="estimate_submit()">
      <div class="table-form">
        <ul class="table-list border-top">
          <li class="table-title">이름</li>
          <li class="table-content">
            <input type="text" name="con_name">
          </li>
        </ul>

        <ul class="table-list">
          <li class="table-title">연락처</li>
          <li class="table-content">
            <input type="text" name="con_phone">
          </li>
        </ul>

        <ul class="table-list">
          <li class="table-title">이메일</li>
          <li class="table-content">
            <input type="text" name="con_email">
          </li>
        </ul>

        <ul class="table-list">
          <li class="table-title">차량명</li>
          <li class="table-content">
            <input type="text" name="con_model">
          </li>
        </ul>

        <ul class="table-list">
          <li class="table-title">년식</li>
          <li class="table-content sm-input">
            <input type="text" name="con_year">
             <span>년</span>
          </li>
        </ul>

        <ul class="table-list align-col smart-editor">
          <li class="table-title">상세설명</li>

          <li class="table-content">
            <textarea name="" id="" cols="30" rows="10" style="width:100%; height:220px;"></textarea>
          </li>
        </ul>

        <ul class="table-list spam border-bottom">
          <li class="table-title">스팸방지</li>
          <li class="table-content sm-input">
            <input type="text" name="spam_code" value="123456" disabled>
            <input type="text" name="spam_input">
            <span>좌측 숫자를 입력하여주세요.</span>
          </li>
        </ul>
      </div>

      <b class="submit-notice">위 내용과 같이 견적신청을 합니다</b>
      <div class="submit-btn">
        <button type="submit" class="btn-blue-lg">견적신청</button>
      </div>
    </form>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/mobile/inc/footer.php"; ?>

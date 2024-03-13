<form name="con_form" method="post" enctype="multipart/form-data" target="HiddenFrm" action="/inc/consult_save.php">
    <section class="contact-us">
      <h2>고객문의 <span class="en">CONTACT US</span></h2>
      <ul>
        <li>
          <div class="label">· 고객명</div>
          <div class="input-wrap">
            <input type="text" name="con_name">
          </div>
        </li>
        <li>
          <div class="label">· 연락처</div>
          <div class="input-wrap">
            <input type="text" name="con_phone">
          </div>
        </li>
        <li>
          <div class="label">· 이메일</div>
          <div class="input-wrap">
            <input type="text"  name="con_email">
          </div>
        </li>
        <li>
          <div class="label">· 문의사항</div>
          <div class="input-wrap">
            <textarea rows="10"  name="con_memo"></textarea>
          </div>
        </li>
      </ul>
      <div class="btn-wrap">
        <button class="<?=$is_main!='ok'?'btn md ':''?>btn-contact">문의하기</button>
      </div>
    </section>
</form>

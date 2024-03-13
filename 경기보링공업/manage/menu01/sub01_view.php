<?
include "../inc/header.php";
include "../inc/menu.php";

if($idx) $mod_consult=sql_fetch("select * from consult where idx='$idx' ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>상담문의</h2>
    </div>
    <div class="content-container">

      <div class="container-fluid contact-manage-view">
        <!-- 상담문의 테이블 -->
        <div class="row mt-5">
          <div class="col-10">
            <table class="table table-layout border-type contact-detail">
              <colgroup>
                <col style="width: 150px;">
                <col style="width: auto;">
              </colgroup>
              <tbody class="table-light">
                <tr>
                  <th>등록일</th>
                  <td><?=substr($mod_consult[consult_regdate],0,10)?></td>
                </tr>
                <tr>
                  <th>고객명</th>
                  <td><?=$mod_consult[consult_name]?></td>
                </tr>
                <tr>
                  <th>연락처</th>
                  <td><?=$mod_consult[consult_phone]?></td>
                </tr>
                <tr>
                  <th>이메일</th>
                  <td><?=$mod_consult[consult_email]?></td>
                </tr>
                <tr>
                  <th class="answer">문의내용</th>
                  <td>
                    <?=nl2br($mod_consult[consult_memo])?>
                  </td>
                </tr>
                <tr>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- //상담문의 테이블 -->
        <!-- 답변 테이블 -->
        <div class="row mt-3">
          <div class="col-10">
            <h3>관리자메모</h3>
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub01_save.php">
<input type="hidden" name="idx" value="<?=$idx?>">
            <table class="table table-layout border-type answer-for-contact">
              <colgroup>
                <col style="width: auto;">
                <col style="width: 150px;">
              </colgroup>
              <tbody class="table-light">
                <tr>
                  <td>
                    <textarea name="consult_admin" class="form-control mt-2 mb-2" id="" cols="30" rows="5"><?=$mod_consult[consult_admin]?></textarea>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-square btn-secondary" onclick="document.wform.submit();">등록</button>
                  </td>
                </tr>
              </tbody>
            </table>
</form>
            <div class="table-footer justify-content-center mt-5">
              <div class="center">
                <a href="javascript:history.back();" class="btn btn-outline-primary btn-sm">목록보기</a>
              </div>
            </div>
          </div>
        </div>
        <!-- //답변 테이블 -->
      </div>
    </div>
  </div>
</body>
</html>
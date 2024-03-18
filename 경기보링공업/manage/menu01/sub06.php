<?
include "../inc/header.php";
include "../inc/menu.php";

$web_config=sql_fetch("select * from web_config where idx=1 ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>사이트설정</h2>
    </div>
    <div class="content-container">

      <div class="container-fluid site-setting">
        <!-- 사이트설정 테이블 -->
        <div class="row mt-5">
          <div class="col-12">
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub06_save.php">
            <table class="table table-layout border-type text-center site-setting">
              <colgroup>
                <col style="width: 180px">
                <col style="width: auto">
              </colgroup>
              <thead class="table-light">
                <tr>
                  <th>항목</th>
                  <th>내용</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    사이트명
                  </td>
                  <td>
                    <input type="text" class="form-control" name="web_sitename" value="<?=$web_config[web_sitename]?>">
                  </td>
                </tr>
                <tr>
                  <td>
                    메타태그
                  </td>
                  <td>
                    <textarea class="form-control" name="web_meta" id="" cols="30" rows="30"><?=$web_config[web_meta]?></textarea>
                  </td>
                </tr>
              </tbody>
            </table>
</form>
          </div>
        </div>
        <!-- //사이트설정 테이블 -->


        <div class="table-footer justify-content-center mt-5 mb-5">
          <div class="center">
            <a href="javascript:document.wform.submit();" class="btn btn-outline-secondary btn-sm" >등록하기</a>
          </div>
        </div>

      </div>
    </div>
  </div>

</body>
</html>
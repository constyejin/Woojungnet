<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/header.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/menu.php";
?>
<?
if (!$loginId) {
  echo "<script>alert('로그인후 사용 가능합니다.');location.href='/';</script>";
  exit;
}

$query = $db->query("select * from woojung_member where userId='$loginId' limit 1");
$row = mysql_fetch_object($query);
?>
<script>
function out_submit() {

    f = document.outForm;

    if (!f.car_name.value) {
        alert('차량번호를 입력해 주세요');
        return;
    }
    f.submit();
}
</script>

<div class="add-car">
    <section class="title-wrap">
        <h2>1:1상담</h2>
    </section>
    <section class="tab-wrap wide-type">
        <ul>
            <!--li class="tab">
          <a href="/sub01/sub01_1.php">차량등록</a>
        </li-->
            <li class="tab">
                <a href="/sub01/sub01_2.php">사진추가</a>
            </li>
            <li class="tab active">
                <a href="/sub01/sub01_3.php">1:1상담</a>
            </li>
        </ul>
    </section>
    <section class="add-photo">
        <form name="outForm" method="post" action="sub01_3_save.php" enctype="multipart/form-data"
            onsubmit='return out_submit();'>
            <input type="hidden" name="mode" value="regist">
            <input type="hidden" name="gubun1" value="1">
            <input type="hidden" name="wc_idx" value="<?= $wc_idx ?>">
            <input type="hidden" name="wc_go_idx" value="">
            <input type="hidden" name="aucidx" value="<?= $aucidx ?>">
            <input type="hidden" name="aucorderNo" value="<?= $aucNo ?>">
            <input type="hidden" name="href" value="<?= $href ?>">
            <input type="hidden" name="call_name" value="<?= $row->name ?>" />
            <input type="hidden" name="call_tel" value="<?= $row->pcs ?>" />
            <input type="hidden" name="wc_mem_etc" value="<?= $row->email ?>" />
            <div class="contact">
                <div class="topper">
                    <p class="notice">아래 간단히 기록하여 주시면 전문상담원이 연락을 드립니다.</p>
                </div>
                <div class="table-style">
                    <ul>
                        <li>
                            <div class="th">상담유형</div>
                            <div class="td">
                                <ul class="radio-group">
                                    <li>
                                        <div class="radio-wrap">
                                            <input type="radio" name="calltype" value="사고차량" id="consultType1">
                                            <label class="radio-label" for="consultType1">사고차량</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio-wrap">
                                            <input type="radio" name="calltype" value="폐차차량" id="consultType2">
                                            <label class="radio-label" for="consultType2">폐차차량</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio-wrap">
                                            <input type="radio" name="calltype" value="중고차량" id="consultType2">
                                            <label class="radio-label" for="consultType2">중고차량</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="th"><span class="emphas">*</span>이름</div>
                            <div class="td"><?= $row->name ?></div>
                        </li>
                        <li>
                            <div class="th"><span class="emphas">*</span>휴대전화</div>
                            <div class="td"><?= $row->pcs ?></div>
                        </li>
                        <li>
                            <div class="th">이메일</div>
                            <div class="td"><?= $row->email ?></div>
                        </li>
                        <li>
                            <div class="th"><span class="emphas">*</span>차량번호</div>
                            <div class="td">
                                <div class="input-wrap">
                                    <input type="text" name="car_name" style="font-size:17px">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="th">보관지역</div>
                            <div class="td">
                                <div class="input-wrap">
                                    <input type="text" name="car_name2" style="font-size:17px">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="th">상담내용</div>
                            <div class="td">
                                <div class="input-wrap textarea-wrap">
                                    <textarea name="wc_memo" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="btn-wrap">
                <button type="button" class="btn btn-primary btn-wide btn-md" onClick="out_submit();">차량상담신청</button>
            </div>
        </form>
    </section>
</div>


<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/footer.php";
?>
</body>

</html>
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

    if (!f.car_no.value) {
        alert('차량번호를 입력해 주세요');
        return;
    } else {
        f.submit();
    }
}


var upfile_num = 1;
var num = 0;
var img_count = 0;

function fileInfo(f) {
    var file = f.files; // files 를 사용하면 파일의 정보를 알 수 있음
    // 파일의 갯수만큼 반복
    for (var i = 0; i < file.length; i++) {

        var reader = new FileReader(); // FileReader 객체 사용
        reader.onload = function(rst) {

            $('#img_box').append('<div class="img-wrap"><img src="' + rst.target.result +
                '"width="95" height="82" id="num' + num + '" data-image="tmp' + num +
                '" class="imgs"><input type=hidden name="tmpfile[]" value="' + num + '"  id="tmp' + num +
                '" class="imgnames"></div>'); // append 메소드를 사용해서 이미지 추가
            // 이미지는 base64 문자열로 추가
            // 이 방법을 응용하면 선택한 이미지를 미리보기 할 수 있음
            num++;
            img_count++;
            document.getElementById("img_count").innerHTML = img_count;
        }

        reader.readAsDataURL(file[i]); // 파일을 읽는다

    }
    upfile_num++;
}


$(document).on("click", "#img_box .imgs", function() {
    $(this).remove();
    dataimg = $(this).data('image');
    $("#" + dataimg).remove();
    img_count--;
    document.getElementById("img_count").innerHTML = img_count;
});

$(document).on("click", "#img_del", function() {
    $(".imgs").remove();
    $(".imgnames").remove();
    img_count = 0;
    document.getElementById("img_count").innerHTML = 0;
});

function file_click() {
    document.getElementById('uf' + upfile_num).click();
}
</script>

<div class="add-car">
    <section class="title-wrap">
        <h2>사진추가</h2>
    </section>
    <section class="tab-wrap wide-type">
        <ul>
            <!--li class="tab">
          <a href="/sub01/sub01_1.php">차량등록</a>
        </li-->
            <li class="tab active">
                <a href="/sub01/sub01_2.php">사진추가</a>
            </li>
            <li class="tab">
                <a href="/sub01/sub01_3.php">1:1상담</a>
            </li>
        </ul>
    </section>
    <section class="add-photo">
        <form name="outForm" action="sub01_2_save.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" id="mode" value="pic_regist">
            <input type="hidden" name="hidFileName" />
            <div class="table-style">
                <ul>
                    <li>
                        <div class="th"><span class="emphas">*</span>이름</div>
                        <div class="td"><?= $row->name ?></div>
                    </li>
                    <li>
                        <div class="th"><span class="emphas">*</span>휴대전화</div>
                        <div class="td"><?= $row->pcs ?></div>
                    </li>
                    <li>
                        <div class="th"><span class="emphas">*</span>차량번호</div>
                        <div class="td">
                            <div class="flex-type">
                                <div class="input-wrap">
                                    <input type="text" name="car_no" style="font-size:17px">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="fileupload-wrap">
                <div class="topper">
                    <span>등록파일: 0/24</span>
                    <div class="btn-wrap">
                        <input type="file" hidden id="fileUpload">
                        <button type="button" onclick="file_click();" class="btn btn-secondary btn-sm">파일찾기</button>
                        <button type="button" class="btn btn-dark btn-sm" id="img_del">초기화</button>
                        <? for ($i = 1; $i <= 10; $i++) { ?>
                        <input type="file" accept="image/*" multiple onChange="fileInfo(this)" name="upfile[]"
                            id="uf<?= $i ?>" style="display:none;" />
                        <? } ?>
                    </div>
                </div>

                <div class="img-list" id="img_box">
                    <!--div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div-->
                </div>

                <p class="notice">
                    * 신청접수의 각 항목을 기입 후 신청해주시면 업무담당자가 확인 후 연락을 드립니다.
                </p>
                <p class="notice">
                    * 고객님께서 입력하신 내용은 경·공매 및 폐차진행을 위한 기본정보이며 안전하게 보호관리됨을 알려드립니다.
                </p>
            </div>

            <div class="btn-wrap">
                <button type="button" class="btn btn-primary btn-wide btn-md" onclick="out_submit();">사진추가등록</button>
            </div>
        </form>
    </section>
</div>


<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/footer.php";
?>
</body>

</html>
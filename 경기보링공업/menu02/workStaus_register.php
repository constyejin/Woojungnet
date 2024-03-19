<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/inc/styles/form-table.css">
<link rel="stylesheet" href="/menu02/style/workStatus.css">

<main class="work-status">
  <section>
    <h2 class="sub-title">작업현황</h2>
    <form name="" method="" action="" enctype="">
      <table>
        <thead>
          <tr>
            <th>차량명</th>
            <td>
              <input type="text" name="" value="">
            </td>
          </tr>

          <tr>
            <th>년식</th>
            <td class="sm-input">
              <input type="text" name="" value="">
              <span>년</span>
            </td>
          </tr>

          <tr>
            <th>주행거리</th>
            <td class="sm-input">
              <input type="text" name="" value="">
              <span>Km</span>
            </td>
          </tr>

          <tr>
            <th>작업비</th>
            <td class="sm-input">
              <input type="text" name="" value="">
              <span>원</span>
            </td>
          </tr>
        </thead>

        <tbody>
          <tr>
            <th colspan="2" style="padding:14px">
              상세설명
            </th>
          </tr>

          <tr class="smart-editor" height="367px">
            <td colspan="2" height="367px">
              <script type="text/javascript" src="/inc/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
              <textarea name="carOptionadd" id="ir1" rows="10" cols="100" style="width:100%; height:320px; display:none;">
              </textarea>
              <script type="text/javascript">
                var oEditors = [];
                // 추가 글꼴 목록
                //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];
                nhn.husky.EZCreator.createInIFrame({
                  oAppRef: oEditors,
                  elPlaceHolder: "ir1",
                  sSkinURI: "/inc/smarteditor2/SmartEditor2Skin.html",
                  htParams : {
                    bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                    bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                    bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                    fOnBeforeUnload : function(){
                      //alert("완료!");
                    }
                  }, //boolean
                  fOnAppLoad : function(){
                    //예제 코드
                    //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                  },
                  fCreator: "createSEditor2"
                });
                function pasteHTML() {
                  var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
                  oEditors.getById["ir1"].exec("PASTE_HTML", [sHTML]);
                }
                function showHTML() {
                  var sHTML = oEditors.getById["ir1"].getIR();
                  alert(sHTML);
                }
          
                function submitContents(elClickedObj) {
                  oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
          
                  // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.
          
                  try {
                    elClickedObj.form.submit();
                  } catch(e) {}
                }
                function setDefaultFont() {
                  var sDefaultFont = '궁서';
                  var nFontSize = 24;
                  oEditors.getById["ir1"].setDefaultFont(sDefaultFont, nFontSize);
                }
              </script>
            </td>
          </tr>

          <tr>
            <td style="border:none;"></td>
          </tr>

          <tr class="upload-img">
            <td style="padding:0; border:none; font-weight: 700;">등록파일: 
              <span>0</span> / 60개
            </td>

            <td align="right" style="padding:8px 0; border:none;">
              <button class="file-btn">파일찾기</button>
              <button class="reset-btn">초기화</button>
            </td>
          </tr>

          <tr>
            <td colspan="2" style="padding:0;border:none;">
              <div class="register-img-list">
                <div class="register-img-item">
                  <img src="/inc/assets/images/slide01.jpeg" alt="">
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="post-btn-box">
        <button class="post-btn select-del-btn">선택삭제</button>
        <div>
          <button class="post-btn show-list-btn">
            <a href="/menu02/workStatus.php">목록보기</a>
          </button>
          <button class="post-btn register-btn">등록하기</button>
        </div>
      </div>
    </form>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

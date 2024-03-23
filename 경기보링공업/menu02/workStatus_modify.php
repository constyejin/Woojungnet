<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/inc/styles/form-table.css">
<link rel="stylesheet" href="/menu02/style//workStatus.css">

<main class="work-status">
  <section>
    <h2 class="sub-title">작업현황
      <p>작업중이거나 작업이 완료된 차량정보입니다</p>
    </h2>
    <p class="top-list-btn">
      <a href="/menu02/workStatus_list.php">목록보기 LIST</a>
    </p>

    <form name="" method="" action="" enctype="">
      <div class="table-form">
        <ul class="table-list border-top">
          <li class="table-title">차량명</li>
          <li class="table-content">
            <input type="text" name="" value="">
          </li>
        </ul>

        <ul class="table-list">
          <li class="table-title">년식</li>
          <li class="table-content sm-input">
            <input type="text" name="" value="">
          </li>
        </ul>

        <ul class="table-list">
          <li class="table-title">주행거리</li>
          <li class="table-content sm-input">
            <input type="text" name="" value="">
            <span>Km</span>
          </li>
        </ul>

        <ul class="table-list">
          <li class="table-title">작업비</li>
          <li class="table-content sm-input">
            <input type="text" name="" value="">
            <span>원</span>
          </li>
        </ul>

        <ul class="table-list align-col smart-editor">
          <li class="table-title">상세설명</li>

          <li class="table-content sm-only">
            <textarea name="" id="" cols="30" rows="10" style="width:100%; height:220px;"></textarea>
          </li>

          <li class="table-content lg-only">
            <script type="text/javascript" src="/inc/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
            <textarea name="carOptionadd" id="ir1" rows="10" cols="100" style="width:100%; height:320px; display:none;"></textarea>
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
          </li>
        </ul>

        <ul class="upload-img">
          <li>등록파일: 
            <span>0</span> / 60개
          </li>
          <li class="table-list-btn">
            <button class="file-btn">파일찾기</button>
            <button class="reset-btn">초기화</button>
          </li>
        </ul>
       
        <ul>
          <li class="register-img-list">
            <div class="register-img-item">
              <img src="/inc/assets/images/slide01.jpeg" alt="">
            </div>
          </li>
        </ul>

        <ul>
          <div class="existing-img-list">
            <div class="existing-img-item">
              <img src="/inc/assets/images/slide01.jpeg" alt="">
              <div class="img-item-chk">
                <input type="checkbox">
                <p>1</p>
              </div>
            </div>
          </div>
        </ul>
      </div>

      <div class="post-btn-box">
        <button class="post-btn select-del-btn">선택삭제</button>
        <div>
          <button class="post-btn show-list-btn">
            <a href="/menu02/workStatus_list.php">목록보기</a>
          </button>
          <button class="post-btn register-btn">등록하기</button>
        </div>
      </div>
    </form>
  </section>
</main>

<script src="/inc/js/car-slide.js"></script>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<? $rand=rand(100000,999999); ?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/inc/styles/form-table.css">
<link rel="stylesheet" href="/menu03/style/estimate.css">

<main class="estimate">
  <section>
    <p class="menu-path sm-only"><a href="/">홈</a> > 견적신청</p>
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

          <li class="table-content sm-only">
            <textarea name="" id="" cols="30" rows="10" style="width:100%; height:220px;"></textarea>
          </li>
          
          <li class="table-content lg-only">
            <script type="text/javascript" src="/inc/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
            <textarea name="con_memo" id="ir1" rows="10" cols="100" style="width:100%; height:320px; display:none;"></textarea>
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

        <ul class="table-list spam border-bottom">
          <li class="table-title">스팸방지</li>
          <li class="table-content sm-input">
            <input type="text" name="spam_code" value="<?=$rand?>" disabled>
            <input type="text" name="spam_input">
            <span>좌측 숫자를 입력하여주세요.</span>
          </li>
        </ul>
      </div>

      <div class="personal-info">
        <b>개인정보수집</b>
        <div class="personal-info-txt">
          <p>당사는 원활한 고객상담,각종서비스의 제공을 위해 아래와 같은 개인정보를 수집하고 있습니다</p>
          <p><b>[가]수집하는 개인정보의 항목</b> : 이름, 연락처 ,이메일, 차량명, 년식</p>
          <p><b>[나]수집하는 개인정보의 수집방법</b> : 자발적으로 온라인상에서 기재하는 방법으로 수집합니다</p>
          <p><b>정보공개</b> :법령에 의한것이 아닌 경우를 제외하고 일체의 외부공개나 위탁을 하지 않습니다.</p>
          <p><b>보유기간</b> : 원칙적으로, 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다</p>
          <p>단, 작업현황에 광고용으로 등재하는 경우 차량명과 년식만 노출합니다</p>
          <p><b>보존기간</b> : 계약 또는 청약철회 등에 관한 기록: 5년(전자상거래등에서의 소비자보호에 관한 법률)</p>
          <p><b>대금결제 및 재화 등의 공급에 관한 기록</b> : 5년(전자상거래등에서의 소비자보호에 관한 법률)</p>
        </div>
        <div class="personal-info-check">
          <input type="checkbox" name="agree_1">
          <b>개인정보수집에 동의합니다</b>
        </div>
      </div>

      <div class="submit-btn">
        <button type="submit" class="btn-blue-lg">견적신청</button>
      </div>
    </form>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

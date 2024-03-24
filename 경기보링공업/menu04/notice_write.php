<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<?
if(!$id) $id="notice";
$web_table=sql_fetch("select * from web_table where table_id='$id' order by idx desc ");

if($web_table[table_write]<$_SESSION[login_level]||!$_SESSION[login_level]){
	alert("권한이 없습니다.","/");
	exit;
}

if($idx) $board_view=sql_fetch("select * from board where idx='$idx' ");
?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/menu04/style/notice_narmi.css">

<main class="notice">
  <section>
    <h2 class="sub-title">공지사항</h2>
    <p class="top-list-btn">
      <a href="/menu04/notice_list.php">목록보기 LIST</a>
    </p>
    
    <form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="notice_save.php" onsubmit="board_save()">
      <input type="hidden" name="idx" value="<?=$idx?>">
      <input type="hidden" name="id" value="<?=$id?>">
      <div class="content-wrap sub">
        <div class="anchor-wrap">
          <a href="#" class="anchor"></a>
        </div>

        <section class="notice-list">
          <div class="container">
            <div class="notice-write-header">
              <div class="label">이름</div>
              <div class="dd name">
                <div class="input-wrap">
                  <input type="text" name="board_name" value="<?=$board_view[board_name]?>">
                </div>
              </div>

              <div class="label">제목</div>
                <div class="dd title">
                  <div class="input-wrap">
                    <input type="text" name="board_title"  value="<?=$board_view[board_title]?>">
                  </div>

                  <div class="check-wrap">
                    <input type="checkbox" name="board_notice" id="checkAnounce" value="Y" <?=$board_view[board_notice]=="Y"?"checked":""?>>
                    <label for="checkAnounce">공지</label>
                  </div>
                </div>
              </div>

            <div class="notice-write-body" style="min-height: 300px">
              <textarea name="memo" id="ir1" rows="10" cols="100" style="width:100%; height:300px; display:none;"><?=$board_view[board_memo]?></textarea>
              <script type="text/javascript" src="/inc/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
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
            </div>
            
            <div class="notice-detail-file">
              <? for($i=0;$i<$web_table[table_file];$i++){ ?>
              <div class="label">파일</div>
              <div class="dd file">
                <input type="file" name="upfile[]">
              </div>
              <? } ?>
            </div>

            <div class="post-btn-box">
              <button class="post-btn show-list-btn">
                <a href="/menu04/notice_list.php">목록보기</a>
              </button>
              <button class="post-btn register-btn">등록하기</button>
            </div>
          </div>
        </section>
      </div>
    </form>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

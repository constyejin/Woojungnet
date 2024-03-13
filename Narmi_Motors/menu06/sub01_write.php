<?
include "../inc/header.php";
include "../inc/menu_sub.php";

if(!$id) $id="notice";
$web_table=sql_fetch("select * from web_table where table_id='$id' order by idx desc ");

if($web_table[table_write]>$_SESSION[login_level]){
	alert("권한이 없습니다.","/");
	exit;
}

$image_sub=sql_fetch("select * from image_sub where sub_type='sub' and sub_menu='고객센터' order by idx desc ");
if($idx) $board_view=sql_fetch("select * from board where idx='$idx' ");
?>
  <div class="sub-visual">
    <!-- 서브비주얼 -->
    <img src="/images/img/<?=$image_sub[sub_file]?>" alt="">
    <!-- <div class="title">
      <p class="catch-phrase">대한민국의 운송장비의 성공신화 !!</p>
      <p class="sub-text">화물차! 특장차! 캠핑카! 책임있고 오랜경험을 고객님들과 함께 합니다. </p>
      <p class="third-text">TEL  1588-1277  , FAX  02-794-3300</p>
    </div> -->
  </div>
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub01_save.php">
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
              <input type="text" name="board_name" value="<?=!$idx?$_SESSION[login_name]:$board_view[board_name]?>">
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
			<? if($web_table[table_secret]=="Y"){ ?>
            <div class="check-wrap">
              <input type="checkbox" name="" id="checkSecret">
              <label for="checkSecret">비밀글</label>
            </div>
			<? } ?>
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

        <div class="notice-detail-footer">
          <div class="btn-wrap">
            <a href="javascript:board_save();" class="btn btn-outline-red btn-round sm">등록하기</a>
            <a href="javascript:history.back();" class="btn btn-outline-secondary btn-round sm">목록보기</a>
          </div>
        </div>
      </div>
    </section>
  </div>
</form>
<?
include "../inc/footer.php";
?>

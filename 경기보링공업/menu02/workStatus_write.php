<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/sub-visual.php"; ?>
<?
  if(!$_SESSION[login_level]||$_SESSION[login_level]>"40"){
	  alert("권한이 없습니다.","/");
	  exit;
  }
  if($wc_idx){
    $qry = "select * from woojung_part where wc_idx = '$wc_idx'  ";
    $row = mysql_fetch_array(mysql_query($qry));
	$mode = 'modify';
  }else{
	  $mode = 'regist';
  }
?>
<link rel="stylesheet" href="/inc/styles/sub-visual.css">
<link rel="stylesheet" href="/inc/styles/form-table.css">
<link rel="stylesheet" href="/menu02/style/workStatus.css">
<script language="JavaScript" type="text/JavaScript">
  var upfile_num=1;
  var num=0;
  var img_count=0;

  function fileInfo(f){
    var file = f.files; // files 를 사용하면 파일의 정보를 알 수 있음
    // 파일의 갯수만큼 반복
    for(var i=0; i<file.length; i++){
      if(img_count==60) break;  
      
      var reader = new FileReader(); // FileReader 객체 사용
      reader.onload = function(rst){
        if(img_count<60){
        $('#img_box').append('<img src="' + rst.target.result + '"width="125" height="90" id="num'+num+'" data-image="tmp'+num+'" class="imgs"><input type=hidden name="tmpfile[]" value="'+ num +'"  id="tmp'+num+'" class="imgnames">'); // append 메소드를 사용해서 이미지 추가
        // 이미지는 base64 문자열로 추가
        // 이 방법을 응용하면 선택한 이미지를 미리보기 할 수 있음
        num++; img_count++; 
        document.getElementById("img_count").innerHTML=img_count;
        }
      }
      reader.readAsDataURL(file[i]); // 파일을 읽는다
    }
  upfile_num++;
  }
  
  $(document).on("click","#img_box .imgs",function(){
    $(this).remove();
    dataimg = $(this).data('image');
    $("#"+dataimg).remove();
    img_count--;
    document.getElementById("img_count").innerHTML=img_count;
  }); 

  $(document).on("click","#img_del",function(){
    $(".imgs").remove();
    $(".imgnames").remove();
    img_count=0;
      document.getElementById("img_count").innerHTML=0;
  }); 

  function file_click(){
    document.getElementById('uf'+upfile_num).click();
  }

function image_alldel(){
	if(confirm("선택한 사진을 삭제하겠습니까?")){
		f=document.outForm;
		f.target="HiddenFrm";
		f.action="img_alldel.php";
		f.submit();
		f.target="";
		f.action="";
	}
}
</script>

<main class="work-status">
  <section>
    <h2 class="sub-title">작업현황
      <p>작업중이거나 작업이 완료된 차량정보입니다</p>
    </h2>
    <p class="top-list-btn">
      <a href="/menu02/workStatus_list.php">목록보기 LIST</a>
    </p>
    
    <form name='outForm' method='post' enctype="multipart/form-data" onsubmit="out_submit()">
	<input type="hidden" name="mode" id="mode" value="<?=$mode?>">
	<input type="hidden" name="wc_idx" value="<?=$wc_idx?>">
      <div class="table-form">
        <ul class="table-list border-top">
          <li class="table-title">차량명</li>
          <li class="table-content">
            <input type="text" name="wc_mem_etc" value="<?=$row[wc_mem_etc]?>">
          </li>
        </ul>

        <ul class="table-list">
          <li class="table-title">년식</li>
          <li class="table-content sm-input">
            <input type="text" name="wc_age" value="<?=$row[wc_age]?>">
          </li>
        </ul>

        <ul class="table-list">
          <li class="table-title">주행거리</li>
          <li class="table-content sm-input">
            <input type="text" name="carmile" value="<?=number($row[wc_mileage])?>" onKeyup="javascript:comma(this);">
            <span>Km</span>
          </li>
        </ul>

        <ul class="table-list">
          <li class="table-title">작업비</li>
          <li class="table-content sm-input">
            <input type="text" name="wc_keep_tel1" value="<?=number($row[wc_keep_tel1])?>" onKeyup="javascript:comma(this);">
            <span>원</span>
          </li>
        </ul>

        <ul class="table-list align-col smart-editor">
          <li class="table-title">상세설명</li>

          <li class="table-content sm-only">
            <textarea name="carOptionadd" id="" cols="30" rows="10" style="width:100%; height:220px;"></textarea>
          </li>

          <li class="table-content lg-only">
            <script type="text/javascript" src="/inc/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
            <textarea name="carOptionadd" id="ir1" rows="10" cols="100" style="width:100%; height:320px; display:none;"><?=$row[wc_option_add]?></textarea>
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
            <span id="img_count">0</span> / 60개
          </li>
          <li class="table-list-btn">
            <button class="file-btn" type="button" onclick="file_click();">파일찾기</button>
            <button class="reset-btn">초기화</button>
			  <? for($i=1;$i<=10;$i++){ ?>
			  <input type="file" accept="image/*" multiple="multiple" onchange="fileInfo(this)" name="upfile[]" id="uf<?=$i?>" style="display:none;"/>
			  <? } ?>
          </li>
        </ul>
       
        <ul>
          <li class="register-img-list" id="img_box">
            <!--div class="register-img-item">
              <img src="/inc/assets/images/slide01.jpeg" alt="">
            </div-->
          </li>
        </ul>

<? if($wc_idx){ ?>
        <ul>
          <div class="existing-img-list">
			<?
			$imgCnt = 0;
			for($i=1; $i<=60; $i++) {

			  $fim="wc_img_".$i;
			  $fileName = $row[$fim];
			  $real_name = explode('/', $fileName);	
			  
			  if(strlen($real_name[0]) == 0)
			  {
				$fileName = '';
				break;
			  }
			  else
			  {
				$imgCnt++;
				$fileName = $site_u[home_url]."/data/".$real_name[0];
			  }
			//	if($i%10==1) echo "</tr><tr>";
			?>
            <div class="existing-img-item">
              <img src="<?=$fileName?>" alt="">
              <div class="img-item-chk">
                <input type="checkbox" name="img_num[]" value="<?=$cnt+1?>">
                <p><?=$cnt+1?></p>
              </div>
            </div>
			<?
			  $cnt++;
			}	
			?>
          </div>
        </ul>
<? } ?>
	  </div>

      <div class="post-btn-box">
<? if($wc_idx){ ?>
        <button class="post-btn select-del-btn" type="button" onclick="image_alldel()">선택삭제</button>
<? } ?>
        <div>
          <button class="post-btn show-list-btn" type="button" onclick="location.href='/menu02/workStatus_list.php';">목록보기</button>
          <button class="post-btn register-btn">등록하기</button>
        </div>
      </div>
    </form>
  </section>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>

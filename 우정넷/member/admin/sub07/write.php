<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>
<?
if($_GET[idx]){
	$sql="select * from plan where idx='$_GET[idx]' ";
	$data=sql_fetch($sql);
}
?>

<script type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>

<script>
function wr(){
	f=document.cform;
	f.action="sub01_save.php";
	submitContents();
	f.submit();
}
function del(idx){
	if(confirm("삭제 하시겠습니까?")){
		location.href="sub01_del.php?idx="+idx;
	}
}
</script>

<iframe name="HiddenFrm" style="display:none;" width=800 height=150></iframe>
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="600" align='center' valign="top" style='font-size:14px; padding:10px'><table width="900" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> 위치 : 년중계획서 &gt;<strong>등록하기</strong></td>
                        <td align='right'>&nbsp;</td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="40" align="left"><span style="color:#FF0000">월별:월별에 들어가는것은 매월 같은 날에 등록되어야 함<br />
년별:년별에 들어가는것은 년도에 지정일자에 들어가면됨 </span></td>
                      </tr>
                        <tr>
                          <td height="5" align="left"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>

<form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub01_memo_save.php">
<input type="hidden" name="idx" value="<?=$_GET[idx]?>">
					  <tr>
                        <td width="9%" height="30" bgcolor="f4f4f4"><strong>구분</strong></td>
                        <td width="91%" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
						<table border="0" cellpadding="2" cellspacing="0">
						<tr>
						<td valign="top"><input name="plan_type" type="radio" value="1" <? if($data[plan_type]=="1") echo "checked"; ?>/></td>
                        <td>월별등록 : 매월</td>
                        <td><span class="table_text">
                          <select name="pday1" class="input_site">
							<? for($i=1;$i<32;$i++){ ?>
							<option value='<?=$i?>'  <? if($data[plan_type]=="1"&&$data[pday]==$i) echo "selected"; ?>><?=$i?></option>
							<? } ?>
                          </select>
                        </span></td>
                        <td>일에 등록 </td>
                        <td valign="top"><input name="plan_type" type="radio" value="2" <? if($data[plan_type]=="2") echo "checked"; ?>/> </td>
                        <td>년별등록 : 매년 </td>
                        <td><span class="table_text">
                          <select name="pmonth" class="input_site">
							<? for($i=1;$i<13;$i++){ ?>
							<option value='<?=$i?>'  <? if($data[plan_type]=="2"&&$data[pmonth]==$i) echo "selected"; ?>><?=$i?></option>
							<? } ?>
                          </select>
                        </span></td>
                        <td>월 </td>
                        <td><span class="table_text">
                          <select name="pday2" class="input_site">
							<? for($i=1;$i<32;$i++){ ?>
							<option value='<?=$i?>'  <? if($data[plan_type]=="2"&&$data[pday]==$i) echo "selected"; ?>><?=$i?></option>
							<? } ?>
                          </select>
                        </span></td>
                        <td>일에 등록</td>
						</tr>
						</table></td>
                      </tr><tr>
                        <td height="30" bgcolor="f4f4f4"><strong>제목</strong></td>
                        <td align="left" style="padding-left:10px;">
                          <input type="subject" size="55" name="title" style='width:380' class='input_basic'  value='<?=$data[title]?>' />
                        </td>
                      </tr>
                      <tr>
                        <td height="30" bgcolor="f4f4f4"><strong>내용</strong></td>
                        <td align="left" style="padding:10px;">
          <textarea rows=12 name="memo" id="ir1" style="width:100%; height:180px;display:none;" wrap="physical"><?=$data[memo]?></textarea>
<script type="text/javascript" src="/board/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript">
var oEditors = [];

// 추가 글꼴 목록
//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ir1",
	sSkinURI: "/board/smarteditor2/SmartEditor2Skin.html",	
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
                      
                    </table></td>
                  </tr>
</form>
				  <tr>
                    <td align="center" height="40"><input name="input2" type="button" class="btn_blue" value="목록보기" onclick="window.location='sub01.php'" />
                    <input type="button" class="btn_pink" value="등록하기" onClick="wr();"> 
					<? if($_GET[idx]){ ?>
					<input type="button" class="btn_pink" value="삭제하기" onClick="del('<?=$_GET[idx]?>');">
					<? } ?>
					</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
          </tr>
</table>
	      <!--/로고 & 탑메뉴-->		
		</td>
  </tr>
	<tr>
		<td height='100%'>
			<!--body-->			
			<!--/body-->
		</td>
	</tr>
</table>
</body>

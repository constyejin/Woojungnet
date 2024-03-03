<?
if(basename(__FILE__)==basename($_SERVER["PHP_SELF"])) die(__FILE__." ....");

if($sub_mode=="edit"){
	$p_qry = "  select * from $id where no='$no' ";
	$p_res = mysql_query($p_qry) or die(mysql_error());
	$view = mysql_fetch_array($p_res);
	$ridx=0;
} else if($sub_mode=="answer") {
	$ridx=1;
} else {
	$ridx=0;
	$sub_mode="write";
}
$randKey=rand(100000,999999);

if($sub_mode=="write"){
//	$sec_checked="checked";
}
?>
<style type="text/css">
.viewtable { border-collapse:collapse; margin-top:30px; }
.viewtable th {background-color:#EFEFEF; height:50px;font-size:13px;}
.viewtable td {text-align:left; padding-left:7px;}

.viewtable th.topline, .viewtable td.topline {border-top:2px solid #000000;}
.viewtable th,.viewtable td {border-bottom:1px solid #D8D8D8;}
input.sbutton {border:1px solid #D8D8D8; text-align:center; background-color:#D8D8D8;  line-height:none; height:20px;color:#ffffff; padding:0px 3px; cursor:hand;}
						
.bbsbg{background-color:#dff6ff;border:1px solid #D8D8D8; }
.Chk {width:13px; height:13px; margin-top:-3px;}
.btn-blue{
	display:inline-flex; justify-content: center; align-items:center;border: 2px solid #0066CC; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color:#0066CC;"
}
.btn-red{
	display: inline-flex;justify-content: center;align-items: center;border: 2px solid #cc3535;border-radius: 20px;min-width: 80px;height: 32px;font-size: 12px;font-weight: 600;color: #cc3535;
}
.btn-black{
	display:inline-flex; justify-content: center; align-items:center;border: 2px solid #000000; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color:#000000; 
}
</style>
          
<form name='writeForm' method='POST' enctype="multipart/form-data" action="./write_ok.php" style="margin:0px;">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="mode" value="<?=$mode?>">
	<input type="hidden" name="sub_mode" value="<?=$sub_mode?>">
	<input type="hidden" name="ridx" value="<?=$ridx?>">
	<input type="hidden" name="page" value="<?=$page?>">
	<?if($sub_mode=="edit" || $sub_mode=="answer"){?>
	<input type="hidden" name="no" value="<?=$no?>">
	<?}?>
 <table  width="98%"  border="0"  cellspacing="0" cellpadding="4" class="viewtable">
	  <?
  	if($sub_mode=="write"){
	  if(!$_SESSION["login_id"]){
	 ?>
      <tr>
            <th width="15%" class="topline" align="center">이름</th>
            <td width="35%" class="topline"><input type=text value='<?if($view[name]){echo $view[name];}else{echo $_SESSION["login_name"];}?>' name='name'></td>
            <th width="15%" class="topline">비밀번호</th>
            <td width="35%" class="topline"><input type="password" value='' name='pwd' class="form_control"></td>
      </tr>			 
	  <tr>
          <th>스팸방지</th>
          <td   colspan="3" ><strong><?=$randKey?></strong> &nbsp;&nbsp; 
          <input type=text name='spaNumber' style="vertical-align:middle" class="form_control"> &nbsp;좌측의 숫자을 입력하세요.</td>
	</tr>
	<?}else{?>
      <tr>
            <th width="15%" class="topline" align="center">이름</th>
            <td colspan="3" width="85%" class="topline"><input type=text value='<?if($view[name]){echo $view[name];}else{echo $_SESSION["login_name"];}?>' name='name' class="form_control" style="height: 35px;"></td>
      </tr>			 
	<?
	  }
	}else{
	  ?>
      <tr>
            <th width="15%" class="topline" align="center">이름</th>
            <td colspan="3" width="85%" class="topline"><input type=text value='<?if($view[name]){echo $view[name];}else{echo $_SESSION["login_name"];}?>' name='name' class="form_control" style="height: 35px;"></td>
      </tr>
	<? } ?>
		
<!--	<?if($sub_mode=="edit"){?>
	      <tr>
            <th width="15%" class="topline" align="center">이름</th>
            <td colspan="3" width="85%" class="topline"><input type=text value='<?if($view[name]){echo $view[name];}else{echo $_SESSION["login_name"];}?>' name='name'></td>
      </tr>			 
	<? } ?>  -->

<?
	if($sub_mode=="answer"){
?>
	<tr>
	  <th>제목</th>
          <td colspan="3" ><input type=text size="55" name="subject" style="width:700px;height: 35px;" value="답글입니다" class="form_control">
<?
if($_SESSION["login_id"]){
?>
			 <input type="checkbox" class="Chk" name="notice" value="Y"  <?if($view[notice]=="Y"){ echo "checked"; }?>  class="form_control"/>공지 
<? } ?>
			 <input type="checkbox" class="Chk" name="security" value="Y" checked/>비밀글    
          </td>
	</tr>
<? }else{ ?>
	<tr>
	  <th>제목</th>
          <td colspan="3" ><input type=text size="55" name="subject" style="width:700px;height: 35px;" value="<?=$view[subject]?>"  class="form_control">
<?
if($_SESSION["login_id"]){
?>
			 <input type="checkbox" class="Chk" name="notice" value="Y"  <?if($view[notice]=="Y"){ echo "checked"; }?>  class="form_control"/>공지 
<? } ?>
			 <input type="checkbox" class="Chk" name="security" value="Y"  <?=$sec_checked?>/>비밀글    
          </td>
	</tr>
<? } ?>
	
	<tr>
	  <td colspan="4" align="center" style="padding-left:0px;">


      <table width="100%"  border="0" cellspacing="0" cellpadding="0" align="center"  style="margin:10px 0px;" >
      <tr><td  style="padding-left:0px;"> 
          <script type="text/javascript" src="../board/js/HuskyEZCreator.js" charset="utf-8"></script> 
<script type="text/javascript" src="../board/js/HuskyEZCreator.js" charset="utf-8"></script>
						  <textarea name="memo" id="ir1" rows="10" cols="100" style="width:100%; height:320px; display:none;"><?=stripslashes($view[memo])?>
                      </textarea>
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
      </td></tr></table>

	  </td>
	</tr>
<?
	if($sub_mode=="write"){
		for($ku=0;$ku<$data["a_file_use"];$ku++){
?>
	</tr>
		<tr>
	  <th>파일</th>
	  <td  colspan='3'><input type="file" size="72" name="upfile[]" class="textarea_01">&nbsp;  </a>
	  	</tr>
<?
		}
	}else{
		$img_l=explode(",",$view['files']);
		$img_l2=explode(",",$view['nfiles']);
		for($ku=0;$ku<$data["a_file_use"];$ku++){
?>
		<tr>
	  <th>파일</th>
	  <td  colspan='3'><input type="file" size="80" name="upfile[]" class="textarea_01" style="width:400px;">&nbsp;  </a>
<?
		if($img_l[$ku]){
?>
		<input type="checkbox" name="chk_del[<?=$ku?>]" style="vertical-align:middle;border:0px;" ><span id='file1_delete_lable' style="color:darkred;">삭제</span> (<?=cut_str($img_l2[$ku],10)?>)</td>
<?
		}
?>
	  	</tr>
<?
		}
	}
?>
</table>
</form>	


<br />
<center>
		<!--<img src='../board/img/btn/btn_write2.gif' class="imgbt1" onclick="write_ok()" style="cursor:pointer;"/>-->
		<a href="javascript:void(0)" onclick="write_ok()" class="btn-red">등록하기</a>
		<!--<img src='../board/img/btn/btn_list.gif' class="imgbt1" onClick="location.href='board.php?id=<?=$id?>';" style="cursor:pointer;"/>-->
		<a href="javascript:void(0)" onclick="location.href='board.php?id=<?=$id?>';" class="btn-blue">목록보기</a>
</center>


<script>
	function write_ok(){
		var f=document.writeForm;
		<?if($sub_mode!="edit" && !$_SESSION["login_id"]){?>
		if(!f.name.value){
			alert('이름을 입력 해주세요.');
			f.name.focus();
			return;
		}
		<?}?>
		if(!f.subject.value){
			alert('제목을 입력 해주세요.');
			f.subject.focus();
			return;
		}
		<?if($sub_mode!="edit" && !$_SESSION["login_id"]){?>
		if(!f.pwd.value){
			alert('비밀번호를 입력 해주세요.');
			f.pwd.focus();
			return;
		}
		<?}?>
		<?if($_SESSION["login_id"] || $sub_mode=="edit"){}else{?>
		if(f.spaNumber.value!=<?=$randKey?>){
			alert('스팸 방지 코드를 입력하세요');
			f.spaNumber.value="";
			f.spaNumber.focus();
			return;
		}
		<?}?>
		submitContents();
		if(!f.memo.value){
			alert('내용을 입력 해주세요.');
			return;
		}
		f.submit();
	}
</script>
<?
$dir=$_SERVER["DOCUMENT_ROOT"]; 

$randKey=rand(100000,999999);

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
	$sec_checked="checked";
}
?>

                <!-- sub title -->
<!--				<table width="740" border="0" cellspacing="0" cellpadding="0" class="tit">
				  <tr>
					<td><img src="../images/sub06/tit01.gif" /></td>
					<td align="right" valign="bottom"><div class="mb3 loc"><img src="../images/ico_home.gif" class="mb3" />HOME > 견적및상담 > 견적및상담</div></td>
				  </tr>
				</table>
				<br />
-->
			
                <!-- 본문시작 -->
			
<style type="text/css">
.viewtable { border-collapse:collapse; margin-top:30px; }
.viewtable th {background-color:#d8c8b3;}
.viewtable th.topline, .viewtable td.topline {border-top:2px solid #362e2b;}
.viewtable th,.viewtable td {border-bottom:1px solid #655a4a;}
input.sbutton {border:1px solid #877c6b; text-align:center; background-color:#877c6b;  line-height:none; height:20px;
					color:#ffffff; font-size:11px; padding:0px 3px; cursor:hand;}
.bbsbg{background-color:#e6d8c6;border:1px solid #877c6b; }
.Chk {width:13px; height:13px; margin-top:-3px;}
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
	  <?if(!$_SESSION["login_id"]){?>
      <tr>
            <th width="15%" class="topline" align="center">이름</th>
            <td width="35%" class="topline"><input type=text value='<?=$_SESSION["login_name"]?>' name='name'></td>
            <th width="15%" class="topline">비밀번호</th>
            <td width="35%" class="topline"><input type="password" value='' name='pwd'></td>
      </tr>			 
	  <tr>
          <th>스팸방지</th>
          <td   colspan="3" ><strong><?=$randKey?></strong> &nbsp;&nbsp; 
          <input type=text name='spaNumber' style="vertical-align:middle"> &nbsp;좌측의 숫자을 입력하세요.</td>
	</tr>
	<?}else{?>
      <tr>
            <th width="15%" class="topline" align="center">이름</th>
            <td colspan="3" width="85%" class="topline"><input type=text value='<?=$_SESSION["login_name"]?>' name='name'></td>
      </tr>			 
	<?}?>
		
	
		<tr>
	  <th>제목</th>
          <td colspan="3" ><input type=text size="55" name="subject" style="width:380" value="<?=$view[subject]?>">
<!--             <input type="checkbox" class="Chk" name="notice" value="Y"  />공지   -->
             <input type="checkbox" class="Chk" name="security" value="N" />비밀글    
          </td>
	</tr>
		
	
	<tr>
	  <td colspan="4" align="center">


      <table width="98%"  border="0" cellspacing="0" cellpadding="0" align="center"  style="margin:10px 0;" >
      <tr><td>
          <script type="text/javascript" src="../board/js/HuskyEZCreator.js" charset="utf-8"></script>
          <textarea rows=12 name="memo" id="memo" style="width:100%; height:200px;display:none;" wrap="physical"><?=stripslashes($view[memo])?></textarea></center>

      <script type="text/javascript">
      var oEditors = [];
      nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: "memo",
        sSkinURI: "../board/SmartEditor2Skin.html",	
        htParams : {bUseToolbar : true,
          fOnBeforeUnload : function(){
            //alert("아싸!");	
          }
        }, //boolean
        fOnAppLoad : function(){
          //예제 코드
          //oEditors.getById["memo"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
        },
        fCreator: "createSEditor2"
      });

      function pasteHTML() {
        var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
        oEditors.getById["memo"].exec("PASTE_HTML", [sHTML]);
      }

      function showHTML() {
        var sHTML = oEditors.getById["memo"].getIR();
        alert(sHTML);
      }
        
      function submitContents(elClickedObj) {
        oEditors.getById["memo"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
        
        // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("memo").value를 이용해서 처리하면 됩니다.
        
        try {
          elClickedObj.form.submit();
        } catch(e) {}
      }

      function setDefaultFont() {
        var sDefaultFont = '돋음';
        var nFontSize = 10;
        oEditors.getById["memo"].setDefaultFont(sDefaultFont, nFontSize);
		oEditors.getById["memo"].exec("RESIZE_EDITING_AREA", [0, 250]); 
      }
      setDefaultFont();
	  
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
	  <td  colspan='3'><input type="file" size="70" name="upfile[]" class="textarea_01" style="width:400px;">&nbsp;  </a>
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
		<img src='../board/img/btn/btn_write2.gif' class="imgbt1" onclick="write_ok()" />
		<img src='../board/img/btn/btn_list.gif' class="imgbt1" onClick="window.location='javascript:history.back(-1)'" />
</center>





			    <!-- 본문끝 -->

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
		<?if(!$_SESSION["login_id"]){?>
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

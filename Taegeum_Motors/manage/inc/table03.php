<table width="900" border="0" cellspacing="0" cellpadding="0" style="margin-top:0px;">
  <tr>
    <td><img src="/manage/img/icon_1.jpg" class="bullet"/> <strong>문서함/</strong> 파일명을 클릭하면 다운로드가 됩니다 (예:폐차증명서/말소증등)</td>
  </tr>
  <tr>
    <td>
	<form action="/manage/inc/doc_upload.php" method="post" enctype="multipart/form-data" name="file_form" target="HiddenFrm" id="file_form">
	<input type="hidden" name="wc_idx" value="<?=$wc_idx?>" />
	<input type="hidden" name="title" />
	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0">
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" padding-left:10px;">
		  <input type="radio" name="file_type" value="CBC025" onclick="document.file_form.title.value='폐차인수증명서';"/>폐차인수증명서 <input type="radio" name="file_type" value="CBC026" onclick="document.file_form.title.value='명의변경서류';"/>명의변경서류 <input type="radio" name="file_type" value="" onclick="document.file_form.title.value='기타';"/>기타
		  <input type="file" accept="image/*" multiple onChange="fileInfo(this)" name="upfile[]" id="uf1" style="display:none;"/>
		  </td>
		  <td bgcolor="#FFFFFF" style=" padding-left:10px;">
		  <input type="button" value="파일 선택" onClick="file_click();"/>
		  </td>
		 </tr>
        <tr>
          <td width="85%" height="25" bgcolor="#FFFFFF" style=" padding-left:10px;">
			<div id="img_box" style="width:97%; height:60px; overflow-y:scroll; padding:10px;">
			</div>
		  </td>
          <td bgcolor="#FFFFFF" style=" padding-left:10px;"><input type="submit" value="등록" class="btn-red" >
		  </td>
		 </tr>
	</table>
	</form>
	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" style="padding:0 0 0 0" class="table-style">
      <colgroup>
      <col style="width: auto;">
      <col style="width: 20%;">
      <col style="width: 20%;">
      <col style="width: 20%;">
      </colgroup>
        <tr>
          <td class="table-th" bgcolor="f6f6f6" style="padding-left:10px;">등록일</td>
          <td class="table-th" bgcolor="f6f6f6">제목</td>
          <td class="table-th" bgcolor="f6f6f6" style="padding-left:10px;">파일명</td>
          <td class="table-th" bgcolor="f6f6f6" >관리</td>
        </tr>
      <?
$sql_f="select * from dongbu2 where wc_idx='$wc_idx' order by regdate desc ";
$result_f=mysql_query($sql_f);
while($data_f=mysql_fetch_array($result_f)){
?>
        <tr>
          <td align="center" bgcolor="#FFFFFF" style="height: 25px; padding-left:10px;"><?=substr($data_f[regdate],0,20)?></td>
          <td align="center" bgcolor="#FFFFFF"><?=$data_f[title]?></td>
          <td align="center" bgcolor="#FFFFFF"><a href="../file/<?=$data_f['filename']?>" target="_blank"><font color="#0066CC">
            <?=$data_f['filename']?>
          </font></a></td>
          <td align="center" bgcolor="#FFFFFF"><font color="#000000" onclick="del_f('<?=$data_f[idx]?>')" style="cursor:pointer;">삭제</font></td>
        </tr>
        <?
}
?>
    </table></td>
  </tr>
</table>


<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>

<script>
function nak_sms(hp){
	if(confirm('입금통장안내 문자를 전송하시겠습니까?')){
		document.getElementById('HiddenFrm').src="/manage/inc/nak_sms.php?hp="+hp;
	}
}
function del_f(idx){
	if(confirm('삭제하시겠습니까?')){
		document.getElementById('HiddenFrm').src="/manage/inc/doc_del.php?idx="+idx;
	}
}

var upfile_num=1;
var num=0;
var img_count=0;

  function fileInfo(f){
    var file = f.files; // files 를 사용하면 파일의 정보를 알 수 있음
    // 파일의 갯수만큼 반복
    for(var i=0; i<file.length; i++){
       
      var reader = new FileReader(); // FileReader 객체 사용
      reader.onload = function(rst){
         
        $('#img_box').append('<img src="' + rst.target.result + '"width="95" height="82" id="num'+num+'" data-image="tmp'+num+'" class="imgs"><input type=hidden name="tmpfile[]" value="'+ num +'"  id="tmp'+num+'" class="imgnames">'); // append 메소드를 사용해서 이미지 추가
        // 이미지는 base64 문자열로 추가
        // 이 방법을 응용하면 선택한 이미지를 미리보기 할 수 있음
      num++; img_count++; 
	  document.getElementById("img_count").innerHTML=img_count;
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
	if(file_form.file_type[0].checked==false && file_form.file_type[1].checked==false && file_form.file_type[2].checked==false){
		alert("종류 선택후 가능합니다.");
	}else{
		document.getElementById('uf1').click();
	}
}
</script>
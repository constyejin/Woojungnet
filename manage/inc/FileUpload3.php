<?
	include "$_SERVER[DOCUMENT_ROOT]/lib/common.php";

	$connect = dbconn();		
	
	$wc_idx = $_GET[wc_idx];
	


$cnt = 0;

if($wc_idx){
	$info = Row_string("SELECT * FROM woojung_car WHERE wc_idx  = '$wc_idx'");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>사진수정및삭제</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />


<style>
.imgs {margin:5px;border:1px solid #E6E6E6;}
</style>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<?
	if($fname){
?>
<script>
	opener.document.outForm.hidFileName.value="<?=$fname?>";
</script>
<?
	}
?>
<script>
 
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
	document.getElementById('uf'+upfile_num).click();
}

function delete_member(){
		
		f=document.outForm;
		result = confirm("한번 삭제하신 자료는 복구 불가능 합니다 \n정말 삭제 하시겠습니까??");
		if(result){
			f.action="image_alldel.php";
			f.submit();
		}
		
	}	

	function all_check(ty){
		if(ty==1){
			for(i=1;i<101;i++){
				id_name="ch"+i;
				document.getElementById(id_name).checked = true;
//				lng[i].checked = true;
			}
		} else {
			for(i=1;i<101;i++){
				id_name="ch"+i;
				document.getElementById(id_name).checked = false;
//				lng[i].checked = false;
			}
		}
	}
</script>
</head>

<body>
<div style="text-align:left;width:600px;">
<form name="outForm" action="image_update03.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="wc_idx" id="wc_idx" value="<?=$wc_idx?>">
<input type="hidden" name="mode" id="mode" value="insert">
<input type="hidden" name="fname" value="<?=$fname?>" />
<table width="1150" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="50" align="left">등록파일: <span id="img_count">0</span> / 100개</td>
    <td align="right" style="padding-right:13px">
      <input type="button" style="BORDER: #ff0000 1px solid; background-color : #ffe3e7; font-family:'맑은 고딕'; font-size: 9pt; color: #ff0000;  padding:0 6px 0 6px; height:26px; cursor:pointer;" value="파일찾기" onClick="file_click();"/>
      <input type="button" id="img_del" style="BORDER: #7FA8C4 1px solid; background-color : #edf1f6; font-family:'맑은 고딕'; font-size: 9pt; color: #165899; padding:0 6px 0 6px; height:26px; cursor:pointer;" value="초기화" />
<? for($i=1;$i<=10;$i++){ ?>
  <input type="file" accept="image/*" multiple onChange="fileInfo(this)" name="upfile[]" id="uf<?=$i?>" style="display:none;"/>
<? } ?>	</td>
  </tr>
  <tr>
    <td height="13" colspan="2" align="left">
	<div id="img_box" style="width:97%; height:110px; overflow-y:scroll; padding:10px; border:1px; border-style:solid; border-color:#000000">
      <!--table border="0" width="110" cellpadding="0" cellspacing="0">
        <tr>
          <td width="10%" align="center"><table border="0" width="100" height="80" cellpadding="2" cellspacing="1" bgcolor="#E6E6E6">
              <tr>
                <td bgcolor="white" align="center"></td>
              </tr>
            </table>
              </td>
        </tr>
      </table-->
    </div></td>
  </tr>
  <tr>
    <td height="50" colspan="2" align="center"><input type="submit"  style="BORDER: #7FA8C4 1px solid; background-color : #edf1f6; font-family:'맑은 고딕'; font-size: 9pt; color: #165899; padding:0 6px 0 6px; height:26px; cursor:pointer;" value="파일업로드" /></td>
  </tr>
</table>   
  <div  style="width:930px;text-align:left;"></div>
  </div>


<table width="110" border="0" align="left">
      <tr>
        
        
        
        
        <?	
	$cnt = 0;
	$imgCnt = 0;
	$real_name = explode('|:|',$fname);
	for($i=1; $i<=100; $i++) {
			
		
		if(!$wc_idx){
			if(strlen($real_name[$i-1]) == 0)
			{
				$fileName = '';
			}
			else
			{
				$fileName = $real_name[$i-1];
				$rname = $real_name[$i-1];
				$imgCnt++;
			}

			$name = $real_name[$i];
		}else{
		$file_name = 'wc_img_'.$i;
		$real_name = explode('/',$info[$file_name]);
		$fileName = 'file'.$i;
		if(strlen($real_name[0]) == 0)
		{
			$fileName = '';
		}
		else
		{
			$fileName = $real_name[0];
			$imgCnt++;
		}
		}
	
		if($cnt%10 == 0){ echo '</tr><tr>';}

		if($fileName){
		?>
		
	        <td colspan="2"><!--이미지 시작 -->
	            <table border="0" width="110" cellpadding="0" cellspacing="0" align="center">           
	            
	               
	              <tr>
	                <td width="10%" align="center"><table border="0" width="100" height="80" cellpadding="2" cellspacing="1" bgcolor="#E6E6E6">
            <tr>
	                      <td bgcolor="white" align="center"><!--실제 사진 시작 --> 
                            <img src="../../data/<?=$fileName?>" name="bt01" width="90" height="82" border="0" id="bt01" />
	                          <!--실제 사진 끝 -->	                      </td>
                      </tr>
	                  </table>
    <table border="0" width="100%" cellpadding="5" cellspacing="0">
	                      <tr>
	                        <td width="72%" style="font-size:12px"><input type="checkbox" name="ch_<?=$cnt+1?>" id="ch<?=$cnt+1?>" value="1" style="vertical-align:middle">
	                          <?=$cnt+1?>
	                          <br />	                        </td>
	                        <td width="28%" align="right"><? if($fileName!='noImage_auction.gif'){ ?>
								<a href="image_update03.php?Mode=down&tmp_name=<?=$fileName?>&name=<?=$rname?>" ><img src="../img/btn_down.gif" border="0" align="absmiddle" style="cursor:pointer;"/></a>
								<? } ?></td>
	                      </tr>
	                  </table></td>
	              </tr>
	            </table>
          <!--이미지 끝 --></td>
          
          <? $cnt++;} } 
          ?>
      </tr>
    </table>
<input type="hidden" name="imgcnt" value="<?=$imgCnt?>">
  </form>
  </form>

  <table width="1150" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><input type="button" name="button3" id="button3" value="전체선택" class="button33"  style="BORDER: #ff0000 1px solid; background-color : #ffe3e7; font-family:'맑은 고딕'; font-size: 9pt; color: #ff0000;  padding:0 6px 0 6px; height:26px; cursor:pointer;" onClick="all_check(1)"/>
        <input type="button" name="button2" id="button2" value="전체해제" class="button33" style="BORDER: #7FA8C4 1px solid; background-color : #edf1f6; font-family:'맑은 고딕'; font-size: 9pt; color: #165899; padding:0 6px 0 6px; height:26px; cursor:pointer;" onClick="all_check()"/>
      <input type="button" name="button4" id="button4" value="선택삭제" class="button33" style="cursor:pointer;font-family:'맑은 고딕'; background-color:#FFFFFF;font-size: 9pt; color:#ffffff; border:#000000 1px solid;padding:0 6px 0 6px;height:26px; background-color:#000000" onClick="delete_member()"/></td>
      <td align="right"><span style="padding-right:13px">
        <input type="button" style="cursor:pointer;font-family:'맑은 고딕'; background-color:#FFFFFF;font-size: 9pt; color:#ffffff; border:#000000 1px solid;padding:0 6px 0 6px;height:26px;  font-weight:bold; background-color:#000000" value="칭닫기" onClick="window.close();"/>
      </span></td>
    </tr>
  </table>
</body>
</html>
<?include "../inc/header.php" ?>
<?
	if(!$loginId){
	echo "<script>alert('로그인후 사용 가능합니다.');location.href='/member/login.php';</script>";
	}

	$query = $db->query("select * from woojung_member where userId='$loginId' limit 1");
	$row = mysql_fetch_object($query);

?>
<style>
.imgs {margin:5px;border:1px solid #E6E6E6;cursor:pointer;}
</style>

<div id="new_wrap">

<script type="text/javascript" src="/common/js/form.js"></script>
<script >
function out_submit(){

	f=document.outForm;

	if(!f.car_no.value){
		alert('차량번호를 입력해 주세요');
		return;
	}else{
		f.submit();
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
	document.getElementById('uf'+upfile_num).click();
}
</script>
<style type="text/css">
/* .viewtable { border-collapse:collapse; margin-top:30px; }
.viewtable th {background-color:#EFEFEF; height:50px;font-size:13px;}
.viewtable td {text-align:left; padding-left:7px;}

.viewtable th.topline, .viewtable td.topline {border-top:2px solid #000000;}
.viewtable th,.viewtable td {border-bottom:1px solid #D8D8D8;}
.viewtable input {border:1px solid #D8D8D8;   line-height:none; height:25px;color:#ffffff; padding:0px 3px; cursor:hand;} */
						 
</style>
<div id="contents_basic">
 
    <div class="co_car_all">
			<div class="sub-visual">
				<div class="sub-text">
					<p class="catch-phrase">
						차량등록
					</p>
					<p class="description-text">공정한 온라인경공매시스템으로  신속, 정확한 정보를 제공합니다.</p>
			  </div>
			</div>
        
		<div class="div_basic">

			<div class="tab_type01">
				<ul>
					<li><a href="sub01_1.php"><span>차량등록</span></a></li>
					<li class="on"><a href="sub01_2.php"><span>사진추가</span></a></li>
					<li><a href="sub01_3.php"><span>차량상담</span></a></li>
				</ul>
			</div>

 
			
			  <table cellpadding="0" cellspacing="0">
 

					<tr> 
						<td height="10"></td>
					</tr> 		

           <tr>
            <td valign="top"  align="center"> 
							<form name="outForm" action="sub01_2_save.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="mode" id="mode" value="pic_regist">
							<input type="hidden" name="hidFileName"/>
							<div class="widcen_1200">
								<table class="viewtable form-table">  
									<colgroup>
                    <col style="width: 180px;">
                    <col style="width: 420px;">
                    <col style="width: 180px;">
                    <col style="width: auto;">
                  </colgroup>
									<tr> 
										<th>
											이름<font color="#FF6600"> *</font></th>
										<td> 
											<?=$row->name?>
										</td>
										<th>휴대전화<font color="#FF6600"> 
											*</font></th>
										<td> 
											<?=$row->pcs?>
										</td>
									</tr>
									<tr> 
										<th>차량번호<font color="#FF6600"> 
											*</font>
										</th>
										<td colspan="3">
											<input name="car_no" type="text"  id="car_no" size="30" required="required" hname='차량번호' class="form_control" style="width:150px;" />
											<span class="notice-text">예 : 서울02마1234</span>
										</td>
									</tr>
								</table>
							</div>
																	
							<table  style="width:1200px" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
								<tr>
									<td>
											<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 20px;">
												<tr>
													<td>등록파일 <span id="img_count">0</span> /24 </td>
													<td align="right"><input type="button" style="BORDER: #ff0000 1px solid; background-color : #ffe3e7; font-family:'맑은 고딕'; font-size: 9pt; color: #ff0000;  padding:0 6px 0 6px; height:26px; cursor:pointer;" value="파일찾기" onclick="file_click();"/>
													<input type="button" id="img_del" style="BORDER: #7FA8C4 1px solid; background-color : #edf1f6; font-family:'맑은 고딕'; font-size: 9pt; color: #165899; padding:0 6px 0 6px; height:26px; cursor:pointer;" value="초기화" />
													<? for($i=1;$i<=10;$i++){ ?>
													<input type="file" accept="image/*" multiple onChange="fileInfo(this)" name="upfile[]" id="uf<?=$i?>" style="display:none;"/>
													<? } ?>
													</td>
												</tr>
											</table>
										<br />
										<div id="img_box" style="height:110px; overflow-y:scroll; padding:10px; border: 1px solid #d4d4d4;"></div>
									</td>
								</tr>
							</table>

							<table  style="width:1200px" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #999999">
								<tr> 
									<td align="left" style="padding-left: 15px; padding-top:15px;">* 신청접수의 각 항목을 기입 후 신청해주시면, 
																업무담당자가 확인후 연락을 드립니다.<br />
																* 고객님께서 입력하신 내용은 경ㆍ공매 및 폐차진행을 위한 기본정보이며 안전하게 보호관리됨을 알려드립니다.<br /><br />
									</td>
								</tr>
								<tr> 
									<td width="900"  valign="top" align="center" style="padding-bottom:50px;">
										<a href="javascript:void(0)" onclick="out_submit();" style="display:inline-block; color:#fff"><div style="" class="user-btn Scor-font-500">사진추가등록</div></a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			
		</div>
	</div>
	<!-- footer -->
	<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>

</body>
</html>


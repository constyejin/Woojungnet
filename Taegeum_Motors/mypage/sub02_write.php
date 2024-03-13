<?include "../inc/header.php" ?>

<?
if($loginId){
	$row = mysql_fetch_array(mysql_query("SELECT * FROM woojung_member WHERE userId='$loginId'"));
	if($row[idx]) {
		$call_line = 'user';
		$post = $row[post1].'-'.$row[post2];
	} else {
		$call_line = '';
		$post = '';
	}
	$telarr = $row[tel];
	$pcsarr = explode('-',$row[pcs]); 
	$faxarr = explode('-',$row[fax]); 
	$emailarr = explode('@',$row[email]);
	$zipcode1 = $row[post1];
	$zipcode2 = $row[post2];

	//dbclose($connect);
}	
 ?>

<!-- 마이페이지독립 css -->
<style type="text/css">
.join_img_body { position:relative;  margin-top:40px; }
.join_area p {text-align:left; margin:10px 0;}
.join_img_body table.join_form tr th { background:#f7f7f7; border:1px solid #666666; font-weight:normal; }
.join_img_body table.join_form tr td { text-align:center; padding:2px 2px 2px 2px; color:#000000; border:1px solid #949294;}
input[type=text] { padding:1px 1px 1px 1px; border:1px solid #008ad9; height:17px; }
.join_img_body table.join_form tr td  table { padding:0; margin:0; }
.join_img_body table.join_form tr td  table tr td { padding:0; margin:0; border:none; padding:2px 2px 2px 2px; }
..join_area p.s_title { font-size:10pt; font-weight:bold; }
.style1 {font-weight: bold}
</style>
<script language="javascript">

function out_submit(){

	f=document.outForm;

/*	if(f.wc_go_type[0].checked==false && f.wc_go_type[1].checked==false && f.wc_go_type[2].checked==false){
		alert('매각유형은 필수 입력 사항입니다.');
		return false;
	}
*/
	NfUpload.FileUpload();
}

</script>

<script language="JavaScript" type="text/javascript">
function si_chk(z){ 
	var tmp = z.options[z.selectedIndex].value; 
	document.outForm.car_name.options[0].selected="true";
	gufrm.location.href = "/admin/inc/gu.php?tmp="+tmp;  
} 
</script>
<?
if($row[wc_made]){
?>
<iframe name="gufrm" style="display:none;" src="/admin/inc/gu.php?tmp=<?=$row[wc_made]?>"></iframe>
<?}else{?>
<iframe name="gufrm" style="display:none;" src=""></iframe>
<?}?>

<script language="JavaScript" type="text/javascript" src="/nfupload/NFUpload/nfupload.js?d=20081028"></script>
<script language="JavaScript" src="/admin/inc/default.js"></script>


<div id="new_wrap">

	<div id="main_wrap">
		<div id="cha_contents">
			<!-- login -->
			<div id="con_left">
<?include "../inc/login.php";?>
				<!-- 좌측 서브 메뉴 start -->
<?include "mypage_menu.php";?>
				<!-- 좌측 서브 메뉴 end -->
				<div class="con_ban"><img src="/images/img_banner_1.jpg"></div>
				<div class="con_cs"><img src="/images/img_cs.jpg"><p style="padding-top:15px"><img src="/images/img_bank.jpg"></div>
			</div>
			<div id="con_right">
				<h1><img src="/images/img_sub1.jpg"></h1>

			<!--컨텐츠 부분-->
			  <table>
				  <tr> 
					<td>&nbsp;</td>
				  </tr>
				  <tr> 
					<td height="7"></td>
				  </tr>
				  <!--출품자정보-->
				  <tr> 
    <td class="title"><img src="/admin/img/icon02.gif" width="15" height="15" ALIGN=absmiddle> 
      출품자정보</td>
  </tr>
<form name="outForm" method="post" action="sub02_write_save.php" enctype="multipart/form-data" onsubmit='return out_submit();'>
<input type="hidden" name="mode" value="regist">
<input type="hidden" name="gubun1" value="1">
<input type="hidden" name="wc_idx" value="<?=$wc_idx?>">
<input type="hidden" name="wc_go_idx" value="">
<input type="hidden" name="aucidx" value="<?=$aucidx?>">
<input type="hidden" name="aucorderNo" value="<?=$aucNo?>">
<input type="hidden" name="href" value="<?=$href?>">
<input type="hidden" name="hidFileName"/>
  <tr> 
    <td><table width="780"  class="ex">
        <tr > 
          <td width="90" bgcolor="f6f6f6" align="center">진행상태 </td>
          <td colspan="3" style="padding-left:10px;">
          <input type="radio" name="calltype" id="radio" value="대기" <?if($row[calltype]=="대기") echo "checked"; ?>/>
          대기
          <input type="radio" name="calltype" id="radio2" value="판매" <?if($row[calltype]=="판매") echo "checked"; ?>/>
          판매
          <input type="radio" name="calltype" id="radio3" value="완료" <?if($row[calltype]=="완료") echo "checked"; ?>/>
          완료</td>
		  </tr>
        <tr > 
          <td width="90" bgcolor="f6f6f6" align="center">담 당 자</td>
          <td width="299" style="padding-left:10px;">
<input name="call_name" type="text" id="call_name" value="<?=$row[wc_mem_name]?$row[wc_mem_name]:$loginName?>" size="20" class="input" required="required" hname='신 청 자' /></td>
          <td width="92" align="center" bgcolor="f6f6f6">일반전화</td>
          <td width="297" style="padding-left:10px;"> 


		  <?
				$tel = $row[tel];

		  $arrphone = explode("-", $tel);
		  ?>
            <input name="call_tel" type="text"  class="input" value="<?=$arrphone[0]?>" size="7" maxlength="4"/>
            - 
            <input name="call_tel2" type="text"  class="input" id="call_tel22" value="<?=$arrphone[1]?>" size="7" maxlength="4"/>
            - 
            <input name="call_tel3" type="text"  class="input" id="call_tel32" value="<?=$arrphone[2]?>" size="7" maxlength="4"/>          </td>
      </tr>
        <tr> 
          <td  align="center" bgcolor="f6f6f6">업 체 명</td>
          <td style="padding-left:10px;"><input name="wc_adminName" type="text" id="wc_adminName" value="<?=$row[company_name]?>" size="20" class="input" required="required" hname='업체명' />
		  
		  
<?
			
	// 제휴 회원이라면
	if( substr($row['usort'], 0, 3) == "com" ){
		$companyNm = $row[team_name];
		$companysubNm = $row[team_subname];
		echo $companyNm ."/". $companysubNm;
	}	





	if($row[wc_mem_mobile] == ""){
		$arrPcs = explode("-", $row[pcs]);
	}else{
		$arrPcs = explode("-", $row[wc_mem_mobile]);
	}

	if($row[wc_mem_fax] == ""){
		$arrFax = explode("-", $row[fax]);
	}else{
		$arrFax = explode("-", $row[wc_mem_fax]);
	}



?>	
			
			</td>
          <td align="center" bgcolor="f6f6f6">휴대전화</td>

	
          <td style="padding-left:10px;">
          
		  
		  
            <input name="call_pcs1" type="text"  class="input" id="call_pcs1" value="<?=$arrPcs[0]?>" size="7" maxlength="4" required="required" hname='휴대전화' >
            - 
            <input name="call_pcs2" type="text" class="input" id="call_pcs2" value="<?=$arrPcs[1]?>" size="7" maxlength="4" required="required" hname='휴대전화' />
            - 
            <input name="call_pcs3" type="text"  class="input" id="call_pcs3" value="<?=$arrPcs[2]?>" size="7" maxlength="4" required="required" hname='휴대전화' /> 
		  
		  </td>
        </tr>
        <tr> 
          <td align="center" bgcolor="f6f6f6">이 메 일</td>
          <td style="padding-left:10px;"><input type="text" name="wc_mem_etc" style='width:150;' value="<?=$row[email]?>"></td>
          <td align="center" bgcolor="f6f6f6">팩스번호</td>




          <td style="padding-left:10px;"><input name="fax1" type="text"  value="<?=$arrFax[0]?>" size="7" maxlength="4" >
            - 
            <input name="fax2" type="text" value="<?=$arrFax[1]?>" size="7" maxlength="4" >
            - 
            <input name="fax3" type="text"  value="<?=$arrFax[2]?>" size="7" maxlength="4" ></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td class="title"><img src="/admin/img/icon02.gif" width="15" height="15" ALIGN=absmiddle> 
      차량정보</td>
  </tr>
  <tr> 
    <td>


	
	<table width="780" class="ex">
<tr > 
          <td width="97" align="center" bgcolor="f6f6f6">차량번호</td>
			<td width="294" style="padding-left:10px;">
				<input name="carno" type="text"  class="input"  value="<?=$row[wc_no]?>" size="20" maxlength="50"/>
				 <span style="padding:10 0 0 5">  
				
			</td>
              <td  width="91" align="center" bgcolor="f6f6f6">판매가격</td>
          <td  style="padding-left:10px;" width="293"> 
		  <input type="text" name="wc_price"  value="<?=number($row[wc_price])?>"  style='width:100;' onKeyup="javascript:calculation5(wc_price);">
            원 
		</td>
      </tr>
        <tr > 
          <td align="center" bgcolor="f6f6f6">제조사</td>
          <td style="padding-left:10px;"> 
			<select name="made" onchange="si_chk(this)">
			<option value="" selected>:: 제조사 ::</option>
<?
$sql="select * from cate2 where depth='1' ";
$result_made=mysql_query($sql);
while($data_made=mysql_fetch_array($result_made)){
?>
			<option value="<?=$data_made[idx]?>" <?if($row[wc_made]==$data_made[idx]) echo "selected";?>><?=$data_made[name]?></option>
<?
}
?>
			</select>
</td>
          <td align="center" bgcolor="f6f6f6">모 델 명</td>
          <td style="padding-left:10px;">
			<select name="car_name">
			<option value="" selected>:: 모델명 ::</option>
<?
if($row[wc_made]){
	$sql="select * from cate2 where code='$row[wc_made]' order by name asc";
	$result_made=mysql_query($sql);
	while($data_made=mysql_fetch_array($result_made)){
?>
			<option value="<?=$data_made[name]?>" <?if($row[wc_model]==$data_made[name]) {echo "selected";}?>><?=$data_made[name]?></option>
<?
	}
}
?>
			</select>
          <span style="padding:3 0 0 5">
          <input type="text" name="car_name2"  value="<?=$row[wc_model2]?>" style='width:100;'  />
          </span>
          </span>
		  </td>
      </tr>
        <tr> 
          <td align="center" bgcolor="f6f6f6">년 식</td>
        <td style="padding-left:10px;"><table cellspacing="0" cellpadding="0" class="ex2">
<tr> 
                <td width="40" align="left" valign="middle"> 
                  <?=$phpfun->holic_year('car_year_yy',substr($row[wc_age],0,4))?> 년</td>
                <td width="40" align="left" valign="middle"> 
                  <?=$phpfun->holic_month2('car_year_mm',substr($row[wc_age],4,2))?> 월</td>
                <td width="20" align="left" valign="middle"></td>
          </tr>
            </table></td>
          <td align="center" bgcolor="f6f6f6">변 속 기</td>
          <td style="padding-left:10px;">  
			<select name="trans">
			<option value="" selected>:: 변속기 ::</option>
<?
$sql="select * from cate where code='1' ";
$result_made=mysql_query($sql);
while($data_made=mysql_fetch_array($result_made)){
?>
			<option value="<?=$data_made[name]?>" <?if($row[wc_trans]==$data_made[name]) echo "selected";?>><?=$data_made[name]?></option>
<?
}
?>
			</select>
</td>
      </tr>
        <tr> 
          <td  align="center" bgcolor="f6f6f6">연 료</td>
          <td  style="padding-left:10px;"> 
			<select name="fual">
			<option value="" selected>:: 연료 ::</option>
<?
$sql="select * from cate where code='2' ";
$result_made=mysql_query($sql);
while($data_made=mysql_fetch_array($result_made)){
?>
			<option value="<?=$data_made[name]?>" <?if($row[wc_fual]==$data_made[name]) echo "selected";?>><?=$data_made[name]?></option>
<?
}
?>
			</select>
</td>
          <td align="center" bgcolor="f6f6f6">배 기 량</td>
          <td  style="padding-left:10px;"> <input type="text" name="carcc" value="<?=number($row[wc_cc])?>" style='width:100;' onKeyup="javascript:calculation5(carcc);">
            cc </td>
      </tr>
        <tr> 
          <td  align="center" bgcolor="f6f6f6">주행거리</td>
          <td  style="padding-left:10px;"> <input type="text" name="carmile"  value="<?=number($row[wc_mileage])?>" style='width:100;' onKeyup="javascript:calculation5(carmile);">
            km</td>
          <td align="center" bgcolor="f6f6f6">사고유무</td>
          <td  style="padding-left:10px;"> 
			<input type="radio" name="caraccdate" value="무사고" >무사고  
			<input type="radio" name="caraccdate" value="사고있음">사고있음
		  </td>
      </tr>
        <tr> 
          <td align="center" bgcolor="f6f6f6">기본옵션</td>
          <td colspan="3"  style="padding-left:10px;">

			<?
			//== /lib/code.php 안에 있음
			WriteArrHTML('checkbox', 'carOption[]', $ArrcarOption, $row[wc_option], '', 6, 'all', '');
		   ?>		   </td>
      </tr>
        <tr> 
          <td height="60" align="center" bgcolor="f6f6f6">추가옵션</td>
          <td colspan="3" style="padding:5px 10px 5px 10px; ">
			<textarea name="carOptionadd" rows="3" style="width:95%; border:1px solid #008ad9;"><?=$row[wc_option_add]?></textarea>
		  </td>
      </tr>
        <tr> 
          <td height="156" align="center" bgcolor="f6f6f6">설명문구</td>
         <td colspan="3" style="padding:5px 10px 5px 10px; "><textarea name="car_memo" id="car_memo" style="width:95%;border:1px solid #008ad9;" rows="10" wrap="hard"></textarea></td>
      </tr>
        
		<tr> 
          <td  align="center" bgcolor="f6f6f6">사진등록<br> </td>
          <td colspan="3"  style="padding:5 10 5 10" width="655"><table width="98%" height="71" border="0" class="ex2">
              <tr> 
                <td height="33">
<table width="98%" border="0">
		<div style="position:absolute;"> 
			<div style="position:absolute;top:-10px;left:120px;z-index:30;width:480;"> 
		
			<table border="0" cellpadding="0" cellspacing="0" width="470">
			 <tr> 
				  <td align="center"  style="padding-top:10px;"> 
					<script language="javascript">
						<!--
	// -----------------------------------------------------------------------------
	// NFUpload User's Config
	// -----------------------------------------------------------------------------
		// 업로드 설정
			var _NF_UploadUrl = "/nfupload/nfupload_proc.php";					   // 업로드 소스파일 경로 (반드시 입력해야함)
			var _NF_FileFilter = "이미지 파일|:|*.jpg;*.jpeg;*.gif;*.png;*.bmp";
			// 파일 필터링 값 ("이미지(*.jpg)|:|*.jpg;*.gif;*.png;*.bmp"); // 기본값 모든파일
			//var _NF_FileFilter = "이미지 파일|:|*.jpg;*.jpeg;*.gif;*.png;*.bmp";								// 파일 필터링 값 ("이미지(*.jpg)|:|*.jpg;*.gif;*.png;*.bmp"); // 기본값 모든파일
			var _NF_DataFieldName = "upfile";				// 업로드 폼에 사용되는 값 (기본값(UploadData))
			var _NF_Flash_Url = "/nfupload/NFUpload/nfupload.swf?d=20081028";			// 업로드 컴포넌트 플래쉬 파일명

		// 화면 구성
			
			var _NF_Width = 600;									// 업로드 컴포넌트 넓이 (기본값 480)
			var _NF_Height = 130;								   // 업로드 컴포넌트 폭 (기본값 150)
			var _NF_ColumnHeader1 = "파일명";					   // 컴포넌트에 출력되는 파일명 제목 (기본값: File Name)
			var _NF_ColumnHeader2 = "용량";						 // 컴포넌트에 출력되는 용량 제목 (기본값: File Size)
			var _NF_FontFamily = "굴림";							// 컴포넌트에서 사용되는 폰트 (기본값: Times New Roman)
			var _NF_FontSize = "11";								// 컴포넌트에서 사용되는 폰트 크기 (기본값: 11)

		// 업로드 제한
			var _NF_MaxFileSize = <?= $__NFUpload['max_size_total'] ?>;							// 업로드 제한 용량 (기본값: 10,240 Kb) (단위는 Kb)
			var _NF_MaxFileCount = <?= $__NFUpload['max_count'] ?>;							  // 업로드 파일 제한 갯수 (기본값: 10)
			var _NF_File_Overwrite = <? if ($__NFUpload['file_overwrite']) echo 'true'; else echo 'false'; ?>;						 // 업로드시 파일명 처리방법(true : 원본파일명 유지, 덮어씌우기 모드 / false : 유니크파일명으로 변환, 중복방지)
			var _NF_Limit_Ext = "<?= $__NFUpload['limit_ext'] ?>";	 // 파일 제한 확장자

			// [2008-10-28] Flash 10 support
			var _NF_Img_FileBrowse = "images/btn_file_browse.gif";  // 파일찾기 이미지
			var _NF_Img_FileBrowse_Width = "59";                    // 파일찾기 이미지 넓이 (기본값 59)
			var _NF_Img_FileBrowse_Height = "22";                   // 파일찾기 이미지 폭 (기본값 22)
			var _NF_Img_FileDelete = "images/btn_file_delete.gif";  // 파일삭제 이미지
			var _NF_Img_FileDelete_Width = "59";                    // 파일삭제 이미지 넓이 (기본값 59)
			var _NF_Img_FileDelete_Height = "22";                   // 파일삭제 이미지 폭 (기본값 22)
			var _NF_TotalSize_Text = "첨부용량 ";                   // 파일용량 텍스트
			var _NF_TotalSize_FontFamily = "굴림";                  // 파일용량 텍스트 폰트
			var _NF_TotalSize_FontSize = "12";                      // 파일용량 텍스트 폰트 크기

	// -----------------------------------------------------------------------------
	// NFUpload Function
	// -----------------------------------------------------------------------------
		// 폼입력 완료
		function NFU_Complete(value) {
			document.outForm.hidFileName.value = '';
			var files = document.outForm.hidFileName.value;
			var fileCount = 0;
			var i = 0;

			// 이 부분을 수정해서 파일이 선택되지 않았을 때에도 submit을 하게 수정할 수 있습니다.
			if (value == null) {
				document.outForm.submit();
				//alert('사진을 1장이상 등록해주십시오');
				return false;
			}
		
			fileCount = value.length;

			for (i = 0; i < fileCount; i++)
			{
				var fileName = value[i].name;
				var realName = value[i].realName;
				var fileSize = value[i].size;

				// 분리자(|:|)는 다른 문자로 변경할 수 있다.
				files += fileName + "/" + realName + "|:|";
			}

			if (files.substring(files.length - 3, files.length) == "|:|") {
				files = files.substring(0, files.length - 3);
			}
			document.outForm.hidFileName.value = files;
			document.outForm.submit();
		}

		// 폼입력 취소
		function NF_Cancel()
		{
			// 초기화 할때는 첨부파일 리스트도 같이 초기화 시켜 준다.
			NfUpload.AllFileDelete();
			FrmUpload.reset();
		}

		// 선택된 파일들의 총용량을 화면에 갱신시킴.
		function NF_ShowUploadSize(value) {
			// value값에 실제 업로드된 용량이 넘어온다.
			sUploadSize.innerHTML = value;
		}

		// 업로드 실패시 경고문구
		function NFUpload_Debug(value)
		{
			Debug("업로드가 실패하였습니다.\r\n\r\n관리자일 경우 디버깅모드를 활성화시켜 디버깅로그를 확인해보시면 됩니다.\r\n\r\n" + value);
		}

//		function window.onload() {
//			document.outForm.hidFileName.value = "";
			//sMaxSize.innerHTML = SizeCalc(_NF_MaxFileSize);
//		}
							// NFUpload 객체 생성
							//NfUpload = new NFUpload({ nf_upload_id : _NF_Uploader_Id, nf_width : _NF_Width, nf_height : _NF_Height, nf_field_name1 : _NF_ColumnHeader1, nf_field_name2 : _NF_ColumnHeader2, nf_max_file_size : _NF_MaxFileSize, nf_max_file_count : _NF_MaxFileCount, nf_upload_url : _NF_UploadUrl, nf_file_filter : _NF_FileFilter, nf_data_field_name : _NF_DataFieldName, nf_font_family : _NF_FontFamily, nf_font_size : _NF_FontSize, nf_flash_url : _NF_Flash_Url, nf_file_overwrite : _NF_File_Overwrite, nf_limit_ext : _NF_Limit_Ext});

							
						 NfUpload = new NFUpload({
								nf_upload_id : _NF_Uploader_Id,
								nf_width : _NF_Width,
								nf_height : _NF_Height,
								nf_field_name1 : _NF_ColumnHeader1,
								nf_field_name2 : _NF_ColumnHeader2,
								nf_max_file_size : _NF_MaxFileSize,
								nf_max_file_count : _NF_MaxFileCount,
								nf_upload_url : _NF_UploadUrl,
								nf_file_filter : _NF_FileFilter,
								nf_data_field_name : _NF_DataFieldName,
								nf_font_family : _NF_FontFamily,
								nf_font_size : _NF_FontSize,
								nf_flash_url : _NF_Flash_Url,
								nf_file_overwrite : _NF_File_Overwrite,
								nf_limit_ext : _NF_Limit_Ext,
							   // nf_img_file_browse : _NF_Img_FileBrowse,
							   // nf_img_file_browse_width : _NF_Img_FileBrowse_Width,
							   // nf_img_file_browse_height : _NF_Img_FileBrowse_Height,
							   // nf_img_file_delete : _NF_Img_FileDelete,
							   // nf_img_file_delete_width : _NF_Img_FileDelete_Width,
							   // nf_img_file_delete_height : _NF_Img_FileDelete_Height,
								nf_total_size_text : _NF_TotalSize_Text,
								nf_total_size_font_family : _NF_TotalSize_FontFamily,
								nf_total_size_font_size : _NF_TotalSize_FontSize
						});
						//-->
						</script> 
						</td>
					</tr>
				  </table>
			</div>
		  </div>
	</td>
              </tr>

            </table></td>
        </tr>

      </table>	
	
	
	
	
	</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
			  </tr>
			  <tr>
						<td width="266" valign="top" align="center"><img src="/images/bt01.jpg" onclick="out_submit();" style="cursor:pointer; "></td>
					</tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>



			</div>
		</div>
	</div>
	<!-- footer -->
	<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>

</body>
</html>


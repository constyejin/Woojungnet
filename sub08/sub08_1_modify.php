<?php 
require_once "../lib/common.php";
//loginCheck();
include $_SERVER['DOCUMENT_ROOT'].'/lib/global.php';
include $_SERVER['DOCUMENT_ROOT'].'/lib/phpfun.class.php';


?>
<? $menuNow ="?pageNum=1&subNum=1"; ?>
	<? include "../inc/header.php" ?>
<script language="JavaScript" src="/admin/inc/default.js"></script>
<script type="text/javascript" src="/common/js/form.js"></script>
<script type="text/javascript">
function out_submit(){

	f=document.outForm;

	if(f.carno_c.value!='1'){
		alert('차량번호 중복확인을 해주세요');
		return false;
	}

/*	if(f.wc_go_type[0].checked==false && f.wc_go_type[1].checked==false && f.wc_go_type[2].checked==false){
		alert('매각유형은 필수 입력 사항입니다.');
		return false;
	}
*/
	if(!validate(f)) return false;
	lib.FileUpload();
	return false;
}

function moveInput(sort) {
	if(sort == 'tel1') {
		$('call_tel2').focus();
	} else if(sort == 'tel2') {
		if($F('call_tel2').length >=4)$('call_tel3').focus();
	
	} else if(sort == 'pcs1') {
		$('call_pcs2').focus();
	} else if(sort == 'pcs2') {
		if($F('call_pcs2').length >=4)$('call_pcs3').focus();
	}
}

</script>
<script language="JavaScript" type="text/javascript" src="/lib/lib/lib.js?d=20081028"></script>

	<div id="main_wrap">
		<div id="cha_contents">
			<!-- login -->
			<div id="con_left">
<?include "../inc/login.php";?>
				<!-- 좌측 서브 메뉴 start -->
<?include "sub08_1_menu.php";?>
				<!-- 좌측 서브 메뉴 end -->
			</div>
			<div id="con_right">
				<h1><img src="/images/img_sub1.jpg"></h1>
              <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td align="center" bgcolor="#FFFFFF"><table width="900" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="800" align="center" valign="top"><table width="900" border="1"  cellpadding="0" cellspacing="0" bordercolor="#CCCCCC"  class="join_form">
                                <tr>
                                  <td width="124" height="30" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px;">구분</td>
                                  <td width="773" height="25" bgcolor="#FFFFFF" class="text04" style="padding-left: 5px; padding-top: 2px; text-align:left; font-weight:normal;"><select name="wc_made" onchange="document.sear.submit();" class="no" style="border:1px solid #999999">
                                      <option value="" >= 제조사 =</option>
                                      <?
			   $team_cate_sql=mysql_query("select * from cate2 where depth='1'");
			   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
                                      <option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$wc_made){ echo "selected"; }?>>
                                      <?=$team_cate["name"]?>
                                      </option>
                                      <?}?>
                                    </select>
                                      <select name="wc_model" onchange="document.sear.submit();" class="no" style="border:1px solid #999999">
                                        <option value="" >=== 모델명 ===</option>
                                        <?
			   if($wc_made){
			   $team_cate_sql=mysql_query("select * from cate2 where code='$wc_made' order by name asc");
			   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
                                        <option value="<?=$team_cate["name"]?>" <?if($team_cate["name"]==$wc_model){ echo "selected"; }?>>
                                        <?=$team_cate["name"]?>
                                        </option>
                                        <?}}?>
                                      </select>
                                      <!--?
		//== /lib/code.php 안에 있음
		WriteArrHTML('select', 'sear2', $ArrcarPlace , $sear2, 'onchange=\'document.sear.submit();\'', '' , 'all', '== 보관지역 ==' );
		?-->
                                      <label>
                                      <select name="select" onchange="document.sear.submit();" class="no" style="border:1px solid #999999">
                                        <option value="" >=== 부품구분 ===</option>
                                        <?
			   if($wc_made){
			   $team_cate_sql=mysql_query("select * from cate2 where code='$wc_made' order by name asc");
			   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
                                        <option value="<?=$team_cate["name"]?>" <?if($team_cate["name"]==$wc_model){ echo "selected"; }?>>
                                        <?=$team_cate["name"]?>
                                        </option>
                                        <?}}?>
                                      </select>
                                    </label></td>
                                </tr>
                                <tr>
                                  <td width="124" height="30" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px;">제목</td>
                                  <td height="25" bgcolor="#FFFFFF" class="text04" style="padding-left: 5px; padding-top: 2px; text-align:left; font-weight:normal;"><input name="textfield2" type="text" size="50" /></td>
                                </tr>
                                <tr>
                                  <td width="124" height="30" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px;">부품/차량명</td>
                                  <td height="25" bgcolor="#FFFFFF" class="text04" style="padding-left: 5px; padding-top: 2px; text-align:left; font-weight:normal;"><input name="textfield2" type="text" size="50" /></td>
                                </tr>
                                <tr>
                                  <td width="124" height="30" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px;">제작년식</td>
                                  <td height="25" bgcolor="#FFFFFF" class="text04 style3" style="padding-left: 5px; padding-top: 2px; text-align:left; "><input name="textfield2" type="text" size="50" /></td>
                                </tr>
                                <tr>
                                  <td height="30" align="center" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">등급</td>
                                  <td height="25" bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><span class="style4">
                                    <input name="textfield2" type="text" size="50" />
                                  </span></td>
                                </tr>
                                <tr>
                                  <td height="30" align="center" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">기타</td>
                                  <td height="25" bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><input name="textfield2" type="text" size="50" /></td>
                                </tr>
                                <tr>
                                  <td height="30" align="center" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">가격</td>
                                  <td height="25" bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><input name="textfield2" type="text" size="50" /></td>
                                </tr>
                                <tr>
                                  <td height="90" align="center" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">운영자메모</td>
                                  <td height="25" bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left; "><textarea name="textfield2" rows="5" style="width:98%;border:1px solid #008ad9;"></textarea></td>
                                </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td height="30" colspan="3" class="title"><img src="/images/sub05_1_img4.jpg"  align="absmiddle" /></td>
                </tr>
                <tr>
                  <td colspan="3"><script language="JavaScript" type="text/javascript">
						<!--
	// -----------------------------------------------------------------------------
	// lib User's Config
	// -----------------------------------------------------------------------------
		// 업로드 설정
			var _NF_UploadUrl = "/lib/lib_proc.php";					   // 업로드 소스파일 경로 (반드시 입력해야함)
			var _NF_FileFilter = "이미지 파일|:|*.jpg;*.jpeg;*.gif;*.png;*.bmp";
			// 파일 필터링 값 ("이미지(*.jpg)|:|*.jpg;*.gif;*.png;*.bmp"); // 기본값 모든파일
			//var _NF_FileFilter = "이미지 파일|:|*.jpg;*.jpeg;*.gif;*.png;*.bmp";								// 파일 필터링 값 ("이미지(*.jpg)|:|*.jpg;*.gif;*.png;*.bmp"); // 기본값 모든파일
			var _NF_DataFieldName = "upfile";				// 업로드 폼에 사용되는 값 (기본값(UploadData))
			var _NF_Flash_Url = "/lib/lib/lib.swf?d=20081028";			// 업로드 컴포넌트 플래쉬 파일명

		// 화면 구성
			
			var _NF_Width = 600;									// 업로드 컴포넌트 넓이 (기본값 480)
			var _NF_Height = 130;								   // 업로드 컴포넌트 폭 (기본값 150)
			var _NF_ColumnHeader1 = "파일명";					   // 컴포넌트에 출력되는 파일명 제목 (기본값: File Name)
			var _NF_ColumnHeader2 = "용량";						 // 컴포넌트에 출력되는 용량 제목 (기본값: File Size)
			var _NF_FontFamily = "굴림";							// 컴포넌트에서 사용되는 폰트 (기본값: Times New Roman)
			var _NF_FontSize = "11";								// 컴포넌트에서 사용되는 폰트 크기 (기본값: 11)

		// 업로드 제한
			var _NF_MaxFileSize = <?= $__lib['max_size_total'] ?>;							// 업로드 제한 용량 (기본값: 10,240 Kb) (단위는 Kb)
			var _NF_MaxFileCount = <?= $__lib['max_count'] ?>;							  // 업로드 파일 제한 갯수 (기본값: 10)
			var _NF_File_Overwrite = <? if ($__lib['file_overwrite']) echo 'true'; else echo 'false'; ?>;						 // 업로드시 파일명 처리방법(true : 원본파일명 유지, 덮어씌우기 모드 / false : 유니크파일명으로 변환, 중복방지)
			var _NF_Limit_Ext = "<?= $__lib['limit_ext'] ?>";	 // 파일 제한 확장자

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
	// lib Function
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
			lib.AllFileDelete();
			FrmUpload.reset();
		}

		// 선택된 파일들의 총용량을 화면에 갱신시킴.
		function NF_ShowUploadSize(value) {
			// value값에 실제 업로드된 용량이 넘어온다.
			sUploadSize.innerHTML = value;
		}

		// 업로드 실패시 경고문구
		function lib_Debug(value)
		{
			Debug("업로드가 실패하였습니다.\r\n\r\n관리자일 경우 디버깅모드를 활성화시켜 디버깅로그를 확인해보시면 됩니다.\r\n\r\n" + value);
		}

//		function window.onload() {
//			document.outForm.hidFileName.value = "";
			//sMaxSize.innerHTML = SizeCalc(_NF_MaxFileSize);
//		}
							// lib 객체 생성
							//lib = new lib({ nf_upload_id : _NF_Uploader_Id, nf_width : _NF_Width, nf_height : _NF_Height, nf_field_name1 : _NF_ColumnHeader1, nf_field_name2 : _NF_ColumnHeader2, nf_max_file_size : _NF_MaxFileSize, nf_max_file_count : _NF_MaxFileCount, nf_upload_url : _NF_UploadUrl, nf_file_filter : _NF_FileFilter, nf_data_field_name : _NF_DataFieldName, nf_font_family : _NF_FontFamily, nf_font_size : _NF_FontSize, nf_flash_url : _NF_Flash_Url, nf_file_overwrite : _NF_File_Overwrite, nf_limit_ext : _NF_Limit_Ext});

							
						 lib = new lib({
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
						</script>                  </td>
                </tr>
                <tr>
                  <td colspan="3" align="center"><table width="100%" border="1" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" >
                      <tr>
                        <td height="370" align="center" bgcolor="#FFFFFF"><span class="title"><img src="/images/edit02.jpg"  align="absmiddle" /></span>
                            <table width="900" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td height="7"></td>
                              </tr>
                              <tr>
                                <td align="center"><!-- 추가사항 이미지 클릭시 위에 큰 이미지로 확대된 이미지가 보여지면 됨.
				이미지가 없을시는 /auction/img/bg01.gif 이미지가 보여지면 됨
				-->
                                    <table width="895" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <?
for($i=1; $i<=8; $i++) {

	$fim="wc_img_".$i;
	$fileName = $row[$fim];
	$real_name = explode('/', $fileName);	
	
	if(strlen($real_name[0]) == 0)
	{
		$fileName = '/images/box02.jpg';
		$script = "";
		
	}
	else
	{
		$fileName = $site_u[home_url]."/data/".$real_name[0];
		$script = " onClick=\"detailView($i)\" onmouseover=\"zoomView('$fileName', $i)\" style=\"cursor:pointer;\" ";
	}
?>
                                        <td width="85" height="44" align="center" bgcolor="BABABA"><img src="/images/sub05_1_img3.jpg" width="105" height="70"    <?=$script?> /></td>
                                        <td width="3"></td>
                                        <?
					  if($i%8 == 0){
							echo "</tr>
								  <tr><td colspan=13 height=1></td></tr>							
								  <tr>";  
					  }
}	
?>
                                      </tr>
                                  </table></td>
                              </tr>
                              <tr>
                                <td height="30" align="center" class="txt04"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td align="center"> 삭제 </td>
                                      <td align="center"> 삭제 </td>
                                      <td align="center"> 삭제 </td>
                                      <td align="center"> 삭제 </td>
                                      <td align="center"> 삭제 </td>
                                      <td align="center"> 삭제 </td>
                                      <td align="center"> 삭제 </td>
                                      <td align="center"> 삭제 </td>
                                    </tr>
                                </table></td>
                              </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td height="150" align="center" bgcolor="#FFFFFF"><span class="title"><img src="/images/edit.jpg"  align="absmiddle" /></span></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="389" height="60" align="center">&nbsp;</td>
                  <td width="166" align="center"><span class="title"><img src="/images/bt10.jpg"  align="absmiddle" /></span></td>
                  <td width="347" align="center">&nbsp;</td>
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
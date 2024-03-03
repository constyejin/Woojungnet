<?include "../inc/header.php" ?>
<?
	if(!$loginId){
	echo "<script>alert('로그인후 사용 가능합니다.');location.href='/login/login.php';</script>";
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

	if(!f.car_name.value){
		alert('차량번호를 입력해 주세요');
		return;
	}

/*	if(f.wc_go_type[0].checked==false && f.wc_go_type[1].checked==false && f.wc_go_type[2].checked==false){
		alert('매각유형은 필수 입력 사항입니다.');
		return false;
	}
*/
	f.submit();
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
    <!-- 1:자동차리스트 -->
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
					<li><a href="sub01_2.php"><span>사진추가</span></a></li>
					<li class="on"><a href="sub01_3.php"><span>차량상담</span></a></li>
				</ul>
			</div>

 
				
			  <table border="0" cellpadding="0" cellspacing="0" style="width:1200px; margin: auto;">
 
				<form name="outForm" action="sub01_3_save.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="mode" id="mode" value="pic_regist">
				<input type="hidden" name="hidFileName"/>

					<tr>
						<td align="left" height="15" colspan="4"  valign="middle" style="width:1200px;padding-bottom: 10px;"> 아래 간단이 기록하여 주시면 전문상담원이 연락을 드립니다.</td>
					</tr>
           <tr>
            <td valign="top"  align="center"> 
							<form name="outForm" method="post" action="sub01_3_save.php" enctype="multipart/form-data" onsubmit='return out_submit();'>
							<input type="hidden" name="mode" value="regist">
							<input type="hidden" name="gubun1" value="1">
							<input type="hidden" name="wc_idx" value="<?=$wc_idx?>">
							<input type="hidden" name="wc_go_idx" value="">
							<input type="hidden" name="aucidx" value="<?=$aucidx?>">
							<input type="hidden" name="aucorderNo" value="<?=$aucNo?>">
							<input type="hidden" name="href" value="<?=$href?>">
							<input type="hidden" name="hidFileName"/>
							<table class="viewtable form-table">  
								<colgroup>
									<col style="width: 180px;">
									<col style="width: 420px;">
									<col style="width: 180px;">
									<col style="width: auto;">
								</colgroup>
								<tr>
									<th>상담유형</td>
									<td colspan="3" >
										<input type="radio" name="calltype" value="사고차량" >
										<span class="radio-label" style="margin-right:5px;">사고차량</span>
										<input type="radio" name="calltype" value="폐차차량">
										<span class="radio-label" style="margin-right:5px;">폐차차량</span>
										<input type="radio" name="calltype" value="중고차량" checked="checked">
										<span class="radio-label">중고차량</span>
									</td>
								</tr>
								<tr>
									<th>
										이&nbsp;&nbsp;&nbsp;&nbsp;름<font color="#FF6600"> *</font>
									</th>
									<td colspan="3"><input name="call_name" type="text"  class="input form_control" size="30" value="<?=$row->name?>"></td>
								</tr>
								<tr>
									<th>
										휴대전화<font color="#FF6600"> *</font>
									</th>
									<td class="form_control">
										<input name="call_tel" type="text" class="input form_control"  size="5"  required="required" hname='핸드폰번호' maxlength="3" value="<?=$pcs_arr[0]?>" class="form_control">
										-
										<input name="call_tel2" type="text"  class="input form_control"  size="5"  required="required" hname='핸드폰번호' maxlength="4" value="<?=$pcs_arr[1]?>">
										-
										<input name="call_tel3" maxlength="4"  type="text" class="input form_control"  size="5" required="required" hname='핸드폰번호' value="<?=$pcs_arr[2]?>" >
									</td>
									<th>이 메 일</th>
									<td>
										<input name="wc_mem_etc"  type="text" class="input form_control" size="30" value="<?=$row->email?>" class="form_control">
									</td>
								</tr>
								<tr>	  
									<th>차량번호<font color="#FF6600"> *</font></td>
									<td>
										<input name="car_name" type="text" class="input form_control" size="30" >
									</td>
									<th>
										보관지역
									</th>
									<td>
										<input name="car_name2" type="text" class="input form_control"  size="30" >
									</td>
								</tr>
								<tr>
									<th>
										상담내용
									</th>
									<td colspan="3">
										<textarea name="wc_memo" class="form_control" rows="10"></textarea>
									</td>          
								</td>
							</tr>
 

					<table width="350" border="0" cellspacing="0" cellpadding="0" style="width: 1200px; text-align: center;">
							<tr>
								<td  valign="top" colspan="2" height="30"></td>
							</tr>
					
							<tr>
								<td style="padding-bottom: 50px;">
									<!-- <img src="/images/main_sns03.jpg" onclick="out_submit();" /> -->
									<a href="javascript:void(0)" onClick="out_submit();" style="display:inline-block; color:#fff"><div style="" class="user-btn Scor-font-500">차량상담신청</div></a>
								<!--
								<input type="button" value="취소" onclick="javascript:history.go(-1);" name="submitButton" id="submitButton" class="btn_cancle"/>-->
								</td>
							</tr>
						</table>
					</tr>
				</table>
			</td>
	  </tr>
	  <tr>
		<td height="15" align="center"></td>
	  </tr>
	  <tr>
		<td align="center"><table width="500" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td align="center"><? include "../inc/page.php";?></td>
			</tr>
		  </table></td>
	  </tr>
	  <tr>
		<td height="15" align="center">&nbsp;</td>
	  </tr>
	</table> 


 
		</div>
	</div>
	<!-- footer -->
	<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>

</body>
</html>

<script type="text/javascript">
function auctionView(idx) {
	window.location.href="sub02_1_view.php?idx="+idx;
}
</script>

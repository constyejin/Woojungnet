<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
	$pno=4;
?>

<script type="text/javascript">

<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->

// 팝업
function popup() {  
 var newwin,
  w_url = 'http://woo10123.woojungnet.co.kr/admin/pop_buy.php',
  w_name = '',
  w_width = 730,
  w_height = 600,
  w_left = (screen.width - w_width)/2,
  w_top = (screen.height - w_height)/2,
  w_options = 'width='+ w_width +', height='+ w_height +', left='+ w_left +', top='+ w_top +', scrollbars=yes';

 newwin = open(w_url, w_name, w_options);
 if(window.focus) newwin.focus();
};

// 팝업
function popup1() {  
 var newwin,
  w_url = 'http://woo10123.woojungnet.co.kr/admin/pop_buy_1.php',
  w_name = 'a',
  w_width = 730,
  w_height = 600,
  w_left = (screen.width - w_width)/2,
  w_top = (screen.height - w_height)/2,
  w_options = 'width='+ w_width +', height='+ w_height +', left='+ w_left +', top='+ w_top +', scrollbars=yes';

 newwin = open(w_url, w_name, w_options);
 if(window.focus) newwin.focus();
};



</script>
<style>
    .btn_pink {
    cursor: pointer;
    background-color: #fae3e3;
    color: #ff0000;
    border: #ff0000 1px solid;
  }
  .btn_blue {
    cursor: pointer;
    background-color: #e7f1f9;
    color: #084573;
    border: #636563 1px solid;
  }
  .tableTitle {
    background-color: #8A8C9A;
    color: white;
  }
  .pageTitleBold{
	font-weight: bold;
	font-size: 13px;
}
  </style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" height='100%'>
	<tr>
		<td valign='top'>

		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <!-- <td width='145' align='center' valign="top" style='font-size:14px;'>
				<-? // left ?>	
				<-? include "../inc/sm_calculate.php";?>
				</td> -->
                <td width="1" height="400" valign="top" background="../img/nor/sb.gif"></td>
                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top" style='padding:10px;'>
					
					
					<table width="1000" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto">
                      <tr>
                        <td align="center" valign="top">

<form name="cform" method=post action="/comm/comexc.php" target="HiddenFrm" style="margin:0px;" onSubmit="document.cform.target='';document.cform.action='';">
<input type=hidden name=mode value=reg>
<input type=hidden name="page" value=<?=$page?>>
                          <!-- 타이틀 -->
                        <table width="1000" style="margin: 0px auto">
                            <tr  >
                            <td width="20%" height="42" valign="top" colspan="4" border="0"><img src="/manage/img/icon02.gif"> 위치 : <span class="pageTitleBold"> 업체관리 </span>  </td>
                             </tr>
                            </table>
                          <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#626262" frame="border or box " style="border-collapse:collapse; border-color:rgb(194, 194, 194);" class='pad_10'>
                       
                            <tr>
                              <td align="center" bgcolor="f3f3f3" class="p_tt" >상호</td>
                              <td height="30" align="center" bgcolor="f3f3f3" class="p_tt " >전화번호</td>
                              <td height="30" align="center"  bgcolor="f3f3f3"class="p_tt " >은행명</td>
                              <td width="18%" height="30" align="center"bgcolor="f3f3f3" class="p_tt " >계좌번호</td>
                              <td height="30" align="center" bgcolor="f3f3f3" class="p_tt " >예금주</td>
                              <td height="30" align="center" bgcolor="f3f3f3" class="p_tt " >관리</td>
                            </tr>


                            <tr>
                              <td width="17%" height="30" align="center"><input type="text" class="ipip" name="company"  size="12"></td>
                              <td width="23%" height="30" align="center">
                        <input type="text" class="ipip" name="phone1" size="4" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone2" size="4" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone3" size="4" maxlength="4"></td>
                              <td width="12%" height="30" align="center"><input type="text" class="ipip" name="bankname" size="9"></td>
                              <td height="30" align="center"><input type="text" class="ipip" name="banknum"  size="15"></td>
                              <td width="18%" height="30" align="center"><input type="text" class="ipip" name="bname"  size="15"></td>
                              <td width="12%" height="30" align="center"><input type="button" id="button2" value="등록" class='btn_pink' onClick="document.cform.submit();" /></td>
                            </tr>
                          </table>
                            <br>
                            <table width="100%">
                              <tr>
                                <td height="6"></td>
                              </tr>
                            </table>
                          <table width="100%" border="0" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;">
                              <tr>
                                <td height="30" align="right"  class="p_tt"><input type="text" name="search" class="ipip" size="40" value="<?=$search?>">
                                  &nbsp;
                                  <!-- <input type="button" id="button1" value="검색" onClick="document.location.href='/admin/comp.php?page=<?=$page?>&search=' + document.cform.search.value" style='width:50px;cursor:hand'/ > -->
								  <input type="submit" value="검색"  class="btn_blue"/></td>
                              </tr>
                            </table>




                          <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#626262" frame="border or box " style="border-collapse:collapse;  border-color:rgb(194, 194, 194);" class='pad_10'>
                              <tr>
                                <td height="30" align="center" bgcolor="f3f3f3" class="p_tt ">NO</td>
                                <td align="center" bgcolor="f3f3f3" class="p_tt ">상호</td>
                                <td height="30" align="center" bgcolor="f3f3f3" class="p_tt ">전화번호</td>
                                <td height="30" align="center" bgcolor="f3f3f3" class="p_tt ">은행정보</td>
                                <td height="30" align="center" bgcolor="f3f3f3" class="p_tt ">관리</td>
                              </tr>

<?
	$view_article = 12; // 한화면에 나타날 게시물의 총 개수  
	if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
	$start = ($page-1)*$view_article; 

	$where = " 1  ";
	if($search) $where .= " and company like '%".$search."%' or phone like '%".$search."%' or bankname like '%".$search."%' or banknum like '%".$search."%' or bname like '%".$search."%' ";

	$query = "select count(idx) from admcom WHERE $where ";  
	//echo $query;
	$result = mysql_query($query, $connect);  
	$temp = mysql_fetch_row($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함

											$sql="select * from admcom WHERE $where order by idx LIMIT $start, $view_article ";
											//echo $sql;
											$result=mysql_query($sql);
											$i=1;
											while ($data = mysql_fetch_assoc($result)){	
										$phone = explode("-",$data[phone]);
							?>
                              <tr>
                                <td width="3%" height="30" align="center"><?=$total_article-$i+1-(($page-1)*$view_article)?></td>
                                <td width="15%" height="30" align="center"><input type="text" class="ipip" name="company<?=$i?>" value="<?=$data[company]?>"  size="12"></td>
                                <td width="20%" height="30" align="center">  <input type="text" class="ipip" name="phone1<?=$i?>" value="<?=$phone[0]?>" size="3" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone2<?=$i?>" value="<?=$phone[1]?>" size="3" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone3<?=$i?>" value="<?=$phone[2]?>" size="3" maxlength="4"></td>
                                <td width="40%" height="30" align="center"><input type="text" class="ipip" name="bankname<?=$i?>" value="<?=$data[bankname]?>" size="9"> / <input type="text" class="ipip" name="banknum<?=$i?>" value="<?=$data[banknum]?>" size="13"> / <input type="text" class="ipip" name="bname<?=$i?>" value="<?=$data[bname]?>" size="13"> </td>
                                <td width="14%" height="30" align="center">
								<span onClick="subreg('/comm/comexc.php?mode=mod&idx=<?=$data[idx]?>&company='+ document.cform.company<?=$i?>.value + '&phone1=' + document.cform.phone1<?=$i?>.value + '&phone2=' +  document.cform.phone2<?=$i?>.value + '&phone3=' + document.cform.phone3<?=$i?>.value+ '&bankname=' + document.cform.bankname<?=$i?>.value+ '&banknum=' + document.cform.banknum<?=$i?>.value+ '&bname=' + document.cform.bname<?=$i?>.value);" style="cursor:hand">수정</span>
                                     / 
                                        <span onClick="document.HiddenFrm.location.href='/comm/comexc.php?mode=del&idx=<?=$data[idx]?>'" style="cursor:hand">삭제</span>
								</td>
                              </tr>
<?$i++;}?>



                            </table>


</form>



                          <!-- <table width="100%" border="0" cellpadding="3" cellspacing="0"  style="border-collapse:collapse;">
                              <tr>
                                <td><HR color="#999999" width="100%"></td>
                              </tr>
                            </table>
                          <table border="0" cellpadding="5" cellspacing="0" align='center' style='margin-top:10px;'> -->
                            <tr>
                              <td><?=Normal_Page("/admin/comp.php?")?></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>                    
                  </td>
                  </tr>
                </table></td>
              </tr>
              <!-- <tr>
                <td bgcolor='dddddd' height='1' colspan='3'></td>
              </tr> -->
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
</html>
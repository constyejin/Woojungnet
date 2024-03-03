
<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
	$pno=4;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='stylesheet' href='/common/css/adm_style.css' type='text/css'> 
<link rel='stylesheet' href='/common/css/admin_style.css' type='text/css'>

<style>
  .btn-gray {
  cursor: pointer;
  background-color: #ffffff;
  border: 1px #636563 solid;
  font-weight: bold;
}
.btn-pink {
  cursor: pointer;
background-color: #fae3e3;
color: #ff0000;
border: #ff0000 1px solid;

}
.pageTitleBold{
	font-weight: bold;
	font-size: 13px;
}

  </style>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
</head>
<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" box-size="border-box">
						
<form name="cform" method=post action="/comm/setexc.php" target="HiddenFrm" style="margin:0px;" onSubmit="return false;">
<td height="25" align="right"  class="p_tt">
  <!-- <input type="text" name="search" class="ipip" size="40" value="<?=$search?>"> -->
		                <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                          <tr>
                            <!--td width='145' align='center' valign="top" style='font-size:14px;'><? include "$DOCUMENT_ROOT/inc/sm_set01.php";?></td-->
                            <!-- <td width="1" height="400" valign="top"><img src="../img/nor/sb.gif" width="1" /></td> -->
                            <td valign="top" style='padding:10px;'>
                            <!-- 타이틀 아이콘 -->
                            <table width="1000" style="margin: 0px auto" >
                            <tr  >
                            <td width="20%" height="42" valign="top" colspan="4" border="0"><img src="/manage/img/icon02.gif"> 위치 : <span class="pageTitleBold"> 계좌관리 </span> </td>
                             </tr>
                            </table>
                            <!-- 본문 테이블 -->
                            <table width="1000" border="1" bordercolor="#626262" cellpadding="0" cellspacing="0"  frame="border or box " 
                            style="border-collapse:collapse; margin:0px auto; border-color:rgb(194, 194, 194);">
                              <tr class="table-th" height=30>
                                <td width="28%"  bgcolor="f3f3f3"class="p_tt" align="center" >은 행 명</td>
                                <td width="28%" align="center"  bgcolor="f3f3f3" class="p_tt" >계좌번호</td>
                                <td width="28%" align="center"  bgcolor="f3f3f3" class="p_tt" >예 금 주</td>
                                <td align="center"  bgcolor="f3f3f3" class="p_tt">관리</td>
                              </tr>
                              <tr height=30>
                                <td align="center" bgcolor="f3f3f3"><input name="bankname" type="text" size=30></td>
                                <td align="center" bgcolor="f3f3f3">
                                  <input name="bname" type="text"  size=30>
                                </td>
                                <td align="center" bgcolor="f3f3f3"><input name="banknum" type="text"  size=30></td>
                                <td align="center" bgcolor="f3f3f3"><input type="button" value="추가하기" class="btn-pink" onClick="document.cform.submit();"></td>
                              </tr>
							  <?
											$sql="select * from admbank order by idx";
											$result=mysql_query($sql);
											$i=1;
											while ($data = mysql_fetch_assoc($result)){	
										
							?>
                              <tr >
                                <td align="center" ><input type="text" class="ipip" name="bankname<?=$i?>" value="<?=$data[bankname]?>" size=30></td>
                                <td align="center"><input type="text" class="ipip" name="bname<?=$i?>" value="<?=$data[bname]?>" size=30></td>
                                <td align="center"><input type="text" class="ipip" name="banknum<?=$i?>" value="<?=$data[banknum]?>" size=30></td>
                                <td align="center"><input type="button" value="수정" class="btn-pink" onClick="subreg('/comm/setexc.php?mode=bmod&idx=<?=$data[idx]?>&bankname=' + document.cform.bankname<?=$i?>.value+ '&banknum=' + document.cform.banknum<?=$i?>.value+ '&bname=' + document.cform.bname<?=$i?>.value);" style="cursor:hand">
                                <input type="button" value="삭제" class="btn-gray" onClick="document.HiddenFrm.location.href='/comm/setexc.php?mode=bdel&idx=<?=$data[idx]?>'" style="cursor:hand"></td>
                              </tr>
                             <?$i++;}?>
                             <!-- 샘플 -->
                             <tr height=30>
                                <td align="center" ><input type="text" class="ipip" name="bankname" value="농협" size=30></td>
                                <td align="center"><input type="text" class="ipip" name="banknum<?=$i?>" value="123-456-789" size=30></td>
                                <td align="center"><input type="text" class="ipip" name="bname<?=$i?>" value="무통장입금" size=30></td>
                                <td align="center"><input type="button" value="수정" class="btn-pink" onClick="subreg('/comm/setexc.php?mode=bmod&idx=<?=$data[idx]?>&bankname=' + document.cform.bankname<?=$i?>.value+ '&banknum=' + document.cform.banknum<?=$i?>.value+ '&bname=' + document.cform.bname<?=$i?>.value);" style="cursor:hand">
                                <input type="button" value="삭제" class="btn-gray" onClick="document.HiddenFrm.location.href='/comm/setexc.php?mode=bdel&idx=<?=$data[idx]?>'" style="cursor:hand"></td>
                              </tr>
                              <tr height=30>
                                <td align="center" ><input type="text" class="ipip" name="bankname" value="농협" size=30></td>
                                <td align="center"><input type="text" class="ipip" name="banknum<?=$i?>" value="123-456-789" size=30></td>
                                <td align="center"><input type="text" class="ipip" name="bname<?=$i?>" value="무통장입금" size=30></td>
                                <td align="center">
                                <input type="button" value="수정" class="btn-pink" onClick="subreg('/comm/setexc.php?mode=bmod&idx=<?=$data[idx]?>&bankname=' + document.cform.bankname<?=$i?>.value+ '&banknum=' + document.cform.banknum<?=$i?>.value+ '&bname=' + document.cform.bname<?=$i?>.value);" style="cursor:hand">
                                <input type="button" value="삭제" class="btn-gray" onClick="document.HiddenFrm.location.href='/comm/setexc.php?mode=bdel&idx=<?=$data[idx]?>'" style="cursor:hand">
                                </td>
                              </tr>
                            <!-- 샘플끝 -->
                            </table>
                            </tr>
                          <!-- <tr>
                            <td bgcolor='dddddd' height='1' colspan='3'></td>
                          </tr> -->
                        </table>
	</form>
      </td>
	</tr>
              <!-- <tr>
                <td bgcolor='dddddd' height='1' colspan='3'></td>
              </tr> -->
            </table>
	      <!--/�ΰ� & ž�޴�-->		
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
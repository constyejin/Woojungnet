<? 
include_once "../inc/header.php"; 
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
	
include $_SERVER['DOCUMENT_ROOT'].'/lib/phpfun.class.php';
$phpfun = new phpfun();
	
$href = "page=$page&gubun1=$gubun1&gubun2=$gubun2&gubun3=$gubun3&gubun4=$gubun4&admidx=$admidx&searchKey=$searchKey"; 
$href .= "&start_date=$start_date&end_date=$end_date";
?>

<script type="text/javascript" src="../common/js/form.js"></script>

<?
if($loginId){
	$row = mysql_fetch_array(mysql_query("SELECT * FROM woojung_member WHERE userId='$loginId'"));
	$com = Row_string("SELECT * FROM recruit WHERE code  = '$row[code]'");
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
  
<script language="javascript">

function out_submit(){

	f=document.outForm;

	return true;
}

</script>
<script language="JavaScript" type="text/javascript" src="/nfupload/NFUpload/nfupload.js?d=20081028"></script>

<form name="outForm" method="post" action="Sale01_save.php" enctype="multipart/form-data" onsubmit='return out_submit();'>
<input type="hidden" name="mode" value="regist">
<input type="hidden" name="wc_idx" value="<?=$wc_idx?>">
<input type="hidden" name="wc_go_idx" value="">
<input type="hidden" name="aucidx" value="<?=$aucidx?>">
<input type="hidden" name="aucorderNo" value="<?=$aucNo?>">
<input type="hidden" name="href" value="<?=$href?>">
<input type="hidden" name="hidFileName"/>

<table width="970" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><table width="900" border="0" cellspacing="0" cellpadding="0"><tr>
      <td align="center"><table width="900" border="0" cellspacing="0" cellpadding="0">
       <tr>
  <td height="20" align="left" style="color:#333399"> <font size="-4"> <img src="/manage/img/icon02.gif"></font>위치 :    차량등록</td></tr>
<tr><td  height="1" bgcolor="#333399"> </td></tr>
<tr><td  height="20"> </td></tr>

        <tr> 
          <td height="40" align="center"><input type="submit" name="image" value="등록하기" class="button33"  style="cursor:pointer; background-color:#fae3e3; color:#ff0000; border:#ff0000 1px solid; padding:3 3 3 3; height:23px; "> </td>
          </tr>
      </table>
	  
	  
	  </td>
  </tr>
  <tr> 
    <td align="center">
	<table width="900" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td> 
              <!-- 진행구분 -->
              <? include_once "$dir/manage/inc/table01_modify.php";?>
            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td>
              <!-- 출품자정보 -->
              <? include_once "$dir/manage/inc/table02_modify.php";?>
            </td>
          </tr>
          <tr> 
            <td><table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center"><input type="submit" name="image" value="등록하기" class="button33"  style="cursor:pointer; background-color:#fae3e3; color:#ff0000; border:#ff0000 1px solid; padding:5 3 3 3;height:23px;" ></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
  </tr>
  <tr align="center"> 
    <td width="150" align="center">&nbsp;</td>

  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>

  	</form>

</table>
<? include_once "../inc/footer.php";?>

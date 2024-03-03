<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';

if( $MemName && $mode == "Ins" ){

	$wam=$wamobile1."-".$wamobile2."-".$wamobile3;

	$SQL = "insert into woojung_admin (waname,wamobile,orderval) values ('".$MemName."','$wam','$orderval') ";
	$rIns = mysql_query($SQL);
	if($rIns){
		MsgMov("등록되었습니다.","$PHP_SELF");
	}

}

if( $MemName && $mode == "edit" && $aidx){

	$wam=$wamobile1."-".$wamobile2."-".$wamobile3;

	$SQL1 = "update woojung_admin set  waname  = '".$MemName."', wamobile='$wam' , orderval='$orderval' where waidx=".$aidx." ";
	$rIns1 = mysql_query($SQL1);
	if($rIns1){
		MsgMov("수정되었습니다.","$PHP_SELF");
	}
}

if(  $mode == "del" && $idx){

	$SQL1 = "delete from woojung_admin  where waidx=".$idx." ";
	$rIns1 = mysql_query($SQL1);
	if($rIns1){
		MsgMov("삭제되었습니다.","$PHP_SELF?");
	}
}

if($aidx){
	$mode = "edit";
	$data=mysql_fetch_array(mysql_query("select * from woojung_admin where waidx='$aidx' "));
	$wamobile=explode("-",$data[wamobile]);
}else{
	$mode = "Ins";
}

?>

<script>
function DelName(idx){
	f=document.frmMem;
	if(confirm("삭제하시겠습니까?")){
		f.mode.value="del";
		f.idx.value=idx;
		f.submit();
	}
}
</script>


<table width="970" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td colspan="2">
      <table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="20" align="left" style="color:#333399"> <font size="-4"> ▶ </font>위치 : 담당자입력 &gt;담당자리스트</td>
        </tr>
        <tr> 
          <td width="602" height="1" colspan="2" bgcolor="#333399"></td>
        </tr>
        <tr> 
          <td height="20">&nbsp;</td>
        </tr>  
        <tr> 
          <td width="900" align="left" class="title">
            <table border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td><img src="/manage/img/icon02.gif" class="bullet"/></td>
              <td><strong>담당자입력</strong></td>
              </tr>
          </table></td>
        </tr>
        <tr> 
          <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="dadada" style="padding:0 0 0 0">
              <tr bgcolor="f6f6f6"> 
                <td width="36%" height="30" align="center" class="table-th">담당자등록</td>
                <td width="64%" align="center" class="table-th">내부담당자 목록</td>
              </tr>
              <tr> 
			  <form name="frmMem" method="post" >

          <input type="hidden" name="mode" id="mode" value="<?=$mode?>" > 
          <input type="hidden" name="aidx" id="aidx" value="<?=$aidx?>" >
          <input type="hidden" name="idx" id="idx" value="" >

                <td width="36%" height="30" align="center" valign="top" bgcolor="#FFFFFF">&nbsp; 
                  <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td><table border="0" cellspacing="0" cellpadding="2">
                          <tr>
                            <td width="55">정렬 : </td>
                            <td align="left"><input name="orderval" type="text" value="<?=$data[orderval]?>" size="2" /></td>
                          </tr>  
                        </table>
                        </td>
                    </tr>
                    <tr>
                      <td><table border="0" cellspacing="0" cellpadding="2"> 
                          <tr>
                            <td width="55">이름 : </td>
                            <td align="right"><input name="MemName" type="text" value="<?=$data[waname]?>" /></td>
                          </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                      <td><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td>휴대전화 : </td>
                          <td><input name="wamobile1" type="text" size="4" value="<?=$wamobile[0]?>"/></td>
                          <td>-</td>
                          <td><input name="wamobile2" type="text" size="4" value="<?=$wamobile[1]?>"/></td>
                          <td>-</td>
                          <td><input name="wamobile3" type="text" size="4" value="<?=$wamobile[2]?>"/></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td align="center"><input type="submit" value="등록하기" class="button44 btn-red-sm"/></td>
                    </tr>
                  </table><br />
                  </td>
              </form> 

                <td bgcolor="#FFFFFF" style="padding:5 10 5 10">
                  <?
	    $qry = "SELECT * FROM woojung_admin order by orderval asc  , waidx asc ";
  		$arr = Fetch_string($qry);

		for($i=0;$i<count($arr);$i++){	
?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Tableline">
                    <tr> 
                      <td height="30" style="padding:5 10 5 10"><table border="0" cellspacing="0" cellpadding="2">
                       <tr>
                         <td width="100">
						   <?=$arr[$i][orderval]?>
	                       
                           <?=$arr[$i][waname]?></td>
                         <td width="10">:</td>
                         <td><?=$arr[$i][wamobile]?></td>
                       </tr>
                     </table></td>
                      <td width="120" style="padding:5 0 5 10"><a href="Setup3.php?aidx=<?=$arr[$i][waidx]?>">수정</a> /
                       <a href="javascript:DelName('<?=$arr[$i][waidx]?>')">삭제</a> 
                      </td>
                    </tr>
                  </table>
                  <?
		}	

?>
                </td>
              </tr>
</form>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>
</table>

<? include_once "../inc/footer.php";?>

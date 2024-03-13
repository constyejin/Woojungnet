<? 	
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
	
	$Qry = mysql_query("SELECT * FROM woojung_car_q where wc_idx='".$wc_idx."'");
	$row = mysql_fetch_array($Qry);
?>
<script>
	function funcdel(idx){
		location.href='proc.php?wc_idx='+idx+'&mode=delete';
	}
</script>
<table width="900" border="0" cellspacing="0" cellpadding="0">
   <tr>
  <td height="20" colspan="2" align="left" style="color:#333399"> <font size="-4"> ▶ </font>위치 :    차량상담</td></tr>
<tr><td  height="1" bgcolor="#333399" colspan="2"> </td></tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="900" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" >
              <col width=10%>
              </col>
              
              <col width=35%>
              </col>
              
              <col width=10%>
              </col>
              
              <col width=35%>
              </col>
              
              <tr>
                <td width="100" height="23" align="center" bgcolor="f6f6f6" ><strong>상담유형</strong></td>
                <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10">&nbsp;<?=$row[calltype]?></td>
              </tr>
              <tr>
                <td width="100" height="23" align="center" bgcolor="f6f6f6" ><strong>이 름</strong></td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10">&nbsp;<?=$row[wc_mem_name]?></td>
                <td width="100" align="center" bgcolor="f6f6f6" class="tab_bg"><strong>작 성 일</strong></td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10">&nbsp;<?=$row[wc_regdate]?></td>
              </tr>
              <tr>
                <td height="23" align="center" bgcolor="f6f6f6" class="tab_bg"><strong>연 락 처</strong></td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10">&nbsp;<?=$row[wc_mem_phone]?></td>
                <td align="center" bgcolor="f6f6f6" class="tab_bg"><strong>이 메 일</strong></td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10">&nbsp;<?=$row[wc_mem_etc]?></td>
              </tr>
			  <tr>
                <td height="23" align="center" bgcolor="f6f6f6" class="tab_bg"><strong>차량번호</strong></td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10">&nbsp;<?=$row[wc_model]?></td>
                <td align="center" bgcolor="f6f6f6" class="tab_bg"><strong>보관지역</strong></td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10">&nbsp;<?=$row[wc_model2]?></td>
              </tr>
              <tr>
                <td align="center" bgcolor="f6f6f6" class="tab_bg"><strong>메 모</strong></td>
                <td height=100 colspan=3 align="left" valign=top bgcolor="#FFFFFF" style="padding:5 5 5 5;">&nbsp;<?=nl2br($row[wc_memo])?></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center"><br>
            <table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td><input type="button" value="목록보기" class="button44 btn-blue" onclick="location.href='Scrap_app_list.php'" ></td>
                <!-- <td><input type="button" value="삭제하기" class="button33" onclick="funcdel('<?=$row[wc_idx]?>')" style="cursor:pointer; background-color:#FFFFFF; color:#ff0000; border:#636563 1px solid; padding:5 3 3 3; font-weight:bold"></td> -->
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<? include_once "../inc/footer.php";?>

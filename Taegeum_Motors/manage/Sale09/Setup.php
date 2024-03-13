<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
//DB명 세팅

$tr_height=30;
$data=mysql_fetch_array(mysql_query("select * from js_webconfig where no=1"));
$bankno=explode("/" , $data[bankno]);
?>
<form method="post" name="myform" action="Setup_save.php">
<table width="970" border="0" cellspacing="0" cellpadding="0">

 <tr>
  <td>
    <table width="900" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td height="20" align="left" style="color:#333399"> <font size="-4"> ▶ </font>위치 : 환경설정 &gt;기본설정</td>
      </tr>
      <tr> 
        <td width="602" height="1" colspan="2" bgcolor="#333399"></td>
      </tr>
      <tr> 
      <td height="20">&nbsp;</td>
      </tr>  
      <tr> 
        <td align="left" class="title"><img src="/manage/img/icon02.gif" class="bullet" /> <strong>기본설정</strong></td>
      </tr>
    </table>
  </td>
 </tr>

  <tr> 
    <td colspan="2">
      <table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="#C2C2C2" style="padding:0 0 0 0" class="table-style">
      <colgroup>
        <col style="width: 100px;" />
        <col style="width: 200px;" />
        <col style="width: 100px;" />
        <col style="width: 200px;" />
      </colgroup>
      <tr>
        <td class="table-th" bgcolor="f6f6f6" >사이트명</td>
        <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="shop_name" value="<?=$data[shop_name]?>" style='width:95%;' /></td>
        <td class="table-th" bgcolor="f6f6f6" >URL</td>
        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="homeurl" style='width:95%;' value="<?=$data[homeurl]?>" /></td>
      </tr>
      <tr>
        <td class="table-th" bgcolor="f6f6f6" >사업자명</td>
        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="shop_cname" style='width:95%;' value="<?=$data[shop_cname]?>" /></td>
        <td class="table-th" bgcolor="f6f6f6" >대표자</td>
        <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="owner_name" value="<?=$data[owner_name]?>" style='width:95%;' /></td>
      </tr>
      <tr>
        <td class="table-th" bgcolor="f6f6f6" >사업자번호</td>
        <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="office_num" value="<?=$data[office_num]?>" style='width:95%;' />        </td>
        <td class="table-th" bgcolor="f6f6f6" >개인정보관리자</td>
        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="webmaster" value="<?=$data[webmaster]?>" style='width:95%;' /></td>
      </tr>
      <tr>
        <td class="table-th" bgcolor="f6f6f6" >회사번호</td>
        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="com_num" value="<?=$data[com_num]?>" style='width:95%;' /></td>
        <td class="table-th" align="center" bgcolor="f6f6f6" >팩스번호</td>
        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="fax_num" value="<?=$data[fax_num]?>" style='width:95%;' /></td>
      </tr>
      <tr>
        <td class="table-th" bgcolor="f6f6f6" >관리자이메일</td>
        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="admin_email" value="<?=$data[admin_email]?>" style='width:95%;' /></td>
        <td class="table-th" align="center" bgcolor="f6f6f6" >문자키</td>
        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="shop_onlineno" style='width:95%;' value="<?=$data[shop_onlineno]?>" /></td>
      </tr>
      <tr>
        <td class="table-th" bgcolor="f6f6f6" >문자아이디</td>
        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="sms_id" value="<?=$data[sms_id]?>" style='width:95%;' /></td>
        <td class="table-th" align="center" bgcolor="f6f6f6" >문자비번</td>
        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="sms_pass" style='width:95%;' value="<?=$data[sms_pass]?>" /></td>
      </tr>
      <tr>
        <td class="table-th" bgcolor="f6f6f6" >회사주소</td>
        <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="address" size="80" value="<?=$data[address]?>" style='width:95%;' /></td>
      </tr>
      <tr>
        <td class="table-th" bgcolor="f6f6f6" >입금번호</td>
        <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">은행
          <input name="bankno1" type="text"  value="<?=$bankno[0]?>" size="15" />
          계좌번호
          <input name="bankno2" type="text"  value="<?=$bankno[1]?>" size="15" />
          예금주
          <input name="bankno3" type="text"  value="<?=$bankno[2]?>" size="30" /></td>
      </tr>
      <tr>
        <td class="table-th" bgcolor="f6f6f6" >관리자전용IP</td>
        <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name="admin_ip" style='width:20%;' value="<?=$data[admin_ip]?>"/>
          <font color="#0033FF">관리자는 등록된 IP가 아니면 접속이 되지 않습니다</font><br>
      </tr>
    </table></td>
  </tr>
  <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>


  <tr>
    <td height="20" align="left" class="title"><img src="/manage/img/icon02.gif" class="bullet" />  <strong>기본수수료</strong></td>
  </tr>
  <tr>
    <td colspan="2" >
      <table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="#C2C2C2" style="padding:0 0 0 0" class="table-style">
            <colgroup>
              <col style="width: 100px;" />
              <col style="width: 200px;" />
              <col style="width: 100px;" />
              <col style="width: 200px;" />
            </colgroup>
              <tr>
                <td class="table-th" bgcolor="f6f6f6" >구분</td>
                <td class="table-th" bgcolor="f6f6f6" style="padding-left:10px;" >기준</td>
                <td class="table-th" bgcolor="f6f6f6" >내용</td>
                <td class="table-th" bgcolor="f6f6f6" style="padding-left:10px;" >수수료 또는 금액</td>
              </tr>
              <tr>
                <td class="table-th" bgcolor="f6f6f6" >최저수수료</td>
                <td width="284" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">&nbsp;</td>
                <td class="table-th" bgcolor="f6f6f6" >최저수수료</td>
                <td width="275" align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><input type="text" name='charge01' style='width:100;' value="<?=number_format($data[charge01])?>" onKeyup="javascript:calculation5(charge01);" />
                  <strong>원</strong></td>
              </tr>
              <tr>
                <td class="table-th" bgcolor="f6f6f6" >손상차량</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><strong>낙찰금액 0 ~ 999,000원</strong></td>
                <td class="table-th" bgcolor="f6f6f6" >낙찰수수료</td>
                <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><input type="text" name='charge02' style='width:100;' value="<?=$data[charge02]?>" onKeyup="javascript:calculation5(charge02);" />
                  <strong>%</strong></td>
              </tr>
              <tr>
                <td class="table-th" bgcolor="f6f6f6" >손상차량</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><strong>낙찰금액 1,000,000 ~ 9,999,999원</strong></td>
                <td class="table-th" bgcolor="f6f6f6" >낙찰수수료</td>
                <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><input type="text" name='charge03' style='width:100;' value="<?=$data[charge03]?>" onKeyup="javascript:calculation5(charge03);" />
                  <strong>%</strong></td>
              </tr>
              <tr>
                <td class="table-th" bgcolor="f6f6f6" >손상차량</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><strong>낙찰금액 10,000,000 ~ 29,999,999원</strong></td>
                <td class="table-th" bgcolor="f6f6f6" >낙찰수수료</td>
                <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><input type="text" name='charge04' style='width:100;' value="<?=$data[charge04]?>"  onKeyup="javascript:calculation5(charge04);"/>
                  <strong>%</strong></td>
              </tr>
              <tr>
                <td class="table-th" bgcolor="f6f6f6" >손상차량</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><strong>낙찰금액 30,000,000<strong>원</strong> ~</strong></td>
                <td class="table-th" bgcolor="f6f6f6" >낙찰수수료</td>
                <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><input type="text" name='charge05' style='width:100;' value="<?=$data[charge05]?>" onKeyup="javascript:calculation5(charge05);" />
                  <strong>%</strong></td>
              </tr>
              <tr>
                <td class="table-th" bgcolor="f6f6f6" >도난 회수차량</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">&nbsp;</td>
                <td class="table-th" bgcolor="f6f6f6" >낙찰수수료</td>
                <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><input type="text" name='charge06' style='width:100;' value="<?=$data[charge06]?>" onKeyup="javascript:calculation5(charge06);" />
                  <strong>%</strong></td>
              </tr>
              <tr>
                <td class="table-th" bgcolor="f6f6f6" >최고수수료</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">&nbsp;</td>
                <td class="table-th" bgcolor="f6f6f6" >최고수수료</td>
                <td align="left" bgcolor="#FFFFFF"  style="padding-left:10px;"><input type="text" name='charge07' style='width:100;' value="<?=number_format($data[charge07])?>" onKeyup="javascript:calculation5(charge07);" />
                  <strong>원</strong></td>
              </tr>

          </table></td>
        </tr>
    </table></td>
  </tr>
  
  
  <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="left" class="title"><img src="/manage/img/icon02.gif" class="bullet" /> <strong>상사이전비기준표 / 입찰금액에 따라 적용되며 명의이전 만 적용</strong></td>
  </tr>
 
  <tr>
    <td colspan="2">
      <table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="#C2C2C2" style="padding:0 0 0 0" class="table-style">
              <colgroup>
                <col style="width: 100px;" />
                <col style="width: 200px;" />
                <col style="width: 100px;" />
                <col style="width: 200px;" />
              </colgroup>
              <tr> 
                <td class="table-th" bgcolor="f6f6f6" >1</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">10,000~4,999,999원</td>
                <td class="table-th" bgcolor="f6f6f6" >상사이전비</td>
                <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name='sang1' style='width:100;' value="<?=number_format($data[sang1])?>" onKeyup="javascript:calculation5(sang1);"/>
                  <strong>원</strong></td>
              </tr>
              <tr> 
                <td class="table-th" bgcolor="f6f6f6" >2</td>
                <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">5,000,000~9,999,999원</td>
                <td class="table-th" bgcolor="f6f6f6" >상사이전비</td>
                <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name='sang2' style='width:100;' value="<?=number_format($data[sang2])?>"  onKeyup="javascript:calculation5(sang2);"/>
                  <strong>원</strong></td>
              </tr>
              
                 <tr> 
                <td class="table-th" bgcolor="f6f6f6" >3</td>
                <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">10,000,000~19,999,999원</td>
                <td class="table-th" bgcolor="f6f6f6" >상사이전비</td>
                <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name='sang3' style='width:100;' value="<?=number_format($data[sang3])?>"  onKeyup="javascript:calculation5(sang3);"/>
                  <strong>원</strong></td>
              </tr>
                 <tr> 
                <td class="table-th" bgcolor="f6f6f6" >4</td>
                <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">20,000,000~29,999,999원</td>
                <td class="table-th" bgcolor="f6f6f6" >상사이전비</td>
                <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name='sang4' style='width:100;' value="<?=number_format($data[sang4])?>"  onKeyup="javascript:calculation5(sang4);" />
                  <strong>원</strong></td>
              </tr>
                 <tr> 
                <td class="table-th" bgcolor="f6f6f6" >5</td>
                <td width="280" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">30,000,000원~</td>
                <td class="table-th" bgcolor="f6f6f6" >상사이전비</td>
                <td width="275" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" name='sang5' style='width:100;' value="<?=number_format($data[sang5])?>"  onKeyup="javascript:calculation5(sang5);"/>
                  <strong>원</strong></td>
              </tr>
              
              
            </table></td>
        </tr>

		<tr>
			<td height="50" class="title"><img src="/manage/img/icon02.gif" class="bullet" />  <strong>페차서류대행비</strong> <span style="padding-left:10px;">
			<input type="text" name='charge08' style='width:10%;' value="<?=number_format($data[charge08])?>"/>
			원 <font color="#FF0000">(폐차로 입찰시만 적용됩니다)</font></span></td>
		</tr>
<? if($_SESSION["login_id"]=="drg1038"){ ?>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><span class="title"><img src="/manage/img/icon02.gif" class="bullet" /> <strong>문자인증</strong> &nbsp;&nbsp;<input type="radio" name="sms_certify" value="Y" <? if($data[sms_certify]=="Y") echo "checked"; ?>>적용 &nbsp;&nbsp;<input type="radio" name="sms_certify" value="N" <? if($data[sms_certify]=="N") echo "checked"; ?>>미적용</span></td>
        </tr>
<? } ?>

      </table></td>
  </tr>

  
  <tr> 
    <td height="40" colspan="2" align="center"> <input type="submit" value="수정하기" class="button44 btn-red-sm"> &nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>
<? include_once "../inc/footer.php";?>

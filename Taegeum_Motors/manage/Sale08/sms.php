<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';

if (!$connect) $connect=dbconn();
//if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("잘못된 접근입니다.");
$a_board=rfile("skin/admin_board.htm");
$tmp_board=explode("[loop]",$a_board);
$a_board=$tmp_board[0];


$data=mysql_fetch_array(mysql_query("select * from sms where idx=1"));

?>
<style type="text/css">
.style1 {color: #990066}
</style>


<table width="970" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td>
     <table width="900" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td>
            <table width="900" border="0" cellpadding="0" cellspacing="0">    
              <tr>
                <td height="20" align="left" style="color:#333399"> <font size="-4"> ▶ </font>위치 : 자동(SMS)문자/ 자동으로 문자가 전송됩니다</td>
              </tr>
              <tr> 
                <td height="1" colspan="2" bgcolor="#333399"></td>
              </tr>
              <tr> 
                <td height="20">&nbsp;</td>
              </tr>
            </table>
          </td> 
        </tr>
      </table>
    </td>
  </tr>

	<tr>
		<td valign='top' align="center">
			
			<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td align="left" valign="top">
            <table width="900" border="0" cellspacing="0" cellpadding="0">
					 
					  <tr>
					    <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <form action="sms_ok.php" method="post" name="myform" id="myform">
                            <tr>
                              <td height="13" align="left"><p><strong>문자서비스는 문자천국에 항상 잔고가 있는지 여부를 확인하십시요.</strong> (문자천국:<a href="https://www.skysms.co.kr" target="_blank">www.skysms.co.kr</a>)</p>
<p>발송자：
                                      <input type='text' name='number' value='<?=$data[number]?>' />
                                    (&quot;-&quot;빼고 입력하세요) </p>
<p><strong>1.<span class="style1">낙찰자에게 문자발송(낙찰정산서에서 발급하기 누르면 발송됨)</span>/ (낙찰자)님/(차량번호/차량명)의 낙찰자로 결정</strong>
  <textarea name='auto1' cols='100' row='30' style='height:50px' ><?=$data[auto1]?></textarea>
                                </p>
                                <p><strong>2.<span class="style1">입금완료시 자동문자</span>/ (낙찰자)님/(차량번호/차량명)의 입금완료</strong>
                                  <textarea name='auto2' cols='100' row='30' style='height:50px'><?=$data[auto2]?></textarea>
                                </p>
                                <p><strong>3.<span class="style1">무통장입금안내 문자</span>/ 입금통장안내/ (은행명):(계좌번호)/(예금주)</strong>
                                    <textarea name='auto3' cols='100' row='30' style='height:50px'><?=$data[auto3]?></textarea>
								</p>
                                <p><strong>4.<span class="style1">아이디찾기 시 문자 전송부분</span></strong>
                                    <textarea name='auto5' cols='100' row='30' style='height:50px'><?=$data[auto5]?></textarea>
								</p>
                                <p><strong>5.<span class="style1">회원가입</span></strong>
                                    <textarea name='auto4' cols='100' row='30' style='height:50px'><?=$data[auto4]?></textarea>
								</p>
                                  <p>
                                </p>
                                </p>
                              </td>
                            </tr>
                            
                            <tr>
                              <td align="center"><input type="submit" name="Submit222322" value="등록하기" class="button33" style="cursor:pointer; background-color:#ffecec; color:#ff0000; border:#ff0000 1px solid; padding:5 3 3 3;" /></td>
                            </tr>
                          </form>
				        </table></td>
				      </tr>
				    </table></td>
				</tr>
			</table>	
	</td>
	</tr>
</table>

<? include_once "../inc/footer.php";?>
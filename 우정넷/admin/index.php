<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";?>
<? include "$DOCUMENT_ROOT/inc/top_menu.php";?> 

<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" background="/images/main_bg.jpg"><table width="1000" border="0" cellspacing="0" cellpadding="0">
	
      <tr>
        <td><table width="1000" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><? include "$DOCUMENT_ROOT/inc/main_rolling.php";?></td>
            </tr>
          
        </table></td>
      </tr>
      <tr>
        <td height="300"><table border="0" cellspacing="0" cellpadding="0">
          <!--tr>
            <td width="678" height="193" align="right" valign="top" background="/images/main_bn.jpg"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="45"><p>&nbsp;</p>                  </td>
                <td width="50" rowspan="4">&nbsp;</td>
              </tr>
              <tr>
                <td height="50" style="font-size:13px; line-height:19px;">1�� : ns1.woojungnet.com / IP : 1.234.83.172<br />
2�� : ns2.woojungnet.com / IP : 1.234.83.172</td>
                </tr>
              <tr>
                <td height="10">&nbsp;</td>
                </tr>
              <tr>
                <td height="50" style="font-size:13px; line-height:19px;">1�� : ns1.woojungnet.co.kr / IP : 175.125.93.22<br />
2�� : ns2.woojungnet.co.kr / IP : 175.125.93.22</td>
              </tr>
            </table></td>
            <td><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="/images/main_faq.jpg" width="322" height="39" /></td>
              </tr>
              <tr>
                <td height="145" valign="top" background="/images/main_faq_bg.jpg" style="padding-left:20px; padding-top:9px"><table border="0" cellspacing="0" cellpadding="0">
<?
$sql="select * from faq where 1 ORDER by list desc,ridx asc LIMIT 0, 5 ";
$result=mysql_query($sql);
while($data=mysql_fetch_array($result)){
		$subject=cut_str(strip_tags($data[subject]),26);
?>
				  <tr>
                    <td height="24"><a href="/board/board.php?id=faq&mode=view&no=<?=$data[no]?>"><?=$subject?></a></td>
                  </tr>
<?
}
?>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr-->
      <tr>
        <td height="300">&nbsp;</td>
      </tr>
      <tr>
        <td><table width="1000" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="/images/main_pf.jpg" width="376" height="56" /></td>
            <td align="right"><a href="/sub06/"><img src="/images/more.jpg" width="100" height="42" /></a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="300">&nbsp;</td>
      </tr>
      <tr>
        <td height="300"><table width="1000" border="0" cellspacing="0" cellpadding="0">
          <tr>
<?
if($_GET[page] && $_GET[page] > 0){
    $page = $_GET[page];
}else{
    $page = 1;
}
// �� �������� ���� �� ��
$page_row = 20;
// ���ٿ� ������ ������ ��
$page_scale = 10;
$paging_str = "";

$wh=" portfolio='1' ";

$sql = "select count(*) as cnt from user where $wh ";
$total_count = sql_total($sql);
$paging_str = paging2($page, $page_row, $page_scale, $total_count,$_SERVER['PHP_SELF']."?"."sear=".$sear."&lev=$_GET[lev]&");
$from_record = ($page - 1) * $page_row;

$sql="select * from user where $wh order by op_date desc,regdate desc  limit 0,12";
$result=sql_query($sql);
$i=$page_row*($page-1);
$k=0;
while($data=mysql_fetch_array($result)){
	if($k&&$k%4==0)echo '</tr><tr>';
?>
                    <td align="center" style="border-bottom:1px solid #CCCCCC; padding-top:20px; padding-bottom:20px;">
					<table width="230" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td style="width:230px;align:left;">
							<table>
								<tr>
									<td style="border:2px solid #CCCCCC">
									<? if($data[domain]){ ?>
										<a href="http://<?=$data[domain]?>" target="_blank">
										<img src="/images/portfolio/<?=$data[p_file]?>" width="230" height="300" />
										</a>
									<? }else{ ?>
										<img src="/images/portfolio/<?=$data[p_file]?>" width="230" height="300" />
									<? } ?>
									</td>
								</tr>
								<tr>
									<td align="center">
									<? if($data[domain]){ ?>
										<a href="http://<?=$data[domain]?>" target="_blank"><?=$data[com_name]?></a>
									<? }else{ ?>
										<?=$data[com_name]?>
									<? } ?>
									</td>
								</tr>
							</table>
						</td>
					</tr></table></td>
<?
	$k++;
}
?>
          </tr>
          
        </table></td>
      </tr>
      <tr>
        <td height="300">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<footer>
    <div class="container">
      <div class="logo">
        <h1>
          <span>우정넷</span>
          <a href="" class="link-to-pc">PC����</a>
        </h1>
      </div>
      <div class="info">
        <div>����: 1899-3840/02-2601-6569~70  �ѽ�: 02)2601-6691 | �̸���: drg1038@naver.com</div>
        <div>��ȣ: ������ �� ����ڹ�ȣ: 152-25-00212  |  ��ǥ: ���̼�  ��  �ּ�: ���� ������ ȭ���185 ���������� 505ȣ</div>
      </div>
    </div>
    <a href="" class="banner">
      <p>Ȩ���������� �������� <span class="tag">�ٷΰ���</span></p>
    </a>
  </footer>
<? include "$DOCUMENT_ROOT/inc/bottom.php";?> 
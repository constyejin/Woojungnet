<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<style>
.ui-datepicker select.ui-datepicker-month{ width:30%;  }
.ui-datepicker select.ui-datepicker-year{ width:40%; }
</style>


<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0">
<iframe name="HiddenFrm" style="display:none;" width=800 height=150></iframe>
<table width="100%" border="0" cellpadding="0" cellspacing="0" height='100%'>
	<tr>
		<td valign='top'>
			<!--로고 & 탑메뉴-->
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="750" align='center' valign="top" style='font-size:14px; padding:10px'>                  <table width="1000" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> 위치 : 포트폴리오 &gt; <strong>포트폴리오</strong></td>
                        <td align='right'>&nbsp;</td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
<?
if($_GET[page] && $_GET[page] > 0){
    $page = $_GET[page];
}else{
    $page = 1;
}
// 한 페이지에 보일 글 수
$page_row = 20;
// 한줄에 보여질 페이지 수
$page_scale = 10;
$paging_str = "";

$wh=" portfolio='1' ";

$sql = "select count(*) as cnt from user where $wh ";
$total_count = sql_total($sql);
$paging_str = paging2($page, $page_row, $page_scale, $total_count,$_SERVER['PHP_SELF']."?"."sear=".$sear."&lev=$_GET[lev]&");
$from_record = ($page - 1) * $page_row;

$sql="select * from user where $wh order by op_date desc,regdate desc  limit ".$from_record.", ".$page_row;
$result=sql_query($sql);
$i=$page_row*($page-1);
$k=0;
while($data=mysql_fetch_array($result)){
	if($k&&$k%4==0)echo '</tr><tr>';
?>
                    <td align="center">
					<table width="250" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td style="width:250px;align:left;">
							<table>
								<tr>
									<td>
									<? if($data[virtual_url]){ ?>
										<a href="http://<?=$data[virtual_url]?>" target="_blank">
										<img src="/images/portfolio/<?=$data[p_file]?>" width="230" height="200" />
										</a>
									<? }else{ ?>
										<img src="/images/portfolio/<?=$data[p_file]?>" width="230" height="200" />
									<? } ?>
									</td>
								</tr>
								<tr>
									<td align="center"><?=$data[com_name]?></td>
								</tr>
							</table>
						</td>
					</tr></table></td>
<?
	$k++;
}
?>
                      </tr>
                      <tr><td colspan="4" align="center" height="50"><?=$paging_str?></td></tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
                </tr>
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

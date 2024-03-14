<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";

if(!$nmonth){
	$nmonth=date("n");
}

?>

<script>
   var initBody
   function beforePrint(){
   initBody = document.body.innerHTML;
   document.body.innerHTML = idPrint.innerHTML;
       }
   function afterPrint(){
       document.body.innerHTML = initBody;
      }
   function printArea() {
       window.print();
      }
      window.onbeforeprint = beforePrint;
      window.onafterprint = afterPrint;
</script>


<iframe name="HiddenFrm" style="display:none;" width=800 height=150></iframe>
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="600" align='center' valign="top" style='font-size:14px; padding:10px'><table width="900" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> 위치 : 년중계획서 &gt;<strong>&nbsp;<a href="sub02.php"><font color="#FF0000">월별</font></a></strong></td>
                        <td align='right'>&nbsp;</td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr>
                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="25" align="left"><span style="font-size:14px; font-weight:bold">
						  <?
							for($i=1;$i<13;$i++){
								if($i==1){
									if($nmonth=="1"){
										echo '<font color="#FF0000">1월</font>';
									}else{
										echo '<span onclick="location.href='."'sub01.php?nmonth=".$i."'".'" style="cursor:pointer;">1월</span>';
									}
								}else{
									if($nmonth==$i){
										echo ' / <font color="#FF0000">'.$i.'월</font> ';
									}else{
										echo ' / <span onclick="location.href='."'sub01.php?nmonth=".$i."'".'" style="cursor:pointer;">'.$i.'월 </span>';
									}
								}
							}
						  ?>
                          </td>
                          <td width="15%" align="right"><a href="write.php"><font color="#FF0000">등록하기</font></a></td>
                      </tr>
                        <tr>
                          <td height="5" colspan="2" align="left"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td colspan="2"><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
					  <tr>
                        <td height="30" width="4%" bgcolor="f4f4f4"><strong>no</strong></td>
                        <td width="8%" bgcolor="f4f4f4"><strong>일자</strong></td>
                        <td width="84%" bgcolor="f4f4f4"><strong>일정</strong><strong></strong></td>
                      </tr>
<?
					$k=1;
					for($i=1;$i<32;$i++){
						$sql="select count(*) as cnt from plan where pday='$i' and (plan_type='1' or (plan_type='2' and pmonth='$nmonth') )  ";
						$total_count = sql_total($sql);
						if($total_count>0){
?>
					  <tr >
                        <td height="30" ><?=$k?></td>
                        <td ><?=$i?>일</td>
                        <td align="left" style="padding:5px;line-height:200%;"><font color="#0066CC"><strong>
<?
							$j=0;
							$sql="select * from plan where pday='$i' and (plan_type='1' or (plan_type='2' and pmonth='$nmonth') )  ";
							$result=mysql_query($sql);
							while($data=mysql_fetch_array($result)){
								if($j==0){
									echo '<span style="cursor:pointer;" onClick="window.location='."'write.php?idx=".$data[idx]."'".'">'.$data[title].'</span>';
								}else{
									echo "<br>".'<span style="cursor:pointer;" onClick="window.location='."'write.php?idx=".$data[idx]."'".'">'.$data[title].'</span>';
								}
								$k++;$j++;
							}
?>
						</strong></font><br /><?=nl2br($data[memo])?></td>
                      </tr>
<?
						}
?>
<?
					}
?>
                    </table>
					
<div id="idPrint" style="display:none;">
<table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
					  <tr>
                        <td height="30" width="4%" bgcolor="f4f4f4"><strong>no</strong></td>
                        <td width="8%" bgcolor="f4f4f4"><strong>일자</strong></td>
                        <td width="84%" bgcolor="f4f4f4"><strong>일정</strong><strong></strong></td>
                      </tr>
<?
					$k=1;
					for($i=1;$i<32;$i++){
						$sql="select count(*) as cnt from plan where pday='$i' and (plan_type='1' or (plan_type='2' and pmonth='$nmonth') )  ";
						$total_count = sql_total($sql);
						if($total_count>0){
?>
					  <tr >
                        <td height="30" ><?=$k?></td>
                        <td ><?=$i?>일</td>
                        <td align="left" style="padding:5px;line-height:200%;"><font color="#0066CC"><strong>
<?
							$j=0;
							$sql="select * from plan where pday='$i' and (plan_type='1' or (plan_type='2' and pmonth='$nmonth') )  ";
							$result=mysql_query($sql);
							while($data=mysql_fetch_array($result)){
								if($j==0){
									echo '<span style="cursor:pointer;" onClick="window.location='."'write.php?idx=".$data[idx]."'".'">'.$data[title].'</span>';
								}else{
									echo "<br>".'<span style="cursor:pointer;" onClick="window.location='."'write.php?idx=".$data[idx]."'".'">'.$data[title].'</span>';
								}
								$k++;$j++;
							}
?>
						</strong></font><br /><?=nl2br($data[memo])?></td>
                      </tr>
<?
						}
?>
<?
					}
?>
                    </table>
</div>

					
					</td>
                  </tr>
                  <tr>
                    <td align="left" height="40"></td>
                    <td align="right"><span onclick="printArea();" style="cursor:pointer;">인쇄하기</span></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
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

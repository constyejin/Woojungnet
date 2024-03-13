<?
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';

//if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("잘못된 접근입니다.");
$a_board=rfile("skin/admin_board.htm");
$tmp_board=explode("[loop]",$a_board);
$a_board=$tmp_board[0];

$sql="select * from admin_table";
$result=mysql_query($sql,$connect);

include "../Setup/submenu.php";
//echo $a_board;
?>
<table width="970" border="0" cellpadding="0" cellspacing="0">
<tr> 
    <td>
     <table width="900" border="0" cellspacing="0" cellpadding="0">
     	<tr>
         <td height="30">
           <table width="900" border="0" cellpadding="0" cellspacing="0">    
             <tr>
               <td height="20" align="left" style="color:#333399"> <font size="-4"> ▶ </font>위치 : 게시판설정 &gt; 게시판 리스트</td>
       		  </tr>
             <tr> 
               <td width="780" height="1" colspan="2" bgcolor="#333399"></td>
       		  </tr>
             <tr> 
               <td height="20">&nbsp;</td>
	         </tr>
            </table></td>
        </tr>
      </table>
     
    </td>
  </tr>

	<tr>
		<td valign='top'>
				<!--컨텐츠-->
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table width="900" border="0" cellpadding="0" cellspacing="0">						
					  <tr>
								<td>
									<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="d9d9d9" frame="hsides" style="border-collapse:collapse;text-align:center;margin-top:5px;" class="table-style">
										
										<tr>								
											<td bgcolor="f7f7f7" class="table-th">No</td>
											<td bgcolor="f7f7f7" class="table-th">테이블명</td>
											<td bgcolor="f7f7f7" class="table-th">ID</td>
											<td bgcolor="f7f7f7" class="table-th">등록글수</td>
											<td bgcolor="f7f7f7" class="table-th">스킨명</td>
											<td bgcolor="f7f7f7" class="table-th">파일사용</td>
											<td bgcolor="f7f7f7" class="table-th">비밀글</td>											
											<td bgcolor="f7f7f7" class="table-th">비고</td>
										</tr>	
										<?
										while ($data=mysql_fetch_array($result)) {

											$t_name="$data[a_name]";
											$s_name=$data[a_skinname];
											if ($data[a_file_use]==0) $u_file="사용안함"; 
												else $u_file=$data[a_file_use];
											$b_no++;

											$sql="select count(no) from $data[a_name]";
											$result2=mysql_query($sql,$connect);
//											$t_count=mysql_result($result2,0);
											$t_title=$data[a_title];

											if ($data[a_security]=="y") $security="비밀글";
											else $security="";

										?>
										<!-- /board/board.php?id=$data[a_name] -->
										<tr onblur="this.style.backgroundColor='#deecee'" onfocus="this.style.backgroundColor='#FFF'" onMouseOver="this.style.backgroundColor='#deecee'" onMouseOut="this.style.backgroundColor='#FFF'" >								
											<td><a href="Setup2_write.php?idx=<?=$data[a_idx]?>" style="cursor:hand"><?=$b_no?></td>
											<td><a href='/board/board.php?id=<?=$t_name?>' target="_blank"><?=$t_title?></td>
											<td><a href="Setup2_write.php?idx=<?=$data[a_idx]?>" style="cursor:hand"><?=$t_name?></a></td>
											<td><a href="Setup2_write.php?idx=<?=$data[a_idx]?>" style="cursor:hand"><?=$t_count?></td>
											<td><a href="Setup2_write.php?idx=<?=$data[a_idx]?>" style="cursor:hand"><?=$s_name?></td>
											<td><a href="Setup2_write.php?idx=<?=$data[a_idx]?>" style="cursor:hand"><?=$u_file?></td>
											<td><a href="Setup2_write.php?idx=<?=$data[a_idx]?>" style="cursor:hand"><?=$security?></td>											
											<td><span onclick="del_ok('<?=$data[a_idx]?>');" style="cursor:hand">[삭제]</span></td>
										</tr>
										<? } ?>																			
									</table>

									<table border="0" cellpadding="5" cellspacing="0"  style='margin-top:10px;' align='center'>	
										<tr>
											<td><input type="submit" id="button" value="새로만들기" class='button33 btn-red-sm' onclick="window.location='./Setup2_write.php'" ></td>	
										</tr>
									</table>
								</td>
							</tr>
						</table>
				  </td>
				</tr>
			</table>	
			<!--/컨텐츠-->
		</td>
	</tr>
</table>
<script language="javascript">

function del_ok(del){
	if (confirm ("정말로 삭제를 원하십니까?")) {
		location.href="Setup2_del.php?idx="+del;
	}
}

</script>
<?mysql_close($connect);?>
<? include_once "../inc/footer.php";?>
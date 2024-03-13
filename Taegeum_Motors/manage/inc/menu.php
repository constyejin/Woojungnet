<?
$tchkdir=explode("/",$PHP_SELF);
$chkdir2=basename($PHP_SELF);
$chkdir3=$_SERVER['QUERY_STRING'];
$chkdir=$tchkdir[sizeof($tchkdir)-2];
$data_noti=mysql_fetch_array(mysql_query("select * from js_webconfig where no=1"));

$today_2 = mysql_fetch_row(mysql_query("SELECT count(*) FROM woojung_car_go  WHERE wc_go_end_date='".date("Y-m-d")."' " ));
$today_3 = mysql_fetch_row(mysql_query("SELECT count(*) FROM woojung_bid  WHERE bid_sort_date like '".date("Y-m-d")."%' and bid_sort = 'Y' " ));

if (!$xwidth){ 
?>
<table border="0" cellspacing="0" cellpadding="0" width="1500" align="center" style="font-weight:bold;">
  <tr class="menu01"> 
    <td width="10">
      <table border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><? include_once "$dir/manage/title.php";?> </td>
        </tr>
      </table>
    </td>
    <td width="300">
	  <span class="tag-round">
        <font style="font-weight:700;"> 오늘마감:</font><a href="/manage/Sale03/Sale_list.php?ed=1"><font style="color: #E9181E; font-weight:700;"><?=$today_2[0]?></font></a>
      </span>
      <span class="tag-round">
        <font style="font-weight:700;">오늘낙찰:</font><a href="/manage/Sale04/Suc_list.php?tm=1"><font style="color: #F33; font-weight:700;"><?=$today_3[0]?></font>
     
		  </td>
	  
	  <td width="84"> <table width="83" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="24"></td>
          <td style="background:url(/manage/img/tab02.gif);background-repeat:repeat-x;"><a href="/manage/Sale06/Scrap_app_list.php" class="menu-link"> 
            <?if ($chkdir=="Sale06") {?>
            <font color="#3887ff"> 
            <?}?>
            차량상담</font></a></td>
          <td width="7"></td>
        </tr>
      </table></td>
         <td width="85"> <table width="84" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="24"></td>
          <td style="background:url(/manage/img/tab02.gif);background-repeat:repeat-x;"> <a href="/manage/Sale01/write.php" class="menu-link"> 
            <?if ($chkdir=="Sale01") {?>
            <font color="#3887ff"> 
            <?}?>
            차량등록</font></a> </td>
          <td width="7"></td>
        </tr>
      </table></td>
            
		<td width="85" >
			<table width="84" border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td width="24"></td>
					<td style="background:url(/manage/img/tab02.gif);background-repeat:repeat-x;"> <a href="/manage/Sale02/Sale_list.php" class="menu-link"> 
				<?if($listpage){
					 if($listpage=="1") echo "<font color='#3887ff'>";
				  }else if($chkdir=="Sale02"||$chkdir=="Sale05"){
					 echo "<font color='#3887ff'>";
				  } 
				  ?> 
					접수대장</font></a> </td>
					<td width="7"></td>
				</tr>
			</table>
		</td>

<?
if($loginUsort == "admin1" ||$loginUsort == "admin2" || $loginUsort == "superadmin"){
?>
	<td width="85"> <table width="90" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="24"></td>
          <td style="background:url(/manage/img/tab02.gif);background-repeat:repeat-x;"><a href="/manage/Sale03/Sale_list.php" class="menu-link"> 
            <?if ($chkdir=="Sale03") {?>
            <font color="#3887ff"> 
            <?}?>
           입찰현황</font></a></td>
          <td width="7"></td>
        </tr>
      </table></td> 
<?
}
?>
      
<?	if($loginUsort == "admin" || $loginUsort == "admin1" || $loginUsort == "admin2" || $loginUsort == "superadmin"){ ?>
	<td width="85"> <table width="90" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="24"></td>
          <td style="background:url(/manage/img/tab02.gif);background-repeat:repeat-x;"><a href="/manage/Sale04/Suc_list.php" class="menu-link"> 
			<?if($listpage){
                 if($listpage=="2") echo "<font color='#3887ff'>";
              }else if($chkdir=="Sale04"){
			     echo "<font color='#3887ff'>";
			  } 
			  ?>
           낙찰대장</font></a></td>
          <td width="7"></td>
        </tr>
      </table></td> 
<? } ?>	  
      
     
<?	if($loginUsort == "admin1" || $loginUsort == "admin2" || $loginUsort == "superadmin"){ ?>
    <td width="79"> <table width="85" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="24"></td>
          <td width="54" style="background:url(/manage/img/tab02.gif);background-repeat:repeat-x;"><a href="/manage/Sale07/Member_list.php" class="menu-link"> 
            <?if ($chkdir=="Sale07") {?>
            <font color="#3887ff"> 
            <?}?>
          회원관리</font></a></td>
          <td width="7"></td>
        </tr>
      </table></td>
<? } ?>	  
      
<?	if($loginUsort == "admin1" || $loginUsort == "admin2" || $loginUsort == "superadmin"){ ?>
        <td width="84"><table width="84" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="24"></td>
          <td style="background:url(/manage/img/tab02.gif);background-repeat:repeat-x;"><a href="/manage/Sale08/Setup3.php" class="menu-link"> 
            <?if ($chkdir=="Sale08") {?>
            <font color="#3887ff"> 
            <?}?>
            기본설정</font></a></td>
          <td width="7"></td>
        </tr>
      </table> </td>
<? } ?>	  
      
<?
if($loginUsort == "admin2" || $loginUsort == "superadmin"){
?>
		<td width="84">
      <table width="84" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="24"></td>
          <td style="background:url(/manage/img/tab02.gif);background-repeat:repeat-x;"><a href="/manage/Sale09/Setup.php"> 
            <?if ($chkdir=="Sale09") {?>
            <font color="#3887ff"> 
            <?}?>
            환경설정</font></a></td>
          <td width="7"></td>
        </tr>
      </table>
    </td>
<? } ?>	  

    <td width="200">
      <table border="0" cellspacing="0" cellpadding="0" style="margin-left: auto;">
        <tr> 
          <td class="bg-darkblue">
            <a href="/index.php" class="btn btn-link tag-round"><i class="bi bi-house"></i> 홈으로</a>
            <a href="/login/loginProc.php?logMode=logout" class="btn btn-link tag-round ml-10"><i class="bi bi-box-arrow-right"></i> 로그아웃</a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<?}?>
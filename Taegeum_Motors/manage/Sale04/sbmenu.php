 <?
//if($user_level != "20"){echo "<script>alert('최고관리자만 가능합니다.');history.back();</script>";}
 ?>
<a href="/manage/Sale04/Suc_list.php"> 
<?if ($chkdir=="Sale04" && $chkdir2=="Suc_list.php" && !$gubun4) {?>
<font color="#EA0000"> 
<?}?>
전체보기</font></a> &nbsp;&nbsp; 

<a href="/manage/Sale04/Suc_list02.php"> 
<?if ($chkdir=="Sale04" && ($chkdir2=="Suc_list02.php" || $chkdir2=="Suc_list02.php") ) {?>
<font color="#EA0000"> 
<?}?>
낙찰(경리용)</font></a>
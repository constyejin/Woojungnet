<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';

include "setup.php";

if($idx){

	$sql="select * from admin_table where a_idx='$idx'";
	$data=mysql_fetch_assoc(mysql_query($sql));
	if ($data[a_security]=="0") $addcheck="checked";
	if ($data[a_security]=="y") $security_check="checked";
	$a_level = $data[a_level];
	$a_write_level = $data[a_write_level];

}else{
}

//admin page
$Arr_Skin = array(
"bbs"=>"bbs"
);
$Arr_level = array(
	"비회원"=>"10",
	"일반회원"=>"9",
	"교육회원"=>"8",
	"제휴회원"=>"7",
	"관리자"=>"1"
);
/*
$t_name="<input type=text name=a_name>";
$s_name="<input type=text name=a_skinname>";
$a_header="<input type=text name=a_header>";
$a_footer="<input type=text name=a_footer>";
$a_file_use=tselect("a_file_use","0,1,2,3,4,5,6,7,8,9,10");
*/
//$confirm="<input type=submit value=\"확인\" class='button'>";
//$reset="<input type=reset value=\"취소\" class='button'>";
//$list="<input type=button value=\"리스트\" class='button' onclick=\"history.back(-1);\">";

/*
$a_img="<table border=0 cellpadding=0 cellspacing=0><tr>";
for ($i=1;$i<=20;$i++){

	if ($data[a_img]==$i) $selected="checked";
	else $selected="";
$a_img_tmp="<td><table border=0 cellpadding=0 cellspacing=0><tr><td><img src=\"/etc/img/$i.gif\"></td></tr><tr><td align=center><input type=radio name=a_img value=$i $selected></td></tr></table></td>";
$a_img.=$a_img_tmp;
if ($i%4==0) $a_img.="</tr><tr>";
}
$a_img.="</tr></table>";
*/
/*
$a_img="<input type=text name=a_img>"; 
$a_title="<input type=text name=a_title>";
$table_data=rfile("skin/edit.htm");
$table_data=str_replace("[t_title]",$a_title,$table_data);
$table_data=str_replace("[a_img]",$a_img,$table_data);
$table_data=str_replace("[t_name]",$t_name,$table_data);
$table_data=str_replace("[s_name]",$s_name,$table_data);
$table_data=str_replace("[a_header]",$a_header,$table_data);
$table_data=str_replace("[a_footer]",$a_footer,$table_data);
$table_data=str_replace("[a_file_use]",$a_file_use,$table_data);
$table_data=str_replace("[confirm]",$confirm,$table_data);
$table_data=str_replace("[reset]",$reset,$table_data);
$table_data=str_replace("[list]",$list,$table_data);


echo "<form method=post action=write_ok.php>";
echo $table_data;
echo "</form>";
*/
?>


<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
			<td height="20" colspan="2" align="left" style="color:#333399"> <font size="-4"> ▶ </font>위치 : 게시판설정    &gt; 새로만들기</td></tr>
		<tr><td  height="1" bgcolor="#333399" colspan="2"> </td></tr>
		<tr><td  height="20" colspan="2"> </td></tr>

</table>

<form name="cform" method="post" action="Setup2_save.php" style="margin:0px;">
<input type="hidden" name="no" value="<?=$idx?>">
	<table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="b2b2b2" class="tableline2 table-style">
      <tr>
        <td width="15%" height="23" align="center" bgcolor="f6f6f6" class="bg1 table-th">테이블명</td>

        <td width="85%" align="left" bgcolor="#FFFFFF" style="padding:3px 0 0 10px"><input name="a_title" type="text" size="30" value='<?=($data[a_title])?$data[a_title]:""?>'> <span class="blue">예:공지사항</span></td>
	  </tr>
      <tr>
        <td height="23" align="center" bgcolor="f6f6f6" class="bg1 table-th">ID</td>

        <td align="left" bgcolor="#FFFFFF" style="padding:3px 0 0 10px"><input name="a_name" type="text" size="30" value='<?=($data[a_name])?$data[a_name]:""?>'> <span class="blue">예:notice</span></td>
	  </tr>
      <tr>
        <td height="23" align="center" bgcolor="f6f6f6" class="bg1 table-th">스킨명</td>
  		<td align="left" bgcolor="#FFFFFF" style="padding:3px 0 0 10px">
		  <select name='a_skinname' >  
<option value=''  <? if($data[a_skinname]=="") echo "selected"; ?>>:: 선택 ::</option>
<option value='bbs' <? if($data[a_skinname]=="bbs") echo "selected"; ?>>bbs</option>
<option value='gallery' <? if($data[a_skinname]=="gallery") echo "selected"; ?>>gallery</option>
</select>
		</td>
      </tr>
      <tr>
        <td height="23" align="center" bgcolor="f6f6f6" class="bg1 table-th">쓰기권한</td>
        <td align="left" bgcolor="#FFFFFF" style="padding:3px 0 0 10px">
		<select name='a_write_level' >  
<option value=''  <? if($data[a_write_level]=="") echo "selected"; ?>>:: 선택 ::</option>
<option value='10' <? if($data[a_write_level]=="10") echo "selected"; ?>>비회원</option>
<option value='7' <? if($data[a_write_level]=="7") echo "selected"; ?>>일반회원</option>
<option value='1' <? if($data[a_write_level]=="1") echo "selected"; ?>>관리자</option>
</select>
 <span class="blue">* 선택레벨이상 쓰기권한이 주어짐</span>
		</td>    
	  </tr>
      <tr>
        <td height="23" align="center" bgcolor="f6f6f6" class="bg1 table-th">보기권한</td>
        <td align="left" bgcolor="#FFFFFF" style="padding:3px 0 0 10px">
		<select name='a_level' >  
<option value=''  <? if($data[a_level]=="") echo "selected"; ?>>:: 선택 ::</option>
<option value='10' <? if($data[a_level]=="10") echo "selected"; ?>>비회원</option>
<option value='7' <? if($data[a_level]=="7") echo "selected"; ?>>일반회원</option>
<option value='1' <? if($data[a_level]=="1") echo "selected"; ?>>관리자</option>
</select>
 <span class="blue">* 선택레벨이상 보기권한이 주어짐</span>
		</td>
	  </tr>

	   <tr>
        <td height="23" align="center" bgcolor="f6f6f6" class="bg1 table-th">댓글쓰기</td>
        <td align="left" bgcolor="#FFFFFF" style="padding:3px 0 0 10px">
		<select name='a_comment_level' >  
<option value=''  <? if($data[a_comment_level]=="") echo "selected"; ?> >:: 선택 ::</option>
<option value='10' <? if($data[a_comment_level]=="10") echo "selected"; ?>>비회원</option>
<option value='7' <? if($data[a_comment_level]=="7") echo "selected"; ?>>일반회원</option>
<option value='1' <? if($data[a_comment_level]=="1") echo "selected"; ?>>관리자</option>
</select>
 <span class="blue">* 선택레벨이상 쓰기권한이 주어짐</span>
		</td>    
	  </tr>

	  <tr>
        <td height="23" align="center" bgcolor="f6f6f6" class="bg1 table-th">파일갯수</td>
 <td align="left" bgcolor="#FFFFFF" style="padding:3px 0 0 10px">
       <select name=a_file_use>
		   <option value='' <? if($data[a_file_use]=="") echo "selected"; ?>>선택</option>
		   <option value='0' <? if($data[a_file_use]=="0") echo "selected"; ?>>0</option>
		   <option value='1' <? if($data[a_file_use]=="1") echo "selected"; ?>>1</option>
		   <option value='2' <? if($data[a_file_use]=="2") echo "selected"; ?>>2</option>
		   <option value='3' <? if($data[a_file_use]=="3") echo "selected"; ?>>3</option>
		   <option value='4' <? if($data[a_file_use]=="4") echo "selected"; ?>>4</option>
		   <option value='5' <? if($data[a_file_use]=="5") echo "selected"; ?>>5</option>
		   <option value='6' <? if($data[a_file_use]=="6") echo "selected"; ?>>6</option>
		   <option value='7' <? if($data[a_file_use]=="7") echo "selected"; ?>>7</option>
		   <option value='8' <? if($data[a_file_use]=="8") echo "selected"; ?>>8</option>
		   <option value='9' <? if($data[a_file_use]=="9") echo "selected"; ?>>9</option>
		   <option value='10' <? if($data[a_file_use]=="10") echo "selected"; ?>>10</option>
		   </select>
		   </td>
	  </tr>
	  <tr>
        <td height="23" align="center" bgcolor="f6f6f6" class="bg1 table-th">타이틀</td>
        <td align="left" bgcolor="#FFFFFF" style="padding:3px 0 0 10px">
          <input type=text name=a_header style="width:350px;" value='<?=$data[a_header]?>'> ex)  ../images/image1.jpg
		</td>
	  </tr>
	  <tr>
        <td height="23" align="center" bgcolor="f6f6f6" class="bg1 table-th">헤더</td>
        <td align="left" bgcolor="#FFFFFF" style="padding:3px 0 0 10px">
          <input type=text name=a_header2 style="width:350px;" value='<?=$data[a_header2]?>'> ex)  /inc/header1.php 
		</td>
	  </tr>
	  <tr>
        <td height="23" align="center" bgcolor="f6f6f6" class="bg1 table-th">풋터</td>
        <td align="left" bgcolor="#FFFFFF" style="padding:3px 0 0 10px">
          <input type=text name=a_footer style="width:350px;" value='<?=$data[a_footer]?>'> ex)  /inc/footer1.php
		</td>
	  </tr>
	  <tr>
        <td height="23" align="center" bgcolor="f6f6f6" class="bg1 table-th">게시판위삽입</td>
        <td align="left" bgcolor="#FFFFFF" style="padding:3px 0 0 10px">
          <textarea name="a_table" rows="3" class='w95' style="width:95%;"><?=$data[a_table]?></textarea>
		</td>
	  </tr> 
    </table>

<br />
<center>
	<input type="submit" name="Submit2" value="등록하기" class="btn-red-sm" onclick="" > &nbsp;
      <input type="reset" name="Submit62" value="목록보기" class="btn-blue" onClick="window.location='javascript:history.back(-1)'" />
</center>
</form>


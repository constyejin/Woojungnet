<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
?>

<script language="javascript">
	
	function ChkInsu(){
		
		var obj = document.frmInsu;
		if(!obj.InsuName.value){
			alert("제휴업체명을 기입해 주세요.");
			return false;
		}

		obj.action = "./Setup4.php";
	}


	
	function ChgName(nm, idx, sidx, sort_list){
		var obj = document.frmInsu;
		obj.mode.value = "edit";
		obj.subname.value = "수정하기";
		obj.InsuName.value = nm;
		obj.idx.value = idx;	
		obj.subidx.value = sidx;	
		obj.sort_list.value = sort_list;	
	}


	function freset(){
		var obj = document.frmInsu;
		obj.subname.value = "현위치에등록";
		obj.reset();
	}

	function DelName(no, sidx){	
		
		var obj = document.frmInsu;
		obj.mode.value = "del";
		obj.idx.value = no;
		obj.subidx.value = sidx;

		if(confirm('삭제후 복원 불가능 합니다. 하위메뉴까지 포함 삭제됨\n\n정말 삭제하시겠습니까?')){
			obj.action = "./Setup4.php";
			obj.submit();
		}
	}
</script>

<?
if($midx) $data=mysql_fetch_array(mysql_query("select * from team_cate where idx=$midx"));

if( $InsuName && $mode == "Ins" ){
//idx  code  depth  name  
	if(!$idx){ // 최상위 등록

		$SQL = "insert into team_cate (depth, name, sort_list) values ('1', '".$InsuName."', ".$sort_list.") ";
		$rIns = mysql_query($SQL);
		if($rIns){
			MsgMov("등록되었습니다.","$PHP_SELF?idx=".$idx."&name=".$name."");
		}

	}else{

		$SQL = "insert into team_cate (code, depth, name, sort_list) values ( '".$idx."', '2','".$InsuName."', ".$sort_list.") ";
		$rIns = mysql_query($SQL);
		if($rIns){
			MsgMov("등록되었습니다.","$PHP_SELF?idx=".$idx."&name=".$name."");
		}

	}
}

if( $InsuName && $mode == "edit" && $idx){

	$SQL1 = "update team_cate set  name  = '".$InsuName."', sort_list = ".$sort_list." where idx=".$idx." ";
	
	$rIns1 = mysql_query($SQL1);
	if($rIns1){
		if($subidx){
			MsgMov("수정되었습니다.","$PHP_SELF?idx=".$subidx."&name=".$name."");
		}else{
			MsgMov("수정되었습니다.","$PHP_SELF?idx=".$idx."&name=".$name."");
		}
	}
}

if(  $mode == "del" && $idx){

	$SQL1 = "delete from team_cate  where idx=".$idx." ";
	$rIns1 = mysql_query($SQL1);

	$SQL2 = "delete from team_cate  where code=".$idx." ";
	$rIns2 = mysql_query($SQL2);

	

	if($rIns1){
		if($subidx){
			MsgMov("삭제되었습니다.","$PHP_SELF?idx=".$subidx."&name=".$name."");
		}else{
			MsgMov("삭제되었습니다.","$PHP_SELF?idx=".$idx."&name=".$name."");
		}
		
	}
}



?>
<table width="970" border="0" cellspacing="0" cellpadding="0">

<tr> 
    <td>
     <table width="900" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="20" align="left" style="color:#333399"> <font size="-4"> ▶ </font>위치 : 제휴업체등록 &gt;제휴업체리스트</td>
       </tr>
       <tr> 
        <td width="602" height="1" colspan="2" bgcolor="#333399"></td>
       </tr>
       <tr> 
        <td height="20">&nbsp;</td>
       </tr>  
       <tr> 
         <td width="862" align="left" class="title"><img src="/manage/img/icon02.gif" width="15" height="15" align=absmiddle /> <strong>제휴업체등록</strong></td>
       </tr>
      </table>
       
    </td>
  </tr>
  <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" align="left"><table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="dadada">
        <tr> 
          <td height="30" align="left" valign="middle" bgcolor="#f6f6f6" style="padding-left:10"><strong>현디렉토리 
            : <font color=blue>
            <?if($name) echo $name; else echo "최상위";?>
            </font></strong> </td>
          <td height="30" align="center" valign="middle" bgcolor="#f6f6f6" style="padding:0 0 0 10">
		        <table width="460" border="0" cellpadding="0" cellspacing="0">
              <form name="frmInsu" method="post" onsubmit="return ChkInsu()">
                <input type="hidden" name="mode" value="Ins">
                <input type="hidden" name="idx" value="<?=$idx?>">
                <input type="hidden" name="subidx" value="<?=$subidx?>">
                <input type="hidden" name="program" value="SetupMain5">
                <input type="hidden" name="name" value="<?=$name?>">
                <tr> 
                  <td width="30" align="left" valign="middle" bgcolor="#f6f6f6"><strong>순서</strong></td>
                  <td width="70" align="left" valign="middle" bgcolor="#f6f6f6"><input name="sort_list" type="text" size="3" /></td>
                  <td width="70" align="left" valign="middle" bgcolor="#f6f6f6"><strong>제휴업체명</strong></td>
                  <td width="" align="left" valign="middle" bgcolor="#f6f6f6"><input name="InsuName" type="text" id="InsuName" size="22" /></td>
                  <td  align="left" valign="middle" bgcolor="#f6f6f6"> <input type="submit" name="subname" value="등록" class="button333" style="size:80; cursor:pointer; background-color:#FFFFFF; color:#ff0000; border:#636563 1px solid; padding:2 0 0 0; font-weight:bold">
                    &nbsp; <input type="button" name="subname22" value="취소" onclick="freset();" class="button4"style="cursor:pointer; background-color:#FFFFFF; color:#ff0000; border:#636563 1px solid; padding:2 0 0 0; font-weight:bold"> 
                  </td>
                </tr>
              </form>
            </table></td>
        </tr>
        <tr> 
          <td  height="102" align="left" valign="top" bgcolor="#FFFFFF" style="padding-left:5px;"> 
            <table width="190" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height=30><span class="style4"><a href="./Setup4.php"><b>/최상위</b></a></span></td>
              </tr>
            </table>
<form name="frmInsu2" method="post" >
<input type="hidden" name="mode" value="edit">
<input type="hidden" name="idx" value="<?=$midx?>">
<input type="hidden" name="name" value="<?=$name?>">
<input type="hidden" name="subidx" value="<?=$idx?>">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <?
	    $qry = "SELECT * FROM team_cate Where depth=1 order by sort_list asc ";
  		$arr = Fetch_string($qry);
		
		
		if($arr[0][name]){

			for($i=0;$i<count($arr);$i++){	

				if($idx == $arr[$i][idx]) $font = "#c4c4c4";
				else $font = "#FFFFFF";
?>
              <tr bgcolor="<?=$font?>"> 
                <td width="17" height="22"><img src="../img/admin_setting_pol.gif" width="13" height="11" /></td>
                <td width="70" height="22">
				<?
				if($midx==$arr[$i][idx]){
				?>
				<input name="sort_list" type="text" size="3" value="<?=$data[sort_list]?>"/>
				<?
				}else{
					echo $arr[$i][sort_list];
				}
				?>
				</td>
                <td  height="22">
				<?
				if($midx==$arr[$i][idx]){
				?>
				<input name="InsuName" type="text" size="24" value="<?=$data[name]?>"/>
				<?
				}else{
				?>
				<a href="<?=$_SERVER['PHP_SELF']?>?idx=<?=$arr[$i][idx]?>&name=<?=$arr[$i][name]?>"><strong><?=$arr[$i][name]?></strong></a>
				<?
				}
				?>
				</td>
                <td width="90">
				<?
				if($midx==$arr[$i][idx]){
				?>
				<input type="submit" value="변경"/> <input type="button" value="취소" onclick="history.back();"/>
				<?
				}else{
				?>
				<a href="<?=$_SERVER['PHP_SELF']?>?midx=<?=$arr[$i][idx]?>" class="hand" >수정</a> 
                / <a href="#" class="hand" onclick="DelName(<?=$arr[$i][idx]?>,'')">삭제</a>
				<?
				}
				?>
				</td>
              </tr>
              <?
			}	

		}

?>
            </table>
            <br> </td>
          <td width="296" height="102" align="left" valign="top" bgcolor="#FFFFFF" style="padding-left:3px;"><table width="434" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="434" height="30" align="left" valign="top"><a href="#"><img src="../img/admin_setting_pol_2.gif" width="12" height="13" border="0" />..</a></td>
              </tr>
            </table>
            <table  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="436" height="20" align="left" valign="top"><table width="435" border="0" cellspacing="0" cellpadding="0">
                    <?
if($idx){
	    $qryS = "SELECT * FROM team_cate Where depth=2 and code=".$idx." order by sort_list,name asc";
  		$arrS = Fetch_string($qryS);
		if($arrS[0][name]){
			for($j=0;$j<count($arrS);$j++){	
?>
                    <tr> 
                      <td width="17" height="15" align="left" valign="top"><img src="../img/admin_setting_pol_3.gif" width="16" height="11" /></td>
						<td width="70" height="22">
						<?
						if($midx==$arrS[$j][idx]){
						?>
						<input name="sort_list" type="text" size="3" value="<?=$data[sort_list]?>"/>
						<?
						}else{
							echo $arrS[$j][sort_list];
						}
						?>
						</td>
						<td  height="22">
						<?
						if($midx==$arrS[$j][idx]){
						?>
						<input name="InsuName" type="text" size="24" value="<?=$data[name]?>"/>
						<?
						}else{
							echo $arrS[$j][name];
						}
						?>
						</td>
						<td width=90>
						<?
						if($midx==$arrS[$j][idx]){
						?>
						<input type="submit" value="변경"/> <input type="button" value="취소" onclick="history.back();"/>
						<?
						}else{
						?>
						<a href="<?=$_SERVER['PHP_SELF']?>?name=<?=$name?>&idx=<?=$idx?>&midx=<?=$arrS[$j][idx]?>" class="hand">수정</a> 
						/ <a href="#" class="hand" onclick="DelName(<?=$arrS[$j][idx]?>, <?=$arrS[$j][code]?>)">삭제</a>
						<?
						}
						?>
						</td>
                    </tr>
                    <?
			}	

		}
}
?>
                  </table></td>
              </tr>
            </table></td>
</form>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>
</table>

<? include_once "../inc/footer.php";?>

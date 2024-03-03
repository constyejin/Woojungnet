<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
?>

<script language="javascript">
	
	function ChkInsu(){
		
		var obj = document.frmInsu;
		if(!obj.InsuName.value){
			alert("제조사를 기입해 주세요.");
			return false;
		}

		obj.action = "./Setup5.php";
	}


	
	function ChgName(nm, idx, sidx){
		var obj = document.frmInsu;
		obj.mode.value = "edit";
		obj.subname.value = "수정하기";
		obj.InsuName.value = nm;
		obj.idx.value = idx;	
		obj.subidx.value = sidx;	
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
			obj.action = "./Setup5.php";
			obj.submit();
		}
	}
</script>

<?
if($midx) $data=mysql_fetch_array(mysql_query("select * from cate2 where idx=$midx"));

if( $InsuName && $mode == "Ins" ){
//idx  code  depth  name  
	if(!$idx){ // 최상위 등록

		$SQL = "insert into cate2 (depth, name, sort_list) values ('1', '".$InsuName."', ".$sort_list.") ";
		$rIns = mysql_query($SQL);
		if($rIns){
			MsgMov("등록되었습니다.","$PHP_SELF?idx=".$idx."&name=".$name."");
		}

	}else{

		$SQL = "insert into cate2 (code, depth, name, sort_list) values ( '".$idx."', '2','".$InsuName."', ".$sort_list.") ";
		$rIns = mysql_query($SQL);
		if($rIns){
			MsgMov("등록되었습니다.","$PHP_SELF?idx=".$idx."&name=".$name."");
		}

	}
}

if( $InsuName && $mode == "edit" && $idx){

	$SQL1 = "update cate2 set  name  = '".$InsuName."', sort_list = ".$sort_list." where idx=".$idx." ";
	
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

	$SQL1 = "delete from cate2  where idx=".$idx." ";
	$rIns1 = mysql_query($SQL1);

	$SQL2 = "delete from cate2  where code=".$idx." ";
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
          <td height="20" align="left" style="color:#333399"> <font size="-4"> ▶ </font>위치 : 제조사</td>
        </tr>
        <tr> 
          <td width="602" height="1" colspan="2" bgcolor="#333399"></td>
        </tr>
        <tr> 
          <td height="20">&nbsp;</td>
        </tr>  
       </table>
    </td>
  </tr>
  <tr> 
    <td align="left" class="title"><img src="/manage/img/icon02.gif" width="15" height="15" align=absmiddle /> <strong>제조사/모델명</strong></td>
  </tr>
  <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr> 
    <td>
      <table width="900" border="0" cellpadding="0" cellspacing="1" bgcolor="#dadada">
        <tr> 
          <td width="300" height="30" align="left" valign="middle" bgcolor="#f6f6f6" style="padding-left:10"><strong>현디렉토리 
            : <font color=blue>
            <?if($name) echo $name; else echo "최상위";?>
            </font></strong> </td>
          <td height="30" align="center" valign="middle" bgcolor="#f6f6f6">
		        <table width="460" border="0" cellpadding="0" cellspacing="0">
              <form name="frmInsu" method="post" onsubmit="return ChkInsu()">
                <input type="hidden" name="mode" value="Ins">
                <input type="hidden" name="idx" value="<?=$idx?>">
                <input type="hidden" name="subidx" value="<?=$subidx?>">
                <input type="hidden" name="program" value="SetupMain5">
                <input type="hidden" name="name" value="<?=$name?>">
                <tr bgcolor="#f6f6f6"> 
                  <td width="90" align="left" valign="middle" style="padding:0 0 0 10"><strong>제조/모델명</strong></td>
                  <td width="" align="left" valign="middle"><input name="InsuName" type="text" id="InsuName" size="30" /></td>
                  <td  align="left" valign="middle"> <input type="submit" name="subname" id="subname" value="현위치에등록" class="button333" style="cursor:pointer; background-color:#FFFFFF; color:#ff0000; border:#636563 1px solid; padding:2 0 0 0; font-weight:bold"/>
                    &nbsp; <input type="button" name="subname22" id="subnam22e" value="취소" onclick="freset();" class="button4" style="cursor:pointer; background-color:#FFFFFF; color:#ff0000; border:#636563 1px solid; padding:2 0 0 0; font-weight:bold"/> 
                  </td>
                </tr>
              </form>
            </table>
          </td>
        </tr>
        <tr> 
          <td  height="102" align="left" valign="top" bgcolor="#FFFFFF" style="padding-left:5px;"> 
            <table width="190" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height=30><span class="style4"><a href="./Setup5.php"><b>/최상위</b></a></span></td>
              </tr>
            </table>
<form name="frmInsu2" method="post" >
<input type="hidden" name="mode" value="edit">
<input type="hidden" name="idx" value="<?=$midx?>">
<input type="hidden" name="name" value="<?=$name?>">
<input type="hidden" name="subidx" value="<?=$idx?>">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <?
	    $qry = "SELECT * FROM cate2 Where depth=1 order by sort_list asc ";
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
				<input name="InsuName" type="text" size="15" value="<?=$data[name]?>"/>
				<?
				}else{
				?>
				<a href="<?=$_SERVER['PHP_SELF']?>?idx=<?=$arr[$i][idx]?>&name=<?=$arr[$i][name]?>"><strong><?=$arr[$i][name]?></strong></a>
				<?
				}
				?>
				</td>
                <td width="110">
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
                <td width="434" height="22" align="left" valign="top"><a href="#"><img src="../img/admin_setting_pol_2.gif" width="12" height="13" border="0" />..</a></td>
              </tr>
            </table>
            <table  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="436" align="left" valign="top"><table width="435" border="0" cellspacing="0" cellpadding="0">
                    <?
if($idx){
	    $qryS = "SELECT * FROM cate2 Where depth=2 and code=".$idx." order by sort_list,name asc";
  		$arrS = Fetch_string($qryS);
		if($arrS[0][name]){
			for($j=0;$j<count($arrS);$j++){	
?>
                    <tr> 
                      <td width="17" height="22" align="left" valign="top"><img src="../img/admin_setting_pol_3.gif" width="16" height="11" /></td>
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

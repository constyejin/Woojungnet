<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr> 
        <td width="100%" align="right" style="padding-top:20px;">
			<table border="0" cellspacing="0" cellpadding="0" >
			<form name='searchForm' method='POST' onSubmit='return searchFormSubmit(this);'>
				<tr>
					<td style="font-size:19px;font-weight:bold;"><?=$data[a_title]?>
					</td>
					<td align="right" width="70%">
					<select name="board_field" class='form_select'>
							<option value="subject" <?if($_POST["board_field"]=="subject"){ echo "selected"; }?>>제목</option>
							<option value="date" <?if($_POST["board_field"]=="date"){ echo "selected"; }?>>작성일</option>
							<option value="name" <?if($_POST["board_field"]=="name"){ echo "selected"; }?>>작성자</option>
						</select>&nbsp;	
					
					<input type="text" name="search" size=20 class='form_control' value='<?=$search?>' >
					<input type="submit" value="검색" class="sbutton">
					</td>
				</tr>
			</form>
			</table>
		</td>
	</tr>
</table>
<SCRIPT LANGUAGE="JavaScript">
<!--
function countwin(no,id){
	window.open("/board/counter.php?no="+no+"&id="+id,"","left=200,top=50,height=200,width=300");
}
function chkall(){
	var cobj = document.getElementById('allchk');
	var obj = document.getElementsByName('chk[]');
	for(var i=0; i < obj.length ; i++){
		if (cobj.checked == true)
		{
			obj[i].checked = true;
		}else{
			obj[i].checked = false;
		}
	}

}
function allDel(){
	var fobj = document.frmdel;
	var obj = document.getElementsByName('chk[]');
	var k=0;
	for(var i=0; i < obj.length ; i++){
		if (obj[i].checked == true) {
			k++;
			break;
		}
	}

	if(k > 0){
		if(confirm("선택된 게시물들을 모두 삭제 하시겠습니까?")){
			fobj.action = "/board/alldel.php";
			fobj.submit();
		}
		return false;
	}else{
		alert("선택된 게시물이 없습니다.");
		return false;
	}
}
//-->
</SCRIPT>
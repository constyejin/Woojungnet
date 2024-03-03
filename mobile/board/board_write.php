<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";

if($no){
	$sql="select * from admin_table where a_name='$id'";
	$result=mysql_query($sql);
	$data=mysql_fetch_array($result);
	if($data[a_write_level]<$_SESSION[login_level]){
		exit;
	}
	$p_qry = "  select * from $id where no='$no' ";
	$p_res = mysql_query($p_qry) or die(mysql_error());
	$view = mysql_fetch_array($p_res);
	$ridx=0;
	$sub_mode="edit";
}else{
	$sub_mode="write";
}

?>
<script>
	function write_ok(){
		var f=document.writeForm;
		if(!f.subject.value){
			alert('제목을 입력 해주세요.');
			f.subject.focus();
			return;
		}
		if(!f.memo.value){
			alert('내용을 입력 해주세요.');
			return;
		}
		f.submit();
	}
</script>

  <div class="add-car">
    <section class="title-wrap">
      <h2>고객센터</h2>
    </section>
    <section class="tab-wrap wide-type">
      <ul>
        <li class="tab<?=$id=="notice"?' active':''?>">
          <a href="/board/board.php?id=notice">공지사항</a>
        </li>
        <li class="tab<?=$id=="qna"?' active':''?>">
          <a href="/board/board.php?id=qna">질문과답변</a>
        </li>
        <li class="tab<?=$id=="data"?' active':''?>">
          <a href="/board/board.php?id=data">자료실</a>
        </li>
        <li class="tab">
          <a href="/sub01/sub01_3.php?id=">1:1상담</a>
        </li>
      </ul>
    </section>
<form name='writeForm' method='POST' enctype="multipart/form-data" action="./write_ok.php" style="margin:0px;">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="mode" value="write">
	<input type="hidden" name="sub_mode" value="<?=$sub_mode?>">
	<input type="hidden" name="ridx" value="<?=$ridx?>">
	<input type="hidden" name="page" value="<?=$page?>">
	<input type="hidden" name="no" value="<?=$no?>">
    <section class="board-notice">
      <div class="board-notice-write">
        <div class="table-style">
          <ul>
            <li>
              <div class="th">이름</div>
              <div class="td">
                <div class="input-wrap">
                  <input type="text" value='<?if($view[name]){echo $view[name];}else{echo $_SESSION["login_name"];}?>' name='name'>
                </div>
              </div>
            </li>
            <li>
              <div class="th">제목</div>
              <div class="td">
                <div class="flex-type">
                  <div class="input-wrap">
                    <input type="text" name="subject">
                  </div>
                  <ul class="checkbox-group">
                    <li>
                      <div class="checkbox-wrap">
                        <input type="checkbox" name="" id="titleOption1">
                      </div>
                      <label for="titleOption1">공지</label>
                    </li>
                    <li>
                      <div class="checkbox-wrap">
                        <input type="checkbox" name="" id="titleOption2">
                      </div>
                      <label for="titleOption2">비밀글</label>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
          </ul>
        </div>

        <div class="editor">
          <!-- 에디터영역 -->
			<textarea name="memo" id="ir1" rows="10" cols="100" style="width:100%; height:320px;"><?=stripslashes($view[memo])?></textarea>
        </div>

        <div class="table-style">
          <ul>
            <li>
              <div class="th">파일</div>
              <div class="td">
                <input type="file">
              </div>
            </li>
            <li>
              <div class="th">파일</div>
              <div class="td">
                <input type="file">
              </div>
            </li>
          </ul>
        </div>

        <div class="btn-group align-c">
          <div class="center">
            <button type="button" class="btn btn-outline-red btn-sm btn-round" onclick="write_ok()">등록하기</button>
            <a href="javascript:history.back();" class="btn btn-outline-primary btn-sm btn-round">목록보기</a>
          </div>
        </div>
      </div>
    </section>
	</form>
  </div>

  
<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>
</html>
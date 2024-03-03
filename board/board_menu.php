<?if($id=="buy"||$id=="sale"){?>
<!-- sub menu start -->
<div class="con_left_menu">
	<ul>
		<li><img src="/images/img_sub6_menu_title.gif"></li>
		<li class="s_left_tbl">
			<ul>
				<li><a href="board.php?id=sale"><span class="s_menu_txt">팝니다</span></a></li>
				<li><a href="board.php?id=buy"><span class="s_menu_txt">삽니다</span></a></li>
			</ul>
		</li>
		<li class="s_left_bot"></li>
	</ul>
</div>
<?}else if($id=="dbuy"||$id=="dsale"){?>
<!-- sub menu start -->
<div class="con_left_menu">
	<ul>
		<li><img src="/images/img_sub11_menu_title.gif"></li>
		<li class="s_left_tbl">
			<ul>
				<li><a href="board.php?id=dsale"><span class="s_menu_txt">팝니다</span></a></li>
				<li><a href="board.php?id=dbuy"><span class="s_menu_txt">삽니다</span></a></li>
			</ul>
		</li>
		<li class="s_left_bot"></li>
	</ul>
</div>
<?}else{?>
<!-- sub menu start -->
<div class="con_left_menu">
	<ul>
		<li><img src="/images/img_sub7_menu_title.gif"></li>
		<li class="s_left_tbl">
			<ul>
				<li><a href="board.php?id=notice"><span class="s_menu_txt">공지사항</span></a></li>
				<li><a href="board.php?id=qna"><span class="s_menu_txt">질문과답변</span></a></li>
				<li><a href="board.php?id=news"><span class="s_menu_txt">자동차소식</span></a></li>
				<li><a href="board.php?id=free"><span class="s_menu_txt">자유게시판</span></a></li>
			</ul>
		</li>
		<li class="s_left_bot"></li>
	</ul>
</div>
<?}?>
<!-- sub menu end -->
<?include "../inc/cs.php";?>

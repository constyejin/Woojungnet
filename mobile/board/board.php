<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/header.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/menu.php";

function cut_str($text, $num)
{
	$subject = mb_substr($text, 0, $num, 'utf-8');
	if ($subject != $text) $subject .= "..";
	return $subject;
}

if (!$id) $id = "notice";
$sql = "select * from admin_table where a_name='$id'";
$result = mysql_query($sql);
$data = mysql_fetch_array($result);
?>
<script>
function allDel() {
    var fobj = document.frmdel;
    var obj = document.getElementsByName('chk[]');
    var k = 0;
    for (var i = 0; i < obj.length; i++) {
        if (obj[i].checked == true) {
            k++;
            break;
        }
    }

    if (k > 0) {
        if (confirm("선택된 게시물들을 모두 삭제 하시겠습니까?")) {
            fobj.action = "/board/alldel.php";
            fobj.submit();
        }
        return false;
    } else {
        alert("선택된 게시물이 없습니다.");
        return false;
    }
}

function allcancel() {
    var obj = document.getElementsByName('chk[]');
    for (var i = 0; i < obj.length; i++) {
        obj[i].checked = false;
    }
}
</script>

<form name="frmdel" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="add-car">
        <section class="title-wrap">
            <h2>고객센터</h2>
        </section>
        <section class="tab-wrap wide-type">
            <ul>
                <li class="tab<?= $id == "notice" ? ' active' : '' ?>">
                    <a href="/board/board.php?id=notice">공지사항</a>
                </li>
                <li class="tab<?= $id == "qna" ? ' active' : '' ?>">
                    <a href="/board/board.php?id=qna">질문과답변</a>
                </li>
                <li class="tab<?= $id == "data" ? ' active' : '' ?>">
                    <a href="/board/board.php?id=data">자료실</a>
                </li>
                <li class="tab">
                    <a href="/sub01/sub01_3.php?id=">1:1상담</a>
                </li>
            </ul>
        </section>
        <section class="board-notice">
            <div class="board-notice-list">
                <ul>
                    <?

					if (!$page) $page = 1; //초기 페이지 설정
					$nperpage = 10 - $notice_cnt;
					$nperblock = 10;

					$sql = "  select * from $id where bdiv='0' and notice!='Y' $where";
					$result = mysql_query($sql);
					$trecord = mysql_num_rows($result);
					$tpage = ceil($trecord / $nperpage); //전체페이지
					// 출력 레코드 범위
					if ($trecord == 0) {
						$first = 1;
						$last = 0;
					} else {
						$first = $nperpage * ($page - 1);
						$last = $nperpage * $page;
					}
					$p_qry = "  select * from $id where bdiv='0' and notice!='Y' $where ORDER by list desc,ridx asc LIMIT $first, $nperpage";
					$p_res = mysql_query($p_qry) or die(mysql_error());
					$num_row = mysql_num_rows($p_res);

					$article_num = $trecord - $nperpage * ($page - 1); //가상번호 설정
					// 각 페이지로 직접 이동할 수 있는 페이지 링크에 대한 설정을 한다.
					$tblock = ceil($tpage / $nperblock);
					$block = ceil($page / $nperblock);
					$first_page = ($block - 1) * $nperblock;
					$last_page = $block * $nperblock;
					if ($tblock <= $block) {
						$last_page = $tpage;
					}
					$i = 1;
					while ($list = mysql_fetch_array($p_res)) {
						$d_no = $list["no"]; //게시물고유번호
						$d_memo = $list["memo"]; //내용
						$d_name = $list["name"]; //작성자
						$d_subject = $list["subject"]; //제목
						$d_pwd = $list["pwd"]; //비밀번호
						$d_date = $list["date"]; //time()값
						$d_ref = $list["ref"]; //조회
						$d_list = $list["list"]; //게시물등록순서 / 등록시 max(no)+1
						$d_level = $list["level"]; // 0 - 원글 / 1 - 답글
						$d_ridx = $list["ridx"]; // 0 - 원글 / 1 - 답글
						$d_email = $list["email"]; // 이메일
						$d_userno = $list["midx"]; // 0 - ? / 2 - ?
						$d_html = $list["html"]; //html구분
						$d_security = $list["security"]; //비밀설정 Y,N
						$d_notice = $list["notice"]; //공지사항설정 Y,N
						$d_files = $list["files"];
						$d_files2 = $list["files2"];

						$subject = cut_str(strip_tags($d_subject), 30);

						$newdate = time() - 60 * 60 * 24 * 1;
						if ($newdate < $d_date) $outnew = "&nbsp; <img src='/board/img/ico_new.gif' border=0 style='vertical-align:middle'>";
						else $outnew = "";
						if ($d_security == "Y") {
							$icon_sec = "<img src='/board/img/secret.gif' border='0'>";
							if ($u_admin) {
								$passed = "";
							} elseif ($cookie_user_no == $d_userno) {
								$passed = "";
							} else {
								$passed = "pwview";
							}
						} else {
							$icon_sec = "";
							$passed = "";
						}
						$number = $article_num--;
						if ($d_ridx == 1) {
							$reply_gubun = " &nbsp;<img src='" . $skinDir . "img/re.gif' border=0 style='vertical-align:middle'> ";
						} else {
							$reply_gubun = "";
						}

						if ($d_files) {
							$dfiles = "<img src='/board/img/ico_file.gif' border='0'>";
						} else {
							$dfiles = "";
						}

						$qry_board = "select * from admin_table where a_name='$id' ";
						$res_board = mysql_query($qry_board) or die(mysql_error());
						$data_board = mysql_fetch_array($res_board);
					?>
                    <li>
                        <div class="td-check">
                            <div class="checkbox-wrap">
                                <? if ($_SESSION[login_level] <= 3) { ?>
                                <input type="checkbox" name='chk[]' value="<?= $d_no ?>">
                                <? } ?>
                            </div>
                        </div>
                        <div class="td">
                            <a href="./board_view.php?id=<?= $id ?>&no=<?= $d_no ?>" class="title"><?= $subject ?></a>
                            <div class="content-info">
                                <span class="name"><?= cut_str($d_name, 7) ?></span>
                                <span class="date"><?= date("Y-m-d", $d_date) ?></span>
                                <span class="read">조회 <?= $d_ref ?></span>
                            </div>
                        </div>
                    </li>
                    <?
						$i++;
					}
					?>

                    <div class="btn-group" style="margin-top:10px; padding:0">
                        <div class="prefix" style="transform:scale(0.8)">
                            <? if ($_SESSION[login_level] <= 3) { ?>
                            <button type="button" class="btn btn-outline-dark btn-sm btn-round"
                                onclick="allDel()">선택삭제</button>

                            <? } ?>
                        </div>
                        <div class="suffix" style="transform:scale(0.8)">
                            <?
							if ($data[a_write_level] >= $_SESSION[login_level]) {
							?>
                            <a href="./board_write.php?id=<?= $id ?>"
                                class="btn btn-outline-red btn-sm btn-round">글쓰기</a>
                            <?
							}
							?>
                        </div>
                    </div>
                    <div class="pagination">
                        <div class="prev-wrap">
                            <? list_number(); ?>

                        </div>
                    </div>
            </div>
        </section>
    </div>
</form>


<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/footer.php";
?>
<?
function list_number()
{

	global $page, $qcommon, $first_page, $nperblock, $direct_page, $block, $last_page, $tblock, $tpage;

	// 첫번째 블록에 대한 링크
	if ($block > 1 && $tblock > 2) {
		echo "<a href=\"$PHP_SELF?$qcommon&page=1\" class=\"first disabled\">&lt;&lt;</a>";
	}


	// 이전블록에 대한 링크
	if ($block > 1) {
		$imsi = $page;
		$page = $first_page;
		echo "<a href=\"$PHP_SELF?$qcommon&page=$page\" class=\"prev disabled\">&lt;</a>";
		$page = $imsi;
	}

	echo '</div>
          <ul class="pages">
            <li>';

	// 페이지이동(블록내)

	for ($direct_page = $first_page + 1; $direct_page <= $last_page; $direct_page++) {
		if ($page == $direct_page) {
			echo "<a href=\"#\" class=\"current\">$direct_page</a>";
		} else {
			echo "<a href=\"$PHP_SELF?$qcommon&page=$direct_page\">$direct_page</a>";
		}
	}
	//$list_bottom=str_replace("[number]",$tmp_list_bottom,$list_bottom);


	echo '</li>
          </ul>
          <div class="next-wrap">';

	// 다음블록에 대한 링크

	if ($block < $tblock) {
		$page = $last_page + 1;
		echo "<a href=\"$PHP_SELF?$qcommon&page=$page\" class=\"next\">&gt;</a>";
	}

	//마지막 블록에 대한 링크
	if ($block < $tblock && $tblock > 2) {
		$final_page = ($tblock * 10) - 9;
		echo "&nbsp;&nbsp;&nbsp;<a href=\"$PHP_SELF?$qcommon&page=$final_page\" class=\"last\">>&gt;>&gt;</a>";
	}
}
?>
</body>

</html>
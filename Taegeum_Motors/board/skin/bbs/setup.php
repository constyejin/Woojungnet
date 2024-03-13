<?
/* ------- 스킨 설정 ------------------------------------ */
$skin_copy_right = "<a href='http://www.designboard.net' target='_blank'>designboard</a>";

// 입력 처리후 이동 페이지
// '1' : list
// '2' : view
// '3' : insert
$write_move_page = "2";

// 검색어 색상
$search_start_tag = '<font color="#BF0909">';
$search_end_tag   = '</font>';

// 의견글 수 태그
$tot_comment_start_tag = ' <font face="tahoma" size="1"> [';
$tot_comment_end_tag   = ']</font>';

// 최근에 올라온 의견글에대한 표시
$new_comment_tag       = ' <font color="#FF0000">+</font>';

// 폼메일 팝업 창 크기
$mail_popup_width       = 500; // 폼 메일 팝업 가로 길이
$mail_popup_height      = 533; // 폼 메일 팝업 세로 높이

// mode : '1' : 로그인 성공 메시지 출력
//        '2' : 로그인후 윈도우 닫기
//        '3' : 로그 아웃 스킨 표시 ( 기본 값 )
//        '4' : 현재 페이지
$member_login_mode                  = '2';
$member_login_succ_url              = '' ; // 성공 URL
$member_login_popup_width           = 210; // 팝업 가로 길이
$member_login_popup_height          = 167; // 팝업 세로 높이
$member_login_scroll_yn             = 'N'; // 팝업 스크롤바 생성 여부 ( 'Y', 'N' )

//회원 가입
// mode : '1' : 팝업   회원 가입 페이지 열기
//        '2' : 현재창 회원 가입 페이지 열기
$member_register_mode               = '2';
$member_register_succ_url           = '' ; // 성공 URL
$member_register_popup_width        = 616; // 팝업 가로 길이
$member_register_popup_height       = 550; // 팝업 세로 높이
$member_register_scroll_yn          = 'Y'; // 팝업 스크롤바 생성 여부 ( 'Y', 'N' )

//회원 수정
// mode : '1' : 팝업   회원 수정 페이지 열기
//        '2' : 현재창 회원 수정 페이지 열기
$member_update_mode                 = '1';
$member_update_succ_url             = '' ; // 성공 URL
$member_update_popup_width          = 616; // 팝업 가로 길이
$member_update_popup_height         = 550; // 팝업 세로 높이
$member_update_scroll_yn            = 'Y'; // 팝업 스크롤바 생성 여부 ( 'Y', 'N' )

//회원 탈퇴
// mode : '1' : 팝업   회원 탈퇴 페이지 열기
//        '2' : 현재창 회원 탈퇴 페이지 열기
$member_secession_mode              = '1';
$member_secession_succ_url          = '' ; // 성공 URL
$member_secession_popup_width       = 400; // 팝업 가로 길이
$member_secession_popup_height      = 205; // 팝업 세로 높이
$member_secession_scroll_yn         = 'N'; // 팝업 스크롤바 생성 여부 ( 'Y', 'N' )

//회원 비밀 번호 발송
// mode : '1' : 팝업   회원 비밀 번호 발송 페이지 열기
//        '2' : 현재창 회원 비밀 번호 발송 페이지 열기
$member_infor_search_mode           = '1';
$member_infor_search_succ_url       = '' ; // 성공 URL
$member_infor_search_popup_width    = 500; // 팝업 가로 길이
$member_infor_search_popup_height   = 193; // 팝업 세로 높이
$member_infor_search_scroll_yn      = 'N'; // 팝업 스크롤바 생성 여부 ( 'Y', 'N' )

//회원 보기
// mode : '1' : 팝업   회원 가입 페이지 열기
//        '2' : 현재창 회원 가입 페이지 열기
$member_view_mode               = '1';
$member_view_succ_url           = '' ; // 성공 URL
$member_view_popup_width        = 537; // 팝업 가로 길이
$member_view_popup_height       = 575; // 팝업 세로 높이
$member_view_scroll_yn          = 'Y'; // 팝업 스크롤바 생성 여부 ( 'Y', 'N' )

// 어드민 리스트 상자 스타일
$admin_list_box_script = 'style="font-face:굴림;font-size:12px;background:#F7F7F7"';

// 텍스트 길이 제한
$name_limit            = 12   ; // 이름 타이틀 길이 맞추기
$name_cut_tag          = ' ..'; // 이름 줄임 이후 표시 문자 [리스트 화면만 적용]

$title_cut_tag         = '...'; // 제목 줄임 이후 표시 문자
$content_cut_tag       = '...'; // 내용 줄임 이후 표시 문자

$list_cursor_tag       = '<img src="' . $skinDir . 'images/arrow.gif">'; // 현재 읽고 있는 자료의 위치

/* -------------------- 이미지 관련 설정 -------------------- */
$image_auto_load_yn      = 'Y';  // 보기 페이지 이미지 자동 표시 여부 ( 'Y' / 'N' )

// _image_display_mode
// 1 : 화면에 이미지 크기 자동 조절
// 2 : _image_width, _image_height 값으로 이미지 크기 조절
$list_image_display_mode        = '2'     ;  // 목록
$view_image_display_mode        = '1'     ;  // 보기

$list_width_many                = 2       ;  // 가로 갯수

$list_image_width               = '100'   ;  // 목록 페이지 이미지 넓이
$list_image_height              = '100'      ;  // 목록 페이지 이미지 높이
$view_image_width               = '500'      ;  // 보기 페이지 이미지 넓이
$view_image_height              = '200'      ;  // 보기 페이지 이미지 높이

// _image_display_mode
// 1 : 화면에 이미지 크기 자동 조절
// 2 : _image_width, _image_height 값에 의한 크기 조절
// 3 : popup_width, popup_height로 창을 열고 popup_image_width, popup_image_height 이미지 크기 조절
$popup_image_display_mode       = '1'     ;  // 팝업
$popup_image_width              = '500'   ;  // 팝업 페이지 이미지 넓이
$popup_image_height             = '400'   ;  // 팝업 페이지 이미지 높이

$popup_width                    = '700'   ;  // 팝업 넓이
$popup_height                   = '500'   ;  // 팝업 높이

// 이미지 팝업시 기본적으로 이미지 크기에 맞추어 팝업을 띄우게 됩니다.
// 스킨을 변경하였을경우 다른 디자인적인 요소들이 반영되었을경우.
// 넓이나 높이가 더 늘어났을경우를 가만하여 이부분에 픽셀 단위의 크기를 지정하면 됩니다.
$image_popup_plus_width         = '0'     ; // 이미지 팝업시 이미지 크기 기준으로 추가될 넓이
$image_popup_plus_height        = '0'     ; // 이미지 팝업시 이미지 높이 기준으로 추가될 높이

/* -------------------- 멀티 미디어 관련 설정 -------------------- */
$mutimedia_auto_play_yn         = 'Y'     ; // 보기 멀티미디어 자동 표시 여부 ( 'Y' / 'N' )

$mutimedia_player_show          = 'Y'     ; // Player 표시 여부
$mutimedia_player_autostart     = 'Y'     ; // Player 자동 재생 여부
$mutimedia_player_loop          = 'Y'     ; // Player 순환 여부
$mutimedia_player_width         = ''      ; // Player 음악조절판 넓이
$mutimedia_player_height        = ''      ; // Player 음악조절판 높이

$mutimedia_popup_width          = '400'   ; // 팝업 넓이
$mutimedia_popup_height         = '400'   ; // 팝업 높이

$mutimedia_popup_player_width   = ''      ; // 팝업 Player 음악조절판 넓이
$mutimedia_popup_player_height  = ''      ; // 팝업 Player 음악조절판 높이

$member_layer_box_use           = 'Y'     ;  // 사용 안함 : 'N', 사용 : 'Y'
$member_layer_box_event         = 'click' ;  // 클릭 : 'click', 오버 : 'mouseover'

/* 페이지 탭 설정 */
// $page_tab['pre'              ] = "[이전 $page_many]";
// $page_tab['next'             ] = "[이후 $page_many]";
$page_tab['pre'              ] = '<span class="text_03"><font size="1">◀</font></span><span class="text_02"> 이전</span> <font color=CCCCCC>ㅣ</font> '; // 이전
$page_tab['next'             ] = '<span class="text_02">다음</span> <span class="text_03"><font size="1">▶</font>'; // 이후
$page_tab['pre_1'            ] = ""      ; // 이전
$page_tab['next_1'           ] = ""      ; // 이후

$page_tab['page_sep'         ] = ""      ; // 페이지구분 기호
$page_tab['page_start'       ] = ""    ; // 페이지 표시 시작 [1] <<-- [
$page_tab['page_end'         ] = " <font color=CCCCCC>ㅣ</font> "    ; // 페이지 표시 끝   [1] <<-- ]
$page_tab['page_pre'         ] = ""      ; // 페이지 앞 [*여기* 1]
$page_tab['page_next'        ] = ""      ; // 페이지 뒤 [1 *여기*]
$page_tab['page_start_active'] = "<b><font color=806A1F>"   ; // 선택 페이지 앞쪽 태그
$page_tab['page_end_active'  ] = "</b></font> <font color=CCCCCC>ㅣ</font> "  ; // 선택 페이지 뒷쪽 태그
?>
<table width="<?=$table_width?>" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td colspan='2' height="5"></td></tr>

<td valign=top>
<table border="0" cellspacing="0" cellpadding="0">
<tr>

<?=$hide_category_s     ?>
<form method='POST' onSubmit='return searchFormSubmit(this);'>
<td>
<?
    /* 카테고리 설정 */
    $category_setup['title'             ]   = "카테고리";
    $category_setup['item_align'        ]   = ""        ; // 카테고리 항목 정렬 방식 ( left(기본) / right )
    $category_setup['script'            ]   = "onChange='searchFormSubmit(this.form);this.form.submit();'"  ; // 스크립트
    $category_setup['properties'        ]   = "class=admin_listbox"        ; // 카테고리 html 속성
    $category_setup['start_tag'         ]   = ""        ; // 카테고리 맨 처음 태그
    $category_setup['loop_start_tag'    ]   = ""        ; // 카테고리 항목 처음   태그
    $category_setup['loop_end_tag'      ]   = ""        ; // 카테고리 항목 마지막 태그
    $category_setup['end_tag'           ]   = ""        ; // 카테고리 맨 마지막 태그
    $category_setup['active_start_tag'  ]   = "<B>"     ; // 카테고리 선택 항목 처음   태그
    $category_setup['active_end_tag'    ]   = "</B>"    ; // 카테고리 선택 항목 마지막 태그
/* A 태그를 이용한 클릭시 검색  */
//  $category_setup['script'            ]   = "onClick='document.PageForm.search_cat_no.value=this.value;document.PageForm.submit();'"  ; // 스크립트
//  $category_setup['properties'        ]   = "href='#' "; // 카테고리 html 속성

/* 체크   상자 검색             */
//  $category_setup['script'            ]   = "onMouseUp='searchFormSubmit(this.form);this.form.submit();'"  ; // 스크립트

/* 라디오 상자 검색             */
//  $category_setup['script'            ]   = "onClick='searchFormSubmit(this.form);this.form.submit();'"  ; // 스크립트

/* 리스트 상자 검색             */
//  $category_setup['script'            ]   = "onChange='searchFormSubmit(this.form);this.form.submit();'"  ; // 스크립트
?>
    <?=createCategory ('S','SELECT')?>
</td>
</form>
<td width=5></td>
<?=$hide_category_e     ?>

<?=$show_admin_yn_s?>
<td>
<? /* 관리자 게시물 관리 설정 */ ?>
            <?=$admin_bbs_list_box   ?> <?// 게시판 정보 리스트 상자?>
            <?=$a_bbs_data_copy  ?><img src="<?=$skinDir?>images/admin_copy.gif"   border='0' align='absmiddle' width=37 height=18></a> <?// 게시물 복사 버튼       ?>
            <?=$a_bbs_data_delete?><img src="<?=$skinDir?>images/admin_delete.gif" border='0' align='absmiddle' width=37 height=18></a> <?// 게시물 삭제 버튼       ?>
<? /* ------------------------------------------------------------ */ ?>
</td>
<?=$show_admin_yn_e?>
</tr>
</table>

<?=$hide_area_s?>
<?=$a_bbs_data_move  ?><img src="<?=$skinDir?>images/admin_move.gif"   border='0' align='absmiddle'></a>
<?// 게시물 이동 버튼       ?>
        </td>
<?=$hide_area_e?>

<td></td>
<td align='right' class='text_01'>
<?=$show_admin_yn_s?>
<a href="admin_board.php?branch=setup&gubun=&no=<?=$bbsInfor['no']?>" target='_new'><img src="<?=$skinDir?>images/button_top_setup.gif" border=0 width=49 height=18>
<?=$show_admin_yn_e?><?=$a_login?><img src="<?=$skinDir?>images/button_top_login.gif" border=0 width=49 height=18></a><?=$a_logout?><img src="<?=$skinDir?>images/button_top_logout.gif" border=0></a> <?=$a_member_register?><img src="<?=$skinDir?>images/button_top_join.gif" border=0 width=49 height=18></a><?=$a_member_update?><img src="<?=$skinDir?>images/button_top_modify.gif" border=0 width=49 height=18></a>

</td>
</tr>
</table>
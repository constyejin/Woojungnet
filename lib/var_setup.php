<?
  if ($_var_setup) return;
  $_var_setup=true;

  $result=mysql_query("select * from js_webconfig where no='1'") or die (mysql_error());
  $setup=mysql_fetch_array($result);

  $shop_name = $setup[shop_name]; //회사이름
  $owner_name = $setup[owner_name]; //대표자이름
  $office_num = $setup[office_num]; //사업자등록번호
  $address = $setup[address]; //주소
  $webmaster = $setup[webmaster]; //개인정보관리자
  $milagepoint = $setup[milagepoint]; //마일리지 % 값(10000원팔면 300원 마일리지로 적립시킨다는 뜻)
  $transport = $setup[transport]; //배송비
  $jeju = $setup[jeju]; //배송지가 제주도일경우 배송비 추가 항공요금 설정(제주도에서사면 5500원이 추가된다는 뜻)
  $average_m = $setup[average_m]; //배송비 추가 기준(3만원미만이면 배송비가 추가된다는 뜻)
  $use_milage = $setup[use_milage];//마일리지 사용할수있는 최소 적립포인트(1만원이 되면 물건을 살수 있다는 뜻)
  $join_milage = $setup[join_milage];//회원가입시 적립되는 마일리지
  $tel_num=$setup[tel_num];
  $fax_num = $setup[fax_num]; //팩스 번호
  $com_num = $setup[com_num]; //회사 번호
  $milage_statu = $setup[milage_statu]; // 마일리지 결제 허용여부 Y는 허용, N불허
  $admin_email  = $setup[admin_email ]; //관리자 이메일
  $webmaster_mail = $setup[webmaster_mail]; //관리자2 이메일
  $chg_milage=$setup[chg_milage]; // 무료 -> 가용 (변경비율)
  $can_milage=$setup[can_milage]; //마일리지 사용제한
  $inload1=$setup[inload_1];
  $inload2=$setup[inload_2];
  $inload3=$setup[inload_3];
  $inload4=$setup[inload_4];
  $inload5=$setup[inload_5];
  $inload6=$setup[inload_6];
  $tekup1=$setup[w_tekup1];
  $tekup2=$setup[w_tekup2];
  $tekup3=$setup[w_tekup3];
  $tekup4=$setup[w_tekup4];
  $tekup5=$setup[w_tekup5];
  $tekup6=$setup[w_tekup6];
  $tekup7=$setup[w_tekup7];
  $tekup8=$setup[w_tekup8];
  $tekup9=$setup[w_tekup9];
  $tekup10=$setup[w_tekup10];
  $tekup11=$setup[w_tekup11];
  $tekup12=$setup[w_tekup12];
  $tekup13=$setup[w_tekup13];
  $tekup14=$setup[w_tekup14];
  $tekup15=$setup[w_tekup15];
  $tekup16=$setup[w_tekup16];
  $tekup17=$setup[w_tekup17];
  $tekup18=$setup[w_tekup18];
  $tekup19=$setup[w_tekup19];
  $tekup20=$setup[w_tekup20];
  $pmil=$setup[milageper];
  $pmil=$pmil/100;
  $meach=$setup[meach]; //마일리지 각각(false) 전체(true) 설정
  if ($setup[b2b]==0) { $b2bs="<!--"; $b2be="-->";} //b2b체크
  $login_point=$setup[login_point]; //로그인 포인트설정
  $setup[MLevel]=array("","관리자","","관리자","","","B2B","","","일반회원");
  $setup[MemType]=array("쇼핑몰운영자","오프라인(매장)판매자","개인리셀러");

  $join_level=9;

  $conf[UserOrderStep]=array("B2B대기","B2B승인","일반회원");
  $conf[UserOrderStep2]=array("B2B대기","B2B승인");
  $conf[UserOrderStepOut]=array("<font color='#285100'>B2B대기</font>","<font color='#046A9B'>B2B승인</font>");  

#######################################################
$setup[point][detail]=array("","입금예정","입금완료","배송중","휴지통","반품/취소","상품준비중","거래완료","구입사용","로그인포인트");

?>
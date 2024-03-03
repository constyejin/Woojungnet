<?
	include"../inc/Func.php";
	$connect = dbconn();
?>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/common/css/base.css?v=221208"/>

	<link rel="stylesheet" type="text/css" href="/common/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="/common/css/add_style.css?v=2212081209"/>  <!-- 2022.11.25 css추가  -->
	<link rel="stylesheet" type="text/css" href="/common/css/incaron_style.css"/>  <!-- 2022.11.25 css추가  -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	
	<!-- swiper.js css-->
	<link
		rel="stylesheet"
		href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
	/>
	<!-- swiper.js js-->
	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <script src="/common/js/incaron_ui.js"></script>
  <script src="/common/js/front.js"></script>
</head>
<?
	
	$tb_name = "woojung_member";

	$sql = "SELECT * FROM recruit WHERE code = 'branch00'";	
	$com_row = Row_string($sql);

	if($Mode == "newpass"){
		$tb_name = "woojung_member";		
		$Mode = substr($Mode, 0, 4);

		$SQL = "Select * From $tb_name Where  idx = ".$_SESSION["login_user_no"]."";		
		$MemInfo = Row_string($SQL);
		

		if( trim($MemInfo[userPw]) != trim($yuserPw) ){
			MsgMov("현재 비밀번호가 일치하지 않습니다.","newpass.php");
			exit;
		}

		$query="update $tb_name SET userPw='$u_pw2', pw_mod_date=now() Where  idx = '".$_SESSION["login_user_no"]."'";
		mysql_query($query)or die(mysql_error());
		MsgMov("비밀번호가 변경 되었습니다. ","/");

		exit;
	}
	
	
	#주민등록번호 확인 함수
	function jumin_check($jumin1, $jumin2){	
		
		global $connect;
		$query = "SELECT * FROM woojung_member WHERE ssn='{$jumin1}-{$jumin2}'";		
		
		$result = mysql_query($query, $connect);
		while($arr = mysql_fetch_array($result)){
			$tmp = explode("-",$arr[ssn]);
			if($jumin1 == $tmp[0] && $jumin2 == $tmp[1]){
				return $IsJumin = 1;
			} 
		}		
		return $IsJumin = 0;		
	}
	
	//$res = jumin_check($ssn1, $ssn2);
	$res = 0; // 주민번호 없어졌음 0으로 픽스함

if($userId && $userPw1){


	#일반 회원 가입일때
	if($Mode == "indi"){
		if($res == 1){
			err_msg("이미 가입된 주민등록 번호 입니다. 다시 확인해 주세요");
		} else {
			if($ssn1) $ssn = $ssn1."-".$ssn2;
			$email = $email1."@".$email2;
			if(trim($tel1))$tel = $tel1."-".$tel2."-".$tel3;
			if(trim($pcs1))$pcs = $pcs1."-".$pcs2."-".$pcs3;
			if(trim($company_tel1))$company_tel = $company_tel1."-".$company_tel2."-".$company_tel3;
			if(trim($fax1))$fax  = $fax1."-".$fax2."-".$fax3;

			$query  = "INSERT INTO $tb_name (";
			$query .= "userId, userPw, userNick, name, ssn, email, post1, post2, addr1, addr2, tel, pcs, company_tel, fax, emailSend, grade, usort, rdate,mdate,reco_id,code,company,pw_mod_date)";
			$query .= " VALUES ";
			$query .="('$userId','$userPw1','$userNick2','$user_name2','$ssn','$email','$zipcode','$zipcode2','$address','$address_ext', '$tel','$pcs','$company_tel','$fax','$emailSend','c','$Mode',now(),now(),'$reco_id','$com_row[code]','$com_row[company]',now())";
			
			$result = mysql_query($query, $connect);
			if(!$result){
				die(mysql_error());
			}
			$loginId = $userId;
			$loginPw = $userPw1;
			$loginName = $user_name2;
			$loginNick = $userNick2;		
			$loginUsort = $Mode;
			$grade = "c";
			$loginGrade = "c";

			
		$_SESSION["cookie_user_no"]=$cookie_user_no;
		$_SESSION["loginIdx"]=$loginIdx;
		$_SESSION["loginId"]=$loginId;
		$_SESSION["loginPw"]=$loginPw;
		$_SESSION["loginName"]=$loginName;
		$_SESSION["loginNick"]=$loginNick;
		$_SESSION["loginGrade"]=$loginGrade;
		$_SESSION["loginUsort"]=$loginUsort;
			
			$_SESSION["login_id"]=$loginId;
			$_SESSION["login_name"]=$loginName;
			$_SESSION["login_level"]=$login_level;
			$_SESSION["login_user_no"]=$cookie_user_no;
			$_SESSION["user_company"]=$com_row[company];

		echo "
			<script>
				alert('회원가입 되었습니다.');
				parent.location.href='/';
			</script>
		";
		exit;
		}
	}
	
	#제휴 회원 가입일때
	if($Mode == "company"){
	
		//$res = jumin_check($ssn1, $ssn2);
		
		//if($res == 1){
		//	err_msg("이미 가입된 주민등록 번호 입니다. 다시 확인해 주세요");
		//} else {
			//if($ssn1) $ssn = $ssn1."-".$ssn2;
			$email = $email1."@".$email2;
			if($tel1) $tel = $tel1."-".$tel2."-".$tel3;
			if($pcs1) $pcs = $pcs1."-".$pcs2."-".$pcs3;
			if($company_tel1) $company_tel = $company_tel1."-".$company_tel2."-".$company_tel3;
			if($fax1) $fax = $fax1."-".$fax2."-".$fax3;
			$tmp = explode("|",$team_name);
			$team_code = $tmp[1];
			$team_name = $tmp[0];

			$query  = "INSERT INTO $tb_name (";
			$query .= "userId, userPw, userNick, name, email, post1, post2, addr1, addr2, company_tel, tel, pcs, fax, company_name, team_code,team_name, team_subname, team_subname_etc, emailSend, grade, usort, rdate,mdate,reco_id,code,company,pw_mod_date)";
			$query .= " VALUES ";
			$query .="('$userId','$userPw1','$userNick2','$user_name2','$email','$zipcode','$zipcode2','$address','$address_ext'  ,'$company_tel','$tel','$pcs','$fax','$company_name','$team_code','$team_name','$team_subname','$team_subname_etc','$emailSend','a','company1',now(),now(),'$reco_id','$com_row[code]','$com_row[company]',now())";
			
			$result = mysql_query($query, $connect)or die($query);
			if(!$result){
				die(mysql_error());
			}
			
			$loginId = $userId;
			$loginPw = $userPw1;
			$loginName = $user_name2;
			$loginNick = $userNick2;		
			$loginUsort = "company1";
			$grade = "a";
			$loginGrade = "a";

		$_SESSION["cookie_user_no"]=$cookie_user_no;
		$_SESSION["loginIdx"]=$loginIdx;
		$_SESSION["loginId"]=$loginId;
		$_SESSION["loginPw"]=$loginPw;
		$_SESSION["loginName"]=$loginName;
		$_SESSION["loginNick"]=$loginNick;
		$_SESSION["loginGrade"]=$loginGrade;
		$_SESSION["loginUsort"]=$loginUsort;

			$_SESSION["login_id"]=$loginId;
			$_SESSION["login_name"]=$loginName;
			$_SESSION["login_level"]=$login_level;
			$_SESSION["login_user_no"]=$cookie_user_no;
		$_SESSION["company_name"]=$pw[company_name];
			
		echo "
			<script>
				alert('제휴 회원가입 되었습니다.');
				parent.location.href='/sub02/sub02_1.php';
			</script>
		";
		exit;
		//}
	}
	
	
	
	#프리미엄 회원 가입일 경우
	#a는 우대 b는 일반 c는 대기
	if($Mode == "premium"){

		//$res = jumin_check($ssn1, $ssn2);
		if($res == 1){
			err_msg("이미 가입된 주민등록 번호 입니다. 다시 확인해 주세요");
		} else {

			if($ssn1) $ssn = $ssn1."-".$ssn2;
			$email = $email1;
			if($tel1) $tel = $tel1."-".$tel2."-".$tel3;
			if($pcs1) $pcs = $pcs1."-".$pcs2."-".$pcs3;
			if($company_tel1) $company_tel = $company_tel1."-".$company_tel2."-".$company_tel3;
			if($fax1) $fax = $fax1."-".$fax2."-".$fax3;
			if($company_no1) $company_no = $company_no1."-".$company_no2."-".$company_no3;
			if($ceo_ssn1) $ceo_ssn = $ceo_ssn1."-".$ceo_ssn2;			
			$company_post = $czipcode;
			
			$query  = "INSERT INTO $tb_name (";
			$query .= "userId, userPw, userNick, name, ssn, ceo_name, ceo_ssn, company_email, email, post1, post2, addr1, addr2, company_post, company_addr1, company_addr2, company_tel, tel, pcs, fax, company_name, company_no, company_sort,company_subsort, emailSend, grade, usort, rdate,mdate,reco_id,code,company,upjong,pw_mod_date)";
			$query .= " VALUES ";
			$query .="('$userId','$userPw1','$userNick2','$user_name2','$ssn','$ceo_name','$ceo_ssn','$company_email','$email','$zipcode','$zipcode2','$address','$address_ext', '$company_post', '$caddress', '$caddress_ext' ,'$company_tel','$tel','$pcs','$fax','$company_name','$company_no','$company_sort','$company_subsort','$emailSend','c','premium1',now(),now(),'$reco_id','$com_row[code]','$com_row[company]','$upjong',now())";
			
			

			$result = mysql_query($query, $connect);
			if(!$result){
				die(mysql_error());
			}
			
			$loginId = $userId;
			$loginPw = $userPw1;
			$loginName = $user_name2;
			$loginNick = $userNick2;		
			$loginUsort = "premium1";

			$loginGrade = "c";

			$grade = "c";
			
		$_SESSION["cookie_user_no"]=$cookie_user_no;
		$_SESSION["loginIdx"]=$loginIdx;
		$_SESSION["loginId"]=$loginId;
		$_SESSION["loginPw"]=$loginPw;
		$_SESSION["loginName"]=$loginName;
		$_SESSION["loginNick"]=$loginNick;
		$_SESSION["loginGrade"]=$loginGrade;
		$_SESSION["loginUsort"]=$loginUsort;

			$_SESSION["login_id"]=$loginId;
			$_SESSION["login_name"]=$loginName;
			$_SESSION["login_level"]=$login_level;
			$_SESSION["login_user_no"]=$cookie_user_no;
			$_SESSION["user_company"]=$com_row[company];

			
		echo "
			<script>
				alert('회원가입 되었습니다. 입찰 회원은 관리자 승인을 기다려주세요!!');
				parent.location.href='/';
			</script>
		";
		exit;
		}

		
		

	}
?>


<form name="frmRegMail" method="post" action="/mail/mail_regist_ok.php">
	<input type="hidden" name="receiver_email" style="width:80%" class="minput" value="<?=$email?>">
	<input type="hidden" name="subject" style="width:80%" class="minput" value="<?=$loginName?>님 회원가입을 축하드립니다.">
	<textarea name="messages" class='mtextarea' style="width:0;height:0">
		<br>
		<table align=center width=430 height=229 border=0 cellpadding=0 cellspacing=0>
		  <tr>
			<td width=430>
			
			<table cellspacing=0 cellpadding=3 border=0>
			<td height=16 colspan=4 width=320><?=$com_row[company]?>에 회원가입을 해주시어 감사를 드립니다.</td>
			</table>

			  <table width=435 cellpadding=3 cellspacing=0 border=0>
		  <td height=33 width=427><?=$com_row[company]?>는 자동차컨설팅전문기업으로 고객만족을 위해 노력할것입니다.</td>
			  </table>

			  <table width=307 height=17 cellpadding=3 cellspacing=0 border=0>
		  <td height=16 width=305>항상 노력하는 <?=$com_row[company]?>을 자주 이용하여 주십시요.</td>
			  </table>
			  </td>
		  </tr>
		  <tr>
			<td height=57>
			
			<table border=0 width=305 height=39 cellpadding=0 cellspacing=0>
				<td height=16 width=307>회원가입시 등록된 내용입니다.</td>
			</table>
			
			</td>
		  </tr>

		  <tr>
			<td height=91   align=center>

			<table width=400 height=63 align=center border=0 cellpadding=5 cellspacing=0>
			  <tr>
				<td width=110 align=right><b>아이디 :</b> </td>
				<td width=390><?=$loginId?></td>
			  </tr>
			  <tr>
				<td align=right><b>비밀번호 :</b> </td>
				<td><?=$loginPw?></td>
			  </tr>
			</table>
			
			</td>
		  </tr>
		</table>	
	</textarea>
</form>


<script language='javascript'>
	document.frmRegMail.submit();
</script>

<?
}
?>
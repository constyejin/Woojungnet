<?
	include"../inc/Func.php";
	$connect = dbconn();
?>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SKRCAUTO 서울경기종합폐차장(주)</title>
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
	$Mode = substr($Mode, 0, 4);

	$SQL = "Select userPw From $tb_name Where  idx = ".$idx."";		
	$MemInfo = Row_string($SQL);
	

	if( trim($MemInfo[userPw]) != trim($yuserPw) ){
		MsgMov("기존 비밀번호가 일치하지 않습니다.","njoin.php");
		exit;
	}



	#관리자, 최고관리자
		if($Mode == "admi" || $Mode == "supe"){
				
			$ssn = $ssn1."-".$ssn2;
			$email = $email1;
			$tel = $tel1."-".$tel2."-".$tel3;
			$pcs = $pcs1."-".$pcs2."-".$pcs3;
			$company_no = $company_no1."-".$company_no2."-".$company_no3;
			$ceo_ssn = $ceo_ssn1."-".$ceo_ssn2;
			$company_tel = $company_tel1."-".$company_tel2."-".$company_tel3;
			$company_post = $czipcode;
			$fax = $fax1."-".$fax2."-".$fax3;

			$query  = " update  $tb_name SET ";

			if($userPw1 && $userPw2){
				$query  .=  " userPw = '".$userPw1."' , ";
				$query  .=  " pw_mod_date = now() , ";
			}

			$query  .=  " email = '".$email."' , 
							name='$user_name2', 
							ssn = '".$ssn."' , 
							userNick = '".$userNick2."' , 
							post1 = '".$zipcode1."' , 
							post2 = '".$zipcode2."' , 
							addr1 = '".$address."' , 
							addr2 = '".$address_ext."' , 
							tel = '".$tel."' , 
							pcs = '".$pcs."' , 
							fax = '".$fax."' , 

							ceo_name= '".$ceo_name."' , 

							company_post = '".$company_post."' ,
							company_addr1 = '".$caddress."' ,
							company_addr2 = '".$caddress_ext."' ,
							company_tel = '".$company_tel."' ,
							ceo_ssn = '".$ceo_ssn."' ,
							company_name = '".$company_name."' , 
							company_no = '".$company_no."' , 
							company_sort = '".$company_sort."' , 
							company_subsort = '".$company_subsort."' , 
							upjong = '".$upjong."' , 


							emailSend = '".$emailSend."' , 
							grade = 'c' , 													
							mdate = now(),
							reco_id = '$reco_id'
						Where idx = ".$idx." and   userPw = '".$yuserPw."'
					  ";

		
			$result = mysql_query($query, $connect);
			if(!$result){				
				die(mysql_error());
				exit;
			}
					
			
			MsgMov("수정되었습니다.","sub07.php");
		
	}


	#일반 회원 가입일때
	if($Mode == "indi"){
				
			$ssn = $ssn1."-".$ssn2;
			$email = $email1;
			$tel = $tel1."-".$tel2."-".$tel3;
			$pcs = $pcs1."-".$pcs2."-".$pcs3;
			$company_tel = $company_tel1."-".$company_tel2."-".$company_tel3;
			$fax = $fax1."-".$fax2."-".$fax3;
/*
			$query  = "INSERT INTO $tb_name (";
			$query .= "userId, userPw, userNick, name, ssn, email, post1, post2, addr1, addr2, tel, pcs, emailSend, grade, usort, rdate,mdate)";
			$query .= " VALUES ";
			$query .="('$userId','$userPw1','$userNick2','$user_name2','$ssn','$email','$zipcode1','$zipcode2','$address','$address_ext',
						'$tel','$pcs','$emailSend','c','$Mode',now(),now())";
			//echo $query;
*/

			$query  = " update  $tb_name SET ";

			if($userPw1 && $userPw2){
				$query  .=  " userPw = '".$userPw1."' , ";
				$query  .=  " pw_mod_date = now() , ";
			}

			$query  .=  " email = '".$email."' ,
							name='$user_name2', 
							ssn = '".$ssn."' , 
							userNick = '".$userNick2."' , 
							post1 = '".$zipcode."' , 
							post2 = '".$zipcode2."' , 
							addr1 = '".$address."' , 
							addr2 = '".$address_ext."' , 
							tel = '".$tel."' , 
							pcs = '".$pcs."' , 
							fax = '".$fax."' , 
							company_tel = '".$company_tel."' , 
							emailSend = '".$emailSend."' , 
							grade = 'c' , 
							usort = '".$Mode."' , 							
							mdate = now(),
							reco_id = '$reco_id'
						Where idx = ".$idx." and   userPw = '".$yuserPw."'
					  ";

		
			$result = mysql_query($query, $connect);
			if(!$result){				
				die(mysql_error());
				exit;
			}
					
			
			MsgMov("수정되었습니다.","sub07.php");
		
	}
	
	#제휴 회원 가입일때
	if($Mode == "comp"){
		
			$ssn = $ssn1."-".$ssn2;
			$email = $email1;
			$tel = $tel1."-".$tel2."-".$tel3;
			$pcs = $pcs1."-".$pcs2."-".$pcs3;
			$company_tel = $company_tel1."-".$company_tel2."-".$company_tel3;
			$fax = $fax1."-".$fax2."-".$fax3;
			$tmp = explode("|",$team_name);
			$team_code = $tmp[1];
			$team_name = $tmp[0];


/*
			$query  = "INSERT INTO $tb_name (";
			$query .= "userId, userPw, userNick, name, ssn, email, post1, post2, addr1, addr2, company_tel, tel, pcs, fax, company_name, team_code,team_name, team_subname, emailSend, grade, usort, rdate,mdate)";
			$query .= " VALUES ";
			$query .="('$userId','$userPw1','$userNick2','$user_name2','$ssn','$email','$zipcode1','$zipcode2','$address','$address_ext'  ,'$company_tel','$tel','$pcs','$fax','$company_name','$team_code','$team_name','$team_subname','$emailSend','a','company1',now(),now())";
			//echo $query;
*/


		$query  = " update  $tb_name SET ";

			if($userPw1 && $userPw2){
				$query  .=  " userPw = '".$userPw1."' , ";
				$query  .=  " pw_mod_date = now() , ";
			}

			$query  .=  " email = '".$email."' , 
							name='$user_name2', 
							post1 = '".$zipcode1."' , 
							post2 = '".$zipcode2."' , 
							addr1 = '".$address."' , 
							addr2 = '".$address_ext."' , 
							tel = '".$tel."' , 
							pcs = '".$pcs."' , 							
							ssn = '".$ssn."' , 
							fax = '".$fax."' , 
							company_tel = '".$company_tel."' , 
							company_name = '".$company_name."' , 
							team_code = '".$team_code."' , 
							team_name = '".$team_name."' , 
							team_subname = '".$team_subname."' , 

							emailSend = '".$emailSend."' , 
														
							mdate = now(),
							reco_id = '$reco_id'
						Where idx = ".$idx." and   userPw = '".$yuserPw."'
					  ";
				
				//grade = 'a' , 
				//usort = 'company1' , 

			

			$result = mysql_query($query, $connect);
			if(!$result){
				die(mysql_error());
			}
			
	
			
			MsgMov("수정되었습니다.","sub07.php");
		
	}
	
	
	
	#프리미엄 회원 가입일 경우
	#a는 우대 b는 일반 c는 대기
	if($Mode == "prem" || $Mode == "jisa"){
		

			$ssn = $ssn1."-".$ssn2;
			$email = $email1;
			$tel = $tel1."-".$tel2."-".$tel3;
			$pcs = $pcs1."-".$pcs2."-".$pcs3;
			$company_no = $company_no1."-".$company_no2."-".$company_no3;
			$ceo_ssn = $ceo_ssn1."-".$ceo_ssn2;
			$company_tel = $company_tel1."-".$company_tel2."-".$company_tel3;
			$company_post = $czipcode;
			$fax = $fax1."-".$fax2."-".$fax3;
			$query  = "INSERT INTO $tb_name (";
			$query .= "userId, userPw, userNick, name, ssn, ceo_name, company_email, email, post1, post2, addr1, addr2, company_post, company_addr1, company_addr2, company_tel, tel, pcs, fax, company_name, company_no, company_sort,company_subsort, emailSend, grade, usort, rdate,mdate,reco_id)";
			$query .= " VALUES ";
			$query .="('$userId','$userPw1','$userNick2','$user_name2','$ssn','$ceo_name','$company_email','$email','$zipcode1','$zipcode2','$address','$address_ext', '$company_post', '$company_addr1', '$company_addr2' ,'$company_tel','$tel','$pcs','$fax','$company_name','$company_no','$company_sort','$company_subsort','$emailSend','c','premium1',now(),now(),'$reco_id')";
			
			//echo $query."<br>";



			$query  = " update  $tb_name SET ";

			if($userPw1 && $userPw2){
				$query  .=  " userPw = '".$userPw1."' , ";
				$query  .=  " pw_mod_date = now() , ";
			}

			$query  .=  " email = '".$email."' , 
							name='$user_name2', 
							userNick = '".$userNick2."' ,			
							post1 = '".$zipcode1."' , 
							post2 = '".$zipcode2."' , 
							addr1 = '".$address."' , 
							addr2 = '".$address_ext."' , 
							ssn = '".$ssn."' , 
							ceo_name= '".$ceo_name."' , 

							company_post = '".$company_post."' ,
							company_addr1 = '".$caddress."' ,
							company_addr2 = '".$caddress_ext."' ,
							company_tel = '".$company_tel."' ,
							ceo_ssn = '".$ceo_ssn."' ,
							upjong = '".$upjong."' , 
							

							tel = '".$tel."' , 
							pcs = '".$pcs."' , 
							fax = '".$fax."' , 

							company_name = '".$company_name."' , 
							company_no = '".$company_no."' , 
							company_sort = '".$company_sort."' , 
							company_subsort = '".$company_subsort."' , 


							emailSend = '".$emailSend."' , 
														
							mdate = now(),
							reco_id = '$reco_id' 
						Where idx = ".$idx." and   userPw = '".$yuserPw."'
					  ";

				
							//grade = 'c' , 
							//usort = 'premium1' , 



			$result = mysql_query($query, $connect);
			if(!$result){
				die(mysql_error());
			}
			
		
			MsgMov("수정되었습니다.","sub07.php");
		
	}
?>
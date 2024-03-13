<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	

	if($Mode == 'member_delete'){
	
		if(!$check){MsgMov("선택된 회원이 없습니다.","Member_list.php?$href");exit;}
		for($i=0;$i<count($check);$i++){
			Query_string("DELETE FROM woojung_member WHERE idx = '$check[$i]'");
		}
		
		MsgMov("회원 삭제 되었습니다.","Member_list.php?$href");
	}
	
	if($Mode == 'Modify'){
	
		$ssn = $ssn1."-".$ssn2;
		$email = $email1."@".$email2;
		$tel = $tel1."-".$tel2."-".$tel3;
		$pcs = $pcs1."-".$pcs2."-".$pcs3;
		$company_no = $company_no1."-".$company_no2."-".$company_no3;
		$ceo_ssn = $ceo_ssn1."-".$ceo_ssn2;
		$company_tel = $company_tel1."-".$company_tel2."-".$company_tel3;
		$company_post = $czipcode;
		$fax = $fax1."-".$fax2."-".$fax3;
		$tmp = explode("|",$team_name); $team_code = $tmp[1]; $team_name = $tmp[0];


		
		if(!$mdate && (strpos($row[usort], 'premiu') !== true)  ){
			$req_date = date("Y-m-d");
			$pre_rdate = date("Y-m-d");
		}else{			
			$req_date = $mdate;
			$pre_rdate = $mdate;			
		}

		$eyy = substr($req_date, 0,4);
		$emm = substr($req_date, 5,2);
		$edd = substr($req_date, 8,2);
		$end_date = date("Y-m-d", mktime(0, 0, 0, $emm+12, $edd-1, $eyy));


		//echo $_POST['company_name'];
		
		$query  = "UPDATE woojung_member SET";
		if($userPw)	$query .= " userPw = '$userPw',";
		$query .= " userNick = '$u_nicname',";		
		$query .= " ssn = '$ssn', ";
		$query .= " email = '$email', ";
		$query .= " post1 = '$zipcode',";
		$query .= " post2 = '$zipcode2',"; 
		$query .= " addr1 = '$address',";
		$query .= " addr2 = '$address_ext',";
		$query .= " tel = '$tel',";
		$query .= " pcs = '$pcs', ";
		$query .= " emailSend = '$emailSend', ";
		$query .= "	mdate = '$mdate', ";
		$query .= " usort = '$usort', ";
		$query .= " upjong = '$upjong', ";
		$query .= " code = '$code', ";
		$query .= " memo = '$memo', ";
		$query .= " power = '$power' ";
		

		if( $usort == 'company1' || $usort == 'company2'  ){
		
		# 제휴회원정보
		$query .= "	, company_name = '$company_name', ";
		$query .= "	team_code = '$team_code', ";
		$query .= "	team_name = '$team_name', ";
		$query .= "	team_subname = '$team_subname', ";
		$query .= "	company_tel = '$company_tel', ";
		$query .= "	fax = '$fax' ";


		}

		
		

		if( $usort == 'premium1' || $usort == 'premium2' || $usort == 'premium3' || $usort == 'premium4' ){
		
			#프리미엄 회원정보
			$query .= "	, fax = '$fax',  ";
			$query .= "	company_name = '$company_name', ";
			$query .= "	company_no = '$company_no', ";
			$query .= "	ceo_name = '$ceo_name', ";
			$query .= "	company_tel = '$company_tel', ";
			$query .= "	company_sort = '$company_sort', ";
			$query .= "	company_subsort = '$company_subsort', ";
			$query .= "	company_post = '$company_post', ";
			$query .= "	company_addr1 = '$caddress', ";
			$query .= " ceo_ssn = '$ceo_ssn', ";
			$query .= "	company_addr2 = '$caddress_ext' ";

		}

		if( $usort == 'jisajang' || $usort == 'jisajang2' ){
		
			#프리미엄 회원정보
			$query .= "	, fax = '$fax',  ";
			$query .= "	company_name = '$company_name', ";
			$query .= "	company_no = '$company_no', ";
			$query .= "	ceo_name = '$ceo_name', ";
			$query .= "	company_tel = '$company_tel', ";
			$query .= "	company_sort = '$company_sort', ";
			$query .= "	company_subsort = '$company_subsort', ";
			$query .= "	company_post = '$company_post', ";
			$query .= "	company_addr1 = '$caddress', ";
			$query .= " ceo_ssn = '$ceo_ssn', ";
			$query .= "	company_addr2 = '$caddress_ext' ";

		}

		
		if( strpos($usort , 'premium') !== false ){
			$query .= "	, pre_rdate  = '$pre_rdate', ";
			$query .= "	pre_mdate  = '$end_date' ";
		}
		
		if($reco_id){
			$query .= "	, reco_id  = '$reco_id' ";
		}
		
		$query .= "WHERE idx = '$No'";

		
	
		

//echo $query;		
		$result = mysql_query($query, $connect) or die(mysql_error());

		


		MsgMov("수정이 완료되었습니다.","modify.php?No=$No&$href");
		
	}
?>


<?include "../inc/header.php" ?>
<?
/*	if(!$loginId){
		echo "<script>alert('로그인후 사용 가능합니다.');history.back();</script>";
	}
*/
	if($loginUsort!="company2"&&$loginUsort!="premium2"&&$loginUsort!="jisajang"&&$loginUsort!="jisajang2"&&$loginUsort!="admin"&&$loginUsort!="superadmin"){
		echo "<script>alert('사용 권한이 없습니다.');history.back();</script>";
	}


	$tb_name = "woojung_car2";
	//echo $tb_name;
	$nowDate = date("Y-m-d");
	$YesterDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1, date("Y") ));

	
	$exstart_date = $start_date;
	//if(!$start_date) $exstart_date = $nowDate;
	//else $exstart_date = $start_date;

	$href = "&gubun2=$gubun2&gubun2=$gubun2&wc_made=$wc_made&wc_model=$wc_model&calltype=$calltype&sear4=$sear4"; 
	$href .= "&start_date=$start_date&end_date=$end_date&car_cate=$car_cate";
	$href1 = "&page=$page".$href;
	$where = " wc_mem_id='$loginId' ";


	#조회 버튼 입력시
	if($gubun1){  		 
		if($gubun1=="3"){
			$p=1;
			$where .= "";
		} else {
			$p = "";
			$where .= " and wc_gubun1  = '$gubun1'";
		}
	}


	if($wc_made){  		 
		$where .= " and wc_made  = '$wc_made'";  
	}
if($wc_model){  		 
		$where .= " and wc_model  = '$wc_model'";  
	}

	if($calltype){  		 
		$where .= " and calltype  = '$calltype'";  
	}  

	if($sear4){
		$where .= " and ( wc_no  like '%$sear4%' or wc_mem_name like '%$sear4%' or wc_model  like '%$sear4%') ";  	

	}

	if($car_cate){
		$where .= " and wc_prog_etc  = '$car_cate'";
	}

	if($start_date && $end_date){		
		$where .= " and substring(wc_regdate, 1, 10)  >= '$start_date' and substring(wc_regdate, 1, 10) <= '$end_date'";
	}
	if($start_date && !$end_date){
		$where .= " and substring(wc_regdate, 1, 10) >= '$start_date' ";
	}
	if(!$start_date && $end_date){
		$where .= " and substring(wc_regdate, 1, 10) <= '$end_date' ";
	}
	//echo $where;
	$query = "select count(*) from $tb_name where $where ";  
	//echo $query;
	$result = mysql_query($query);  
	//echo $result;
	$temp = mysql_fetch_array($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	
	
?>

<!-- 마이페이지독립 css -->
<style type="text/css">
.join_img_body { position:relative;  margin-top:40px; }
.join_area p {text-align:left; margin:10px 0;}
.join_img_body table.join_form tr th { background:#f7f7f7; border:1px solid #666666; font-weight:normal; }
.join_img_body table.join_form tr td { text-align:center; padding:2px 2px 2px 2px; color:#000000; border:1px solid #949294;}
input[type=text] { padding:1px 1px 1px 1px; border:1px solid #666666; height:17px; }
.join_img_body table.join_form tr td  table { padding:0; margin:0; }
.join_img_body table.join_form tr td  table tr td { padding:0; margin:0; border:none; padding:2px 2px 2px 2px; }
..join_area p.s_title { font-size:10pt; font-weight:bold; }
.style1 {font-weight: bold}
select.no{border:1px solid #666666;}
</style>
<script>
	function all_check(){
		var lng =  document.getElementsByName('check[]');
		if(document.f.allcheck.checked == true){
			for(i=0;i<lng.length;i++){
				lng[i].checked = true;
			}
		} else {
			for(i=0;i<lng.length;i++){
				lng[i].checked = false;
			}
		}
	}
	function delete_member(){
		

		var j=0;
		var obj = document.getElementsByName('check[]');
		for(var i=0;i < obj.length ; i++){
			if(obj[i].checked == true){
				j++;
				break;
			}
		}
		
		if(j == 0){
			alert("선택된 자료가 없습니다.");
			return;
		}

		result = confirm("한번 삭제하신 자료는 복구 불가능 합니다.\n\n(페차,손상,특수,낙찰대장,감정 등의 정보까지 모두 삭제 됨)   \n\n정말 삭제 하시겠습니까??");
		if(result){
			
			document.f.submit();
		}
		
	}
</script>


<div id="new_wrap">

	<div id="main_wrap">
		<div id="cha_contents">
			<!-- login -->
			<div id="con_left">
<?include "../inc/login.php";?>
				<!-- 좌측 서브 메뉴 start -->
<?include "mypage_menu.php";?>
				<!-- 좌측 서브 메뉴 end -->
			</div>
			<div id="con_right">
				<h1><img src="/images/img_sub1.jpg"></h1>
				<table width="760" border="0" cellspacing="0" cellpadding="0">
					<tr> 
						<td height="1"></td>
					</tr>
					<tr> 
						<td height="38" align="left" valign="bottom"><img src="/images/img_mypage_2_bar.gif" /></td>
					</tr>
				</table>	
			<!--컨텐츠 부분-->
            <div class="join_area">
				<div class="join_img_body">
                
<div class="join_area">
				
				<table width="730" border="0" cellSpacing="1" cellPadding="0">
			  <tbody>
						<tr style="cursor:pointer;" >
							<td bgColor="#ebebeb">
								<table width="100%" bgColor="#ffffff" border="0" cellSpacing="0" cellPadding="0">
										<tbody>
											<tr>
											  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <!--추가 에러-->
                                                <colgroup>
                                                <col width="*" />
                                                <col width="*" />
                                                </colgroup>
                                                 
                                                 <tr>
                                                 <td align="left">
<?if($user_level>=14){?>
												 <a href="/mypage/sub02_write.php" alt=""><img src="/images/in.jpg" /></a>
<?}?>
												 </td>
<form name="sear">
                                                  <td align="right"><span style="padding-right:3px">
			<select name="wc_made" onchange="document.sear.submit();" class="no">
              <option value="" >= 제조사 =</option>
              <?
			   $team_cate_sql=mysql_query("select * from cate2 where depth='1'");
			   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
              <option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$wc_made){ echo "selected"; }?>>
                <?=$team_cate["name"]?>
                </option>
              <?}?>
            </select>
			<select name="wc_model" onchange="document.sear.submit();" class="no">
              <option value="" >=== 모델명 ===</option>
              <?
			   if($wc_made){
			   $team_cate_sql=mysql_query("select * from cate2 where code='$wc_made' order by name asc");
			   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
              <option value="<?=$team_cate["name"]?>" <?if($team_cate["name"]==$wc_model){ echo "selected"; }?>>
                <?=$team_cate["name"]?>
                </option>
              <?}}?>
            </select>
          <select name="calltype" onchange="document.sear.submit();" class="no">
            <option value="" > 상태 </option>
            <option value="판매대기" <?if($calltype=="대기"){ echo "selected"; }?>>대기</option>
            <option value="판매중" <?if($calltype=="판매"){ echo "selected"; }?>>판매</option>
            <option value="판매완료" <?if($calltype=="완료"){ echo "selected"; }?>>완료</option>
           </option>
          </select> 
                                                  </span></td>
                                                  <!--td align="right">일자&nbsp;</td>
                                                  <td width="70" height="25" align="right"><input name="start_date" class="input" id="start_date" type="text" size="10"/></td>
                                                  <td width="20" align="center"><a onclick="Calendar(end_date);" href="javascript:;"> <img src="/images/icon_calendar.gif" border="0" /></a></td>
                                                  <td width="15" align="center">~</td>
                                                  <td width="70" align="right"><span class="style1">
                                      <input name="end_date" class="input" id="end_date" type="text" size="10"/></span></td>
                                            <td width="30" align="left"><a onclick="Calendar(end_date);" href="javascript:;">&nbsp;<img src="/images/icon_calendar.gif" border="0" /></a></td-->
                                            <td width="100" align="left"><span class="style1">
                                            <input name="sear4" class="input"  type="text" size="15" value="<?=$sear4?>"/></span></td>
                    <td width="50" align="center"><span class="style1">
                    <img src="/images/search.jpg" onclick="document.sear.submit();" style="cursor:pointer;"/></span></td>
   </form>
                                                </tr>
                                                 <tr>
                                                   <td height="7" colspan="10" align="right"></td>
                                                 </tr>
                                              </table>
	<form name="f" action="proc2.php" method="post">
        <input type="hidden" name="mode" value="delete">
        <input type="hidden" name="gubun4" value="<?=$gubun4?>">
        <input type="hidden" name="page" value="<?=$page?>">
    <table class="join_form" width="100%" border="0" cellspacing="0" cellpadding="5">
                                                      <!--추가 에러-->
<colgroup>
                                                      <col width="*" />
                                                      <col width="*" />
                                                      </colgroup>
                                                      <tr>
                                                        <th width="3%" height="30" align="center" ><input type="checkbox" name="allcheck" id="allcheck" onClick="all_check()" /></th>
                                                        <th width="5%" height="30" align="center" ><strong>no</strong></th>
                                                        <th width="12%" align="center" ><strong>접수번호</strong></th>
                                                        <th width="12%" align="center" ><strong>접수일자</strong></th>
                                                        <th width="14%" align="center" ><strong>차량번호</strong></th>
                                                        <th width="14%" align="center"><strong>모델명</strong></th>
                                                        <th width="14%" align="center"><strong>년식</strong></th>
                                                        <th width="14%" align="center"><strong>판매가격</strong></th>
                                                        <th width="12%" align="center"><strong>진행상태</strong></th>
                            </tr>
                                                    </table>
<table width="100%" border="0" cellpadding="5" cellspacing="0">

  <tr>
                                                        <th width="29" align="center" colspan="9"></th>
                            </tr>
<?

		 

if($total_article > 0){

	$Qry = "SELECT * FROM $tb_name WHERE $where order by wc_idx  desc LIMIT $start, $view_article";

	//echo $Qry;
	$arr = Fetch_string($Qry);
	
	
	for($i=0;$i<count($arr);$i++){

		$num = $total_article-$i-(($page-1)*$view_article);
		
		($i%2 == 0) ? $bgCol = "#ffffff" : $bgCol = "#ffffff";
			
			$zzim=mysql_fetch_row(mysql_query("select count(idx) from car_zzim where no='".$arr[$i][wc_idx]."'"));
			$bohum=mysql_fetch_array(mysql_query("select * from team_cate where idx='".$arr[$i][wc_prog_etc]."'"));
		  ?>
											  
          <tr align="center" bgcolor="<?=$bgCol?>" style="cursor: hand; padding:3 0 0 0;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''" > 
            <td width="3%" class="hand" ><input type="checkbox" name="check[]" id="check[]" value="<?=$arr[$i][wc_idx]?>" />
			<input type="hidden" name="checkout[]" id="checkout[]" value="<?=$arr[$i][wc_idx]?>" /></td>
            <td width="5%" height="25" onclick="location.href='sub02_view.php?idx=<?=$arr[$i][wc_idx]?>';">
              <?=$num?></td>
            <td width="12%" class="hand" onclick="location.href='sub02_view.php?idx=<?=$arr[$i][wc_idx]?>';" style="color:blue;"><?=$arr[$i][wc_orderno]?></td>
            <td width="12%" class="hand" onclick="location.href='sub02_view.php?idx=<?=$arr[$i][wc_idx]?>';"><?=substr( $arr[$i][wc_regdate], 0, 10)?></td>
            <td width="14%" class="hand" onclick="location.href='sub02_view.php?idx=<?=$arr[$i][wc_idx]?>';"><?=$arr[$i][wc_no]?></td>
            <td width="14%" class="hand" onclick="location.href='sub02_view.php?idx=<?=$arr[$i][wc_idx]?>';"><?=cutStr($arr[$i][wc_model], 0, 10)?>&nbsp;</td>
            <td width="14%" class="hand" onclick="location.href='sub02_view.php?idx=<?=$arr[$i][wc_idx]?>';"><?=substr($arr[$i][wc_age],0,4)?>년 <?=substr($arr[$i][wc_age],2,2)?>월</td>
       <td width="14%" class="hand" onclick="location.href='sub02_view.php?idx=<?=$arr[$i][wc_idx]?>';">
			<?=number_format($arr[$i][wc_price])?> 원</td>
            
			<td width="12%" valign="middle" class="hand" onclick="location.href='sub02_view.php?idx=<?=$arr[$i][wc_idx]?>';"><span style="padding-left:5px">
			  <?=$arr[$i][calltype]?></span></td>
            
			
			<?
				switch($arr[$i][wc_gubun4]){
				case "1" :
					$gubun_color = "#aa2321";
					break;
				case "2":
					$gubun_color = "green";
					break;
				case "3":
					$gubun_color = "hotpink";
					break;
				case "4":
					$gubun_color = "#234dcc";
					break;
				case "5":
					$gubun_color = "#00aa9c";
					break;
				case "6":
					$gubun_color = "#84a09c";
					break;
				case "7":
					$gubun_color = "#234d9c";
					break;
				default:
					$gubun_color = "#239dcc";
					break;
				}

			?>
          </tr>
         <tr>
         <td height="1" colspan="15" bgcolor="#d1d1d1"></td>
         </tr>
          <? }}?>
                                                </table>
                                              </td>
											</tr>
										</tbody>									
									</form>
								</table>
						  </td>
						</tr>
				  </tbody>
		  </table>
</form>
				
<br />
<br />
				<table width="730" border="0" cellspacing="0" cellpadding="0">
                  <tr align="center">
                    <td align="left"><input type="button" height="30" name="Submit" value=" 선택삭제 " style="cursor:pointer; background-color:#FFFFFF; color:#ff0000; border:#636563 1px solid; padding:20 10 10 10; font-weight:bold"  onclick="javascript:delete_member()" /></td>
                  </tr>
                  <tr align="center">
                    <td align="center"><? include "../inc/page.php";?></td>
                  </tr>
                </table>
<td height="25" align="center" vAlign="top">
					<tbody>
						<tr align="center" bgColor="#e6e6e6">
							
						</tr>
						
					</tbody>
				</table>

			</div>
</div></div>



			</div>
		</div>
	</div>
	<!-- footer -->
	<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>

</body>
</html>


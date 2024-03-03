<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';

	$tb_name = "admin_log_new";
	$view_article = 15; // 한화면에 나타날 게시물의 총 개수  
	if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
	$start = ($page-1)*$view_article; 

	$href="&start_date=$start_date&end_date=$end_date";

	$s_date = date("Y-m-d",strtotime(date("Y-m-d") . " -1 year"));
	//echo $s_date;

	$where = " regdate > '$s_date' and log_memo!='' ";

	if($start_date){$where.=" and regdate >='$start_date' ";}
	if($end_date){$where.=" and regdate <='".date("Y-m-d",strtotime($end_date . " +1 day"))."' ";}
	if($sear){$where.=" and ( wc_orderno like '%$sear%' or wc_carno like '%$sear%' or user_id like '%$sear%' or user_name like '%$sear%' ) ";}

	$query = "select count(*) from $tb_name where $where ";  

	
	$result = mysql_query($query, $connect);  
	$temp = mysql_fetch_array($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함

?>
<style>
  .table-topper{
    text-align:right;
    margin-bottom: 10px;
  }
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

		result = confirm("한번 삭제하신 자료는 복구 불가능 합니다. \n\n정말 삭제 하시겠습니까??");
		if(result){
			
			document.f.submit();
		}
		
	}

	function exl_down(){
		document.search.action="exldown2.php";
		document.search.submit();
		document.search.action="";
	}
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            //모든 datepicker에 대한 공통 옵션 설정
            $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd' //Input Display Format 변경
                ,showOtherMonths: true //빈 공간에 현재월의 앞뒤월의 날짜를 표시
                ,showMonthAfterYear:true //년도 먼저 나오고, 뒤에 월 표시
                ,changeYear: true //콤보박스에서 년 선택 가능
                ,changeMonth: true //콤보박스에서 월 선택 가능                
                ,showOn: "both" //button:버튼을 표시하고,버튼을 눌러야만 달력 표시 ^ both:버튼을 표시하고,버튼을 누르거나 input을 클릭하면 달력 표시  
                ,buttonImage: "/images/icon_data.gif" //버튼 이미지 경로
                ,buttonImageOnly: true //기본 버튼의 회색 부분을 없애고, 이미지만 보이게 함
                ,buttonText: "선택" //버튼에 마우스 갖다 댔을 때 표시되는 텍스트                
                ,yearSuffix: "년" //달력의 년도 부분 뒤에 붙는 텍스트
                ,monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'] //달력의 월 부분 텍스트
                ,monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'] //달력의 월 부분 Tooltip 텍스트
                ,dayNamesMin: ['일','월','화','수','목','금','토'] //달력의 요일 부분 텍스트
                ,dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'] //달력의 요일 부분 Tooltip 텍스트
                ,onSelect: function(dateText) {
                    // 변하는 내용이 있을 때 호출되는 함수이다.
                    if(this.id == "mdate"){
                        // 시작에서 선택한 날짜를 마지막의 처음 날짜로 설정한다.
                        var minDate = $(this).datepicker('getDate');
                        
                    }else if(this.id == "datePickEnd"){
                        // 마지막에서 선택한 날짜를 시작의 마지막 날짜로 설정한다.
                        var maxDate = $(this).datepicker('getDate');
                    }
                }                
            });
 
            //input을 datepicker로 선언
            $("#sdate").datepicker({
                                        changeMonth: false,
                                        changeYear: false
                                    });                    
            $("#edate").datepicker({
                                        changeMonth: false,
                                        changeYear: false
                                    });                    
        });
    </script>
<style>
/*datepicer 버튼 롤오버 시 손가락 모양 표시*/
.ui-datepicker-trigger{cursor: pointer;}
/*datepicer input 롤오버 시 손가락 모양 표시*/
.hasDatepicker{cursor: pointer;}
/*ui-datepicker-trigger에서 9px를 올려준 것은 이미지가 살짝 위로 올라가서 위치를 조정하기 위해서 */
.ui-datepicker-trigger{
    position:relative;
    top:6px;
}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="30" align="left" class="title"><img src="/manage/img/icon02.gif" class="bullet"> 
      작업진행현황</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">
<form name="search" method="get">
      <div class="table-topper">
	  <input name="sear" value="<?=$sear?>"><input type="submit" value="검색">
        <img src="../img/btnl_excel.gif" onclick="exl_down();" style="cursor:pointer;">
      </div>
</form>
      <table width="100%" border="0" cellspacing="1" cellpadding="0" style="word-break:break-all;" class="list-table-standard">
      <colgroup>
        <col style="width:80px"/>
        <col style="width:5%"/>
        <col style="min-width:10%"/>
        <col style="min-width:10%"/>
        <col style="min-width:10%"/>
        <col style="min-width:35%"/>
        <col style="min-width:10%"/>
        <col style="min-width:10%"/>
      </colgroup>
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
<form name="f" action="proc.php" method="post" target="HiddenFrm">
<input type="hidden" name="mode" value="delete">
      <tr align="center" class="sbtitle">
        <td class="table-th-dark" background="/admin/img/titlebg01.gif" >
		<? if($_SESSION["login_id"]=="drg1038"){ ?>
        <input type="checkbox" name="allcheck" id="allcheck" onclick="all_check()" />
		<? } ?>
		</td>
        <td class="table-th-dark">NO</td>
        <td class="table-th-dark">일시</td>
        <td class="table-th-dark">접수번호</td>
        <td class="table-th-dark">차량번호</td>
        <td class="table-th-dark">작업내용</td>
        <td class="table-th-dark">아이디</td>
        <td class="table-th-dark">이름</td>
        </tr>
<?
if($total_article > 0){

	$qry = "SELECT * FROM $tb_name WHERE $where order by idx desc LIMIT $start, $view_article";
	$arr = Fetch_string($qry);
	for($i=0;$i<count($arr);$i++){	
?>
      <tr align="center" bgcolor="<?=$bgCol?>" style="cursor: pointer; padding:3 0 0 0;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''" >
        <td bgcolor="<?=$bgCol?>" >
		<? if($_SESSION["login_id"]=="drg1038"){ ?>
		<input type="checkbox" name="check[]" id="check[]" value="<?=$arr[$i][idx]?>" />
		<? } ?>
		</td>
        <td height="25" bgcolor="<?=$bgCol?>"><?=$total_article-$i-(($page-1)*$view_article)?></td>
        <td bgcolor="<?=$bgCol?>" class="hand" ><?=$arr[$i][regdate]?></td>
        <td bgcolor="<?=$bgCol?>" class="hand" ><?=$arr[$i][wc_orderno]?></td>
        <td bgcolor="<?=$bgCol?>" class="hand" ><?=$arr[$i][wc_carno]?></td>
        <td bgcolor="<?=$bgCol?>" class="hand" ><?=$arr[$i][log_memo]?></td>
        <td bgcolor="<?=$bgCol?>" class="hand" ><?=$arr[$i][user_id]?></td>
        <td bgcolor="<?=$bgCol?>" class="hand" ><?=$arr[$i][user_name]?></td>
      </tr>
<?
	}
}
?>
</form>
      <!-- 반복되는 줄 끝 -->
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="padding-bottom:5px">
		<? if($_SESSION["login_id"]=="drg1038"){ ?>
		<input type="button" value="선택삭제" class="button44" onclick="javascript:delete_member()" style="cursor:pointer; background-color:#FFFFFF; border:1px #636563 solid; padding:5 3 3 3; font-weight:bold">
		<? } ?>
	</td>
  </tr>
  <tr>
    <td align="center"><? include "../../inc/page.php";?>
      &nbsp;</td>
  </tr>
</table>

<? include_once "../inc/footer.php";?>

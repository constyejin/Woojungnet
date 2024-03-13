<style type="text/css">
.thead {
height:26px; align:center;
border-left:1px solid #0070b1;  border-right:1px solid #0070b1;  border-bottom:1px solid #0070b1;  
border-top:2px solid #0070b1;  
background-color:#ebf3fb;
}
.th{align:center; font-weight:bold; color:#5a7eb1;}
.r_line{border-left:1px solid #c4d1da;}
  }
.in_c {vertical-align:middle;border:solid 0;}
</style>	


<style type="text/css">
#bbstable { border-collapse:collapse; margin-top:10px; }
#bbstable th {border-top:2px solid #000000;background-color:#EFEFEF; height:50px; text-align:center; font-size:16px; color: #666666;}
#bbstable th, #bbstable td {border-bottom:1px solid #D8D8D8; text-align:center; }
#bbstable td{ font-size: 15px;color: #000000;}
#bbstable td a{color: #000000}
#bbstable tr:hover td, #bbstable tr:hover td a{ color: #2279cb;}
#bbstable td.a_left {text-align:left; font-size:13px;}
input.sbutton {border:1px solid #D8D8D8; text-align:center; background-color:#D8D8D8;  line-height:none; height:25px;
					color:#000000; font-size:13px; padding:0px 3px; cursor:hand;}
.bbsbg{background-color:#e6d8c6;border:1px solid #8cb1d4; }
.Chk {width:13px; height:13px; margin-top:-3px;}
</style>






<form name="frmdel" method="post" >
			<table width="98%" border="0" cellpadding="4" cellspacing="0" id="bbstable">
            <col width="2%"></col>
            <col width="8%"></col>
            <col width="56%"></col>
            <col width="13%"></col>
            <col width="13%"></col>
            <col width="8%"></col>
            <tr height="50">
                <th class="left">
			<?if($_SESSION[login_level]<=3){?>
				<input type="checkbox" name='allchk' id='allchk' class="Chk" onclick='chkall()'/>
			<? } ?>
				</th>
                <th>번호</th>
                <th>제목</th>
                <th>이름</th>
                <th>등록일</th>
                <th class="right">조회</th>
            </tr>

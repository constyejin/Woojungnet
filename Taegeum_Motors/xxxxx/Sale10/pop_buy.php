<? include_once "../admin_setting.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
.btn-blue {
    cursor: pointer;
    background-color: #e7f1f9;
    color: #084573;
    border: #636563 1px solid;
}

.btn-pink {
    cursor: pointer;
    background-color: #fae3e3;
    color: #ff0000;
    border: #ff0000 1px solid;
}
</style>
<script language='javascript' src='../inc/Object.js'></script>
<script language="JavaScript" src="/inc/default.js"></script>
<link rel="stylesheet" href="/css/admin.css" type="text/css">
<link rel="stylesheet" href="/css/style.css" type="text/css">
<link rel="stylesheet" href="/common/css/adm_style.css">
<link rel="stylesheet" href="/common/css/admin_style.css">





<body>
    <br>
    <table width="950" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto">
        <tr>
            <td align="center" valign="top">
                <form name="cform" method=post action="/comm/comexc.php" target="HiddenFrm" style="margin:0px;"
                    onsubmit="document.cform.target='';document.cform.action='';">
                    <input type=hidden name=mode value=reg>
                    <input type=hidden name=pop value=1>
                    <input type=hidden name="page" value=<?= $page ?>>
                    <table width="100%" border="1" cellpadding="3" cellspacing="0" frame="border or box "
                        style="border-collapse:collapse; border-color:rgb(194, 194, 194);" class='pad_10'>
                        <tr>
                            <td colspan="8" class="p_tt"><b>신규거래처등록</b></td>
                        </tr>
                        <tr>
                            <td align="center" bgcolor="f3f3f3" class="p_tt">상호</td>
                            <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">전화번호</td>
                            <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">은행명</td>
                            <td width="18%" height="30" align="center" bgcolor="f3f3f3" class="p_tt">계좌번호</td>
                            <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">예금주</td>
                            <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">관리</td>
                        </tr>


                        <tr>
                            <td width="20%" height="30" align="center"><input type="text" class="ipip" name="company"
                                    size="20"></td>
                            <td width="23%" height="30" align="center">
                                <input type="text" class="ipip" name="phone1" size="3" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone2" size="4" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone3" size="4" maxlength="4">
                            </td>
                            <td width="12%" height="30" align="center"><input type="text" class="ipip" name="bankname"
                                    size="9"></td>
                            <td width="25%" align="center"><input type="text" class="ipip" name="banknum" size="30">
                            </td>
                            <td width="13%" height="30" align="center"><input type="text" class="ipip" name="bname"
                                    size="15"></td>
                            <td width="16%" height="30" align="center"><input type="button" id="button2" value="등록"
                                    class='btn-pink' onclick="document.cform.submit();" /></td>
                        </tr>
                    </table>
                    <br>
                    <table width="100%">
                        <tr>
                            <td height="6"></td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                        style="border-collapse:collapse; margin-bottom:10px">
                        <tr>
                            <td align="center" class="p_tt">
                                <input type="text" name="search" class="ipip" size="40" value="<?= $search ?>">
                                &nbsp;
                                <!-- <input type="submit" value="�˻�" onclick="document.location.href='/admin/pop_buy.php?page=<?= $page ?>&search=' + document.cform.search.value" style='width:50px;cursor:hand'/ > -->
                                <input type="submit" class='btn-blue' value="검색" style='width:50px;cursor:hand' />
                            </td>
                        </tr>

                    </table>


                    <table width="100%" border="1" cellpadding="3" cellspacing="0" frame="border or box "
                        style="border-collapse:collapse; border-color:rgb(194, 194, 194);" class='pad_10'>
                        <tr>
                            <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">선택</td>
                            <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">NO</td>
                            <td align="center" bgcolor="f3f3f3" class="p_tt">상호</td>
                            <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">전화번호</td>
                            <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">은행정보</td>
                            <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">관리</td>
                        </tr>

                        <!-- 샘플  10-->
                        <tr>
                            <td width="4%" height="40" align="center"><input type="button" id="button1" value="선택"
                                    class="btn-pink" style='width:50px;cursor:hand'
                                    onClick="funselect(<?= $data[idx] ?>,'<?= $data[company] ?>','<?= $data[phone] ?>','<?= $data[bankname] ?>','<?= $data[banknum] ?>','<?= $data[bname] ?>');" />
                            </td>
                            <td width="3%" height="30" align="center">
                                10</td>
                            <td width="17%" height="30" align="center"><input type="text" class="ipip"
                                    name="company<?= $i ?>" value="<?= $data[company] ?>" size="20"></td>
                            <td width="20%" height="30" align="center"> <input type="text" class="ipip"
                                    name="phone1<?= $i ?>" value="<?= $phone[0] ?>" size="3" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone2<?= $i ?>" value="<?= $phone[1] ?>" size="4"
                                    maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone3<?= $i ?>" value="<?= $phone[2] ?>" size="4"
                                    maxlength="4">
                            </td>
                            <td width="40%" height="30" align="center">
                                <input type="text" class="ipip" name="bankname<?= $i ?>" value="<?= $data[bankname] ?>"
                                    size="9"> /
                                <input type="text" class="ipip" name="banknum<?= $i ?>" value="<?= $data[banknum] ?>"
                                    size="22"> /
                                <input type="text" class="ipip" name="bname<?= $i ?>" value="<?= $data[bname] ?>"
                                    size="12">
                            </td>
                            <td width="10%" height="30" align="center">
                                <span
                                    onclick="subreg('/comm/comexc.php?mode=mod&pop=1&idx=<?= $data[idx] ?>&company='+ document.cform.company<?= $i ?>.value + '&phone1=' + document.cform.phone1<?= $i ?>.value + '&phone2=' +  document.cform.phone2<?= $i ?>.value + '&phone3=' + document.cform.phone3<?= $i ?>.value+ '&bankname=' + document.cform.bankname<?= $i ?>.value+ '&banknum=' + document.cform.banknum<?= $i ?>.value+ '&bname=' + document.cform.bname<?= $i ?>.value);"
                                    style="cursor:hand; ">수정</span>
                                <span style="margin:0 2px"> | </span>
                                <span
                                    onclick="document.HiddenFrm.location.href='/comm/comexc.php?mode=del&pop=1&idx=<?= $data[idx] ?>'"
                                    style="cursor:hand; ">삭제</span>
                            </td>
                        </tr>
                        <!-- 샘플  9-->
                        <tr>
                            <td width="4%" height="40" align="center"><input type="button" id="button1" value="선택"
                                    class="btn-pink" style='width:50px;cursor:hand'
                                    onClick="funselect(<?= $data[idx] ?>,'<?= $data[company] ?>','<?= $data[phone] ?>','<?= $data[bankname] ?>','<?= $data[banknum] ?>','<?= $data[bname] ?>');" />
                            </td>
                            <td width="3%" height="30" align="center">
                                9</td>
                            <td width="17%" height="30" align="center"><input type="text" class="ipip"
                                    name="company<?= $i ?>" value="<?= $data[company] ?>" size="20"></td>
                            <td width="20%" height="30" align="center"> <input type="text" class="ipip"
                                    name="phone1<?= $i ?>" value="<?= $phone[0] ?>" size="3" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone2<?= $i ?>" value="<?= $phone[1] ?>" size="4"
                                    maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone3<?= $i ?>" value="<?= $phone[2] ?>" size="4"
                                    maxlength="4">
                            </td>
                            <td width="40%" height="30" align="center">
                                <input type="text" class="ipip" name="bankname<?= $i ?>" value="<?= $data[bankname] ?>"
                                    size="9"> /
                                <input type="text" class="ipip" name="banknum<?= $i ?>" value="<?= $data[banknum] ?>"
                                    size="22"> /
                                <input type="text" class="ipip" name="bname<?= $i ?>" value="<?= $data[bname] ?>"
                                    size="12">
                            </td>
                            <td width="10%" height="30" align="center">
                                <span
                                    onclick="subreg('/comm/comexc.php?mode=mod&pop=1&idx=<?= $data[idx] ?>&company='+ document.cform.company<?= $i ?>.value + '&phone1=' + document.cform.phone1<?= $i ?>.value + '&phone2=' +  document.cform.phone2<?= $i ?>.value + '&phone3=' + document.cform.phone3<?= $i ?>.value+ '&bankname=' + document.cform.bankname<?= $i ?>.value+ '&banknum=' + document.cform.banknum<?= $i ?>.value+ '&bname=' + document.cform.bname<?= $i ?>.value);"
                                    style="cursor:hand; ">수정</span>
                                <span style="margin:0 2px"> | </span>
                                <span
                                    onclick="document.HiddenFrm.location.href='/comm/comexc.php?mode=del&pop=1&idx=<?= $data[idx] ?>'"
                                    style="cursor:hand; ">삭제</span>
                            </td>
                        </tr>
                        <!-- 샘플  8-->
                        <tr>
                            <td width="4%" height="40" align="center"><input type="button" id="button1" value="선택"
                                    class="btn-pink" style='width:50px;cursor:hand'
                                    onClick="funselect(<?= $data[idx] ?>,'<?= $data[company] ?>','<?= $data[phone] ?>','<?= $data[bankname] ?>','<?= $data[banknum] ?>','<?= $data[bname] ?>');" />
                            </td>
                            <td width="3%" height="30" align="center">
                                8</td>
                            <td width="17%" height="30" align="center"><input type="text" class="ipip"
                                    name="company<?= $i ?>" value="<?= $data[company] ?>" size="20"></td>
                            <td width="20%" height="30" align="center"> <input type="text" class="ipip"
                                    name="phone1<?= $i ?>" value="<?= $phone[0] ?>" size="3" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone2<?= $i ?>" value="<?= $phone[1] ?>" size="4"
                                    maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone3<?= $i ?>" value="<?= $phone[2] ?>" size="4"
                                    maxlength="4">
                            </td>
                            <td width="40%" height="30" align="center">
                                <input type="text" class="ipip" name="bankname<?= $i ?>" value="<?= $data[bankname] ?>"
                                    size="9"> /
                                <input type="text" class="ipip" name="banknum<?= $i ?>" value="<?= $data[banknum] ?>"
                                    size="22"> /
                                <input type="text" class="ipip" name="bname<?= $i ?>" value="<?= $data[bname] ?>"
                                    size="12">
                            </td>
                            <td width="10%" height="30" align="center">
                                <span
                                    onclick="subreg('/comm/comexc.php?mode=mod&pop=1&idx=<?= $data[idx] ?>&company='+ document.cform.company<?= $i ?>.value + '&phone1=' + document.cform.phone1<?= $i ?>.value + '&phone2=' +  document.cform.phone2<?= $i ?>.value + '&phone3=' + document.cform.phone3<?= $i ?>.value+ '&bankname=' + document.cform.bankname<?= $i ?>.value+ '&banknum=' + document.cform.banknum<?= $i ?>.value+ '&bname=' + document.cform.bname<?= $i ?>.value);"
                                    style="cursor:hand; ">수정</span>
                                <span style="margin:0 2px"> | </span>
                                <span
                                    onclick="document.HiddenFrm.location.href='/comm/comexc.php?mode=del&pop=1&idx=<?= $data[idx] ?>'"
                                    style="cursor:hand; ">삭제</span>
                            </td>
                        </tr>
                        <!-- 샘플  7-->
                        <tr>
                            <td width="4%" height="40" align="center"><input type="button" id="button1" value="선택"
                                    class="btn-pink" style='width:50px;cursor:hand'
                                    onClick="funselect(<?= $data[idx] ?>,'<?= $data[company] ?>','<?= $data[phone] ?>','<?= $data[bankname] ?>','<?= $data[banknum] ?>','<?= $data[bname] ?>');" />
                            </td>
                            <td width="3%" height="30" align="center">
                                7</td>
                            <td width="17%" height="30" align="center"><input type="text" class="ipip"
                                    name="company<?= $i ?>" value="<?= $data[company] ?>" size="20"></td>
                            <td width="20%" height="30" align="center"> <input type="text" class="ipip"
                                    name="phone1<?= $i ?>" value="<?= $phone[0] ?>" size="3" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone2<?= $i ?>" value="<?= $phone[1] ?>" size="4"
                                    maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone3<?= $i ?>" value="<?= $phone[2] ?>" size="4"
                                    maxlength="4">
                            </td>
                            <td width="40%" height="30" align="center">
                                <input type="text" class="ipip" name="bankname<?= $i ?>" value="<?= $data[bankname] ?>"
                                    size="9"> /
                                <input type="text" class="ipip" name="banknum<?= $i ?>" value="<?= $data[banknum] ?>"
                                    size="22"> /
                                <input type="text" class="ipip" name="bname<?= $i ?>" value="<?= $data[bname] ?>"
                                    size="12">
                            </td>
                            <td width="10%" height="30" align="center">
                                <span
                                    onclick="subreg('/comm/comexc.php?mode=mod&pop=1&idx=<?= $data[idx] ?>&company='+ document.cform.company<?= $i ?>.value + '&phone1=' + document.cform.phone1<?= $i ?>.value + '&phone2=' +  document.cform.phone2<?= $i ?>.value + '&phone3=' + document.cform.phone3<?= $i ?>.value+ '&bankname=' + document.cform.bankname<?= $i ?>.value+ '&banknum=' + document.cform.banknum<?= $i ?>.value+ '&bname=' + document.cform.bname<?= $i ?>.value);"
                                    style="cursor:hand; ">수정</span>
                                <span style="margin:0 2px"> | </span>
                                <span
                                    onclick="document.HiddenFrm.location.href='/comm/comexc.php?mode=del&pop=1&idx=<?= $data[idx] ?>'"
                                    style="cursor:hand; ">삭제</span>
                            </td>
                        </tr>
                        <!-- 샘플  6-->
                        <tr>
                            <td width="4%" height="40" align="center"><input type="button" id="button1" value="선택"
                                    class="btn-pink" style='width:50px;cursor:hand'
                                    onClick="funselect(<?= $data[idx] ?>,'<?= $data[company] ?>','<?= $data[phone] ?>','<?= $data[bankname] ?>','<?= $data[banknum] ?>','<?= $data[bname] ?>');" />
                            </td>
                            <td width="3%" height="30" align="center">
                                6</td>
                            <td width="17%" height="30" align="center"><input type="text" class="ipip"
                                    name="company<?= $i ?>" value="<?= $data[company] ?>" size="20"></td>
                            <td width="20%" height="30" align="center"> <input type="text" class="ipip"
                                    name="phone1<?= $i ?>" value="<?= $phone[0] ?>" size="3" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone2<?= $i ?>" value="<?= $phone[1] ?>" size="4"
                                    maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone3<?= $i ?>" value="<?= $phone[2] ?>" size="4"
                                    maxlength="4">
                            </td>
                            <td width="40%" height="30" align="center">
                                <input type="text" class="ipip" name="bankname<?= $i ?>" value="<?= $data[bankname] ?>"
                                    size="9"> /
                                <input type="text" class="ipip" name="banknum<?= $i ?>" value="<?= $data[banknum] ?>"
                                    size="22"> /
                                <input type="text" class="ipip" name="bname<?= $i ?>" value="<?= $data[bname] ?>"
                                    size="12">
                            </td>
                            <td width="10%" height="30" align="center">
                                <span
                                    onclick="subreg('/comm/comexc.php?mode=mod&pop=1&idx=<?= $data[idx] ?>&company='+ document.cform.company<?= $i ?>.value + '&phone1=' + document.cform.phone1<?= $i ?>.value + '&phone2=' +  document.cform.phone2<?= $i ?>.value + '&phone3=' + document.cform.phone3<?= $i ?>.value+ '&bankname=' + document.cform.bankname<?= $i ?>.value+ '&banknum=' + document.cform.banknum<?= $i ?>.value+ '&bname=' + document.cform.bname<?= $i ?>.value);"
                                    style="cursor:hand; ">수정</span>
                                <span style="margin:0 2px"> | </span>
                                <span
                                    onclick="document.HiddenFrm.location.href='/comm/comexc.php?mode=del&pop=1&idx=<?= $data[idx] ?>'"
                                    style="cursor:hand; ">삭제</span>
                            </td>
                        </tr>
                        <!-- 샘플  5-->
                        <tr>
                            <td width="4%" height="40" align="center"><input type="button" id="button1" value="선택"
                                    class="btn-pink" style='width:50px;cursor:hand'
                                    onClick="funselect(<?= $data[idx] ?>,'<?= $data[company] ?>','<?= $data[phone] ?>','<?= $data[bankname] ?>','<?= $data[banknum] ?>','<?= $data[bname] ?>');" />
                            </td>
                            <td width="3%" height="30" align="center">
                                5</td>
                            <td width="17%" height="30" align="center"><input type="text" class="ipip"
                                    name="company<?= $i ?>" value="<?= $data[company] ?>" size="20"></td>
                            <td width="20%" height="30" align="center"> <input type="text" class="ipip"
                                    name="phone1<?= $i ?>" value="<?= $phone[0] ?>" size="3" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone2<?= $i ?>" value="<?= $phone[1] ?>" size="4"
                                    maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone3<?= $i ?>" value="<?= $phone[2] ?>" size="4"
                                    maxlength="4">
                            </td>
                            <td width="40%" height="30" align="center">
                                <input type="text" class="ipip" name="bankname<?= $i ?>" value="<?= $data[bankname] ?>"
                                    size="9"> /
                                <input type="text" class="ipip" name="banknum<?= $i ?>" value="<?= $data[banknum] ?>"
                                    size="22"> /
                                <input type="text" class="ipip" name="bname<?= $i ?>" value="<?= $data[bname] ?>"
                                    size="12">
                            </td>
                            <td width="10%" height="30" align="center">
                                <span
                                    onclick="subreg('/comm/comexc.php?mode=mod&pop=1&idx=<?= $data[idx] ?>&company='+ document.cform.company<?= $i ?>.value + '&phone1=' + document.cform.phone1<?= $i ?>.value + '&phone2=' +  document.cform.phone2<?= $i ?>.value + '&phone3=' + document.cform.phone3<?= $i ?>.value+ '&bankname=' + document.cform.bankname<?= $i ?>.value+ '&banknum=' + document.cform.banknum<?= $i ?>.value+ '&bname=' + document.cform.bname<?= $i ?>.value);"
                                    style="cursor:hand; ">수정</span>
                                <span style="margin:0 2px"> | </span>
                                <span
                                    onclick="document.HiddenFrm.location.href='/comm/comexc.php?mode=del&pop=1&idx=<?= $data[idx] ?>'"
                                    style="cursor:hand; ">삭제</span>
                            </td>
                        </tr>
                        <!-- 샘플  4-->
                        <tr>
                            <td width="4%" height="40" align="center"><input type="button" id="button1" value="선택"
                                    class="btn-pink" style='width:50px;cursor:hand'
                                    onClick="funselect(<?= $data[idx] ?>,'<?= $data[company] ?>','<?= $data[phone] ?>','<?= $data[bankname] ?>','<?= $data[banknum] ?>','<?= $data[bname] ?>');" />
                            </td>
                            <td width="3%" height="30" align="center">
                                4</td>
                            <td width="17%" height="30" align="center"><input type="text" class="ipip"
                                    name="company<?= $i ?>" value="<?= $data[company] ?>" size="20"></td>
                            <td width="20%" height="30" align="center"> <input type="text" class="ipip"
                                    name="phone1<?= $i ?>" value="<?= $phone[0] ?>" size="3" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone2<?= $i ?>" value="<?= $phone[1] ?>" size="4"
                                    maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone3<?= $i ?>" value="<?= $phone[2] ?>" size="4"
                                    maxlength="4">
                            </td>
                            <td width="40%" height="30" align="center">
                                <input type="text" class="ipip" name="bankname<?= $i ?>" value="<?= $data[bankname] ?>"
                                    size="9"> /
                                <input type="text" class="ipip" name="banknum<?= $i ?>" value="<?= $data[banknum] ?>"
                                    size="22"> /
                                <input type="text" class="ipip" name="bname<?= $i ?>" value="<?= $data[bname] ?>"
                                    size="12">
                            </td>
                            <td width="10%" height="30" align="center">
                                <span
                                    onclick="subreg('/comm/comexc.php?mode=mod&pop=1&idx=<?= $data[idx] ?>&company='+ document.cform.company<?= $i ?>.value + '&phone1=' + document.cform.phone1<?= $i ?>.value + '&phone2=' +  document.cform.phone2<?= $i ?>.value + '&phone3=' + document.cform.phone3<?= $i ?>.value+ '&bankname=' + document.cform.bankname<?= $i ?>.value+ '&banknum=' + document.cform.banknum<?= $i ?>.value+ '&bname=' + document.cform.bname<?= $i ?>.value);"
                                    style="cursor:hand; ">수정</span>
                                <span style="margin:0 2px"> | </span>
                                <span
                                    onclick="document.HiddenFrm.location.href='/comm/comexc.php?mode=del&pop=1&idx=<?= $data[idx] ?>'"
                                    style="cursor:hand; ">삭제</span>
                            </td>
                        </tr>
                        <!-- 샘플  3-->
                        <tr>
                            <td width="4%" height="40" align="center"><input type="button" id="button1" value="선택"
                                    class="btn-pink" style='width:50px;cursor:hand'
                                    onClick="funselect(<?= $data[idx] ?>,'<?= $data[company] ?>','<?= $data[phone] ?>','<?= $data[bankname] ?>','<?= $data[banknum] ?>','<?= $data[bname] ?>');" />
                            </td>
                            <td width="3%" height="30" align="center">
                                3</td>
                            <td width="17%" height="30" align="center"><input type="text" class="ipip"
                                    name="company<?= $i ?>" value="<?= $data[company] ?>" size="20"></td>
                            <td width="20%" height="30" align="center"> <input type="text" class="ipip"
                                    name="phone1<?= $i ?>" value="<?= $phone[0] ?>" size="3" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone2<?= $i ?>" value="<?= $phone[1] ?>" size="4"
                                    maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone3<?= $i ?>" value="<?= $phone[2] ?>" size="4"
                                    maxlength="4">
                            </td>
                            <td width="40%" height="30" align="center">
                                <input type="text" class="ipip" name="bankname<?= $i ?>" value="<?= $data[bankname] ?>"
                                    size="9"> /
                                <input type="text" class="ipip" name="banknum<?= $i ?>" value="<?= $data[banknum] ?>"
                                    size="22"> /
                                <input type="text" class="ipip" name="bname<?= $i ?>" value="<?= $data[bname] ?>"
                                    size="12">
                            </td>
                            <td width="10%" height="30" align="center">
                                <span
                                    onclick="subreg('/comm/comexc.php?mode=mod&pop=1&idx=<?= $data[idx] ?>&company='+ document.cform.company<?= $i ?>.value + '&phone1=' + document.cform.phone1<?= $i ?>.value + '&phone2=' +  document.cform.phone2<?= $i ?>.value + '&phone3=' + document.cform.phone3<?= $i ?>.value+ '&bankname=' + document.cform.bankname<?= $i ?>.value+ '&banknum=' + document.cform.banknum<?= $i ?>.value+ '&bname=' + document.cform.bname<?= $i ?>.value);"
                                    style="cursor:hand; ">수정</span>
                                <span style="margin:0 2px"> | </span>
                                <span
                                    onclick="document.HiddenFrm.location.href='/comm/comexc.php?mode=del&pop=1&idx=<?= $data[idx] ?>'"
                                    style="cursor:hand; ">삭제</span>
                            </td>
                        </tr>
                        <!-- 샘플  2-->
                        <tr>
                            <td width="4%" height="40" align="center"><input type="button" id="button1" value="선택"
                                    class="btn-pink" style='width:50px;cursor:hand'
                                    onClick="funselect(<?= $data[idx] ?>,'<?= $data[company] ?>','<?= $data[phone] ?>','<?= $data[bankname] ?>','<?= $data[banknum] ?>','<?= $data[bname] ?>');" />
                            </td>
                            <td width="3%" height="30" align="center">
                                2</td>
                            <td width="17%" height="30" align="center"><input type="text" class="ipip"
                                    name="company<?= $i ?>" value="<?= $data[company] ?>" size="20"></td>
                            <td width="20%" height="30" align="center"> <input type="text" class="ipip"
                                    name="phone1<?= $i ?>" value="<?= $phone[0] ?>" size="3" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone2<?= $i ?>" value="<?= $phone[1] ?>" size="4"
                                    maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone3<?= $i ?>" value="<?= $phone[2] ?>" size="4"
                                    maxlength="4">
                            </td>
                            <td width="40%" height="30" align="center">
                                <input type="text" class="ipip" name="bankname<?= $i ?>" value="<?= $data[bankname] ?>"
                                    size="9"> /
                                <input type="text" class="ipip" name="banknum<?= $i ?>" value="<?= $data[banknum] ?>"
                                    size="22"> /
                                <input type="text" class="ipip" name="bname<?= $i ?>" value="<?= $data[bname] ?>"
                                    size="12">
                            </td>
                            <td width="10%" height="30" align="center">
                                <span
                                    onclick="subreg('/comm/comexc.php?mode=mod&pop=1&idx=<?= $data[idx] ?>&company='+ document.cform.company<?= $i ?>.value + '&phone1=' + document.cform.phone1<?= $i ?>.value + '&phone2=' +  document.cform.phone2<?= $i ?>.value + '&phone3=' + document.cform.phone3<?= $i ?>.value+ '&bankname=' + document.cform.bankname<?= $i ?>.value+ '&banknum=' + document.cform.banknum<?= $i ?>.value+ '&bname=' + document.cform.bname<?= $i ?>.value);"
                                    style="cursor:hand; ">수정</span>
                                <span style="margin:0 2px"> | </span>
                                <span
                                    onclick="document.HiddenFrm.location.href='/comm/comexc.php?mode=del&pop=1&idx=<?= $data[idx] ?>'"
                                    style="cursor:hand; ">삭제</span>
                            </td>
                        </tr>
                        <!-- 샘플  1-->
                        <tr>
                            <td width="4%" height="40" align="center"><input type="button" id="button1" value="선택"
                                    class="btn-pink" style='width:50px;cursor:hand'
                                    onClick="funselect(<?= $data[idx] ?>,'<?= $data[company] ?>','<?= $data[phone] ?>','<?= $data[bankname] ?>','<?= $data[banknum] ?>','<?= $data[bname] ?>');" />
                            </td>
                            <td width="3%" height="30" align="center">
                                1</td>
                            <td width="17%" height="30" align="center"><input type="text" class="ipip"
                                    name="company<?= $i ?>" value="<?= $data[company] ?>" size="20"></td>
                            <td width="20%" height="30" align="center"> <input type="text" class="ipip"
                                    name="phone1<?= $i ?>" value="<?= $phone[0] ?>" size="3" maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone2<?= $i ?>" value="<?= $phone[1] ?>" size="4"
                                    maxlength="4">
                                -
                                <input type="text" class="ipip" name="phone3<?= $i ?>" value="<?= $phone[2] ?>" size="4"
                                    maxlength="4">
                            </td>
                            <td width="40%" height="30" align="center">
                                <input type="text" class="ipip" name="bankname<?= $i ?>" value="<?= $data[bankname] ?>"
                                    size="9"> /
                                <input type="text" class="ipip" name="banknum<?= $i ?>" value="<?= $data[banknum] ?>"
                                    size="22"> /
                                <input type="text" class="ipip" name="bname<?= $i ?>" value="<?= $data[bname] ?>"
                                    size="12">
                            </td>
                            <td width="10%" height="30" align="center">
                                <span
                                    onclick="subreg('/comm/comexc.php?mode=mod&pop=1&idx=<?= $data[idx] ?>&company='+ document.cform.company<?= $i ?>.value + '&phone1=' + document.cform.phone1<?= $i ?>.value + '&phone2=' +  document.cform.phone2<?= $i ?>.value + '&phone3=' + document.cform.phone3<?= $i ?>.value+ '&bankname=' + document.cform.bankname<?= $i ?>.value+ '&banknum=' + document.cform.banknum<?= $i ?>.value+ '&bname=' + document.cform.bname<?= $i ?>.value);"
                                    style="cursor:hand; ">수정</span>
                                <span style="margin:0 2px"> | </span>
                                <span
                                    onclick="document.HiddenFrm.location.href='/comm/comexc.php?mode=del&pop=1&idx=<?= $data[idx] ?>'"
                                    style="cursor:hand; ">삭제</span>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>
    <table width="950" border="0" cellpadding="0" cellspacing="0" style="margin: 10px auto">
        <tr>
            <td align="center"> <span>[맨처음]<b> 1 </b> [마지막]</span> </td>
        </tr>
    </table>

</body>
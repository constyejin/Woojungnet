<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="/style.css">
</head>

<body>
<table width="471" border="0" cellspacing="0" cellpadding="0" style="padding-top:50">
<form>
  <tr>
    <td align="center">
      <table width="471" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="146" background="/images/error1.gif" style="padding:25 25 25 170" valign="top"><strong><?echo $message;?></strong></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="right"><?if(!$url){?><a href=# onclick=history.back() onfocus=blur()><img src="/images/error2.gif" width="96" height="29"></a>
<?}else{?><a href=# onclick=location.href="<?echo $url;?>" onfocus=blur()><img src="/images/error3.gif" alt="페이지이동"></a><?}?></td>
  </tr>
</form>
</table>
</body>
</html>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";?>
<script>
function login(){
	f=document.cform;
	if(f.user_id.value==""){
		alert('���̵� �Է��� �ּ���.');
	}else if(f.user_pass.value==""){
		alert('�н����带 �Է��� �ּ���.');
	}else{
		f.action="login_ok.php";
		f.submit();
	}
}
</script>

  <div class="login-wrap">
    <h1>
      <a href="../index.php">������ WOOJUNGNET</a>
    </h1>
    <div class="login-box">
      <h2>�α��� Login</h2>
      <p class="description">�α��� �� �̿밡���մϴ�.</p>
      <form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm">
            <input type="text" class="input-custom" placeholder="���̵� �Է��ϼ���" name="user_id">
            <input type="password" class="input-custom" placeholder="��й�ȣ�� �Է��ϼ���" name="user_pass">

            <div class="btn-wrap">
              <button type="button" onclick="login();">�α���</button>
            </div>
      </form>
    </div>
    <div class="copyright">
      Ȩ������ ��� : TEL. 1899-3840/02-2601-6569~70 (�ָ�, ������ �޹�)
    </div>

    <footer style="margin-top:60px;">
      <a href="/sub05" class="banner">
        <p>Ȩ���������� �������� 
          <span class="tag">�ٷΰ���</span>
        </p>
      </a>
    </footer>
  </div>
</body>
</html>



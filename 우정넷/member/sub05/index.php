<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";?>
<?
$rand=mt_rand(1000000,9999999);
?>

<script>
function wr(){
	f=document.cform;
	if(f.spam_text.value!="<?=$rand?>"){
		alert("���Թ��� �ڵ带 Ȯ���� �ּ���.");
	}else if(f.ch1.checked==false){
		alert("�������� ��޹�ħ�� ������ �ּ���.");
	}else{
		f.action="est_save.php";
		f.submit();
	}
}
</script>

  <div class="gnb">
    <div class="container">
      <div class="prefix">
        <h1><a href="../index.php">������ WOOJUNGNET</a></h1>
      </div>
      <div class="suffix">
        <? if($_SESSION[user_id]){ ?>
                <a href="/admin/sub04/sub01.php" class="btn-manage">�����ڸ��</a>
        <? } ?>
        <? if($_SESSION[user_id]){ ?>
                <span class="user"><?=$_SESSION[user_name]?>��</span>
        <? } ?>
                <ul class="links">
                  <li><a href="/sub05/">��������</a></li>
        <? if($_SESSION[user_id]){ ?>
                  <li><a href="/member/logout.php">�α׾ƿ�</a></li>
        <? }else{ ?>
                  <li><a href="/member/login.php">�α���</a></li>
        <? } ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="header">
    <div class="main-visaul">
      <img src="/img/main1.png" alt="���� �����̵� �̹���">
    </div>
    <div class="nav">
      <ul>
        <li class="on"><a href="/">������</a></li>
        <li><a href="">Ȩ����������</a></li>
        <li><a href="">��������</a></li>
        <li><a href="">��ȣ����</a></li>
        <li>�������� �����ּ��� �� 1899-3840 / 02-2601-6569</li>
      </ul>
    </div>
  </div>
  <div class="content join">
    <div class="container">
      <h2>Ȩ���������� ��������</h2>
      <p class="sub-phrase">�Ʒ� ������ �����Ͻø� ��翡�� �ż��ϰ� ������ �帮�ڽ��ϴ� </p>

      <form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm">
            <div class="join-form">
              <ul>
                <li>
                  <div class="th">
                    �̸�
                  </div>
                  <div class="td">
                    <input type="text" class="input-custom md" name="est_name">
                  </div>
                </li>
                <li>
                  <div class="th">
                    �޴���ȭ
                  </div>
                  <div class="td">
                    <div class="phone">
                      <input type="text" maxlength="3" class="input-custom" name="est_mobile1">
                      <span>-</span>
                      <input type="text"  maxlength="4" class="input-custom" name="est_mobile2">
                      <span>-</span>
                      <input type="text" maxlength="4" class="input-custom" name="est_mobile3">
                    </div>
                  </div>
                </li>
                <li>
                  <div class="th">
                    Ȩ�������뵵
                  </div>
                  <div class="td">
                    <div class="radio-list">  
                      <ul>
                        <li>
                          <input type="radio" name="type1" value="1" id="category1" class="radio-custom" checked>
                          <label for="category1">ȸ���</label>
                        </li>
                        <li>
                          <input type="radio" name="type1" value="2" id="category2" class="radio-custom">
                          <label for="category2">ȫ����</label>
                        </li>
                        <li>
                          <input type="radio" name="type1" value="3" id="category3" class="radio-custom">
                          <label for="category3">������</label>
                        </li>
                        <li>
                          <input type="radio" name="type1" value="4" id="category4" class="radio-custom">
                          <label for="category4">���θ�</label>
                        </li>
                        <li>
                          <input type="radio" name="type1" value="5" id="category5" class="radio-custom">
                          <label for="category5">��Ÿ</label>
                        </li>
                      </ul>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="th">
                    ������
                  </div>
                  <div class="td">
                    <input type="text" class="input-custom md" name="pay">
                    <span>��</span>
                  </div>
                </li>
                <li>
                  <div class="th">
                    ��������
                  </div>
                  <div class="td">
                    <div class="radio-list">
                      <ul>
                        <li>
                          <input type="radio" name="type2" value="1" id="question1" class="radio-custom" checked>
                          <label for="question1">Ȩ����������</label>
                        </li>
                        <li>
                          <input type="radio" name="type2" value="2" id="question2" class="radio-custom">
                          <label for="question2">��������</label>
                        </li>
                        <li>
                          <input type="radio" name="type2" value="3" id="question3" class="radio-custom">
                          <label for="question3">����ȣ����</label>
                        </li>
                        <li>
                          <input type="radio" name="type2" value="4" id="question4" class="radio-custom">
                          <label for="question4">��ȣ����</label>
                        </li>
                      </ul>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="th">
                    �������Ʈ1
                  </div>
                  <div class="td">
                    <input type="text" class="input-custom" name="site1">
                  </div>
                </li>
                <li>
                  <div class="th">
                    �������Ʈ2
                  </div>
                  <div class="td">
                    <input type="text" class="input-custom" name="site2">
                  </div>
                </li>
                <li>
                  <div class="th">
                    �������Ʈ3
                  </div>
                  <div class="td">
                    <input type="text" class="input-custom" name="site3">
                  </div>
                </li>
                <li>
                  <div class="th">
                    ���ǻ���
                  </div>
                  <div class="td">
                    <textarea type="text" class="input-custom" rows="5" cols="20" name="memo"></textarea>
                  </div>
                </li>
                <li>
                  <div class="th">
                    <span>���Թ���</span>
                    <span style="float:right; color:red">���� ���ڸ� �Է��Ͽ��ּ���.</span>
                  </div>
                  <div class="td">
                    <div class="spam">
                      <input type="text" class="input-custom" value="<?=$rand?>" disabled>
                      <input type="text" class="input-custom" name="spam_text">
                    </div>
                  </div>
                </li>
              </ul>
            </div>

            <div class="privacy">
              <h3>��������ó����ħ</h3>
              <div class="term-box">
                <div class="term-content">
                  ���� ��Ȱ�� �����,���������� ������ ���� �Ʒ��� ���� ���������� �����ϰ� �ֽ��ϴ�

                  [��]�����ϴ� ���������� �׸� : �̸� , ����ó(�޴���ȭ)

                  [��]�����ϴ� ���������� ������� : �ڹ������� �¶��λ󿡼� �����ϴ� ������� �����մϴ�
                  ���� ��Ȱ�� �����,���������� ������ ���� �Ʒ��� ���� ���������� �����ϰ� �ֽ��ϴ�

                  [��]�����ϴ� ���������� �׸� : �̸� , ����ó(�޴���ȭ)

                  [��]�����ϴ� ���������� ������� : �ڹ������� �¶��λ󿡼� �����ϴ� ������� �����մϴ�
                  ���� ��Ȱ�� �����,���������� ������ ���� �Ʒ��� ���� ���������� �����ϰ� �ֽ��ϴ�

                  [��]�����ϴ� ���������� �׸� : �̸� , ����ó(�޴���ȭ)

                  [��]�����ϴ� ���������� ������� : �ڹ������� �¶��λ󿡼� �����ϴ� ������� �����մϴ�
                </div>
                <div class="agree-wrap">
                  <input type="checkbox" name="ch1" id="ch1">
                  <label for="agree-chk">��������ó����ħ�� �����մϴ�.</label>
                </div>
              </div>
            </div>

            <div class="btn-wrap">
              <button type="button" onclick="wr()">��������</button>
            </div>
      </form>
	  </div>
  </div>
  
  <footer>
    <div class="container">
        <? if($_SESSION[user_id]){ ?>
      <p onclick="location.href='/admin/sub04/sub01.php';">[�����ڸ��]</p>
        <? } ?>
      <div class="logo">
        <h1>
          <span>������</span>
          <span>WOOJUNGNET</span>
        <? if($_SESSION[user_id]){ ?>
          <a href="/member/logout.php" class="link-to-pc">�α׾ƿ�</a>
        <? }else{ ?>
          <a href="/member/login.php" class="link-to-pc">�α���</a>
        <? } ?>
        </h1>
      </div>
      <div class="info">
        <div>����: 1899-3840/02-2601-6569~70  �ѽ�: 02)2601-6691 | �̸���: drg1038@naver.com</div>
        <div>��ȣ: ������ �� ����ڹ�ȣ: 152-25-00212  |  ��ǥ: ���̼�  ��  �ּ�: ���� ������ ȭ���185 ���������� 505ȣ</div>
      </div>
    </div>
  </footer>
  <div class="banner sm-only">
    <a href="/sub05">
      <p>Ȩ���������� ��������
        <span class="tag">�ٷΰ���</span>
      </p>
    </a>
  </div>
</body>
</html>

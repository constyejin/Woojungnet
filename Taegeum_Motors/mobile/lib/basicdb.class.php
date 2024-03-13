<?php
#################### 데이타 베이스 클래스 입니다 ###############

class basicdb {

	var $host		= 'localhost';
	var $userId		= 'wjn2403';
	var $userPass	= 'q1w2e3r4';
	var $dbname		= 'wjn2403';
	var $con;

	function basicdb($host="",$userId="",$userPass="",$dbname=""){
		
		if(!$host)$host			= $this->host;
		if(!$userId)$userId		= $this->userId;
		if(!$userPass)$userPass = $this->userPass;
		if(!$dbname)$dbname		= $this->dbname;

		$this->con	= mysql_connect($host,$userId,$userPass) or die(mysql_error());
		$condb = mysql_select_db($dbname) or die(mysql_error());
	}


	function dberr($sql) {
		$result="<table width=400 border=1 cellpadding=0 cellspacing=0 bordercolor=#B9B9B9>";
		$result.="<tr><td width=90>query문</td><td>";
		$result.=$sql;
		$result.="</td></tr>";
		$result.="<tr><td width=90>에러문</td><td>";
		$result.=mysql_error();
		$result.="</td></tr>";
		$result.="</table>";
		
	return $result;
	}
	
	function query($sql) {
		$result = mysql_query($sql) or die($this->dberr($sql));
	return $result;
	}
	
	function del($tbname,$where) {
		$result = $this->query("delete from $tbname where $where");
	return $result;
	}

	function dbclose() {
		$result = mysql_close($this->con) or die(mysql_error());
	return $result;
	}
}
?>

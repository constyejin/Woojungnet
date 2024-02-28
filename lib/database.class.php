<?php
############################################################################################
#		회원 모듈의 설정 파일
#
#############################################################################################

class shopDataSetting extends basicdb {
	var $catetb		 = 'nidr_shop_cate';
	var $menutb		 = 'nidr_shop_menu';
	var $goodstb	 = 'nidr_shop_goods';
	var $menuRanktb	 = 'nidr_menu_rank';

	function shopDataSetting($catetb="",$menutb="") {

		if(!$catetb)$catetb	  = $this->catetb;
		if(!$menutb)$menutb   = $this->menutb;

		$tbResultCate   = $this->seekTable($catetb);
		$tbResultMenu   = $this->seekTable($menutb);
		
		if(!$tbResultCate)$this->createCate($catetb);
		if(!$tbResultMenu)$this->createMenu($menutb);

		echo "쇼핑몰테이블셋팅에 성공하였습니다";
	}

	function allCreate() {
		$this->createCate($this->catetb);
		$this->createMenu($this->menutb);
		$this->createMenuRank($this->menuRanktb);
		$this->createGoods($this->goodstb);

	}

	function seekTable($tableName) {
		$query = $this->query("show tables like '$tableName'");
		$row = mysql_fetch_row($query);

	return $row[0];
	}
	
	function allDrop() {
		$query1 = $this->query("drop table $this->catetb");
		$query2 = $this->query("drop table $this->menutb");
		$query3 = $this->query("drop table $this->goodstb");
		$query4 = $this->query("drop table $this->menuRanktb");
	}
	
	function partDrop($tableName) {
		$query = $this->query("drop table $tableName");
	}


	function createCate($tableName) {
		$catesql = "create table if not exists $tableName (
				idx				int(10) not null auto_increment,
				cateName		varchar(40) not null,
				cateCode		varchar(30) not null,
				depth			int(3) not null,
				cateImg1		varchar(50),
				cateImg2		varchar(50),
				cateImg3		varchar(50),
				mainOut			enum('yes','no') not null,
				cateUse			enum('yes','no') not null,
				level			int(5) not null,
				primary key(idx),
				index(cateName),
				index(cateCode),
				index(mainOut),
				index(cateUse),
				index(level)
				)";
		
		$result = $this->query($catesql);
		if(!$result) {
			echo "카테고리테이블 생성에 실패하였습니다";
			exit;
		}
	}

	function createMenu($tableName) {

		$menusql= "create table if not exists $tableName (
				idx				int(10) not null auto_increment,
				menuName		varchar(40) not null,
				menuCode		varchar(30) not null,
				mainMenuOut		enum('yes','no') not null,
				mainDisplayOut  enum('yes','no') not null,
				menuGoodsOutNum	tinyint(2) not null default '6',
				level			tinyint(2) not null,
				menuImg		varchar(50),
				mainMenuImg		varchar(50),
				mainDisplayImg		varchar(50),
				mainDisplayImgBack	varchar(50),
				subDisplayImg		varchar(50),
				primary key(idx),
				index(menuCode),
				index(mainMenuOut),
				index(mainDisplayOut),
				index(level)
				)";
		$result = $this->query($menusql);
		if(!$result) {
			echo "메뉴테이블 생성에 실패하였습니다";
			exit;
		}
	}
	
	function createMenuRank($tableName) {

		$ranksql= "create table if not exists $tableName (
				idx				int(10) not null auto_increment,
				goodsCode		varchar(20),
				primary key(idx),
				index(goodsCode)
				)";
		$result = $this->query($ranksql);
		if(!$result) {
			echo "상품메뉴순서 테이블 생성에 실패하였습니다";
			exit;
		}
	}
	
	function createGoods($tableName) {

		$goodsql= "create table if not exists $tableName (
					idx					int(10) not null auto_increment,
					goodsCode			varchar(40) not null,
					goodsName			varchar(80) not null,
					goodsImg			varchar(60),
					goodsCate			varchar(35) not null,
					goodsMenu			varchar(140),
					goodsSupportCode	varchar(5),
					goodsSupportName	varchar(40),
					customerPrice		int(8),
					supportPrice		int(8),
					salePrice			int(8),
					goodsNum			int(8),
					goodsTrans			enum('allpay','partpay','nopay') not null,
					goodsOption1		varchar(100),
					goodsOptionValue1	mediumtext,
					goodsOption2		varchar(100),
					goodsOptionValue2	mediumtext,
					goodsOption3		varchar(100),
					goodsOptionValue3	mediumtext,
					goodsSimpleContents	text,
					goodsDetailContents text not null,
					goodsSmallImg		varchar(60),
					goodsMiddleImg		varchar(60),
					goodsBigImg			varchar(60),
					goodsUse			enum('yes','no') not null,
					level				int(5) not null,
					rdate				date,
					primary key(idx),
					index(goodsCode),
					index(goodsName),
					index(goodsCate),
					index(goodsMenu),
					index(goodsUse),
					index(level)
					)";
		$result = $this->query($goodsql);
		if(!$result) {
			echo "상품테이블 생성에 실패하였습니다";
		}

	}
}
?>
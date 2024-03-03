<%@ page language="java" contentType="text/html; charset=euc-kr" %>
<html style="width:505; height:350;">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>���� ��������������������������������������������������������������������������������������������������������������������������������������������������������������������������.</title>

<style type="text/css">
	body	{font-size: 9pt; font-family: ����, ����; font-style:  normal; font-weight: normal;}
	td		{font-size: 9pt; font-family: ����, ����; font-style:  normal; font-weight: normal;}
	pre		{font-size: 9pt; font-family: ����, ����; font-style:  normal; font-weight: normal;}
	input, select, textarea, button	{font-size: 9pt; font-family: ����, ����; font-style:  normal; font-weight: normal;}
	
	input, select	{width:90%;}
	textarea		{width:100%; height:50;}
	button			{width:75; cursor:hand;}
	
	.threedface	{background-color: threedface;}
	
	.Colortone	{width:20; height:15; border-style:inset; border-width:1px;}
</style>
</head>

<script language="JScript">

	//**	�⺻ �� ���� ����
		var GetHexRGB;
		var PosObj;
	
	
	//**	�⺻ ����
		var Colortone		= new Array(11);
			Colortone[0]	= new Array('#000000','#FFFFFF','#008000','#800000','#AC8295','#808000','#000080','#800080','#808080','#C0C0C0');
			Colortone[1]	= new Array('#FFFF00','#00FF00','#00FFFF','#FF00FF','#FF0000','#0000FF','#008080','#ED8602','#0099FF','#9900FF');
			Colortone[2]	= new Array('#FFFFFF','#E5E4E4','#D9D8D8','#C0BDBD','#A7A4A4','#8E8A8B','#827E7F','#767173','#5C585A','#000000');
			Colortone[3]	= new Array('#FEFCDF','#FEF4C4','#FEED9B','#FEE573','#FFED43','#F6CC0B','#E0B800','#C9A601','#AD8E00','#8C7301');
			Colortone[4]	= new Array('#FFDED3','#FFC4B0','#FF9D7D','#FF7A4E','#FF6600','#E95D00','#D15502','#BA4B01','#A44201','#8D3901');
			Colortone[5]	= new Array('#FFD2D0','#FFBAB7','#FE9A95','#FF7A73','#FF483F','#FE2419','#F10B00','#D40A00','#940000','#6D201B');
			Colortone[6]	= new Array('#FFDAED','#FFB7DC','#FFA1D1','#FF84C3','#FF57AC','#FD1289','#EC0078','#D6006D','#BB005F','#9B014F');
			Colortone[7]	= new Array('#FCD6FE','#FBBCFF','#F9A1FE','#F784FE','#F564FE','#F546FF','#F328FF','#D801E5','#C001CB','#8F0197');
			Colortone[8]	= new Array('#E2F0FE','#C7E2FE','#ADD5FE','#92C7FE','#6EB5FF','#48A2FF','#2690FE','#0162F4','#013ADD','#0021B0');
			Colortone[9]	= new Array('#D3FDFF','#ACFAFD','#7CFAFF','#4AF7FE','#1DE6FE','#01DEFF','#00CDEC','#01B6DE','#00A0C2','#0084A0');
			Colortone[10]	= new Array('#EDFFCF','#DFFEAA','#D1FD88','#BEFA5A','#A8F32A','#8FD80A','#79C101','#3FA701','#307F00','#156200');
			Colortone[11]	= new Array('#D4C89F','#DAAD88','#C49578','#C2877E','#AC8295','#C0A5C4','#969AC2','#92B7D7','#80ADAF','#9CA53B');



//**********************************************************************************************************************************************************************
//*			����� �Լ�
//**********************************************************************************************************************************************************************

	//******************************************************************************************************************************************
	//*		�⺻ �̺�Ʈ ó��
	//******************************************************************************************************************************************



	//**	�⺻ ���� ����â���� ���ý� ó��
		function FUN_SelectColor(HexRGB){
			var Color	=	new Array;
			
			if(HexRGB == null){
				HexRGB	=	document.all['RGB'].value;
			}
			
			if(HexRGB.substring(0,1) != '#'){
				HexRGB	= '#' + HexRGB;
			}
			
			document.all['RGB'].value	=	HexRGB;
			
			//**	������ ���� ����
				FUN_BarChange();
		}



	//**	RGB �Է�â�� �� ����� ����
		function FUN_HexRGB_Input_Color(HexRGB){
			
			var Color	=	new Array;
			var Red, Green, Blue;
			var X, Y, Z;
			
			//**	�Է�â üũ
				if(HexRGB.length != 7 && HexRGB.substring(0,1) != '#'){
					return;
				}
			
			//**	�Է�â���� ����, ESC �Է½� Ȯ������ ��Ŀ�� �̵�
				if(event.keyCode == 27){
					FUN_Cancel();
				}
				if(event.keyCode == 13){
					document.all['InsertColor_OK'].focus();
				}
			
			//**	RGB�Է�â�� �Է�
				document.all['RGB'].value	=	HexRGB;
			
			//**	HexRGB ������ RGB �� ������ ����
				Color	=	FUN_HexRGBtoRGB(HexRGB);
				
				//**	RGB �� �Է� ������ ���ư���
					if(Color == null){
						return;
					}
				//**	RGB �� ����
					Red		=	Color['Red'];
					Green	=	Color['Green'];
					Blue	=	Color['Blue'];
					
				//**	RGB �� �Է�
					document.all['Red'].value	=	Red;
					document.all['Green'].value	=	Green;
					document.all['Blue'].value	=	Blue;
				
			//**	RGB ���� HSL�� ��ȯ
				Color	=	FUN_RGBtoHSL(Red, Green, Blue);
				
				document.all['Hue'].value	=	Color['Hue'];
				document.all['Sat'].value	=	Color['Sat'];
				document.all['Lum'].value	=	Color['Lum'];
			
			//**	Hue, Sat ������ X, Y �� ���ϱ�
				Color	=	FUN_HStoXY(document.all['Hue'].value, document.all['Sat'].value);
					
					X	=	Color['X'];
					Y	=	Color['Y'];
			
			//**	Lum ������ ����� ����(Z) ���ϱ�
				Z	=	FUN_LtoZ(document.all['Lum'].value);
			
			//**	������ ���� ����
				FUN_BarChange();
			
			//**	���� �̸����� ���� ����
				FUN_Change_Color();
			
			//**	���� ���� �κ��� Ŀ�� ��ġ ����
				//**	�÷� ��Ʈ ���� Ŀ��
					document.all['Cursor_Chart'].style.left	= X - 10;
					document.all['Cursor_Chart'].style.top	= Y - 10;
				
				//**	������ ���� Ŀ�� ����
					document.all['Cursor_Bar'].style.top	= Z - 5;

		}



	//**	Hue, Sat, Lum �Է�â�� �� ����� ����
		function FUN_HSL_Input_Color(){
			
			var Color	=	new Array;
			
			var Hue		=	document.all['Hue'].value;
			var Sat		=	document.all['Sat'].value;
			var Lum		=	document.all['Lum'].value;
			var X, Y, Z;
			
			//**	�Է°� üũ
				//**	Hue üũ
					if(isNaN(Hue) || Hue < 0 || Hue > 360){
						return;
					}
				//**	Sat, Lum üũ
					if(isNaN(Sat) || Sat < 0 || Sat > 100 || isNaN(Lum) || Lum < 0 || Lum > 100){
						return;
					}
			
			//**	�Է�â���� ����, ESC �Է½� Ȯ������ ��Ŀ�� �̵�
				if(event.keyCode == 27){
					FUN_Cancel();
				}
				if(event.keyCode == 13){
					document.all['InsertColor_OK'].focus();
				}
			
			//**	Hue, Sat ������ X, Y �� ���ϱ�
				Color	=	FUN_HStoXY(Hue, Sat);
					
					X	=	Color['X'];
					Y	=	Color['Y'];
			
			//**	Lum ������ ����� ����(Z) ���ϱ�
				Z	=	FUN_LtoZ(Lum);
			
			//**	���� ���� �κ��� Ŀ�� ��ġ ����
				//**	�÷� ��Ʈ ���� Ŀ��
					document.all['Cursor_Chart'].style.left	= X - 10;
					document.all['Cursor_Chart'].style.top	= Y - 10;
				
				//**	������ ���� Ŀ�� ����
					document.all['Cursor_Bar'].style.top	= Z - 5;
			
			//**	HSL �� RGB ������ ��ȯ
				Color	= FUN_HSLtoRGB(Hue, Sat, Lum);
			
			//**	RGB ���� �Է�
				document.all['Red'].value	=	Color['Red'];
				document.all['Green'].value	=	Color['Green'];
				document.all['Blue'].value	=	Color['Blue'];
			
			
			//**	���� ����
				FUN_ViewColor();
		
		}



	//**	Red, Green, Blue �Է�â�� �� ����� ����
		function FUN_RGB_Input_Color(){
			
			var Color	=	new Array;
			var Red		=	document.all['Red'].value;
			var Green	=	document.all['Green'].value;
			var Blue	=	document.all['Blue'].value;
			
			//**	�Է°� üũ
				if(isNaN(Red) || Red < 0 || Red > 255 || isNaN(Green) || Green < 0 || Green > 255 || isNaN(Blue) || Blue < 0 || Blue > 255){
					return;
				}
			
			//**	RGB ���� HSL�� ��ȯ
				Color	=	FUN_RGBtoHSL(Red, Green, Blue);
				
				document.all['Hue'].value	=	Color['Hue'];
				document.all['Sat'].value	=	Color['Sat'];
				document.all['Lum'].value	=	Color['Lum'];
			
			//**	Hue, Sat ������ X, Y �� ���ϱ�
				Color	=	FUN_HStoXY(document.all['Hue'].value, document.all['Sat'].value);
					
					X	=	Color['X'];
					Y	=	Color['Y'];
			
			//**	Lum ������ ����� ����(Z) ���ϱ�
				Z	=	FUN_LtoZ(document.all['Lum'].value);
			
			//**	���� ���� �κ��� Ŀ�� ��ġ ����
				//**	�÷� ��Ʈ ���� Ŀ��
					document.all['Cursor_Chart'].style.left	= X - 10;
					document.all['Cursor_Chart'].style.top	= Y - 10;
				
				//**	������ ���� Ŀ�� ����
					document.all['Cursor_Bar'].style.top	= Z - 5;
			
			
			//**	���� ����
				FUN_ViewColor();
		}
		





	//**	���� �̸����⿡ �� ����
		function FUN_Change_Color(){
			
			var HexRGB	=	document.all['RGB'].value;
						
			if(HexRGB.substring(0,1) !== '#'){
				HexRGB = '#' + HexRGB;
			}
			
			ColorBox.style.backgroundColor	= HexRGB;
			
		}



	//**	���� ����
		function FUN_ViewColor(){
			
			//**	RGB ���� ���� 16���� ������ ��ȯ
				Color	= FUN_RGBtoHexRGB(document.all['Red'].value, document.all['Green'].value, document.all['Blue'].value);
			
			//**	���� �Է� â�� ����
				document.all['RGB'].value	=	'#'+ Color['RGB'];
			
			//**	���� �̸� ���⿡ ����
				FUN_Change_Color();
			
			//**	������ ���� ����
				FUN_BarChange();
		
		}



	//**	������ ���� ���� ó��
		function FUN_BarChange(){
		
			BarColor	= new Array;
			
			BarColor	=	FUN_HSLtoRGB(document.all['Hue'].value, document.all['Sat'].value, 100);
			
			BarColor	=	FUN_RGBtoHexRGB(BarColor['Red'], BarColor['Green'], BarColor['Blue']);
			
			var startColor	=	'#'+ BarColor.RGB;
			var endColor	= '#000000';
			
			document.all['ColorBar'].innerHTML	=	'<div style="width:100%; height:100%; FILTER:progid:DXImageTransform.Microsoft.Gradient(gradientType=0,startColorStr='+ startColor +',endColorStr='+ endColor +');"></div>'
		}




	//**	�÷� ��Ʈ ���� ���� ó��
		
		//**	�÷� ��Ʈ ���� ���콺 Ŭ���� ó��
			function FUN_ChartClick(){
				var Color	=	new Array;
								
				var MinX	=	251;
				var MinY	= 	44;
				var MaxX	=	427;
				var MaxY	=	232;
				
				PosObj	=	document.all['Cursor_Chart'];
				
				var OldPosX		=	PosObj.PosX;
				var OldPosY		=	PosObj.PosY;
				var NewPosX		=	event.clientX;
				var NewPosY		=	event.clientY;
				
				if(NewPosX < MinX || NewPosX > MaxX || NewPosY < MinY || NewPosY > MaxY){
					FUN_EndDrag();
					return;
				}
				
				NewPosX		-=	MinX;
				NewPosY		-=	MinY;
				
				PosObj.style.left	= MinX + NewPosX - 10;
				PosObj.style.top	= MinY + NewPosY - 10;
				
				//**	XY ���� HS �� ��ȯ
					Color	=	FUN_XYtoHS(NewPosX, NewPosY, MaxX-MinX, MaxY-MinY);
					//**	H, S ���� �Է�â�� ����
						document.all['Hue'].value	= Color['Hue'];
						document.all['Sat'].value	= Color['Sat'];
										
				//**	HSL �� RGB�� ��ȯ					
					Color	= FUN_HSLtoRGB(document.all['Hue'].value, document.all['Sat'].value, document.all['Lum'].value);
					
					//** R, G, B �Է�â�� �� ����
						document.all['Red'].value	=	Color['Red'];
						document.all['Green'].value	=	Color['Green'];
						document.all['Blue'].value	=	Color['Blue'];
				
				//**	���� ����
					FUN_ViewColor();
					
				return;
			}




		//**	�÷� ��Ʈ�� ���콺 ����
			function FUN_ChartMove(){
				
				if(PosObj != document.all['Cursor_Chart']){
					return;
				}
				
				FUN_ChartClick();
			}




	//**	�÷� �� ���� ���� ó��
		//**	�÷��� Ŭ���� ó��
			
			function FUN_BarClick(){
				var Color	=	window.Color;
				
				PosObj	=	document.all['Cursor_Bar'];
				
				var MaxX	= 469;
				var MaxY	= 232;
				var MinX	= 459;
				var MinY	= 44;
				
				var NewX	= event.clientX;
				var NewY	= event.clientY;
				
				if(NewX < MinX || NewX > MaxX || NewY < MinY || NewY > MaxY){
					FUN_EndDrag();
					return;
				}
				
				PosObj.style.top	= NewY - 5;
				
				NewY -=	MinY;
				
				//**	Z(Y) ���� L�� ��ȯ
					Color	= FUN_ZtoL(NewY, MaxY-MinY);
					
					//**	L���� �Է�â�� ����
						document.all['Lum'].value	= Color['Lum'];
				
				//**	HSL �� RGB�� ��ȯ
				
					Color	= FUN_HSLtoRGB(document.all['Hue'].value, document.all['Sat'].value, document.all['Lum'].value);
					
					//** R, G, B �Է�â�� �� ����
						document.all['Red'].value	=	Color['Red'];
						document.all['Green'].value	=	Color['Green'];
						document.all['Blue'].value	=	Color['Blue'];
				
				//**	���� ����
					FUN_ViewColor();
			}




		//**	�÷��� �����ó��
			function FUN_BarMove(){
				if(PosObj != document.all['Cursor_Bar']){
					return;
				}
				
				FUN_BarClick();
			}




	//**	�巹�� ����
		function FUN_EndDrag(){
			PosObj=null;
			return;
		}






	//******************************************************************************************************************************************
	//*			��ȯ �Լ�
	//******************************************************************************************************************************************


	//**	16���� ���� RGB���ڷ� ��ȯ
		function FUN_HexRGBtoRGB(HexRGB){
			
			var tmpColor	= new Array;
			
			var HexList	=	'01234567890ABCDEF';
			
			if(HexRGB.substring(0,1) == '#'){
				HexRGB	= HexRGB.substring(1);
			}
			
			if(HexRGB.length < 6){
				return;
			}
			
			for(var i=0; i<6; i++){
				if(HexList.indexOf(HexRGB.charAt(i)) < 0){
					return tmpColor;
				}
			}
			
			tmpColor['Red']		=	parseInt(HexRGB.substring(0,2), 16);
			tmpColor['Green']	=	parseInt(HexRGB.substring(2,4), 16);
			tmpColor['Blue']	=	parseInt(HexRGB.substring(4,6), 16);
			
			return tmpColor;
			
		}


	//**	RGB���� ���� 16������ ��ȯ
		function FUN_RGBtoHexRGB(Red, Green, Blue){
			
			var tmpColor	= new Array;
			
			Red		= eval(Red);
			Green	= eval(Green);
			Blue	= eval(Blue);
			
			//**	RGB���� 16������ ��ȯ
				if(Red < 16){
					Red		= '0' + Red.toString(16);
				}else{
					Red		= Red.toString(16);
				}
			
				if(Green < 16){
					Green	= '0' + Green.toString(16);
				}else{
					Green	= Green.toString(16);
				}
			
				if(Blue < 16){
					Blue	= '0' + Blue.toString(16);
				}else{
					Blue	= Blue.toString(16);
				}
			
			
			//**	�빮�ڷ� ��ȯ
				Red		=	Red.toUpperCase();
				Green	=	Green.toUpperCase();
				Blue	=	Blue.toUpperCase();
			
			//**	�迭�� ����
				tmpColor['HexRed']		=	Red;
				tmpColor['HexGreen']	=	Green;
				tmpColor['HexBlue']		=	Blue;
				tmpColor['RGB']			=	Red + Green + Blue;
			
			return tmpColor;
		}



	//**	���� ���� ó��
		//**	XY ���������� HS �� ���ϱ�
			function FUN_XYtoHS(X, Y, XSize, YSize){
				
				var tmpColor	= new Array;
				
				tmpColor['Hue']	= Math.round(X/XSize*360);
				tmpColor['Sat']	= Math.round((1-Y/YSize)*100);
				tmpColor['Lum'] = document.all['Lum'].value;
				
				return tmpColor;
			}
		
		
		//**	Z������ ������ Lum�� ���ϱ�
			function FUN_ZtoL(Z, ZSize){
				var tmpColor	= new Array;
				
				tmpColor['Lum']	= Math.round((1-Z/ZSize)*100);
				
				return tmpColor;
			}


		
		//**	HSL�� RGB ����
			function FUN_HSLtoRGB(H, S, L){
				
				var tmpColor	= new Array;
								
				var R=0, G=0, B=0;
				var tmpH, i, j;
				var X, Y, Z;
				
				//**	HSL�� ���� ���� Ȯ��
					if(isNaN(H) || isNaN(S) || isNaN(L)){
						return;
					}
				
				//**	H�� 360�϶� 0���� �ٲ�
					if(H==360){
						H = 0;
					}
				
				//**	S, L�� ��ȯ
					S	= S/100;
					L	= L/100;
				
				//**	S�� 0�϶�(���)
					if(S==0){
						R	=	L;
						G	=	L;
						B	=	L;
					}else{
						//**	H�� 0�϶�
							if(H==0){
								tmpH	= 0;
						
						//**	H�� 0�� �ƴҰ��
							}else{
								tmpH	= H/60;
							}
								i		= Math.floor(tmpH);
								j		= tmpH - i;
								
								X	=	L*(1-S);
								Y	=	L*(1-(S*j));
								Z	=	L*(1-(S*(1-j)));
								
								
								switch(i){
									case	0:
										R	=	L;
										G	=	Z;
										B	=	X;
										break;
									case	1:
										R	=	Y;
										G	=	L;
										B	=	X;
										break;
									case	2:
										R	=	X;
										G	=	L;
										B	=	Z;
										break;
									case	3:
										R	=	X;
										G	=	Y;
										B	=	L;
										break;
									case	4:
										R	=	Z;
										G	=	X;
										B	=	L;
										break;
									case	5:
										R	=	L;
										G	=	X;
										B	=	Y;
										break;
								}
					}
										
					tmpColor['Red']		=	Math.round(R * 255);
					tmpColor['Green']	=	Math.round(G * 255);
					tmpColor['Blue']	=	Math.round(B * 255);
					
					return tmpColor;
			}



		//**	HS ���� XY������ ��ȯ
			function FUN_HStoXY(Hue, Sat){
				
				var tmpColor	=	new Array;
				var X, Y;
				var MinX	=	251;
				var MinY	= 	44;
				var MaxX	=	427;
				var MaxY	=	232;
				
				X	=	MinX + (MaxX - MinX) * Hue / 360;
				Y	=	MinY + (MaxY - MinY) * (1 - Sat / 100);
				
				tmpColor['X']	=	X;
				tmpColor['Y']	=	Y;
				
				return tmpColor;
			
			}


		//**	Lum ������ Z�� ���ϱ�
			function FUN_LtoZ(Lum){
			
				var Z;
				var MinY	= 	44;
				var MaxY	=	232;
				
				Z	=	MinY + (MaxY - MinY) * (1 - Lum / 100);
				
				return Z;
				
			}

		//**	RGB ���� HSL�� ��ȯ
			function FUN_RGBtoHSL(Red, Green, Blue){
				
				var tmpColor	=	new Array;
				var Hue, Sat, Lum;
				var Min, Max, tmp;
				
				Red		=	Red / 255;
				Green	=	Green / 255;
				Blue	=	Blue / 255;
				
				//**	RGB �� ū��(Lum��)�� ���� ���� ����
					Min		=	Math.min(Red, Math.min(Green, Blue));
					Max		=	Math.max(Red, Math.max(Green, Blue));
					
					Lum		=	Max;
				
				tmp		=	Max - Min;
				
				//**	Sat�� ����
					if(tmp == 0){
						Sat	=	0;
					}else{
						Sat	=	tmp / Lum;
					}
				
				//**	Hue �� ����
					if(Sat == 0){
						Hue	=	0;
					}else{
						if(Lum == Red){
							if((Red != Green) && (Red != Blue)){
								Hue	=	60*((Green - Blue)/tmp);
							}
						}
						if(Lum == Green){
							if(Green != Blue){
								Hue	=	120 + ((60*(Blue-Red))/tmp);
							}
						}
						if(Lum == Blue){
							Hue	=	240 + ((60*(Red-Green))/tmp);
						}
					}
					
					if(Hue < 0){
						Hue	=	360 + Hue;
					}
				
				//**	HSL���� �迭�� ���� �� ��ȯ
					tmpColor['Hue']	=	Math.round(Hue);
					tmpColor['Sat']	=	Math.round(Sat * 100);
					tmpColor['Lum']	=	Math.round(Lum * 100);
				
				return tmpColor;
			
			}




	//**	���� �Է� Ȯ��
		function FUN_OK(){
		
			var HexRGB	=	document.all['RGB'].value;
			
			if(HexRGB == null || HexRGB.length != 7 || HexRGB.substring(0,1) != '#'){
				alert('������ ������ �ֽñ� �ٶ��ϴ�.');
				return;
			}
			
			window.returnValue = HexRGB.substring(1);
			window.close();
			return;
		
		}




	//**	���� �Է� ���
		function FUN_Cancel(){
			window.returnValue = '';
			window.close();
			return;
		}
	
</script>

<script langauge="JScript" for="window" event="onload">
	
	//**	�⺻ �� ����
		GetHexRGB	=	window.dialogArguments;
		
		if(GetHexRGB == null || GetHexRGB.length != 6){
			GetHexRGB	=	'FFFFFF';
		}
		
		FUN_HexRGB_Input_Color('#' + GetHexRGB);
		
	//**	��Ŀ�� �̵�
		document.all['RGB'].focus();
</script>

<body style="background: threedface; color: windowtext; margin: 0px; border-style: none;">

<form name="Insert_Color">

<table border="0" cellpadding="0" cellspacing="1" style="border-collapse: collapse" width="500" height="390">
	<tr>
		<td width="100%" valign="top" align="center">
		��<table border="0" cellpadding="0" cellspacing="1" style="border-collapse: collapse" width="490">
			<tr>
				<td width="100%" height="20">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="100%">
					<tr>
						<td width="14%">���� ����</td>
						<td width="146%"><hr></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
				<table border="0" cellpadding="0" cellspacing="1" style="border-collapse: collapse" width="480">
					<tr>
						<td width="230" align="center" height="100%" rowspan="2">

	<script language="JScript">
	
		var strHTML = '';
			strHTML = strHTML + '<table cellpadding=0 cellspacing=0 border=0>';

			for (var i=0; i<Colortone.length; i++){
				strHTML = strHTML + '<tr>';
				
				for(var j=0; j<Colortone[i].length; j++){
					strHTML = strHTML + '<td style="padding:1;"><button name="'+ Colortone[i][j] +'" class="Colortone" style="background-color:'+ Colortone[i][j] +';" title="'+ Colortone[i][j] +'" OnClick="javascript:FUN_HexRGB_Input_Color(\''+ Colortone[i][j] +'\');">&nbsp;&nbsp;&nbsp;</button></td>';
				}   
				strHTML = strHTML + '</tr>';
			}
			strHTML = strHTML + '</table>';
			
			document.write(strHTML);
	
	</script>
						</td>
						<td width="200" align="center">
							<div id="ColorChart" style="border: 1px inset; background-image:url('../icon_color_colorchart.jpg'); width:178; height:189;" OnMouseDown="javascript:FUN_ChartClick();" OnMouseMove="javascript:FUN_ChartMove();" OnMouseUp="javascript:FUN_EndDrag();;"> 
								<div style="position:absolute; top:1px; left:0px; width:175; height:187" border=0> 
									<img id="Cursor_Chart" src="../icon_color_cursor.gif" border=0 style="position:absolute; width:19; height:19; left:242; top:221" width="16" height="16"> 
								</div>
							</div>
						</td>
						<td width="50" align="center">
						<div id="ColorBar" style="border: 1px inset; width:12; height:189; background-image:url('../icon_color_colorbar.gif');" OnMouseDown="javascript:FUN_BarClick();" OnMouseMove="javascript:FUN_BarMove();" OnMouseUp="javascript:FUN_EndDrag();">
							<div style="width:100%; height:100%; FILTER:progid:DXImageTransform.Microsoft.Gradient(gradientType=0,startColorStr=#FFFFFF,endColorStr=#000000);"></div>
						</div>
						<img id="Cursor_Bar" src="../icon_color_cursor2.gif" border=0 style="position:absolute; left:472; top:41" width="5" height="9">
						</td>
					</tr>
					<tr>
						<td width="250" rowspan="2" align="center" colspan="2">
						<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="90%">
							<tr>
								<td width="20%" rowspan="3" align="center" valign="bottom">
								<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="100%" height="100%">
									<tr>
										<td width="100%">
										<div id="ColorBox" style="border-style:inset; border-width:1px; width:75; height:50; background-color:#FFFFFF"></div>
										</td>
									</tr>
									<tr>
										<td width="100%" height="25" align="center">
								&nbsp;<input type="text" name="RGB" size="20" value="#000000" style="width:60" OnKeyUp="javascript:FUN_HexRGB_Input_Color(this.value);" maxlength="7" OnFocus="javascript:this.select();"></td>
									</tr>
								</table>
								</td>
								<td width="20%" align="right">Hue:</td>
								<td width="20%" align="center">
								<input type="text" name="Hue" size="20" value="0" style="width:30;" OnKeyUp="javascript:FUN_HSL_Input_Color();" OnFocus="javascript:this.select();" maxlength="3"> ��</td>
								<td width="20%" align="right">Red:</td>
								<td width="20%" align="center">
								<input type="text" name="Red" size="20" value="0" OnKeyUp="javascript:FUN_RGB_Input_Color();" OnFocus="javascript:this.select();" maxlength="3"></td>
							</tr>
							<tr>
								<td width="20%" align="right">Sat:</td>
								<td width="20%" align="center">
								<input type="text" name="Sat" size="20" value="0" style="width:30;" OnKeyUp="javascript:FUN_HSL_Input_Color();" OnFocus="javascript:this.select();" maxlength="3"><font size="1">%</font></td>
								<td width="20%" align="right">Green:</td>
								<td width="20%" align="center">
								<input type="text" name="Green" size="20" value="0" OnKeyUp="javascript:FUN_RGB_Input_Color();" OnFocus="javascript:this.select();" maxlength="3"></td>
							</tr>
							<tr>
								<td width="20%" align="right">Lum:</td>
								<td width="20%" align="center">
								<input type="text" name="Lum" size="20" value="100" style="width:30;" OnKeyUp="javascript:FUN_HSL_Input_Color();" OnFocus="javascript:this.select();" maxlength="3"><font size="1">%</font></td>
								<td width="20%" align="right">Blue:</td>
								<td width="20%" align="center">
								<input type="text" name="Blue" size="20" value="0" OnKeyUp="javascript:FUN_RGB_Input_Color();" OnFocus="javascript:this.select();" maxlength="3"></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td width="230" align="center">
						<button name="InsertColor_OK" OnClick="javascript:FUN_OK();">Ȯ��</button>
						&nbsp;
						<button name="InsertColor_CANCLE" OnClick="javascript:FUN_OK();">���</button></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</form>

</body>

</html>
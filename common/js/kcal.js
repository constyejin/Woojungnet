
//-----------------------------------------------CSS ������ ���� �Լ�
	function onMouse(td){
		td.style.backgroundColor = "#dfdfdf";
		//td.style.color="#000099"
		td.style.fontWeight="bold";
		td.style.cursor="hand";
	}
	function outMouse(td,today){
		if(today=="today"){
			td.style.backgroundColor = "#FFF000";
			td.style.color="#000099"
			td.style.fontWeight="bold";
		}else{
			td.style.backgroundColor = "#ffffff";
			td.style.fontWeight="normal";
		}
	}
//-----------------------------------------------CSS ������ ���� �Լ�

	function datePicker(tYear,tMonth,tDay,tYoil){ // �ؽ�Ʈ�ڽ��� ��¥ �ֱ� ���� ���� �Լ�
		picDate= new Date(tYear,tMonth,tDay);       // ����� ��¥ ��ü ������ ��¥����

		calendar(tYear,tMonth,tDay);   //���õȰɷ� �ٽ� �ѷ�����

		selDate.value=picDate.getFullYear()+"�� "+(picDate.getMonth()+1)+"�� "+picDate.getDate()+"��"+"("+tYoil+")";
		
		document.getElementById('rdate2').innerHTML = picDate.getFullYear()+"�� "+(picDate.getMonth()+1)+"�� "+picDate.getDate()+"�� "+tYoil+"����"; //��¥�� �ð��� 
		document.getElementById('rdate_c').value = picDate.getFullYear()+"-"+(picDate.getMonth()+1)+"-"+picDate.getDate();//hidden����;

	}


function calendar(tYear,tMonth,sday){ //�޷� �Լ�

	var nowDate = new Date();               //���� ��¥ ��ü ����
	var nYear = nowDate.getFullYear();      //������ �⵵
	var nMonth = nowDate.getMonth() ;       //������ �� �� 0������ ����
	var nDate = nowDate.getDate();           //������ ��
	var nNumday = nowDate.getDay();         //������ ���� 0=�Ͽ���...6=�����
	var endDay=new Array(31,28,31,30,31,30,31,31,30,31,30,31);      //������ ������ ��¥
	var dayName=new Array("��", "��", "ȭ", "��", "��", "��", "��"); // ���� ������ ���� ���� �ٲ� �Լ�
	var col=0;  //���߿� �յ� �� ��¥ĭ ��� 

	if (tYear==null)   //null �ϰ��, ó�� �������� �ε� �ɶ��� �⵵�� 
		{tYear=nYear;} // ���� �⵵�� ��������

	if (tMonth==null)   //null �ϰ��, ó�� �������� �ε� �ɶ��� ����
		{tMonth=nMonth;}//���� ���� ��������

		eDate= new Date();       // ����� ��¥ ��ü ����
		eDate.setFullYear(tYear);// ����� �⵵ ����
		eDate.setMonth(tMonth);  // ����� �� ����
		eDate.setDate(1);        // ��¥�� 1�Ϸ� �����ؼ�
		var fNumday=eDate.getDay();    // ù��° ��¥ 1���� ���� ����
		var lastDay=endDay[eDate.getMonth()]; //����� ���� ������ ��¥

		if ((eDate.getMonth()==1)&&(((eDate.getYear()%4==0)&&(eDate.getYear() %100 !=0))||eDate.getYear() % 400 ==0 ))
			{lastDay=29;} // 0�� ���� �����ϹǷ� 1�� 2����. ���� ��� 4�⸶�� 29�� , 100��� 28��, 400�� °�� 29��

		calendarStr  = "<TABLE>"
		calendarStr +="<TR align=center><TD valign=middle>"
		calendarStr +="<a href=javascript:calendar("+tYear+","+(tMonth-1)+") class=preNext>��</a>" //���� �ѱ涧 ���� -1�� �ؼ� �ѱ��(�⵵�� �ڵ� ����)
		calendarStr +="</TD><TD colspan=5 >"
		calendarStr +="<font size=3 color=black>  <b>"+eDate.getFullYear()+"�� "+(eDate.getMonth()+1)+"��</b></font> "// �ش��ϴ� �⵵�� �� ǥ��
		calendarStr +="</TD><TD valign=middle>"
		calendarStr +="<a href=javascript:calendar("+tYear+","+(tMonth+1)+") class=preNext>��</a>" //���� �ѱ涧 ���ϱ� +1�� �ؼ� �ѱ��(�⵵�� �ڵ� ����)
		calendarStr +="</TD></TR><TR>"
		for (i=0;i<dayName.length;i++){			
			calendarStr +="<TD class=week>"+dayName[i] + "</TD>" // ���� ������ ��¥ ���Ϸ� �Է�
		}

		calendarStr +="</TR><TR align=center>"

		for (i=0;i<fNumday;i++){          // ù��° ��¥�� ���� ������ ���ؼ� ���������� ��ĭ ó��
			calendarStr +="<TD>&nbsp;</TD>" 
			col++;                     
		}

		for ( i=1; i<=lastDay; i++){       // �ش� ���� �޷� 
			//if(eDate.getFullYear()==nYear&&eDate.getMonth()==nMonth&&i==nDate && !sday){//�����̰� ���õ� ��¥ ������  today ��Ÿ�Ϸ� ǥ��
			//	calendarStr +="<TD class=today onmouseover=onMouse(this) onmouseout=outMouse(this,'today') onClick=datePicker("+tYear+","+tMonth+","+i+",'"+dayName[col]+"')>"+i+"</TD>" 
			
		//		}
				
				 if(sday && i==sday){
				calendarStr +="<TD class=sunday onmouseover=onMouse(this) onmouseout=outMouse(this,'today') onClick=datePicker("+tYear+","+tMonth+","+i+",'"+dayName[col]+"')>"+i+"</TD>" 
				

				
			}else{

				if(  tYear <=  nYear && tMonth <nMonth || (tYear <=  nYear && tMonth <=nMonth   && i < nDate+14)  ){ 
					if(col==0){       
						calendarStr +="<TD class=sunday  >"+i+"</TD>"
					}else if (col==6){
						calendarStr +="<TD class=satday2  >"+i+"</TD>"
					}else{
						calendarStr +="<TD class=sunday2  >"+i+"</TD>"
					}
				}else{

						if(col==0){              //�Ͽ����̸�
		//					calendarStr +="<TD class=sunday onmouseover=onMouse(this) onmouseout=outMouse(this,'notToday') onClick=datePicker("+tYear+","+tMonth+","+i+",'"+dayName[col]+"')>"+i+"</TD>"
							calendarStr +="<TD class=sunday  >"+i+"</TD>"
						}else if(1<=col&&col<=5){//�׿� ����� ���̸�
							calendarStr +="<TD class=workday onmouseover=onMouse(this) onmouseout=outMouse(this,'notToday') onClick=datePicker("+tYear+","+tMonth+","+i+",'"+dayName[col]+"')>"+i+"</TD>" 
						}else if(col==6){        //������̸�
							calendarStr +="<TD class=satday onmouseover=onMouse(this) onmouseout=outMouse(this,'notToday') onClick=datePicker("+tYear+","+tMonth+","+i+",'"+dayName[col]+"')>"+i+"</TD>" 
						}
				}

			}			
			col++;

			if(col==7){     //7ĭ�� ����� �� �ٲپ� �� ���� ����� �ٽ� ù ĭ���� ����
				calendarStr +="</TR><TR align=center>"
				col=0;
			}
		}   

		for (i=col;i<dayName.length;i++){        //������ ������ ���� ������ �� ĭ �����
			calendarStr +="<TD>&nbsp;</TD>"
		}


		calendarStr +="</TR><TR align=center><TD colspan=7 ><input name=selDate class=selDate type=text readonly></TD></TR></TABLE>"
		document.getElementById('calendarView').innerHTML = calendarStr
}

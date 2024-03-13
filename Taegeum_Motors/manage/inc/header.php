<?  
include ($_SERVER['DOCUMENT_ROOT']."/lib/config.php");
include ($_SERVER['DOCUMENT_ROOT']."/lib/common.php");
$connect = dbconn();

if($loginUsort != "admin" && $loginUsort != "admin1" && $loginUsort != "admin2" && $loginUsort != "admin3" && $loginUsort != "superadmin" && $loginUsort != "jisajang2"){
	movepage("/index.php", "관리자 로그인이 필요합니다.");
	MsgMov("관리자 로그인이 필요합니다.","/index.php");
	exit;
}

$d_adm=explode("/", $_SERVER['PHP_SELF']);
if($d_adm[2]!="Sale"&&$loginUsort == "jisajang2"){
	exit;
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>태금모터스 관리자</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='stylesheet' href='/common/css/adm_style.css' type='text/css'> 
<link rel='stylesheet' href='/common/css/admin_style.css' type='text/css'>
<script language="JavaScript" src="/common/js/manage_default.js"></script> 
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<!-- swiper.js css-->
	<link
		rel="stylesheet"
		href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
	/>
	<!-- swiper.js js-->
	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<style>
#CalendarControlIFrame {
  display: none;
  left: 0px;
  position: absolute;
  top: 0px;
  height: 250px;
  width: 250px;
  z-index: 99;
}

#CalendarControl {
  position:absolute;
  background-color:#FFF;
  margin:0;
  padding:0;
  display:none;
  z-index: 100;
}

#CalendarControl table {
  font-family: verdana;
  font-size: 11px;
  letter-spacing:-1px;
  border-left: 1px solid #003399;
  border-right: 1px solid #003399;
}

#CalendarControl th {
  font-weight: normal;
}

#CalendarControl th a {
  font-weight: normal;
  text-decoration: none;
  color: #FFF;
  padding: 1px;
}

#CalendarControl td {
  text-align: center;
}

#CalendarControl .header {
  background-color: #003399;
}

#CalendarControl .weekday {
  background-color: #DDD;
  color: #000;
}

#CalendarControl .weekend {
  background-color: #8CAAE6;
  color: #000;
}

#CalendarControl .current {
  border: 1px solid #003399;
  background-color: #003399;
  color: #FFF;
}

#CalendarControl .weekday,
#CalendarControl .weekend,
#CalendarControl .current {
  display: block;
  text-decoration: none;
  border: 1px solid #FFF;
  width: 2em;
}

#CalendarControl .weekday:hover,
#CalendarControl .weekend:hover,
#CalendarControl .current:hover {
  color: #FFF;
  background-color: #003399;
  border: 1px solid #999;
}

#CalendarControl .previous {
  text-align: left;
}

#CalendarControl .next {
  text-align: right;
}

#CalendarControl .previous,
#CalendarControl .next {
  padding: 1px 3px 1px 3px;
  font-size: 1.4em;
}

#CalendarControl .previous a,
#CalendarControl .next a {
  color: #FFF;
  text-decoration: none;
  font-weight: bold;
}

#CalendarControl .title {
  text-align: center;
  font-weight: bold;
  color: #FFF;
}

#CalendarControl .empty {
  background-color: #CCC;
  border: 1px solid #FFF;
}

.hand {cursor:pointer;}
</style>
</head>
<body>

<script   language="javascript" >

function openwind(){
	window.open("/admin/inc/admpass.php","","left=200,top=50,height=200,width=300");
}

function positionInfo(object) {

  var p_elm = object;

  this.getElementLeft = getElementLeft;
  function getElementLeft() {
    var x = 0;
    var elm;
    if(typeof(p_elm) == "object"){
      elm = p_elm;
    } else {
      elm = document.getElementById(p_elm);
    }
    while (elm != null) {
      x+= elm.offsetLeft;
      elm = elm.offsetParent;
    }
    return parseInt(x);
  }

  this.getElementWidth = getElementWidth;
  function getElementWidth(){
    var elm;
    if(typeof(p_elm) == "object"){
      elm = p_elm;
    } else {
      elm = document.getElementById(p_elm);
    }
    return parseInt(elm.offsetWidth);
  }

  this.getElementRight = getElementRight;
  function getElementRight(){
    return getElementLeft(p_elm) + getElementWidth(p_elm);
  }

  this.getElementTop = getElementTop;
  function getElementTop() {
    var y = 0;
    var elm;
    if(typeof(p_elm) == "object"){
      elm = p_elm;
    } else {
      elm = document.getElementById(p_elm);
    }
    while (elm != null) {
      y+= elm.offsetTop;
      elm = elm.offsetParent;
    }
    return parseInt(y);
  }

  this.getElementHeight = getElementHeight;
  function getElementHeight(){
    var elm;
    if(typeof(p_elm) == "object"){
      elm = p_elm;
    } else {
      elm = document.getElementById(p_elm);
    }
    return parseInt(elm.offsetHeight);
  }

  this.getElementBottom = getElementBottom;
  function getElementBottom(){
    return getElementTop(p_elm) + getElementHeight(p_elm);
  }
}

function CalendarControl() {

  var calendarId = 'CalendarControl';
  var currentYear = 0;
  var currentMonth = 0;
  var currentDay = 0;

  var selectedYear = 0;
  var selectedMonth = 0;
  var selectedDay = 0;

  var months = ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'];
  var dateField = null;

  function getProperty(p_property){
    var p_elm = calendarId;
    var elm = null;

    if(typeof(p_elm) == "object"){
      elm = p_elm;
    } else {
      elm = document.getElementById(p_elm);
    }
    if (elm != null){
      if(elm.style){
        elm = elm.style;
        if(elm[p_property]){
          return elm[p_property];
        } else {
          return null;
        }
      } else {
        return null;
      }
    }
  }

  function setElementProperty(p_property, p_value, p_elmId){
    var p_elm = p_elmId;
    var elm = null;

    if(typeof(p_elm) == "object"){
      elm = p_elm;
    } else {
      elm = document.getElementById(p_elm);
    }
    if((elm != null) && (elm.style != null)){
      elm = elm.style;
      elm[ p_property ] = p_value;
    }
  }

  function setProperty(p_property, p_value) {
    setElementProperty(p_property, p_value, calendarId);
  }

  function getDaysInMonth(year, month) {
    return [31,((!(year % 4 ) && ( (year % 100 ) || !( year % 400 ) ))?29:28),31,30,31,30,31,31,30,31,30,31][month-1];
  }

  function getDayOfWeek(year, month, day) {
    var date = new Date(year,month-1,day)
    return date.getDay();
  }

  this.clearDate = clearDate;
  function clearDate() {
    dateField.value = '';
    hide();
  }

  this.setDate = setDate;
  function setDate(year, month, day) {
    if (dateField) {
      if (month < 10) {month = "0" + month;}
      if (day < 10) {day = "0" + day;}

      var dateString = year+"-"+month+"-"+day;
      dateField.value = dateString;
      hide();
    }
    return;
  }

  this.changeMonth = changeMonth;
  function changeMonth(change) {
    currentMonth += change;
    currentDay = 0;
    if(currentMonth > 12) {
      currentMonth = 1;
      currentYear++;
    } else if(currentMonth < 1) {
      currentMonth = 12;
      currentYear--;
    }

    calendar = document.getElementById(calendarId);
    calendar.innerHTML = calendarDrawTable();
  }

  this.changeYear = changeYear;
  function changeYear(change) {
    currentYear += change;
    currentDay = 0;
    calendar = document.getElementById(calendarId);
    calendar.innerHTML = calendarDrawTable();
  }

  function getCurrentYear() {
    var year = new Date().getYear();
    if(year < 1900) year += 1900;
    return year;
  }

  function getCurrentMonth() {
    return new Date().getMonth() + 1;
  } 

  function getCurrentDay() {
    return new Date().getDate();
  }

  function calendarDrawTable() {

    var dayOfMonth = 1;
    var validDay = 0;
    var startDayOfWeek = getDayOfWeek(currentYear, currentMonth, dayOfMonth);
    var daysInMonth = getDaysInMonth(currentYear, currentMonth);
    var css_class = null; //CSS class for each day

    var table = "<table cellspacing='0' cellpadding='0' border='0'>";
    table = table + "<tr class='header'>";
    table = table + "  <td colspan='2' class='previous'><a href='javascript:changeCalendarControlMonth(-1);'>&lt;</a> <a href='javascript:changeCalendarControlYear(-1);'>&laquo;</a></td>";
    table = table + "  <td colspan='3' class='title'>" + currentYear +"년<br>" + months[currentMonth-1] + "</td>";
    table = table + "  <td colspan='2' class='next'><a href='javascript:changeCalendarControlYear(1);'>&raquo;</a> <a href='javascript:changeCalendarControlMonth(1);'>&gt;</a></td>";
    table = table + "</tr>";
    table = table + "<tr><th>S</th><th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th></tr>";

    for(var week=0; week < 6; week++) {
      table = table + "<tr>";
      for(var dayOfWeek=0; dayOfWeek < 7; dayOfWeek++) {
        if(week == 0 && startDayOfWeek == dayOfWeek) {
          validDay = 1;
        } else if (validDay == 1 && dayOfMonth > daysInMonth) {
          validDay = 0;
        }

        if(validDay) {
          if (dayOfMonth == selectedDay && currentYear == selectedYear && currentMonth == selectedMonth) {
            css_class = 'current';
          } else if (dayOfWeek == 0 || dayOfWeek == 6) {
            css_class = 'weekend';
          } else {
            css_class = 'weekday';
          }

          table = table + "<td><a class='"+css_class+"' href=\"javascript:setCalendarControlDate("+currentYear+","+currentMonth+","+dayOfMonth+")\">"+dayOfMonth+"</a></td>";
          dayOfMonth++;
        } else {
          table = table + "<td class='empty'>&nbsp;</td>";
        }
      }
      table = table + "</tr>";
    }

    table = table + "<tr class='header'><th colspan='7' style='padding: 3px;'><a href='javascript:clearCalendarControl();'>Clear</a> | <a href='javascript:hideCalendarControl();'>Close</a></td></tr>";
    table = table + "</table>";

    return table;
  }

  this.show = show;
  function show(field) {
  
    // If the calendar is visible and associated with
    // this field do not do anything.
    if (dateField == field) {
      return;
    } else {
      dateField = field;
    }

    if(dateField) {
      try {
        var dateString = new String(dateField.value);
        var dateParts = dateString.split("/");
        
       selectedYear = parseInt(dateParts[0],10);
	selectedMonth = parseInt(dateParts[1],10);
	selectedDay = parseInt(dateParts[2],10);
      } catch(e) {}
    }

    if (!(selectedYear && selectedMonth && selectedDay)) {
      selectedMonth = getCurrentMonth();
      selectedDay = getCurrentDay();
      selectedYear = getCurrentYear();
    }
	

	


    currentMonth = selectedMonth;
    currentDay = selectedDay;
    currentYear = selectedYear;

	


    if(document.getElementById){

      calendar = document.getElementById(calendarId);
      calendar.innerHTML = calendarDrawTable(currentYear, currentMonth);

      setElementProperty('display', 'block', 'CalendarControlIFrame');
      setProperty('display', 'block');

      var fieldPos = new positionInfo(dateField);
      var calendarPos = new positionInfo(calendarId);

      var x = fieldPos.getElementLeft();
      var y = fieldPos.getElementBottom();

      setProperty('left', x + "px");
      setProperty('top', y + "px");
      setElementProperty('left', x + "px", 'CalendarControlIFrame');
      setElementProperty('top', y + "px", 'CalendarControlIFrame');
      setElementProperty('width', calendarPos.getElementWidth() + "px", 'CalendarControlIFrame');
      setElementProperty('height', calendarPos.getElementHeight() + "px", 'CalendarControlIFrame');
    }
  }

  this.hide = hide;
  function hide() {
    if(dateField) {
      setProperty('display', 'none');
      setElementProperty('display', 'none', 'CalendarControlIFrame');
      dateField = null;
    }
  }

  this.visible = visible;
  function visible() {
    return dateField
  }
}

var calendarControl = new CalendarControl();


function Calendar(textField) {  	
	 //var ctextField = document.getElementById(textField);
	 showCalendarControl(textField);
}


function showCalendarControl(textField) {  	
	 //var ctextField = document.getElementById(textField);
	 calendarControl.show(textField);
}

function clearCalendarControl() {
  calendarControl.clearDate();
}

function hideCalendarControl(flag) {
  if (calendarControl.visible()) {
    if (flag) {
      calendarControl.hide();
    } else {
      window.setTimeout('hideCalendarControl(true)',200);
    }
  }
}

function setCalendarControlDate(year, month, day) {	
  calendarControl.setDate(year, month, day);  	
}

function changeCalendarControlYear(change) {
  calendarControl.changeYear(change);
}

function changeCalendarControlMonth(change) {
  calendarControl.changeMonth(change);
}

document.write("<iframe id='CalendarControlIFrame' src='' frameBorder='0' scrolling='no'></iframe>");
document.write("<div id='CalendarControl'></div>");
</script>


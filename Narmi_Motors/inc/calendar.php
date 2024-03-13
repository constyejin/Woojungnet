<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            //모든 datepicker에 대한 공통 옵션 설정
            $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd' //Input Display Format 변경
                ,showOtherMonths: true //빈 공간에 현재월의 앞뒤월의 날짜를 표시
                ,showMonthAfterYear:true //년도 먼저 나오고, 뒤에 월 표시
                ,changeYear: true //콤보박스에서 년 선택 가능
                ,changeMonth: true //콤보박스에서 월 선택 가능                
                ,showOn: "both" //button:버튼을 표시하고,버튼을 눌러야만 달력 표시 ^ both:버튼을 표시하고,버튼을 누르거나 input을 클릭하면 달력 표시  
                ,buttonImage: "/images/icon_data.gif" //버튼 이미지 경로
                ,buttonImageOnly: true //기본 버튼의 회색 부분을 없애고, 이미지만 보이게 함
                ,buttonText: "선택" //버튼에 마우스 갖다 댔을 때 표시되는 텍스트                
                ,yearSuffix: "년" //달력의 년도 부분 뒤에 붙는 텍스트
                ,monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'] //달력의 월 부분 텍스트
                ,monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'] //달력의 월 부분 Tooltip 텍스트
                ,dayNamesMin: ['일','월','화','수','목','금','토'] //달력의 요일 부분 텍스트
                ,dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'] //달력의 요일 부분 Tooltip 텍스트
                ,onSelect: function(dateText) {
                    // 변하는 내용이 있을 때 호출되는 함수이다.
                    if(this.id == "mdate"){
                        // 시작에서 선택한 날짜를 마지막의 처음 날짜로 설정한다.
                        var minDate = $(this).datepicker('getDate');
                        
                    }else if(this.id == "datePickEnd"){
                        // 마지막에서 선택한 날짜를 시작의 마지막 날짜로 설정한다.
                        var maxDate = $(this).datepicker('getDate');
                    }
                }                
            });
 
            //input을 datepicker로 선언
            $("#sdate").datepicker({
                                        changeMonth: false,
                                        changeYear: false
                                    });                    
            $("#edate").datepicker({
                                        changeMonth: false,
                                        changeYear: false
                                    });                    
        });
    </script>
<style>
/*datepicer 버튼 롤오버 시 손가락 모양 표시*/
.ui-datepicker-trigger{cursor: pointer;}
/*datepicer input 롤오버 시 손가락 모양 표시*/
.hasDatepicker{cursor: pointer;}
/*ui-datepicker-trigger에서 9px를 올려준 것은 이미지가 살짝 위로 올라가서 위치를 조정하기 위해서 */
.ui-datepicker-trigger{
    position:relative;
    top:6px;
}
</style>
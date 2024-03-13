<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            //��� datepicker�� ���� ���� �ɼ� ����
            $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd' //Input Display Format ����
                ,showOtherMonths: true //�� ������ ������� �յڿ��� ��¥�� ǥ��
                ,showMonthAfterYear:true //�⵵ ���� ������, �ڿ� �� ǥ��
                ,changeYear: true //�޺��ڽ����� �� ���� ����
                ,changeMonth: true //�޺��ڽ����� �� ���� ����                
                ,showOn: "both" //button:��ư�� ǥ���ϰ�,��ư�� �����߸� �޷� ǥ�� ^ both:��ư�� ǥ���ϰ�,��ư�� �����ų� input�� Ŭ���ϸ� �޷� ǥ��  
                ,buttonImage: "/images/icon_data.gif" //��ư �̹��� ���
                ,buttonImageOnly: true //�⺻ ��ư�� ȸ�� �κ��� ���ְ�, �̹����� ���̰� ��
                ,buttonText: "����" //��ư�� ���콺 ���� ���� �� ǥ�õǴ� �ؽ�Ʈ                
                ,yearSuffix: "��" //�޷��� �⵵ �κ� �ڿ� �ٴ� �ؽ�Ʈ
                ,monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'] //�޷��� �� �κ� �ؽ�Ʈ
                ,monthNames: ['1��','2��','3��','4��','5��','6��','7��','8��','9��','10��','11��','12��'] //�޷��� �� �κ� Tooltip �ؽ�Ʈ
                ,dayNamesMin: ['��','��','ȭ','��','��','��','��'] //�޷��� ���� �κ� �ؽ�Ʈ
                ,dayNames: ['�Ͽ���','������','ȭ����','������','�����','�ݿ���','�����'] //�޷��� ���� �κ� Tooltip �ؽ�Ʈ
                ,onSelect: function(dateText) {
                    // ���ϴ� ������ ���� �� ȣ��Ǵ� �Լ��̴�.
                    if(this.id == "mdate"){
                        // ���ۿ��� ������ ��¥�� �������� ó�� ��¥�� �����Ѵ�.
                        var minDate = $(this).datepicker('getDate');
                        
                    }else if(this.id == "datePickEnd"){
                        // ���������� ������ ��¥�� ������ ������ ��¥�� �����Ѵ�.
                        var maxDate = $(this).datepicker('getDate');
                    }
                }                
            });
 
            //input�� datepicker�� ����
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
/*datepicer ��ư �ѿ��� �� �հ��� ��� ǥ��*/
.ui-datepicker-trigger{cursor: pointer;}
/*datepicer input �ѿ��� �� �հ��� ��� ǥ��*/
.hasDatepicker{cursor: pointer;}
/*ui-datepicker-trigger���� 9px�� �÷��� ���� �̹����� ��¦ ���� �ö󰡼� ��ġ�� �����ϱ� ���ؼ� */
.ui-datepicker-trigger{
    position:relative;
    top:6px;
}
</style>
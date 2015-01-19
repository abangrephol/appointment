$(document).ready(function(){
    function submitForm(form){
        //$( ".form" ).submit(function( event ) {

        var $form = $( form ),
            data = $form.serialize(),
            url = $form.attr( "action" );
        $child = $form.closest('.tab-pane,.panel');
        $child.find('.alert').addClass('hidden');

        var posting = $.post( url, { paymentData: data,
            serviceData: $.cookie('appdata-service'),
            customerData: $.cookie('appdata-customer-s'),
            customerType: $.cookie('appdata-customer-type')
        } );

        posting.done(function( data ) {

            if(data.failed) {

                $.each(data.message, function( index, value ) {
                    var errorDiv = "#"+index+"_error";
                    $child.find(errorDiv).closest('.form-group').removeClass('has-success').addClass('has-error');
                    $child.find(errorDiv).html(value).show();
                });
                $child.find('#successMessage').html(data.flashMessage);
                $child.find('.alert').removeClass('hidden').removeClass('alert-success').addClass('alert-danger');
            }
            if(data.success) {

               $('.appointment').fadeOut('slow').html('Success').fadeIn('slow');
            } //success
        }); //done
        //});
    }

    function validateFormCustomer(){
        //jQuery.each(jQuery(""),function(i,l){
            $('.form').validate({
                highlight: function(element) {
                    jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                success: function(element) {
                    jQuery(element).closest('.form-group').removeClass('has-error');
                }
            });
        //});

    }
    function validateFormConfirm(){
        //jQuery.each(jQuery(""),function(i,l){
        $('.form-confirm').validate({
            highlight: function(element) {
                jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            },
            errorPlacement: function(error, element) {
                error.appendTo( jQuery(element).closest('[class*="col"]') );

            },
            rules:{
                price:{
                    required:true,
                    number:true
                },
                deposit:{
                    required:true,
                    number:true
                },
                tax:{
                    required:true,
                    number:true
                },
                priceTotal:{
                    required:true,
                    number:true
                }
            }
        });
        //});

    }
    function textareaGrow(){
        jQuery('.ta-grow').autogrow();
    }
    function tabFormAppointment(){
        jQuery('.appointment').bootstrapWizard({
            tabClass: 'nav nav-pills nav-justified nav-disabled-click', //
            onTabClick: function(tab,navigation,index){
                return false;
            },
            onNext: function(tab,navigation,index){
                $('.appointment').bootstrapWizard('enable',index);
                $(tab).addClass('loaded');
            },
            onTabShow: function(tab,navigation,index){
                loadTabAppointment(tab,index);
            }
        });

    }
    tabFormAppointment();
    function tabFormCustomer(){
        $('.tab-customer > div > [data-toggle="tab"]').on('click',function(e){
            $('.tab-customer > div > [data-toggle="tab"]').each(function(){
                $(this).removeClass('btn-primary active').addClass('btn-default');
            })
            $(this).removeClass('btn-default').addClass('btn-primary active');
        })
    }
    var serviceInited=false, customerInited=false;
    var TABSERVICE= 0,TABCUSTOMER= 1,TABCONFIRM= 2;
    function loadTabAppointment(tab,index){
        if(!$(tab).hasClass('loaded'))
            $($(tab).find('a').attr('href'))
                .load($(tab).find('a').data("url")
                ,function(e){
                    $(this).addClass('active');
                    if(!serviceInited && index==TABSERVICE){

                        callendarService();
                        selectService();

                        serviceInited = true;
                    }
                    else if(index==TABCUSTOMER){

                        tabFormCustomer();
                        validateFormCustomer();
                        buttonProceedCustomer();

                        //customerInited = true;
                    }
                    else if(index==TABCONFIRM){
                        var services = $.cookie('appdata-service'),
                            customerData = $.cookie('appdata-customer'),
                            customerType = $.cookie('appdata-customer-type');
                        var price = 0;
                        services = services.split('||');
                        services.forEach(function(value,index){
                            var serviceData = value.split("##");
                            var serviceDate = moment(serviceData[2]+' '+serviceData[3]);
                            price += Number(serviceData[4]);
                            $('.table-service tbody').append('' +
                                '<tr>' +
                                '<td>'+serviceData[1]+'</td>' +
                                '<td><b>'+serviceDate.format('dddd, DD MMMM YYYY') + '</b> at '+
                                serviceDate.format('HH:mm A')+'</td>' +
                                '</tr>');
                        })

                        switch (customerType){
                            case "new":
                                customerData = $.parseJSON(customerData);
                                customerData.forEach(function(val,ind){
                                    if(ind>0){
                                        $('.table-customer #customer-'+val['name']).html(val['value']);
                                    }
                                })
                                break;
                            case "return" :

                                var customerJson = null;
                                jQuery.ajax({
                                    type : "GET",
                                    url : laroute.route('json.customer',{'id':customerData}),
                                    success: function(html){
                                        customerJson = html;
                                        $('.table-customer #customer-first')
                                            .html(customerJson.first+" "+customerJson.last);
                                        $('.table-customer #customer-email')
                                            .html(customerJson.email);
                                        $('.table-customer #customer-address_1')
                                            .html(customerJson.address_1);
                                        $('.table-customer #customer-address_2')
                                            .html(customerJson.address_2);
                                        $('.table-customer #customer-zip')
                                            .html(customerJson.zip);
                                    }
                                })

                                break;
                        }

                        $('.table-payment #price').val(price);
                        $('.table-payment #deposit').val(0);
                        $('.table-payment #tax').val(price * 0.1);
                        $('.table-payment #priceTotal').val(
                            price
                            + Number($('.table-payment #tax').val()));
                        validateFormConfirm();
                        buttonProceedConfirm();
                    }
                }
            );
        else
        {

        }
    }
    function selectService(){
        $('.btn-service').on('click',function(e){
            if($(this).hasClass('selected')){
                $(this).button('reset')
                    .removeClass('selected btn-success').addClass('btn-black');

            }else{
                $(this).button('selected')
                    .addClass('selected btn-success').removeClass('btn-black');
                $(this+" li").removeClass('hidden');

            }
            loadTime();
        });
    }
    function selectServiceTime(timeEl){
        $(timeEl+' .btn-service-time').on('click',function(e){
            $(timeEl+' .btn-service-time').each(function(e){
                $(this).button('reset').removeClass('selected btn-success').addClass('btn-default');
            });
            if($(this).hasClass('selected')){
                $(this).button('reset')
                    .removeClass('selected btn-success').addClass('btn-default');

            }else{
                $(this).button('selected')
                    .addClass('selected btn-success').removeClass('btn-default');
            }
            checkSelectingDone();
        });
    }
    function checkSelectingDone(){
        if($('.btn-service-time.selected').length == $('.btn-service.selected').length){
            $("#btn-proceed").removeClass('disabled');
            buttonProceedService();
        }else{
            $("#btn-proceed").addClass('disabled');
        }


    }
    function buttonProceedService(){
        $('#btn-proceed').off('click');
        $('#btn-proceed:not(.disabled)').on('click',function(){
            var service = [];
            $('.btn-service-time.selected').each(function(e){
               service.push($(this).data('service-id')+'##'
                   +$(this).data('service-name')+'##'
                   +$(this).data('service-date')+'##'
                   +$(this).data('service-time')+'##'
                   +$(this).data('service-price')
               )
            });
            $.cookie('appdata-service',service.join('||'));
            jQuery('.appointment').bootstrapWizard('next');
        });
    }
    function buttonProceedCustomer(){
        $('#btn-proceed-customer').off('click');
        $('#btn-proceed-customer:not(.disabled)').on('click',function(){
            switch($('.tab-customer .btn.active').data('customer-type')){
                case 'new':
                    if($('.form').valid()){
                        var $form = $('.form'),
                            data = JSON.stringify($form.serializeArray()),
                            dataForm = $form.serialize();
                        $.cookie('appdata-customer',data);
                        $.cookie('appdata-customer-s',dataForm);
                        $.cookie('appdata-customer-type',$('.tab-customer .btn.active').data('customer-type'));
                        jQuery('.appointment').bootstrapWizard('next');
                    }
                    break;
                case 'return' :
                    if($('.customer-select').length){
                        $.cookie('appdata-customer',$('.customer-select').data('customer-id'));
                        $.cookie('appdata-customer-s',$('.customer-select').data('customer-id'));
                        $.cookie('appdata-customer-type',$('.tab-customer .btn.active').data('customer-type'));
                        jQuery('.appointment').bootstrapWizard('next');
                    }

                    break;
            }


        });
    }
    function buttonProceedConfirm(){
        $('#btn-proceed-confirm').off('click');
        $('#btn-proceed-confirm:not(.disabled)').on('click',function(){

            if($('.form-confirm').valid()){
                submitForm($('.form-confirm'));
            }



        });
    }
    function callendarService(){

        jQuery('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'today'
            },
            editable: true,
            height: 200,

            dayClick:function(date,jsEvent,view){
                $('.fc-day.fc-selected').each(function(e){ $(this).removeClass('fc-selected'); })
                $(view.target).closest('.fc-day').addClass('fc-selected');

                selectedDate = moment(date);
                isDateSelected = true;
                loadTime();
            }
        });

    }
    var selectedDate = moment();
    var isDateSelected = false;
    function loadTime(){

        if(isDateSelected){
            var isHasService = false;
            $('.btn-service').each(function(e){
                if(!$(this).hasClass('selected')){
                    var id = $(this).data('service-id');
                    if($('#time-'+id).length)
                    {
                        $('#time-'+id).fadeOut('normal');
                    }
                }
            });
            $('.btn-service.selected').each(function(e){
                isHasService = true;
                var id = $(this).data('service-id');
                $('#time-'+id).fadeOut('normal');
                $('.ta-loader').fadeIn('normal');
                jQuery.ajax({
                    type: "GET",
                    url: laroute.route('w.ta',{'date':selectedDate,'data':$(this).data('service-id')}),
                    success: function(html){
                        if($('#time-'+id).length)
                        {
                            $('#time-'+id).html(html).fadeIn('normal');
                        }else{
                            $('#times').append('<div id="time-'+id+'" class="col-md-6"></div>');
                            $('#time-'+id).html(html).fadeIn('normal');
                        }
                        $('.ta-loader').fadeOut('normal');
                        selectServiceTime('#time-'+id);
                        checkSelectingDone();
                    }
                })
            })
            if(!isHasService){
                $('.ta-alert').fadeIn('normal');
            }else{
                $('.ta-alert').fadeOut('normal');
            }

        }




    }
});
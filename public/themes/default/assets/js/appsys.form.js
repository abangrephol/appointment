$(document).ready(function(){
    function submitForm(form){
        //$( ".form" ).submit(function( event ) {


            //event.preventDefault();

            var $form = $( form ),
                data = $form.serialize(),
                url = $form.attr( "action" );
            $child = $form.closest('.tab-pane,.panel');
            $child.find('.alert').addClass('hidden');

            var posting = $.post( url, { formData: data } );

            posting.done(function( data ) {

                if(data.failed) {

                    $.each(data.message, function( index, value ) {
                        var errorDiv = "#"+index+"_error";
                        //jQuery(errorDiv).closest('.error').hide();

                        $child.find(errorDiv).closest('.form-group').removeClass('has-success').addClass('has-error');
                        $child.find(errorDiv).html(value).show();
                    });
                    $child.find('#successMessage').html(data.flashMessage);
                    $child.find('.alert').removeClass('hidden').removeClass('alert-success').addClass('alert-danger');

                }
                if(data.success) {

                    $child.find('.form-group').removeClass('has-error');
                    $child.find('#successMessage').html(data.flashMessage);
                    $child.find('.alert').removeClass('hidden').removeClass('alert-danger').addClass('alert-success');
                    if($('.appointment').length )
                        $('.appointment').bootstrapWizard('next');
                } //success
            }); //done
        //});
    }

    function validateForm(){
        jQuery.each(jQuery(".form"),function(i,l){
           $(l).validate({
               highlight: function(element) {
                   jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
               },
               success: function(element) {
                   jQuery(element).closest('.form-group').removeClass('has-error');
               },
               errorPlacement: function(error, element) {
                   //error.appendTo(  );
                   jQuery(element).closest('div[class*="col"]').find('.error').html(error);
               },
               submitHandler: function(form) {
                   submitForm(form);
               }
           });
        });

    }
    function textareaGrow(){
        jQuery('.ta-grow').autogrow({onInitialize: false});
    }
    function tabForm(){
        $('.basic-wizard:not(.appointment) a[data-toggle="tab"]').on('click',function(e){

            $($(this).attr('href')).load($(this).data("url"),function(e){
                validateForm();
            });
            $($(this).attr('href')+" .alert").addClass('hidden');

        });
        jQuery('.appointment').bootstrapWizard({
            tabClass: 'nav nav-pills nav-justified nav-disabled-click',
            onTabClick: function(tab, navigation, index) {
                return false;
            }
        });
        $($('.basic-wizard li[class="active"] a[data-toggle="tab"]').attr('href'))
            .load($('.basic-wizard li[class="active"] a[data-toggle="tab"]').data("url")
                ,function(e){
                    $(this).addClass('active');
                    callendarService();
                    validateForm();

                }
            );
    }
    function formatTime(){
        jQuery('.app-time').each(function(){
            jQuery(this).html(moment(jQuery(this).html()).format('DD-MMM-YYYY, H:m A'));
        })
    }
    function callendarService(){
        jQuery('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            editable: true,
            height: 200,
            dayClick:function(date,jsEvent,view){
                $('.fc-day.fc-selected').each(function(e){ $(this).removeClass('fc-selected'); })
                $(view.target).closest('.fc-day').addClass('fc-selected');
            }
        });
    }
    function tagsInput(){
        var engine = new Bloodhound({
                remote: {
                    url: '/employee/specialize/all?term=%QUERY',
                    filter: function (response) {
                        return $.map(response, function (special) {
                            return {
                                id:special.id,
                                value: special.value,
                                label: special.value
                            };
                        });
                    }
                },
                datumTokenizer: function(d) {
                    return Bloodhound.tokenizers.whitespace(d.value);
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();
        $('#specialize').tokenfield({
            typeahead: [
                null,
                {
                    name: 'specialize',
                    displayKey: 'label',
                    source: engine.ttAdapter()
                }
            ],
            showAutocompleteOnFocus: true,
            beautify : false
        }).on('tokenfield:createtoken', function (event) {
            var existingTokens = $(this).tokenfield('getTokens');
            $.each(existingTokens, function(index, token) {
                if (token.value === event.attrs.value) {
                    event.preventDefault();
                }
            });
        });

    }
    function editField(){
        $.each($('.del-field'),function(index,el){
            $(el).on('click',function(e){
                $(this).closest('.form-group').remove();
            });
        })
        $.each($('.edit-field'),function(index,el){
            $(el).on('click',function(e){
                if($('#panel-add').length!=0){
                    $('#panel-add').remove();
                }
                $(this).closest('.panel-body').append($('#fieldtpl').html());
                formAdd(this);
                $('#panel-add #new-field').val($(this).data('field-name'));
                $('#panel-add #new-field-type').val($(this).data('field-type'));
                $('#panel-add #new-field-req').val($(this).data('field-req'));
            });
        })

    }
    editField();
    function formAdd(el){

        $('#panel-add .cancel').on('click',function(){
            $('#panel-add').remove();
        })
        $('#panel-add .add').on('click',function(){
            //customField.push({ name:$('#panel-add').find('#new-field').val(), type:$('#panel-add').find('#new-field-type').val() });
            var row = $('#fieldtpl-row').html();
            row = row.replace(/\{name}/g,$('#panel-add').find('#new-field').val())
                .replace(/\{type}/g,$('#panel-add').find('#new-field-type option:selected').text())
                .replace(/\{req}/g,$('#panel-add').find('#new-field-req option:selected').val()=='1'?'required':'optional')
                .replace(/\{val-type}/g,$('#panel-add').find('#new-field-type').val())
                .replace(/\{val-req}/g,$('#panel-add').find('#new-field-req').val());
            if($(el).attr('id')!=$('#addfield').attr('id'))
            {
                $(row).insertBefore($(el).closest('.form-group'));
                $(el).closest('.form-group').remove();
            }
            else
                $(this).closest('.panel-body').append(row);

            $('.del-field').on('click',function(e){
                $(this).closest('.form-group').remove();
            });
            $('.edit-field').on('click',function(e){
                if($('#panel-add').length!=0){
                    $('#panel-add').remove();
                }
                $(this).closest('.panel-body').append($('#fieldtpl').html());
                formAdd(this);
                $('#panel-add #new-field').val($(this).data('field-name'));
                $('#panel-add #new-field-type').val($(this).data('field-type'));
                $('#panel-add #new-field-req').val($(this).data('field-req'));

            });
            $('#panel-add').remove();
        })
    }
    function addField(){

        $('#addfield').on('click',function(){
            if($('#panel-add').length==0){
                $(this).closest('.panel-body').append($('#fieldtpl').html());
                formAdd(this);
            }


        })
    }
    addField();
    tabForm();
    validateForm();
    textareaGrow();
    formatTime();
    tagsInput();
});
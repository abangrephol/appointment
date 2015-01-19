$(document).ready(function(){
    function submitModalForm(){
        $( ".form" ).submit(function( event ) {
            $('.bs-delete-modal').modal('hide');
            event.preventDefault();

            var $form = $( this ),
                data = $form.serialize(),
                url = $form.attr( "action" );

            var posting = $.post( url, { formData: data ,"_method":"DELETE"} );

            posting.done(function( data ) {
                if(data.failed) {
                    jQuery.gritter.add({
                        title: 'Notification',
                        text: 'Delete failed.',
                        class_name: 'growl-danger',
                        sticky: false,
                        time: ''
                    });
                    oTable.fnDraw(false);
                }
                if(data.success) {
                    jQuery.gritter.add({
                        title: 'Notification',
                        text: 'Delete success..',
                        class_name: 'growl-success',
                        sticky: false,
                        time: ''
                    });
                    oTable.fnDraw(false);
                } //success
            }); //done
        });
    }
    submitModalForm();
});
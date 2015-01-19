{{ Datatable::table()
->addColumn($columns)
->setUrl(route($routeUrl))
->setCallBacks(
    'fnDrawCallback','function (aoData){
        $(function()
        {

            jQuery(".btn-edit").on("click",function(e){
                e.preventDefault();
                toUrl($(this).data("action"));
            });
            jQuery(".btn-app-customer-choose").on("click",function(e){
                e.preventDefault();
                $(".btn-app-customer-choose").each(function(){
                    $(this).removeClass("btn-success customer-select");
                });
                $(this).addClass("btn-success customer-select");
            });
            jQuery(".btn-new").on("click",function(e){
                toUrl($(this).data("action"));
            });
            $(".modal").on("show.bs.modal", function (e) {

                var btn = $(e.relatedTarget);
                $(".modal-content").load(btn.attr("href"));
            })
        });
    }'
)
->render() }}
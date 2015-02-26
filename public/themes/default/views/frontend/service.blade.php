<div class="row">
    <div class="col-xs-12">
        <a ui-sref="service.cart" class="btn btn-black btn-sm mb20"><i class="fa fa-shopping-cart mr5"></i>&nbsp;Confirmation</a>
        <a ui-sref="service.login" class="btn btn-black btn-sm mb20"><i class="fa fa-calendar-o mr5"></i>&nbsp;My Calendar</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-6" ng-repeat="service in services" >
        <div class="panel panel-default panel-f">
            <div class="panel-heading">
                <div class="panel-btns pull-right">
                    <a ui-sref="service.detail({id:service.id})" class="btn btn-make active">Make Appointment</a>
                </div>
                <h1 class="panel-title">
                    @{{ service.name }}
                </h1>


            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <p>@{{ service.description }}</p>
                    </div>

                </div>
                <span class="well well-sm"><i class="fa fa-tag"></i>&nbsp;{{ Setting::get(Session::get('sid')[0].'.app.currency') }} @{{ service.price }}</span>
                <span class="well well-sm"><i class="fa fa-time"></i>&nbsp;@{{ service.duration }} Minutes </span>
            </div>

        </div>
    </div>
</div>

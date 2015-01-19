<div ng-app="appSys">
    <div ui-view class="row"></div>
    <script type="text/ng-template" id="index.html">
        <div ui-view="list" class="row slide-reveal" ></div>
    </script>
    <script type="text/ng-template" id="services.list.html">
            <div class="col-sm-6" ng-repeat="service in services" >
                <div class="panel panel-default panel-f">
                    <div class="panel-heading">
                        <div class="panel-btns pull-right">

                        </div>
                        <h2 class="panel-title">
                            @{{ service.name }}
                        </h2>
                        <div class="row">
                            <div class="col-xs-12">
                                <p>@{{ service.description }}</p>
                            </div>

                        </div>

                    </div>
                    <div class="panel-body">
                        <span class="well well-sm"><i class="fa fa-tag"></i>&nbsp;{{ Setting::get('app.currency') }} @{{ service.price }}</span>
                        <span class="well well-sm"><i class="glyphicon glyphicon-time"></i>&nbsp;@{{ service.duration }} Minutes </span>
                        <a ui-sref="service.detail({id:service.id})" class="pull-right btn btn-md btn-black">Make Appointment</a>
                    </div>

                </div>
            </div>

    </script>
    <script type="text/ng-template"  id="services.detail.html">
        <div class="col-xs-12">
            <div>
                <a ui-sref="service.list" class="btn btn-black btn-sm mb20"><i class="fa fa-chevron-left mr5"></i>&nbsp;Back to services</a>
            </div>
            <div class="panel panel-default panel-f">
                <div class="panel-heading">
                    <div class="panel-btns pull-right">

                    </div>
                    <h2 class="panel-title">
                        @{{ service.name }}
                    </h2>
                    <div class="row">
                        <div class="col-xs-12">
                            <p>@{{ service.description }}</p>
                        </div>

                    </div>

                </div>
                <div class="panel-body">
                    <span class="well well-sm"><i class="fa fa-tag"></i>&nbsp;{{ Setting::get('app.currency') }} @{{ service.price }}</span>
                    <span class="well well-sm"><i class="glyphicon glyphicon-time"></i>&nbsp;@{{ service.duration }} Minutes </span>
                </div>

            </div>
        </div>
    </script>
</div>


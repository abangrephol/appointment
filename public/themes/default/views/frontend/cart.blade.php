<div class="row">
    <div class="col-xs-12">
        <a ui-sref="service.list" class="btn btn-black btn-sm mb20"><i class="fa fa-chevron-left mr5"></i>&nbsp;Back to services</a>
    </div>
</div>
<div class="row" ng-show="empty">
    <div class="col-sm-12">
        <div class="panel panel-warning panel-f mb20">
            <div class="panel-heading text-center">
                <h2 class="panel-title panel-title-alt">Empty cart</h2>
                <span>Checkout not available</span>
            </div>
        </div>
    </div>
</div>
<div class="row" ng-hide="empty">
    <div class="col-sm-3">
        <div class="panel panel-default panel-f mb20">
            <div class="panel-heading">
                <h2 class="panel-title panel-title-alt">Items</h2>
            </div>
            <div class="panel-body">
                <ul class="app-cart">
                    <li ng-repeat="item in carts">
                        <span class="service-name">@{{item.service.name}}</span>
                        <span class="service-date">@{{item.dateFormat}}</span>
                        <span class="service-time">@{{item.timeStart}} until @{{item.timeEnd}} </span>
                        <span class="service-price">@{{currency}} @{{item.service.price}}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default panel-f ">
            <div class="panel-heading">
                <h2 class="panel-title panel-title-alt">Prices</h2>
            </div>
            <div class="panel-body">
                <ul class="app-cart">
                    <li class="row">
                        <div class="col-xs-7"><strong>Service(s) Price</strong></div>
                        <div class="col-xs-5">@{{currency}} @{{ servicesPrice }}</div>
                    </li>
                    <li class="row">
                        <div class="col-xs-7"><strong>Tax</strong></div>
                        <div class="col-xs-5">@{{currency}} @{{ tax }}</div>
                    </li>
                    <li class="row">
                        <div class="col-xs-7"><strong>Total Price</strong></div>
                        <div class="col-xs-5">@{{currency}} @{{ totalPrice }}</div>
                    </li>
                    <li class="row">
                        <div class="col-xs-7"><strong>Deposit Payment</strong></div>
                        <div class="col-xs-5">@{{currency}} @{{ totalDeposit }}</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="panel panel-default panel-f ">
            <div class="panel-heading">
                <h2 class="panel-title panel-title-alt">Checkout Form</h2>
            </div>
            <div class="panel-body">
                {{ Form::open(array('class'=>'form form-horizontal')) }}
                <div class="alert alert-success hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div id="successMessage"></div>
                </div>
                <div class="form-group">
                    {{ Form::label('first', 'First Name', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-6">
                        {{ Form::text('first', null , array('class'=>'form-control','placeholder' => 'Enter First Name','required')) }}

                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('last', 'Last Name', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-6">
                        {{ Form::text('last', null , array('class'=>'form-control','placeholder' => 'Enter Last Name')) }}

                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-6">
                        {{ Form::text('text', null , array('class'=>'form-control','placeholder' => 'Enter Email','required')) }}

                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('address_1', 'Address', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-6">
                        {{ Form::text('address_1', null , array('class'=>'form-control','placeholder' => 'Enter Address','required')) }}

                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('address_2', 'Address 2', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-6">
                        {{ Form::text('address_2', null , array('class'=>'form-control','placeholder' => 'Enter Address')) }}

                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('zip', 'ZIP', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-2">
                        {{ Form::text('zip', null , array('class'=>'form-control','placeholder' => 'Enter ZIP','required')) }}

                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('note', 'Notes', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-6">
                        {{ Form::textarea('note', null , array('class'=>'','rows'=>5,'placeholder' => 'Enter Notes','required')) }}

                    </div>
                </div>
                {{ Form::close() }}
                <div class="row">
                    <div class="col-sm-offset-3 col-sm-6">
                        <a class="btn btn-sm" ui-sref="service.checkout">Continue</a>
                        <a class="btn btn-sm">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

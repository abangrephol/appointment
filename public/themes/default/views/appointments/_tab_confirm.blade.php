<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-alt panel-default">
            <div class="panel-heading">
                <h5 class="panel-title-alt">Customer Information</h5>
            </div>
            <div class="panel-body-nopadding">
                <div class="table-responsive">
                    <table class="table table-bordered table-info table-customer mb30">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td id="customer-name">
                                    <span id="customer-first"></span>
                                    <span id="customer-last"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td id="customer-email">
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td id="customer-address">
                                    <p id="customer-address_1"></p>
                                    <p id="customer-address_2"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>ZIP</td>
                                <td id="customer-zip">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-alt panel-default">
            <div class="panel-heading">
                <h5 class="panel-title-alt">Appointment Service</h5>
            </div>
            <div class="panel-body-nopadding">
                <div class="table-responsive">
                    <table class="table table-bordered table-info table-service mb30">
                        <thead>
                            <tr>
                                <th>Service Name</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    {{ Form::open(array('route' => array('appointments.store'),'class'=>'form-confirm form-horizontal')) }}
    <div class="col-sm-6">
        <div class="panel panel-alt panel-default">
            <div class="panel-heading">
                <h5 class="panel-title-alt">Payment Information</h5>
            </div>
            <div class="panel-footer">
                <div class="form-horizontal table-payment">

                    <div class="form-group">
                        {{ Form::label('price', 'Price', array('class' => 'col-sm-3 control-label')) }}
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                {{ Form::text('price', null , array('id'=>'price','class'=>'form-control ta-grow'
                                    ,'placeholder' => 'Enter Price')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('deposit', 'Deposit', array('class' => 'col-sm-3 control-label')) }}
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                            {{ Form::text('deposit', null , array('id'=>'deposit','class'=>'form-control ta-grow','placeholder' => 'Enter Deposit')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('tax', 'Tax', array('class' => 'col-sm-3 control-label')) }}
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                            {{ Form::text('tax', null , array('id'=>'tax','class'=>'form-control ta-grow','placeholder' => 'Enter Tax')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('priceTotal', 'Total Price', array('class' => 'col-sm-3 control-label')) }}
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                            {{ Form::text('priceTotal', null , array('id'=>'priceTotal','class'=>'form-control ta-grow','placeholder' => 'Enter TotalPrice')) }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-alt panel-default">
            <div class="panel-heading">
                <h5 class="panel-title-alt">Additional Information</h5>
            </div>
            <div class="panel-footer ">
                <div class="form-horizontal">
                    <div class="form-group">
                        {{ Form::label('note', 'Note', array('class' => 'col-sm-3 control-label')) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('note', null , array('class'=>'form-control ta-grow','placeholder' => 'Enter Additional Note')) }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
<div class="row">

</div>
<div id="proceed" class="row">
    <div class=" col-sm-12 col-md-4 col-lg-4"></div>
    <div class=" col-sm-12 col-md-2 col-lg-4">
        <button id="btn-proceed-confirm" class="btn btn-primary btn-block">Complete Make Appointment</button>
    </div>
    <div class=" col-sm-12 col-md-4 col-lg-4"></div>

</div>
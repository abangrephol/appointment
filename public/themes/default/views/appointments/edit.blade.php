{{ Form::model($data, array('route' => array('app.update', $data->id),'method'=>'PUT','class'=>'form form-horizontal')) }}
<div class="panel-heading">
    <h4 class="panel-title">{{ Theme::get('title') }}</h4>
</div>
<div class="panel-body">
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
                                <span id="customer-first">{{ $data->customer->first }}</span>
                                <span id="customer-last">{{ $data->customer->last }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td id="customer-email">{{ $data->customer->email }}
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td id="customer-address">
                                <p id="customer-address_1">{{ $data->customer->address_1 }}</p>
                                <p id="customer-address_2">{{ $data->customer->address_2 }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>ZIP</td>
                            <td id="customer-zip">{{ $data->customer->zip }}
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
                        <tbody>

                        @forelse ( $services as $service)
                        <tr>
                            <td>{{ $service->service->name }}</td>
                            <td><span class="app-time">{{ $service->date }} {{ $service->time }}</span> </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2">Has no appointment.</td>

                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
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
                                {{ Form::text('price', null , array('id'=>'price','class'=>'form-control'
                                ,'placeholder' => 'Enter Price')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('price_deposit', 'Deposit', array('class' => 'col-sm-3 control-label')) }}
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                {{ Form::text('price_deposit', null , array('id'=>'price_deposit','class'=>'form-control','placeholder' => 'Enter Deposit')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('price_tax', 'Tax', array('class' => 'col-sm-3 control-label')) }}
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                {{ Form::text('price_tax', null , array('id'=>'price_tax','class'=>'form-control','placeholder' => 'Enter Tax')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('price_total', 'Total Price', array('class' => 'col-sm-3 control-label')) }}
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                {{ Form::text('price_total', null , array('id'=>'price_total','class'=>'form-control','placeholder' => 'Enter TotalPrice')) }}
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
                            {{ Form::textarea('note', null , array('class'=>'form-control ta-grow','placeholder' => 'Enter Additional Note','rows'=>3)) }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                {{ Form::submit('Save',array('class'=>'btn btn-primary')) }}
                {{ Form::reset('Reset',array('class'=>'btn btn-default')) }}
            </div>
        </div>
    </div>
{{ Form::close() }}

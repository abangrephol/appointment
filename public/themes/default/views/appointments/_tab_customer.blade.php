<div class="tab-customer row mb20">
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
        <a data-toggle="tab" href="#new-customer"
           class="btn btn-primary btn-block active" data-customer-type="new">
            New Customer
        </a>
    </div>
    <div class="col-sm-3">
        <a data-toggle="tab" href="#return-customer"
           class="btn btn-default btn-block" data-customer-type="return">
            Returning Customer
        </a>
    </div>
    <div class="col-sm-3"></div>
</div>
<div class="tab-content">
    <div id="new-customer" class=" active tab-pane panel panel-primary panel-alt">

        <div class="panel-heading">
            <h4 class="panel-title">New Customer</h4>
        </div>
        <div class="panel-footer">
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
                    {{ Form::email('email', null , array('class'=>'form-control','placeholder' => 'Enter Email','required')) }}

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
            {{ Form::close() }}
        </div>


    </div>
    <div id="return-customer" class="tab-pane panel panel-primary panel-alt">
        <div class="panel-heading">Returning Customer</div>
        <div class="panel-footer">
            <div class="table-responsive">
                {{ Theme::widget('datatable', array('columns' => $usersColumn, 'routeUrl' => $routeUrl))->render() }}
            </div>
        </div>
    </div>
</div>
<div id="proceed" class="row">
    <div class=" col-sm-12 col-md-4 col-lg-4"></div>
    <div class=" col-sm-12 col-md-2 col-lg-4">
        <button id="btn-proceed-customer" class="btn btn-primary btn-block">Confirm Appointment</button>
    </div>
    <div class=" col-sm-12 col-md-4 col-lg-4"></div>

</div>

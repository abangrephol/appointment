{{ Form::open(array('route' => array('customer.store'),'method'=>'POST','class'=>'form form-horizontal')) }}
<div class="panel-heading">
    <h4 class="panel-title">{{ Theme::get('title') }}</h4>
</div>
<div class="panel-body">
    <div class="alert alert-success hidden">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <div id="successMessage"></div>
    </div>
    <div class="form-group">
        {{ Form::label('first', 'First Name', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::text('first', null , array('class'=>'form-control','placeholder' => 'Enter First Name','required')) }}
            <label id="first_error" for="first" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('last', 'Last Name', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::text('last', null , array('class'=>'form-control','placeholder' => 'Enter Last Name')) }}
            <label id="last_error" for="first" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::email('email', null , array('class'=>'form-control','placeholder' => 'Enter Email','required')) }}
            <label id="email_error" for="first" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('address_1', 'Address', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::text('address_1', null , array('class'=>'form-control','placeholder' => 'Enter Address','required')) }}
            <label id="address_1_error" for="first" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('address_2', 'Address 2', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::text('address_2', null , array('class'=>'form-control','placeholder' => 'Enter Address')) }}
            <label id="address_2_error" for="first" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('zip', 'ZIP', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-2">
            {{ Form::text('zip', null , array('class'=>'form-control','placeholder' => 'Enter ZIP')) }}
            <label id="address_2_error" for="first" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('username', 'User Name', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::text('username', null , array('class'=>'form-control','placeholder' => 'Enter Username')) }}
            <label id="username_error" for="first" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::password('password', array('class'=>'form-control')) }}

            <label id="password_error" for="first" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('password_confirmation', 'Confirm Password', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::password('password_confirmation', array('class'=>'form-control')) }}
            <label id="password_confirmation_error" for="first" class="error" style="display: inline-block;"></label>
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
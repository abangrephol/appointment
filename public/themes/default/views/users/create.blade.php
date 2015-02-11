{{ Form::open(array('route' => array('user.store'),'method'=>'POST','class'=>'form form-horizontal')) }}
<div class="panel-heading">
    <h4 class="panel-title">{{ Theme::get('title') }}</h4>
</div>
<div class="panel-body">
    <div class="alert alert-success hidden">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <div id="successMessage"></div>
    </div>
    <div class="form-group">
        {{ Form::label('first_name', 'First Name', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::text('first_name', null , array('class'=>'form-control','placeholder' => 'Enter First Name','required')) }}
            <label id="first_error" for="first" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::text('last_name', null , array('class'=>'form-control','placeholder' => 'Enter Last Name')) }}
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
        {{ Form::label('username', 'User Name', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::text('username', null , array('class'=>'form-control','placeholder' => 'Enter Last Name','required')) }}
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
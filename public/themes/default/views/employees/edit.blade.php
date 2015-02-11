{{ Form::model($data, array('route' => array('employee.update', $data->id),'method'=>'PUT','class'=>'form form-horizontal')) }}
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
        {{ Form::label('title', 'Title', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-2">
            {{ Form::text('title', null , array('class'=>'form-control','placeholder' => 'Enter Title','required')) }}
            <label id="title_error" for="first" class="error" style="display: inline-block;"></label>
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
        {{ Form::label('phone', 'Phone', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-3">
            {{ Form::text('phone',null, array('class'=>'form-control')) }}

            <label id="password_error" for="first" class="error" style="display: inline-block;"></label>
        </div>
        {{ Form::label('phone_ext', 'Ext', array('class' => 'col-sm-1 control-label')) }}
        <div class="col-sm-2">
            {{ Form::text('phone_ext',null, array('class'=>'form-control')) }}
            <label id="phone_ext_error" for="first" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('specialize', 'Specialize', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::text('specialize', null , array('class'=>'form-control')) }}
            <label id="specialize_error" for="specialize" class="error" style="display: inline-block;"></label>
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
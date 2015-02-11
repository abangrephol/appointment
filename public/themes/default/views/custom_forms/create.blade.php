{{ Form::open(array('route' => array('customform.store'),'method'=>'POST','class'=>'form form-horizontal')) }}
<div class="panel-heading">
    <h4 class="panel-title">{{ Theme::get('title') }}</h4>
</div>
<div class="panel-body">
    <div class="alert alert-success hidden">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <div id="successMessage"></div>
    </div>
    <div class="form-group">
        {{ Form::label('name', 'Form Name', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::text('name', null , array('class'=>'form-control','placeholder' => 'Enter Form Name','required')) }}
            <label id="name_error" for="name" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Description', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::textarea('description', null , array('class'=>'form-control','placeholder' => 'Enter Description')) }}
            <label id="description_error" for="description" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right"><h5><strong>Form Fields</strong></h5></div>
        <div class="col-sm-6">
            <a class="btn btn-default btn-sm">Add new field</a>
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
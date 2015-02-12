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
        <div class="col-sm-6 col-sm-offset-3">
            <h5 ><strong class="mr20">Form Fields</strong><a class="btn btn-default btn-sm" id="addfield">Add new field</a></h5>

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
<script type="text/html" id="fieldtpl">
    <div class="panel panel-default col-sm-10 col-sm-offset-1" id='panel-add'>
        <div class="panel-heading">
            <div class="form-group">
                {{ Form::label('new-field', 'Field Name', array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-6">
                    {{ Form::text('new-field', null , array('id'=>'new-field','class'=>'form-control','placeholder' => 'Enter Field Name')) }}
                    <label id="new-field_error" for="description" class="error" style="display: inline-block;"></label>
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('new-field-type', 'Field Type', array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-6">
                    {{ Form::select('new-field-type',
                    array('textfield'=>'Text Field','text'=>'Text','checkbox'=>'Checkbox','yesno'=>'Yes/No') ,
                    '',
                    array('id'=>'new-field-type','class'=>'form-control','placeholder' => 'Enter Field Name')) }}
                    <label id="new-field-type_error" for="description" class="error" style="display: inline-block;"></label>
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('new-field-req', 'Requirements', array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-6">
                    {{ Form::select('new-field-req',
                    array('0'=>'optional','1'=>'required') ,
                    1,
                    array('id'=>'new-field-req','class'=>'form-control','placeholder' => 'Enter Field Name')) }}
                    <label id="new-field-type_error" for="description" class="error" style="display: inline-block;"></label>
                </div>
            </div>
            <div class="form-group">

                <div class="col-sm-6 col-sm-offset-3">
                    <a class="btn btn-default btn-sm mr5 add">Add</a><a class="btn btn-sm btn-default cancel">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</script>
<script type="text/html" id="fieldtpl-text">
    <div class="form-group">
        {{ Form::label('new-field', 'Field Name', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::text('new-field', null , array('id'=>'new-field','class'=>'form-control','placeholder' => 'Enter Field Name')) }}
            <label id="new-field_error" for="description" class="error" style="display: inline-block;"></label>
        </div>
    </div>
</script>
<script type="text/html" id="fieldtpl-row">
    <div class="form-group">
        {{ Form::hidden('customfieldname[]', '{name}' , array('class'=>'form-control')) }}
        {{ Form::hidden('customfieldtype[]', '{val-type}' , array('class'=>'form-control')) }}
        {{ Form::hidden('customfieldreq[]', '{val-req}' , array('class'=>'form-control')) }}
        <div class="col-xs-2 col-sm-offset-3 col-xs-offset-2">{name}</div>
        <div class="col-xs-2">
            <span class="mr20">{type}</span>
        </div>
        <div class="col-xs-1">
            <span class="mr20">{req}</span>

        </div>
        <div class="col-xs-1">
            <a class="del-field mr10"><i class="fa fa-trash-o"></i></a>
            <a class="edit-field"  data-field-name="{name}" data-field-type="{val-type}" data-field-req="{val-req}"><i class="fa fa-edit"></i></a>
        </div>
    </div>
</script>
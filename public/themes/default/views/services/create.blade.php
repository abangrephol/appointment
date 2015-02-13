{{ Form::open(array('route' => array('service.store'),'method'=>'POST','class'=>'form form-horizontal')) }}
<div class="panel-heading">
    <h4 class="panel-title">{{ Theme::get('title') }}</h4>
</div>
<div class="panel-body">
    <div class="alert alert-success hidden">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <div id="successMessage"></div>
    </div>
    <div class="form-group">
        {{ Form::label('name', 'Service Name', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::text('name', null , array('class'=>'form-control','placeholder' => 'Enter Service Name','required')) }}
            <label id="name_error" for="name" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Description', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-6">
            {{ Form::textarea('description', null , array('class'=>'form-control ta-grow','required','placeholder' => 'Enter Description','title'=>'Please type at least 6 characters long!','rows'=>4)) }}
            <label id="description_error" for="description" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('price', 'Price', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-3">
            <div class="input-group">
                <span class="input-group-addon">$</span>
                {{ Form::text('price', null , array('class'=>'form-control','placeholder' => 'Enter Price','required')) }}
            </div>
            <label id="price_error" for="price" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('duration', 'Duration (minutes)', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-2">
            <div class="input-group">
                {{ Form::text('duration', null , array('class'=>'form-control','placeholder' => '','required')) }}
                <span class="input-group-addon">Minutes</span>
            </div>
            <label id="duration_error" for="duration" class="error" style="display: inline-block;"></label>

        </div>
    </div>
    <div class="form-group">
        {{ Form::label('interval', 'Interval (minutes)', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-2">
            <div class="input-group">
                {{ Form::text('interval', null , array('class'=>'form-control','placeholder' => '','required')) }}
                <span class="input-group-addon">Minutes</span>
            </div>
            <label id="interval_error" for="interval" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('capacity', 'Capacity', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-2">
            <div class="input-group">
                {{ Form::text('capacity', null , array('class'=>'form-control','placeholder' => '','required')) }}
                <span class="input-group-addon">Person</span>
            </div>
            <label id="capacity_error" for="capacity" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    @if ($customfields->count()>0)
    <div class="form-group">
        {{ Form::label('custom_forms[]', 'Custom Forms', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-2">
            <div class="input-group">
                @foreach($customfields as $fields)
                <div class="checkbox block">
                    <label>
                        {{ Form::checkbox('custom_forms[]', $fields->id) }}
                        {{ $fields->name }}
                    </label>
                </div>
                @endforeach
            </div>
            <label id="capacity_error" for="capacity" class="error" style="display: inline-block;"></label>
        </div>
    </div>
    @endif
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
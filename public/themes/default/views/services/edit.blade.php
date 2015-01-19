
<div class="panel-heading">
    <h4 class="panel-title">{{ Theme::get('title') }}</h4>
</div>
<div class="panel-body panel-body-nopadding">
    <div class="basic-wizard">
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a href="#service" data-toggle="tab" data-url="{{ route('tab.service',array( 'service' , $data->id)) }}"><span>Service Info</span></a></li>
            <li class=""><a href="#bussiness-hour" data-toggle="tab" data-url="{{ route('tab.service',array( 'hour' , $data->id)) }}">Bussiness Hour</a></li>
            <li class=""><a href="#availability" data-toggle="tab" data-url="{{ route('tab.service',array( 'service' , $data->id)) }}">Availability</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane" id="service">

        </div>
        <div class="tab-pane" id="bussiness-hour">

        </div>
        <div class="tab-pane" id="availability">

        </div>
    </div>

</div>
<div class="panel-footer">
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">

        </div>
    </div>
</div>



<div class="panel-heading">
    <h4 class="panel-title">{{ Theme::get('title') }}</h4>
</div>
<div class="panel-body panel-body-nopadding">
    <div class="basic-wizard">
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a href="#general" data-toggle="tab" data-url="{{ route('setting.general') }}"><span>General</span></a></li>
            <li class=""><a href="#bussiness-hour" data-toggle="tab" data-url="{{ route('setting.hours') }}">Bussiness Hour</a></li>

        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane" id="general">

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


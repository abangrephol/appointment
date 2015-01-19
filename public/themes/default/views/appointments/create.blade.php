<div class="panel-heading">
    <h4 class="panel-title">{{ Theme::get('title') }}</h4>
    <p id="services"></p>
</div>
<div class="panel-body panel-body-nopadding">
    <div class="basic-wizard appointment">
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a href="#service" data-toggle="tab" data-url="{{ route('tab.app.service',array('service')) }}">Service and Date</a></li>
            <li class=""><a href="#customer" data-toggle="tab" data-url="{{ route('tab.app.customer',array('customer')) }}">Customer</a></li>
            <li class=""><a href="#confirm" data-toggle="tab" data-url="{{ route('tab.app.confirm',array('confirm')) }}">Confirm</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="service">

            </div>
            <div class="tab-pane" id="customer">

            </div>
            <div class="tab-pane" id="confirm">

            </div>
        </div>
        <ul class="pager wizard">
            <li class="previous"><a href="javascript:void(0)">Previous</a></li>
        </ul>
    </div>
</div>
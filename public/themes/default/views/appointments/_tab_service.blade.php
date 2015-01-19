<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    Choose Service
                </div>
            </div>
            <div class="panel-footer">
                @foreach($data as  $service)
                <div class="row padding5">
                    <div class="col-sm-12">
                        {{ $service->name }}

                        <a class="btn-service btn btn-xs btn-black pull-right"
                            data-service-id="{{ $service->id }}"
                            data-selected-text="<i class='fa fa-check'></i>&nbsp;Selected" >Select</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    Choose Date for appointment
                </div>
            </div>
            <div class="panel-body-nopadding">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">

        <div class="ta-alert alert alert-danger text-center" style="display: none">
            &nbsp; Please select at least 1 service
        </div>
        <div class="ta-loader loaders text-center mb20" style="display: none">
            <img src="{{ Theme::asset()->usePath()->url('images/loaders/loader10.gif') }}" alt="">
            &nbsp; Load available time
        </div>
        <div id="times" class="row">

        </div>
        <div id="proceed" class="row">
            <div class=" col-sm-12 col-md-4"></div>
            <div class=" col-sm-12 col-md-4">
                <button id="btn-proceed" class="btn btn-primary btn-block disabled">Proceed Appointment</button>
            </div>
            <div class=" col-sm-12 col-md-4"></div>

        </div>
    </div>
</div>
<style>
    .fc-content td:hover{background: #428bca; color: #ffffff; cursor: pointer   }
    .fc-day-number {float:none !important; text-align: center}
    .fc-selected {background: #428bca !important; color: #ffffff;}
    .btn-service-time{padding: 0 !important;}
</style>
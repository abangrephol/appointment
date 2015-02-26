<div class="row">
    <div class="col-xs-12">
        <a ui-sref="service.list" class="btn btn-black btn-sm mb20"><i class="fa fa-chevron-left mr5"></i>&nbsp;Back to services</a>
        <a ui-sref="service.calendar" class="btn btn-black btn-sm mb20"><i class="fa fa-calendar-o mr5"></i>&nbsp;My Calendar</a>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-4">
        <div class="panel panel-default panel-f">
            <div class="panel-heading">
                <h2 class="panel-title panel-title-alt">
                    Select a date
                </h2>
                @{{dt | date:'fullDate' }}
            </div>
            <div class="panel-body panel-body-nopadding">
                <datepicker ng-model="dt" starting-day="1" min-date="minDate" show-weeks="false" date-disabled="disabled(date, mode)" ng-change="selects(dt)" class=""></datepicker>
            </div>
        </div>

    </div>
    <div class="col-xs-12 col-sm-8">
        <div class="panel panel-default panel-f ">
            <div class="panel-heading">
                <div class="panel-btns pull-right">

                </div>
                <h2 class="panel-title">
                    Your Schedule
                </h2>


            </div>
            <div class=" panel-body" ui-view="schedule">
                <table class="table table-bordered">
                    <tr>
                        <th>Service</th>
                        <th>Customer Name</th>
                        <th>Date & Time</th>
                    </tr>
                    <tr ng-repeat="schedule in scheduled">
                        <td>@{{schedule.serviceName}}</td>
                        <td>@{{schedule.customer.first}} @{{schedule.customer.last}}</td>
                        <td>@{{schedule.datetime}}</td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>
<script id="template/datepicker/datepicker.html" type="text/ng-template">
    <div ng-switch="datepickerMode" role="application" ng-keydown="keydown($event)" class="tableDate">
        <daypicker ng-switch-when="day" tabindex="0"></daypicker>
        <monthpicker ng-switch-when="month" tabindex="0"></monthpicker>
        <yearpicker ng-switch-when="year" tabindex="0"></yearpicker>
    </div>
</script>
<script id="template/datepicker/day.html" type="text/ng-template">

    <table role="grid" aria-labelledby="@{{uniqueId}}-title" aria-activedescendant="@{{activeDateId}}" class="col-xs-12">
        <thead>
        <tr>
            <th><button type="button" class="btn btn-default btn-date pull-left btn-block" ng-click="move(-1)" tabindex="-1"><i class="fa fa-chevron-left"></i></button></th>
            <th colspan="@{{5 + showWeeks}}"><button id="@{{uniqueId}}-title" role="heading" aria-live="assertive" aria-atomic="true" type="button" class="btn btn-default btn-date btn-block" ng-click="toggleMode()" tabindex="-1"><strong>@{{title}}</strong></button></th>
            <th><button type="button" class="btn btn-default btn-date pull-right btn-block" ng-click="move(1)" tabindex="-1"><i class="fa fa-chevron-right"></i></button></th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <th ng-show="showWeeks" class="text-center"></th>
            <th ng-repeat="label in labels track by $index" class="text-center"><small aria-label="@{{label.full}}">@{{label.abbr}}</small></th>
        </tr>
        <tr ng-repeat="row in rows track by $index">
            <td ng-show="showWeeks" class="text-center h6"><em>@{{ weekNumbers[$index] }}</em></td>
            <td ng-repeat="dt in row track by dt.date" class="text-center" role="gridcell" id="@{{dt.uid}}" aria-disabled="@{{!!dt.disabled}}">
                <button ng-hide="dt.secondary" type="button" style="width:100%;" class="btn btn-date btn-default" ng-class="{'active': dt.selected,'today':dt.current,'past':dt.pastdate,'disable':dt.disabled, 'holiday':dt.holiday}" ng-click="select(dt.date)" ng-disabled="dt.disabled" tabindex="-1">
                    <span ng-class="{'text-alert': dt.secondary, 'text-alert': dt.current}">@{{dt.label}}</span>
                </button>
            </td>
        </tr>
        </tbody>
    </table>

</script>
<script id="template/datepicker/month.html" type="text/ng-template">
    <table role="grid" aria-labelledby="@{{uniqueId}}-title" aria-activedescendant="@{{activeDateId}}" class="col-xs-12">
        <thead>
        <tr>
            <th><button type="button" class="btn btn-default btn-date pull-left" ng-click="move(-1)" tabindex="-1"><i class="fa fa-chevron-left"></i></button></th>
            <th><button id="@{{uniqueId}}-title" role="heading" aria-live="assertive" aria-atomic="true" type="button" class="btn btn-default btn-date" ng-click="toggleMode()" tabindex="-1" style="width:100%;"><strong>@{{title}}</strong></button></th>
            <th><button type="button" class="btn btn-default btn-date pull-right" ng-click="move(1)" tabindex="-1"><i class="fa fa-chevron-right"></i></button></th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="row in rows track by $index">
            <td ng-repeat="dt in row track by dt.date" class="text-center" role="gridcell" id="@{{dt.uid}}" aria-disabled="@{{!!dt.disabled}}">
                <button type="button" style="width:100%;" class="btn btn-default" ng-class="{'btn-primary': dt.selected, active: isActive(dt)}" ng-click="select(dt.date)" ng-disabled="dt.disabled" tabindex="-1"><span ng-class="{'text-info': dt.current}">@{{dt.label}}</span></button>
            </td>
        </tr>
        </tbody>
    </table>
</script>
<script id="template/datepicker/year.html" type="text/ng-template">
    <table role="grid" aria-labelledby="@{{uniqueId}}-title" aria-activedescendant="@{{activeDateId}}" class="col-xs-12">
        <thead>
        <tr>
            <th><button type="button" class="btn btn-default btn-date pull-left" ng-click="move(-1)" tabindex="-1"><i class="fa fa-chevron-left"></i></button></th>
            <th colspan="3"><button id="@{{uniqueId}}-title" role="heading" aria-live="assertive" aria-atomic="true" type="button" class="btn btn-default btn-date" ng-click="toggleMode()" tabindex="-1" style="width:100%;"><strong>@{{title}}</strong></button></th>
            <th><button type="button" class="btn btn-default btn-date pull-right" ng-click="move(1)" tabindex="-1"><i class="fa fa-chevron-right"></i></button></th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="row in rows track by $index">
            <td ng-repeat="dt in row track by dt.date" class="text-center" role="gridcell" id="@{{dt.uid}}" aria-disabled="@{{!!dt.disabled}}">
                <button type="button" style="width:100%;" class="btn btn-default" ng-class="{'btn-info': dt.selected, active: isActive(dt)}" ng-click="select(dt.date)" ng-disabled="dt.disabled" tabindex="-1"><span ng-class="{'text-info': dt.current}">@{{dt.label}}</span></button>
            </td>
        </tr>
        </tbody>
    </table>
</script>

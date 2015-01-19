


<ul >
    <li ng-repeat="time in timeArray" ng-class="{'disable':time.disable}" ui-sref-active="active" ng-click="select(time)"><a ui-sref="service.detail.date.time({time:time.data})">@{{ time.time }}</a></li>
</ul>
<div ui-view="make" class="slide-reveal"></div>
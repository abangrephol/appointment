<div ng-show='cartAdded' class='mb20 text-success'>Successfull make an appointment. View <b><a ui-sref='service.cart'>Cart</a></b> to checkout.</div>
<div ng-show="notAvailable">
    <span>Sorry, No available staff for selected time.</span>
</div>
<div ng-hide="notAvailable">
    <div ng-hide='cartAdded' class='row col-sm-12 mb20'><span class='well well-sm mr5 mb5'>Start time : @{{ startTime }}</span>
        <span class='well well-sm mr5 mb5'>End time : @{{ endTime }}</span></div>
        <span ng-repeat="form in forms" ng-hide='cartAdded'>
    <div class="mb10">


        <div class="form-group"><h4 class=" text-info">Additional Form : @{{ form.name }}</h4></div>
        <div ng-repeat="field in form.fields">
            <div class="row">
                <div ng-switch on="field.type" class="col-sm-6">
                    <label for="@{{field.type}}_@{{field.id}}" class="control-label">
                        @{{field.name}}
                        <span class="text-muted">( @{{ field.req?'Required':'Optional' }} )</span>
                    </label>
                    <div ng-switch-when="textfield" >
                        <input type="text" class="form-control" name="@{{field.type}}_@{{field.id}}" id="@{{field.type}}_@{{field.id}}">
                    </div>
                    <div ng-switch-when="text" >
                        <textarea class="form-control" rows="4" name="@{{field.type}}_@{{field.id}}" id="@{{field.type}}_@{{field.id}}"></textarea>
                    </div>
                    <div ng-switch-when="yesno" class="radio checkout_block">
                        <input type="radio" name="@{{field.type}}_@{{field.id}}[]" id="@{{field.type}}_@{{field.id}}_yes" checked>
                        <label for="@{{field.type}}_@{{field.id}}_yes">
                            Yes
                        </label>

                        <input type="radio" name="@{{field.type}}_@{{field.id}}[]" id="@{{field.type}}_@{{field.id}}_no">
                        <label for="@{{field.type}}_@{{field.id}}_no">
                            No
                        </label>
                    </div>
                    <div ng-switch-when="checkbox">
                        <input type="checkbox" name="@{{field.type}}_@{{field.id}}" id="@{{field.type}}_@{{field.id}}">
                        <label for="@{{field.type}}_@{{field.id}}">
                            @{{field.name}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

</span>
    <div class='row col-sm-12'><a class='btn btn-sm' ng-click='makeAppointment()'>Make Appointment</a></div>
</div>

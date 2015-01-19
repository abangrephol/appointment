<div class="modal fade bs-delete-modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
<div class="table-responsive">
    {{ Theme::widget('datatable', array('columns' => $usersColumn, 'routeUrl' => $routeUrl))->render() }}
</div>
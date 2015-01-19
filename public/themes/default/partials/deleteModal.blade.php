<div class="panel panel-warning panel-alt">
    <div class="panel-heading">
        <div class="panel-btns">
            <a class="panel-close" data-dismiss="modal" aria-hidden="true">&times;</a>
        </div><!-- panel-btns -->
        <h3 class="panel-title">Confirmation</h3>
    </div>
    <div class="panel-body">
        Are you sure want to delete this?
    </div>
    <div class="panel-footer midtext">
        <div class="pull-right">
            {{ Form::model($data, array('route' => array($route.'.destroy', $data['id']),'method'=>'DELETE','class'=>'form form-horizontal')) }}
            <button class="btn " type="submit">Confirm</button>
            {{ Form::close() }}
        </div>

    </div>
</div>
{{ Theme::asset()->container('footer-modal')->scripts() }}
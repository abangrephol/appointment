<div class="panel-heading">
    <div class="panel-btns">
        <a href="" class="panel-edit btn-edit" data-action="{{ route(Theme::get('route').'.create') }}">
            <span>
                <i class="fa fa-edit"></i>&nbsp;New {{ Theme::get('title') }}
            </span>
        </a>
    </div>
    <h4 class="panel-title">{{ Theme::get('title') }}</h4>
</div>
<div class="panel-body">
    {{ Theme::content() }}
</div>
<div class="panel-footer">

</div>
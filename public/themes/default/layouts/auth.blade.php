<!DOCTYPE html>
<html>
<head>
    <title>{{ Theme::get('title') }}</title>
    <meta charset="utf-8">
    <meta name="keywords" content="{{ Theme::get('keywords') }}">
    <meta name="description" content="{{ Theme::get('description') }}">
    <base url="/" />
    {{ Theme::asset()->styles() }}
    {{ Theme::asset()->container('header')->scripts() }}
</head>
<body class="horizontal-menu ">
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>
<section >
    <div class="mainpanel">
        <div class="contentpanel">
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default content">
                        {{ Theme::content() }}
                    </div>
                </div>
            </div>
        </div>
        {{ Theme::partial('footer') }}
    </div>
</section>
{{ Theme::asset()->container('footer')->scripts() }}

</body>
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

        {{ Theme::partial('header') }}
        <div class="contentpanel">
            <div class="row">
                <div class = "col-xs-12 mb20">
                        {{ Theme::partial('tabmenu') }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div id="loader-body" class="panel panel-body" style="display: none;">
                        <div id="loader-body-status" class=" text-center" style="display: none;">
                            <h4>
                                <i class="fa fa-spinner fa-spin"></i> Loading page
                            </h4>
                        </div>
                    </div>
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
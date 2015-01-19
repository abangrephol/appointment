<!DOCTYPE html>
<html>
<head>
    <title>{{ Theme::get('title') }}</title>
    <meta charset="utf-8">
    <meta name="keywords" content="{{ Theme::get('keywords') }}">
    <meta name="description" content="{{ Theme::get('description') }}">


</head>
<body class="horizontal-menu ">
<section>
    {{ Theme::asset()->container('style-frontend')->styles() }}
    {{ Theme::asset()->container('script-frontend-h')->scripts() }}
    <div class="mainpanel">
        <div class="row">
            <div class="col-xs-12">
                {{ Theme::content() }}
            </div>
        </div>
    </div>
    {{ Theme::asset()->container('script-frontend')->scripts() }}
    {{ Theme::asset()->queue('appsys')->scripts(array('defer' => 'defer')); }}
</section>

</body>
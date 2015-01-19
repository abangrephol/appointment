<!DOCTYPE html>
<html>
<head>
    <title>{{ Theme::get('title') }}</title>
    <meta charset="utf-8">
    <meta name="keywords" content="{{ Theme::get('keywords') }}">
    <meta name="description" content="{{ Theme::get('description') }}">
    {{ Theme::asset()->styles() }}
    {{ Theme::asset()->container('header')->scripts() }}
</head>
<body class="horizontal-menu ">
<section>
    <div class="mainpanel">


        <div class="contentpanel">


            <div class="row">
                <div class = "col-xs-3">

                        {{ Theme::partial('frontend.sidebar') }}

                </div>
                <div class="col-xs-9">
                    <div class="panel panel-primary panel-stat mb20">
                        <div class="panel-heading">
                            <div class="stat">
                                <h5 class="panel-title">Choose Services</h5>
                            </div>

                        </div>
                    </div>


                        {{ Theme::content() }}


                </div>
            </div>
        </div>
        {{ Theme::partial('frontend.footer') }}
    </div>
</section>
{{ Theme::asset()->container('footer')->scripts() }}
{{ Theme::asset()->container('footer-frontend')->scripts() }}
</body>
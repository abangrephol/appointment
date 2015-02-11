<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials", "views" and "widgets"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these event can be override by package config.
    |
    */

    'events' => array(

        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function($theme)
        {
            // You can remove this line anytime.
            $theme->setTitle('Appointment System');
            $theme->asset()->usePath()->add('core-style', 'css/style.default.css');
            $theme->asset()->usePath()->add('core-style-inverse', 'css/style.inverse.css');
            $theme->asset()->usePath()->add('jquery-database', 'css/jquery.datatables.css');
            $theme->asset()->usePath()->add('font-awesome', 'css/font-awesome.min.css');
            $theme->asset()->usePath()->add('fullcalendar', 'css/fullcalendar.css');
            $theme->asset()->usePath()->add('gritter', 'css/jquery.gritter.css');

            $theme->asset()->container('header')->usePath()->add('jquery',"js/jquery-1.10.2.min.js");
            $theme->asset()->container('header')->usePath()->add('router',"js/laroute.js");

            $theme->asset()->container('footer')->usePath()->add('jquery-migrate',"js/jquery-migrate-1.2.1.min.js");
            $theme->asset()->container('footer')->usePath()->add('jquery-ui',"js/jquery-ui-1.10.3.min.js");
            $theme->asset()->container('footer')->usePath()->add('js-bootstrap',"js/bootstrap.min.js");
            $theme->asset()->container('footer')->usePath()->add('modernizr',"js/modernizr.min.js");
            $theme->asset()->container('footer')->usePath()->add('jquery-sparkline',"js/jquery.sparkline.min.js");
            $theme->asset()->container('footer')->usePath()->add('js-toggles',"js/toggles.min.js");
            $theme->asset()->container('footer')->usePath()->add('js-retina',"js/retina.min.js");
            $theme->asset()->container('footer')->usePath()->add('jquery-cookies',"js/jquery.cookies.js");
            $theme->asset()->container('footer')->usePath()->add('iframe',"js/iframeResizer.contentWindow.min.js");
            //$theme->asset()->container('footer')->usePath()->add('flot',"js/flot/flot.min.js");
            //$theme->asset()->container('footer')->usePath()->add('flot-resize',"js/flot/flot.resize.min.js");
            //$theme->asset()->container('footer')->usePath()->add('morris',"js/morris.min.js");
            //$theme->asset()->container('footer')->usePath()->add('raphael',"js/raphael-2.1.0.min.js");
            $theme->asset()->container('header')->usePath()->add('jquery-database-js',"js/jquery.datatables.min.js");
            $theme->asset()->container('footer')->usePath()->add('jquery-chosen',"js/chosen.jquery.min.js");
            $theme->asset()->container('footer')->usePath()->add('jquery-validation',"js/jquery.validate.min.js");
            $theme->asset()->container('footer')->usePath()->add('js-dashboard',"js/appsys.js");
            $theme->asset()->container('footer')->usePath()->add('frontend-js',"js/frontend.js");
            $theme->asset()->container('footer')->usePath()->add('moment',"js/moment.min.js");
            $theme->asset()->container('footer')->usePath()->add('calendar',"js/fullcalendar.min.js");

            $theme->asset()->container('footer-modal')->usePath()->add('jquery-gritter',"js/jquery.gritter.min.js");
            $theme->asset()->container('footer-modal')->usePath()->add('js-modal',"js/appsys.modal.js");

            $theme->asset()->queue('appsys')->usePath()->add('angular',"js/angular/angular.min.js");
            $theme->asset()->queue('appsys')->usePath()->add('angular-ui-route',"js/angular/angular-ui-router.min.js");
            $theme->asset()->queue('appsys')->usePath()->add('angular-animate',"js/angular/angular-animate.min.js");
            $theme->asset()->queue('appsys')->add('services',"apps/frontend/Controllers/services.js");
            $theme->asset()->queue('appsys')->add('services.service',"apps/frontend/Controllers/services-service.js");
            $theme->asset()->queue('appsys')->add('utils.service',"apps/frontend/Controllers/utils-service.js");
            $theme->asset()->queue('appsys')->add('app',"apps/frontend/app.js");

            //$theme->asset()->container('jquery')->usePath()->add('jquery',"js/jquery-1.10.2.min.js");
            //$theme->asset()->container('moment')->usePath()->add('moment',"js/moment.min.js");
            // Breadcrumb template.
            // $theme->breadcrumb()->setTemplate('
            //     <ul class="breadcrumb">
            //     @foreach ($crumbs as $i => $crumb)
            //         @if ($i != (count($crumbs) - 1))
            //         <li><a href="{{ $crumb["url"] }}">{{ $crumb["label"] }}</a><span class="divider">/</span></li>
            //         @else
            //         <li class="active">{{ $crumb["label"] }}</li>
            //         @endif
            //     @endforeach
            //     </ul>
            // ');
        },

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function($theme)
        {
            // You may use this event to set up your assets.
            // $theme->asset()->usePath()->add('core', 'core.js');
            // $theme->asset()->add('jquery', 'vendor/jquery/jquery.min.js');
            // $theme->asset()->add('jquery-ui', 'vendor/jqueryui/jquery-ui.min.js', array('jquery'));

            // Partial composer.
            // $theme->partialComposer('header', function($view)
            // {
            //     $view->with('auth', Auth::user());
            // });
        },

        // Listen on event before render a layout,
        // this should call to assign style, script for a layout.
        'beforeRenderLayout' => array(
            'appsys' => function($theme)
            {
                // Frontend Section


                $theme->asset()->container('style-frontend')->usePath()->add('core-style', 'css/style.default.css');
                $theme->asset()->container('style-frontend')->usePath()->add('font-awesome', 'css/font-awesome.min.css');
                $theme->asset()->container('style-frontend')->usePath()->add('fullcalendar', 'css/fullcalendar.css');
                $theme->asset()->container('style-frontend')->usePath()->add('frontend', 'css/frontend.css');

                $theme->asset()->container('script-frontend')->usePath()->add('jquery',"js/jquery-1.10.2.min.js");
                $theme->asset()->container('script-frontend')->usePath()->add('moment',"js/moment.min.js");
                $theme->asset()->container('script-frontend')->usePath()->add('calendar',"js/fullcalendar.min.js");
                $theme->asset()->container('script-frontend')->usePath()->add('js-bootstrap',"js/bootstrap.min.js");
                $theme->asset()->container('script-frontend')->usePath()->add('modernizr',"js/modernizr.min.js");

                $theme->asset()->queue('appsys')->usePath()->add('angular',"js/angular/angular.min.js");
                $theme->asset()->queue('appsys')->usePath()->add('angular-ui-route',"js/angular/angular-ui-router.min.js");
                $theme->asset()->queue('appsys')->usePath()->add('angular-animate',"js/angular/angular-animate.min.js");
                $theme->asset()->queue('appsys')->add('services',"apps/frontend/Controllers/services.js");
                $theme->asset()->queue('appsys')->add('services.service',"apps/frontend/Controllers/services-service.js");
                $theme->asset()->queue('appsys')->add('utils.service',"apps/frontend/Controllers/utils-service.js");
                $theme->asset()->queue('appsys')->add('app',"apps/frontend/app.js");

                // Frontend Section
            },
            'iframe' => function($theme)
            {
                //$theme->asset()->container('footer')->usePath()->add('iframe',"js/iframeResizer.contentWindow.min.js");
            },
            'default' => function($theme)
            {
                // $theme->asset()->usePath()->add('ipad', 'css/layouts/ipad.css');
            },
            'form' => function($theme)
            {
                $theme->asset()->container('header-form')->usePath()->add('tags-style', 'css/bootstrap-tokenfield.css');
                $theme->asset()->container('header-form')->usePath()->add('typeahead-style', 'css/tokenfield-typeahead.css');



                $theme->asset()->container('footer-form')->usePath()->add('js-form-autogrow',"js/jquery.autogrow-textarea.js");
                $theme->asset()->container('footer-form')->usePath()->add('js-form-wizard',"js/bootstrap-wizard.min.js");
                $theme->asset()->container('footer-form')->usePath()->add('js-form-tags',"js/bootstrap-tokenfield.min.js");
                $theme->asset()->container('footer-form')->usePath()->add('js-form-typeahead',"js/typeahead.bundle.js");

                $theme->asset()->container('footer-form')->usePath()->add('js-form',"js/appsys.form.js");
            },
            'formApp' => function($theme)
            {
                $theme->asset()->container('footer-form')->usePath()->add('js-form-autogrow',"js/jquery.autogrow-textarea.js");
                $theme->asset()->container('footer-form')->usePath()->add('js-form-wizard',"js/bootstrap-wizard.min.js");
                $theme->asset()->container('footer-form')->usePath()->add('js-form',"js/appsys.form-app.js");

            }

        )

    )

);

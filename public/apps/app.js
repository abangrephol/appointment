var config = {
    "server":"http://appointment.dev6.wirednest.net",
    "apiPath" : "http://appointment.dev6.wirednest.net/api/"
};
(function() {
    "use strict";
    var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(
            navigator.vendor),
        loadCssHack = function(url, callback) {
            var link = document.createElement("link");
            link.type = "text/css";
            link.rel = "stylesheet";
            link.href = url;
            document.getElementsByTagName("head")[0].appendChild(link);
            var img = document.createElement("img");
            img.onerror = function() {
                if (callback && typeof callback === "function") {
                    callback();
                }
            };
            img.src = url;
        },
        loadRemote = function(url, type, callback) {
            if (type === "css" && isSafari) {
                loadCssHack.call(null, url, callback);
                return;
            }
            var _element, _type, _attr, scr, s, element;
            switch (type) {
                case "css":
                    _element = "link";
                    _type = "text/css";
                    _attr = "href";
                    break;
                case "js":
                    _element = "script";
                    _type = "text/javascript";
                    _attr = "src";
                    break;
            }
            scr = document.getElementsByTagName(_element);
            s = scr[scr.length - 1];
            element = document.createElement(_element);
            element.type = _type;
            if (type == "css") {
                element.rel = "stylesheet";
            }
            if (element.readyState) {
                element.onreadystatechange = function() {
                    if (element.readyState == "loaded" || element.readyState ==
                        "complete") {
                        element.onreadystatechange = null;
                        if (callback && typeof callback === "function") {
                            callback();
                        }
                    }
                };
            } else {
                element.onload = function() {
                    if (callback && typeof callback === "function") {
                        callback();
                    }
                };
            }
            element[_attr] = url;
            s.parentNode.insertBefore(element, s.nextSibling);
        },
        loadScript = function(url, callback) {
            loadRemote.call(null, url, "js", callback);
        },
        loadCss = function(url, callback) {
            loadRemote.call(null, url, "css", callback);
        },
        setDiv = function(){
            //jQuery(document).ready(function(){
            angular.element(document).ready(function(){
                jQuery('#appsys').append('<div id="appsysContainer"><div ui-view class="row"></div></div>');
                angular.bootstrap(document.getElementById("appsysContainer"), ["appSys"])
            });

            //});
        };

    loadScript(
        /*config.server+"/themes/default/assets/js/jquery-1.10.2.min.js",
        function(){

            loadScript(*/
                config.server+"/themes/default/assets/js/angular/angular.min.js",
                function(){

                    loadScript(
                        config.server+"/themes/default/assets/js/jquery.cookies.js",
                        function(){
                            loadScript(
                                config.server+"/themes/default/assets/js/moment.min.js",
                                function(){
                                    loadScript(
                                        /*config.server+"/themes/default/assets/js/fullcalendar.min.js",
                                        function(){
                                            loadScript(*/
                                                config.server+"/themes/default/assets/js/angular/angular-ui-router.min.js",
                                                function(){
                                                    loadScript(
                                                        config.server+"/themes/default/assets/js/angular/angular-animate.min.js",
                                                        function(){
                                                            loadScript(
                                                                config.server+"/apps/frontend/Controllers/services.js",
                                                                function(){
                                                                    loadScript(
                                                                        config.server+"/apps/frontend/Controllers/services-service.js",
                                                                        function(){
                                                                            loadScript(
                                                                                config.server+"/apps/frontend/Controllers/utils-service.js",
                                                                                function(){
                                                                                    loadScript(
                                                                                        config.server+"/apps/frontend/Controllers/settings.js",
                                                                                        function(){
                                                                                            loadScript(
                                                                                                config.server+"/themes/default/assets/js/angular/ui-bootstrap-0.12.0.js",
                                                                                                function(){
                                                                                                    loadScript(
                                                                                                        config.server+"/themes/default/assets/js/angular/ngStorage.js",
                                                                                                        function(){

                                                                                                            loadScript(
                                                                                                                config.server+"/apps/frontend/app.js",
                                                                                                                function(){
                                                                                                                    setDiv();
                                                                                                                    if(cssLoad){
                                                                                                                        loadCss(config.server+"/themes/default/assets/css/style.default.css");
                                                                                                                    }
                                                                                                                    //loadCss(config.server+"/themes/default/assets/css/fullcalendar.css");
                                                                                                                    loadCss(config.server+"/themes/default/assets/css/frontend.css");

                                                                                                                }
                                                                                                            )
                                                                                                        }
                                                                                                    )
                                                                                                }

                                                                                            )

                                                                                        }
                                                                                    )
                                                                                }

                                                                            )
                                                                        }
                                                                    )
                                                                }
                                                            )
                                                        }
                                                    )
                                                }
                                            //)
                                        //}
                                    )
                                }
                            )
                        }
                    )
                }

            //)
        //}
    );
})();
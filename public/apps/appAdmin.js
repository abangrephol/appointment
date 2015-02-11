(function(){
    ifrm = document.createElement("IFRAME");
    ifrm.setAttribute("src", "http://appointment.dev6.wirednest.net/loginAPI?apikey="+options.apikey);
    ifrm.setAttribute("width","100%");
    ifrm.setAttribute("frameborder","0");
    document.getElementById(options.element).appendChild(ifrm);
    resizer= document.createElement('script');
    resizer.setAttribute('src','http://appointment.dev6.wirednest.net/themes/default/assets/js/iframeResizer.min.js');
    document.getElementById(options.element).appendChild(resizer);
    if (resizer.readyState) {
        resizer.onreadystatechange = function() {
            if (resizer.readyState == "loaded" || resizer.readyState ==
                "complete") {
                resizer.onreadystatechange = null;
                if (iFrameResize && typeof iFrameResize === "function") {
                    iFrameResize();
                }
            }
        };
    } else {
        resizer.onload = function() {
            if (iFrameResize && typeof iFrameResize === "function") {
                iFrameResize();
            }
        };
    }

})();
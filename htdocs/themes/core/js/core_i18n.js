/**
 * Configurations
 */
var config = {
    logging : true,
    baseURL : location.protocol + "//" + location.hostname + "/admin"
};


/**
 * Bootstrap IE10 viewport bug workaround
 */
if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement('style')
    msViewportStyle.appendChild(
        document.createTextNode(
            '@-ms-viewport{width:auto!important}'
        )
    )
    document.querySelector('head').appendChild(msViewportStyle)
}


/**
 * Global core functions
 */
$(document).ready(function() {

});

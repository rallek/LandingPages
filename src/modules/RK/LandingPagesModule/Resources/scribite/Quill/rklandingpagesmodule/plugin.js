var rklandingpagesmodule = function(quill, options) {
    setTimeout(function() {
        var button;

        button = jQuery('button[value=rklandingpagesmodule]');

        button
            .css('background', 'url(' + Zikula.Config.baseURL + Zikula.Config.baseURI + '/web/modules/rklandingpages/images/admin.png) no-repeat center center transparent')
            .css('background-size', '16px 16px')
            .attr('title', 'Landing pages')
        ;

        button.click(function() {
            RKLandingPagesModuleFinderOpenPopup(quill, 'quill');
        });
    }, 1000);
};

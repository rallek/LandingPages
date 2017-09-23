/**
 * Initializes the plugin, this will be executed after the plugin has been created.
 * This call is done before the editor instance has finished it's initialization so use the onInit event
 * of the editor instance to intercept that event.
 *
 * @param {tinymce.Editor} ed Editor instance that the plugin is initialised in
 * @param {string} url Absolute URL to where the plugin is located
 */
tinymce.PluginManager.add('rklandingpagesmodule', function(editor, url) {
    var icon;

    icon = Zikula.Config.baseURL + Zikula.Config.baseURI + '/web/modules/rklandingpages/images/admin.png';

    editor.addButton('rklandingpagesmodule', {
        //text: 'Landing pages',
        image: icon,
        onclick: function() {
            RKLandingPagesModuleFinderOpenPopup(editor, 'tinymce');
        }
    });
    editor.addMenuItem('rklandingpagesmodule', {
        text: 'Landing pages',
        context: 'tools',
        image: icon,
        onclick: function() {
            RKLandingPagesModuleFinderOpenPopup(editor, 'tinymce');
        }
    });

    return {
        getMetadata: function() {
            return {
                title: 'Landing pages',
                url: 'http://k62.de'
            };
        }
    };
});

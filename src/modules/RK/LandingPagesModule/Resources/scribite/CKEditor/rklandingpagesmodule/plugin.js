CKEDITOR.plugins.add('rklandingpagesmodule', {
    requires: 'popup',
    lang: 'en,nl,de',
    init: function (editor) {
        editor.addCommand('insertRKLandingPagesModule', {
            exec: function (editor) {
                var url = Routing.generate('rklandingpagesmodule_external_finder', { objectType: 'page', editor: 'ckeditor' });
                // call method in RKLandingPagesModule.Finder.js and provide current editor
                RKLandingPagesModuleFinderCKEditor(editor, url);
            }
        });
        editor.ui.addButton('rklandingpagesmodule', {
            label: editor.lang.rklandingpagesmodule.title,
            command: 'insertRKLandingPagesModule',
            icon: this.path.replace('scribite/CKEditor/rklandingpagesmodule', 'public/images') + 'admin.png'
        });
    }
});

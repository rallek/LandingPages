CKEDITOR.plugins.add('rklandingpagesmodule', {
    requires: 'popup',
    init: function (editor) {
        editor.addCommand('insertRKLandingPagesModule', {
            exec: function (editor) {
                RKLandingPagesModuleFinderOpenPopup(editor, 'ckeditor');
            }
        });
        editor.ui.addButton('rklandingpagesmodule', {
            label: 'Landing pages',
            command: 'insertRKLandingPagesModule',
            icon: this.path.replace('scribite/CKEditor/rklandingpagesmodule', 'images') + 'admin.png'
        });
    }
});

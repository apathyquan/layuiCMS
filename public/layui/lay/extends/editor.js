layui.define([], function(exports) {
    var editor = {
        create: function(id) {
            // var E = window.wangeditor;
            // var editor = new E(`#${id}`);
            // // 或者 var editor = new E( document.getElementById('editor') )
            // editor.create()
            var E = window.wangEditor;
            if (!window.editor) {
                var editor = new Array();
            }
            editor[id] = new E("#" + id);
            editor[id].customConfig.uploadImgShowBase64 = true;
            // 或者 var editor = new E( document.getElementById('editor') )
            editor[id].create();
            window.editor = editor;
        }
    };
    exports("editor", editor);
});

layui.define(['jquery', 'layer','form','request'], function(exports) {
    var $ = layui.jquery,layer = layui.layer, request = layui.request;
    var dialog = {
        /*确认框*/
        confirm: function(jsonData) {
            layer.confirm(jsonData.message, {
                btn: ['确定', '取消'],
                shade: [0.1, '#fff']
            }, function() {
                jsonData.success();
            }, function() {
                jsonData.cancel();
            });
        },

        page: function(title, url, w, h) {
            if (title == null || title == '') {
                title = false;
            };
            if (url == null || url == '') {
                url = "404.html";
            };
            if (w == null || w == '') {
                w = '700px';
            };
            if (h == null || h == '') {
                h = '350px';
            };
            var index = layer.open({
                title: title,
                type: 2,
                area: [w, h],
                fixed: false, //不固定
                maxmin: true,
                content: url,
            });
        },
        addOrEdit: function(title, url, w, h) {
            if (title == null || title == '') {
                title = false;
            };
            if (url == null || url == '') {
                url = "404.html";
            };
            if (w == null || w == '') {
                w = '700px';
            };
            if (h == null || h == '') {
                h = '350px';
            };
            var index = layer.open({
                title: title,
                btn: ['确定', '取消'],
                type: 2,
                area: [w, h],
                fixed: false, //不固定
                maxmin: true,
                content: url,
                yes: function(index, layero) {
                    var exits=layero.find('iframe').contents().find("#submit").length;
                    if(exits>0){
                         layero.find('iframe').contents().find("#submit").click();
                     }else{
                         // layero.find('iframe').contents().find("#edit").click();
                         layer.msg('id为submit的button不存在');
                     }
                   
                    
                },
                btn2: function(data) {
                    // console.log(data);
                }
            });
        },
        /**
         * 提示
         * @param title
         * @param obj
         */
        tips: function(title, obj) {
            layer.tips(title, obj, {
                tips: [1, '#444c63'], //还可配置颜色
                time: 1000
            });
        }
    };
    //输出test接口
    exports('dialog', dialog);
});
layui.define(["laytpl", "element", "jquery", "inputTpl"], function(exports) {
    var laytpl = layui.laytpl,
        $ = layui.$,
        element = layui.element,
        inputTpl = layui.inputTpl;
    var tabTpl = {
        html: function() {
            var html = "";
            html += '<script id="indexTemplate" type="text/html">';
            html +=
                '<div class="layui-tab table-bg layui-tab-brief"  lay-filter="{{d.layFilter}}">';
            html += '        <ul class="layui-tab-title" >';
            html += "{{# layui.each(d.groupData, function(index, item){    }}";
            html +=
                '            <li class="{{index==1?"layui-this":""}}" lay-id="{{index}}">{{item}}</li>';
            html += "{{# }); }}";
            html += "       </ul>";
            html += '<div class="layui-tab-content" id="tabContent">';
            html +=
                '<form class="layui-form dialog-form" id="inputContent"   lay-filter="systemConfig">';
            html += "</form>";
            html += "      </div>";
            html += "</div>";
            html += "</script>";
            return html;
        },
        render: function(jsonData) {
            var data = jsonData;
            var getTpl = indexTemplate.innerHTML,
                view = document.getElementById("indexContent");
            laytpl(getTpl).render(data, function(html) {
                view.innerHTML = html;
            });
        },
        /**
         * @description:渲染inputTpl的数据
         * @param {type}
         * @return:
         */
        inputRender: function(jsonData) {
            var inputJsonData = (inputJsonData = {
                // view: "tabContent",
                formFilter: "systemConfig",
                button: true,
                content: []
            });
            jsonData.forEach(item => {
                let data = {
                    label: item.label,
                    name: item.key,
                    value: item.value,
                    remark: item.remark,
                    type: item.config_type,
                    autocomplete: "off"
                };
                if (item.config_type == "image") {
                    data.type = "uploadImg";
                    data.uploadUrl = "/backend/system/upload";
                } else if (item.config_type == "gallery") {
                    data.type = "uploadGallery";
                    data.uploadUrl = "/backend/system/upload";
                }
                inputJsonData.content.push(data);
            });
            if (!inputJsonData.content.length) {
                inputJsonData.button = false;
            }
            inputTpl.render(inputJsonData);
        }
    };
    exports("tabTpl", tabTpl);
});

@extends('layout.main') @section('content')
<div class="layui-fluid layui-anim  ">
    <div class="layui-row" id="indexContent"></div>
</div>

<script type="text/javascript">
    layui.use(
        [
            "jquery",
            "form",
            "table",
            "element",
            "dialog",
            "request",
            "tabTpl",
            "inputTpl",
            "layer"
        ],
        function() {
            var form = layui.form,
                table = layui.table,
                element = layui.element,
                tabTpl = layui.tabTpl,
                inputTpl = layui.inputTpl,
                layer = layui.layer,
                $ = layui.$,
                request = layui.request,
                dialog = layui.dialog;
            var html = tabTpl.html;
            var inputHtml = inputTpl.html;
            $(".layui-fluid").append(html);
            $(".layui-fluid").append(inputHtml);
            var jsonData = {};
            var groupData;
            request.zqajax(
                {
                    type: "GET",
                    url: "/backend/system/group",
                    success: function(data) {
                        if (data.code == 200) {
                            jsonData = {
                                layFilter: "config",
                                groupData: data.data
                            };
                            tabTpl.render(jsonData);
                            // console.log(Object.keys(data.data));
                            layui.event(
                                "groupData",
                                "data",
                                Object.keys(data.data)[0]
                            );
                        } else {
                            layer.msg(JSON.stringify(data.message));
                        }
                    }
                },
                true,
                1
            );
            //监听Tab切换，以改变地址hash值
            element.on("tab(config)", function() {
                // location.hash = "test=" + this.getAttribute("lay-id");
                layui.event("groupData", "data", this.getAttribute("lay-id"));
            });
            /**
             * @description: 获取分组数据
             * @param  gid
             * @return:
             */
            layui.onevent("groupData", "data", function(gid) {
                request.zqajax(
                    {
                        type: "GET",
                        url: "/backend/system/group/data?gid=" + gid,
                        success: function(data) {
                            if (data.code == 200) {
                                tabTpl.inputRender(data.data);
                                groupData = data.data;
                            } else {
                                layer.msg(JSON.stringify(data.message));
                            }
                        }
                    },
                    true,
                    1
                );
            });
            form.on("submit(submit)", function(data) {
                var parentLayer = parent.layer;
                var index = parentLayer.getFrameIndex(window.name); //先得到当前iframe层的索引
                data = data.field;
                if (data.status && data.status != 1) {
                    data.status = 0;
                }
                // console.log(groupData,23232);
                let dataKeys = Object.keys(data);
                groupData.forEach(element => {
                    element.value = data[element.key];
                    //   console.log(element,33);
                    if (element.config_type == "image") {
                        element.value = $("#" + element.key + "Show").attr(
                            "src"
                        );
                    } else if (element.config_type == "gallery") {
                        let gallery = $("#" + element.key + "Show").find("img");
                        element.value = [];
                        let value = gallery.map(index => {
                            element.value.push(gallery.eq(index).attr("src"));
                        });
                    }
                });
                request.zqajax(
                    {
                        type: "PATCH",
                        url: "/backend/system/edit",
                        data: { data: groupData },
                        success: function(data) {
                            if (data.code == 200) {
                                layer.msg("操作成功");
                            } else {
                                layer.msg(JSON.stringify(data.message));
                            }
                        }
                    },
                    true,
                    1
                );
                return false;
            });
        }
    );
</script>
@endsection

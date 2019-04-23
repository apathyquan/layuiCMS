@extends('layout.main') 
@include('layout.editOrAdd')
@section('content')
<script type="text/javascript">
    layui.use(
        [
            "jquery",
            "form",
            "layer",
            "inputTpl",
            "request",
            "layedit",
            "upload"
        ],
        function() {
            var form = layui.form,
                $ = layui.$,
                upload = layui.upload,
                layedit = layui.layedit,
                layer = layui.layer,
                request = layui.request,
                inputTpl = layui.inputTpl;
            var html = inputTpl.html;
            $(".layui-fluid").append(html);

            var layeditIndex = layedit.build("contentId");
            var router = layui.router();
            var id = router.search.id;
            request.zqajax({
                type: "GET",
                url: "/backend/permission/edit/" + id,
                success: function(data) {
                    if (data.code == 200) {
                        var dataAjax = data.data;
                        var jsonData = {
                            content: [
                                {
                                    label: "名称",
                                    name: "name",
                                    verify: "required",
                                    autocomplete: "off",
                                    value: dataAjax.name
                                },
                                {
                                    label: "链接",
                                    name: "href",
                                    verify: "",
                                    autocomplete: "off",
                                    value: dataAjax.href
                                },
                                {
                                    label: "icon",
                                    name: "icon",
                                    verify: "",
                                    autocomplete: "off",
                                    value: dataAjax.icon
                                }
                            ]
                        };
                        inputTpl.render(jsonData);
                    } else {
                        layer.msg(JSON.stringify(data.message));
                    }
                }
            });
            form.on("submit(submit)", function(data) {
                var parentLayer = parent.layer;
                var index = parentLayer.getFrameIndex(window.name); //先得到当前iframe层的索引
                data = data.field;
                data.id = id;
                request.zqajax(
                    {
                        type: "PATCH",
                        url: "/backend/permission/edit/" + id,
                        data: data,
                        success: function(data) {
                            if (data.code == 200) {
                                parent.layui.treeGrid.reload("treeTable", {}); //父级页面表格重载
                                parentLayer.close(index); //再执行关闭
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

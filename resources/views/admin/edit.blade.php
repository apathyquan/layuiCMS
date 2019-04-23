@extends('layout.main') 
@include('layout.editOrAdd')
@section('content')
<script type="text/javascript">
    layui.use(
        ["jquery", "form", "layer", "inputTpl", "request", "upload"],
        function() {
            var form = layui.form,
                $ = layui.$,
                layer = layui.layer,
                request = layui.request,
                upload = layui.upload,
                inputTpl = layui.inputTpl;
            var html = inputTpl.html;
            $(".layui-fluid").append(html);

            var router = layui.router();
            var id = router.search.id;
            request.zqajax({
                type: "GET",
                url: "/backend/admin/edit/" + id,
                success: function(data) {
                    if (data.code == 200) {
                        var dataAjax = data.data;
                        form.val("editForm", {
                            //渲染初始化数据
                            name: dataAjax.name,
                            mobile: dataAjax.mobile,
                            id: dataAjax.id,
                            status: dataAjax.status
                        });
                        var jsonData = {
                            content: [
                                {
                                    label: "用户名",
                                    name: "name",
                                    verify: "required",
                                    autocomplete: "off",
                                    value: dataAjax.name
                                },
                                {
                                    label: "头像",
                                    name: "icon",
                                    verify: "",
                                    autocomplete: "off",
                                    type: "uploadImg",
                                    value: dataAjax.icon,
                                    uploadUrl: "{{route('admin.upload')}}"
                                },
                                {
                                    label: "手机号码",
                                    name: "mobile",
                                    verify: "required|phone",
                                    value: dataAjax.mobile
                                },
                                {
                                    label: "用户状态",
                                    name: "status",
                                    inputType: "checkbox",
                                    skin: "switch",
                                    layText: "启用|禁用",
                                    value: dataAjax.status
                                }
                            ]
                        };
                        inputTpl.render(jsonData);
                    } else {
                        layer.msg(JSON.stringify(data.message));
                    }
                }
            });

            form.on(
                "submit(submit)",
                function(data) {
                    var parentLayer = parent.layer;
                    var index = parentLayer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    data = data.field;
                    if (data.status != 1) {
                        data.status = 0;
                    }
                    data.id = id;
                    data.icon = $("#iconShow").attr("src");
                    request.zqajax({
                        type: "PATCH",
                        url: "/backend/admin/edit/" + id,
                        data: data,
                        success: function(data) {
                            if (data.code == 200) {
                                parent.layui.table.reload("tableList", {}); //父级页面表格重载
                                parentLayer.close(index); //再执行关闭
                            } else {
                                layer.msg(JSON.stringify(data.message));
                            }
                        }
                    });

                    return false;
                },
                true,
                1
            );
        }
    );
</script>
@endsection

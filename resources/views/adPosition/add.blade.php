@extends('layout.main') 
@include('layout.editOrAdd')
@section('content')
<script type="text/javascript">
    layui.use(
        ["jquery", "form", "layer", "request", "inputTpl"],
        function() {
            var form = layui.form,
                $ = layui.$,
                layer = layui.layer,
                request = layui.request,
                inputTpl = layui.inputTpl;
            var html = inputTpl.html;
            $(".layui-fluid").append(html);
            var jsonData = {
                content: [
                    {
                        label: "名称",
                        name: "name",
                        verify: "required",
                        autocomplete: "off"
                    },
                    {
                        label: "标识",
                        name: "identity",
                        verify: "required",
                        autocomplete: "off"
                    },
                    {
                        label: "状态",
                        name: "status",
                        inputType: "checkbox",
                        skin: "switch",
                        layText: "启用|禁用"
                    }
                ]
            };
            inputTpl.render(jsonData);
            form.on("submit(submit)", function(data) {
                var parentLayer = parent.layer;
                var index = parentLayer.getFrameIndex(window.name); //先得到当前iframe层的索引
                data = data.field;
                if (data.status != 1) {
                    data.status = 0;
                }
                request.zqajax(
                    {
                        type: "POST",
                        url: "{{route('ad.position.addPost')}}",
                        dataType: "json",
                        data: data,
                        success: function(data) {
                            if (data.code == 200) {
                                parent.layui.table.reload("tableList", {}); //父级页面表格重载
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

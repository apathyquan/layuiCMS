@extends('layout.main') 
@include('layout.editOrAdd')
@section('content')
<script type="text/javascript">
    layui.use(
        ["jquery", "form", "layer", "request", "formSelects", "inputTpl"],
        function() {
            var form = layui.form,
                $ = layui.$,
                layer = layui.layer,
                request = layui.request,
                router = layui.router(),
                formSelects = layui.formSelects,
                inputTpl = layui.inputTpl;
            var html = inputTpl.html;
            $(".layui-fluid").append(html);
            var jsonData = {};

            var id = router.search.id;

            request.zqajax({
                url: `/backend/admin/impower/role/${id}`,
                success: function(res) {
                    var jsonData = {
                        content: [
                            {
                                label: "角色",
                                name: "name",
                                verify: "required",
                                autocomplete: "off",
                                type: "formSelect",
                                value: res.data,
                                selectMax:10,
                                url: "{{route('admin.impower.data')}}"
                            }
                        ]
                    };
                    inputTpl.render(jsonData);
                }
            });

            form.on("submit(submit)", function(data) {
                var ids = formSelects.value("nameId", "val");

                var parentLayer = parent.layer;
                var index = parentLayer.getFrameIndex(window.name); //先得到当前iframe层的索引
                request.zqajax(
                    {
                        type: "PATCH",
                        url: `/backend/admin/impower/${id}`,
                        data: { arr: ids },
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

@extends('layout.main') 
@include('layout.editOrAdd')
@section('content')
<script type="text/javascript">
    layui.use(['jquery', 'form', 'layer', 'request', 'inputTpl'], function () {
        var form = layui.form,
            $ = layui.$,
            layer = layui.layer,
            request = layui.request,
            inputTpl = layui.inputTpl;
        var html = inputTpl.html;
        $('.layui-fluid').append(html);
        var jsonData = {
            content: [{
                label: '角色名',
                name: 'name',
                verify: 'required',
                autocomplete: 'off',
            }]
        };
        inputTpl.render(jsonData);
        form.on('submit(submit)', function (data) {
            var parentLayer = parent.layer;
            var index = parentLayer.getFrameIndex(window.name); //先得到当前iframe层的索引
            data = data.field;
            request.zqajax({
                type: 'POST',
                url: "{{route('role.addPost')}}",
                dataType: 'json',
                data: data,
                success: function (data) {
                    if (data.code == 200) {
                        parent.layui.table.reload('tableList', {}); //父级页面表格重载
                        parentLayer.close(index); //再执行关闭
                    } else {
                        layer.msg(JSON.stringify(data.message));
                    }
                }
            }, true, 1);

            return false;
        });


    });
</script>
@endsection
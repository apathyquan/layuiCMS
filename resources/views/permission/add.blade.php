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
        var router = layui.router();
        var parent_id = router.search.id;
        $('.layui-fluid').append(html);
        var jsonData = {
            content: [{
                label: '名称',
                name: 'name',
                verify: 'required',
                autocomplete: 'off',
            }, {
                label: '链接',
                name: 'href',
                verify: '',
                autocomplete: 'off',
            }, {
                label: 'icon',
                name: 'icon',
                verify: '',
                autocomplete: 'off',
            }
            ]
        };
        inputTpl.render(jsonData);
        form.on('submit(submit)', function (data) {
            var parentLayer = parent.layer;
            var index = parentLayer.getFrameIndex(window.name); //先得到当前iframe层的索引
            data = data.field;
            data.parent_id=parent_id;
            request.zqajax({
                type: 'POST',
                url: "{{route('permission.addPost')}}",
                dataType: 'json',
                data: data,
                success: function (data) {
                    if (data.code == 200) {
                        parent.layui.treeGrid.reload('treeTable', {}); //父级页面表格重载
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
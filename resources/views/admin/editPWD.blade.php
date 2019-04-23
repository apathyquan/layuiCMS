@extends('layout.main') 
@include('layout.editOrAdd')
@section('content')
<script type="text/javascript">
layui.use(['jquery', 'form', 'layer', 'inputTpl','request'], function() {
    var form = layui.form,
        $ = layui.$,
        layer = layui.layer,
        inputTpl = layui.inputTpl,
        request=layui.request,
        router=layui.router();
    var tpl = inputTpl.html;
    $('.layui-fluid').append(tpl);
    var jsonData = {
        content: [{
            label: '密码',
            name: 'password',
            inputType: 'password',
            verify: 'required',
        }, {
            label: '密码确认',
            name: 'password_confirmation',
            inputType: 'password',
            verify: 'required',
        }]
    };
    inputTpl.render(jsonData);
    var id=router.search.id;
    form.on('submit(submit)', function(data) {
        var parentLayer = parent.layer;
        var index = parentLayer.getFrameIndex(window.name); //先得到当前iframe层的索引
        data = data.field;
        if (data.status != 1) {
            data.status = 0;
        }
       request.zqajax({
            type: 'PATCH',
            url: id,
            data: data,
            success: function(data) {
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
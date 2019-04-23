@extends('layout.main') 
@include('layout.editOrAdd')
@section('content')
<script type="text/javascript">
    layui.use(['jquery', 'form', 'layer', 'inputTpl', 'element', 'request','upload'], function () {
        var form = layui.form,
            $ = layui.$,
            layer = layui.layer,
            request = layui.request,
            element = layui.element,
            upload=layui.upload,
            inputTpl = layui.inputTpl;
        var html = inputTpl.html;
        $('.layui-fluid').append(html);
        var jsonData = {
            content: [{
                label: '用户名',
                name: 'name',
                verify: 'required',
                autocomplete: 'off',
            }, {
                label: '头像',
                name: 'icon',
                verify: '',
                autocomplete: 'off',
                type: 'uploadImg',
                uploadUrl: "{{route('admin.upload')}}"
            }, {
                label: '手机号码',
                name: 'mobile',
                verify: 'required|phone',
            }, {
                label: '用户状态',
                name: 'status',
                inputType: 'checkbox',
                skin: "switch",
                layText: '启用|禁用',
            }, {
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

        form.on('submit(submit)', function (data) {
            var parentLayer = parent.layer;
            var index = parentLayer.getFrameIndex(window.name); //先得到当前iframe层的索引
            // data = data.field;
            // console.log(data.field);
            data=data.field;
            data.icon= $('#iconShow').attr('src');
            request.zqajax({
                type: 'POST',
                url: "{{route('admin.addPost')}}",
                dataType: 'json',
                data: data,
                success: function (data) {
                        parent.layui.table.reload('tableList', {}); //父级页面表格重载
                        parentLayer.close(index); //再执行关闭

                }
            }, true, 1);

            return false;
        });


    });
</script>
@endsection
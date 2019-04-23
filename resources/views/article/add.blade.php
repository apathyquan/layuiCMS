@extends('layout.main') 
@include('layout.editOrAdd')
@section('content')
<script type="text/javascript">
    layui.use(
        ["jquery", "form", "layer", "request", "inputTpl", "upload"],
        function() {
            var form = layui.form,
                $ = layui.$,
                layer = layui.layer,
                request = layui.request,
                upload = layui.upload,
                inputTpl = layui.inputTpl;
            var html = inputTpl.html;
            $(".layui-fluid").append(html);
            var jsonData = {
                content: [
                    {
                        label: "文章分类",
                        name: "category_id",
                        verify: "required",
                        autocomplete: "off",
                        type: "formSelect",
                        keyName: "category_name",
                        keyVal: "id",
                        linkage: true,
                        keyChildren: "children",
                        selectMax: 1,
                        style: "primary",
                        url: "{{route('articleCategory.data',['tree'=>true])}}"
                    },
                    {
                        label: "标题",
                        name: "title",
                        verify: "required",
                        autocomplete: "off"
                    },
                    {
                        label: "状态",
                        name: "status",
                        inputType: "checkbox",
                        skin: "switch",
                        layText: "发布|下线"
                    },
                    {
                        label: "封面图",
                        name: "cover",
                        verify: "required",
                        autocomplete: "off",
                        type: "uploadImg",
                        uploadUrl: "{{route('article.upload')}}"
                    },
                    {
                        label: "内容",
                        name: "content",
                        verify: "required",
                        autocomplete: "off",
                        type: "editor"
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
                data.content = window.editor["contentId"].txt.html();
                data.cover = $("#coverShow").attr("src");
                request.zqajax(
                    {
                        type: "POST",
                        url: "{{route('article.addPost')}}",
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

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
            "upload",
            "formSelects"
        ],
        function() {
            var form = layui.form,
                $ = layui.$,
                upload = layui.upload,
                layer = layui.layer,
                request = layui.request,
                formSelects = layui.formSelects,
                inputTpl = layui.inputTpl;
            var html = inputTpl.html;
            $(".layui-fluid").append(html);
            var router = layui.router();
            var id = router.search.id;

            request.zqajax({
                type: "GET",
                url: "/backend/article/edit/" + id,
                success: function(data) {
                    var dataAjax = data.data;
                    let arr = new Array();
                    arr.push(dataAjax.category_id);
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
                                keyChildren: "children",
                                linkage: true,
                                value: arr,
                                selectMax: 1,
                                style: "primary",
                                url:"{{route('articleCategory.data',['tree'=>true])}}"
                            },
                            {
                                label: "标题",
                                name: "title",
                                value: dataAjax.title,
                                verify: "required",
                                autocomplete: "off"
                            },
                            {
                                label: "状态",
                                name: "status",
                                inputType: "checkbox",
                                value: dataAjax.status,
                                skin: "switch",
                                layText: "发布|下线"
                            },
                            {
                                label: "封面图",
                                name: "cover",
                                verify: "required",
                                autocomplete: "off",
                                value: dataAjax.cover,
                                type: "uploadImg",
                                uploadUrl: "{{route('article.upload')}}"
                            },
                            {
                                label: "内容",
                                name: "content",
                                verify: "required",
                                autocomplete: "off",
                                value: dataAjax.content,
                                type: "editor",
                            }
                        ]
                    };
                    inputTpl.render(jsonData);
                }
            });

            form.on("submit(submit)", function(data) {

                var parentLayer = parent.layer;
                var index = parentLayer.getFrameIndex(window.name); //先得到当前iframe层的索引
                data = data.field;
                if (data.status != 1) {
                    data.status = 0;
                }
                data.content=window.editor['contentId'].txt.html();

                data.id = id;
                data.cover = $("#coverShow").attr("src");
   
                request.zqajax(
                    {
                        type: "PATCH",
                        url: "/backend/article/edit/" + id,
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

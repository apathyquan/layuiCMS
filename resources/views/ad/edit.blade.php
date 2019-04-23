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
        function () {
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
                url: "/backend/ad/edit/" + id,
                success: function (data) {
                    var dataAjax = data.data;
                    let optionDefault=[];
                         optionDefault.push(dataAjax.ad_position_id);
                    var jsonData = {
                        content: [
                            {
                                label: "广告位置",
                                name: "ad_position_id",
                                verify: "required",
                                autocomplete: "off",
                                type: "formSelect",
                                keyName: "name",
                                keyVal: "id",
                                value: optionDefault,
                                selectMax: 1,
                                style: "primary",
                                url:
                                    "{{route('ad.position.data')}}"
                            },
                            {
                                label: "广告名称",
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
                                label: "广告图片",
                                name: "img_path",
                                verify: "required",
                                autocomplete: "off",
                                value: dataAjax.img_path,
                                type: "uploadImg",
                                uploadUrl: "{{route('ad.upload')}}"
                            },
                            {
                                label: "广告链接",
                                name: "text_link",
                                verify: "required",
                                autocomplete: "off",
                                value: dataAjax.text_link,
                            }
                        ]
                    };
                    inputTpl.render(jsonData);
                }
            });

            form.on("submit(submit)", function (data) {

                var parentLayer = parent.layer;
                var index = parentLayer.getFrameIndex(window.name); //先得到当前iframe层的索引
                data = data.field;
                if (data.status != 1) {
                    data.status = 0;
                }
                data.id = id;
                data.img_path = $("#img_pathShow").attr("src");

                request.zqajax(
                    {
                        type: "PATCH",
                        url: "/backend/ad/edit/" + id,
                        data: data,
                        success: function (data) {
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
@extends('layout.main') @section('content')
<div class="layui-fluid layui-anim  ">
    <div class="layui-row">
        <div class="layui-col-md12 bg">
            <div class="layui-card padding-15">
                <form class="layui-form flex-wrap" id="inputContent"></form>
            </div>
        </div>
    </div>
    <div class="table-bg">
        <div>
            <button class="layui-btn" id="add">新增</button>
            <button class="layui-btn layui-btn-danger" id="batchDelete">
                批量删除
            </button>
        </div>
        <table id="tableList" lay-filter="list"></table>
    </div>
</div>

<script type="text/javascript">
    layui.use(
        ["jquery", "form", "table", "element", "dialog", "request", "inputTpl"],
        function() {
            var form = layui.form,
                table = layui.table,
                element = layui.element,
                $ = layui.$,
                request = layui.request,
                dialog = layui.dialog,
                inputTpl = layui.inputTpl;
            var html = inputTpl.html;
            $(".layui-fluid").append(html);
            var jsonData = {
                content: [
                    {
                        label: "名称",
                        name: "title",
                        autocomplete: "off"
                    }
                ],
                layFilter: "search", //提交按钮的lay-filter
                button: true //是否需要button
            };
            inputTpl.render(jsonData);
            // form.render();
            var tableIns = table.render({
                elem: "#tableList",
                // height: 315,
                toolbar: ["filter", "print", "exports"],
                url: "{{route('ad.data')}}",
                response: {
                    statusCode: 200 //规定成功的状态码，默认：0
                },
                page: true, //开启分页
                cols: [
                    [
                        //表头
                        { type: "checkbox", fixed: "left" },
                        { field: "id", title: "ID", sort: true, fixed: "left" },
                        {
                            field: "ad_position_id",
                            sort: true,
                            title: "广告位置",
                            templet: d => {
                                return d.ad_position.name;
                            }
                        },
                        { field: "title", title: "广告名称" },
                        {
                            field: "status",
                            title: "状态",
                            templet: d => {
                                return d.status == 0 ? "禁止" : "启用";
                            }
                        },
                        { field: "created_at", title: "创建时间" },
                        { field: "updated_at", title: "修改时间" },
                        {
                            title: "操作",
                            // minWidth: 200,
                            templet: d => {
                                return (
                                    '<button class="layui-btn layui-btn-xs "  id="edit" data-id="' +
                                    d.id +
                                    '">编辑</button><button class="layui-btn layui-btn-xs layui-btn-danger "  id="delete" data-id="' +
                                    d.id +
                                    '">删除</button>'
                                );
                            }
                        }
                    ]
                ]
            });

            //绑定新增事件
            $(document).on("click", "#add", function(data) {
                // var id = $(this).attr('data-id');
                dialog.addOrEdit("新增", "{{route('ad.add')}}", "60%", "85%");
            });
            //绑定编辑事件
            $(document).on("click", "#edit", function(data) {
                var id = $(this).attr("data-id");
                var url = "{{route('ad.edit')}}/#/id=" + id;
                // console.log("edit/"+id);
                dialog.addOrEdit("编辑", url, "60%", "85%");
            });

            //批量删除
            $(document).on("click", "#batchDelete", function() {
                let data = table.checkStatus("tableList").data;
                let ids = data.map(item => {
                    return item.id;
                });
                layui.event("onDelete", "delete", ids);
            });
            //删除
            $(document).on("click", "#delete", function(data) {
                var id = $(this).attr("data-id");
                layui.event("onDelete", "delete", id);
            });
            //刪除
            layui.onevent("onDelete", "delete", function(
                ids,
                message = "是否确认删除数据"
            ) {
                var id = $(this).attr("data-id");
                var url = "{{route('ad.delete')}}?id=" + ids;
                dialog.confirm({
                    message: message,
                    success: function() {
                        request.zqajax({
                            type: "DELETE",
                            url: url,
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                if (data.code == 200) {
                                    layer.closeAll();
                                    layer.msg("删除成功");
                                    tableIns.reload("tableList", {});
                                } else {
                                    layer.msg(JSON.stringify(data.message));
                                }
                            }
                        });
                    },
                    cancel: function() {
                        layer.msg("已取消");
                    }
                });
            });
            form.on("submit(search)", function(data) {
                //提交搜索
                table.reload("tableList", {
                    url: "{{route('ad.data')}}",
                    where: data.field //设定异步数据接口的额外参数
                    //,height: 300
                });

                return false;
            });
        }
    );
</script>
@endsection

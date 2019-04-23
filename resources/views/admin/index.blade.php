@extends('layout.main') @section('content')
<div class="layui-fluid layui-anim  ">
    <div class="layui-row">
        <div class="layui-col-md12 bg">
            <div class="layui-card padding-15">
                <form class="layui-form flex-wrap" id="inputContent">
                </form>
            </div>
        </div>
    </div>
    <!-- 操作 -->
    <div class="table-bg">
        <div>
            <button class="layui-btn" id="add">新增</button>
            <!-- <button class="layui-btn layui-btn-danger">批量删除</button> -->
        </div>
        <table id="tableList" lay-filter="list"></table>
    </div>
</div>
<script type="text/javascript">
    layui.use(
        ["jquery", "form", "table", "element", "dialog", "layer", "request",
            "inputTpl"],
        function() {
            var form = layui.form,
                table = layui.table,
                layer = layui.layer,
                element = layui.element,
                $ = layui.$,
                dialog = layui.dialog,
                inputTpl = layui.inputTpl,
                request = layui.request;
            var html = inputTpl.html;
            $(".layui-fluid").append(html);
            var jsonData = {
                content: [
                    {
                        label: "名称",
                        name: "name",
                        autocomplete: "off"
                    },
                    {
                        label: "手机号码",
                        name: "mobile",
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
                // toolbar: ['filter', 'print', 'exports'],
                // height: 315,
                url: "{{route('admin.data')}}",
                response: {
                    statusCode: 200, //规定成功的状态码，默认：0
                },
                page: true, //开启分页
                cols: [
                    [
                        //表头
                        // { type: "checkbox", fixed: "left" },
                        { field: "id", title: "ID", sort: true, fixed: "left" },
                        { field: "name", title: "用户名" },
                        {
                            title: "头像",
                            templet: function(d) {
                                return (
                                    "<img src=" +
                                    d.icon +
                                    ' class="layui-nav-img"/>'
                                );
                            }
                        },
                        { field: "mobile", title: "手机号码" },
                        {
                            field: "status",
                            title: "状态",
                            templet: function(d) {
                                return d.status == 0 ? "禁止" : "启用";
                            }
                        },
                        { field: "created_at", title: "创建时间" },
                        { field: "updated_at", title: "修改时间" },
                        {
                            title: "操作",
                            // minWidth: 200,
                            templet: function(d) {
                                return (
                                    '<button class="layui-btn layui-btn-primary layui-btn-xs "  id="impower" data-id="' +
                                    d.id +
                                    '">角色选择</button><button class="layui-btn layui-btn-xs "  id="edit" data-id="' +
                                    d.id +
                                    '">编辑</button><button class="layui-btn layui-btn-xs "  id="editPWD" data-id="' +
                                    d.id +
                                    '">修改密码</button><button class="layui-btn layui-btn-xs layui-btn-danger "  id="delete" data-id="' +
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
                dialog.addOrEdit(
                    "新增",
                    "{{route('admin.add')}}",
                    "70%",
                    "81%"
                );
            });
            //授权
            $(document).on("click", "#impower", function(data) {
                var id = $(this).attr("data-id");
                var url = `{{route('admin.impower')}}/#/id=${id}`;
                dialog.addOrEdit("角色选择", url, "60%", "60%");
            });
            //绑定编辑事件
            $(document).on("click", "#edit", function(data) {
                var id = $(this).attr("data-id");
                var url = "{{route('admin.edit')}}" + "/#/id=" + id;
                // console.log("edit/"+id);
                dialog.addOrEdit("编辑", url, "70%", "81%");
            });
            //绑定编辑事件
            $(document).on("click", "#editPWD", function(data) {
                var id = $(this).attr("data-id");
                var url = `{{route('admin.editpwd')}}/#/id=${id}`;
                // console.log("edit/"+id);
                dialog.addOrEdit("修改密码", url, "40%", "40%");
            });
            $(document).on("click", "#delete", function(data) {
                var id = $(this).attr("data-id");
                var url = "{{route('admin.delete')}}?id=" + id;
                // console.log("edit/"+id);
                dialog.confirm({
                    message: "你确认删除吗？",
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
                    url: "{{route('admin.data')}}",
                    where: data.field//设定异步数据接口的额外参数
                    //,height: 300
                });

                return false;
            });
        }
    );
</script>
@endsection

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
                inputTpl = layui.inputTpl,
                $ = layui.$,
                request = layui.request,
                html = inputTpl.html;
            $(".layui-fluid").append(html);
            var jsonData = {
                content: [
                    {
                        label: "用户名",
                        name: "name",
                        autocomplete: "off",
                        type: "input"
                    }
                ],
                layFilter: "search", //提交按钮的lay-filter
                button: true //是否需要button
            };
            inputTpl.render(jsonData);
            var tableIns = table.render({
                elem: "#tableList",
                url: "{{route('loginRecord.data')}}",
                response: {
                    statusCode: 200 //规定成功的状态码，默认：0
                },
                page: true, //开启分页
                cols: [
                    [
                        //表头
                        // { type: "checkbox", fixed: "left" },
                        { field: "id", title: "ID", sort: true, fixed: "left" },
                        {
                            field: "user",
                            title: "用户名",
                            templet: function(d) {
                                return d.user.name;
                            }
                        },
                        { field: "ip", title: "IP" },
                        { field: "country", title: "国家", sort: true },
                        { field: "province", title: "省份", sort: true },
                        { field: "city", title: "城市", sort: true },
                        { field: "created_at", title: "创建时间", sort: true }
                    ]
                ]
            });

            form.on("submit(search)", function(data) {
                // console.log(data.field);
                //提交搜索
                table.reload("tableList", {
                    url: "{{route('loginRecord.data')}}",
                    where: data.field //设定异步数据接口的额外参数
                    //,height: 300
                });

                return false;
            });
        }
    );
</script>
@endsection

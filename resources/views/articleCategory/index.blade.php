@extends('layout.main') @section('content')

<div class="layui-fluid layui-anim ">
    <div class="layui-row">
        <div class="layui-col-md12 bg table-bg">
            <div>
                <button class="layui-btn" id="add">新增</button>
                <!--
                    <button class="layui-btn layui-btn-danger">批量删除</button>
                -->
            </div>
            <div class="dBody">
                <table
                    class="layui-hidden"
                    id="treeTable"
                    lay-filter="treeTable"
                ></table>
            </div>
        </div>
    </div>
</div>
<script>
    var editObj = null,
        ptable = null,
        treeGrid = null,
        tableId = "treeTable",
        layer = null;
    layui.use(
        ["element", "dialog", "request", "jquery", "request", "treeGrid"],
        function() {
            var element = layui.element,
                dialog = layui.dialog,
                $ = layui.$,
                request = layui.request,
                treeGrid = layui.treeGrid;
            //绑定新增事件
            $(document).on("click", "#add", function(data) {
                var id = $(this).attr("data-id");
                var url = "{{route('articleCategory.add')}}/#/id=" + id;
                dialog.addOrEdit("新增", url, "70%", "60%");
            });
            //绑定编辑事件
            $(document).on("click", "#edit", function(data) {
                var id = $(this).attr("data-id");
                var url = "{{route('articleCategory.edit')}}/#/id=" + id;
                // console.log("edit/"+id);
                dialog.addOrEdit("编辑", url, "70%", "60%");
            });
            //删除
            $(document).on("click", "#delete", function(data) {
                var id = $(this).attr("data-id");
                var url = "{{route('articleCategory.delete')}}?id=" + id;
                // console.log("edit/"+id);
                dialog.confirm({
                    message: "你确认删除吗？",
                    success: function() {
                        request.zqajax({
                            type: "DELETE",
                            url: url,
                            dataType: "json",
                            success: function(data) {
                                // console.log(data);
                                if (data.code == 200) {
                                    layer.closeAll();
                                    layer.msg("删除成功");
                                    treeGrid.reload("treeTable", {});
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
            ptable = treeGrid.render({
                id: tableId,
                elem: "#" + tableId,
                url: "category/listData",
                cellMinWidth: 100,
                response: {
                    statusCode: 200, //规定成功的状态码，默认：0
                },
                idField: "id", //必須字段
                treeId: "id", //树形id字段名称
                treeUpId: "parent_id", //树形父id字段名称
                treeShowName: "category_name", //以树形式显示的字段
                heightRemove: [".dHead", 10], //不计算的高度,表格设定的是固定高度，此项不生效
                height: "100%",
                isFilter: false,
                iconOpen: false, //是否显示图标【默认显示】
                isOpenDefault: true, //节点默认是展开还是折叠【默认展开】
                onClickRow: null, //行单击事件
                onDblClickRow: null, //行双击事件
                loading: true,
                method: "get",
                cols: [
                    [
                        // { type: 'numbers' },
                        // ,{ type: 'radio' },
                        // { type: 'checkbox', sort: false },
                        {
                            width: 150,
                            title: "操作",
                            align: "center" /*toolbar: '#barDemo'*/,
                            templet: function(d) {
                                var addBtn =
                                    '<a class="layui-btn layui-btn-primary layui-btn-xs" data-id="' +
                                    d.id +
                                    '" id="add" >添加</a>';
                                var editBtn =
                                    '<a class="layui-btn layui-btn-primary layui-btn-xs" data-id="' +
                                    d.id +
                                    '" id="edit">编辑</a>';
                                var delBtn =
                                    '<a class="layui-btn layui-btn-danger layui-btn-xs" data-id="' +
                                    d.id +
                                    '" id="delete">删除</a>';
                                return addBtn + editBtn + delBtn;
                            }
                        },
                        // { width: 300, field: 'name', title: '名称', edit: 'text', sort: false },
                        {
                            width: 300,
                            field: "category_name",
                            title: "分类名称",
                            sort: false
                        },
                        { field: "id", title: "id", sort: false },
                        { field: "parent_id", title: "pid", sort: false },
                        {
                            field: "icon",
                            title: "icon",
                            sort: false,
                            templet: function(d) {
                                return (
                                    '<img class="layui-icon list-icon" src="'+d.icon+'"></img>'
                                );
                            }
                        }
                    ]
                ],
                isPage: false,
                parseData: function(res) {
                    //数据加载后回调
                    return res;
                },
                onClickRow: function(index, o) {
                    console.log(index, o, "单击！");
                },
                onDblClickRow: function(index, o) {
                    console.log(index, o, "双击");
                }
            });

            treeGrid.on("tool(" + tableId + ")", function(obj) {
                if (obj.event === "del") {
                    //删除行
                    del(obj);
                } else if (obj.event === "add") {
                    //添加行
                    add(obj);
                }
            });
        }
    );

    // function print() {
    //     console.log(treeGrid.cache[tableId]);
    //     var loadIndex = layer.msg("对象已打印，按F12，在控制台查看！", {
    //         time: 3000
    //         , offset: 'auto'//顶部
    //         , shade: 0
    //     });
    // }

    // function openorclose() {
    //     var map = treeGrid.getDataMap(tableId);
    //     var o = map['102'];
    //     treeGrid.treeNodeOpen(tableId, o, !o[treeGrid.config.cols.isOpen]);
    // }

    // function openAll() {
    //     var treedata = treeGrid.getDataTreeList(tableId);
    //     treeGrid.treeOpenAll(tableId, !treedata[0][treeGrid.config.cols.isOpen]);
    // }
    // function getCheckData() {
    //     var checkStatus = treeGrid.checkStatus(tableId)
    //         , data = checkStatus.data;
    //     layer.alert(JSON.stringify(data));
    // }
    // function radioStatus() {
    //     var data = treeGrid.radioStatus(tableId)
    //     layer.alert(JSON.stringify(data));
    // }
    // function getCheckLength() {
    //     var checkStatus = treeGrid.checkStatus(tableId)
    //         , data = checkStatus.data;
    //     layer.msg('选中了：' + data.length + ' 个');
    // }

    // function reload() {
    //     treeGrid.reload(tableId, {
    //         page: {
    //             curr: 1
    //         }
    //     });
    // }
</script>

@endsection

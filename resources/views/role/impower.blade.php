@extends('layout.main') @include('layout.editOrAdd') @section('content')
<script type="text/javascript">
    layui.use(
        ["jquery", "form", "eleTree", "request", "element", "inputTpl"],
        function() {
            var $ = layui.jquery,
                eleTree = layui.eleTree,
                form = layui.form,
                request = layui.request,
                element = layui.element,
                inputTpl = layui.inputTpl;
            var router = layui.router();
            var id = router.search.id;
            var html = inputTpl.html;
            $(".layui-fluid").append(html);
            var jsonData = {
                content: [
                    {
                        label: "",
                        name: "tree",
                        type: "tree",
                        autocomplete: "off",
                        treeConfig: {
                            elem: "#treeId",
                            url: `/backend/role/impower/data/${id}`,
                            type: "get",
                            showCheckbox: true,
                            drag: false,
                            accordion: false,
                            defaultExpandAll:true,
                            response: {
                                statusName: "code",
                                statusCode: 200,
                                dataName: "data"
                            },
                            request: {
                                name: "name",
                                key: "id",
                                children: "children",
                                checked: "checked",
                                disabled: "disabled",
                                isLeaf: "isLeaf"
                            }
                        }
                    }
                ]
            };

            inputTpl.render(jsonData);
            form.on("submit(submit)", function() {
                let parentLayer = parent.layer;
                let index = parentLayer.getFrameIndex(window.name); //先得到当前iframe层的索引
                let tmpData = window.eleTree.getChecked(false,true);
                        //   console.log(tmpData);return false;
                let data = new Array();
                for (let i = 0, len = tmpData.length; i < len; i++) {
                    data.push(tmpData[i].name);
                }
                request.zqajax(
                    {
                        url: `/backend/role/impower/${id}`,
                        type: "PATCH",
                        data: { data: data },
                        success: function(res) {
                            parentLayer.close(index);
                        }
                    },
                    true,
                    1
                );
            });
        }
    );
</script>

@endsection

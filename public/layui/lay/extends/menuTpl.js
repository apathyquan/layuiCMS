layui.define(['jquery', 'laytpl', 'element'], function(exports) {
    var laytpl = layui.laytpl,
        element = layui.element;
    var menuTpl = {
        menu: function(res) {
            var html = '';
            html += '<script id="menuTemplate" type="text/html">'
            html += '<div class="layui-side-scroll " >'
            html += '<ul class="layui-nav layui-nav-tree " lay-shrink="all"  lay-filter="menuList">'
            html += '{{# layui.each(d, function(index, item){    }}'
            html += ' <li class="layui-nav-item {{ item.expand }}">'
            html += ' <a class="" href="javascript:;"><i class="layui-icon {{ item.icon }}"></i><span class="iconText">{{ item.name }}</span></a>'
            html += '{{# layui.each(item.child,function(index,dd) { }}'
            html += '<dl class="layui-nav-child">'
            html += '<dd>'
            html += ' <a href="javascript:;" lay-href="{{ dd.href }}">'
            html += ' {{ dd.name }}'
            html += ' </a>'
            html += '</dd>'
            html += '</dl>'
            html += ' {{# }); }}'
            html += ' </li>'
            html += ' {{# }); }}'
            html += ' </ul>'
            html += '</div>'
            html += '</script>'
            return html;
        },
        render: function(jsonData) {
            // console.log(jsonData);
            // var jsonData = [
            //     {
            //         name: '系統管理',
            //         icon: 'layui-icon-auz',
            //         expand: 'layui-nav-itemed', //是否默认展开
            //         child: [{
            //             name: '管理员列表',
            //             href: "admin"
            //         }, {
            //             name: '角色列表',
            //             href: "role"
            //         }, {
            //             name: '权限列表',
            //             href: "permission"
            //         }]
            //     }, {
            //         name: '新闻系统',
            //         icon: 'layui-icon-read',
            //         child: [{
            //             name: '广告位',
            //             href: ""
            //         }, {
            //             name: '广告列表',
            //             href: ""
            //         }, {
            //             name: '分类管理',
            //             href: ""
            //         }, {
            //             name: '标签管理',
            //             href: ""
            //         }, {
            //             name: '文章管理',
            //             href: ""
            //         }]
            //     }, {
            //         name: '文件管理系统',
            //         icon: 'layui-icon-file-b',
            //         child: [{
            //             name: '文件列表',
            //             href: ""
            //         }]
            //     }, {
            //         name: '安全管理',
            //         icon: 'layui-icon-log',
            //         child: [{
            //             name: '系统日志',
            //             href: ""
            //         }]
            //     }
            // ];
            var getTpl = menuTemplate.innerHTML,
                view = document.getElementById('menu');
            laytpl(getTpl).render(jsonData, function(html) {
                view.innerHTML = html;
            });

            element.render();
        }
    };
    exports('menuTpl', menuTpl);
});
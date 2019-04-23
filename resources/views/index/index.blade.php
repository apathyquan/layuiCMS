@extends('layout.main') @section('content')
<div class="layui-layout layui-layout-admin ">
    <div class="layui-header">
        <div class="layui-header-left ">
            <div class="layui-bg-black zq-logo ">{{$webTitle}}</div>
        </div>
        <div class="layui-header-right">
            <div class="bg-white">
                <button class="layui-btn layui-btn-primary menu-btn" id="menuBtn">
                    <i class="layui-icon layui-icon-spread-left menu-icon"></i>
                </button>
            </div>
            <ul class="layui-nav layui-layout-right   font-color ">
                <li class="layui-nav-item line-hight">
                    <a href="javascript:;">
                        <img src="{{auth('backend')->user()->icon}}" class="layui-nav-img">
                        {{auth('backend')->user()->name}}
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="{{route('backend.logout')}}">退出</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <div class="layui-side layui-bg-black" id="menu"></div>
    <div class="layui-body ">
        <div class=" layui-tab  index-layui-tab layui-tab-card" lay-allowClose="true" lay-filter="tabCard">
            <ul class="layui-tab-title" id="tab-list">
                <li class="layui-this" lay-id="{{route('backend.home')}}"><i class="layui-icon layui-icon-home home-tab"></i></li>
            </ul>
        </div>
        <!-- 内容主体区域 -->
        <div class="content">
            <iframe src="{{route('backend.home')}}" id="contentFrame" frameborder="0" scrolling="yes" width="100%"
                height="100%"></iframe>
        </div>
    </div>
    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © xianglong.site 
    </div>
</div>
<script>
    //JavaScript代码区域
    layui.use(['jquery', 'element', 'laytpl', 'menuTpl', 'request'], function () {
        var element = layui.element,
            laytpl = layui.laytpl,
            $ = layui.$,
            menuTpl = layui.menuTpl,
            request = layui.request;
        var menu = menuTpl.menu;
        $('#menu').append(menu);

        request.zqajax({
            url: 'menu',
            success: function (res) {
                menuTpl.render(res.data);
            }
        })
        //初始化动态元素，一些动态生成的元素如果不设置初始化，将不会有默认的动态效果
        // element.render();
        //监听切换tab
        element.on('tab(tabCard)', function (data) {
            // var layId=data.elem.context.attributes['lay-id'].value;
            var layId = $(this).attr('lay-id');
            $('#contentFrame').attr('src', layId);

        });
        //导航条点击监听，新增tab
        element.on('nav(menuList)', function (elem) {
            var title = $(this).text();
            var content = $(this).attr('lay-href');
            if (content) {
                var exist = $("li[lay-id='" + content + "']").length; //判断是否存在tab
                if (exist == 0) {
                    element.tabAdd('tabCard', {
                        title: title,
                        content: content, //支持传入html
                        id: content,
                    });
                }
            }
            element.tabChange('tabCard', content); //切换tab
        });
        //菜单显示和隐藏
        $("#menuBtn").on('click', function () {
            //layui-icon-shrink-right
            let btn = $("#menuBtn i");
            if (btn.hasClass('layui-icon-spread-left')) {
                menuHide(btn);
                btn.addClass('btn-index');

            } else {
                btn.removeClass('btn-index');
                menuShow(btn);
            }
        })
        $(window).resize(function () {
            let width = $(document.body).width();
            let btn = $("#menuBtn i");
            if (width < 1000) {
                if (btn.hasClass('layui-icon-spread-left')) {
                    menuHide(btn);
                }
            } else {
                if (!btn.hasClass('btn-index')) {
                    if (btn.hasClass('layui-icon-shrink-right')) {
                        menuShow(btn);
                    }
                }


            }

        });

        function menuShow(btn) {
            btn.removeClass('layui-icon-shrink-right').addClass('layui-icon-spread-left');
            $(".layui-side").animate({ width: 'toggle' });
            $(".zq-logo").animate({ width: 'toggle' });
            $(".layui-body").animate({ left: '200px' });
            $(".layui-footer").animate({ left: '200px' });
        }

        function menuHide(btn) {
            btn.removeClass(' layui-icon-spread-left').addClass('layui-icon-shrink-right');
            $(".layui-side").animate({ width: 'toggle' }); //toggle如果原来div是隐藏的就会把元素显示，如果原来是显示则隐藏
            $(".zq-logo").animate({ width: 'toggle' });
            $(".layui-body").animate({ left: '0px' });
            $(".layui-footer").animate({ left: '0px' });
        }
    });
</script>
@endsection

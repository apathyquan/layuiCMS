@extends('layout.main') @section('content')
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md6 flex-column ">
            <div class="layui-card block-bg">
                <div class="block-top">
                    <b class="admin-p">{{auth('backend')->user()->name}}</b>
                    <p class="role-p">{{ $data }}</p>
                </div>
                <div class="block-bottom">
                    <div class="flex-row">
                        <p>当前登录ip:</p>
                        <p>{{$loginInfo->ip}}</p>
                    </div>
                    <div class="flex-row">
                        <p>登录位置:</p>
                        <p>{{$loginInfo->address}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-md6 version-block">
            <div class="layui-card block-bg ">
                <div class="card-title"><b>版本信息</b></div>
                <table class="layui-table table-min-height">
                    <colgroup>
                        <col width="40%" />
                        <col width="60%" />
                    </colgroup>
                    <tbody>
                        <tr>
                            <td>作者</td>
                            <td>Quan</td>
                        </tr>
                        <tr>
                            <td>当前版本</td>
                            <td>v1.0.0</td>
                        </tr>
                        <tr>
                            <td>基于框架</td>
                            <td>layuiv2.4.5 / laravelv.5.7</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="layui-col-md6 version-block">
            <div class="layui-card block-bg ">
                <div class="card-title"><b>打赏(疯狂暗示)</b></div>
                <img src="{{asset('image/pay.png')}}" style="width:200px;height:200px"  alt="">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    layui.use("table", function() {
        var table = layui.table;
    });
</script>
@endsection

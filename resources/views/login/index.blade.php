<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>登录</title>
		<link rel="stylesheet" href="{{URL::asset('layui/css/layui.css')}}">
		<link rel="stylesheet" href="{{URL::asset('css/login.css')}}">
		<script src="{{URL::asset('layui/layui.js')}}"></script>
		<script type="text/javascript" src="{{URL::asset('js/common.js')}}"></script>
	</head>
	<body>
		<div class="login" >
			<div class=" layui-main center-div">
			<div class="login-title">{{$webTitle}}</div>
			<div id="darkbannerwrap"></div>
				 <form class="layui-form" >
					 {{csrf_field()}}
					<input type="text" name="mobile" placeholder="用户名" lay-verify="required|phone" class="layui-input layui-form-danger login-input" >
					<input type="password" name="password" placeholder="密码"  lay-verify="required" class="layui-input layui-form-danger login-input">
					<button class="layui-btn layui-btn-fluid login-btn" lay-submit lay-filter="login" >登录</button>
				</form>
			</div>
			
		</div>
		
		<script type="text/javascript">
            layui.use(['jquery','form','request'], function(){
              var form = layui.form,
               $=layui.$,request=layui.request;
              //监听提交
              form.on('submit(login)', function(data){
								//  console.log(data.field);
								 request.zqajax({
									 type:'POST',
									 url: "{{route('backend.login')}}",
									 data: data.field,
									 success(res){
										  location.href = "{{route('backend.index')}}";
									 }
								 });

                return false;
              });
            });
      
		</script>
	</body>
</html>
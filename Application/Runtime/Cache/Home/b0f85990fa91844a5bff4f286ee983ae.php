<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>二手交易系统</title>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="/secondhand/Public/css/bootstrap.min.css">

	<!-- 可选的Bootstrap主题文件（一般不用引入） -->
	<!-- <link rel="stylesheet" href="css/bootstrap-theme.min.css"> -->

	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="/secondhand/Public/js/jquery.min.js"></script>

	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="/secondhand/Public/js/bootstrap.min.js"></script>
	<style>
		body { padding-top: 70px; }
		.my-text{
			white-space:nowrap;
			overflow:hidden;
			text-overflow:ellipsis;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo U('Index/index');?>">二手交易市场</a>
			</div>
		
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				
	<ul class="nav navbar-nav">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">商品 <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo U('Index/index');?>">全部类别</a></li>
				<li><a href="<?php echo U('Index/index?label=电器数码');?>">电器数码</a></li>
				<li><a href="<?php echo U('Index/index?label=运动健身');?>">运动健身</a></li>
				<li><a href="<?php echo U('Index/index?label=图书教材');?>">图书教材</a></li>
				<li><a href="<?php echo U('Index/index?label=生活娱乐');?>">生活娱乐</a></li>
				<li><a href="<?php echo U('Index/index?label=衣物伞帽');?>">衣物伞帽</a></li>
				<li><a href="<?php echo U('Index/index?label=其他类别');?>">其他类别</a></li>
			</ul>
		</li>
		<li><a href="<?php echo U('User/publish');?>">发布 <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></li>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">我的发布 <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo U('User/published');?>">全部状态</a></li>
				<li><a href="<?php echo U('User/published?status=0');?>">竞价中</a></li>
				<li><a href="<?php echo U('User/published?status=1');?>">已成交</a></li>
				<li><a href="<?php echo U('User/published?status=-1');?>">已下架</a></li>
			</ul>
		</li>
		<li><a href="<?php echo U('User/auctioned');?>">我的竞价</a></li>
	</ul>
	<form action="<?php echo U('Index/search');?>" class="navbar-form navbar-left" role="search">
		<div class="form-group">
			<input type="search" name="key" class="form-control" placeholder="搜索商品" required required>
		</div>
		<button type="submit" class="btn btn-default">搜索</button>
	</form>
	<ul class="nav navbar-nav navbar-right">
		<li class="notlogin"><a href="<?php echo U('Login/index');?>">登录</a></li>
		<li class="notlogin active"><a href="<?php echo U('Login/signup');?>">注册</a></li>
		<li class="dropdown login">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><?php echo session('uname');?> <b class="caret"></b></a>
			<ul class="dropdown-menu">							
				<li><a href="<?php echo U('User/setting');?>">账号设置</a></li>
				<li><a href="<?php echo U('User/logout');?>">退出</a></li>
			</ul>
		</li>
	</ul>

			</div><!-- /.navbar-collapse -->
		</div>
	</nav>
	<div class="container">
		
	<div class="row">
		<div class="panel panel-default">
			  <div class="panel-heading">
					<h3 class="panel-title">注册</h3>
			  </div>
			  <div class="panel-body">
					<form action="<?php echo U('Login/submitSignup');?>" enctype="multipart/form-data" method="POST" class="form-horizontal" role="form">
					  		<div class="form-group">
					  			<label for="uaccount" class="col-md-2 control-label">账号</label>
					  			<div class="col-md-8">
				  					<input type="email" name="uaccount" id="uaccount" class="form-control" required="required" placeholder="请输入邮箱">
					  			</div>
			  				</div>
			  				<div class="form-group">
					  			<label for="uname" class="col-md-2 control-label">用户名</label>
					  			<div class="col-md-8">
				  					<input type="text" name="uname" id="uname" class="form-control" required="required" placeholder="请输入用户名">
					  			</div>
			  				</div>
			  				<div class="form-group">
					  			<label for="password" class="col-md-2 control-label">密码</label>
					  			<div class="col-md-8">
				  					<input type="password" name="upwd" id="password" class="form-control" required="required" placeholder="请输入密码">
					  			</div>
			  				</div>
			  				<div class="form-group">
					  			<label for="password1" class="col-md-2 control-label">确认密码</label>
					  			<div class="col-md-8">
				  					<input type="password" id="password1" class="form-control" required="required" placeholder="请再次输入密码">
					  			</div>
			  				</div>
			  				<div class="form-group">
					  			<label for="upic" class="col-md-2 control-label">图片</label>
					  			<div class="col-md-8">
				  					<input type="file" name="upic" accept="image/*" id="upic" class="form-control" required="required">
					  			</div>
					  			<div class="col-md-1">
					  				<img id="uploadPreview" style="display:none" class="img-responsive" /> 
					  			</div>
					  		</div>
							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<button type="submit" class="btn btn-primary">注册</button>
									<a class="col-md-offset-6 btn btn-default" href="<?php echo U('Login/index');?>">已有账号？去登陆</a>
								</div>
							</div>
					</form>
			  </div>
		</div>
	</div>

	</div>

	<!-- Footer
	================================================== -->
	<footer class="footer navbar-fixed-bottom">
	    <div class="container">
	        <div>
	        	
	        </div>
	    </div>
	</footer>
	<script>
	    var islogin;
		$(document).ready(function() {
			islogin =<?php echo "'".session('uid')."'";?>;
			if(islogin=='')
				$(".login").css('display', 'none');
			else
				$(".notlogin").css('display', 'none');
		});
	</script>
	
<script>
	$("#password1").change(function(){
		if(($(this).val()!="") && ($(this).val()!=$("#password").val()) ){
			alert("两次输入的不一致");
		}
	});
	$("#uaccount").change(function() {
		/* Act on the event */
		$.post('<?php echo U("Login/checkAccount");?>', {"uaccount": $(this).val()}, 
			function(data, textStatus, xhr) {
			if(data.status==0){
				alert(data.mesg);
				$(this).focus();
			}
		});
	});
	$("#upic").change(function() {
		if(!window.FileReader) return;
		var oFReader = new FileReader();
		if (document.getElementById("upic").files.length === 0) { return; }
		var oFile = document.getElementById("upic").files[0];
		oFReader.readAsDataURL(oFile);
		oFReader.onload = function (oFREvent) {
		  $("#uploadPreview").css("display","block");
		  document.getElementById("uploadPreview").src = oFREvent.target.result;
		};
	});
</script>

</body>
</html>
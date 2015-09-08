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
	<form action="<?php echo U('Index/search');?>" class="navbar-form navbar-left" role="search" method="post">
		<div class="form-group">
			<input type="search" name="key" class="form-control" placeholder="搜索商品" value="<?php echo ($data["key"]); ?>" required>
		</div>
		<button type="submit" class="btn btn-default">搜索</button>
	</form>
	<ul class="nav navbar-nav navbar-right">
		<li class="notlogin"><a href="<?php echo U('Login/index');?>">登录</a></li>
		<li class="notlogin"><a href="<?php echo U('Login/signup');?>">注册</a></li>
		<li class="dropdown login">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><?php echo session('uname');?> <b class="caret"></b></a>
			<ul class="dropdown-menu">							
				<li><a href="<?php echo U('User/changePwd');?>">修改密码</a></li>
				<li><a href="<?php echo U('User/changeName');?>">修改昵称</a></li>
				<li><a href="<?php echo U('User/logout');?>">退出</a></li>
			</ul>
		</li>
	</ul>

			</div><!-- /.navbar-collapse -->
		</div>
	</nav>
	<div class="container">
		
	<div class="row">
		<?php if(empty($data)): ?><div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>orz木有数据orz</strong>
		</div><?php endif; ?>
	<?php if(is_array($data["data"])): $i = 0; $__LIST__ = $data["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" id="<?php echo ($vo["gid"]); ?>">
			<div class="thumbnail">
				<img data-src="#" alt="" src="<?php echo ($vo["thumb_url"]); ?>" class="img-responsive">
				<div class="caption my-text">
					<h4><span><?php echo ($vo["gname"]); ?></span></h4>
					<hr>
					<div class="row">
						<div class="col-md-12 col-xs-12">底价：<strong>￥<?php echo ($vo["base_price"]); ?></strong></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12 col-xs-12">最高竞价：<strong>￥<?php echo ($vo["top_auction"]); ?></strong></div>
					</div>
					<!-- <hr> -->
					<br>
					<div class="row">
						<div class="col-md-6 col-xs-6"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <span>评论数：<?php echo ($vo["comment_num"]); ?></span></div>
						<div class="col-md-6 col-xs-6"><span>竞价数：</span><span><?php echo ($vo["auction_num"]); ?></span></div>
					</div>	
					<!-- <hr> -->
					<br>
					<div class="row">
						<div class="col-md-12 col-xs-12">
							发布时间：<?php echo (substr($vo["update_time"],0,16)); ?>
						</div>
						<hr>
						<div class="col-md-12 col-xs-12">
							<a href="<?php echo U('Index/detail').'?gid='.$vo['gid'];?>" class="btn btn-primary btn-sm">查看详情</a>
						</div>
					</div>
				</div>
			</div>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
		<div class="row">
		<div class="col-md-7 col-md-offset-5 col-xs-12" id="page">
				<?php echo ($page); ?>
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
	
</body>
</html>
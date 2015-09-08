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
		<li class="notlogin"><a href="<?php echo U('Login/signup');?>">注册</a></li>
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
		<div class="col-md-3">
			<img src="<?php echo ($gpic); ?>" alt="" class="img-responsive img-rounded">
		</div>
		<div class="col-md-9">
			<div class="row">
			<div class="col-md-12">
				<h3><span><?php echo ($gname); ?></span>  <small><?php echo ($description); ?></small></h3>
			</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-4 col-xs-4">
					<span>标签: <span class="label label-default"><?php echo ($label); ?></span></span> 
				</div>	

				<div class="col-md-4 col-xs-4">
					<span>发布者: <span id="<?php echo ($user_id); ?>"><?php echo ($uname); ?></span></span> 
				</div>
				<div class="col-md-4 col-xs-4">
					<span>发布时间: <span><?php echo ($update_time); ?></span></span> 
				</div>		
			</div>
			<br>
			<div class="row">
				<div class="col-md-4 col-xs-4">底价：<span>￥<b id="base_price"><?php echo ($base_price); ?></b></span></div>
				<div class="col-md-4 col-xs-4">最高竞价：<span>￥<b id="top_auction"><?php echo ($top_auction); ?></b></span></div>
				<div class="col-md-4 col-xs-4">
					<span>状态：</span><strong><?php switch($status): case "0": ?>竞价中<?php break; case "1": ?>已成交<?php break; case "-1": ?>已下架<?php break; endswitch;?></strong>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-4 col-xs-4"><span>评论数：</span> <span><?php echo ($comment_num); ?></span></div>
				<div class="col-md-4 col-xs-4"><span>竞价数：</span><span><?php echo ($auction_num); ?></span></div>
				<div class="col-md-4 col-xs-offset-6 col-xs-6">
				    <?php if(($isMyGoods) != "1"): ?><button type="button" class="btn btn-primary btn-sm modal-btn" data-toggle="modal" data-target="#commentModal">发表评论</button>
						<button type="button" class="btn btn-primary btn-sm modal-btn" data-toggle="modal" data-target="#auctionModal">参与竞价</button><?php endif; ?>
				    <?php if(($isMyGoods == 1) AND ($status == 0) AND ($top_auction != '无')): ?><a type="button" class="btn btn-danger btn-sm" href="<?php echo U('User/makeDeal').'?gid='.$gid;?>">成交</a><?php endif; ?>
				</div>
			</div>	
		</div>
	</div>
	<hr>
	<div class="row">
		<div role="tabpanel">
		    <!-- Nav pills -->
		    <ul class="nav nav-tabs" role="tablist">
		        <li role="presentation" class="active col-md-offset-5">
		            <a href="#comment" aria-controls="comment" role="tab" data-toggle="tab">评论</a>
		        </li>
		        <li role="presentation">
		            <a href="#auction" aria-controls="auction" role="tab" data-toggle="tab">竞价</a>
		        </li>
		    </ul>
			<br>
		    <!-- Tab panes -->
		    <div class="tab-content">
		        <div role="tabpanel" class="tab-pane active" id="comment">
		        <?php if(is_array($comments)): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="row" id="<?php echo ($vo["cid"]); ?>">
		        		<div class="col-md-1 col-xs-2">
		        			<img src="<?php echo ($vo["upic"]); ?>" alt="头像" class="img-responsive img-rounded">
		        		</div>
			        	<div class="col-md-11 col-xs-10">
			        		<div class="row">
			        			<div class="col-md-4  col-xs-6">
			        				<h4><span><?php echo ($vo["uname"]); ?></span><?php if(empty($vo["replied_id"])): ?><small> 说：</small><?php endif; if(!empty($vo["replied_id"])): ?><small> 回复</small> <span><?php echo ($vo["replied_name"]); ?></span><?php endif; ?></h4>
			        			</div>
			        			<div class="col-md-offset-6 col-md-2  col-xs-6">
			        				<?php echo ($vo["time"]); ?>
			        			</div>
			        		</div>
			        		<div class="row">
			        			<div class="col-md-12"><?php echo ($vo["content"]); ?></div>
			        		</div>
			        		<div class="col-md-offset-11"><?php if(empty($vo["cantReply"])): ?><button type="button" class="btn btn-default btn-sm modal-btn" data-toggle="modal" data-target="#replyModal" onclick="initReplyModal('<?php echo ($vo["cid"]); ?>')">回复</button><?php endif; ?></div>
			        	</div>
			        </div>
			        <hr><?php endforeach; endif; else: echo "" ;endif; ?>        	
		        </div>
		        <div role="tabpanel" class="tab-pane" id="auction">
		        <?php if(is_array($auction)): $i = 0; $__LIST__ = $auction;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="row">
		        		<div class="col-md-1 col-xs-2">
		        			<img src="<?php echo ($vo["upic"]); ?>" alt="头像" class="img-responsive img-rounded">
		        		</div>
			        	<div class="col-md-11 col-xs-10">
			        		<div class="row">
			        			<div class="col-md-4 col-xs-6">
			        				<h4><span><?php echo ($vo["uname"]); ?></span> <small>出价：</small><strong>￥<?php echo ($vo["auction_price"]); ?></strong></h4>
			        			</div>
			        			<div class="col-md-offset-6 col-md-2 col-xs-6">
			        				<?php echo ($vo["time"]); ?>
			        			</div>
			        		</div>
			        		<div class="row">
			        			<div class="col-md-12">
			        				<?php echo ($vo["comment"]); ?>
			        			</div>
			        		</div>
			        	</div>
			        </div>
			        <hr><?php endforeach; endif; else: echo "" ;endif; ?>
		        </div>
		    </div>
		</div>
	</div>
</volist>
<!-- Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">发表评论</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo U('User/makeComment');?>" method="POST" class="form-horizontal" role="form">
        		<input type="hidden" name="goods_id" value="<?php echo ($gid); ?>">
        		<div class="form-group">
		  			<div class="col-md-offset-1 col-md-10">
	  					<textarea class="form-control" name="content" id="content"  cols="30" rows="5"></textarea>
		  			</div>
  				</div>
        		<div class="form-group">
        			<div class="col-sm-2 col-sm-offset-9">
        				<button type="submit" class="btn btn-primary">提交</button>
        			</div>
        		</div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="auctionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">竞价</h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo U('User/makeAuction');?>" method="POST" class="form-horizontal" role="form">
        		<input type="hidden" name="goods_id" value="<?php echo ($gid); ?>">
        		<input type="hidden" name="price1" value="<?php echo ($base_price); ?>">
        		<input type="hidden" name="price2" value="<?php echo ($top_auction); ?>">
        		<div class="form-group">
        			<label class="col-md-2 control-label" for="price1">底价</label>
		  			<div class="col-md-8">
	  					<input class="form-control"   id="price1" value="<?php echo ($base_price); ?>" disabled required>
		  			</div>
  				</div>
  				<div class="form-group">
        			<label class="col-md-2 control-label" for="price2">最高竞价</label>
		  			<div class="col-md-8">
	  					<input class="form-control"  id="price2" value="<?php echo ($top_auction); ?>" disabled required>
		  			</div>
  				</div>
        		<div class="form-group">
        			<label class="col-md-2 control-label" for="auction_price">竞价</label>
		  			<div class="col-md-8">
	  					<input class="form-control" name="auction_price" id="auction_price" placeholder="必须高于当前的最高竞价或底价" required>
		  			</div>
  				</div>
  				<div class="form-group">
  					<label class="col-md-2 control-label" for="comment">感言</label>
		  			<div class="col-md-8">
	  					<textarea class="form-control" name="comment" id="comment"  cols="30" rows="5" required></textarea>
		  			</div>
  				</div>
        		<div class="form-group">
        			<div class="col-sm-2 col-sm-offset-9">
        				<button  class="btn btn-primary">提交</button>
        			</div>
        		</div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">回复评论</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo U('User/makeComment');?>" method="POST" class="form-horizontal" role="form">
        		<input type="hidden" name="replied_id">
        		<input type="hidden" name="goods_id" value="<?php echo ($gid); ?>">
        		<div class="form-group">
		  			<div class="col-md-offset-1 col-md-10">
	  					<textarea class="form-control" name="content" id="content"  cols="30" rows="5"></textarea>
		  			</div>
  				</div>
        		<div class="form-group">
        			<div class="col-sm-2 col-sm-offset-9">
        				<button type="submit" class="btn btn-primary">提交</button>
        			</div>
        		</div>
        </form>
      </div>
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
	
	<script type="text/javascript">
		$("button.modal-btn").click(function(event) {
			if(islogin==''){
				window.location.href = "<?php echo U('Login/index');?>";
			}
		});
		function initReplyModal(cid){
			$("input[name='replied_id']").val(cid);
		}
		$("#auction_price").change(function(event) {
			/* Act on the event */
			if(isNaN($(this).val())){
				alert("输入的不是数字");
				$(this).focus();
				return false;
			}
			var top = parseInt($("#base_price").text());
			if($("#top_auction").text()==0 && $(this).val()<top){
				alert("竞价的金额不能小于底价");
				$(this).focus();
				return false;
			}
			var top = parseInt($("#top_auction").text());
			if($("#top_auction").text()!=0 && $(this).val()<=top){
				alert("竞价的金额必须大于目前的最高竞价");
				$(this).focus();
				return false;
			}
		});
		function check(){
			var top1 = parseInt($("#top_auction").text());
			var top2 = parseInt($("#base_price").text());
			if($("input[name='auction_price]").val()<top1 || $("input[name='auction_price]").val()<top1){
				alert("竞价的金额不能小于目前的最高竞价或低价");
				return false;
			}
		}
	</script>

</body>
</html>
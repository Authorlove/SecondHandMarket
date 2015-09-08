<?php
namespace Home\Controller;
use \Think\Model;
class UserController extends BaseController{
	//我的发布
	public function published(){
		if(I("status")!="")
			$data = M("Goods")->where(array("user_id"=>$this->uid,"status"=>I("status")))->order("update_time desc")->page(I('p',1).','.C("ONE_PAGE"))->select();
		else
			$data = M("Goods")->where(array("user_id"=>$this->uid))->order("update_time desc")->limit(12)->page(I('p',1).','.C("ONE_PAGE"))->select();			
		$count = M("Goods")->where(array("user_id"=>$this->uid,"status"=>I("status")))->count();			
        $Page = new \Think\Page($count,C("ONE_PAGE"));
        $show = $Page->show();
        $this->assign("page",$show);
		for ($i=0; $i < count($data) ; $i++) { 
			$data[$i]['comment_num'] = M("Comments")->where("goods_id=".$data[$i]["gid"])->count();
			$data[$i]['auction_num'] = M("Auction")->where("goods_id=".$data[$i]["gid"])->count();
			$data[$i]['top_auction'] = M("Auction")->where("goods_id=".$data[$i]["gid"])->order("aid desc")->find()['auction_price'];
			if(!$data[$i]['top_auction'])
				$data[$i]['top_auction']="无";
			$data[$i]['thumb_url'] = __ROOT__.C('PIC_PATH_PREFIX').C("UPLOAD_GOODS_PICS_CONFIG.subName").'/thumb_'.$data[$i]['gpic'];
		}
		$this->assign("data",$data);
		$this->show();
	}
	//发布
	public function publish(){
		$this->show();
	}
	//发布
	public function submitPublish(){
		$_POST['user_id'] = $this->uid;
		$upload = new \Think\Upload(C("UPLOAD_GOODS_PICS_CONFIG"));
		$info = $upload->uploadOne($_FILES['gpic']);
		if(!$info){
			$this->error($upload->getError());
		}else{
			$image = new \Think\Image();
			$image->open(C("UPLOAD_GOODS_PICS_CONFIG.rootPath").$info['savepath'].$info['savename']);
			$thumb_url = C("UPLOAD_GOODS_PICS_CONFIG.rootPath").$info['savepath'].'thumb_'.$info['savename'];
			$image->thumb(C("THUMB_PIC_WIDTH"),C("THUMB_PIC_HEIGHT"),\Think\Image::IMAGE_THUMB_CENTER)->save($thumb_url);
			$_POST['gpic'] = $info['savename'];
		}
		$Goods = M("Goods");
		if($Goods->create()){
			if($Goods->add()){
				$this->success("发布成功");
			}
		}
		$this->error("发布失败");
	}
	//退出
	public function logout(){
		session("uid",null);
		session("uname",null);
		$this->redirect("Login/index");
	}
	public function makeComment(){
		if(I("replied_id")){
			$replied_uid = M("Comments")->where("cid=".I("replied_id"))->find()['user_id'];
			if($this->uid==$replied_uid)
				$this->error("评论失败：自己不能回复自己");
		}
		$_POST['user_id']=$this->uid;
		$comments = M("Comments");
		if($comments->create()){
			$id = $comments->add(); 
			if($id){
				$this->success("评论成功");
			}
		}
	}
	public function makeAuction(){
		$top1 = I("price1");
		$top2 = I("price2");
		if(I("auction_price")<$top1 || I("auction_price")<$top2 ){
			$this->error("竞价太低，失败");
		}
		$user_id = M("Goods")->where("gid=".I("goods_id"))->find()['user_id'];
		if($this->uid==$user_id){
			$this->error("竞价失败：不能给自己的物品竞价");
		}
		$_POST['user_id']=$this->uid;
		$auction = M("Auction");
		if($auction->create()){
			if($auction->add()){
				$this->success("竞价成功");
			}
		}
		$this->error("竞价失败");
	}
	public function makeDeal(){
		$accept_id = M("Auction")->where(array("gid"=>I("gid")))->order("aid desc")->find()['aid'];
		if(M("Goods")->where(array("gid"=>I("gid"),"user_id"=>$this->uid))->save(array("accept_id"=>$accept_id,
			"status"=>1))){
			$this->success("成交成功");
			// $data['status'] = 1;
			// $this->ajaxReturn($data);
		}
		$this->error("成交失败");
		// $data['status'] = 0;
	 //    $this->ajaxReturn($data);
	}
	public function delete(){
		if(M("Goods")->where(array("gid"=>I("gid"),"user_id"=>$this->uid))->save(array("status"=>-1))){
			$this->success("下架成功");
		}
		$this->error("下架失败");
	}
	//竞价记录
	public function auctioned(){
		$model = new Model();
		$uid = $this->uid;
		$data = M("Auction")->join("goods on gid=goods_id")->field('max(auction_price) as auction_price,accept_id,goods.user_id,
			gid,gname,description,base_price,label,gpic,update_time,status')->where("auction.user_id=$uid")->group("goods_id")->page(I('p',1).','.C("ONE_PAGE"))->select();
        $temp = M("Auction")->join("goods on gid=goods_id")->where("auction.user_id=$uid")->group("goods_id")->select();
        $count = count($temp);
        $Page = new \Think\Page($count,C("ONE_PAGE"));
        $show = $Page->show();
        $this->assign("page",$show);
		for ($i=0; $i < count($data) ; $i++) {
			$user_id = $data[$i]['user_id'];
			$User = M("User")->where("uid=".$user_id)->find();
			$data[$i]['uname'] = $User["uname"];
			if($data[$i]['accept_id']){
				$data[$i]['top_auction'] = M("Auction")->where("aid=".$data[$i]["accept_id"])->find()['auction_price'];
				$accept_id = $data[$i]["accept_id"];
				
				$flag = M("Auction")->where(array("user_id"=>$this->uid,"aid"=>$accept_id))->find(); 
				// dump($flag);
				if($flag){
					$data[$i]['attact'] = $User["uaccount"];
				}
			}
			$data[$i]['comment_num'] = M("Comments")->where("goods_id=".$data[$i]["gid"])->count();
			$data[$i]['auction_num'] = M("Auction")->where("goods_id=".$data[$i]["gid"])->count();
			$data[$i]['top_auction'] = M("Auction")->where("goods_id=".$data[$i]["gid"])->order("aid desc")->find()['auction_price'];
			if(!$data[$i]['top_auction'])
				$data[$i]['top_auction']="无";
			$data[$i]['gpic'] = __ROOT__.C('PIC_PATH_PREFIX').C("UPLOAD_GOODS_PICS_CONFIG.subName").'/'.$data[$i]['gpic'];
		}
		$this->assign("data",$data);
		$this->show();
	}
	public function setting(){
		$data = M("User")->where("uid=".$this->uid)->find();
		$data['upic'] =  __ROOT__.C('PIC_PATH_PREFIX').C("UPLOAD_USER_PICS_CONFIG.subName").'/'.$data['upic'];
		$this->assign($data);
		$this->show();
	}
	public function submitSetting(){
		if(I("password")){
			$pwd1 = md5(I('password')); 
			$oldpwd = M("User")->where("uid=".$this->uid)->find()['upwd'];
			if($pwd1!=$oldpwd){
				$this->error("原密码输入错误");
			}
			else{
				$_POST['upwd']=I('upwd','',md5);
			}
		}
		M("User")->create();
		if(M("User")->save()){
			if(I('uname')){
				session('uname',I('uname'));
			}
			$this->success("修改成功");
		}
		$this->error("修改失败");
	}
	public function updatePic(){
		$oldPath = M("User")->where("uid=".$this->uid)->find()['upic'];
		$upload = new \Think\Upload(C("UPLOAD_USER_PICS_CONFIG"));
		$info = $upload->uploadOne($_FILES['upic']);
		if(!$info){
			$this->error($upload->getError());
		}else{
			$image = new \Think\Image();
			$image->open(C("UPLOAD_USER_PICS_CONFIG.rootPath").$info['savepath'].$info['savename']);
			$thumb_url = C("UPLOAD_USER_PICS_CONFIG.rootPath").$info['savepath'].'thumb_'.$info['savename'];
			$image->thumb(C("THUMB_USER_PIC_WIDTH"),C("THUMB_USER_PIC_HEIGHT"))->save($thumb_url);
			$_POST['upic'] = $info['savename'];
		}
		M("User")->create();
		if(M("User")->save()){
			unlink(C("UPLOAD_USER_PICS_CONFIG.rootPath").$info['savepath'].$oldPath);
			unlink(C("UPLOAD_USER_PICS_CONFIG.rootPath").$info['savepath'].'thumb_'.$oldPath);
			$this->success("修改成功");
		}
		$this->error("修改失败");
	}
}
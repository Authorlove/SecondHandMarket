<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller{
	public function index(){
		$this->show();
	}
	public function login(){
		$User = M("User");
		$user = $User -> where(array("uaccount"=>I("uaccount")))->find();
		if(!$user || $user["upwd"] != I('upwd','',md5)) {
		    $this->error("账号或密码错误！");
		}
		else {
		    session("uid",$user["uid"]);
		    session('uname',$user['uname']);
		    $this->redirect("Index/index");
		}	
	}

	public function signup(){
		$this->display("signup");
	}

	public function checkAccount(){
		$User = M("User");
		$user = $User -> where(array("uaccount"=>I("uaccount")))->find();
		if($user){
			$data['status']=0;
			$data['mesg']="该账号已存在";
			$this->ajaxReturn($data);
		}
		else{
			$data['status']=1;
			$this->ajaxReturn($data);	
		} 
	}

	public function submitSignup(){
		$upload = new \Think\Upload(C("UPLOAD_USER_PICS_CONFIG"));
		$info = $upload->uploadOne($_FILES['upic']);
		if(!$info){
			$this->error($upload->getError());
		}else{
			dump($info);
			$image = new \Think\Image();
			$image->open(C("UPLOAD_USER_PICS_CONFIG.rootPath").$info['savepath'].$info['savename']);
			$thumb_url = C("UPLOAD_USER_PICS_CONFIG.rootPath").$info['savepath'].'thumb_'.$info['savename'];
			$image->thumb(C("THUMB_USER_PIC_WIDTH"),C("THUMB_USER_PIC_HEIGHT"))->save($thumb_url);
			$_POST['upic'] = $info['savename'];
		}
		$_POST['upwd']=I("upwd","",md5);
		if(M("User")->create()){
			$uid = M("User")->add();
			if($uid){
				session("uid",$uid);
				session('uname',I('uname'));
				$this->redirect("Index/index");
			}
		}
		$this->error("注册失败");
	}
}
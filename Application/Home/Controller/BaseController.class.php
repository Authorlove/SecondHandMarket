<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller{
	protected $uid;
	public function _initialize(){
		if(!session("uid")){
			$this->redirect("Login/index");
		}
		$this->uid = session("uid");
	}
}
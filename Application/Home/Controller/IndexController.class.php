<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class IndexController extends Controller {
    public function index(){
    	if(I("label")){
            $data = M("Goods")->where(array("label"=>I("label"),"status"=>0))->order("gid desc")->page(I('p',1).','.C("ONE_PAGE"))->select();
            $count = M("Goods")->where(array("label"=>I("label"),"status"=>0))->count();
        }
        else{
            $data = M("Goods")->where("status=0")->order("gid desc")->page(I('p',1).','.C("ONE_PAGE"))->select();
            $count = M("Goods")->where("status=0")->count();            
        }
        $Page = new \Think\Page($count,C("ONE_PAGE"));
        $show = $Page->show();
        $this->assign("page",$show);
		for ($i=0; $i < count($data) ; $i++) { 
			$data[$i]['comment_num'] = M("Comments")->where("goods_id=".$data[$i]["gid"])->count();
			$data[$i]['auction_num'] = M("Auction")->where("goods_id=".$data[$i]["gid"])->count();
			$data[$i]['top_auction'] = M("Auction")->where("goods_id=".$data[$i]["gid"])->order("aid desc")->find()['auction_price'];
			if(!$data[$i]['top_auction'])
				$data[$i]['top_auction']=0;
			$data[$i]['thumb_url'] = __ROOT__.C('PIC_PATH_PREFIX').C("UPLOAD_GOODS_PICS_CONFIG.subName").'/thumb_'.$data[$i]['gpic'];
		}
		$this->assign("data",$data);
    	$this->show();
    }

    public function detail(){
    	$data = M("Goods")->where(array("gid"=>I("gid")))->find();
        $data['uname'] = M("User")->where("uid=".$data['user_id'])->find()['uname'];
        if($data['user_id']==session("uid"))
            $data['isMyGoods']=1;
        else
            $data['isMyGoods']=0;
    	$data['comment_num'] = M("Comments")->where("goods_id=".$data["gid"])->count();
    	$data['auction_num'] = M("Auction")->where("goods_id=".$data["gid"])->count();
    	$data['top_auction'] = M("Auction")->where("goods_id=".$data["gid"])->order("aid desc")->find()['auction_price'];
    	if(!$data['top_auction'])
    		$data['top_auction']=0;
        else{
            $model = new Model();
            $gid = I('gid');
            $data["auction"] = $model->query("select aid,uname,upic,auction_price,comment,time from auction,user
                where auction.goods_id = $gid
                and user.uid=auction.user_id order by aid desc");
            for ($i=0; $i < count($data["auction"]); $i++) { 
                # code...
                $data["auction"][$i]['upic'] = __ROOT__.C('PIC_PATH_PREFIX').C("UPLOAD_USER_PICS_CONFIG.subName").'/thumb_'.$data["auction"][$i]['upic'];
            }
        }
        $model = new Model();
        $comments = M("Comments")->join("user on user.uid=comments.user_id")->field("upic,uname,replied_id,cid,time,content,user_id")->where("goods_id=".I("gid"))->order("cid asc")->select();
        for ($i=0; $i < count($comments) ; $i++) { 
            $comments[$i]['upic'] = __ROOT__.C('PIC_PATH_PREFIX').C("UPLOAD_USER_PICS_CONFIG.subName").'/thumb_'.$comments[$i]['upic'];
            if($comments[$i]['replied_id']){
                $replied_id = $comments[$i]['replied_id'];
                $comments[$i]['replied_name'] = $model->query("select uname from comments,user 
                    where comments.cid= $replied_id
                    and comments.user_id=user.uid")[0]['uname'];
            }
            if($comments[$i]['user_id']==session("uid")){
                $comments[$i]['cantReply'] = 1;
            }
        }
        $data['comments'] = $comments; 
    	$data['gpic'] = __ROOT__.C('PIC_PATH_PREFIX').C("UPLOAD_GOODS_PICS_CONFIG.subName").'/'.$data['gpic'];
    	// dump($data);
     //    die();
        $this->assign($data);
		$this->show();
	}
    //根据商品名称搜索
    public function search(){
        $map['gname']=array("like",'%'.I("key").'%');
        $data = M("Goods")->where($map)->order("gid desc")->page(I('p',1).','.C("ONE_PAGE"))->select();
        $count = M("Goods")->where($map)->count();            
        $Page = new \Think\Page($count,C("ONE_PAGE"));
        $show = $Page->show();
        $this->assign("page",$show);
        for ($i=0; $i < count($data) ; $i++) { 
            $data[$i]['comment_num'] = M("Comments")->where("goods_id=".$data[$i]["gid"])->count();
            $data[$i]['auction_num'] = M("Auction")->where("goods_id=".$data[$i]["gid"])->count();
            $data[$i]['top_auction'] = M("Auction")->where("goods_id=".$data[$i]["gid"])->order("aid desc")->find()['auction_price'];
            $data[$i]['thumb_url'] = __ROOT__.C('PIC_PATH_PREFIX').C("UPLOAD_GOODS_PICS_CONFIG.subName").'/thumb_'.$data[$i]['gpic'];
        }
        $list['data']=$data;
        $list['key']=I("key");
        $this->assign("data",$list);
        $this->show();
    }
    public function sort(){
        $key = I("key");
        $type = I("sort");
        $data = M("Goods")->where("status=0")->select();         
        for ($i=0; $i < count($data) ; $i++) { 
            $data[$i]['comment_num'] = M("Comments")->where("goods_id=".$data[$i]["gid"])->count();
            $data[$i]['auction_num'] = M("Auction")->where("goods_id=".$data[$i]["gid"])->count();
            $data[$i]['top_auction'] = M("Auction")->where("goods_id=".$data[$i]["gid"])->order("aid desc")->find()['auction_price'];
            if(!$data[$i]['top_auction'])
                $data[$i]['top_auction']=0;
            $data[$i]['thumb_url'] = __ROOT__.C('PIC_PATH_PREFIX').C("UPLOAD_GOODS_PICS_CONFIG.subName").'/thumb_'.$data[$i]['gpic'];
        }
        foreach ($data as $key1 => $value) {
            $sort[$key1] = $value[$key];
        }
        if($type=="SORT_ASC")
            $type = SORT_ASC;
        else
            $type = SORT_DESC;
        array_multisort($sort,$type,$data);
        $this->ajaxReturn($data);
    }
}
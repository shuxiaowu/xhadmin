<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\common\service\CommonService;
use app\common\service\LinkService;

class Link extends Admin {


	/*友情链接*/
	function index(){
		if (!$this->request->isAjax()){
			return $this->fetch('index');
		}else{
			$limit  = input('post.limit', 0, 'intval');
			$offset = input('post.offset', 0, 'intval');
			$page   = floor($offset / $limit) +1 ;

			$where = [];
			$where['a.title'] = input('param.title', '', 'strip_tags');
			$where['a.catagory_id'] = input('param.catagory_id', '', 'strip_tags');
			$where['a.type'] = input('param.type', '', 'strip_tags');
			$where['a.status'] = input('param.status', '', 'strip_tags');

			$startTime = input('param.startTime', '', 'strip_tags');
			$endTime = input('param.endTime', '', 'strip_tags');

			$where['a.create_time'] = CommonService::getTimeWhere($startTime,$endTime);

			$orderby = 'a.sortid desc,a.link_id desc';

			$limit = ($page-1) * $limit.','.$limit;
			try{
				$field='a.*';
				//后面3个字段分别是关联表名 关联表的字段 当前表的字段
				$res = LinkService::loadRelateList($where,$field="a.*,b.title as catagory_name",$limit,$orderby);
			}catch(\Exception $e){
				exit($e->getMessage());
			}
			$list = $res['list'];
			$data['rows']  = $list;
			$data['total'] = $res['count'];

			exit(json_encode($data));

		}

	}

	/*创建数据*/
	function add(){
		if (!$this->request->isPost()){
			return $this->fetch('info');
		}else{
			$data = input('post.');
			try {
				$res = LinkService::saveData('add',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'添加成功'));
		}
	}

	/*编辑数据*/
	function update(){
		if (!$this->request->isPost()){

			$link_id = input('param.link_id','','intval');
			empty($link_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));

			$info = model('Link')->getInfo($link_id);
			!$info && exit(json_encode(array('status'=>'01','msg'=>'没有数据')));
			$this->assign('info',$info);
			return $this->fetch('info');
		}else{
			$data = input('post.');
			try {
				$res = LinkService::saveData('edit',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}

	/*删除数据*/
	function delete(){
		$idx =  $this->request->post('link_ids', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		try{
			$where = [];
			$where['link_id'] = array('in',$idx);
			$res = LinkService::delete($where);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}
	
	//设置排序
	function updateSort(){
		$data['link_id'] = input('param.link_id','','intval');
		$data['sortid'] = input('param.sortid','','intval');
		
		empty($data['link_id']) || empty($data['sortid']) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
		try{
			$res = model('Link')->edit($data);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
		
	}

}
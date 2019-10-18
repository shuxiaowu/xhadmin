<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\common\service\CommonService;
use app\common\service\GroupService;

class Group extends Admin {


	/*分组管理*/
	function index(){
		if (!$this->request->isAjax()){
			return $this->fetch('index');
		}else{
			$limit  = input('post.limit', 0, 'intval');
			$offset = input('post.offset', 0, 'intval');
			$page   = floor($offset / $limit) +1 ;

			$where = [];
			$where['status'] = input('param.status', '', 'strip_tags');

			$orderby = $this->request->post('orderby', '', 'strip_tags');

			$limit = ($page-1) * $limit.','.$limit;
			try{
				$res = GroupService::loadList($where,$field,$limit,$orderby);
			}catch(\Exception $e){
				exit($e->getMessage());
			}
			$list = $res['list'];
			$data['rows']  = $list;
			$data['total'] = $res['count'];

			exit(json_encode($data));

		}

	}

	/*添加分组*/
	function add(){
		if (!$this->request->isPost()){
			return $this->fetch('info');
		}else{
			$data = input('post.');
			try {
				$res = GroupService::saveData('add',$data,87);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'添加成功'));
		}
	}

	/*修改分组*/
	function update(){
		if (!$this->request->isPost()){

			$group_id = input('param.group_id','','intval');
			empty($group_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));

			$info = model('Group')->getInfo($group_id);
			!$info && exit(json_encode(array('status'=>'01','msg'=>'没有数据')));
			$this->assign('info',$info);
			return $this->fetch('info');
		}else{
			$data = input('post.');
			try {
				$res = GroupService::saveData('edit',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}

	/*禁用*/
	function forbidden(){
		$idx =  $this->request->post('group_ids', '', 'strval');
		$statusData =  $this->request->post('statusData', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		empty($statusData) && exit(json_encode(array('status'=>'02','msg'=>'状态信息不能为空')));

		try{
			$where = [];
			$where['group_id'] = array('in',$idx);
			$dt = explode('|',$statusData);
			if(empty($dt[0]) && $dt[0] !== '0' || empty($dt[1]) && $dt[1] !== '0'){
				exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
			}
			$data[$dt[0]] = $dt[1];
			$res = GroupService::editWhere($where,$data);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}

	/*启用*/
	function start(){
		$idx =  $this->request->post('group_ids', '', 'strval');
		$statusData =  $this->request->post('statusData', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		empty($statusData) && exit(json_encode(array('status'=>'02','msg'=>'状态信息不能为空')));

		try{
			$where = [];
			$where['group_id'] = array('in',$idx);
			$dt = explode('|',$statusData);
			if(empty($dt[0]) && $dt[0] !== '0' || empty($dt[1]) && $dt[1] !== '0'){
				exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
			}
			$data[$dt[0]] = $dt[1];
			$res = GroupService::editWhere($where,$data);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}

	/*删除数据*/
	function delete(){
		$idx =  $this->request->post('group_ids', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		try{
			$where = [];
			$idx = explode(',',$idx);
			if($idx){
				foreach($idx as $id){
					$where['group_id'] = $id;
					$res = GroupService::delete($where);				
					\app\common\service\UserService::delete($where);
					db("access")->where($where)->delete();	
				}
			}
			
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}

}
<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\common\service\CommonService;
use app\common\service\UserService;

class User extends Admin {


	/*用户管理*/
	function index(){
		if (!$this->request->isAjax()){
			return $this->fetch('index');
		}else{
			$limit  = input('post.limit', 0, 'intval');
			$offset = input('post.offset', 0, 'intval');
			$page   = floor($offset / $limit) +1 ;

			$where = [];
			$where['a.name'] = input('param.name', '', 'strip_tags');
			$where['a.user'] = input('param.user', '', 'strip_tags');
			$where['a.group_id'] = input('param.group_id', '', 'strip_tags');

			$orderby = 'user_id desc';

			$limit = ($page-1) * $limit.','.$limit;
			try{
				$res = UserService::loadRelateList($where,$field="a.*,b.name as group_name",$limit,$orderby);
			}catch(\Exception $e){
				exit($e->getMessage());
			}
			$list = $res['list'];
			$data['rows']  = $list;
			$data['total'] = $res['count'];

			exit(json_encode($data));

		}

	}

	/*添加账户*/
	function add(){
		if (!$this->request->isPost()){
			return $this->fetch('add');
		}else{
			$data = input('post.');
			try {
				$res = UserService::saveData('add',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'添加成功'));
		}
	}

	/*修改账户*/
	function update(){
		if (!$this->request->isPost()){

			$user_id = input('param.user_id','','intval');
			empty($user_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));

			$info = model('User')->getInfo($user_id);
			!$info && exit(json_encode(array('status'=>'01','msg'=>'没有数据')));
			$this->assign('info',$info);
			return $this->fetch('update');
		}else{
			$data = input('post.');
			try {
				$res = UserService::saveData('edit',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}

	/*修改密码*/
	function updatePassword(){
		if (!$this->request->isPost()){

			$info['user_id'] = input('param.user_id','','intval');
			$this->assign('info',$info);
			return $this->fetch('updatePassword');
		}else{
			$data = input('post.');
			try {
				$res = UserService::saveData('edit',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}
	
	/*禁用*/
	function forbidden(){
		$idx =  $this->request->post('user_ids', '', 'strval');
		$statusData =  $this->request->post('statusData', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		empty($statusData) && exit(json_encode(array('status'=>'02','msg'=>'状态信息不能为空')));

		try{
			$where = [];
			$where['user_id'] = array('in',$idx);
			$dt = explode('|',$statusData);
			if(empty($dt[0]) && $dt[0] !== '0' || empty($dt[1]) && $dt[1] !== '0'){
				exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
			}
			$data[$dt[0]] = $dt[1];
			$res = UserService::editWhere($where,$data);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}

	/*启用*/
	function start(){
		$idx =  $this->request->post('user_ids', '', 'strval');
		$statusData =  $this->request->post('statusData', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		empty($statusData) && exit(json_encode(array('status'=>'02','msg'=>'状态信息不能为空')));

		try{
			$where = [];
			$where['user_id'] = array('in',$idx);
			$dt = explode('|',$statusData);
			if(empty($dt[0]) && $dt[0] !== '0' || empty($dt[1]) && $dt[1] !== '0'){
				exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
			}
			$data[$dt[0]] = $dt[1];
			$res = UserService::editWhere($where,$data);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}
	
	/*删除数据*/
	function delete(){
		$idx =  $this->request->post('user_ids', '', 'strval');
		empty($idx) && $this->error('主键不能为空');
		try{
			$where = [];
			$idx = explode(',',$idx);
			if($idx){
				foreach($idx as $id){
					if($id <> 1){
						$where['user_id'] = $id;
						$res = UserService::delete($where);
					}
				}
			}		
			if($idx[0] == 1){
				exit(json_encode(array('status'=>'01','msg'=>'超级管理员不允许删除')));
			}
			
		}catch(\Exception $e){
			exit($this->error($e->getMessage()));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}

}
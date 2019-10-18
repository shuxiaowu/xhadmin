<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\common\service\CommonService;
use app\common\service\MemberService;

class Member extends Admin {

	/*会员管理*/
	function index(){
		if (!$this->request->isAjax()){
			return $this->fetch('index');
		}else{
			$limit  = input('post.limit', 0, 'intval');
			$offset = input('post.offset', 0, 'intval');
			$page   = floor($offset / $limit) +1 ;

			$where = [];
			$where['username'] =  ['like','%'.input('param.username', '', 'strip_tags').'%'];
			$where['sex'] = input('param.sex', '', 'strip_tags');
			$where['mobil'] = input('param.mobil', '', 'strip_tags');
			$where['email'] = input('param.email', '', 'strip_tags');
			$where['status'] = input('param.status', '', 'strip_tags');
			$where['relname'] = input('param.relname', '', 'strip_tags');

			$startTime = input('param.startTime', '', 'strip_tags');
			$endTime = input('param.endTime', '', 'strip_tags');

			$where['create_time'] = CommonService::getTimeWhere($startTime,$endTime);
			$where['province'] = input('param.province', '', 'strip_tags');;
			$where['city'] = input('param.city', '', 'strip_tags');;
			$where['district'] = input('param.district', '', 'strip_tags');;
			$where['color'] = input('param.color', '', 'strip_tags');
			$where['longitude'] = input('param.longitude', '', 'strip_tags');

			$orderby = $this->request->post('orderby', '', 'strip_tags');

			$limit = ($page-1) * $limit.','.$limit;
			try{
				$field='*';
				$res = MemberService::loadList($where,$field,$limit,$orderby);
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
			return $this->fetch('add');
		}else{
			$data = input('post.');
			try {
				$res = MemberService::saveData('add',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'添加成功'));
		}
	}

	/*编辑数据*/
	function update(){
		if (!$this->request->isPost()){

			$m_id = input('param.m_id','','intval');
			empty($m_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));

			$info = model('Member')->getInfo($m_id);
			!$info && exit(json_encode(array('status'=>'01','msg'=>'没有数据')));
			$this->assign('info',$info);
			return $this->fetch('update');
		}else{
			$data = input('post.');
			try {
				$res = MemberService::saveData('edit',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}

	/*数值加*/
	function recharge(){
		if (!$this->request->isPost()){
			$info['m_id'] = input('param.m_id','','intval');
			$this->assign('info',$info);
			return $this->fetch('recharge');
		}else{
			$idx =  $this->request->post('m_id', '', 'strval');
			$incData =  $this->request->post('amount', '', 'intval');

			empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
			empty($incData) && exit(json_encode(array('status'=>'01','msg'=>'操作数据不能为空')));
			try{
				$where = [];
				$where['m_id'] = array('in',$idx);
				$res = MemberService::setInc($where,'amount',$incData);
			}catch(\Exception $e){
				exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
			}
			echo json_encode(array('status'=>'00','msg'=>'操作成功'));
		}
	}

	/*数值减*/
	function backRecharge(){
		if (!$this->request->isPost()){
			$info['m_id'] = input('param.m_id','','intval');
			$this->assign('info',$info);
			return $this->fetch('backRecharge');
		}else{
			$idx =  $this->request->post('m_id', '', 'strval');
			$incData =  $this->request->post('amount', '', 'intval');

			empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
			empty($incData) && exit(json_encode(array('status'=>'01','msg'=>'操作数据不能为空')));
			try{
				$where = [];
				$where['m_id'] = array('in',$idx);
				$res = MemberService::setDec($where,'amount',$incData);
			}catch(\Exception $e){
				exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
			}
			echo json_encode(array('status'=>'00','msg'=>'操作成功'));
		}
	}

	/*删除数据*/
	function delete(){
		$idx =  $this->request->post('m_ids', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		try{
			$where = [];
			$where['m_id'] = array('in',$idx);
			$res = MemberService::delete($where);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}

	/*编辑数据*/
	function forbidden(){
		$idx =  $this->request->post('m_ids', '', 'strval');
		$statusData =  $this->request->post('statusData', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		empty($statusData) && exit(json_encode(array('status'=>'02','msg'=>'状态信息不能为空')));

		try{
			$where = [];
			$where['m_id'] = array('in',$idx);
			$dt = explode('|',$statusData);
			if(empty($dt[0]) && $dt[0] !== '0' || empty($dt[1]) && $dt[1] !== '0'){
				exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
			}
			$data[$dt[0]] = $dt[1];
			$res = MemberService::editWhere($where,$data);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}

	/*修改状态*/
	function start(){
		$idx =  $this->request->post('m_ids', '', 'strval');
		$statusData =  $this->request->post('statusData', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		empty($statusData) && exit(json_encode(array('status'=>'02','msg'=>'状态信息不能为空')));

		try{
			$where = [];
			$where['m_id'] = array('in',$idx);
			$dt = explode('|',$statusData);
			if(empty($dt[0]) && $dt[0] !== '0' || empty($dt[1]) && $dt[1] !== '0'){
				exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
			}
			$data[$dt[0]] = $dt[1];
			$res = MemberService::editWhere($where,$data);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}

	
	/*修改密码*/
	function updatePassword(){
		if (!$this->request->isPost()){

			$info['m_id'] = input('param.m_id','','intval');
			$this->assign('info',$info);
			return $this->fetch('updatePassword');
		}else{
			$data = input('post.');
			try {
				$res = MemberService::saveData('edit',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}

	/*批量编辑数据*/
	function batchUpdate(){
		if (!$this->request->isPost()){

			$m_id = input('param.m_id','','strval');
			empty($m_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));

			$info['m_id'] = $m_id;
			$this->assign('info',$info);
			return $this->fetch('batchUpdate');
		}else{
			$data = input('post.');
			try {
				foreach( $data as $k=>$v){
					if( !$v )
						unset( $data[$k] );
				}
				$pk_idx = explode(',',$data['m_id']);
				foreach($pk_idx as $key=>$val){
					$data['m_id'] = $val;
					$res = MemberService::saveData('edit',$data);
				}
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}

	/*查看数据*/
	function viewMember(){
		$m_id = input('param.m_id','','intval');
		empty($m_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));

		$info = model('Member')->getInfo($m_id);
		!$info && exit(json_encode(array('status'=>'01','msg'=>'没有数据')));
		$this->assign('info',$info);
		return $this->fetch('viewMember');
	}
}
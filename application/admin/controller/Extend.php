<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\admin\service\ExtendService;
use app\admin\service\FieldSetService;

class Extend extends Admin {


	/*栏目拓展模型*/
	function index(){
		if (!$this->request->isAjax()){
			return $this->fetch('index');
		}else{
			$limit  = input('post.limit', 0, 'intval');
			$offset = input('post.offset', 0, 'intval');
			$page   = floor($offset / $limit) +1 ;

			$where = [];
			$where['title'] = input('param.title', '', 'strip_tags');
			$where['table_name'] = input('param.table_name', '', 'strip_tags');
			$where['type'] = input('param.type', '', 'strip_tags');
			$where['status'] = input('param.status', '', 'strip_tags');

			$orderby = 'sortid desc,extend_id desc';

			$limit = ($page-1) * $limit.','.$limit;
			try{
				$field='*';
				$res = ExtendService::loadList($where,$field,$limit,$orderby);
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
				$res = ExtendService::saveData('add',$data,378,'','id');
				if($res){
					FieldSetService::createTable($data);
				}
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'添加成功'));
		}
	}

	/*编辑数据*/
	function update(){
		if (!$this->request->isPost()){

			$extend_id = input('param.extend_id','','intval');
			empty($extend_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));

			$info = model('Extend')->getInfo($extend_id);
			!$info && exit(json_encode(array('status'=>'01','msg'=>'没有数据')));
			$this->assign('info',$info);
			return $this->fetch('info');
		}else{
			$data = input('post.');
			try {
				$info = model('Extend')->getInfo($data['extend_id']);
				$res = ExtendService::saveData('edit',$data);
				if($info['table_name'] <> $data['table_name']){	
					FieldSetService::updateTable($info,$data);
				}
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}
	
	//设置排序
	function updateSort(){
		$data['extend_id'] = input('param.extend_id','','intval');
		$data['sortid'] = input('param.sortid','','intval');
		
		empty($data['extend_id']) || empty($data['sortid']) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
		try{
			$res = model('Extend')->edit($data);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
		
	}
	
	//排序上下移动操作
	function setSort(){
		$extend_id  = input('post.extend_id', 0, 'intval');
		$type  = input('post.type', 0, 'intval');
		empty($extend_id) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		empty($type) && exit(json_encode(array('status'=>'01','msg'=>'排序类型不能为空')));
		
		try{
			ExtendService::setSort($extend_id,$type);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));	
	}


	/*删除数据*/
	function delete(){
		$idx =  $this->request->post('ids', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		try{
			$where = [];
			$where['id'] = array('in',$idx);
			$res = ExtendService::delete($where);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}

}
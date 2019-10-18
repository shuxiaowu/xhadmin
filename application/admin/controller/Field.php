<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\admin\service\CommonService;
use app\admin\service\FieldService;
use app\admin\service\FieldSetService;

class Field extends Admin {


	/*数据列表*/
	function index(){
		if (!$this->request->isAjax()){
			$extend_id = input('param.extend_id');
			$this->assign('extend_id',$extend_id);
			return $this->fetch('index');
		}else{
			$limit  = input('post.limit', 0, 'intval');
			$offset = input('post.offset', 0, 'intval');
			$page   = floor($offset / $limit) +1 ;
			
			$extend_id = input('param.extend_id','','intval');
			empty($extend_id) && exit(json_encode(array('status'=>'01','msg'=>'菜单编号不能为空')));
			$where = [];
			$where['extend_id'] = $extend_id;

			$limit = ($page-1) * $limit.','.$limit;
			try{
				$field='*';
				$res = FieldService::loadList($where,$field,$limit);
			}catch(\Exception $e){
				exit($e->getMessage());
			}
			$list = $res['list'];
			
			foreach($list as $key=>$val){
				$typeField = FieldSetService::typeField();
				$fieldInfo = $typeField[$val['type']];
				$list[$key]['type'] = $fieldInfo['name'];
			}
			
			$data['rows']  = $list;
			$data['total'] = $res['count'];

			exit(json_encode($data));
		}
		
		
	}
	
	/*添加字段*/
	function add(){	
		if (!$this->request->isPost()){
			$extend_id = input('param.extend_id','','intval');
			empty($extend_id) && $this->error('菜单编号不能为空');
			$info['extend_id'] = $extend_id;
			$this->assign('info',$info);
			$this->assign('fieldList',FieldSetService::typeField());
			return $this->fetch('info');
		}else{
			$data = input('post.');		
			try {
				$res = FieldService::add($data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
            echo json_encode(array('error'=>'00','message'=>'添加成功'));
		}
		
	}

	/*修改字段*/
	function update(){
		if (!$this->request->isPost()){
			$id = input('param.id','','intval');
			$info = model("field")->getInfo($id);
			$this->assign('info',$info);
			$this->assign('fieldList',FieldSetService::typeField());
			return $this->fetch('info');
		}else{
			$data = input('post.');	
			
			try {
				$res = FieldService::edit($data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
            echo json_encode(array('error'=>'00','message'=>'修改成功'));
		}
	}

	/*删除*/
	function delete(){
		$idx =  $this->request->post('id', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		try{
			$where = [];
			$where['id'] = array('in',$idx);
			$res = FieldService::delete($where);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}
	
	
	//设置排序
	function updateSort(){
		$data['id'] = input('param.id','','intval');
		$data['sortid'] = input('param.sortid','','intval');
		
		empty($data['id']) || empty($data['sortid']) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
		try{
			$res = model('Field')->edit($data);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
		
	}
	
	
	//排序上下移动操作
	function setSort(){
		$id  = input('post.id', 0, 'intval');
		$type  = input('post.type', 0, 'intval');
		empty($id) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		empty($type) && exit(json_encode(array('status'=>'01','msg'=>'排序类型不能为空')));
		
		try{
			FieldService::setSort($id,$type);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));	
	}

	

}
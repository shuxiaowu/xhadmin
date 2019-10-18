<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\common\service\CommonService;
use app\admin\service\NodeService;

class Node extends Admin {


	/*节点管理*/
	function index(){
		if (!$this->request->isAjax()){
			return $this->fetch('index');
		}else{
			$limit  = input('post.limit', 0, 'intval');
			$offset = input('post.offset', 0, 'intval');
			$page   = floor($offset / $limit) +1 ;
			
			$where = [];
			$limit = ($page-1) * $limit.','.$limit;
			$orderby = 'sortid asc,id asc';
			
			$res = NodeService::loadList($where,$field,$limit,$orderby);
			$list = formartList(['id', 'pid', 'title','cname'],$res['list']);
			
			$data['rows']  = $list;
			$data['total'] = $res['count'];
			exit(json_encode($data));
		}

	}

	/*创建数据*/
	function add(){
		if (!$this->request->isPost()){
			$id = input('param.id','','intval');
			$info = model('Node')->getInfo($id);
			$data['pid'] = $info['id'];
			$this->assign('info',$data);
			return $this->fetch('info');
		}else{
			$data = input('post.');
			try {
				$res = NodeService::saveData('add',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'添加成功'));
		}
	}

	/*编辑数据*/
	function update(){
		if (!$this->request->isPost()){

			$id = input('param.id','','intval');
			empty($id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));

			$info = model('Node')->getInfo($id);
			!$info && exit(json_encode(array('status'=>'01','msg'=>'没有数据')));
			$this->assign('info',$info);
			return $this->fetch('info');
		}else{
			$data = input('post.');
			try {
				$res = NodeService::saveData('edit',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}
	
	
	/*删除数据*/
	function delete(){
		$idx =  $this->request->post('ids', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		try{
			$idx = explode(',',$idx);
			if($idx){
				foreach($idx as $id){
					$where['id'] = $id;
					$info = model('Node')->getWhereInfo(['pid'=>$id],'id desc');
					if(!$info){
						$res = NodeService::delete($where);
					}else{
						exit(json_encode(array('status'=>'02','msg'=>'有子栏目无法删除，请先删除子栏目')));
					}	
				}
			}
			
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
			$res = model('node')->edit($data);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
		
	}

}
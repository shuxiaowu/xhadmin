<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\common\service\CommonService;
use app\common\service\CatagoryService;

class Catagory extends Admin {


	/*分类管理*/
	function index(){
		if (!$this->request->isAjax()){
			return $this->fetch('index');
		}else{
			$list = model('Catagory')->loadRelateList($where = [],'a.*,b.title as extend_name','sortid asc');
			$list = formartList(['class_id', 'pid', 'class_name','class_name'],$list);
			$data['rows']  = $list;
			$data['total'] = model('Catagory')->countList($where = []);
			exit(json_encode($data));
		}

	}

	/*创建数据*/
	function add(){
		if (!$this->request->isPost()){
			$class_id = input('param.class_id','','intval');
			$info = model('Catagory')->getInfo($class_id);
			
			$data['type'] = $info['type'];
			$data['list_tpl'] = $info['list_tpl'];
			$data['detail_tpl'] = $info['detail_tpl'];
			$data['pid'] = $info['class_id'];
			$data['module_id'] = $info['module_id'];
			$data['filepath'] = $info['filepath'];
			
			$this->assign('tpList',CatagoryService::tplList(config('default_themes')));
			$this->assign('info',$data);
			return $this->fetch('info');
		}else{
			$data = input('post.');
			try {
				$res = CatagoryService::saveData('add',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'添加成功'));
		}
	}

	/*编辑数据*/
	function update(){
		if (!$this->request->isPost()){

			$class_id = input('param.class_id','','intval');
			empty($class_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));

			$info = model('Catagory')->getInfo($class_id);
			!$info && exit(json_encode(array('status'=>'01','msg'=>'没有数据')));
			$this->assign('tpList',CatagoryService::tplList(config('default_themes')));
			$this->assign('info',$info);
			return $this->fetch('info');
		}else{
			$data = input('post.');
			try {
				$res = CatagoryService::saveData('edit',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}
	
	//设置排序
	function updateSort(){
		$data['class_id'] = input('param.class_id','','intval');
		$data['sortid'] = input('param.sortid','','intval');
		
		empty($data['class_id']) || empty($data['sortid']) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
		try{
			$res = CatagoryService::saveData('edit',$data);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
		
	}
	
	//排序上下移动操作
	function setSort(){
		$class_id  = input('post.class_id', 0, 'intval');
		$type  = input('post.type', 0, 'intval');
		empty($class_id) && exit(json_encode(array('status'=>'01','msg'=>'ID不能为空')));
		empty($type) && exit(json_encode(array('status'=>'01','msg'=>'排序类型不能为空')));
		
		try{
			CatagoryService::setSort($class_id,$type);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
		
	}

	/*删除数据*/
	function delete(){
		$idx =  $this->request->post('class_ids', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		try{
			$where = [];
			
			$idx = explode(',',$idx);
			if($idx){
				foreach($idx as $id){
					$where['class_id'] = $id;
					$info = model('Catagory')->getWhereInfo(['pid'=>$id],'class_id desc');
					if(!$info){
						$res = CatagoryService::delete($where);
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

}
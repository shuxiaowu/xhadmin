<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\common\service\CommonService;
use app\common\service\ContentService;

class Content extends Admin {

	
	
	/*文章管理*/
	function index(){
		if (!$this->request->isAjax()){
			$list = json_encode(ContentService::getSubClass('0'));
			$list = str_replace('class_name','name',$list);
			$list = str_replace('class_id','id',$list);
			$this->assign('catagoryInfo',$list);
			return $this->fetch('index');
			
		}else{
			$limit  = input('post.limit', 0, 'intval');
			$offset = input('post.offset', 0, 'intval');
			$page   = floor($offset / $limit) +1 ;
				
			$class_idx = model('index/Catagory')->getSubClassId(input('param.class_id', '', 'strip_tags'));
			
			$where = [];
			$where['a.title'] = input('param.title', '', 'strip_tags');
			$where['a.class_id'] =['in',$class_idx];
			$where['a.status'] = input('param.status', '', 'strip_tags');
			$where['a.create_time'] = input('param.create_time', '', 'strip_tags');		

			$orderby = 'a.sortid desc,a.content_id desc';

			$limit = ($page-1) * $limit.','.$limit;
			try{
				$res = ContentService::loadRelateList($where,$field="a.*,b.class_name as class_name",$limit,$orderby);
			}catch(\Exception $e){
				exit($e->getMessage());
			}
			$list = $res['list'];
			
			foreach($list as $key=>$val){
				if(!empty($val['pic'])){
					$list[$key]['title'] = $val['title'].'&nbsp;<img onmousemove=\'showBigPic("'.$val['pic'].'")\' onmouseout=\'closeimg()\' src="/static/img/pic.gif">&nbsp;';
				}			
				if(!empty($val['position'])){
					$list[$key]['title'] .= '&nbsp;'.ContentService::getPositionName($val['position'],$val['content_id']);
				}
			}
			
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
				$res = ContentService::saveData('add',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'添加成功'));
		}
	}

	/*编辑数据*/
	function update(){
		if (!$this->request->isPost()){

			$content_id = input('param.content_id','','intval');
			empty($content_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));

			$info = model('Content')->getInfo($content_id);
			!$info && exit(json_encode(array('status'=>'01','msg'=>'没有数据')));
			$this->assign('info',$info);
			return $this->fetch('info');
		}else{
			$data = input('post.');
			try {
				$res = ContentService::saveData('edit',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}
	
	//设置排序
	function updateSort(){
		$data['content_id'] = input('param.content_id','','intval');
		$data['sortid'] = input('param.sortid','','intval');
		
		empty($data['content_id']) || empty($data['sortid']) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
		try{
			$res = ContentService::edit($data);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
		
	}
	
	
	//文章移动到其他栏目
	public function move(){
		$content_ids = input('param.content_ids','','strval');
		$class_id = input('param.class_id','','intval');
		empty($content_ids) || empty($class_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
		
		try {
			$where['content_id'] = ['in',$content_ids];
			$data['class_id'] = $class_id;
			$res = ContentService::editWhere($where,$data);
		} catch (\Exception $e) {
			$this->error($e->getMessage());
		}
		echo json_encode(array('status'=>'00','message'=>'修改成功'));
	}
	
	
	//设置推荐位
	public function setPosition(){
		$content_ids = input('param.content_ids','','strval');
		$position_id = input('param.position_id','','intval');
		empty($content_ids) || empty($position_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
		
		try {
			$where = [];
			$idx = explode(',',$content_ids);
			if($idx){
				foreach ($idx as $id) {
					$res = ContentService::setPosition($id,$position_id);
				}
			}
			
		} catch (\Exception $e) {
			$this->error($e->getMessage());
		}
		echo json_encode(array('status'=>'00','message'=>'操作成功'));
	}
	
	//删除推荐位
	public function delPosition(){
		$content_id = input('param.content_id','','intval');
		$position_id = input('param.position_id','','intval');
		empty($content_id) || empty($position_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
		
		try {
			$res = ContentService::delPosition($content_id,$position_id);
			
		} catch (\Exception $e) {
			$this->error($e->getMessage());
		}
		echo json_encode(array('status'=>'00','message'=>'操作成功'));
	}
	
	//文章发布 草稿
	public function setStatus(){
		$content_ids = input('param.content_ids','','strval');
		$value = input('param.value','','intval');
		empty($content_ids) || empty($value) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
		
		try {
			$where['content_id'] = ['in',$content_ids];
			$data['status'] = $value == 1 ? 10 : 0;
			$res = ContentService::editWhere($where,$data);
		} catch (\Exception $e) {
			$this->error($e->getMessage());
		}
		echo json_encode(array('status'=>'00','message'=>'修改成功'));
	}

	/*
	删除数据
	此处必须一条条的删除 因为可能拓展表里面也有信息 必须一起删除
	*/
	function delete(){
		$idx =  $this->request->post('content_ids', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		try{
			$where = [];
			$idx = explode(',',$idx);
			if($idx){
				foreach ($idx as $id) {
					$where['content_id'] = $id;
					$res = ContentService::delete($where);
				}
			}
				
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}
	
	/*获取拓展字段信息*/
	function getExtends(){
		$class_id = input('param.class_id','','intval');
		$content_id = input('param.content_id','','intval');
		$classInfo = model('Catagory')->getInfo($class_id);
		if(!$classInfo['module_id']){
			return;
		}
		
		//获取拓展表的内容信息
		if($content_id){
			$extInfo = model('Extend')->getInfo($classInfo['module_id']);
			model('FormData')->setTable('ext_'.$extInfo['table_name']);
			model('FormData')->setPk('content_id');
			$extContentInfo = model('FormData')->getInfo($content_id);
		}
		
		$htmlstr = '';
		$fieldList = model('Field')->loadAll(['extend_id'=>$classInfo['module_id'],'status'=>1]);
		foreach($fieldList as $key=>$val){
			if($val['type'] == 17){
				$areaVal = explode('|',$val['field']);
				$val['province'] = $extContentInfo[$areaVal[0]];
				$val['city'] = $extContentInfo[$areaVal[1]];
				$val['district'] = $extContentInfo[$areaVal[2]];
			}else{
				$val['value'] = $extContentInfo[$val['field']];
			}

			if($content_id){
				$val['content_id'] = $content_id;
			}	
			$htmlstr .= \app\admin\service\FieldSetService::getFieldData($val);
		}
		
		
			
		echo json_encode(['fieldList'=>$fieldList,'data'=>$htmlstr]);
	}

}
<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\common\service\CommonService;
use app\common\service\HookService;
use think\Cache;

class Hook extends Admin {

	
	
	public function __construct(){
		parent::__construct();
		Cache::rm('hooks');
	}
	
	/*钩子管理*/
	function index(){
		if (!$this->request->isAjax()){
			return $this->fetch('index');
		}else{
			$limit  = input('post.limit', 0, 'intval');
			$offset = input('post.offset', 0, 'intval');
			$page   = floor($offset / $limit) +1 ;

			$where = [];
			$where['hook_name'] = input('param.hook_name', '', 'strip_tags');
			$where['status'] = input('param.status', '', 'strip_tags');

			$orderby = $this->request->post('orderby', '', 'strip_tags');

			$limit = ($page-1) * $limit.','.$limit;
			try{
				$field='*';
				$res = HookService::loadList($where,$field,$limit,$orderby);
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
				$res = HookService::saveData('add',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'添加成功'));
		}
	}

	/*编辑数据*/
	function update(){
		if (!$this->request->isPost()){

			$hook_id = input('param.hook_id','','intval');
			empty($hook_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));

			$info = model('Hook')->getInfo($hook_id);
			!$info && exit(json_encode(array('status'=>'01','msg'=>'没有数据')));
			$this->assign('info',$info);
			return $this->fetch('update');
		}else{
			$data = input('post.');
			try {
				$res = HookService::saveData('edit',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}

	/*删除数据*/
	function delete(){
		$idx =  $this->request->post('hook_ids', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		try{
			$where = [];
			$where['hook_id'] = array('in',$idx);
			$res = HookService::delete($where);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}

}
<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\common\service\CommonService;
use app\common\service\PluginsService;
use think\Cache;

class Plugins extends Admin {

	
	public function __construct(){
		parent::__construct();
		Cache::rm('hooks');
	}
	
	/*插件管理*/
	function index(){
		if (!$this->request->isAjax()){
			return $this->fetch('index');
		}else{
			$limit  = input('post.limit', 0, 'intval');
			$offset = input('post.offset', 0, 'intval');
			$page   = floor($offset / $limit) +1 ;

			$where = [];
			$where['plugins_name'] = input('param.plugins_name', '', 'strip_tags');
			$where['plugins_dir'] = input('param.plugins_dir', '', 'strip_tags');
			$where['description'] =  ['like','%'.input('param.description', '', 'strip_tags').'%'];
			$where['author'] = input('param.author', '', 'strip_tags');
			$where['status'] = input('param.status', '', 'strip_tags');
			$where['type'] = input('param.type', '', 'strip_tags');

			$orderby = $this->request->post('orderby', '', 'strip_tags');

			$limit = ($page-1) * $limit.','.$limit;
			try{
				$field='*';
				$res = PluginsService::loadList($where,$field,$limit,$orderby);
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
				$res = PluginsService::saveData('add',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'添加成功'));
		}
	}

	/*编辑数据*/
	function update(){
		if (!$this->request->isPost()){

			$plugins_id = input('param.plugins_id','','intval');
			empty($plugins_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));

			$info = model('Plugins')->getInfo($plugins_id);
			!$info && exit(json_encode(array('status'=>'01','msg'=>'没有数据')));
			$this->assign('info',$info);
			return $this->fetch('update');
		}else{
			$data = input('post.');
			try {
				$res = PluginsService::saveData('edit',$data);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}

}
<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\common\service\CommonService;
use app\common\service\LogService;

class Log extends Admin {


	/*登录日志管理*/
	function index(){
		if (!$this->request->isAjax()){
			return $this->fetch('index');
		}else{
			$limit  = input('post.limit', 0, 'intval');
			$offset = input('post.offset', 0, 'intval');
			$page   = floor($offset / $limit) +1 ;

			$where = [];
			$where['a.username'] = input('param.username', '', 'strip_tags');

			$orderby = $this->request->post('orderby', '', 'strip_tags');

			$limit = ($page-1) * $limit.','.$limit;
			try{
				$sql = 'select a.*,b.name as group_name,c.user as username,c. name as nickname from cd_log as a inner join cd_group as b inner join cd_user as c on a.user_id = c.user_id and c.group_id= b.group_id';
				$res = LogService::query($sql,$where,$limit,$orderby);
			}catch(\Exception $e){
				exit($e->getMessage());
			}
			$list = $res['list'];
			$data['rows']  = $list;
			$data['total'] = $res['count'];

			exit(json_encode($data));

		}

	}


	/*删除*/
	function delete(){
		$idx =  $this->request->post('log_ids', '', 'strval');
		empty($idx) && exit(json_encode(array('status'=>'01','msg'=>'主键ID不能为空')));
		try{
			$where = [];
			$where['log_id'] = array('in',$idx);
			$res = LogService::delete($where);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}

}
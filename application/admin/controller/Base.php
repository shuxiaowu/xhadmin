<?php

namespace app\admin\controller;

use app\admin\controller\Admin;

class Base extends Admin
{
   
   
    public function password(){
	   if (!$this->request->isPost()){
			
			return $this->fetch('password');
		}else{			
			$password = $this->request->post('password', '', 'strval');
			try {
				\app\admin\service\BaseService::updatePassword($password);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
            echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
    }
   
   /**
     * 授权管理
     * @return array|string
     */
    public function auth()
    {		
		if (!$this->request->isPost()){
			$id = $this->request->get('group_id', '', 'strval');
			$info = model("Group")->getInfo($id);		
			
			$list = $this->getSubClass(0);		
			$myAccess = db('access')->where('group_id',$id)->select();
			foreach($myAccess as $val){
				$array[] = $val['purviewval'];
			}
			$this->assign('myAccess',$array);
			$this->assign('list',$list);
			$this->assign('id',$id);
			return $this->fetch('auth');
		}else{			
			$access = $this->request->post('purviewval', '', 'strval');
			$access = explode(',',$access);
			$id = $this->request->post('id', '', 'strval');				
			\app\admin\service\BaseService::delete($id);
			foreach($access as $val){
				$data = ['purviewval'=>$val,'group_id'=>$id];				
				\app\admin\service\BaseService::add($data);								
			}
            $this->success('设置成功');			
		}
		
    }
	
	//生成树级结构列表 递归的方法
	public function getSubClass($pid){
		$where = [];
		$where['pid'] = $pid;
		$where['status'] = 10;
		$where['id'] = ['neq',258];
		$list = db("Node")->where($where)->order('sortid asc,id asc')->select();
		foreach($list as $key=>$val){
			$map['pid'] = $val['pid'];
			$map['status'] = 10;
			$sublist = db("Node")->where(['pid'=>$val['id']])->order('sortid asc,id asc')->select();
			if($sublist){
				$list[$key]['subdata'] = $this->getSubClass($val['id']);
			}
		}
		
		return $list;
	}
	
	/*清空缓存*/
	public function delCache(){
		
		if(\app\common\service\CommonService::deldir('../runtime')){
			$this->success('删除成功',url('admin/Index/main'));
		}else{
			$this->success('操作失败',url('admin/Index/main'));
		}
		
	}
	
	/**
     * 字体图标选择器
     * @return \think\response\View
     */
    public function icon()
    {
        $field =input('param.field','','strval');
        return view('', ['field' => $field]);
    }
	
	
	

	
	

}

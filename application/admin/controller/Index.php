<?php

namespace app\admin\controller;     
use app\admin\controller\Admin;

class Index extends Admin
{

	
	public function index()
    {	
		$menulist = db("node")->where(['status'=>10,'pid'=>0,'is_menu'=>1])->order('sortid asc')->select();
		$menu = [];
		foreach($menulist as $key=>$val){
			$menu[$key]['title'] = $val['title'];
			if(empty($val['icon'])){
				$menu[$key]['icon'] = 'fa fa-clone';
			}else{
				$menu[$key]['icon'] = $val['icon'];
			}	
			$menu[$key]['url'] = $val['val'];
			if($val['id'] == 258){
				$menu[$key]['sub'] = $this->getFormList();
			}else{
				$menu[$key]['sub'] = $this->getSublist($val['id']);
			}
		}
		
        return view('', ['title' => '系统管理', 'menus' => $menu]);
    }
	
	public function getSublist($menu_id){
		$menulist = db("node")->where(['status'=>10,'pid'=>$menu_id,'is_menu'=>1])->order('sortid asc')->select();
		$menu = [];
		foreach($menulist as $key=>$val){
			$menu[$key]['title'] = $val['title'];
			if(empty($val['icon'])){
				$menu[$key]['icon'] = 'fa fa-clone';
			}else{
				$menu[$key]['icon'] = $val['icon'];
			}
			$menu[$key]['url'] = $val['val'];
		}
		
		return $menu;
	}
	
	
	public function getFormList(){
		$where = ['status'=>10,'type'=>2];
		$menulist = db("extend")->where($where)->order('sortid desc,extend_id desc')->select();
		$menu = [];
		foreach($menulist as $key=>$val){
			$menu[$key]['title'] = $val['title'];
			$menu[$key]['icon'] = 'fa fa-clone';
			$menu[$key]['url'] = url('admin/FormData/index',['extend_id'=>$val['extend_id']]);	
		}
		
		return $menu;
	}

    /**
     * @return View
     */
    public function main()
    {  
        return view();
    }

   

}

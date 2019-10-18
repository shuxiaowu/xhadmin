<?php

namespace app\index\controller;
use app\index\controller\Base;
use app\common\service\BaseService;
use think\Controller;


class About extends Base
{
	
	//列表页面
	public function index(){
		$class_id = input('param.class_id','','intval');
		$p = input('param.p',1,'intval');
		!$class_id && $this->error('栏目ID不能为空');
		$info = model("common/Catagory")->getInfo($class_id);
		!$info && $this->error('栏目信息不存在');
		
		$topCategoryInfo = model("index/Catagory")->getTopBigInfo($class_id); //最上级栏目信息
		
		$empty="<li><a href='".url('/About/'.$class_id)."'>".$topCategoryInfo['class_name']."</a></li>";
		$this->assign('media',BaseService::getMedia($info['class_name'])); //网站关键词描述信息
		$this->assign('info',$info);  //当前栏目信息
		$this->assign('class_name',$info['class_name']);  //当前栏目名称
		$this->assign('classid',$info['class_id']);	//当前栏目ID
		$this->assign('pname',$topCategoryInfo['class_name']);  //最上级栏目名称
		$this->assign('pid',$topCategoryInfo['class_id']);	//最上级栏目ID
		$this->assign('position', model("catagory")->getPosition($class_id)); //面包屑信息
		$this->assign('empty',$empty);	//最上级栏目ID
		$this->assign('p',$p);
		
		
		//频道页的时候读取第一条内容作为频道页信息
		if($info['type'] == 1){
			$content = model("common/Content")->getWhereInfo(['class_id'=>$info['class_id']]);
			$this->assign('info',$content);
		}
		$default_themes = config('default_themes') ? config('default_themes') : 'index';
		return $this->fetch($default_themes.'/'.$info['list_tpl']);
	}
	
}

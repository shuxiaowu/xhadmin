<?php

namespace app\index\controller;
use app\index\controller\Base;
use app\common\service\BaseService;
use think\Controller;


class View extends Base
{
	
	//列表页面
	public function index(){
		$content_id = input('param.content_id','','intval');
		empty($content_id) && $this->error('内容ID不能为空');
		
		$contentInfo = model("common/Content")->getInfo($content_id);
		empty($contentInfo['class_id']) && $this->error('栏目ID不能为空');
		
		$classInfo = model("common/Catagory")->getInfo($contentInfo['class_id']);
		!$classInfo && $this->error('栏目信息不存在');
		
		//获取拓展模块的内容信息
        if($classInfo['module_id']){
            $extInfo = \app\common\service\ContentService::getExtDataInfo($classInfo['module_id'],$content_id);
            $contentInfo = array_merge($contentInfo , $extInfo);
        }
		
		$topCategoryInfo = model("index/Catagory")->getTopBigInfo($classInfo['class_id']); //最上级栏目信息
		
		$empty="<li><a href='".url('/About/'.$contentInfo['class_id'])."'>".$topCategoryInfo['class_name']."</a></li>";
		
		$this->assign('media',BaseService::getMedia($contentInfo['title'])); //关键词描述等信息
		$this->assign('classInfo',$classInfo);  //当前栏目信息
		$this->assign('class_name',$classInfo['class_name']);  //当前栏目名称
		$this->assign('classid',$classInfo['class_id']);	//当前栏目ID
		$this->assign('pname',$topCategoryInfo['class_name']);  //最上级栏目名称
		$this->assign('pid',$topCategoryInfo['class_id']);	//最上级栏目ID
		$this->assign('position', model("catagory")->getPosition($classInfo['class_id'])); //面包屑信息
		$this->assign('info',$contentInfo);
		$this->assign('shownext', BaseService::shownext($content_id,$contentInfo['class_id']));
		$this->assign('empty',$empty);
		$default_themes = config('default_themes') ? config('default_themes') : 'index';
		return $this->fetch($default_themes.'/'.$classInfo['detail_tpl']);
	}
	
	
	//点击量增加
	public function hits()
	{
	   $con['content_id'] = input('param.content_id','','intval');
	   $data = db("content") -> field('views')->where($con)->find();
	   db("content") -> where($con) ->setInc('views',1);
	   echo "document.write('".$data['views']."');";
	   
	}
	
}

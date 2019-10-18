<?php

namespace app\index\controller;
use think\Controller;
use app\index\controller\Base;
use app\common\service\BaseService;


class Index extends Base
{
	
	//首页
	public function index(){
    	$this->assign('media', baseService::getMedia());  //网站关键词描述信息
		$this->assign('pid',0);
		$default_themes = config('default_themes') ? config('default_themes') : 'index';
		return $this->fetch($default_themes.'/index');
	}
	
	
	
}

<?php

namespace app\common\controller;
use think\Controller;


class Base extends Controller
{
	
	public function _initialize(){
		
		$info = model("admin/Config")->getInfo();
		config($info);
	}
	
	/*
	 * 页面Meda信息组合
     * @return array 页面信息
     */
    protected function getMedia($title='',$keywords='',$description='')
    {
        if(empty($title)){
            $title=config('site_title');
        }else{
            $title=$title.' - '.config('site_title');
        }
        if(empty($keywords)){
            $keywords=config('keyword');
        }
        if(empty($description)){
            $description=config('description');
        }
        return array(
            'title'=>$title,
            'keyword'=>$keywords,
            'description'=>$description,
        );
    }
	
	/*
	 * 上一页下一页链接信息
     * @return array 链接信息
     */
	protected function showNext($id,$classid)
	{
	   $arr = [];
	   $map['content_id']  = array('lt',$id);
	   $map['class_id'] = $classid;
	   $pre = db("content") -> field('content_id,title,jumpurl') ->where($map) -> order('create_time desc') ->find();
	   if($pre)
	   {
		  $url = !empty($pre['url']) ? $pre['url'] : url('index/View/index',['content_id'=>$pre['content_id']]);
	      $str_a = '<a href="'.$url.'">'.$pre['title'].'</a>';
	   }else{
	      $str_a = '没有了';
	   }
	   
	   $con['content_id']  = array('gt',$id);
	   $con['class_id'] = $classid;
	   $next = db("content") -> field('content_id,title,jumpurl') ->where($con) -> order('create_time asc') ->find();
	   if($next)
	   {
		  $url = !empty($next['url']) ? $next['url'] : url('index/View/index',['content_id'=>$next['content_id']]);
	      $str_b = '<a href="'.$url.'">'.$next['title'].'</a>';
	   }else{
	      $str_b = '没有了';
	   }
	   
	  array_push($arr,$str_a,$str_b);
	  return $arr;
	}
	
	protected function siteDispaly($tpl){
		return $this->fetch(config('default_themes').'/'.$tpl);
	}
	

}

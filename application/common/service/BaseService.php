<?php

namespace app\common\service;

class BaseService
{
	
	/*
	 * 页面Meda信息组合
     * @return array 页面信息
     */
    public static function getMedia($title='',$keywords='',$description='')
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
	public static function showNext($id,$classid)
	{
	   $arr = [];
	   $map['content_id']  = array('lt',$id);
	   $map['class_id'] = $classid;
	   $pre = db("content") -> field('content_id,title,jumpurl') ->where($map) -> order('sortid desc,content_id desc') ->find();
	   if($pre)
	   {
		  $url = getListUrl($pre);
	      $str_a = '<a href="'.$url.'">'.$pre['title'].'</a>';
	   }else{
	      $str_a = '没有了';
	   }
	   
	   $con['content_id']  = array('gt',$id);
	   $con['class_id'] = $classid;
	   $next = db("content") -> field('content_id,title,jumpurl') ->where($con) -> order('sortid desc, content_id desc') ->find();
	   if($next)
	   {
		  $url = getListUrl($next);
	      $str_b = '<a href="'.$url.'">'.$next['title'].'</a>';
	   }else{
	      $str_b = '没有了';
	   }
	   
	  array_push($arr,$str_a,$str_b);
	  return $arr;
	}
	
	
	
	

	
	
}

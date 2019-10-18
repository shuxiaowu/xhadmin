<?php

namespace app\index\model;
use think\Model;


class Catagory extends Model
{
	
	
	//原始的分类数据
	private $rawList=array();
	//格式化后的分类
	private $formatList=array();
	
	
	
	/**
     * 获取列表
     * @return array 列表
     */
    public function loadList($where = [], $classId=0){
        $data =	db("catagory")->field("class_id,class_name,pid,jumpurl,filepath,filename")->select();
        $cat = $this->formartList(['class_id', 'pid', 'title','cname'],$data,$classId);
        //获取内容模型
        return $cat;
    }
	
	/**
     * 获取菜单面包屑
     * @param int $classId 菜单ID
     * @return array 菜单表列表
     */
	public function loadCrumb($classId){
		$data =	db("catagory")->field("class_id,class_name,pid,jumpurl,filepath,filename")->select();
		return $this->getPath($data,$classId);
	}
	
	
	//获取当前分类的路径
	public function getPath($data,$id){
		$this->rawList=$data;
		while(1){
			$id=$this->getPid($id);
			if($id==0){
				break;
			}
		}
		return array_reverse($this->formatList);
	}
	
	//通过当前id获取pid
	public function getPid($id)
	{
		foreach($this->rawList as $key=>$value){
		
			if($this->rawList[$key]['class_id']==$id)
			{
				$this->formatList[]=$this->rawList[$key];
				return $this->rawList[$key]['pid'];
			}
		}
		return 0;
	}
	
	//返回面包屑信息
	public function getPosition($classId)
	{
		$crumb = $this->loadCrumb($classId);
	    $pos = '当前位置：<a href="'.url('@index').'">首页</a>';
		
		foreach($crumb as $val)
		{
			$url = getClassUrl($val);
		    $pos .= '&nbsp;&gt;&gt;&nbsp;<a href="'.$url.'">'.$val['class_name'].'</a>';
		} 
		return $pos;
	}
	
	
	public function getTopBigInfo($classId){
		$crumb = $this->loadCrumb($classId);
		return model('common/Catagory')->getInfo($crumb[0]['class_id']);
	}
	
	/**
     * 获取子栏目ID
     * @param array $classId 当前栏目ID
     * @return string 子栏目ID
     */
    public function getSubClassId($classId)
    {
        $data = $this->loadList([],$classId);
        if(empty($data)){
            return $classId;
        }
        $list=[];
        foreach ($data as $value) {
           $list[]=$value['class_id'];
        }
        return $classId.','.implode(',', $list);
        
    }
	
	/*格式化列表*/
	public function formartList($fieldConfig,$list,$classId)
	{
		$cat = new \app\common\org\Category($fieldConfig);
		$ret=$cat->getTree($list,$classId);
		return $ret;
	}

}

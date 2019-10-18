<?php

namespace app\admin\service;
use app\admin\service\FieldSetService;

class FieldService
{
	
	//加载默认数据
    public static function loadList($where,$field,$limit){
	
		try{
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
		
			$list = model('Field')->loadList($where,$field,$limit);
			$count = model('Field')->countList($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$list,'count'=>$count];	
	}
	
	//批量删除
	public static function delete($where){
	
		try{	
			$reset = model('Field')->delete($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//添加
	public static function add($data){
	
		try{
			$data['config'] = str_replace('，',',',$data['config']);
			$reset = model('Field')->createData($data);
			if($reset){
				model('Field')->edit(['id'=>$reset,'sortid'=>$reset]);
				FieldSetService::createField($data);
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//修改
	public static function edit($data){
	
		try{
			$data['config'] = str_replace('，',',',$data['config']);
			$info = model("Field")->getInfo($data['id']);
			if($data['field'] <> $info['field'] || $data['type'] <> $info['type']){
				FieldSetService::updateField($info,$data);
			}
			$reset = model('Field')->edit($data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	
	//排序上下移动
	public static function setSort($id,$type){
		$data = model("Field")->getInfo($id);

		if($type == 1){
			$map['sortid']  = array('lt',$data['sortid']);
			$map['extend_id'] = $data['extend_id'];
			$info = model("Field")->getWhereInfo($map,$order='sortid desc');
		}else{
			$map['sortid']  = array('gt',$data['sortid']);
			$map['extend_id'] = $data['extend_id'];
			$info = model("Field")->getWhereInfo($map,$order='sortid asc');
		}
		
		if(!$info)
		{
		    return false;
		}else{
		   $selfMap['id'] = $id;
		   $targetMap['id'] = $info['id'];
		   $r1 = db("field")->where($selfMap)->setField(array('sortid'=>$info['sortid']));
		   $r2 = db("field")->where($targetMap)->setField(array('sortid'=>$data['sortid']));
		   
		   if($r1 && $r2)
		   {
			  return true;
		   }
		}
	}
	
	
}

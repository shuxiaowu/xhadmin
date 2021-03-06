<?php

namespace app\common\service;

use think\Validate;

class HookService
{
	
	//加载默认数据
    public static function loadList($where,$field,$limit,$orderby){
	
		try{
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
		
			$list = model('Hook')->loadList($where,$field,$limit,$orderby);
			$count = model('Hook')->countList($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$list,'count'=>$count];	
	}
	
	
	//批量删除
	public static function delete($where){
	
		try{
			
			$reset = model('Hook')->delete($where,$extTableName,$pk);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//按条件修改
	public static function editWhere($where,$data){
	
		try{
			$reset = model('Hook')->editWhere($where,$data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//按主键修改
	public static function edit($data){
	
		try{
			$reset = model('Hook')->edit($data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	
	//添加或者编辑数据
	public static function saveData($type,$data){
	
		try{
			
			if($type == 'add'){
				$reset = model('Hook')->createData($data);
			}elseif($type == 'edit'){
				$reset = model('Hook')->edit($data);
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;
		
	}
	
	
	
}

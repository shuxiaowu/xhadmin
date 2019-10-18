<?php

namespace app\common\service;

use think\Validate;

class PluginsService
{
	
	//加载默认数据
    public static function loadList($where,$field,$limit,$orderby){
	
		try{
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
		
			$list = model('Plugins')->loadList($where,$field,$limit,$orderby);
			$count = model('Plugins')->countList($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$list,'count'=>$count];	
	}
	
	
	//批量删除
	public static function delete($where){
	
		try{
			
			$reset = model('Plugins')->delete($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//按条件修改
	public static function editWhere($where,$data){
	
		try{
			$reset = model('Plugins')->editWhere($where,$data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//按主键修改
	public static function edit($data){
	
		try{
			$reset = model('Plugins')->edit($data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//添加或者编辑数据
	public static function saveData($type,$data){
	
		try{
			
			if($type == 'add'){
				$reset = model('Plugins')->createData($data);
			}elseif($type == 'edit'){
				$reset = model('Plugins')->edit($data);
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;
		
	}
	
	
}

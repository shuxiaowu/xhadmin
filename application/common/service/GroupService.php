<?php

namespace app\common\service;

use think\Validate;

class GroupService
{
	
	//加载默认数据
    public static function loadList($where,$field,$limit,$orderby){
	
		try{
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
		
			$list = model('Group')->loadList($where,$field,$limit,$orderby);
			$count = model('Group')->countList($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$list,'count'=>$count];	
	}
	
	
	//批量删除
	public static function delete($where){
	
		try{
			
			$reset = model('Group')->delete($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//按条件修改
	public static function editWhere($where,$data){
	
		try{
			$reset = model('Group')->editWhere($where,$data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//按主键修改
	public static function edit($data){
	
		try{
			$reset = model('Group')->edit($data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	
	//添加或者编辑数据
	public static function saveData($type,$data){
	
		try{
			
			$rule = [];
			$rule = [
				['name','require','分组名称不能为空'],
			];
			
			$validate = new Validate($rule);			
			if (!$validate->check($data)) {
				throw new \Exception($validate->getError());
			}
			
			if($type == 'add'){
				$reset = model('Group')->createData($data);
			}elseif($type == 'edit'){
				$reset = model('Group')->edit($data);
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;
		
	}
	
	
	
}

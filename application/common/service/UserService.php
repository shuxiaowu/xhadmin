<?php

namespace app\common\service;

use think\Validate;

class UserService
{
	
	//加载默认数据
    public static function loadList($where,$field,$limit,$orderby){
	
		try{
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
		
			$list = model('User')->loadList($where,$field,$limit,$orderby);
			$count = model('User')->countList($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$list,'count'=>$count];	
	}
	
	//关联查询
    public static function loadRelateList($where,$field,$limit,$orderby){
	
		try{
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
		
			$result = model('User')->loadRelateList($where,$field,$limit,$orderby);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$result['list'],'count'=>$result['count']];	
	}
	
	
	//批量删除
	public static function delete($where){
	
		try{
			
			$reset = model('User')->delete($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//按条件修改
	public static function editWhere($where,$data){
	
		try{
			$reset = model('User')->editWhere($where,$data);
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
				['name','require','真实姓名不能为空'],
				['user','require','用户名不能为空'],
				['pwd','require','登录密码不能为空'],
			];
			
			$validate = new Validate($rule);			
			if (!$validate->check($data)) {
				throw new \Exception($validate->getError());
			}
			
			if($type == 'add'){
				$data['create_time'] = time();
				$data['pwd'] = md5(trim($data['pwd']));
				$reset = model('User')->createData($data);
			}elseif($type == 'edit'){
				$reset = model('User')->edit($data);
			}
			
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;
		
	}
	
	
}
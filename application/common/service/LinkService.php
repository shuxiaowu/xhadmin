<?php

namespace app\common\service;

use think\Validate;

class LinkService
{
	
	//加载默认数据
    public static function loadList($where,$field,$limit,$orderby){
	
		try{
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
		
			$list = model('Link')->loadList($where,$field,$limit,$orderby);
			$count = model('Link')->countList($where);
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
		
			$result = model('Link')->loadRelateList($where,$field,$limit,$orderby);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$result['list'],'count'=>$result['count']];	
	}
	
	
	//批量删除
	public static function delete($where){
	
		try{
			
			$reset = model('Link')->delete($where,$extTableName,$pk);
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
				['title','require','链接名称不能为空'],
				['jumpurl','require','链接地址不能为空'],
			];
			
			$validate = new Validate($rule);			
			if (!$validate->check($data)) {
				throw new \Exception($validate->getError());
			}
			if($type == 'add'){
				$data['create_time'] = time();
				$reset = model('Link')->createData($data);
			}elseif($type == 'edit'){
				$reset = model('Link')->edit($data);
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;
		
	}
	
}

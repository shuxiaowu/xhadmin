<?php

namespace app\admin\service;

use think\Validate;

class UploadConfigService
{
	
	//加载默认数据
    public static function loadList($where,$field,$limit,$orderby){
	
		try{
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
		
			$list = model('UploadConfig')->loadList($where,$field,$limit,$orderby);
			$count = model('UploadConfig')->countList($where);
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
		
			$result = model('UploadConfig')->loadRelateList($where,$field,$limit,$orderby);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$result['list'],'count'=>$result['count']];	
	}
	
	
	//批量删除
	public static function delete($where){
	
		try{
			
			$reset = model('UploadConfig')->delete($where,$extTableName,$pk);
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
				['title','require','配置名称不能为空'],
			];
			
			$validate = new Validate($rule);			
			if (!$validate->check($data)) {
				throw new \Exception($validate->getError());
			}
			if($type == 'add'){
				$reset = model('UploadConfig')->createData($data);
			}elseif($type == 'edit'){
				$reset = model('UploadConfig')->edit($data);
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;
		
	}
	
}

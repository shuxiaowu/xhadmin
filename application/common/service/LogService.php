<?php

namespace app\common\service;

class LogService
{
	
	//sql语句查询
    public static function query($sql,$where,$limit,$orderby){
	
		try{
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
			
			$res = model('Log')->query($sql,$where,$limit,$orderby);
			
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$res['list'],'count'=>$res['count']];	
	}
	
	//批量删除
	public static function delete($where){
	
		try{
			$reset = model('Log')->delete($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	
}

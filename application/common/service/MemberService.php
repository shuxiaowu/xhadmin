<?php

namespace app\common\service;

use think\Validate;
use think\Cache;
use PHPExcel;
use PHPExcel_Cell;
use PHPExcel_IOFactory;

class MemberService
{
	
	//加载默认数据
    public static function loadList($where,$field,$limit,$orderby){
	
		try{
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
		
			$list = model('Member')->loadList($where,$field,$limit,$orderby);
			$count = model('Member')->countList($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$list,'count'=>$count];	
	}
	
	
	
	//批量删除
	public static function delete($where){
	
		try{
			
			$reset = model('Member')->delete($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//按条件修改
	public static function editWhere($where,$data){
	
		try{
			$reset = model('Member')->editWhere($where,$data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//按主键修改
	public static function edit($data){
	
		try{
			$reset = model('Member')->edit($data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//数值累加
	public static function setInc($where,$field,$data){
	
		try{
			$reset = model('Member')->setInc($where,$field,$data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//数值减
	public static function setDec($where,$field,$data){
	
		try{
			$reset = model('Member')->setDec($where,$field,$data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//添加或者编辑数据
	public static function saveData($type,$data){
	
		try{

			if($type == 'add'){
				$reset = model('Member')->createData($data);
			}elseif($type == 'edit'){
				$reset = model('Member')->edit($data);
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;
		
	}
	
	
	
}

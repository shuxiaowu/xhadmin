<?php

namespace app\admin\service;

use think\Validate;

class ExtendService
{
	
	//加载默认数据
    public static function loadList($where,$field,$limit,$orderby){
	
		try{
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
		
			$list = model('Extend')->loadList($where,$field,$limit,$orderby);
			$count = model('Extend')->countList($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$list,'count'=>$count];	
	}
	
	
	//批量删除
	public static function delete($where,$extTableName,$pk){
	
		try{
			
			$reset = model('Extend')->delete($where,$extTableName,$pk);
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
				['title','require','名称不能为空'],
				['table_name','require','数据表不能为空'],
			];
			
			$validate = new Validate($rule);			
			if (!$validate->check($data)) {
				throw new \Exception($validate->getError());
			}
			
			if($type == 'add'){
				$reset = model('Extend')->createData($data);
			}elseif($type == 'edit'){
				$reset = model('Extend')->edit($data);
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;
		
	}
	
	//排序上下移动
	public static function setSort($extend_id,$type){
		$data = model("Extend")->getInfo($extend_id);

		if($type == 1){
			$map['sortid']  = array('lt',$data['sortid']);
			$info = model("Extend")->getWhereInfo($map,$order='sortid desc');
		}else{
			$map['sortid']  = array('gt',$data['sortid']);
			$info = model("Extend")->getWhereInfo($map,$order='sortid asc');
		}
		
		if(!$info)
		{
		    return false;
		}else{
		   $selfMap['extend_id'] = $extend_id;
		   $targetMap['extend_id'] = $info['extend_id'];
		   $r1 = db("Extend")->where($selfMap)->setField(array('sortid'=>$info['sortid']));
		   $r2 = db("Extend")->where($targetMap)->setField(array('sortid'=>$data['sortid']));
		   
		   if($r1 && $r2)
		   {
			  return true;
		   }
		}
	}
	
	
	

	
	
}

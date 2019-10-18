<?php
namespace app\admin\model;

use think\Model;


class FieldData extends Model
{
	
	//拓展表操作
	public function saveData($data,$type,$extTableName,$pk){
		try{
			if($type == 'add'){
				$result = db($extTableName)->insertGetId($data);	
			}elseif($type == 'edit'){
				$where[$pk] = $data[$pk];
				$result = db($extTableName)->where($where)->update($data);
			}
			
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
	}
	
    
}

<?php
namespace app\admin\model;

use think\Model;


class Config extends Model
{
	
	protected $tableName = 'config';  
	

    /**
     * 获取信息
     * @param int 
     * @return array 信息
     */
    public function getInfo()
    {
        $list = db($this->tableName)->select();
		
		foreach ($list as $key => $value) {
            $config[$value['name']] = $value['data'];
        }
        return $config;
        
    }
	
	
	/**
     * 数据修改
     * @param array $where 条件
     * @return array 信息
     */
	public function edit($where,$data)
    {   	
		try{
			$result = db($this->tableName)->where($where)->update($data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
    }
	
	/**
     * 创建信息
     * @return array 信息
     */
    public function createData($data)
    {	
		try{
			$result = db($this->tableName)->insertGetId($data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
    }
	

    
	
    
}

<?php
namespace app\admin\model;

use think\Model;


class Node extends Model
{
	
	protected $tableName = 'node';  
	protected $pk = "id";
	
	/**
     * 获取列表
     * @return array 列表
     */
    public function loadList($where = array(),$field="*",$limit,$order="sortid asc"){
		
		try{
			$result =  db($this->tableName)->field($field)->where($where)->limit($limit)->order($order)->select();
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
    }
	
	/**
     * 获取所有数据
     * @return array 列表
     */
    public function loadAll($where = array()){
		
		try{
			$result =  db($this->tableName)->where($where)->order('sortid asc')->select();
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
    }

    /**
     * 获取统计
     * @return int 数量
     */
    public function countList($where){
	
		try{
			$result = db($this->tableName)->where($where)->count();
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
    }

    /**
     * 获取信息
     * @param int 
     * @return array 信息
     */
    public function getInfo($pk)
    {
        $map = array();
        $map[$this->pk] = $pk;
        return $this->getWhereInfo($map,$this->pk.' desc');
    }

    /**
     * 获取信息
     * @param array $where 条件
     * @return array 信息
     */
    public function getWhereInfo($where,$orderby)
    {		
		try{
			$result = db($this->tableName)->where($where)->order($orderby)->find();
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
    }
	
	/**
     * 删除信息
     * @return array 信息
     */
    public function delete($where)
    {	
		try{
			$result = db($this->tableName)->where($where)->delete();
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
    }
	
	
	
	/**
     * 修改状态
     * @param array $where 条件
     * @return array 信息
     */
    public function edit($data)
    {   	
		try{
			$result = db($this->tableName)->update($data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		if(!$result){
			throw new \Exception('修改失败');
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

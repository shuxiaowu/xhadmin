<?php
namespace app\common\model;

use think\Model;


class Catagory extends Model
{
	
	protected $tableName = 'catagory';   //数据表名
	protected $pk = "class_id";
	
	
	/**
     * 获取数据
     * @param int 
     * @return array 信息
     */
	public function loadAll($where){
		try{
			$result = db($this->tableName)->order('sortid asc')->select();
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
	}
	
	/*关联查询*/
	 public function loadRelateList($where = [],$field,$orderby){
		
		try{
			$list = db($this->tableName)->field($field)->alias('a')->join('extend b','a.module_id=b.extend_id',"LEFT")->where($where)->order($orderby)->select();
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $list;
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
     * 按住键修改
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

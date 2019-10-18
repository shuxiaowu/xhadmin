<?php
namespace app\admin\model;

use think\Model;


class Backup extends Model
{
	
	protected $tableName = '';   //用户表
	protected $pk = "";
	protected $joinTable = "joinTable";
	
	/**
     * 获取列表
     * @return array 列表
     */
    public function loadList($where = array(),$field="*",$limit,$orderby){
		
		try{
			if(empty($orderby)){
				$orderby = ' desc';
			}
			$result =  db($this->tableName)->field($field)->where($where)->limit($limit)->order($orderby)->select();
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
    }
	
	/*关联查询*/
	 public function loadRelateList($where = array(),$field,$limit,$orderby,$relate_table,$relate_field,$thisTableField){
		
		try{
			if(empty($field)){
				$field = "a.*,b.*";
			}
			
			if(empty($orderby)){
				$orderby = ' desc';
			}
			
			$result = db($this->tableName)->field($field)->alias('a')->join(''.$relate_table.' b','a.'.$thisTableField.'=b.'.$relate_field.'')->where($where)->limit($limit)->order($orderby)->select();
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
    }
	
	/*关联查询数据总量*/
	 public function loadRelateCount($where = array(),$relate_table,$relate_field,$thisTableField){
		
		try{
			if(empty($field)){
				$field = "a.*,b.*";
			}
			
			$result = db($this->tableName)->alias('a')->join(''.$relate_table.' b','a.'.$thisTableField.'=b.'.$relate_field.'')->where($where)->count();
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
    }
	
	
	/**
     * sql查询
     */
    public function query($sql,$where,$limit,$orderby){
	
		try{
			foreach($where as $key=>$val){
				$map .= $key.'="'.$val.'" and ';
			}
			
			$map = rtrim($map,'and ');
			
			
			
			$where = !empty($where) ?  ' where '.$map : '';			
			$orderby = !empty($orderby) ?  ' order by '.$orderby : ' order by '.$this->pk.' desc';
			$limit = !empty($limit) ?  ' limit '.$limit : '';
			
			$sql .= $where.$orderby.$limit;
			
			
			$result = db()->query($sql);
			
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
        return $this->getWhereInfo($map);
    }

    /**
     * 获取信息
     * @param array $where 条件
     * @return array 信息
     */
    public function getWhereInfo($where)
    {		
		try{
			$result = db($this->tableName)->where($where)->find();
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
    }
	
	/**
     * 关联查询
     * @param array $where 条件
     * @return array 信息
     */
	public function getExtInfo($pk,$extTableName){
		
		try{
			$where['a.'.$this->pk] = $pk;
			$result =  db($this->tableName)->alias('a')->join($extTableName.' b','a.'.$this->pk.'=b.'.$this->pk.'')->where($where)->find();
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage()); 
		}
		
		return $result;
		
	}
	
	/**
     * 删除信息
     * @return array 信息
     */
    public function delete($where,$extTableName,$pk)
    {	
		try{
			$result = db($this->tableName)->where($where)->delete();
			if(!empty($extTableName) && !empty($pk)){
				db($extTableName)->where($where)->delete();
			}
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
    public function editStatus($where,$data)
    {   	
		try{
			$result = db($this->tableName)->where($where)->update($data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
    }
	
	
	/**
     * 数据修改
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
     * 数值加
     * @param array $where 条件
     * @return array 信息
     */
	public function setInc($where,$field,$data)
    {   	
		try{
			$result = db($this->tableName)->where($where)->setInc($field,$data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		return $result;
    }
	
	
	/**
     * 数值减
     * @param array $where 条件
     * @return array 信息
     */
	public function setDec($where,$field,$data)
    {   	
		try{
			$result = db($this->tableName)->where($where)->setDec($field,$data);
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

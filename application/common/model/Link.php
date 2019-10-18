<?php
namespace app\common\model;

use think\Model;


class Link extends Model
{
	
	protected $tableName = 'link';   //数据表名
	protected $pk = "link_id";
	
	/**
     * 获取列表
     * @return array 列表
     */
    public function loadList($where = array(),$field="*",$limit,$orderby){
		
		try{
			empty($orderby) && $orderby = $this->pk.' desc';
			$result =  db($this->tableName)->field($field)->where($where)->limit($limit)->order($orderby)->select();
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $result;
    }
	
	
	/*关联查询*/
	 public function loadRelateList($where = [],$field='*',$limit,$orderby){
		
		try{
			$list = db($this->tableName)->field($field)->alias('a')->join('link_catagory b','a.catagory_id=b.catagory_id',"LEFT")->where($where)->limit($limit)->order($orderby)->select();
			
			$count = $this->countList($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return ['list'=>$list,'count'=>$count];
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
     * 按条件修改
     * @param array $where 条件
     * @return array 信息
     */
    public function editWhere($where,$data)
    {   	
		try{
			$result = db($this->tableName)->where($where)->update($data);
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

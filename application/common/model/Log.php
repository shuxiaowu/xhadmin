<?php
namespace app\common\model;

use think\Model;


class Log extends Model
{
	
	protected $tableName = 'log';   //数据表名
	protected $pk = "log_id";

	
	/**
     * sql查询
     */
    public function query($sql,$where,$limit,$orderby){
		
		try{
			foreach($where as $key=>$val){
				if(is_array($val)){
					if(is_array($val[0])){
						foreach($val as $k=>$v){
							$map .= $key.' '.$v[0].' '.$v[1].' and ';
						}
					}else{
						$map .= $key.' '.$val[0].' '.$val[1].' and ';
					}					
				}else{
					$map .= $key.'="'.$val.'" and ';
				}	
			}
			
			$map = str_replace('gt','>',rtrim($map,'and '));
			$map = str_replace('lt','<',$map);
			
			if(!false === strpos($sql,"where") ){
				$where = !empty($where) ?  ' and '.$map : '';	
			}else{
				$where = !empty($where) ?  ' where '.$map : '';	
			}
			
			$orderby = !empty($orderby) ?  ' order by '.$orderby : ' order by '.$this->pk.' desc';
			$limit = !empty($limit) ?  ' limit '.$limit : '';
			
			$countWhere = preg_replace('/^select(.*)from/iUs','select count(*) as count from',$sql.$where);
			$sql .= $where.$orderby.$limit;
			$result = db()->query($sql);
			$count = db()->query($countWhere);
			
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return ['list'=>$result,'count'=>$count[0]['count']];
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
	

}

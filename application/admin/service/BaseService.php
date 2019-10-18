<?php

namespace app\admin\service;


class BaseService
{
	
	
	/*
	 * 删除权限节点
     * @param array $where 条件
     * @return array 添加状态
	*/
	public function delete($group_id)
	{
		$data = ['group_id' => $group_id];
        return db('access')->where($data)->delete();
	}
	
	/**
     * 添加权限信息
     * @return array 添加状态
     */
    public function add($data)
	{
        $res = db('access')->insert($data);
		if($res){
			return true;
		}
	}
	
	/**
     * 修改密码
     * @return array 修改状态
     */
    public function updatePassword($password)
	{
        try{
			$where['user_id'] = session('admin.userid');
			$dt['pwd'] = md5(trim($password));	
			$status = db("user")->where($where)->update($dt);
			
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return $status;
	}
	
	

}

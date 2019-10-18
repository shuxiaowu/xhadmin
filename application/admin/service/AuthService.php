<?php

namespace app\admin\service;

class AuthService
{
	
	
    /**
     * 根据用户名密码，验证用户是否能成功登陆
     * 
     * @param string $username
     * @param string $password
     * @throws \Exception
     * @return mixed
     */
    public static function checkLogin($username, $password) {

        $data['username'] = $username;
        $data['password']  = $password;
        
        $ret = self::checkUser($data);
		
        if ('00' != $ret['error']) {
            throw new \Exception($ret['message']);
        }
        
		$node = db('access')->where('group_id',$ret['data']['group_id'])->select();
        foreach($node as $val){
			$access[] = $val['purviewval'];
		}				
        //数据存储session
        $userInfo = [
            'username'      => $ret['data']['group_name'].'-'.$ret['data']['name'],
			'userid'      => $ret['data']['user_id'],
            'status'        => $ret['data']['status'],
			'group_status'   => $ret['data']['group_status'],        
			'nodes'         => $access,
			'role'          => $ret['data']['role'],
        ];

		$array = [
			'user_id'=>$ret['data']['user_id'],
			'username'=>$username,
			'event'=>'用户登录',
			'ip'=>ip(),
			'time'=>time()
		];
		
		db("log")->insert($array);
		
        session('admin', $userInfo);
		session('admin_sign', data_auth_sign($userInfo));
        return $userInfo;
    }
    
	
	/*验证登录*/
	public static function checkUser($data){
		$where['a.user'] = trim($data['username']);
		$where['a.pwd']  = md5(trim($data['password']));		
		$info = db('user')->alias('a')->join('group b', 'a.group_id =b.group_id')->field('a.*,b.name as group_name,b.status as group_status,b.role as role')->where($where)->find();
		
		if(!$info){
			throw new \Exception("请检查用户名或者密码");
		}
		if(!($info['status']) || !($info['group_status'])){
			throw new \Exception("该账户被禁用");
		}
		return ['error'=>'00','data'=>$info];
		
	}
    
}

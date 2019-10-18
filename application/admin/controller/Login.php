<?php

namespace app\admin\controller;

use app\admin\controller\Admin;
use app\admin\service\AuthService;

class Login extends Admin
{

	
	public function denglu(){
		
	}
	
    /**
     * 用户登录
     * @return string
     */
    public function index()
    {
  
        if ($this->request->isGet()) {
            return $this->fetch('', ['title' => '用户登录']);
        } else {
            
            $username = $this->request->post('username', '', 'strip_tags');
            $password = $this->request->post('password', '', 'strip_tags');
			$verify = $this->request->post('verify', '', 'strip_tags');
		   
            // 用户信息验证
            try {
				 $Verify = new \app\common\org\Verify();
				 if(!$Verify->check($verify)){
					 throw new \Exception('验证码错误');
				 }
                $res = AuthService::checkLogin($username, $password);
            } catch (\Exception $e) {
                $this->error("登陆失败：{$e->getMessage()}");
            }
            $this->success('登录成功，正在进入系统...', '@admin');
        }
    }
	
	/*验证码*/
	public function Verify()
	{
	    ob_clean();
	    $Verify = new \app\common\org\Verify();
		$Verify->fontSize = 16;
		$Verify->length   = 4;
		$Verify->useNoise = false;
		return $Verify->entry();
	}

    /**
     * 退出登录
     */
    public function out()
    {
        session('admin', null);
        session_destroy();
        $this->success('退出登录成功！', '@admin/login');
    }
	
	
}

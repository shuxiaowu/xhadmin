<?php 

namespace app\admin\controller;
use think\Controller;
use think\Request;

class Admin extends Controller {
	

	public function _initialize(){

		if (!defined('ADMIN_STATUS')) { 
            $this->error('请从后台入口重新登录！', false);
        }
		$userid = $this->isLogin();
		
		$this->request = Request::instance();
		//当userid 不存在并且也不是登录操作的时候 重载到登录界面
        if( !$userid && ( $this->request->module() <> 'admin' || $this->request->controller() <> 'Login' )){
            //$this->redirect('admin/Login/index');
			echo exit('<script>top.location.href="'.url('admin/Login/index').'"</script>');
        }
		
		$info = model("Config")->getInfo();
		config($info);
		
		//检测权限
		$this->checkPurview();
		
		
		
		
	}
	
	/**
     * 用户权限检测
     */
    protected function checkPurview()
    {
        $this->request = Request::instance();
        list($module, $controller, $action) = [$this->request->module(), $this->request->controller(), $this->request->action()];
		$url =  "/{$module}/{$controller}/{$action}";
        /*不需要检测的权限*/		
		$nocheck = config('nocheck');
		
		if(session('admin.role') !== 1 && !in_array($url,$nocheck) && $action !== 'startImport'){	
			if(!in_array($url,session('admin.nodes'))){
				$this->error('你没有权限访问',url('/admin/Index/main'));
			}	
		}	
    }
	
	/**
     * 检测用户是否登录
     * @return int 用户ID
     */
    protected function isLogin(){
        $admin = session('admin');
        if (!$admin) {
            return 0;
        } else {
            return session('admin_sign') == data_auth_sign($admin) ? $admin['userid'] : 0;
        }
    }
	
	

}
<?php

namespace plugins\viewbigpic;
use app\common\controller\Plugins;

class viewbigpic extends Plugins
{
	
    /**
     * @param $params
     */
    public function run($params)
    {
		$this->assign('type',$params['type']);
        $this->display('viewbigpic');
    }
	
	 /**
     * 安装前的业务处理，可在此方法实现，默认返回true
     * @return bool
     */
    public function install()
    {
        return true;
    }
	
	/**
     * 卸载前的业务处理，可在此方法实现，默认返回true
     * @return bool
     */
    public function uninstall()
    {
        return true;
    }
	
}

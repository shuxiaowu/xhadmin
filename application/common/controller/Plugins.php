<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: yangweijie <yangweijiester@gmail.com> <code-tech.diandian.com>
// +----------------------------------------------------------------------

namespace app\common\controller;


/**
 * 插件类
 * @author yangweijie <yangweijiester@gmail.com>
 */
abstract class Plugins{
    
	/**
     * @var null 视图实例对象
     */
    protected $view = null;

    /**
     * @var string 错误信息
     */
    protected $error = '';

    /**
     * @var string 插件名
     */
    public $pluginsName = '';

    /**
     * @var string 插件路径
     */
    public $pluginsPath = '';
	

   

    public function __construct(){
	   $this->view         =   \think\View::instance();
		// 获取插件名
       $class = get_class($this);
       $this->pluginsName = substr($class, strrpos($class, '\\') + 1);
       $this->pluginsPath = ROOT_PATH.'plugins/'.$this->pluginsName.'/view/';
    }

    /**
     * 模板主题设置
     * @access protected
     * @param string $theme 模版主题
     * @return Action
     */
    final protected function theme($theme){
        $this->view->theme($theme);
        return $this;
    }

    //显示方法
    final protected function display($template=''){
        if($template == '')
            $template = CONTROLLER_NAME;
        echo ($this->fetch($template));
    }

    /**
     * 模板变量赋值
     * @access protected
     * @param mixed $name 要显示的模板变量
     * @param mixed $value 变量的值
     * @return Action
     */
    final protected function assign($name,$value='') {
        $this->view->assign($name,$value);
        return $this;
    }



    //用于显示模板的方法
    final protected function fetch($templateFile = CONTROLLER_NAME){
        if(!is_file($templateFile)){
            $templateFile = $this->pluginsPath.$templateFile.'.html';
            if(!is_file($templateFile)){
                throw new \Exception("模板不存在:$templateFile");
            }
        }
        return $this->view->fetch($templateFile);
    }
	

    final public function getError()
    {
        return $this->error;
    }

    abstract public function install();

    abstract public function uninstall();
	
}

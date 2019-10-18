<?php

namespace app\common\behavior;
use think\Cache;

class Hook
{

    /**
     * 注册钩子
     * @param $params
    */ 
    public function run(&$params)
    {	
		$data = Cache::get('hooks');
		if(!$data){
			$hooks = db("hook")->where('status',10)->column('hook_name');
			$plugins = db("plugins")->where('status',10)->column('plugins_dir','hook_name');
			foreach($hooks as $val){
				if(isset($plugins[$val])){
					\think\Hook::add($val,'plugins\\'.$plugins[$val].'\\'.$plugins[$val].'');
				}
			}
			Cache::set('hooks',\think\Hook::get());
		}else{
			 \think\Hook::import($data,false);
		}

    }
	

}

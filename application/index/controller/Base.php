<?php

namespace app\index\controller;
use think\Controller;


class Base extends Controller
{
	
	public function _initialize(){
		
		$info = model("admin/Config")->getInfo();
		config($info);
		if($info['site_status'] == 2){
			exit($info['off_msg']);
		}
		
		//检测终端
		$mobil = isMobile();
		$url = $_SERVER['HTTP_HOST'];
		if(config('mobil_status') == 1){
			if($mobil){
				if(config('mobil_domain') && config('mobil_domain') <> $url){
					header('location:http://'.config('mobil_domain'));	
				}
				config('default_themes',config('mobil_themes'));
			}
			
			
		}
	}
	
	
	

}

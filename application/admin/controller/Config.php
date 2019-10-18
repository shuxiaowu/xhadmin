<?php

namespace app\admin\controller;

use app\admin\controller\Admin;


class Config extends Admin {

	/*系统配置*/
	function index(){
		if (!$this->request->isPost()){
			$info = model("Config")->getInfo();
			$this->assign('info',$info);
			$this->assign('themesList',\app\common\service\CatagoryService::tplList(''));
			return $this->fetch('index');
		}else{
			$data = input('post.');
			
			try{
				$info = model("Config")->getInfo();
				if(config('url_type') !== $data['url_type']){
					\app\common\service\CommonService::deldir('../runtime');
				}
				foreach($info as $k=>$v){
					$keyArr[] = $k;
				}
				
				foreach ($data as $key => $value) {
					$currentData = array();
					$currentData['data'] = $value;
					if(in_array($key,$keyArr)){
						model("Config")->edit(array('name'=>''.$key.''),$currentData);
					}else{
						model("Config")->createData(array('name'=>$key,'data'=>$value));
					}
				}
			}catch(\Exception $e){
				$this->error($e->getMessage());
			}
			
            echo json_encode(array('status'=>'00','message'=>'修改成功'));
		}
	}
	
	
	

}
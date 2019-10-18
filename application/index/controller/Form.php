<?php

namespace app\index\controller;
use app\index\controller\Base;
use think\Controller;


class Form extends Base
{
	
	//表单提交页面
	public function index(){
		if ($this->request->isPost()){
			$formData = input('post.');
			if(empty($formData['extend_id'])){
				$this->error('模型ID不能为空');
			}
			try {
				$res = model("FormExtend")->saveData($formData);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			
			$this->success('提交成功');
		}
	}
	
}

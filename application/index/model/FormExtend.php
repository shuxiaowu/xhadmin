<?php

namespace app\index\model;
use think\Model;
use think\Validate;


class FormExtend extends Model
{
	
	//提交表单数据
	public function saveData($formData){
		$fieldList = db("field")->where(['extend_id'=>$formData['extend_id']])->select();
		
		$extInfo = model("admin/Extend")->getInfo($formData['extend_id']);
		unset($formData['extend_id']);
		foreach($formData as $k=>$v){
			$fields .= $k.',';
		}
		$fields = rtrim($fields,',');
		
		foreach($fieldList as $key=>$val){
			
			$rules ='';
			if($val['validate'] == 'notEmpty'){
				$rules = 'require';
				$emptyMsg = $val['name'].'不能为空';
			}
			if(!empty($val['rule'])){
				$rules .= '|'.$val['rule']; 
			}
			if(!empty($val['validate']) || !empty($val['rule'])){
				$rules = ltrim($rules,'|');
				$msg = !empty($val['message']) ? $val['message'] : $emptyMsg;
				$rule[] = [$val['field'] ,$rules, $msg];
			}		
			
			
			if($val['type'] == 7){
				$formData[$val['field']] = strtotime($formData[$val['field']]);
			}		
			if($val['type'] == 12){
				$formData[$val['field']] = time();
			}
			if($val['type'] == 20){
				$formData[$val['field']] = ip();
			}
			
		}
		
		$validate = new Validate($rule);			
		if (!$validate->check($formData)) {
			throw new \Exception($validate->getError());
		}
		
		try{
			db('ext_'.$extInfo['table_name'])->insert($formData);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
		
		return true;
		
	}
	
}

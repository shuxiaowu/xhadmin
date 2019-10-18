<?php

namespace app\admin\service;
use app\admin\service\FieldSetService;
use think\Validate;
use PHPExcel;
use PHPExcel_Cell;
use PHPExcel_IOFactory;
use think\Cache;

class FormDataService
{
	
	//获取表单列表
	public static function getTableList($fieldList){
		$htmlstr .="	CodeGoods.initColumn = function () {\n";
		$htmlstr .=" 		return [\n";
		$htmlstr .=" 			{field: 'selectItem', checkbox: true},\n";
		$htmlstr .=" 			{title: '编号', field: 'data_id', visible: true, align: 'left', valign: 'middle'},\n";
		foreach($fieldList as $k=>$v){
			if($v['type'] == 1 || $v['type'] == 2 || $v['type'] == 3 || $v['type'] == 13){
				if(!empty($v['config'])){
					$htmlstr .=" 			{title: '".$v['name']."', field: '".$v['field']."', visible: true, align: '".$v['align']."', valign: 'middle',formatter: 'CodeGoods.".$v['field']."Formatter'},\n";
				}else{
					$htmlstr .=" 			{title: '".$v['name']."', field: '".$v['field']."', visible: true, align: '".$v['align']."', valign: 'middle'},\n";
				}
			}else if($v['type'] == 7 || $v['type'] == 8 || $v['type'] == 10 || $v['type'] == 12){
				$htmlstr .=" 			{title: '".$v['name']."', field: '".$v['field']."', visible: true, align: '".$v['align']."', valign: 'middle',formatter: 'CodeGoods.".$v['field']."Formatter'},\n";
			}else if($v['type'] == 17){
				$htmlstr .=" 			{title: '".$v['name']."', field: '".$v['field']."', visible: true, align: '".$v['align']."', valign: 'middle',formatter: 'CodeGoods.threeAreaFormatter'},\n";
			}else{
				$htmlstr .=" 			{title: '".$v['name']."', field: '".$v['field']."', visible: true, align: '".$v['align']."', valign: 'middle'},\n";
			}	
		}
		
		$htmlstr .=" 			{title: '操作', field: 'data_id', visible: true, align: 'center', valign: 'middle',formatter: 'CodeGoods.buttonFormatter'},,\n";
		
		$htmlstr .=" 		];\n";
		$htmlstr .=" 	};\n\n";
		
		
		foreach($fieldList as $key=>$val){
			
			if(!empty($val['config']) && ($val['type'] == 1 || $val['type'] == 13)){
				$htmlstr .="	CodeGoods.".$val['field']."Formatter = function(value,row,index) {\n";
				$htmlstr .="		if(value){\n";
				$htmlstr .="			return '<span class=\"label label-".$val['config']."\">'+value+'</span>';\n";
				$htmlstr .="		}\n";
				$htmlstr .="	}\n\n";
			}
			
			//格式化单选框 下拉框
			if($val['type'] == 2 || $val['type'] == 3){
				if(!empty($val['config'])){
					
					$htmlstr .="	CodeGoods.".$val['field']."Formatter = function(value,row,index) {\n";
					$htmlstr .="		if(value !== null){\n";
					$htmlstr .="			var value = value.toString();\n";
					$htmlstr .="			switch(value){\n";
					$data = explode(',',$val['config']);
					if($data && count($data) > 1){
						foreach($data as $key=>$val){
							$valArr = explode('|',$val);
							if($valArr){
								$htmlstr .="				case '".$valArr[1]."':\n";
								if(!empty($valArr[2])){
									$htmlstr .="					return '<span class=\"label label-".trim($valArr[2])."\">".$valArr[0]."</span>';\n";
								}else{
									$htmlstr .="					return '".$valArr[0]."';\n";
								}
								$htmlstr .="				break;\n";
							}
							
						}
					}
					
					$htmlstr .="			}\n";
					$htmlstr .="		}\n";
					$htmlstr .="	}\n\n";
				}
			}
			
			//格式化显示图片
			if($val['type'] == 8){
				$htmlstr .="	CodeGoods.".$val['field']."Formatter = function(value,row,index) {\n";
				$htmlstr .="		if(value){\n";
				$htmlstr .="			return \"<a href=\"+value+\" target='_blank'><img height='30' src=\"+value+\"></a>\";	\n";
				$htmlstr .="		}\n";
				$htmlstr .="	}\n\n";
			}
			
			//附件下载
			if($val['type'] == 10){
				$htmlstr .="	CodeGoods.".$val['field']."Formatter = function(value,row,index) {\n";
				$htmlstr .="		if(value){\n";
				$htmlstr .="			return \"<a href=\"+value+\" target='_blank'>下载附件</a>\";	\n";
				$htmlstr .="		}\n";
				$htmlstr .="	}\n\n";
			}
			
			//格式化时间
			if($val['type'] == 7 || $val['type'] == 12){
				$htmlstr .="	CodeGoods.".$val['field']."Formatter = function(value,row,index) {\n";
				$htmlstr .="		if(value){\n";
				$htmlstr .="			return formatDateTime(value);	\n";
				$htmlstr .="		}\n";
				$htmlstr .="	}\n\n";
			}
			
			//格式化三级联动
			if($val['type'] == 17){
				$htmlstr .="	CodeGoods.threeAreaFormatter = function(value,row,index) {\n";
				$htmlstr .="		 var areaStr = '';\n";
				foreach(explode('|',$val['field']) as $m=>$n){
					$htmlstr .="		 if(row.".$n."){\n";
					$htmlstr .="		 	areaStr += \"-\"+row.".$n.";\n";
					$htmlstr .="		 }\n";
				}
				$htmlstr .="		areaStr = areaStr.substr(1);\n";
				$htmlstr .="		return areaStr;\n";
				$htmlstr .="	}\n\n";
			}
		}
		
		return $htmlstr;
	}
	
	//搜索加载
	public function getSearchGroup($searchlist){
		
		foreach($searchlist as $k=>$v){
			if(in_array($v['type'],[1,2,3,12,17])){
				
				if($v['type'] == 12){
					$htmlstr .= "							<div class=\"col-sm-2\">\n";
					$htmlstr .= "								<div class=\"input-group\">\n";
					$htmlstr .= "									<div class=\"input-group-btn\">\n";
					$htmlstr .= "										<button data-toggle=\"dropdown\" class=\"btn btn-white dropdown-toggle\" type=\"button\">开始时间</button>\n";
					$htmlstr .= "									</div>\n";
					$htmlstr .= "									<input type=\"text\" autocomplete=\"off\"  placeholder=\"开始时间\" class=\"form-control layer-date\" onclick=\"laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})\" id=\"startTime\">\n";
					$htmlstr .= "								</div>\n";
					$htmlstr .= "							</div>\n";	
					
					$htmlstr .= "							<div class=\"col-sm-2\">\n";
					$htmlstr .= "								<div class=\"input-group\">\n";
					$htmlstr .= "									<div class=\"input-group-btn\">\n";
					$htmlstr .= "										<button data-toggle=\"dropdown\" class=\"btn btn-white dropdown-toggle\" type=\"button\">结束时间</button>\n";
					$htmlstr .= "									</div>\n";
					$htmlstr .= "									<input type=\"text\" autocomplete=\"off\"   placeholder=\"结束时间\" class=\"form-control layer-date\" onclick=\"laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})\" id=\"endTime\">\n";
					$htmlstr .= "								</div>\n";
					$htmlstr .= "							</div>\n";	
					
				}elseif($v['type'] == 17){
					
					$htmlstr .="							<div id=\"distpicker5\">\n";
					foreach(explode("|",$v['field']) as $m=>$n){
						if($m=='0'){
							$areaTitle = '省';
						}elseif($m == '1'){
							$areaTitle = '市';
						}elseif($m == '2'){
							$areaTitle = '区';
						}
						$htmlstr .="								<div class=\"col-sm-2\">\n";
						$htmlstr .="									<div class=\"input-group\">\n";
						$htmlstr .="										<div class=\"input-group-btn\">\n";
						$htmlstr .="											<button data-toggle=\"dropdown\" class=\"btn btn-white dropdown-toggle\" type=\"button\">".$areaTitle."</button>\n";
						$htmlstr .="										</div>\n";
						
						$htmlstr .="										<select lay-ignore id=\"".$n."\" class=\"form-control\" ></select>\n";
						$htmlstr .="									</div>\n";
						$htmlstr .="								</div>\n";
					}
					$htmlstr .="							</div>\n";
					$htmlstr .="							<script src=\"__PUBLIC__/static/js/plugins/shengshiqu/distpicker.data.js\"></script>\n";
					$htmlstr .="							<script src=\"__PUBLIC__/static/js/plugins/shengshiqu/distpicker.js\"></script>\n";
					$htmlstr .="							<script src=\"__PUBLIC__/static/js/plugins/shengshiqu/main.js\"></script>\n";
				}else{
					$htmlstr .= "							<div class=\"col-sm-2\">\n";
					$htmlstr .= "								<div class=\"input-group\">\n";
					$htmlstr .= "									<div class=\"input-group-btn\">\n";
					$htmlstr .= "										<button data-toggle=\"dropdown\" class=\"btn btn-white dropdown-toggle\" type=\"button\">".$v['name']."</button>\n";
					$htmlstr .= "									</div>\n";
					
					if($v['type'] == 1){
						$htmlstr .= "									<input type=\"text\" autocomplete=\"off\"   class=\"form-control\" id=\"".$v['field']."\" placeholder=\"".$v['name']."\" />\n";
					}
					
					if($v['type'] == 2 || $v['type'] == 3){
						$htmlstr .= "									<select class=\"form-control\" id=\"".$v['field']."\">\n";
						$htmlstr .= "										<option value=\"\">请选择</option>\n";
						
						$searchArr = explode(',',$v['config']);
						if($searchArr){
							foreach($searchArr as $k=>$v){
								$valArr = explode('|',$v);
								$htmlstr .= "										<option value=\"".$valArr[1]."\">".$valArr[0]."</option>\n";
							}
						}
						
						$htmlstr .= "									</select>\n";
					}
					$htmlstr .= "								</div>\n";
					$htmlstr .= "							</div>\n";	
				}
			}	
		}
		
		if($searchlist){
			$htmlstr .= "							<div class=\"col-sm-2\">\n";
			$htmlstr .= "									<button type=\"button\" class=\"btn btn-primary \" onclick=\"CodeGoods.search()\" id=\"\">\n";
			$htmlstr .= "										<i class=\"fa fa-search\"></i>&nbsp;搜索\n";
			$htmlstr .= "									</button>\n";
			$htmlstr .= "							</div>\n";
		}
		return $htmlstr;
	}
	
	
	public static function getQueryParam($searchList){
		$htmlstr .="	CodeGoods.formParams = function() {\n";
		$htmlstr .="		var queryData = {};\n";
		
		foreach($searchList as $k=>$v){
			switch($v['type']){
				//时间段搜素
				case 12:
					$htmlstr .="		queryData['startTime'] = $(\"#startTime\").val();\n";
					$htmlstr .="		queryData['endTime'] = $(\"#endTime\").val();\n";
				break;
				
				//地区三级联动搜索
				case 17:
					foreach(explode("|",$v['field']) as $m=>$n){
						$htmlstr .="		queryData['".$n."'] = $(\"#".$n."\").val();\n";
					}
				break;
				
				default:
					$htmlstr .="		queryData['".$v['field']."'] = $(\"#".$v['field']."\").val();\n";	
				
			}
		}
		
		$htmlstr .="		return queryData;\n";
		$htmlstr .="	}\n\n";
		
		return $htmlstr;
	}
	
	
	public function getView($fieldlist){
		
		foreach($fieldlist as $key=>$val){
			
			$htmlstr .= "				<tr> \n";
			$htmlstr .= "					<td style=\"background-color:#F5F5F6; font-weight:bold; text-align:right\" width=\"15%\">".$val['name']."：</td> \n";
			switch($val['type']){				
				
				case 2:
					$fieldval = getFieldVal($val['value'],$val['id']);	
				break;
				
				case 3:
					$fieldval = getFieldVal($val['value'],$val['id']);	
				break;
				
				case 4:
					$fieldval = getFieldVal($val['value'],$val['id']);
				break;
				
				case 7:
					$fieldval = date('Y-m-d H:i:s',$val['value']);
				break;
				
				case 8:
					$fieldval = '<img height="75" src="'.$val['value'].'">';
				break;
				
				case 9:
					$fieldval = '';
					$fieldval .= "						<ul>\n";
					foreach(explode('|',$val['value']) as $v){
						if($v){
							$fieldval .= "						<li style=\"float:left; margin-bottom:2px; margin-right:2px;\"><img src=\"".$v."\" height=\"75\"></li>\n";
						}
					}
					$fieldval .= "						</ul>\n";
				break;
				
				case 10:
					$fieldval = '<a target="_blank" href="'.$val['value'].'">下载附件</a>';
				break;
				
				case 12:
					$fieldval = date('Y-m-d H:i:s',$val['value']);
				break;
				
				case 17:
					$areaval = '';
					foreach(explode('|',$val['field']) as $m=>$n){
						$areaval .=$val[$n]."-";
					}
					$fieldval = rtrim($areaval,'-');
				break;
				
				default:
					$fieldval = $val['value'];
			}
			$htmlstr .= "					<td>".$fieldval."</td>   \n";
			$htmlstr .= "				</tr> \n";
			
		}

		return $htmlstr;
	}
	
	
	
	//加载数据列表
	public static function loadList($where,$field,$limit,$extend_id,$orderby){
		
		try{
			
			$extendInfo = model('Extend')->getInfo($extend_id);
			if(!$extendInfo){
				throw new \Exception('没有模型信息');
			}
			
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
			
			model('FormData')->setTable('ext_'.$extendInfo['table_name']);
			model('FormData')->setPk('data_id');
		
			$list = model('FormData')->loadList($where,$field,$limit,$orderby);
			$count = model('FormData')->countList($where);
		
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$list,'count'=>$count];		
	}
	
	
	//获取表单数据
	public static function getInfo($extend_id,$data_id){
		try{		
			$extendInfo = model('Extend')->getInfo($extend_id);
			if(!$extendInfo){
				throw new \Exception('没有模型信息');
			}
			
			model('FormData')->setTable('ext_'.$extendInfo['table_name']);
			model('FormData')->setPk('data_id');
			
			$info = model('FormData')->getInfo($data_id);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $info;	
	}
	
	//添加或者编辑数据
	public static function saveData($type,$data,$fieldList){
		
		try{
			if(!$data){
				return false;
			}
			
			$extendInfo = model('Extend')->getInfo($data['extend_id']);
			if(!$extendInfo){
				throw new \Exception('没有模型信息');
			}
			
			model('FormData')->setTable('ext_'.$extendInfo['table_name']);
			model('FormData')->setPk('data_id');
			
			$rule = [];
			
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
			}
			
			$validate = new Validate($rule);			
			if (!$validate->check($data)) {
				throw new \Exception($validate->getError());
			}
			
			if($type == 'add'){
				foreach($fieldList as $k=>$v){
					if($v['type'] == 7){
						$data[$v['field']] = strtotime($data[$v['field']]);
					}
					if($v['type'] == 12){
						$data[$v['field']] = time();
					}
					if($v['type'] == 20){
						$data[$v['field']] = ip();
					}
				}
				$reset = model('FormData')->createData($data);
			}elseif($type == 'edit'){
				foreach($fieldList as $k=>$v){
					if($v['type'] == 7){
						$data[$v['field']] = strtotime($data[$v['field']]);
					}
				}
				if(empty($data['data_id'])){
					return false;
				}
				$reset = model('FormData')->edit($data);				
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;
		
	}
	
	
	//批量删除
	public static function delete($where,$extend_id){
	
		try{		
			$extendInfo = model('Extend')->getInfo($extend_id);
			if(!$extendInfo){
				throw new \Exception('没有模型信息');
			}
			
			model('FormData')->setTable('ext_'.$extendInfo['table_name']);
			model('FormData')->setPk('data_id');
			
			$reset = model('FormData')->delete($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//数据导出
	public static function dumpData($data){
		
		$fieldList = model('Field')->loadAll(['extend_id'=>$data['extend_id'],'status'=>1,'list_show'=>1]);
		$objPHPExcel = new PHPExcel();
		
		$t = 0;
		foreach($fieldList as $key=>$val){
			$t++;
			if(!empty($val)){
				$tag = \app\common\service\CommonService::getTag($t);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($tag.'1', $val['name']);		
			}         	
		}
		$extendInfo = model('Extend')->getInfo($data['extend_id']);
		if($extendInfo['orderby']){
			$orderby = $extendInfo['orderby']; 
		}else{
			$orderby = 'data_id desc';
		}
		
		$where = [];
		$searchList = model('Field')->loadAll(['extend_id'=>$data['extend_id'],'status'=>1,'is_search'=>1]);
		if($searchList){
			foreach($searchList as $k=>$v){
				if($v['type'] == 12){
					$where[$v['field']] = \app\common\service\CommonService::getTimeWhere($data['startTime'],$data['endTime']);
				}else if($v['type'] == 17){
					foreach(explode('|',$v['field']) as $m=>$n){
						$where[$n] = $data[$n];
					}
				}else{
					$where[$v['field']] = $data[$v['field']];
				}	
			}
		}
				
		//目前设定最多能导出10000条数据
		$res = self::loadList($where,$field='*',10000,$data['extend_id'],$orderby);
		$list = $res['list'];
		
		foreach($list as $key=>$val){
			$j = 0;
			foreach($fieldList as $k=>$v){
				$j++;
				switch($v['type']){
					
					case 2:	
						$arr = explode(',',$v['config']);
						foreach($arr as $kk=>$vv){
							$newarr = explode('|',$vv);
							$dt[$newarr[1]] = $newarr[0];
						}
						$fieldData = $dt[$val[$v['field']]];	
					break;
					
					case 3:
						$arr = explode(',',$v['config']);
						foreach($arr as $kk=>$vv){
							$newarr = explode('|',$vv);
							$dt[$newarr[1]] = $newarr[0];
						}
						$fieldData = $dt[$val[$v['field']]];	
					break;
					
					case 7:
						$fieldData = !empty($val[$v['field']]) ? date('Y-m-d H:i:s',$val[$v['field']]) : '';	
					break;
					
					case 12:
						$fieldData = !empty($val[$v['field']]) ? date('Y-m-d H:i:s',$val[$v['field']]) : '';
					break;
					
					//地区三级联动
					case 17:
						$fieldData = '';
						foreach(explode("|",$v['field']) as $m=>$n){
							$fieldData .= $val[$n];
						}
					break;
					
					default:
						$fieldData = $val[$v['field']];
				}
				
				$tag = \app\common\service\CommonService::getTag($j);	
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($tag.($key+2), $fieldData);
			}	
		}	
		
		$filename = $extendInfo['title'].'_'.date('YmdHis');
		$objPHPExcel->setActiveSheetIndex(0);
		header("Content-type:text/csv"); 
		header("Content-Disposition:attachment;filename=".$filename.'.csv'); 
		header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
		header('Expires:0'); 
		header('Pragma:public');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;	
	}
	
	//数据导入
	public function importData(){
		
		$key = 'FormData';
		$cacheData = Cache::get($key);		
		if(!empty($cacheData)) Cache::rm($key); 
		
		$file = explode('.', $_FILES['file_name']['name']);
		if (!in_array(end($file), array('xls', 'xlsx'))) {
			throw new \Exception('请选择excel文件！');
			exit;
		}

		$path = $_FILES['file_name']['tmp_name'];
		if (empty($path)) {
			throw new \Exception('请选择要上传的文件！');
			exit;
		}

		set_time_limit(0);

		$ex_arr = \app\common\service\CommonService::importExecl($path);
		if ($ex_arr['error'] == 1) {
			throw new \Exception('导入失败');
			exit;
		}
		$escel_data_length = $ex_arr['data'][0]['Rows'] - 1; 
		if ($escel_data_length <= 0) {
			throw new \Exception('数据有误');
			exit;
		}
		$excel_data = $ex_arr['data'][0]['Content'];
		if($excel_data){
			Cache::set($key,$excel_data,3600); 
			return $excel_data;
		}
	}
	
}

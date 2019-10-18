<?php

namespace app\admin\service;
use app\admin\service\ThemesService;

class FieldSetService
{
	
	//创建数据库表
	public static function createTable($data){
		
		$sql=" CREATE TABLE IF NOT EXISTS `".config('database.prefix')."ext_".$data['table_name']."` ( ";
		$sql .= '
				`data_id` int(10) NOT NULL AUTO_INCREMENT ,
				PRIMARY KEY (`data_id`)
				) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
			';
			
		$statusSql = db()->query($sql);
		
		if($data['type'] == 1){
			$propertyField = self::propertyField();
			$property = $propertyField[2];
			$sql = "ALTER TABLE ".config('database.prefix').'ext_'."{$data['table_name']} ADD content_id {$property['name']}({$property['maxlen']}{$property['decimal']}) DEFAULT NULL";
		}
		$statusSql = db()->query($sql);
		return $statusSql;
	}
	
	//修改数据库名
	public static function updateTable($info,$data){
		
		$sql="ALTER TABLE ".config('database.prefix')."ext_".$info['table_name']." RENAME TO ".config('database.prefix')."ext_".$data['table_name'];
		
        $statusSql = db()->query($sql);
		return $statusSql;
	}
	
	//插入字段
	public static function createField($data){
		
		$typeField = self::typeField();
        $propertyField = self::propertyField();
        $typeData = $typeField[$data['type']];
        $property = $propertyField[$typeData['property']];
        if($property['decimal']){
            $property['decimal']=','.$property['decimal'];
        }else{
            $property['decimal']='';
        }
		
		$info = model("Extend")->getInfo($data['extend_id']);
		
		$fields = explode('|',$data['field']);
		
		foreach($fields as $key=>$val){
			$sql="ALTER TABLE ".config('database.prefix')."ext_{$info['table_name']} ADD ".$val." {$property['name']}({$property['maxlen']}{$property['decimal']}) DEFAULT NULL";
			
			$statusSql = db()->query($sql);
		}
		
		return $statusSql;
	}
	
	//修改字段
	public static function updateField($info,$data){
		
		$typeField = self::typeField();
        $propertyField = self::propertyField();
        $typeData = $typeField[$data['type']];
        $property = $propertyField[$typeData['property']];
        if($property['decimal']){
            $property['decimal']=','.$property['decimal'];
        }else{
            $property['decimal']='';
        }
		
		$fieldInfo =$info;
		$info = model("Extend")->getInfo($fieldInfo['extend_id']);
		
		$fields = explode('|',$data['field']);
		$tableFileds = explode('|',$fieldInfo['field']);
		foreach($fields as $key=>$val){			
				if($val !== $v){
					$sql="ALTER TABLE ".config('database.prefix').'ext_'."{$info['table_name']} CHANGE {$tableFileds[$key]} {$fields[$key]} {$property['name']}({$property['maxlen']}{$property['decimal']})";
					$statusSql = db()->query($sql);	
				}	
				
		}
		
		return $statusSql;
	}
	
	//字段属性
	public static function typeField(){
		
		$list=array(
            1=> array(
                'name'=>'文本框',
                'property'=>1,
                ),
            2=> array(
                'name'=>'下拉框',
                'property'=>3,
                ),
            3=> array(
                'name'=>'单选框',
                'property'=>3,
                ),
            4=> array(
                'name'=>'多选框',
                'property'=>1,
                ),
            6=> array(
                'name'=>'文本域',
                'property'=>4,
                ),
            7=> array(
                'name'=>'日期框',
                'property'=>2,
                ),
            8=> array(
                'name'=>'单图上传',
                'property'=>1,
                ),
			9=> array(
                'name'=>'多图上传',
                'property'=>4,
                ),
			10=> array(
                'name'=>'文件上传',
                'property'=>4,
                ),
            11=> array(
                'name'=>'编辑器(xheditor)',
                'property'=>4,
                ),
			12=> array(
                'name'=>'创建时间(后台录入)',
                'property'=>2,
                ),
			16=> array(
                'name'=>'编辑器(ueditor)',
                'property'=>4,
                ),
			13=> array(
                'name'=>'货币',
                'property'=>5,
                ),
			17=> array(
                'name'=>'省市区三级联动',
                'property'=>1,
                ),
			18=> array(
                'name'=>'颜色选择器',
                'property'=>1,
                ),
			20=> array(
                'name'=>'IP',
                'property'=>1,
                ),
            
        );
        return $list;
	}
	
	
	//字段的sql属性
    public static function propertyField()
    {
        $list=array(
            1=> array(
                'name'=>'varchar',
                'maxlen'=>250,
                'decimal'=>0,
                ),
            2=> array(
                'name'=>'int',
                'maxlen'=>10,
                'decimal'=>0,
                ),
			3=> array(
                'name'=>'tinyint',
                'maxlen'=>4,
                'decimal'=>0,
                ),
            4=> array(
                'name'=>'text',
                'maxlen'=>0,
                'decimal'=>0,
                ),
            5 => array(
                'name'=>'decimal',
                'maxlen'=>10,
                'decimal'=>2,
                ),
        );
        return $list;
    }
	
	
	public function getFieldData($fieldInfo){
		
		switch($fieldInfo['type']){
			
			//文本框
			case 1:
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div class=\"col-sm-9\">\n";
				if(!isset($fieldInfo['data_id']) && !isset($fieldInfo['content_id']) && !empty($fieldInfo['default_value'])){
					$defaultValue = $fieldInfo['default_value'];
				}else{
					$defaultValue = $fieldInfo['value'];
				}
				$str .="							<input type=\"text\" id=\"".$fieldInfo['field']."\" value=\"".$defaultValue."\" name=\"".$fieldInfo['field']."\" class=\"form-control\" placeholder=\"请输入".$fieldInfo['name']."\">\n";
				if(!empty($fieldInfo['note'])){
					$str .="							<span class=\"help-block m-b-none\">".$fieldInfo['note']."</span>\n";
				}
				
				$str .="						</div>\n";
				$str .="					</div>\n";
			break;
			
			//下拉框
			case 2:
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div class=\"col-sm-9\">\n";
				
				if(!isset($fieldInfo['data_id']) && !isset($fieldInfo['content_id']) && !empty($fieldInfo['default_value'])){
					$defaultValue = $fieldInfo['default_value'];
				}else{
					$defaultValue = $fieldInfo['value'];
				}
				
				$str .="							<select lay-ignore name=\"".$fieldInfo['field']."\" class=\"form-control\" id=\"".$fieldInfo['field']."\">\n";
				$str .="								<option value=\"\">请选择</option>\n";
				$searchArr = explode(',',$fieldInfo['config']);
				if($searchArr){
					foreach($searchArr as $k=>$v){
						$varArr = explode('|',$v);
						if($defaultValue == $varArr[1]){
							$str .= "								<option selected value=\"".$varArr[1]."\">".$varArr[0]."</option>\n";
						}else{
							$str .= "								<option value=\"".$varArr[1]."\">".$varArr[0]."</option>\n";
						}
					}
				}
				
				$str .= "							</select>\n";
				if(!empty($fieldInfo['note'])){
					$str .="							<span class=\"help-block m-b-none\">".$fieldInfo['note']."</span>\n";
				}
				
				$str .="						</div>\n";
				$str .="					</div>\n";
			break;
			
			//单选框
			case 3:
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div class=\"col-sm-9\">\n";
				
				if(!isset($fieldInfo['data_id']) && !isset($fieldInfo['content_id']) && !empty($fieldInfo['default_value'])){
					$defaultValue = $fieldInfo['default_value'];
				}else{
					$defaultValue = $fieldInfo['value'];
				}

				$valArr = explode(',',$fieldInfo['config']);
				
				if($valArr){
					foreach($valArr as $k=>$v){
						$varArr = explode('|',$v);
						if($defaultValue == $varArr[1]){
							$str .= "							<input name=\"".$fieldInfo['field']."\" value=\"".$varArr[1]."\" type=\"radio\" checked title=\"".$varArr[0]."\">\n";
						}else{
							$str .= "							<input name=\"".$fieldInfo['field']."\" value=\"".$varArr[1]."\" type=\"radio\" title=\"".$varArr[0]."\">\n";
						}
						
					}
				}
				
				
				if(!empty($fieldInfo['note'])){
					$str .="							<span class=\"help-block m-b-none\">".$fieldInfo['note']."</span>\n";
				}
				
				$str .="						</div>\n";
				$str .="					</div>\n";
			break;
			
			//复选框
			case 4:
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div class=\"col-sm-9\">\n";
				
				if(!isset($fieldInfo['data_id']) && !isset($fieldInfo['content_id']) && !empty($fieldInfo['default_value'])){
					$defaultValue = $fieldInfo['default_value'];
				}else{
					$defaultValue = $fieldInfo['value'];
				}
						
				$searchArr = explode(',',$fieldInfo['config']);
				
				if($searchArr){
					foreach($searchArr as $k=>$v){
						$varArr = explode('|',$v);
						if(in_array($varArr[1],explode(',',$defaultValue))){
							$str .= "								<input name=\"".$fieldInfo['field']."\" checked value=\"".$varArr[1]."\" type=\"checkbox\" title=\"".$varArr[0]."\">\n";
						}else{
							$str .= "								<input name=\"".$fieldInfo['field']."\" value=\"".$varArr[1]."\" type=\"checkbox\" title=\"".$varArr[0]."\">\n";
						}
					}
				}
				
				if(!empty($fieldInfo['note'])){
					$str .="							<span class=\"help-block m-b-none\">".$fieldInfo['note']."</span>\n";
				}
				
				$str .="						</div>\n";
				$str .="					</div>\n";
			break;
			
			
			//文本域
			case 6:
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div class=\"col-sm-9\">\n";
				if(!isset($fieldInfo['data_id']) && !isset($fieldInfo['content_id']) && !empty($fieldInfo['default_value'])){
					$defaultValue = $fieldInfo['default_value'];
				}else{
					$defaultValue = $fieldInfo['value'];
				}
				$str .="							<textarea id=\"".$fieldInfo['field']."\" name=\"".$fieldInfo['field']."\"  class=\"form-control\" placeholder=\"请输入".$fieldInfo['name']."\">".$defaultValue."</textarea>\n";
				if(!empty($fieldInfo['note'])){
					$str .="							<span class=\"help-block m-b-none\">".$fieldInfo['note']."</span>\n";
				}
				
				$str .="						</div>\n";
				$str .="					</div>\n";
			break;
			
			//日期选择框
			case 7:
				
				if(!isset($fieldInfo['data_id']) && !isset($fieldInfo['content_id'])){
					$defaultValue = date('Y-m-d H:i:s');
				}else{
					if(!empty($fieldInfo['value'])){
						$defaultValue = date('Y-m-d H:i:s',$fieldInfo['value']);
					}
				}
				
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div class=\"col-sm-9\">\n";

				$str .="							<input type=\"text\" value=\"".$defaultValue."\" name=\"".$fieldInfo['field']."\"  placeholder=\"请输入".$fieldInfo['name']."\" class=\"form-control layer-date\" onclick=\"laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})\" id=\"".$fieldInfo['field']."\">\n";
				
				
				if(!empty($fieldInfo['note'])){
					$str .="							<span class=\"help-block m-b-none\">".$fieldInfo['note']."</span>\n";
				}
				
				$str .="						</div>\n";
				$str .="					</div>\n";
			break;
			
			//单图上传
			case 8:
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div class=\"col-sm-6\">\n";
				if(!isset($fieldInfo['data_id']) && !isset($fieldInfo['content_id']) && !empty($fieldInfo['default_value'])){
					$defaultValue = $fieldInfo['default_value'];
				}else{
					$defaultValue = $fieldInfo['value'];
				}
				$str .="							<input type=\"text\" id=\"".$fieldInfo['field']."\" value=\"".$defaultValue."\" name=\"".$fieldInfo['field']."\" class=\"form-control\" placeholder=\"请输入".$fieldInfo['name']."\">\n";
				
				if(!empty($fieldInfo['note'])){
					$str .="							<span class=\"help-block m-b-none\">".$fieldInfo['note']."</span>\n";
				}
				
				$str .="						</div>\n";
				$str .="						<div class=\"col-sm-2\" style=\"position:relative; right:30px;\">\n";
				$str .="							<span id=\"".$fieldInfo['field']."_upload\"></span>\n";
				$str .="						</div>\n";
				$str .="					</div>\n";
			break;
			
			//多图上传
			case 9:
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div class=\"col-sm-6\">\n";
				if(!isset($fieldInfo['data_id']) && !isset($fieldInfo['content_id']) && !empty($fieldInfo['default_value'])){
					$defaultValue = $fieldInfo['default_value'];
				}else{
					$defaultValue = $fieldInfo['value'];
				}
				$str .="							<input type=\"text\" id=\"".$fieldInfo['field']."\" value=\"".$defaultValue."\" name=\"".$fieldInfo['field']."\" class=\"form-control\" placeholder=\"请输入".$fieldInfo['name']."\">\n";
				
				
				$str .="							<div class=\"pic_list\">\n";
				$str .="							</div>\n";
				
				
				$str .="						</div>\n";
				$str .="						<div class=\"col-sm-3\" style=\"position:relative; right:30px;\">\n";
				$str .="							<span id=\"".$fieldInfo['field']."_upload\"></span>\n";
				$str .="						</div>\n";
				$str .="					</div>\n";
			break;
			
			//文件上传
			case 10:
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div class=\"col-sm-6\">\n";
				if(!isset($fieldInfo['data_id']) && !isset($fieldInfo['content_id']) && !empty($fieldInfo['default_value'])){
					$defaultValue = $fieldInfo['default_value'];
				}else{
					$defaultValue = $fieldInfo['value'];
				}
				$str .="							<input type=\"text\" id=\"".$fieldInfo['field']."\" value=\"".$defaultValue."\" name=\"".$fieldInfo['field']."\" class=\"form-control\" placeholder=\"请输入".$fieldInfo['name']."\">\n";
				
				if(!empty($fieldInfo['note'])){
					$str .="							<span class=\"help-block m-b-none\">".$fieldInfo['note']."</span>\n";
				}
				
				$str .="						</div>\n";
				$str .="						<div class=\"col-sm-2\" style=\"position:relative; right:30px;\">\n";
				$str .="							<span id=\"".$fieldInfo['field']."_upload\"></span>\n";
				$str .="						</div>\n";
				$str .="					</div>\n";
			break;
			
			//xheditor编辑器
			case 11:
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div class=\"col-sm-9\">\n";
				if(!isset($fieldInfo['data_id']) && !isset($fieldInfo['content_id']) && !empty($fieldInfo['default_value'])){
					$defaultValue = $fieldInfo['default_value'];
				}else{
					$defaultValue = $fieldInfo['value'];
				}
				$str .="								<textarea id=\"".$fieldInfo['field']."\" name=\"".$fieldInfo['field']."\" style=\"width: 100%; height:300px;\">".$defaultValue."</textarea>\n";
				$str .="								<script type=\"text/javascript\">$('#".$fieldInfo['field']."').xheditor({html5Upload:false,upLinkUrl:\"".url('admin/Upload/editorUpload',['immediate'=>1])."\",upLinkExt:\"zip,rar,txt,doc,docx,pdf,xls,xlsx\",tools:'simple',upImgUrl:\"".url('admin/Upload/editorUpload',['immediate'=>1])."\",upImgExt:\"jpg,jpeg,gif,png\"});</script>\n";
				
				if(!empty($fieldInfo['note'])){
					$str .="							<span class=\"help-block m-b-none\">".$fieldInfo['note']."</span>\n";
				}
				
				$str .="						</div>\n";
				$str .="					</div>\n";
			break;
			
			//货币
			case 13:
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div class=\"col-sm-9\">\n";
				if(!isset($fieldInfo['data_id']) && !isset($fieldInfo['content_id']) && !empty($fieldInfo['default_value'])){
					$defaultValue = $fieldInfo['default_value'];
				}else{
					$defaultValue = $fieldInfo['value'];
				}
				$str .="							<input type=\"text\" id=\"".$fieldInfo['field']."\" value=\"".$defaultValue."\" name=\"".$fieldInfo['field']."\" class=\"form-control\" placeholder=\"请输入".$fieldInfo['name']."\">\n";
				if(!empty($fieldInfo['note'])){
					$str .="							<span class=\"help-block m-b-none\">".$fieldInfo['note']."</span>\n";
				}
				
				$str .="						</div>\n";
				$str .="					</div>\n";
			break;
			
			
			//百度编辑器
			case 16:
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div class=\"col-sm-9\">\n";
				if(!isset($fieldInfo['data_id']) && !isset($fieldInfo['content_id']) && !empty($fieldInfo['default_value'])){
					$defaultValue = $fieldInfo['default_value'];
				}else{
					$defaultValue = $fieldInfo['value'];
				}
				$str .="							<script id=\"".$fieldInfo['field']."\" type=\"text/plain\" name=\"".$fieldInfo['field']."\" style=\"width:100%;height:300px;\">".$defaultValue."</script>\n";
				$str .="							<script type=\"text/javascript\">\n";
				$str .="								var ue = UE.getEditor('".$fieldInfo['field']."');\n";
				$str .="								scaleEnabled:true\n";
				$str .="							</script>\n";
				if(!empty($fieldInfo['note'])){
					$str .="							<span class=\"help-block m-b-none\">".$fieldInfo['note']."</span>\n";
				}
				
				$str .="						</div>\n";
				$str .="					</div>\n";
			break;
			
			//地区三级联动
			case 17:
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div id=\"distpicker5\">\n";
				
				foreach(explode("|",$fieldInfo['field']) as $k=>$v){
					if($k == '0'){
						$areaTitle = 'province';
					}elseif($k == '1'){
						$areaTitle = 'city';
					}elseif($k == '2'){
						$areaTitle = 'district';
					}
					$str .="							<div class=\"col-sm-3\">\n";
					if(!isset($fieldInfo['content_id']) && !empty($fieldInfo['default_value'])){
						$defaultValue = explode('|',$fieldInfo['default_value']);	
					}
					$str .="								<select lay-ignore id=\"".$v."\" class=\"form-control\" data-".$areaTitle."=\"".$fieldInfo[$v]."\"></select>\n";
					$str .="							</div>\n";
				}	
				
				$str .="						</div>\n";
				$str .="					</div>\n";
				$str .="					<script src=\"/static/js/plugins/shengshiqu/distpicker.data.js\"></script>\n";
				$str .="					<script src=\"/static/js/plugins/shengshiqu/distpicker.js\"></script>\n";
				$str .="					<script src=\"/static/js/plugins/shengshiqu/main.js\"></script>\n";
			break;
			
			//颜色选择器
			case 18:
				$str .="					<div class=\"form-group\">\n";
				$str .="						<label class=\"col-sm-2 control-label\">".$fieldInfo['name']."：</label>\n";
				$str .="						<div id=\"mycp\">\n";
				$str .="							<div class=\"col-sm-8\">\n";
				if(!isset($fieldInfo['data_id']) && !isset($fieldInfo['content_id']) && !empty($fieldInfo['default_value'])){
					$defaultValue = $fieldInfo['default_value'];
				}else{
					$defaultValue = $fieldInfo['value'];
				}
				$str .="								<input type=\"text\" id=\"".$fieldInfo['field']."\" value=\"".$defaultValue."\" name=\"".$fieldInfo['field']."\" class=\"form-control\" placeholder=\"请输入".$fieldInfo['name']."\">\n";
				if(!empty($fieldInfo['note'])){
					$str .="								<span class=\"help-block m-b-none\">".$fieldInfo['note']."</span>\n";
				}
				$str .="							</div>\n";
				$str .="							<div class=\"col-sm-1\">\n";
				$str .="								<span style=\"border:none; margin-left:-30px;  padding:0;\" class=\"input-group-addon col-sm-2\"><i style=\"width:32px; height:32px;\"></i></span>\n";
				
				$str .="							</div>\n";
				$str .="						</div>\n";
				$str .="					</div>\n";
				
				$str .="					<link href=\"/static/js/plugins/colorpicker/bootstrap-colorpicker.css\" rel=\"stylesheet\">\n";
				$str .="					<script src=\"/static/js/plugins/colorpicker/bootstrap-colorpicker.js\"></script>\n";
				$str .="					<script type=\"text/javascript\">\n";
				$str .="					$(function () {\n";
				$str .="						$('#mycp').colorpicker();\n";
				if(empty($defaultValue)){
					$str .="							$('#".$fieldInfo['field']."').val('');\n";
				}
				$str .="					});\n";
				$str .="					</script>\n";
			break;
			
		
		}
		
		return $str;
	}
	
	
	
	
}

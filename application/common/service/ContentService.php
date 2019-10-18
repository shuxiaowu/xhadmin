<?php

namespace app\common\service;

use think\Validate;

class ContentService
{
	
	//加载默认数据
    public static function loadList($where,$field,$limit,$orderby){
	
		try{
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
		
			$list = model('Content')->loadList($where,$field,$limit,$orderby);
			$count = model('Content')->countList($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$list,'count'=>$count];	
	}
	
	//关联查询
    public static function loadRelateList($where,$field,$limit,$orderby){
	
		try{
			foreach( $where as $k=>$v){   
				if( !$v )   
					unset( $where[$k] );   
			}
		
			$result = model('Content')->loadRelateList($where,$field,$limit,$orderby);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return ['list'=>$result['list'],'count'=>$result['count']];	
	}
	
	//添加或者编辑数据
	public static function saveData($type,$data){
		
		try{
			if(!$data){
				return false;
			}
			
			$rule = [];
			$rule = [
				['title','require','标题不能为空'],
				['class_id','require','栏目不能为空'],
			];
			
			$validate = new Validate($rule);			
			if (!$validate->check($data)) {
				throw new \Exception($validate->getError());
			}
			
			if($type == 'add'){
				$data['create_time'] = time();
				$reset = model('Content')->createData($data);
				if($reset){
					model('Content')->edit(['content_id'=>$reset,'sortid'=>$reset]);
				}
				$data['content_id'] = $reset;
				self::saveExtData($data);
			}elseif($type == 'edit'){
				if(empty($data['content_id'])){
					return false;
				}
				$data['create_time'] = strtotime($data['create_time']);
				$reset = model('Content')->edit($data);
				self::saveExtData($data);
				
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;
		
	}
	
	//更新拓展表信息
	 public static function saveExtData($data){
		 
        $classId = $data['class_id'];
        $fieldsetInfo = model("Catagory")->getInfo($classId);
		
		try{
			if(!empty($fieldsetInfo['module_id'])){
				
				$fieldList = model('Field')->loadAll(['extend_id'=>$fieldsetInfo['module_id'],'status'=>1]);
				foreach($fieldList as $k=>$v){
					if($v['type'] == 7){
						$data[$v['field']] = strtotime($data[$v['field']]);
					}
				}
				
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
				
				$extInfo = model('Extend')->getInfo($fieldsetInfo['module_id']);
				model('FormData')->setTable('ext_'.$extInfo['table_name']);
				model('FormData')->setPk('content_id');
					
				if(!model('FormData')->getInfo($data['content_id'])){
					model('FormData')->createData($data);
				}else{
					model('FormData')->editWhere(['content_id'=>$data['content_id']],$data);
				}	
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
        
        return true;
    }
	
	//按条件修改
	public static function editWhere($where,$data){
	
		try{
			$reset = model('Content')->editWhere($where,$data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//按主键修改
	public static function edit($data){
	
		try{
			$reset = model('Content')->edit($data);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	
	//批量删除
	public static function delete($where){
	
		try{
			$contentInfo = db('content')->alias('a')->join('catagory b','a.class_id=b.class_id')->where(['a.content_id'=>$where['content_id']])->find();
			if($contentInfo['module_id']){
				$extInfo = model('Extend')->getInfo($contentInfo['module_id']);
				model('FormData')->setTable('ext_'.$extInfo['table_name']);
				model('FormData')->setPk('content_id');
				
				model("FormData")->delete($where);
				
			}
			$reset = model('Content')->delete($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//批量设置推荐位
	public static function setPosition($content_id,$position_id){
	
		try{
			$contentInfo = model('Content')->getInfo($content_id);
			if($contentInfo){
				if(strpos($contentInfo['position'],$position_id) == false){
					$data['position'] = $contentInfo['position'].','.$position_id;
					$data['content_id'] = $content_id;
					model('Content')->edit($data);
				}
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	//批量设置推荐位
	public static function delPosition($content_id,$position_id){
	
		try{
			$contentInfo = model('Content')->getInfo($content_id);
			if($contentInfo['position']){
				$data['position'] = rtrim(str_replace($position_id.',','',$contentInfo['position'].','),',');
				$data['content_id'] = $content_id;
				model('Content')->edit($data);
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}
	
	
	//获取推荐位的名称
	public static function getPositionName($position,$content_id){
		if(!$position) {
			return;
		}
		
		$where['position_id'] = ['in',$position];
		$list = db("position")->where($where)->select();
		
		if($list){
			foreach($list as $k=>$v){
				$title .= '<a style="color:red" title="点击删除" href="javascript:void(0)" onclick="CodeGoods.delPosition('.$v['position_id'].','.$content_id.')">'.$v['title'].'</a>,';
			}
			
		}
		$title = rtrim($title,',');
		return '<font color="red">['.$title.']</font>';
	}
	
	//生成树级结构列表 递归的方法
	public static function getSubClass($pid){
		$list = db("Catagory")->where(['pid'=>$pid])->field('class_id,pid,class_name,class_id as childs')->select();
		foreach($list as $key=>$val){
			$sublist = db("Catagory")->where(['pid'=>$val['class_id']])->field('class_id,pid,class_name,class_id as childs')->select();
			if($sublist){
				$childs = model('index/Catagory')->getSubClassId($val['class_id']);
				$list[$key]['childs'] = $childs;
				$list[$key]['spread'] = !is_null(config('content_menu_status')) ? config('content_menu_status') : true;
				$list[$key]['children'] = self::getSubClass($val['class_id']);
				foreach($list[$key]['children'] as $k=>$v){
					if(!$v['childs']){
						$list[$key]['children'][$k]['childs'] = $v['class_id'];
					}
				}	
			}
		}
		
		return $list;
	}
	
	
	//获取拓展内容信息
	public static function getExtDataInfo($classId,$content_id){
		if(empty($classId) || empty($content_id)){
			return;
		}
		
		$extInfo = model('admin/Extend')->getInfo($classId);
		model('admin/FormData')->setTable('ext_'.$extInfo['table_name']);
		model('admin/FormData')->setPk('content_id');
		
		$extInfo = model('admin/FormData')->getInfo($content_id);
		return $extInfo;
		
	}
	

	
	
}

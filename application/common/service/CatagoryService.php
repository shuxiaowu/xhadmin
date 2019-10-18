<?php

namespace app\common\service;

use think\Validate;

class CatagoryService
{
	
	//批量删除
	public static function delete($where){
	
		try{	
			$reset = model('Catagory')->delete($where);
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;	
	}


	//添加或者编辑数据
	public static function saveData($type,$data){
	
		try{
			if(!$data){
				return false;
			}
			
			$rule = [];
			$rule = [
				['class_name','require','栏目名称不能为空'],
			];
			
			$validate = new Validate($rule);			
			if (!$validate->check($data)) {
				throw new \Exception($validate->getError());
			}
			
			if($type == 'add'){
				$filepath = self::getFilepath($data['class_name'],$data['class_id']);
				if(empty($data['filepath'])){
					$filepath = rtrim(config('filepath'),'/').'/'.$filepath;
				}else{
					$filepath = $data['filepath'].'/'.$filepath;
				}
				$data['filepath'] = $filepath;
				$reset = model('Catagory')->createData($data);
				if($reset){
					model('Catagory')->edit(['class_id'=>$reset,'sortid'=>$reset]);
				}
			}elseif($type == 'edit'){
				if(empty($data['class_id'])){
					return false;
				}
				if(empty($data['filepath']) || empty($data['filename'])){
					$data['filename'] = 'index.html';
					$data['filepath'] = rtrim(config('filepath'),'/').'/'.self::getFilepath($data['class_name'],$data['class_id']);
				}
				$reset = model('Catagory')->edit($data);
				
			}
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}
			
		return $reset;
		
	}
	
	//排序上下移动
	public static function setSort($class_id,$type){
		$data = model("Catagory")->getInfo($class_id);

		if($type == 1){
			$map['sortid']  = array('lt',$data['sortid']);
			$map['pid'] = $data['pid'];
			$info = model("Catagory")->getWhereInfo($map,$orderby='sortid desc');
		}else{
			$map['sortid']  = array('gt',$data['sortid']);
			$map['pid'] = $data['pid'];
			$info = model("Catagory")->getWhereInfo($map,$orderby='sortid asc');
		}
		
		if(!$info)
		{
		    return false;
		}else{
		   try{
			    $selfMap['class_id'] = $class_id;
				$targetMap['class_id'] = $info['class_id'];
				$r1 = db("Catagory")->where($selfMap)->setField(array('sortid'=>$info['sortid']));
				$r2 = db("Catagory")->where($targetMap)->setField(array('sortid'=>$data['sortid']));
		   }catch(\Exception $e){
				throw new \Exception($e->getMessage());
			}
		   return true;
		}
	}
	
	
	/**
     * 获取当前模板文件
     * @return array 文件列表
     */
    public static function tplList($default_themes)
    {
        $tplDir=APP_PATH.'/index/view/'.$default_themes;
        if(!is_dir($tplDir)){
            return false;
        }
        $listFile=scandir($tplDir);
        if(is_array($listFile)){
            $list=array();
            foreach ($listFile as $key => $value) {
                if ($value != "." && $value != "..") {
                    $list[$key]['file']=$value;
                    $list[$key]['name']=substr($value, 0, -5);
                }
            }
        }
        return $list;
    }
	
	 /**
     * 栏目拼音转换
     * @return string 栏目拼音
     */
    public static function getFilepath($classname,$classId)
    {
		$classname = preg_replace('/\s+/', '-', $classname);
		$pattern = '/[^\x{4e00}-\x{9fa5}\d\w\-]+/u';
		$classname = preg_replace($pattern, '', $classname);
		$filepath = substr(\app\common\org\Pinyin::output($classname, true),0,30);
		$filepath = trim($filepath,'-');
        
        //返回数据
        $where = [];
        if (!empty($classId))
        {
            $where['class_id'] = ['NEQ',$classId];
        }
        $where['filepath'] = $filepath;
        $info = model('Catagory')->getWhereInfo($where,'class_id desc'); 
        if(empty($info))
        {
            return $filepath;
        }else{
            return $filepath.rand(1,9);
        }
    }
	

	
	
}

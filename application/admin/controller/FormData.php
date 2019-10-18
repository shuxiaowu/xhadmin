<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\common\service\CommonService;
use app\admin\service\FormDataService;
use think\Request;
use think\Cache;

class FormData extends Admin {

	
	//表单管理的权限要单独拿出来验证
	function __construct(){
		
		parent::__construct();
		$this->request = Request::instance();
		$action = $this->request->action();
		$extend_id = input('param.extend_id','','intval');
		
		if(session('admin.role') == 2 && !in_array('/admin/FormData/'.$action.'/extend_id/'.$extend_id.'.html',session('admin.nodes')) ){
			$this->error('你没有权限访问',url('/admin/Index/main'));
		}	
	}
	
	/*数据列表*/
	function index(){
		
		$extend_id = input('param.extend_id','','intval');
		!$extend_id && $this->error('参数错误');

			
		if (!$this->request->isAjax()){
			$fieldList =  model('Field')->loadAll(['extend_id'=>$extend_id,'status'=>1,'list_show'=>1]);
			$searchList = model('Field')->loadAll(['extend_id'=>$extend_id,'status'=>1,'is_search'=>1]);
			
			$this->assign('extendInfo',model('Extend')->getInfo($extend_id));
			$this->assign('formStr',FormDataService::getTableList($fieldList));
			$this->assign('searchGroup',FormDataService::getSearchGroup($searchList));
			$this->assign('queryParam',FormDataService::getQueryParam($searchList));
			$this->assign('extend_id',$extend_id);
			return $this->fetch('index');
		}else{
			
			$limit  = input('post.limit', 0, 'intval');
			$offset = input('post.offset', 0, 'intval');
			$page   = floor($offset / $limit) +1 ;
			
			$limit = ($page-1) * $limit.','.$limit;
			try{
				$where= [];
				
				$searchList = model('Field')->loadAll(['extend_id'=>$extend_id,'status'=>1,'is_search'=>1]);
				if($searchList){
					foreach($searchList as $k=>$v){
						if($v['type'] == 12){
							$startTime = input('param.startTime', '', 'strip_tags');
							$endTime = input('param.endTime', '', 'strip_tags');
							$where[$v['field']] = CommonService::getTimeWhere($startTime,$endTime);
						}else if($v['type'] == 17){
							foreach(explode('|',$v['field']) as $m=>$n){
								$where[$n] = input('param.'.$n.'', '', 'strip_tags');
							}
						}else{
							$where[$v['field']] = input('param.'.$v['field'].'', '', 'strip_tags');
						}	
					}
				}
				
				$extendInfo = model('Extend')->getInfo($extend_id);
				if($extendInfo['orderby']){
					$orderby = $extendInfo['orderby']; 
				}else{
					$orderby = 'data_id desc';
				}
				$res = FormDataService::loadList($where,$field='*',$limit,$extend_id,$orderby);
			}catch(\Exception $e){
				exit($e->getMessage());
			}
			$list = $res['list'];
			$data['rows']  = $list;
			$data['total'] = $res['count'];

			exit(json_encode($data));
		}
	}
	
	/*删除数据*/
	function delete(){
		$idx =  $this->request->post('data_ids', '', 'strval');
		$extend_id =  $this->request->post('extend_id', '', 'strval');
		empty($idx) || empty($extend_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
		try{
			$where = [];
			$where['data_id'] = array('in',$idx);
			$res = FormDataService::delete($where,$extend_id);
		}catch(\Exception $e){
			exit(json_encode(array('status'=>'02','msg'=>$e->getMessage())));
		}
		echo json_encode(array('status'=>'00','msg'=>'操作成功'));
	}
	
	
	/*创建数据*/
	function add(){
		if (!$this->request->isPost()){
			$extend_id =  input('param.extend_id','','intval');
			empty($extend_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
			
			$htmlstr = '';
			
			$fieldList = model('Field')->loadAll(['extend_id'=>$extend_id,'status'=>1]);
			!$fieldList && $this->error('没有拓展信息');
			foreach($fieldList as $key=>$val){
				$htmlstr .= \app\admin\service\FieldSetService::getFieldData($val);
			}
			$this->assign('extend_id',$extend_id);
			$this->assign('formStr',$htmlstr);
			return $this->fetch('info');
		}else{
			$data = input('post.');
			try {
				$fieldList = model('Field')->loadAll(['extend_id'=>$data['extend_id'],'status'=>1]);
				!$fieldList && $this->error('没有拓展信息');
				$res = FormDataService::saveData('add',$data,$fieldList);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'添加成功'));
		}
	}
	
	/*修改数据*/
	function update(){
		if (!$this->request->isPost()){
			$extend_id =  input('param.extend_id','','intval');
			$data_id =  input('param.data_id','','intval');
			empty($extend_id) || empty($data_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
			
			$extFormInfo = FormDataService::getInfo($extend_id,$data_id);
			
			!$extFormInfo && !$fieldList && $this->error('没有拓展信息');
			
			$htmlstr = '';
			$fieldList = model('Field')->loadAll(['extend_id'=>$extend_id,'status'=>1]);
			foreach($fieldList as $key=>$val){
				
				if($val['type'] == 17){
					$areaVal = explode('|',$val['field']);
					$val['province'] = $extFormInfo[$areaVal[0]];
					$val['city'] = $extFormInfo[$areaVal[1]];
					$val['district'] = $extFormInfo[$areaVal[2]];
				}else{
					$val['value'] = $extFormInfo[$val['field']];
				}
				
				$val['data_id'] = $data_id;

				$htmlstr .= \app\admin\service\FieldSetService::getFieldData($val);
					
			}
			$this->assign('data_id',$data_id);
			$this->assign('extend_id',$extend_id);
			$this->assign('formStr',$htmlstr);
			$this->assign('fieldList',$fieldList);
			return $this->fetch('info');
		}else{
			$data = input('post.');
			try {
				$fieldList = model('Field')->loadAll(['extend_id'=>$data['extend_id'],'status'=>1]);
				$res = FormDataService::saveData('edit',$data,$fieldList);
			} catch (\Exception $e) {
				$this->error($e->getMessage());
			}
			echo json_encode(array('status'=>'00','message'=>'添加成功'));
		}
	}
	
	//查看数据方法
	public function view(){
		$extend_id =  input('param.extend_id','','intval');
		$data_id =  input('param.data_id','','intval');
		empty($extend_id) || empty($data_id) && exit(json_encode(array('status'=>'01','msg'=>'参数错误')));
		$extFormInfo = FormDataService::getInfo($extend_id,$data_id);
		
		!$extFormInfo && $this->error('没有拓展信息');;
		
		$fieldList = model('Field')->loadAll(['extend_id'=>$extend_id,'status'=>1]);
		foreach($fieldList as $key=>$val){	
			if($val['type'] == 17){
				$areaVal = explode('|',$val['field']);
				$fieldList[$key]['province'] = $extFormInfo[$areaVal[0]];
				$fieldList[$key]['city'] = $extFormInfo[$areaVal[1]];
				$fieldList[$key]['district'] = $extFormInfo[$areaVal[2]];
			}else{
				$fieldList[$key]['value'] = $extFormInfo[$val['field']];
			}
			$fieldList[$key]['value'] = $extFormInfo[$val['field']];		
		}
		$this->assign('formStr',FormDataService::getView($fieldList));
		return $this->fetch('view');
	}
	
	
	//数据导出
	public function dumpData(){
		$data = input('param.');
		empty($data['extend_id']) && $this->error('模块ID不能为空');
		try {
			$res = FormDataService::dumpData($data);
		} catch (\Exception $e) {
			$this->error($e->getMessage());
		}
	}
	
	//数据导入
	public function importData(){
		if ($this->request->isPost()) {
			try{
				$extend_id = $this->request->get('extend_id','','intval');
				empty($extend_id) && $this->error('模块ID不能为空');
				
				$result = FormDataService::importData();
				foreach($result[1] as $key=>$val){ 
					$fields .= $val.',';
				}
				$where['extend_id'] = $extend_id;
				$where['name'] = ['in',$fields];
				$list = model("Field")->loadAll($where);
				foreach($list as $key=>$val){
					$field[] = $val['field'];
				}
				$fieldInfo = model("Field")->getWhereInfo(['extend_id'=>$extend_id,'type'=>12],'id desc');
			}catch(\Exception $e){
				$this->error($e->getMessage());
			}
			if (count($result) > 0) {
				$extendInfo = model('Extend')->getInfo($extend_id);
				$this->redirect('startImport',['field'=>implode(',',$field),'table'=>$extendInfo['table_name'],'timeField'=>$fieldInfo['field']]);
			} else{
				$this->error('内容格式有误！');
			}
		}else {
			return $this->fetch('base/importData');
		}
	}
	
	
	//开始导入
	function startImport(){
		if(!$this->request->isPost()) {
			$field = input('param.field','','strval');
			$timeField = input('param.timeField','','strval');
			$tableName = input('param.table','','strval');
			$this->assign('fields',$field);
			$this->assign('tableName',$tableName);
			$this->assign('timeField',$timeField);
			$this->assign('url',url('admin/FormData/startImport'));
			return $this->fetch('base/startImport');
		}else{
			$p = input('param.p', '', 'intval'); 
			$field = input('param.field','','strval');
			$timeField = input('param.timeField','','strval');
			$tableName = input('param.tableName','','strval');
			$data = Cache::get('FormData');
			$num = count($data);
			if($data){
				if($data[$p]){
					$fieldArr = explode(',',$field);
					$dt['percent'] = ceil(($p+1)/$num*100);
					foreach($fieldArr as $key=>$val){
						if($data[$p+1][$key]){
							$d[$val] = $data[$p+1][$key];
						}
					}
					try{
						if($timeField && $data[$p+1]){
							$d[$timeField] = time();
						}
						db('ext_'.$tableName)->insertGetId($d);
					}catch(\Exception $e){
						echo $e->getMessage();	
					}
					echo json_encode(array('error'=>'00','data'=>$dt));
				}else{
					Cache::rm('FormData');
					echo json_encode(array('error'=>'10'));
				}
			}else{
				$this->error('当前没有数据');
			}
		}
	}
	
	/*获取拓展字段信息*/
	public function getExtends(){
		$extend_id =  input('param.extend_id','','intval');
		$fieldList =  model('Field')->loadAll(['extend_id'=>$extend_id,'status'=>1]);
		echo json_encode($fieldList);
	}
	

	

}
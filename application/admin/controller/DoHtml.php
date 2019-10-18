<?php 

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\common\service\CommonService;
use app\common\service\BaseService;
use app\common\service\CatagoryService;


class DoHtml extends Admin {
	
	
	public function __construct(){
		parent::__construct();
		config('url_type',2);
	}
	
	public function index(){
		$this->assign('tpList',CatagoryService::tplList(config('default_themes')));
		return $this->fetch('info');
	}
	
	//生成首页
	public function doIndex(){
		if ($this->request->isPost()){
			$index_tpl = input('param.index_tpl','','strval');
			!$index_tpl && $this->error('首页模板不能为空');
			$this->assign('media', $media=baseService::getMedia());  //网站关键词描述信息
			try{
				$index_name = config('index_name') ? config('index_name') : 'index.html';
				$this->filePutContents('./'.$index_name,$index_tpl);
			}catch(\Exception $e){
				$this->error($e->getMessage());
			}
			
			echo json_encode(array('status'=>'00','msg'=>'生成成功'));	
		}	
	} 
	
	//生成列表页
	public function doList(){
		
		$classId = input('param.classId','','intval');
		if (!$this->request->isPost()){
			$this->assign('classId',$classId);
			return $this->fetch('listprocess');
		}else{
			if(!$classId){
				$page = input('param.page','','intval');
				$where['list_tpl'] = array('neq','');
				$info = db("Catagory")->limit($page-1,1)->where($where)->order('sortid asc')->select();
				$info = current($info);
				$count = model('Catagory')->countList($where);
				if($info){				
					try{	
						$this->getListContent($info);
						$dt['percent'] = ceil($page/$count*100);
						$dt['filename'] = $info['filepath'].'/'.$info['filename'];
						echo json_encode(array('error'=>'00','data'=>$dt));
					}catch(\Exception $e){
						exit($this->error($e->getMessage()));
					}	
				}else{
					echo json_encode(array('error'=>'10'));
				}	
			}else{				
				$info = model('common/Catagory')->getInfo($classId);
				$count = 1;
				$page = 1;
				if($info){				
					try{	
						$this->getListContent($info);
						$dt['percent'] = ceil($page/$count*100);
						$dt['filename'] = $info['filepath'].'/'.$info['filename'];
						echo json_encode(array('error'=>'10','data'=>$dt));
					}catch(\Exception $e){
						exit($this->error($e->getMessage()));
					}	
				}			
			}	
		}
	}
	
	//获取列表页内容
	private function getListContent($info){
		
		try{
			$class_id = $info['class_id'];
			$crumb = model("index/Catagory")->loadCrumb($class_id);
			$topCategoryInfo = model("common/Catagory")->getInfo($crumb[0]['class_id']);
			$empty="<li><a href='".url('/About/'.$class_id)."'>".$topCategoryInfo['class_name']."</a></li>";
			$this->assign('media',baseService::getMedia($info['class_name'])); 
			$this->assign('info',$info);
			$this->assign('class_name',$info['class_name']); 
			$this->assign('classid',$info['class_id']);	
			$this->assign('pname',$topCategoryInfo['class_name']);
			$this->assign('pid',$topCategoryInfo['class_id']);
			$this->assign('position', model("index/catagory")->getPosition($info['class_id']));
			$this->assign('empty',$empty);
			$this->assign('p',1);
			if($info['type'] == 1){
				$this->assign('info',model("common/Content")->getWhereInfo(['class_id'=>$info['class_id']]));
			}
			$filepath = './'.$info['filepath'].'/'.$info['filename'];
			$this->filePutContents($filepath,$info['list_tpl']);
			if($info['type'] == 2){
				$idx = model("index/Catagory")->getSubClassId($info['class_id']);
				$contentWhere['class_id'] = ['in',$idx];
				$contentWhere['status'] = 10;
				$contentCount = model('common/Content')->countList($contentWhere);
				if($contentCount > 0){
					$pagesize = $this->getListPageSize($info);
					!$pagesize && $pagesize = 10;
					$totalpage = ceil($contentCount/$pagesize);
					if($totalpage > 1){
						for ($i=2; $i <=$totalpage; $i++){
							$this->assign('p',$i);
							$filepath = './'.$info['filepath'].'/'.$i.'/'.$info['filename'];
							$this->filePutContents($filepath,$info['list_tpl']);
						}
					}
				}
				
			}			
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}	
	}
	
	//生成详情页
	public function doView(){
		
		$classId = input('param.classId','','intval');
		$startId = input('param.startId','','intval');
		$endId = input('param.endId','','intval');
		$pagesize = input('param.pagesize','','intval');
		
		if (!$this->request->isPost()){
			$this->assign('classId',$classId);
			$this->assign('pagesize',$pagesize);
			$this->assign('startId',$startId);
			$this->assign('endId',$endId);
			return $this->fetch('viewprocess');
		}else{
			try{
				$page = input('param.page',1,'intval');
				$classId && $where['a.class_id'] = $classId;
				$startId && $where['a.content_id'] = array('egt',$startId);
				$endId && $where['a.content_id'] = array('elt',$endId);
				$where['b.type'] = 2;
				$start=($page-1) * $pagesize;
				$contentList = db('content')->alias('a')->join('catagory b','a.class_id=b.class_id')->where($where)->field('a.*,b.*')->limit($start,$pagesize)->order('content_id asc')->select();
				$count = db('content')->alias('a')->join('catagory b','a.class_id=b.class_id')->where($where)->limit($start,$pagesize)->order('content_id asc')->count();
				
				$per = ceil($count/$pagesize);
				if($contentList){
					foreach($contentList as $key=>$val){
						if($val['type'] == 2 && !empty($val['list_tpl']) || !empty($val['detail_tpl']) && !empty($val['jumpurl'])){
							$this->getViewContent($val);
						}
					}
					$dt['filename'] = $filepath;
					$dt['percent'] = ceil($page/$per*100);
					echo json_encode(array('error'=>'00','data'=>$dt));
				}else{
					echo json_encode(array('error'=>'10'));
				}
			}catch(\Exception $e){
				throw new \Exception($e->getMessage());
			}
		}
	}
	
	private function getViewContent($val){		
		try{
			$topCategoryInfo = model("index/Catagory")->getTopBigInfo($val['class_id']); //最上级栏目信息
			
			//获取拓展模块的内容信息
			if($val['module_id']){
				$extInfo = \app\common\service\ContentService::getExtDataInfo($val['module_id'],$val['content_id']);
				if($extInfo){
					unset($extInfo['data_id'],$extInfo['content_id']);
					$val = array_merge($val , $extInfo);
				}
			}

			$this->assign('media',BaseService::getMedia($val['title'])); //关键词描述等信息
			$this->assign('classInfo',$val);  //当前栏目信息
			$this->assign('class_name',$val['class_name']);  //当前栏目名称
			$this->assign('classid',$val['class_id']);	//当前栏目ID
			$this->assign('pname',$topCategoryInfo['class_name']);  //最上级栏目名称
			$this->assign('pid',$topCategoryInfo['class_id']);	//最上级栏目ID
			$this->assign('position',$this->getPos($val['class_id'])); //面包屑信息
			$this->assign('info',$val);
			$this->assign('shownext', BaseService::shownext($val['content_id'],$val['class_id']));
			$filepath = './'.$val['filepath'].'/'.$val['content_id'].'.html';
			$this->filePutContents($filepath,$val['detail_tpl']);
			
		}catch(\Exception $e){
			throw new \Exception($e->getMessage());
		}	
	}
	
	//此处的做法很不合理 目前没有解决静态生成面包屑重复的问题 实属无赖 且只支持三级 后面待改进
	private function getPos($classId){
		$info = model('common/Catagory')->getInfo($classId);
		$parentInfo = model('common/Catagory')->getInfo($info['pid']);
		$topBigInfo = model('common/Catagory')->getInfo($parentInfo['pid']);
		$pos = '当前位置：<a href="'.url('@index').'">首页</a>&nbsp;&gt;&gt;&nbsp;';
		if($topBigInfo){
			$pos .= '<a href="'.getClassUrl($topBigInfo).'">'.$topBigInfo['class_name'].'</a>&nbsp;&gt;&gt;&nbsp;<a href="'.getClassUrl($parentInfo).'">'.$parentInfo['class_name'].'</a>&nbsp;&gt;&gt;&nbsp;<a href="'.getClassUrl($info).'">'.$info['class_name'].'</a>';
		}else{
			if($parentInfo){
				$pos .= '<a href="'.getClassUrl($parentInfo).'">'.$parentInfo['class_name'].'</a>'.'&nbsp;&gt;&gt;&nbsp;<a href="'.getClassUrl($info).'">'.$info['class_name'].'</a>';
			}else{
				$pos .= '<a href="'.getClassUrl($info).'">'.$info['class_name'].'</a>';
			}
		}
		
		return $pos;
	}
	
	//写入
	private function filePutContents($filepath,$tpl){
		ob_start();
		$default_themes = config('default_themes') ? config('default_themes') : 'index';
		
		$content = $this->fetch('index@'.$default_themes.'/'.$tpl);
		
		echo $content;
		$_cache=ob_get_contents();
		ob_end_clean();
		
		if($_cache){
			$File = new \think\template\driver\File();
			$File->write($filepath, $_cache);	
		}
	}
	
	//获取列表页面的分页参数
	private function getListPageSize($info){
		$default_themes = config('default_themes') ? config('default_themes') : 'index';
		$tpl = $info['list_tpl'];
		$content = file_get_contents(APP_PATH.'index/view/'.$default_themes.'/'.$tpl.'.html');
		if($content){
			preg_match_all('/\{list(.*)num=[\'\"](\d+)[\'\"](.*)\}/',$content,$res);
			return $res[2][0];
		}
	}
	

}
<?php

namespace app\admin\controller;
use app\admin\controller\Admin;

class Upload extends admin{
	
	
	//上传图片
	public function uploadImages()
	{
		$upload = !empty(config('upload_dir')) ? config('upload_dir').'/admin' : '/uploads/admin';
		$targetFolder = '.'.$upload; // 设置上传路径 要是相对路径
		if (@!empty($_FILES)) {
			if(config('file_type')){
				$allowFile = explode(',',config('file_type'));
			}
			foreach($allowFile as $val){
				$allowFiles[] = '.'.$val;
			}
			if(!$allowFiles){
				$allowFiles = array(".gif", ".png", ".jpg", ".jpeg", ".PNG", ".JPG",".doc",".docx",".pdf",".xls",".xlsx",".rar",".zip",".txt",".mp4",".flv");
			}
			
			$maxSize = !config("fileSize") ? 100*1024 : config('fileSize') * 1024;
			
			 //上传配置
			$config = array(
				"savePath" => $targetFolder,
				"maxSize" => $maxSize, //单位KB
				"allowFiles" => $allowFiles
			);
			 //生成上传实例对象并完成上传
			$up= new \app\common\org\Uploader("file", $config);						 
			$info = $up->getFileInfo();
			if($info['state'] == 'SUCCESS'){
				
				$catagoryInfo = model('common/Catagory')->getInfo(input('param.class_id','','intval'));
				if($catagoryInfo['upload_config_id']){
					$this->thumb($info['url'],$catagoryInfo['upload_config_id']);
				}
				
				echo json_encode(array('code'=>1, 'data'=>ltrim($info['url'],'.')));
				exit;
			}
			echo json_encode(array('code'=>0));
			exit;
		}
	}
	
	//生成缩略图或水印
	public function thumb($imagesUrl,$upload_config_id){
		$configInfo = model('UploadConfig')->getInfo($upload_config_id);
		if($configInfo)
		{
			$image = new \app\common\org\Image();
			$image->open($imagesUrl);
			
			$targetimages = $imagesUrl;
			
			if($configInfo['upload_replace'] == 0)
			{
				$upload = !empty(config('upload_dir')) ? config('upload_dir').'/admin' : '/uploads/admin';
				$targetimages = '.'.$upload.'/s_'.basename($imagesUrl);
				copy($imagesUrl,$targetimages);
			}
			
			if($configInfo['thumb_status'] == 1)
			{
				$image->thumb($configInfo['thumb_width'], $configInfo['thumb_height'],$configInfo['thumb_type'])->save($targetimages);
			}			
			if($configInfo['water_status'] == 1 && !empty(config('water_logo')) && config('water_status') == 1)
			{
				$image->water('./'.config('water_logo'),$configInfo['water_position'])->save($targetimages); 
			}
		}
	}
	
	//编辑器上传
	public function editorUpload() {
	 	header('Content-Type: text/html; charset=UTF-8');
		$inputname='filedata';//表单文件域name
		$upload = !empty(config('upload_dir')) ? config('upload_dir').'/admin' : '/uploads/admin';
		$attachdir='.'.$upload;//上传文件保存路径，结尾不要带/
		$dirtype=1;//1:按天存入目录 2:按月存入目录 3:按扩展名存目录  建议使用按天存
		$maxattachsize=1048576 * 300;//最大上传大小，默认是300M
		if(!config('file_type')){
			$upext='zip,rar,txt,doc,docx,ppt,xls,xlsx,csv,jpg,jpeg,gif,png,bmp,swf,flv,fla,avi,wmv,wma,rm,mov,mpg,rmvb,3gp,mp4,mp3,pdf';
		}else{
			$upext=config('file_type');
		}
		//上传扩展名
		$msgtype=2;//返回上传参数的格式：1，只返回url，2，返回参数数组
		$immediate=1;//立即上传模式
		ini_set('date.timezone','Asia/Shanghai');//时区
			
		if(isset($_SERVER['HTTP_CONTENT_DISPOSITION']))//HTML5上传
		{
			if(preg_match('/attachment;\s+name="(.+?)";\s+filename="(.+?)"/i',$_SERVER['HTTP_CONTENT_DISPOSITION'],$info))
			{
				$temp_name=ini_get("upload_tmp_dir").'\\'.date("YmdHis").mt_rand(1000,9999).'.tmp';
				file_put_contents($temp_name,file_get_contents("php://input"));
				$size=filesize($temp_name);
				$_FILES[$info[1]]=array('name'=>$info[2],'tmp_name'=>$temp_name,'size'=>$size,'type'=>'','error'=>0);
			}
		}
		
		$err = "";
		$msg = "''";
		
		$upfile=@$_FILES[$inputname];
		if(!isset($upfile)){
			$err='文件域的name错误';
		}elseif(!empty($upfile['error'])){
			switch($upfile['error'])
			{
				case '1':
					$err = '文件大小超过了php.ini定义的upload_max_filesize值';
					break;
				case '2':
					$err = '文件大小超过了HTML定义的MAX_FILE_SIZE值';
					break;
				case '3':
					$err = '文件上传不完全';
					break;
				case '4':
					$err = '无文件上传';
					break;
				case '6':
					$err = '缺少临时文件夹';
					break;
				case '7':
					$err = '写文件失败';
					break;
				case '8':
					$err = '上传被其它扩展中断';
					break;
				case '999':
				default:
					$err = '无有效错误代码';
			}
		}elseif(empty($upfile['tmp_name']) || $upfile['tmp_name'] == 'none'){
			$err = '无文件上传';
		}else{
			$temppath=$upfile['tmp_name'];
			$fileinfo=pathinfo($upfile['name']);
			$extension=$fileinfo['extension'];
			if(preg_match('/'.str_replace(',','|',$upext).'/i',$extension))
			{
				$bytes=filesize($temppath);
				if($bytes > $maxattachsize)$err='请不要上传大小超过'.$maxattachsize.'的文件';
				else
				{
					switch($dirtype)
					{
						case 1: $attach_subdir = ''; break;
						case 2: $attach_subdir = 'month_'.date('ym'); break;
						case 3: $attach_subdir = 'ext_'.$extension; break;
					}
					$attach_dir = $attachdir.'/'.$attach_subdir;
					if(!is_dir($attach_dir))
					{
						@mkdir($attach_dir, 0777);
						@fclose(fopen($attach_dir.'/index.htm', 'w'));
					}
					PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
					$filename=date("YmdHis").mt_rand(1000,9999).'.'.$extension;
					$target = $attach_dir.'/'.$filename;
					
					rename($upfile['tmp_name'],$target);
					@chmod($target,0755);
					$target=ltrim($attachdir.$attach_subdir.'/'.$filename,'.');
					
					
					
					if($immediate=='1')$target='!'.$target;
					if($msgtype==1)$msg="'$target'";
					else $msg="{'url':'".$target."','localname':'".preg_replace("/([\\\\\/'])/",'\\\$1',$upfile['name'])."','id':'1'}";
					
					
				}
			}
			else $err='上传文件扩展名必需为：'.$upext;		
			@unlink($temppath);			
		}
		echo "{'err':'".preg_replace("/([\\\\\/'])/",'\\\$1',$err)."','msg':".$msg."}";
	}
	
	
    
}
<?php
// +----------------------------------------------------------------------
// | 应用公共文件
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 
// +----------------------------------------------------------------------

error_reporting(0);

/*
 * 生成交易流水号
 * @param char(2) $type
 */
function doOrderSn($type){
	return date('YmdHis') .$type. substr(microtime(), 2, 3) .  sprintf('%02d', rand(0, 99));
}

if (!function_exists('v')) {
    function v($var, $die = 1) {
        var_dump($var);
        $die && die();
    }
}

if (!function_exists('p')) {
    function p($var, $die = 1) {
        print_r($var);
        $die && die();
    }
}

/**
 * 打印输出数据到文件
 * @param mixed $data
 * @param bool $replace
 * @param string|null $pathname
 */
function pf($data, $replace = false, $pathname = null)
{
    is_null($pathname) && $pathname = RUNTIME_PATH . date('Ymd') . '.txt';
    $str = (is_string($data) ? $data : (is_array($data) || is_object($data)) ? print_r($data, true) : var_export($data, true)) . "\n";
    $replace ? file_put_contents($pathname, $str) : file_put_contents($pathname, $str, FILE_APPEND);
}

/**
 * 数组 转 对象
 *
 * @param array $arr 数组
 * @return object
 */
function array_to_object($arr) {
    if (gettype($arr) != 'array') {
        return;
    }
    foreach ($arr as $k => $v) {
        if (gettype($v) == 'array' || getType($v) == 'object') {
            $arr[$k] = (object)array_to_object($v);
        }
    }
    
    return (object)$arr;
}

/**
 * UTF8字符串加密
 * @param string $string
 * @return string
 */
function encode($string)
{
    $chars = '';
    $len = strlen($string = iconv('utf-8', 'gbk', $string));
    for ($i = 0; $i < $len; $i++) {
        $chars .= str_pad(base_convert(ord($string[$i]), 10, 36), 2, 0, 0);
    }
    return strtoupper($chars);
}

/**
 * UTF8字符串解密
 * @param string $string
 * @return string
 */
function decode($string)
{
    $chars = '';
    foreach (str_split($string, 2) as $char) {
        $chars .= chr(intval(base_convert($char, 36, 10)));
    }
    return iconv('gbk', 'utf-8', $chars);
}


/**
 * 设备或配置系统参数
 * @param string $name 参数名称
 * @param bool $value 默认是false为获取值，否则为更新
 * @return string|bool
 */
function sysconf($name, $value = false)
{
    return ;
}

if (!function_exists('array_under_reset')) {
    /**
     * 返回以原数组某个值为下标的新数据
     *
     * @param array $array
     * @param string $key
     * @param int $type 1一维数组2二维数组
     * @return array
     */
    function array_under_reset($array, $key, $type = 1) {
        if (is_array($array)) {
            $tmp = array();
            foreach ($array as $v) {
                if ($type === 1) {
                    $tmp[$v[$key]] = $v;
                } elseif ($type === 2) {
                    $tmp[$v[$key]][] = $v;
                }
            }
            return $tmp;
        } else {
            return $array;
        }
    }
}


/**
 * 随机字符
 * @param int $length 长度
 * @param string $type 类型
 * @param int $convert 转换大小写 1大写 0小写
 * @return string
 */
function random($length=10, $type='letter', $convert=0)
{
    $config = array(
        'number'=>'1234567890',
        'letter'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'string'=>'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
        'all'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
    );

    if(!isset($config[$type])) $type = 'letter';
    $string = $config[$type];

    $code = '';
    $strlen = strlen($string) -1;
    for($i = 0; $i < $length; $i++){
        $code .= $string{mt_rand(0, $strlen)};
    }
    if(!empty($convert)){
        $code = ($convert > 0)? strtoupper($code) : strtolower($code);
    }
    return $code;
}

function ip(){
    $ip='未知IP';
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        return is_ip($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:$ip;
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        return is_ip($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$ip;
    }else{
        return is_ip($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:$ip;
    }
}
function is_ip($str){
    $ip=explode('.',$str);
    for($i=0;$i<count($ip);$i++){ 
        if($ip[$i]>255){ 
            return false; 
        } 
    } 
    return preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/',$str); 
}

/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 */
function data_auth_sign($data) {
    //数据类型检测
    if(!is_array($data)){
        $data = (array)$data;
    }
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    return $sign;
}

/*字符窜替换星号*/
function replaceStar($str, $start, $length = 0)
{
  $i = 0;
  $star = '';
  if($start >= 0) {
   if($length > 0) {
    $str_len = strlen($str);
    $count = $length;
    if($start >= $str_len) {//当开始的下标大于字符串长度的时候，就不做替换了
     $count = 0;
    }
   }elseif($length < 0){
    $str_len = strlen($str);
    $count = abs($length);
    if($start >= $str_len) {//当开始的下标大于字符串长度的时候，由于是反向的，就从最后那个字符的下标开始
     $start = $str_len - 1;
    }
    $offset = $start - $count + 1;//起点下标减去数量，计算偏移量
    $count = $offset >= 0 ? abs($length) : ($start + 1);//偏移量大于等于0说明没有超过最左边，小于0了说明超过了最左边，就用起点到最左边的长度
    $start = $offset >= 0 ? $offset : 0;//从最左边或左边的某个位置开始
   }else {
    $str_len = strlen($str);
    $count = $str_len - $start;//计算要替换的数量
   }
  }else {
   if($length > 0) {
    $offset = abs($start);
    $count = $offset >= $length ? $length : $offset;//大于等于长度的时候 没有超出最右边
   }elseif($length < 0){
    $str_len = strlen($str);
    $end = $str_len + $start;//计算偏移的结尾值
    $offset = abs($start + $length) - 1;//计算偏移量，由于都是负数就加起来
    $start = $str_len - $offset;//计算起点值
    $start = $start >= 0 ? $start : 0;
    $count = $end - $start + 1;
   }else {
    $str_len = strlen($str);
    $count = $str_len + $start + 1;//计算需要偏移的长度
    $start = 0;
   }
  }
 
  while ($i < $count) {
   $star .= '*';
   $i++;
  }
 
  return substr_replace($str, $star, $start, $count);
}

function isMobile(){  
    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ''; 
    //echo $useragent;die;
    $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';        
    function CheckSubstrs($substrs,$text){  
        foreach($substrs as $substr)  
            if(false!==strpos($text,$substr)){  
                return true;  
            }  
            return false;  
    }
    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');  

    $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||  
              CheckSubstrs($mobile_token_list,$useragent);  

    if ($found_mobile){  
        return true;  
    }else{  
        return false;  
    }  
}

function killword($str, $start=0, $length, $charset="utf-8", $suffix=true) {
	if(function_exists("mb_substr"))
		$slice = mb_substr($str, $start, $length, $charset);
	elseif(function_exists('iconv_substr')) {
		$slice = iconv_substr($str,$start,$length,$charset);
	}else{
		$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice = join("",array_slice($match[0], $start, $length));
	}
	return $suffix ? $slice.'...' : $slice;
}
	
function killhtml($str, $length=0){
	if(is_array($str)){
		foreach($str as $k => $v) $data[$k] = killhtml($v, $length);
			 return $data;
	}

	if(!empty($length)){
		$estr = htmlspecialchars( preg_replace('/(&[a-zA-Z]{2,5};)|(\s)/','',strip_tags(str_replace('[CHPAGE]','',$str))) );
		if($length<0) return $estr;
		return killword($estr,0,$length);
	}
	return htmlspecialchars( trim(strip_tags($str)) );
}

/*格式化列表*/
function formartList($fieldConfig,$list)
{
	$cat = new \app\common\org\Category($fieldConfig);
	$ret=$cat->getTree($list);
	return $ret;
}

//通过字段值获取字段配置的名称
function getFieldVal($val,$fieldId){
	$fieldInfo = model("admin/Field")->getInfo($fieldId);
	if($fieldInfo['config']){
		foreach(explode(',',$fieldInfo['config']) as $k=>$v){
			if(strpos($v,strval($val)) !== false){
				$tempstr = explode('|',$v);
				$fieldval = $tempstr[0];
			}
		}
		return $fieldval;
	}
}

function getClassUrl($class){
	if(empty($class['jumpurl'])){
		$url_type = config('url_type') ? config('url_type') : 1;
		if($url_type == 1){
			$url =  url('index/About/index',['class_id'=>$class['class_id']]);
		}else{
			if($class['filepath'] == '/'){
				$url = '/'.$class['filename'];
			}else{
				$url =  $class['filepath'].'/'.$class['filename'];
			}	
		}		
	}else{
		$url =$class['jumpurl'];
	}
	return $url;
}

function getListUrl($newslist){
	if(!empty($newslist['jumpurl'])){
		$url =  $newslist['jumpurl'];
	}else{
		$url_type = config('url_type') ? config('url_type') : 1;
		if($url_type == 1){
			$url =  url('index/View/index',['content_id'=>$newslist['content_id']]);
		}else{
			$info = db('content')->alias('a')->join('catagory b','a.class_id=b.class_id')->where(['a.content_id'=>$newslist['content_id']])->field('a.content_id,b.filepath')->find();
			$url = $info['filepath'].'/'.$info['content_id'].'.html';
		}
		
	}
	return $url;
}

function u($classid){
	$url_type = config('url_type') ? config('url_type') : 1;
	if($url_type == 1){
		$url = url('index/About/index',['class_id'=>$classid]);
	}else{
		$info = model('common/Catagory')->getInfo($classid);
		$url = $info['filepath'].'/'.$info['filename'];
	}
	return $url;
}

//返回图片缩略后 或水印后不覆盖情况下的图片路径
function getSpic($newslist){
	if($newslist){
		$targetimages = pathinfo($newslist['pic']);
		$newpath = $targetimages['dirname'].'/'.'s_'.$targetimages['basename'];
		return $newpath;
	}
}

/**
 * 处理插件钩子
 * @param string $hook   钩子名称
 * @param mixed $params 传入参数
 * @return void
 */
function hook($hook,$params=array()){
    \Think\Hook::listen($hook,$params);
}


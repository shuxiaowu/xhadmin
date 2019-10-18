<?php 

namespace app\api\controller;
use think\Controller;
use think\Request;

class  Common extends Controller {

    protected $request;  //用来处理参数
    protected $backData =[];
	protected function _initialize(){

		// $token = md5(api_md5(red_panda) + md5(123456) + md5(timestamp)_api);
		// $service_token = md5(api_md5(red_panda) + md5(123456) + md5(timestamp)_api);

		// $this -> request = Request::instance();
		// // 判断传过来的时间戳是否超时
		// $this -> check_time($this->request->only(['time']));
		// // 验证token
		// $this -> check_token($this->request->param());
	}
 
	/**
	 * [check_time 验证是否超时]
	 * @param  [array] $arr [包含时间戳的参数数组]
	 * @return [json]      [检测结果]
	 */
	public function check_time($arr){
		if (!isset($arr['time'])||intval($arr['time'])<=1 ) {
			$this->return_msg(400,'时间戳不正确');
		}
		if (time()-intval($arr['time'])>60) {
			$this->return_msg(400,'请求超时');
		}
	}
 
	/**
	 * [check_token 验证token(防止数据被篡改)]
	 * @param  [array] $arr [全部请求参数]
	 * @return [json]      [token验证结果]
	 */
	public function check_token($arr){
		// api 传过来的 token
		if(!isset($arr['token'])||empty($arr['token'])) {
			$this ->return_msg(400,'token 不能为空');
		}
		// api 请求端的token 
		$app_token = $arr['token'];   //api 传过来的token
		// 服务器端生成的 token  :先从参数中剔除token
		unset($arr['token']);
		$service_token = '';
		foreach ($arr as $key => $value) {
			$service_token .= md5($value);
		}
		$service_token = md5('api_' . $service_token . '_api');  //服务端生成的token
 
		// dump($service_token);
 
		// 对比token，返回结果
		if ($app_token !== $service_token) {
			$this -> return_msg(400,'token不正确');
		}
 
	}
 
	/**
	 * [return_msg api数据返回]
	 * @param  [int] $code [结果码 200：正常 / 4**：数据问题  5**：服务器问题]
	 * @param  string $msg  [接口要返回的]
	 * @param  [array] $data [接口要返回的数据]
	 * @return [string]       [最终的json数据]
	 */
	public function return_msg($code,$msg='',$data=[]){
		/******** 组合数据 ********/
		$this->backData['code'] = $code; 
		$this->backData['msg'] = $msg; 
		$this->backData['data'] = $data; 
		/******** 返回信息并终止脚本 ********/
		echo json_encode($this->backData);die;
	}

}
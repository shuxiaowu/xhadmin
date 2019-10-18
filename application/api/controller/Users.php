<?php 

namespace app\api\controller;
use app\api\controller\Common;
use think\Controller;
use think\Request;
use think\Validate;
use think\Db;
use app\common\sms\SignatureHelper;

class Users extends Common {
    public function login(){
        parent::_initialize();
        return json($this->backData);
    }
    //注册
    public function register(){

        $this -> request = Request::instance();
        $phone = $this->request->param('phone','');
        $code = $this->request->param('code','');
        $password = $this->request->param('password','');
        $msg = [
            'mobile'=>$phone,
            'password'=>$password
        ];
        $rule = [
            ['mobile','require|/^1[3456789]\d{9}$/','电话不能为空|请输入正确的手机号'],
            ['password','require','密码不能为空'],
        ];
        $session_key = session($phone.':code');
        $validate = new Validate($rule);
        if (!$validate->check($msg)) {
            // throw new \Exception($validate->getError());
            $this->backData['code'] = 1;
            $this->backData['msg'] = $validate->getError();
            return json($this->backData);
        }else{
            if($code ==  $session_key){
                $pascode = $this->setCode(6);
                $result = Db::name('member')->insertGetId(['mobile'=>$msg['mobile'],'password'=>md5($msg['password'].$pascode),'code'=>$pascode]);
                $this->backData['code'] = 0;
                $this->backData['msg'] = '注册成功';
                $this->backData['data'] = $msg;
                return json($this->backData);exit;
            }else{
                $this->backData['code'] = 2;
                $this->backData['msg'] = '验证码有误'.','.$session_key;
                return json($this->backData);exit;
            }
        }  
    }
    /**
     * 创建验证码
     * @return max 验证码位数
     */
    public function setCode($max){
        $rand = $max ? $max : 6;
        $code = '';
        for($i=0;$i<$rand;$i++){
             $code .=  mt_rand(0,9);
        }
        return $code;
    }
     /**
     * 获取手机验证码
     */
    public function get_sms_code($phone){
        $phone = $this->request->param('phone');
        if(!preg_match('/^1[3456789]\d{9}$/',$phone)){
            $this->backData['code'] = 3;
            $this->backData['msg'] = '手机号码不存在';
            return json($this->backData);exit;
        }
       
        $cache_key = $phone.':code';
        $cache_code = session($cache_key);
        if($cache_code){
            return $this->success([],'验证码已经发送');
        }
        $rand_code =$this->setCode(6);
        try{
            $res = $this->sendSms(['phone'=>$phone,'rand_code'=>$rand_code]);
            $res = json_decode(json_encode($res),1);
            if($res && !empty($res) && $res['Code']=='OK'){
                session($cache_key,$rand_code,600);
                $this->backData['code'] = 0;
                $this->backData['msg'] = '验证码发送成功';
                return json($this->backData);exit;
            }else{
                $this->backData['code'] = 1;
                $this->backData['msg'] = '验证码发送失败';
                return json($this->backData);exit;
            }

        }catch (\Exception $e){
            $this->backData['code'] = 2;
            $this->backData['msg'] = '验证码发送失败';
            return json($this->backData);exit;
        }
    }
    /**
     * aliyun发送短信
     */
    public function sendSms($args=[]) {

        $params = array ();

        // *** 需用户填写部分 ***
        // fixme 必填：是否启用https
        $security = false;

        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        $accessKeyId = "LTAIGJ2E5vwaMC22";
        $accessKeySecret = "z0NsIH1Skwxp5wMsTXf3v4Zvzgvn2C";

        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $args['phone'];

        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = "乐腾科技";

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = "SMS_123670945";

        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = Array (
            "code" => $args['rand_code'],
//            "product" => "阿里通信"
        );

        // fixme 可选: 设置发送短信流水号
//        $params['OutId'] = "12345";

        // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
//        $params['SmsUpExtendCode'] = "1234567";


        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            )),
            $security
        );

        return $content;
    }

}
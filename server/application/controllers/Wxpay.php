<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('date.timezone','Asia/Shanghai');

class Wxpay extends CI_Controller {
    public function index() {
            $this->json([
                'code' => 0,
                'data' => 'this is a index file'
            ]);
    }
    public function prePay(){

        require_once BASEPATH."lib/WxPay.JsApiPay.php";
        require_once BASEPATH."lib/WxPay.Api.php";
        //①、获取用户openid
        $tools = new JsApiPay();
//        $openId = $tools->GetOpenid();
            $openId = htmlspecialchars($_GET['openId'],ENT_QUOTES);
//②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody("test-紅包支付");
        $input->SetAttach("test");
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);

        try{
            $order = WxPayApi::unifiedOrder($input);
        }catch (WxPayException $exception){
            $this->json([
                'code' => -1,
                'data' => $exception->getMessage()
            ]);exit;
        }


        $jsApiParameters = $tools->GetJsApiParameters($order);

        $res = json_decode($jsApiParameters,true);
        unset($res['appId']);
        $this->json([
            'code' => 0,
            'data' => $res
        ]);
//获取共享收货地址js函数参数
//        $editAddress = $tools->GetEditAddressParameters();

    }
}

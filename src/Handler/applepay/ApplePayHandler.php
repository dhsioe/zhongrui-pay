<?php
/**
  * 苹果内购支付
  * @author: hsioe1111@gmail.com
  * @Date: 2021/08/24
  * @Description: 苹果内购支付回调验证 
*/
namespace Zhongrui\Pay\Handler\applepay;

use Exception;
use GuzzleHttp\Client;
use Zhongrui\Pay\Handler\BaseHandler;
use Zhongrui\Pay\PayInterface;
use Yansongda\Pay\Pay as PayHandler;


class ApplePayHandler extends BaseHandler
{
    const MaxLen = 20;

    /**
     *  苹果正式内购环境
     *  @var string
    */
    const NORMAT_URI = "https://buy.itunes.apple.com/verifyReceipt";

    /**
     *  苹果沙箱内购环境
     *  @var string
    */
    const SANDBOX_URI = "https://sandbox.itunes.apple.com/verifyReceipt";

    /**
     *  苹果支付失败原因表
     *  @var array
    */
    const ERROR_MESSAGES_MAP = [
        '21000'     =>    'App Store 不能读取你提供的JSON对象',
        '21002'     =>    'receipt-data数据有问题',
        '21003'     =>    'receipt 无法通过验证',
        '21004'     =>    '数据不匹配',
        '21005'     =>    'receipt服务器不可用',
        '21006'     =>    '订阅已过期',
        '21007'     =>    'sandbox数据不能直接调生产地址',
        '21008'     =>    '生产数据不能通过sandbox验证'
    ];

    public function pay(string $price, array $option)
    {
         // 苹果无需走服务端支付，只需接收回调验证结果即可
    }

    public function getVerfiyByApple($result)
    {
        $client = new Client();
        $verfiyRv = $client->post(self::NORMAT_URI, ['json'=>['receipt-data'=>$result]]);
        $verfiyRv = json_decode($verfiyRv->getBody(), true);
        if($verfiyRv['status'] == '21007'){
            // 沙盒数据
            $verfiyRv = $client->post(self::SANDBOX_URI, ['json' => ['receipt-data' => $result]]);
            $verfiyRv = json_decode($verfiyRv->getBody(), true);
        }

        return $verfiyRv;
    }

    /**
     *  苹果回调处理
     *  @return ['status' => true | false, 'message' => '购买成功']
    */
    public function notify($result='')
    {
        $response = ['status' => true, 'error_msg' => '', 'data' => []];
        
        $verfiyRv = $this->getVerfiyByApple($result);
        if(intval($verfiyRv['status']) === 0){
             // 支付成功
             $response['data'] = $verfiyRv['receipt']['in_app'][0];
             $response['message'] = '购买成功';
        }else{
            // 支付失败
             $response['status']  = false;
             $response['message'] = '购买失败';
             $response['error_msg'] = self::ERROR_MESSAGES_MAP[$verfiyRv['status']];
        }
        
        return $response;
    }
}
?>
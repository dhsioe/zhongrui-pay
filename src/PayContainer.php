<?php
namespace Zhongrui\Pay;

use Zhongrui\Pay\Handler\alipay\AlipayHandler;
use Zhongrui\Pay\Handler\wechat\WechatPayHandler;

use Exception;

class PayContainer
{

    const PAY_METHODS = [
        'wechat' => WechatPayHandler::class,
        'alipay' => AlipayHandler::class
    ];
    
    public static function getPayClass(string $payType)
    {
         if(!in_array(strtolower($payType), array_keys(self::PAY_METHODS))){
              throw new Exception("{$payType} is not allow to use!");
         }
         
         $payHandler = self::PAY_METHODS[$payType];
         return new $payHandler();
    }
}
?>
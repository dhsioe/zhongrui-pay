<?php
namespace Zhongrui\Pay;

use Zhongrui\Pay\Handler\alipay\AlipayHandler;
use Zhongrui\Pay\Handler\wechat\WechatPayHandler;

use Exception;
use Zhongrui\Pay\Handler\applepay\ApplePayHandler;

class PayContainer
{
    const PAY_METHODS = [
        'wechat' => WechatPayHandler::class,
        'alipay' => AlipayHandler::class,
        'applypay' => ApplePayHandler::class
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
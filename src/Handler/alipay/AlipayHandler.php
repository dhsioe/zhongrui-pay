<?php
/**
  * 支付宝支付
  * @author: hsioe1111@gmail.com
  * @Date: 2021/08/24
  * @Description: 
*/
namespace Zhongrui\Pay\Handler\alipay;

use Yansongda\Pay\Pay as PayHandler;
use Zhongrui\Pay\Handler\BaseHandler;


class AlipayHandler extends BaseHandler
{
    public function pay(string $price, array $option)
    {
         PayHandler::config($this->getConfig());
         return PayHandler::alipay()->app([
             'out_trade_no' => $option['order_num'],
             'total_amount' => $price,
             'subject'      => $option['title']
         ]);
    }

    public function notify()
    {
        PayHandler::config($this->getConfig());
        return PayHandler::alipay()->callback();
    }
}
?>
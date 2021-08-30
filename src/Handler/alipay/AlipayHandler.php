<?php
/**
  * 支付宝支付
  * @author: hsioe1111@gmail.com
  * @Date: 2021/08/24
  * @Description: 
*/
namespace Zhongrui\Pay\Handler\alipay;

use Zhongrui\Pay\Handler\BaseHandler;
use Zhongrui\Pay\PayInterface;

class AlipayHandler extends BaseHandler implements PayInterface
{
    public function pay(string $price, array $option)
    {
         return $this->getPayApp('alipay')->app([
             'out_trade_no' => $option['order_num'],
             'total_amount' => $price,
             'subject'      => $option['title']
         ]);
    }

    public function notify()
    {
        return $this->getPayApp('alipay')->callback();
    }

    public function confirm()
    {
        return $this->getPayApp('alipay')->success();
    }
}
?>
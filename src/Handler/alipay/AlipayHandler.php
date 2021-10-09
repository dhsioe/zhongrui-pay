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
             'notify_url'   => $option['notify_url'],
             'subject'      => $option['title']
         ]);
    }

    public function notifyArray()
    {
        $result = $this->notify();
        return [
            'out_trade_no'   => $result['out_trade_no'],
            'transaction_id' => $result['trade_no']
        ];
    }

    public function notify()
    {
        $result = $this->getPayApp('alipay')->callback();
        return $result->toArray();
    }

    public function confirm()
    {
        return $this->getPayApp('alipay')->success();
    }
}
?>
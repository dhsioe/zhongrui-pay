<?php
/**
  * 微信支付
  * @author: hsioe1111@gmail.com
  * @Date: 2021/08/24
  * @Description: 
*/
namespace Zhongrui\Pay\Handler\wechat;

use Zhongrui\Pay\Handler\BaseHandler;
use Zhongrui\Pay\PayInterface;
use Yansongda\Pay\Pay;

class WechatPayHandler extends BaseHandler implements PayInterface
{
    /**
     *  格式化金额
     *  微信的金币单位为分制
     *  @return int | float
    */
    protected function formatPrice(string $price): float
    {
        return (float)$price * 100;
    }

    public function pay(string $price, array $option)
    {
        return $this->getPayApp('wechat')->app([
            'description'  =>  $option['title'],
            'out_trade_no' =>  $option['order_num'],
            'amount'       => [
                'total'    => $this->formatPrice($price)
            ]
        ]);
    }

    public function notifyArray()
    {
        $result = $this->notify();
        return [
            'out_trade_no'    =>  $result['resource']['ciphertext']['out_trade_no'],
            'transaction_id'  =>  $result['resource']['ciphertext']['transaction_id']
        ];
    }

    /**
     *  微信支付回调通知
     *  @return XML
    */
    public function notify()
    {
        $result = $this->getPayApp('wechat')->callback();
        return $result->toArray();
    }

    /**
     *  微信支付回调确认
     *  @return XML
    */
    public function confirm()
    {
        return $this->getPayApp('wechat')->success();
    }
}
?>
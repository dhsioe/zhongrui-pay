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

    /**
     *  微信支付回调通知
     *  @return XML
    */
    public function notify()
    {
        return $this->getPayApp('wechat')->callback();
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
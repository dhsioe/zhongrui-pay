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
use Zhongrui\Pay\PayInterface;

class AlipayHandler extends BaseHandler implements PayInterface
{

    /**
     *  支付APP
    */
    protected $app;

    public function __construct()
    {
        $this->app = PayHandler::alipay($this->config);
    }

    public function pay(string $price, array $option)
    {
         $pay = $this->app->app([
             'out_trade_no' => $option['order_num'],
             'total_amount' => $price,
             'subject'      => $option['title']
         ]);

         return $pay;
    }

    public function notify()
    {
        return $this->app->callback();
    }
}
?>
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
use Yansongda\Pay\Pay as PayHandler;

use Exception;

class WechatPayHandler extends BaseHandler
{

    /**
     *  APP
     *  @var PayHandler;
    */
    protected $app;

    public function __construct()
    {
        $this->app = PayHandler::wechat($this->config);
    }

    /**
     *  格式化金额
     *  微信的金币单位为分制
     *  @return int | float
    */
    protected function formatPrice(string $price): float
    {
        return (float)$price * 100;
    }

    protected function handlerResult($result)
    {
        return [
            'mch_id'    => $result->mch_id,
            'nonce_str' => $result->nonce_str,
            'prepay_id' => $result->prepay_id,
            'sign'      => $result->sign,
            'timestamp' => $result->timestamp
        ];
        //throw new Exception('ZhongruiPay Fail: '. $result['error_msg']);
    }

    public function pay(string $price, array $option)
    {
        $pay = $this->app->app([
            'body'  =>  $option['title'],
            'out_trade_no' => $option['order_num'],
            'total_fee'    => $this->formatPrice($price),
            'trade_type'   => 'app'
        ]);

        return $this->handlerResult($pay);
    }

    /**
     *  微信支付回调通知
     *  @return XML
    */
    public function notify()
    {
        return $this->app->callback();
    }
}
?>
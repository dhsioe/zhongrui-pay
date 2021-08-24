<?php
declare(strict_types=1);
/**
  * 中瑞PHP支付包
  * @author: hsioe1111@gmail.com
  * @Date: 2021/08/24
  * @Description: 
*/
namespace Zhongrui\Pay;

use Zhongrui\Pay\Handler\alipay\AlipayHandler;
use Zhongrui\Pay\Handler\wechat\WechatPayHandler;

class ZhongruiPay
{
    /**
     *  支付额外参数
     *  @var array
    */
    protected $payOptions;

    /**
     *  支付方式
     *  wechat-微信 alipay-支付宝
     *  @var WechatPayHandler
     *  @var AliPayHandler
    */
    protected $payContainer;

    /**
     *  支付金额
     *  @var string
    */
    protected $payPrice;


    public function __construct(string $payType, string $payPrice = '1', array $payOptions = [])
    {
        $this->payContainer = PayContainer::getPayClass($payType);
        $this->payPrice = $payPrice;
        $this->payOptions = $payOptions;
    }

    /**
     *  统一支付方法
     *  @return mixed
    */
    public function doPay()
    {
        return $this->payContainer->pay($this->payPrice, $this->payOptions);
    }

    /**
     *  统一回调方法
     *  @return mixed
    */
    public function doNotify()
    {
        return $this->payContainer->notify();
    }

    /**
     *  配置支付方式
    */
    public function setSetting($config)
    {
        $this->payContainer->setConfig($config);
    }

}
?>
<?php
declare(strict_types=1);
/**
  * 中瑞PHP支付包
  * @author: hsioe1111@gmail.com
  * @Date: 2021/08/24
  * @Description: 
*/
namespace Zhongrui\Pay;


class ZhongruiPay
{
    /**
     *  PayInterface
     *  @var PayInterface
    */
    protected $payHandler;

    public function __construct($payType)
    {
        $this->payHandler = PayContainer::getPayClass($payType);
    }

    /**
     *  统一支付方法
     *  @return mixed
    */
    public function doPay($payPrice, $payOptions)
    {
        return $this->payHandler->pay($payPrice, $payOptions);
    }

    /**
     *  统一回调方法
     *  @return mixed
    */
    public function doNotify()
    {
        return $this->payHandler->notify();
    }

    /**
     *  配置支付方式
    */
    public function setSetting($config)
    {
        $this->payHandler->setConfig($config);
    }

}
?>
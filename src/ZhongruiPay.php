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
     *  获取支付句柄
     *  @return PayInterface
    */
    public function getPayHandler()
    {
        return $this->payHandler;
    }

}
?>
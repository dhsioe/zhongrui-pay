<?php
declare(strict_types=1);
/**
  * 中瑞支付组件接口
  * @author: hsioe1111@gmail.com
  * @Date: 2021/08/24
  * @Description: 
*/
namespace Zhongrui\Pay;


interface PayInterface
{
    /**
     *  发起支付接口
     *  统一接收参数 price, options
     *  @param string $price 支付价格
     *  @param array $options 支付额外配置
    */
    public function pay(string $price, array $options);

    /**
     *  支付回调处理
     *  所有支付必须实现自己的支付回调
     *  @return mixed
    */
    public function notify();

    /**
     *  支付回调确认
     *  @return mixed
    */
    public function confirm();

    /**
     *  设置支付配置
    */
    public function setConfig(array $config);
}
?>
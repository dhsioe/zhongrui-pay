<?php
/**
  * 支付基类方法
  * @author: hsioe1111@gmail.com
  * @Date: 2021/08/28
  * @Description: 
*/
namespace Zhongrui\Pay\Handler;

use Zhongrui\Pay\PayInterface;

class BaseHandler implements PayInterface
{
    /**
     * 支付统一配置
     * @var array
    */
    protected $config = [];

    public function pay(string $payPrice, array $payOptions) {}

    public function notify() {}
    
    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }
}
?>
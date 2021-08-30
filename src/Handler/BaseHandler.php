<?php
/**
  * 支付基类方法
  * @author: hsioe1111@gmail.com
  * @Date: 2021/08/28
  * @Description: 
*/
namespace Zhongrui\Pay\Handler;

use Exception;
use Yansongda\Pay\Pay;


class BaseHandler
{
    /**
     * 支付统一配置
     * @var array
    */
    protected $config = [];

    /**
     * 获取支付实例
    */
    public function getPayApp(string $payType)
    {
        Pay::config($this->config);
        switch($payType){
            case 'wechat':
                return Pay::wechat();
            case 'alipay':
                return Pay::alipay();
        }
        throw new Exception('支付方式不支持');
    }

    /**
     *  支付方式配置
     *  @param array $config  相应的支付配置
    */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     *  获取配置
     *  @return array
    */
    public function getConfig(): array
    {
        return $this->config;
    }
}
?>
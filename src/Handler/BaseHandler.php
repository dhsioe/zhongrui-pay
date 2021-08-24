<?php
/**
  * 支付基类方法
  * @author: hsioe1111@gmail.com
  * @Date: 2021/08/28
  * @Description: 
*/
namespace Zhongrui\Pay\Handler;

use Yansongda\Pay\Pay;

class BaseHandler
{
    /**
     * 支付统一配置
     * @var array
    */
    protected $config;

    
    public function setConfig($config)
    {
        $this->config = $config;
    }
}
?>
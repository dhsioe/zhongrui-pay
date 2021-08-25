<?php
/**
  * 支付类测试
  * @author: hsioe1111@gmail.com
  * @Date: 
  * @Description: 
*/
namespace Zhongrui\Tests;

use Zhongrui\Pay\ZhongruiPay;

class PayHandlerTest extends \PHPUnit\Framework\TestCase
{
    protected $config = [];
    /**
     *  支付方法测试
     *  @group PayTest
    */
    public function testPay()
    {
        $pay = new ZhongruiPay('alipay');
        $pay->setSetting($this->config);
        $result = $pay->doPay('100', ['notify_url'=>'http://', 'title'=>'123', 'order_num'=>'H3093939129191']);
        $this->assertNotEmpty($result);

        $pay = new ZhongruiPay('wechat');
        $pay->setSetting($this->config);
        $result = $pay->doPay('100', ['notify_url'=>'http://', 'title'=>'123', 'order_num'=>'H3093939129191']);
        $this->assertNotEmpty($result);
    }

    /**
     *  支付回调测试
     *  @group PayTest
    */
    public function testNotify()
    {
        $pay = new ZhongruiPay('alipay');
        $pay->setSetting($this->config);
        $this->assertEquals($pay->doNotify(), 'This is wechat Notify');

        $pay = new ZhongruiPay('wechat');
        $pay->setSetting($this->config);
        $this->assertEquals($pay->doNotify(), 'This is wechat Notify');
    }
}
?>
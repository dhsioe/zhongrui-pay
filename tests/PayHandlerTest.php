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
    /**
     *  支付方法测试
     *  @group PayTest
    */
    public function testPay()
    {
        $pay = new ZhongruiPay('wechat', '100', ['notify_url'=>'hello']);
        $this->assertEquals($pay->doPay(), 'This is wechat pay');
    }

    /**
     *  支付回调测试
     *  @group PayTest
    */
    public function testNotify()
    {
        $pay = new ZhongruiPay('wechat', '100', ['notify_url' => 'hello']);
        $this->assertEquals($pay->doNotify(), 'This is wechat Notify');
    }
}
?>
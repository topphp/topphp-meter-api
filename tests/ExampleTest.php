<?php

declare(strict_types=1);

namespace Topphp\Test;

use Topphp\TopphpMeterApi\TqMeter\SyncApi\MeterClient;
use Topphp\TopphpTesting\HttpTestCase;

class ExampleTest extends HttpTestCase
{
    private $code  = '4318a22897441b6cca3add1c0ac338cc';
    private $nonce = 'ECl96pLa7ovmn7gXs0w';

    public function testSyncApi()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode('37577f8fb62a7b14ba55cc6faec5a142')
            ->setNonce('XOfX547SeCIlhufeeBBwgZIN')
            ->collectorQuery([]);
        var_dump($res);
    }

    public function testV1Api()
    {
        $gate = new MeterClient();
        $res  = $gate->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->dataRequest([
                "type"        => "json",                                            # 数据返回类型
                "functionids" => "3,4,5,6,15,16,17,18,22,27,28",                    # 请求数据类型
                "start_time"  => "2020-10-11 00:00:00",                             # 起始时间
                "end_time"    => "2020-10-24 00:00:00",                             # 结束时间
                "offset"      => 0,                                                 # 数据偏移量
                "limit"       => 100
            ]);
        var_dump($res);
    }

    public function testMeterV1()
    {
        $gate = new MeterClient();
        $res  = $gate->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->meter();
        var_dump($res);
    }

    public function testEleMeterState()
    {
        $gate = new MeterClient();
        $res  = $gate->setAuthCode($this->code)
            ->eleMeterState();
        var_dump($res);
    }

    public function testEleMeterQuery()
    {
        $gate = new MeterClient();
        $res  = $gate->setAuthCode($this->code)
            ->user();
        var_dump($res);
    }

    public function testEleMeterParam()
    {
        $gate = new MeterClient();
        $res  = $gate->setAuthCode($this->code)
            ->param();
        var_dump($res);
    }
}

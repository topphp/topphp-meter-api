<?php

declare(strict_types=1);

namespace Topphp\Test;

use Topphp\TopphpMeterApi\TqMeter\AsyncApi\EleMeterClient;
use Topphp\TopphpMeterApi\TqMeter\SyncApi\MeterClient;
use Topphp\TopphpTesting\HttpTestCase;

class ExampleTest extends HttpTestCase
{
    /**
     * Test that true does in fact equal true
     */
    public function testTrueIsTrue()
    {
        $this->assertTrue(true);
    }

    public function testSyncApi()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode('37577f8fb62a7b14ba55cc6faec5a142')
            ->setNonce('XOfX547SeCIlhufeeBBwgZIN')
            ->collectorQuery([]);
        var_dump($res);
    }

    public function testOpenAccount()
    {
        $gateway = new EleMeterClient();
        $res     = $gateway->setAuthCode('37577f8fb62a7b14ba55cc6faec5a142')
            ->setNonce('XOfX547SeCIlhufeeBBwgZIN')
            ->setNotifyUrl('')
            ->eleSecurityOpenAccount([
                [
                    "opr_id"      => $gateway->generateOperateId(),
                    "time_out"    => 0,
                    "must_online" => true,
                    "retry_times" => 1,
                    "cid"         => "19020618114",
                    "address"     => "000066660942",
                    "params"      => [
                        "money" => "100",
                    ]
                ],
            ], '');
        var_dump($res);
    }

    public function testV1Api()
    {
        $gate = new MeterClient();
        $res  = $gate->setAuthCode('37577f8fb62a7b14ba55cc6faec5a142')
            ->setNonce('XOfX547SeCIlhufeeBBwgZIN')
            ->dataRequest([
                "type"        => "json",                     # 数据返回类型
                "functionids" => "3,4,5",                    # 请求数据类型
                "start_time"  => "2020-01-01 00:00:00",      # 起始时间
                "end_time"    => "2020-06-01 00:00:00",      # 结束时间
                "offset"      => 0,                          # 数据偏移量
                "limit"       => 100
            ]);
        var_dump($res);
    }

    public function testMeterV1()
    {
        $gate = new MeterClient();
        $res  = $gate->setAuthCode('37577f8fb62a7b14ba55cc6faec5a142')
            ->setNonce('XOfX547SeCIlhufeeBBwgZIN')
            ->meter();
        var_dump($res);
    }
}

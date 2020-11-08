<?php

declare(strict_types=1);

namespace Topphp\Test;

use Topphp\TopphpMeterApi\TqMeter\AsyncApi\EleMeterClient;
use Topphp\TopphpMeterApi\TqMeter\SyncApi\MeterClient;
use Topphp\TopphpTesting\HttpTestCase;

class ExampleTest extends HttpTestCase
{
    private $code   = '4318a22897441b6cca3add1c0ac338cc';
    private $nonce  = 'ECl96pLa7ovmn7gXs0w';
    private $notify = 'http://vtheatre.n.kaituocn.com/';

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

    public function testUser()
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

    public function testEleWrite()
    {
        $gateway = new EleMeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->setNotifyUrl($this->notify)
            ->eleWrite([
                [
                    'opr_id'      => $gateway->generateOperateId(),
                    'time_out'    => 60,
                    'must_online' => true,
                    'retry_times' => 1,
                    'type'        => 12,
                    'cid'         => '200824015639',
                    'address'     => '200824015639',
                    'params'      => [
                        'p1' => '1',
                        'p2' => '2',
                        'p3' => '3',
                        'p4' => '4',
                    ]
                ],
                [
                    'opr_id'      => $gateway->generateOperateId(),
                    'time_out'    => 60,
                    'must_online' => true,
                    'retry_times' => 1,
                    'type'        => 13,
                    'cid'         => '200824015639',
                    'address'     => '200824015639',
                    'params'      => [
                        'p1' => '100',
                        'p2' => '200',
                        'p3' => '300',
                        'p4' => '400',
                    ]
                ],
                [
                    'opr_id'      => $gateway->generateOperateId(),
                    'time_out'    => 60,
                    'must_online' => true,
                    'retry_times' => 1,
                    'type'        => 14,
                    'cid'         => '200824015639',
                    'address'     => '200824015639',
                    'params'      => [
                        'p1' => '1000',
                        'p2' => '2000',
                        'p3' => '3000',
                        'p4' => '4000',
                    ]
                ],
                [
                    'opr_id'      => $gateway->generateOperateId(),
                    'time_out'    => 60,
                    'must_online' => true,
                    'retry_times' => 1,
                    'type'        => 23,
                    'cid'         => '200824015639',
                    'address'     => '200824015639',
                    'params'      => [
                        'p1' => '1',
                    ]
                ],
                [
                    'opr_id'      => $gateway->generateOperateId(),
                    'time_out'    => 60,
                    'must_online' => true,
                    'retry_times' => 1,
                    'type'        => 24,
                    'cid'         => '200824015639',
                    'address'     => '200824015639',
                    'params'      => [
                        'p1' => '10',
                    ]
                ],
                [
                    'opr_id'      => $gateway->generateOperateId(),
                    'time_out'    => 60,
                    'must_online' => true,
                    'retry_times' => 1,
                    'type'        => 25,
                    'cid'         => '200824015639',
                    'address'     => '200824015639',
                    'params'      => [
                        'p1' => '50',
                    ]
                ],
            ]);
        var_dump($res);
        var_dump(json_decode($res['response_content'], true));
    }

    public function testEleSecurityOpenAccount()
    {
        $gateway = new EleMeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->setNotifyUrl($this->notify)
            ->eleSecurityOpenAccount([
                [
                    'opr_id'      => $gateway->generateOperateId(),
                    'cid'         => '200824015639',
                    'address'     => '200824015639',
                    'params'      => [
                        'account_id' => '0',
                        'count'      => 1,
                        'money'      => '1000',
                        'price'      => '1000'
                    ],
                    'must_online' => true,
                    'time_out'    => 60,
                    'retry_times' => 1,
                ]
            ]);
        var_dump($res);
        var_dump(json_decode($res['response_content'], true));
    }

    public function testRecharge()
    {
        $gateway = new EleMeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->setNotifyUrl($this->notify)
            ->eleSecurityRecharge([
                [
                    'opr_id'      => $gateway->generateOperateId(),
                    'cid'         => '200824015639',
                    'address'     => '200824015639',
                    'params'      => [
                        'account_id' => '0',
                        'count'      => '2',
                        'money'      => '100000',
                        'price'      => '100000'
                    ],
                    'must_online' => true,
                    'time_out'    => 60,
                    'retry_times' => 1,
                ]
            ]);
        var_dump($res);
        var_dump(json_decode($res['response_content'], true));
    }

}

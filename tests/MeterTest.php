<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * @package topphp-meter-api
 * @date 2020/10/22 13:04
 * @author sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\Test;

use Topphp\TopphpMeterApi\TqMeter\AsyncApi\EleMeterClient;
use Topphp\TopphpMeterApi\TqMeter\AsyncApi\Notify;
use Topphp\TopphpMeterApi\TqMeter\SyncApi\MeterClient;
use Topphp\TopphpTesting\HttpTestCase;

class MeterTest extends HttpTestCase
{
    private $code   = '4318a22897441b6cca3add1c0ac338cc';
    private $nonce  = 'ECl96pLa7ovmn7gXs0w';
    private $notify = 'http://meter.n.kaituocn.com/admin/index';

    public function testCollectorAdd()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->collectorAdd([
                ['cid' => '200824015639']
            ]);
        var_dump(json_decode($res['response_content']));
    }

    public function testCollectorDel()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->collectorDelete([
                ['cid' => '200824015639']
            ]);
        var_dump(json_decode($res['response_content']));
    }

    public function testEleMeterAdd()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->eleMeterAdd([
                [
                    'cid'     => '200824015639',
                    'address' => '200824015639',
                    'model'   => '10573'
                ]
            ]);
        var_dump(json_decode($res['response_content']));
    }

    public function testEleMeterDel()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->eleMeterDelete([
                ['cid' => '200824015639', 'address' => '200824015639']
            ]);
        var_dump(json_decode($res['response_content']));
    }

    public function testCollectorQuery()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->collectorQuery([
                ['cid' => '200824015639']
            ]);
        var_dump(json_decode($res['response_content']));
    }

    public function testEleMeterQuery()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->eleMeterQuery([
                ['cid' => '200824015639']
            ]);
        var_dump(json_decode($res['response_content']));
    }

    public function testEleRead()
    {
        $gateway = new EleMeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->setNotifyUrl($this->notify)
            ->eleRead([
                [
                    'opr_id'      => $gateway->generateOperateId(),
                    'time_out'    => 60,
                    'must_online' => true,
                    'retry_times' => 1,
                    'type'        => 3,
                    'cid'         => '200824015639',
                    'address'     => '200824015639',
                ]
            ]);
        var_dump($res);
        var_dump(json_decode($res['response_content']));
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
                        'money'      => '100',
                        'price'      => '100'
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
                        'money'      => '100',
                        'price'      => '100'
                    ],
                    'must_online' => true,
                    'time_out'    => 60,
                    'retry_times' => 1,
                ]
            ]);
        var_dump($res);
        var_dump(json_decode($res['response_content'], true));
    }

    public function testEleSecurityReset()
    {
        $gateway = new EleMeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->setNotifyUrl($this->notify)
            ->eleSecurityRest([
                [
                    'opr_id'      => $gateway->generateOperateId(),
                    'time_out'    => 60,
                    'must_online' => true,
                    'retry_times' => 1,
                    'cid'         => '200824015639',
                    'address'     => '200824015639',
                ]
            ]);
        var_dump($res);
        var_dump(json_decode($res['response_content'], true));
    }

    public function testCheckSign()
    {
//        $a = '{"response_content":"[{\"opr_id\":\"a300fd302b16c07229fa00c9aad01cb2\",\"resolve_time\":\"2020-10-22 15:09:59\",\"status\":\"SUCCESS\",\"data\":[{\"type\":33,\"value\":[\"0.0000\"],\"dsp\":\"0.0000 kW\"}]}]","timestamp":"1603350601","sign":"0831f01586a764512a0e30dadcb5888c"}';
//        $a = json_decode($a, true);
//        var_dump($a['response_content']);
        $arr = [
            "response_content" => '[{"opr_id":"a300fd302b16c07229fa00c9aad01cb2","resolve_time":"2020-10-22 15:09:59","status":"SUCCESS","data":[{"type":33,"value":["0.0000"],"dsp":"0.0000 kW"}]}]',
            "timestamp"        => "1603350601",
            "sign"             => '0831f01586a764512a0e30dadcb5888c'
        ];
        $n   = new Notify();
        $n->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->send($arr, function ($req) {
                if ($req !== false) {
                    var_dump($req);
                } else {
                    var_dump('签名错误');
                }
            });
    }

    public function testCheckSubscribe()
    {
        $_REQUEST['sign']    = '4297f44b13955235245b2497399d7a93';
        $_REQUEST['content'] = '123';

        $n = new Notify();
        $n->setSubscribeToken('bn9twoNwg9k9ENc1lcxL')
            ->subscribe($_REQUEST, function ($ret, $err) {
                var_dump($ret);
                var_dump($err);
            });
    }
}

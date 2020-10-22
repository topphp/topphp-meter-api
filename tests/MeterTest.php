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
    private $code   = '';
    private $nonce  = '';
    private $notify = 'http://n.kaituocn.com/';

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
                    'cid'         => '200824015639',
                    'address'     => '200824015639',
                    'must_online' => true,
                    'retry_times' => 1,
                    'type'        => 33,
                ]
            ]);
        var_dump($res);
        var_dump(json_decode($res['response_content']));
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
}

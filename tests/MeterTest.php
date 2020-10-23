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


    /**
     * 查询采集器状态
     * @author sleep
     */
    public function testCollectorQuery()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->collectorQuery([
                ['cid' => $this->num]
            ]);
        var_dump($res);
        var_dump(json_decode($res['response_content'], true));
    }

    /**
     * 查询电表状态
     * @author sleep
     */
    public function testEleMeterQuery()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->eleMeterQuery([
                ['cid' => $this->num]
            ]);
        var_dump($res);
        var_dump(json_decode($res['response_content'], true));
    }

    /**
     * 抄表
     * @author sleep
     */
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
                    'type'        => 40,
                    'cid'         => $this->num,
                    'address'     => $this->num,
                ],
            ]);
        var_dump($res);
        var_dump(json_decode($res['response_content'], true));
    }

    // 添加采集器
    public function testCollectorAdd()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->collectorAdd([
                ['cid' => $this->num]
            ]);
        var_dump(json_decode($res['response_content'], true));
    }

    //删除采集器
    public function testCollectorDel()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->collectorDelete([
                ['cid' => $this->num]
            ]);
        var_dump(json_decode($res['response_content'], true));
    }

    //添加电表
    public function testEleMeterAdd()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->eleMeterAdd([
                [
                    'cid'     => $this->num,
                    'address' => $this->num,
                    'model'   => '10573'
                ]
            ]);
        var_dump(json_decode($res['response_content']));
    }

    //删除电表
    public function testEleMeterDel()
    {
        $gateway = new MeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->eleMeterDelete([
                ['cid' => $this->num, 'address' => $this->num]
            ]);
        var_dump(json_decode($res['response_content']));
    }

    //开合闸
    public function testCtrl()
    {
        $gateway = new EleMeterClient();
        $res     = $gateway->setAuthCode($this->code)
            ->setNonce($this->nonce)
            ->setNotifyUrl($this->notify)
            ->eleControl([
                [
                    'opr_id'      => $gateway->generateOperateId(),
                    'time_out'    => 60,
                    'must_online' => true,
                    'retry_times' => 1,
                    //10:拉闸
                    //11:合闸
                    'type'        => 11,
                    'cid'         => $this->num,
                    'address'     => $this->num,
                ],
            ]);
        var_dump($res);
        var_dump(json_decode($res['response_content'], true));
    }

    //清零
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
                    'cid'         => $this->num,
                    'address'     => $this->num,
                    'params'      => [
                        'account_id' => "0"
                    ]
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
        $n = new Notify();
        $n->setSubscribeToken($this->token)
            ->subscribe(function ($ret, $err) {
                var_dump($ret);
                var_dump($err);
            });
    }
}

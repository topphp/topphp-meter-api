<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * Project: topphp-meter-api
 * Date: 2020/10/17 8:56 下午
 * Author: sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpMeterApi\TqMeter\AsyncApi;

use Topphp\TopphpMeterApi\TqMeter\Gateway;

class EleMeterClient extends Gateway
{
    /**
     * 抄电表数据
     * @param array $request
     * 示例:[{"opr_id": "be0b6a276a8f41ac865512c1404c3c4b",
     * "time_out": 0, "must_online": true, "retry_times": 1,
     * "cid": "19020618114", "address": "000066660942", "type": 3}]
     * 电表抄表类型:(type)
     * 3:正向有功总电能
     * 4:反向有功总电能
     * 5:正向无功总电能
     * 6:反向无功总电能
     * 27:A相电流
     * 30:A相电压
     * 33:瞬时有功功率
     * 34:瞬时无功功率
     * @param string $notifyUrl 系统处理完查询请求后，通过这个回调地址，把数据推送给请求方
     * @return array
     * @author sleep
     */
    public function eleRead(array $request, string $notifyUrl)
    {
        return $this
            ->setNotifyUrl($notifyUrl)
            ->requestAsync('/Api_v2/ele_read', $request);
    }

    /**
     * 设置电表参数
     * @param array $request
     * 示例:[{"opr_id": "d8c5055e10e845d59f2c11153d3d33d2", "time_out": 0,
     * "must_online": true, "retry_times": 1,
     * "cid": "19020618114", "address": "000066660942",
     * "params": {"p1": 200,"p2" :100}, "type": 24}]
     * 电表设置类型:(type)
     * 12:设置费率电价
     * 13:设置阶梯电价
     * 14:设置阶梯值
     * 23:设置电流互感器变比
     * 24:设置一级报警金额
     * 25:设置二级报警金额
     * params: 设置的参数值map，操作需要一个值，则设置key为p1，需要两个值得操作，key为p1，p2，以此类推
     * @param string $notifyUrl
     * @return array
     * @author sleep
     */
    public function eleWrite(array $request, string $notifyUrl)
    {
        return $this
            ->setNotifyUrl($notifyUrl)
            ->requestAsync('/Api_v2/ele_write', $request);
    }

    /**
     * 电表拉合闸
     * @param array $request
     * 示例:[{"opr_id": "be0b6a276a8f41ac865512c1404c3c4b",
     * "time_out": 0, "must_online": true, "retry_times": 1,
     * "cid": "19020618114", "address": "000066660942", "type": 10}]
     * 电表控制类型:(type)
     * 10:拉闸
     * 11:合闸
     * @param string $notifyUrl
     * @return array
     * @author sleep
     */
    public function eleControl(array $request, string $notifyUrl)
    {
        return $this
            ->setNotifyUrl($notifyUrl)
            ->requestAsync('/Api_v2/ele_control', $request);
    }

    /**
     * 电表清零
     * @param array $request
     * [{"opr_id": "a1ca6ed8ce26488a9f00efb35c4799d9", "time_out": 0,
     * "must_online": true, "retry_times": 1, "cid": "19020618114","address": "000066660942",
     * "params": {"account_id": "123456"}}]
     * params: 清零操作所需要的数据
     * @param string $notifyUrl
     * @return array
     * @author sleep
     */
    public function eleSecurityRest(array $request, string $notifyUrl)
    {
        return $this
            ->setNotifyUrl($notifyUrl)
            ->requestAsync('/Api_v2/ele_security/reset', $request);
    }

    /**
     * 电表开户
     * @param array $request
     * 示例:[{"opr_id": "f17c5cc33ca947e18e081fc911ed9c08", "time_out": 0, "must_online": true,
     * "retry_times": 1, "cid": "19020618114", "address": "000066660942",
     * "params": {"account_id": "123456", "count": "1", "money": "100"}}]
     * params: 操作所需的数据，account_id：账户id，count：充值次数，开户时都填1，money：开户初始金额
     * @param string $notifyUrl
     * @return mixed
     * @author sleep
     */
    public function eleSecurityOpenAccount(array $request, string $notifyUrl)
    {
        return $this
            ->setNotifyUrl($notifyUrl)
            ->requestAsync('/Api_v2/ele_security/open_acount', $request);
    }

    /**
     * 电表充值
     * @param array $request
     * 示例:[{"opr_id": "f17c5cc33ca947e18e081fc911ed9c08", "time_out": 0,
     * "must_online": true, "retry_times": 1, "cid": "19020618114", "address": "000066660942",
     * "params": {"account_id": "123456", "count": "2", "money": "100"}}]
     * params: 操作所需的数据，account_id：账户id，count：充值次数，每次充值成功后，值都需要增加1，money：充值金额
     * @param string $notifyUrl
     * @return mixed
     * @author sleep
     */
    public function eleSecurityRecharge(array $request, string $notifyUrl)
    {
        return $this
            ->setNotifyUrl($notifyUrl)
            ->requestAsync('/Api_v2/ele_security/recharge', $request);
    }
}

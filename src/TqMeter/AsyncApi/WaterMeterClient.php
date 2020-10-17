<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * Project: topphp-meter-api
 * Date: 2020/10/17 9:35 下午
 * Author: sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpMeterApi\TqMeter\AsyncApi;

use Topphp\TopphpMeterApi\TqMeter\Gateway;

class WaterMeterClient extends Gateway
{
    /**
     * 抄水表数据
     * @param array $request
     * 示例:[{"opr_id": "ece49fbc76ea48f18b217eec47c0a1e0", "time_out": 0,
     * "must_online": true, "retry_times": 1, "cid": "10000000031", "address": "20040900000003", "type": 42},
     * {"opr_id": "10d9cf7ac3ea4ffd9ec2216e07a17d6e", "time_out": 0,
     * "must_online": true, "retry_times": 1, "cid": "88020206100", "address": "C1E81000007859", "type": 42}]
     * 水表抄表类型:(type)
     * 42:抄水表数据
     * @return mixed
     * @author sleep
     */
    public function waterRead(array $request)
    {
        return $this->requestAsync('/Api_v2/water_read', $request);
    }

    /**
     * 水表开关阀
     * @param array $request
     * [{"opr_id": "df9ac96cdefd475a97d3ea259a05f7fd", "time_out": 0, "must_online": true,
     * "retry_times": 1, "cid": "10000000031", "address": "20040900000003", "type": 53},
     * {"opr_id": "7be8a8e292f145eea63a67c088a6f14b", "time_out": 0, "must_online": true,
     * "retry_times": 1, "cid": "88020206100", "address": "C1E81000007859", "type": 53}]
     * 水表控制类型:(type)
     * 43:开阀
     * 53:关阀
     * @return mixed
     * @author sleep
     */
    public function waterControl(array $request)
    {
        return $this->requestAsync('/Api_v2/water_control', $request);
    }

    /**
     * 水表清零
     * @param array $request
     * 示例: [{"opr_id": "65f34b202d0949578a39795e1d9b2b80", "time_out": 0, "must_online": true,
     * "retry_times": 1, "cid": "88020206100", "address": "C1E81000007859"}]
     * @return mixed
     * @author sleep
     */
    public function waterSecurityReset(array $request)
    {
        return $this->requestAsync('/Api_v2/water_security/reset', $request);
    }

    /**
     * 水表充值
     * @param array $request
     * 示例: [{"opr_id": "35e5d3a98e954fd89c70448b54c8c158", "time_out": 0, "must_online": true,
     * "retry_times": 1, "cid": "88020206100", "address": "C1E81000007859",
     * "params": {"price": "5", "count": "1", "money": "100"}}]
     * params: 操作所需的数据，price：用水价格，count：充值次数，每次充值成功后，值都需要增加1，money：充值金额，在同步模式下，只需要传递money参数
     * @return mixed
     * @author sleep
     */
    public function waterSecurityRecharge(array $request)
    {
        return $this->requestAsync('/Api_v2/water_security/recharge', $request);
    }

    /**
     * 水价设置
     * @param array $request
     * [{"opr_id": "eb8dc0e967664e289f9f1204065c6c25", "time_out": 0, "must_online": true,
     * "retry_times": 1, "cid": "10000000031", "address": "20040900000003",
     * "params": {"p1":"1","p2":"2","p3":"3","p4":"40","p5":"50"}}]
     * params: 操作所需的数据，p1：一阶水价，p2：二阶水价，p3：三阶水价，p4：二阶起始值，p5：三阶起始值
     * @return mixed
     * @author sleep
     */
    public function waterWritePrice(array $request)
    {
        return $this->requestAsync('/Api_v2/water_write/price', $request);
    }
}

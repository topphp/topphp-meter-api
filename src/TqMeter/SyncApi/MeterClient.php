<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * Project: topphp-meter-api
 * Date: 2020/10/17 8:38 下午
 * Author: sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpMeterApi\TqMeter\SyncApi;

use Topphp\TopphpMeterApi\TqMeter\Gateway;

/**
 * 同步操作数据接口
 * Class MeterClient
 * @package Topphp\TopphpMeterApi\TqMeter\SyncApi
 */
class MeterClient extends Gateway
{
    /**
     * 4.1 采集器添加
     * @param array $request 传入采集器id列表添加指定的采集器
     * 示例: [{"cid": "12345678901"}, {"cid": "19020618114"}]
     * @return array
     * @author sleep
     */
    public function collectorAdd(array $request)
    {
        return $this->request('/Api_v2/collector/add', $request, 'v2');
    }

    /**
     * 4.2 采集器删除
     * @param array $request 传入采集器id列表删除指定的采集器
     * 示例: [{"cid": "12345678901"}, {"cid": "29020618114"}, {"cid": "19020618114"}, {"cid": "1902061811411"}]
     * @return array
     * @author sleep
     */
    public function collectorDelete(array $request)
    {
        return $this->request('/Api_v2/collector/add', $request, 'v2');
    }

    /**
     * 4.3 采集器档案查询
     * @param array $request 查询所有采集器传值：[]，传入采集器id列表查询指定的采集器
     * 示例: [{"cid":"100000000101"},{"cid":"10000000101"},{"cid":"1000000101"},{"cid":"500000000101"}]
     * @return array
     * @author sleep
     */
    public function collectorQuery(array $request)
    {
        return $this->request('/Api_v2/collector/query', $request, 'v2');
    }

    /**
     * 4.4 电能表添加
     * @param array $request 传入由采集器id，表地址组成的键值对列表，添加指定的电能表信息
     * 示例:[{"cid": "19020618114", "address": "000066660942"},{"cid": "11335577990", "address": "000066660942"}]
     * @return array
     * @author sleep
     */
    public function eleMeterAdd(array $request)
    {
        return $this->request('/Api_v2/ele_meter/add', $request, 'v2');
    }

    /**
     * 4.5 电能表删除
     * @param array $request 传入由采集器id，表地址组成的键值对列表，删除指定的电能表信息
     * 示例:[{"cid": "19020618114", "address": "000066660942"},{"cid": "11335577990", "address": "000066660942"}]
     * @return array
     * @author sleep
     */
    public function eleMeterDelete(array $request)
    {
        return $this->request('/Api_v2/ele_meter/delete', $request, 'v2');
    }

    /**
     * 4.6 电能表档案查询
     * @param array $request 传入由采集器id，查询指定的采集器下所有电能表信息
     * 示例:[{"cid": "19020618114"}]
     * @return array
     * @author sleep
     */
    public function eleMeterQuery(array $request)
    {
        return $this->request('/Api_v2/ele_meter/query', $request, 'v2');
    }

    /**
     * 4.7 水表添加
     * @param array $request 传入由采集器id，表地址组成的键值对列表，添加指定的水表信息
     * 示例:[{"cid": "19020618114", "address": "000066660942"},{"cid": "11335577990", "address": "000066660942"}]
     * @return array
     * @author sleep
     */
    public function waterMeterAdd(array $request)
    {
        return $this->request('/Api_v2/water_meter/add', $request, 'v2');
    }

    /**
     * 4.8 水表删除
     * @param array $request 传入由采集器id，表地址组成的键值对列表，删除指定的水表信息
     * 示例:[{"cid": "19020618114", "address": "000066660942"},{"cid": "11335577990", "address": "000066660942"}]
     * @return array
     * @author sleep
     */
    public function waterMeterDelete(array $request)
    {
        return $this->request('/Api_v2/water_meter/delete', $request, 'v2');
    }

    /**
     * 4.9 水表档案查询
     * @param array $request 传入由采集器id，查询指定的采集器下所有水表信息
     * 示例:[{"cid": "19020618114"}]
     * @return array
     * @author sleep
     */
    public function waterMeterQuery(array $request)
    {
        return $this->request('/Api_v2/water_meter/query', $request, 'v2');
    }
}

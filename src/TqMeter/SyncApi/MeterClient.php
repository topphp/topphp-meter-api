<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * Project: topphp-meter-api
 * Date: 2020/10/17 8:38 下午
 * Author: sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpMeterApi\TqMeter\SyncApi;

use Topphp\TopphpClient\guzzle\HttpHelper;
use Topphp\TopphpMeterApi\TqMeter\Gateway;

/**
 * 同步操作数据接口
 * Class MeterClient
 * @package Topphp\TopphpMeterApi\TqMeter\SyncApi
 */
class MeterClient extends Gateway
{
    /**
     * 一、查询历史数据接口
     * @param array $request
     * /Api/DataRequest?type=json&auth=123456789&offset=100&&functionids=3,4,5&&
     * limit=500&start_time=2017-01-01 00:00:00&end_time=2018-01-01 00:00:00
     * 功能分类(functionids 对应功能)
     * 3. 正向有功总电能
     * 4. 反向有功总电能
     * 5. 正向无功总电能
     * 6. 反向无功总电能
     * 15. ABC三相电压
     * 16. ABC三相电流
     * 17. ABC三相有功功率
     * 18. ABC三相无功功率
     * 22. 剩余金额
     * 27. A相电流
     * 28. B相电流
     * 29. C相电流
     * 30. A相电压
     * 31. B相电压
     * 32. C相电压
     * 33. 瞬时有功功率
     * 34. 瞬时无功功率
     * 42. 水表数据
     * @return mixed
     * @author sleep
     */
    public function dataRequest(array $request)
    {
        return $this->get('/Api/DataRequest', $request);
    }

    /**
     * 二、查询设备列表和当前状态
     * @param array $request
     * @return mixed
     * @author sleep
     */
    public function meter(array $request = [])
    {
        return $this->get('/Api/Meter', $request);
    }

    /**
     * 三、查询采集器列表和当前状态
     * @param array $request
     * @return mixed
     * @author sleep
     */
    public function collector(array $request = [])
    {
        return $this->get('/Api/Collector', $request);
    }

    /**
     * 四、查询价格档案
     * @param array $request
     * @return mixed
     * @author sleep
     */
    public function price(array $request = [])
    {
        return $this->get('/Api/Price', $request);
    }

    /**
     * 五、查询用户档案
     * @param array $request
     * @return mixed
     * @author sleep
     */
    public function user(array $request = [])
    {
        return $this->get('/Api/User', $request);
    }

    /**
     * 六、查询参数档案
     * @param array $request
     * @return mixed
     * @author sleep
     */
    public function param(array $request = [])
    {
        return $this->get('/Api/Param', $request);
    }

    /**
     * 七、查询电表当前状态数据
     * @param array $request
     * @return mixed
     * @author sleep
     */
    public function eleMeterState(array $request = [])
    {
        return $this->get('/Api/EleMeterState', $request);
    }

    /**
     * 八、查询水表当前状态数据
     * @param array $request
     * @return mixed
     * @author sleep
     */
    public function waterMeterState(array $request = [])
    {
        return $this->get('/Api/WaterMeterState', $request);
    }

    /*==========================================================================================*/
    /*=============================以下是 v2同步接口===============================================*/
    /*==========================================================================================*/

    /**
     * 4.1 采集器添加
     * @param array $request 传入采集器id列表添加指定的采集器
     * 示例: [{"cid": "12345678901"}, {"cid": "19020618114"}]
     * @return array
     * @author sleep
     */
    public function collectorAdd(array $request)
    {
        return $this->request('/Api_v2/collector/add', $request);
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
        return $this->request('/Api_v2/collector/add', $request);
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
        return $this->request('/Api_v2/collector/query', $request);
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
        return $this->request('/Api_v2/ele_meter/add', $request);
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
        return $this->request('/Api_v2/ele_meter/delete', $request);
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
        return $this->request('/Api_v2/ele_meter/query', $request);
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
        return $this->request('/Api_v2/water_meter/add', $request);
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
        return $this->request('/Api_v2/water_meter/delete', $request);
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
        return $this->request('/Api_v2/water_meter/query', $request);
    }

    /**
     * v1接口调用方法
     * @param $url
     * @param $requestContent
     * @return mixed
     * @author sleep
     */
    public function get($url, $requestContent = [])
    {
        $data = ["auth" => $this->getAuthCode()];
        $data = array_merge($data, $requestContent);
        var_dump($this->getApi1() . $url . '?' . http_build_query($data));
        return HttpHelper::get($this->getApi1() . $url, $data);
    }
}

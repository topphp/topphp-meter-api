<?php

// 授权码 后台获取
$auth_code = "37577f8fb62a7b14ba55cc6faec5a142";
// 随机字符串 后台获取
$nonce = "XOfX547SeCIlhufeeBBwgZIN";
//异步通知地址（服务如果部署在内网，在公网无法直接访问到，需要在路由器上配置端口映射，或者配置内网穿透工具来实现访问）
$notify_url = "http://115.221.15.8:8044/notify";


function main()
{
//    同步接口---------------
    采集器添加();
    采集器删除();
    查询N个采集器();
    查询全部采集器();

    电能表添加();
    电能表删除();
    电能表档案查询();

    水表添加();
    水表删除();
    水表档案查询();

//    操作状态查询();
//    取消操作();

//    异步接口---------------
//    抄电表数据();
//    设置电表参数();
//    电表拉闸();
//    电表合闸();
    电表清零_同步模式();
    电表清零_非同步模式();
    电表开户_同步模式();
    电表开户_非同步模式();
//    电表充值_同步模式();
//    电表充值_非同步模式();

//    抄水表数据();
//    水表关阀();
//    水表开阀();
//    水表清零();
//    Mbus水表充值_同步模式();
//    Mbus水表充值_非同步模式();
//    Lora水表充值_同步模式();
//    Lora水表充值_非同步模式();

//    Lora普通预付费水表设置水价();
//    Lora阶梯预付费水表设置水价();


//     第一套数据接口--------------
//     查询历史数据接口();
//     查询设备列表和当前状态();
//     查询采集器列表和当前状态();
//     查询价格档案();
//     查询用户档案();
//     查询参数档案();
//     查询电表当前状态数据();
//     查询水表当前状态数据();

}

function 查询设备列表和当前状态()
{
//    查询设备列表和当前状态
    $url = "http://api1.tqdianbiao.com/Api/Meter";
    global $auth_code;
    $params = ["auth" => $auth_code];
    $url    = $url . "?" . http_build_query($params);
    $resp   = file_get_contents($url);

    simple_request_print(__FUNCTION__, $resp, $url);
}

function 查询采集器列表和当前状态()
{
//    查询采集器列表和当前状态
    $url = "http://api1.tqdianbiao.com/Api/Collector";
    global $auth_code;
    $params = ["auth" => $auth_code];
    $url    = $url . "?" . http_build_query($params);
    $resp   = file_get_contents($url);

    simple_request_print(__FUNCTION__, $resp, $url);
}

function 查询价格档案()
{
//    查询价格档案
    $url = "http://api1.tqdianbiao.com/Api/Price";
    global $auth_code;
    $params = ["auth" => $auth_code];
    $url    = $url . "?" . http_build_query($params);
    $resp   = file_get_contents($url);

    simple_request_print(__FUNCTION__, $resp, $url);
}

function 查询用户档案()
{
//    查询用户档案
    $url = "http://api1.tqdianbiao.com/Api/User";
    global $auth_code;
    $params = ["auth" => $auth_code];
    $url    = $url . "?" . http_build_query($params);
    $resp   = file_get_contents($url);

    simple_request_print(__FUNCTION__, $resp, $url);
}

function 查询参数档案()
{
//    查询参数档案
    $url = "http://api1.tqdianbiao.com/Api/Param";
    global $auth_code;
    $params = ["auth" => $auth_code];
    $url    = $url . "?" . http_build_query($params);
    $resp   = file_get_contents($url);

    simple_request_print(__FUNCTION__, $resp, $url);
}

function 查询电表当前状态数据()
{
//    查询电表当前状态数据
    $url = "http://api1.tqdianbiao.com/Api/EleMeterState";
    global $auth_code;
    $params = ["auth" => $auth_code];
    $url    = $url . "?" . http_build_query($params);
    $resp   = file_get_contents($url);

    simple_request_print(__FUNCTION__, $resp, $url);
}

function 查询水表当前状态数据()
{
//    查询水表当前状态数据
    $url = "http://api1.tqdianbiao.com/Api/WaterMeterState";
    global $auth_code;
    $params = ["auth" => $auth_code];
    $url    = $url . "?" . http_build_query($params);
    $resp   = file_get_contents($url);

    simple_request_print(__FUNCTION__, $resp, $url);
}

function 查询历史数据接口()
{
//    查询历史数据接口
    $url = "http://api1.tqdianbiao.com/Api/DataRequest";
    global $auth_code;
    $params = [
        "auth"        => $auth_code,                 # 授权码
        "type"        => "json",                     # 数据返回类型
        "functionids" => "3,4,5",                    # 请求数据类型
        "start_time"  => "2020-01-01 00:00:00",      # 起始时间
        "end_time"    => "2020-06-01 00:00:00",      # 结束时间
        "offset"      => 0,                          # 数据偏移量
        "limit"       => 100                         # 返回数据数量
    ];
    $url    = $url . "?" . http_build_query($params);
    $resp   = file_get_contents($url);

    simple_request_print(__FUNCTION__, $resp, $url);
}

function simple_request_print($name, $resp, $url)
{
    echo $name . "\n";
    echo "请求地址：" . $url . "\n";
    echo "返回数据：" . $resp . "\n";

}

function Lora水表充值_非同步模式()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/water_security/recharge";
    # 请求内容，调用接口所需要的数据（Lora水表充值，非同步模式）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "10000000031",
            "address"     => "20040900000003",
            "params"      => [
                "count" => "2",
                "money" => "100",
            ]
        ]
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function Lora水表充值_同步模式()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/water_security/recharge";
    # 请求内容，调用接口所需要的数据（Lora水表充值，同步模式）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "10000000031",
            "address"     => "20040900000003",
            "params"      => [
                "money" => "100",
            ]

        ],
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function Lora普通预付费水表设置水价()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/water_write/price";
    # 请求内容，调用接口所需要的数据（Lora普通预付费水表设置水价）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "10000000031",
            "address"     => "20040900000003",
            "params"      => [
                "p1" => "1",
            ]
        ]
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function Lora阶梯预付费水表设置水价()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/water_write/price";
    # 请求内容，调用接口所需要的数据（Lora阶梯预付费水表设置水价）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "10000000031",
            "address"     => "20040900000003",
            "params"      => [
                "p1" => "1",
                "p2" => "2",
                "p3" => "3",
                "p4" => "40",
                "p5" => "50",
            ]

        ],
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function Mbus水表充值_非同步模式()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/water_security/recharge";
    # 请求内容，调用接口所需要的数据（Mbus水表充值，非同步模式）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "88020206100",
            "address"     => "C1E81000007859",
            "params"      => [
                "price" => "5",
                "count" => "2",
                "money" => "100",
            ]
        ]
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function Mbus水表充值_同步模式()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/water_security/recharge";
    # 请求内容，调用接口所需要的数据（Mbus水表充值，同步模式）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "88020206100",
            "address"     => "C1E81000007859",
            "params"      => [
                "money" => "100",
            ]

        ],
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function 电表充值_非同步模式()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/ele_security/recharge";
    # 请求内容，调用接口所需要的数据（电表充值，非同步模式）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "19020618114",
            "address"     => "000066660942",
            "params"      => [
                "account_id" => "123456",
                "count"      => "2",
                "money"      => "100",
            ]
        ]
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function 电表充值_同步模式()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/ele_security/recharge";
    # 请求内容，调用接口所需要的数据（电表充值，同步模式）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "19020618114",
            "address"     => "000066660942",
            "params"      => [
                "money" => "100",
            ]

        ],
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function 电表开户_非同步模式()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/ele_security/open_acount";
    # 请求内容，调用接口所需要的数据（电表开户，非同步模式）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "19020618114",
            "address"     => "000066660942",
            "params"      => [
                "account_id" => "123456",
                "count"      => "1",
                "money"      => "100",
            ]
        ]
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function 电表开户_同步模式()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/ele_security/open_acount";
    # 请求内容，调用接口所需要的数据（电表开户，同步模式）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "19020618114",
            "address"     => "000066660942",
            "params"      => [
                "money" => "100",
            ]

        ],
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function 电表清零_非同步模式()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/ele_security/reset";
    # 请求内容，调用接口所需要的数据（电表清零，非同步模式）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "19020618114",
            "address"     => "000066660942",
            "params"      => ["account_id" => "123456"]
        ]
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function 水表清零()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/water_security/reset";
    # 请求内容，调用接口所需要的数据（水表清零）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "88020206100",
            "address"     => "C1E81000007859",
        ],
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function 电表清零_同步模式()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/ele_security/reset";
    # 请求内容，调用接口所需要的数据（电表清零，同步模式）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "19020618114",
            "address"     => "000066660942",
        ],
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function 电表拉闸()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/ele_control";
    # 请求内容，调用接口所需要的数据（电表拉闸）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "19020618114",
            "address"     => "000066660942",
            "type"        => 10
        ]
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function 电表合闸()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/ele_control";
    # 请求内容，调用接口所需要的数据（电表合闸）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "19020618114",
            "address"     => "000066660942",
            "type"        => 11
        ],
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function 水表关阀()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/water_control";
    # 请求内容，调用接口所需要的数据（水表关阀）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "88020206100",
            "address"     => "C1E81000007859",
            "type"        => 53
        ]
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function 水表开阀()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/water_control";
    # 请求内容，调用接口所需要的数据（水表开阀）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "88020206100",
            "address"     => "C1E81000007859",
            "type"        => 43
        ],
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function 设置电表参数()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/ele_write";
    # 请求内容，调用接口所需要的数据（一级报警值）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "19020618114",
            "address"     => "000066660942",
            "params"      => ["p1" => "200"],
            "type"        => 24
        ]
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}

function 抄电表数据()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/ele_read";
    # 请求内容，调用接口所需要的数据（抄电表数据）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "19020618114",
            "address"     => "000066660942",
            "type"        => 3
        ]
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}


function 抄水表数据()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/water_read";
    # 请求内容，调用接口所需要的数据（抄水表数据）
    $req             = [
        [
            "opr_id"      => generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "88020206100",
            "address"     => "C1E81000007859",
            "type"        => 42
        ]
    ];
    $request_content = json_encode($req);
    testApiAsync(__FUNCTION__, $url, $request_content);
}


function generateOperateId()
{
    return md5(uniqid(mt_rand(), true));
}


function 电能表档案查询()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/ele_meter/query";
    # 请求内容，调用接口所需要的数据（查询指定的采集器下的电能表信息）
    $req             = [
        ["cid" => "12345678901"],     // 查询其他区域的采集器下的电能表(未找到采集器)
        ["cid" => "29020618114"],     // 查询不存在的采集器下的电能表(未找到采集器)
        ["cid" => "19020618114"],     // 查询本区域已经添加的采集器下的电能表(得到正确结果："address":["000066660942"])
        ["cid" => "1902061811411"],   // 查询不合法的采集器下的电能表(只支持11/12位采集器号)
    ];
    $request_content = json_encode($req);
    testApi(__FUNCTION__, $url, $request_content);
}


function 电能表删除()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/ele_meter/delete";
    // 请求内容，调用接口所需要的数据（删除指定的电能表信息）
    $req             = [
        ["cid" => "19020618114", "address" => "000066660942"],    # 合法数据
        ["cid" => "19020618114", "address" => "0000666609"],      # 不合法的表号
        ["cid" => "1902061811", "address" => "000066660942"],     # 不合法的采集器号
        ["cid" => "12345678901", "address" => "000066660942"],    # 非本区域采集器号
        ["cid" => "11335577990", "address" => "000066660942"],    # 不存在的采集器号
    ];
    $request_content = json_encode($req);
    testApi(__FUNCTION__, $url, $request_content);
}

function 电能表添加()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/ele_meter/add";
    // 请求内容，调用接口所需要的数据（添加指定的电能表信息）
    $req             = [
        ["cid" => "19020618114", "address" => "000066660942"],    # 合法数据
        ["cid" => "19020618114", "address" => "0000666609"],      # 不合法的表号
        ["cid" => "1902061811", "address" => "000066660942"],     # 不合法的采集器号
        ["cid" => "12345678901", "address" => "000066660942"],    # 非本区域采集器号
        ["cid" => "11335577990", "address" => "000066660942"],    # 不存在的采集器号
    ];
    $request_content = json_encode($req);
    testApi(__FUNCTION__, $url, $request_content);
}

function 水表档案查询()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/water_meter/query";
    # 请求内容，调用接口所需要的数据（查询指定的采集器下的水表信息）
    $req             = [
        ["cid" => "19020618114"],     // 查询本区域已经添加的采集器下的水表(得到正确结果："address":["000066660942"])
    ];
    $request_content = json_encode($req);
    testApi(__FUNCTION__, $url, $request_content);
}


function 水表删除()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/water_meter/delete";
    // 请求内容，调用接口所需要的数据（删除指定的水表信息）
    $req             = [
        ["cid" => "19020618114", "address" => "000066660942"],    # 合法数据
    ];
    $request_content = json_encode($req);
    testApi(__FUNCTION__, $url, $request_content);
}

function 水表添加()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/water_meter/add";
    // 请求内容，调用接口所需要的数据（添加指定的水表信息）
    $req             = [
        ["cid" => "19020618114", "address" => "000066660942"],    # 合法数据
    ];
    $request_content = json_encode($req);
    testApi(__FUNCTION__, $url, $request_content);
}


function 操作状态查询()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/request/status";
    // 请求内容，调用接口所需要的数据（操作状态查询）
    $req             = [
        ["opr_id" => "12345678901"],
    ];
    $request_content = json_encode($req);
    testApi(__FUNCTION__, $url, $request_content);
}


function 取消操作()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/request/cancel";
    // 请求内容，调用接口所需要的数据（取消操作）
    $req             = [
        ["opr_id" => "12345678901"],
    ];
    $request_content = json_encode($req);
    testApi(__FUNCTION__, $url, $request_content);
}


function 采集器删除()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/collector/delete";
    // 请求内容，调用接口所需要的数据（删除指定的采集器信息）
    $req             = [
        ["cid" => "12345678901"],     // 删除其他区域的采集器
        ["cid" => "29020618114"],     // 删除不存在的采集器
        ["cid" => "19020618114"],     // 删除本区域已经添加的采集器
        ["cid" => "1902061811411"],   // 删除不合法的采集器
    ];
    $request_content = json_encode($req);
    testApi(__FUNCTION__, $url, $request_content);
}

function 采集器添加()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/collector/add";
    // 请求内容，调用接口所需要的数据（添加指定的采集器信息）
    $req             = [
        ["cid" => "12345678901"],     // 采集器号被其他区域用户添加过的
        ["cid" => "19020618114"],     // 多次调用均会返回添加成功
    ];
    $request_content = json_encode($req);
    testApi(__FUNCTION__, $url, $request_content);
}

function 查询全部采集器()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/collector/query";
    // 请求内容，调用接口所需要的数据（查询所有采集器信息）
    $request_content = "[]";
    testApi(__FUNCTION__, $url, $request_content);
}

function 查询N个采集器()
{
    $url = "http://api2.tqdianbiao.com/Api_v2/collector/query";
    // 请求内容，调用接口所需要的数据（查询所有采集器信息）
    $req             = [
        ["cid" => "100000000101"],
        ["cid" => "10000000101"],
        ["cid" => "1000000101"],      // 采集器号不符合规范
        ["cid" => "50000000101"],     // 不存在的采集器
    ];
    $request_content = json_encode($req);
    testApi(__FUNCTION__, $url, $request_content);
}

function testApi($name, $url, $request_content)
{
    echo $name . "\n";
    $response = request($url, $request_content);
    printResponse($response);
    echo "\n";
}

function testApiAsync($name, $url, $request_content)
{
    echo $name . "\n";
    $response = requestAsync($url, $request_content);
    printResponse($response);
    echo "\n";
}

// 打印响应内容
function printResponse($response)
{
    $json   = json_decode($response, true);
    $status = $json["status"];
    if ($status != "SUCCESS") {
        echo $json["error_msg"];
    } else {
        $response_content = $json["response_content"];
        echo "response_content：" . $response_content . "\n";
        $items = json_decode($response_content, true);
        $index = 1;
        echo "返回结果：\n";
        foreach ($items as $item) {
            echo "[" . $index++ . "]\n";
            var_dump($item);
        }
    }
}

// 请求接口
function request($url, $request_content)
{
    global $auth_code;
    $data         = array(
        'auth_code'       => $auth_code,
        'timestamp'       => time(),
        'request_content' => $request_content
    );
    $sign         = getSign($data);
    $data['sign'] = $sign;

    $ret = sendHttpRequest($url, $data);
    return $ret;
}

// 请求异步接口
function requestAsync($url, $request_content)
{
    global $auth_code;
    global $notify_url;
    $data         = array(
        'auth_code'       => $auth_code,
        'timestamp'       => time(),
        'request_content' => $request_content,
        'notify_url'      => $notify_url
    );
    $sign         = getSign($data);
    $data['sign'] = $sign;

    $ret = sendHttpRequest($url, $data);
    return $ret;
}

// 生成签名字符串
function getSign(array $datas)
{
    // 按关键字排序
    ksort($datas);

    $tmp = "";

    foreach ($datas as $key => $value) {
        // 取各个字段内容拼接字符串
        $tmp .= $value;
    }

    // 加上双方约定随机字符串
    global $nonce;
    $tmp .= $nonce;

    // 计算哈希值
    return md5($tmp);
}

// 发送http请求
function sendHttpRequest($url, array $data)
{
    var_dump($data);
    $postdata = http_build_query($data);
    $options  = array(
        'http' => array(
            'method'  => 'POST',
            'header'  => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' => 15 * 60 // 超时时间（单位:s）
        )
    );

    echo "请求地址：" . $url . "\n";
    echo "发送参数：" . $postdata . "\n";
    $context = stream_context_create($options);
    $result  = file_get_contents($url, false, $context);
    echo "接口返回：" . $result . "\n";

    return $result;
}

main();



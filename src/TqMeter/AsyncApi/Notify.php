<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * Project: topphp-meter-api
 * Date: 2020/10/17 10:00 下午
 * Author: sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpMeterApi\TqMeter\AsyncApi;

use Closure;
use Topphp\TopphpMeterApi\TqMeter\Gateway;

class Notify extends Gateway
{
    public function send($request, Closure $callBack)
    {
        $sign            = $request["sign"];
        $timestamp       = $request["timestamp"];
        $responseContent = $request["response_content"];
        $check           = $this->checkSign($responseContent, $timestamp, $sign);
        if (!$check) {
//            echo "sign check failed";
            $callBack(false);
        } else {
//            echo 'SUCCESS';
            $callBack($responseContent);
        }
    }
}

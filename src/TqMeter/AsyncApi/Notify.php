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
    private $token = '';

    /**
     * @return string
     */
    public function getSubscribeToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Notify
     */
    public function setSubscribeToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * 异步通知回调
     * @param $request
     * @param Closure $callBack
     * @author sleep
     */
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

    /**
     * 订阅消息
     * @param Closure $callBack
     * @author sleep
     */
    public function subscribe(Closure $callBack)
    {
        $sign    = @getallheaders()["Sign"];
        $content = @file_get_contents('php://input');
        if ($content == '') {
            $callBack('返回数据为空', false);
            echo 'SUCCESS';
        } else {
            if (!$this->checkSubscribeSign($content, $sign)) {
//                echo "sign check failed";
                $callBack('签名错误', false);
            } else {
//                echo 'SUCCESS';
                $callBack($content, true);
            }
        }
    }

    /**
     * 订阅消息签名验证方法
     * @param $content
     * @param $sign
     * @return bool
     * @author sleep
     */
    public function checkSubscribeSign($content, $sign)
    {
        // 随机字符串 后台获取
        $buf    = $content . $this->getSubscribeToken();
        $encode = md5($buf);
        return $encode == $sign;
    }
}

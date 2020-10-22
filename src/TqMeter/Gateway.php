<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * Project: topphp-meter-api
 * Date: 2020/10/17 7:35 下午
 * Author: sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpMeterApi\TqMeter;

use Topphp\TopphpClient\guzzle\HttpHelper;

abstract class Gateway
{
    private $authCode  = '';
    private $nonce     = '';
    private $notifyUrl = '';
    // 随机字符串 后台获取
    private $api1 = 'http://api1.tqdianbiao.com';
    private $api2 = 'http://api2.tqdianbiao.com';

    /**
     * @return string
     */
    public function getAuthCode(): string
    {
        return $this->authCode;
    }

    /**
     * @param string $authCode
     * @return Gateway
     */
    public function setAuthCode(string $authCode): self
    {
        $this->authCode = $authCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getNonce(): string
    {
        return $this->nonce;
    }

    /**
     * @param string $nonce
     * @return Gateway
     */
    public function setNonce(string $nonce): self
    {
        $this->nonce = $nonce;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotifyUrl(): string
    {
        return $this->notifyUrl;
    }

    /**
     * @param string $notifyUrl
     * @return Gateway
     */
    public function setNotifyUrl(string $notifyUrl): self
    {
        $this->notifyUrl = $notifyUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getApi1(): string
    {
        return $this->api1;
    }

    /**
     * @param string $api1
     * @return Gateway
     */
    public function setApi1(string $api1): self
    {
        $this->api1 = $api1;
        return $this;
    }

    /**
     * @return string
     */
    public function getApi2(): string
    {
        return $this->api2;
    }

    /**
     * @param string $api2
     * @return Gateway
     */
    public function setApi2(string $api2): self
    {
        $this->api2 = $api2;
        return $this;
    }

    public function getSign(array $data)
    {
        // 按关键字排序
        ksort($data);
        $tmp = "";
        foreach ($data as $key => $value) {
            // 取各个字段内容拼接字符串
            $tmp .= $value;
        }
        // 加上双方约定随机字符串
        $tmp .= $this->getNonce();
        // 计算哈希值
        return md5($tmp);
    }

    public function checkSign($responseContent, $timestamp, $sign)
    {
        // 随机字符串 后台获取
        $nonce  = $this->getNonce();
        $buf    = $responseContent . $timestamp . $nonce;
        $encode = md5($buf);
        return $encode == $sign;
    }

    public function generateOperateId()
    {
        return md5(uniqid((string)mt_rand(), true));
    }

    /**
     * v2 同步请求
     * @param $url
     * @param $requestContent
     * @return mixed
     * @author sleep
     */
    public function request($url, $requestContent)
    {
        $data         = [
            'auth_code'       => $this->getAuthCode(),
            'timestamp'       => time(),
            'request_content' => json_encode($requestContent)
        ];
        $sign         = $this->getSign($data);
        $data['sign'] = $sign;
        $url          = $this->getApi2() . $url;
        return HttpHelper::post($url, $data, 'json', ['Content-Type' => 'application/json']);
    }

    /**
     * v2 异步请求
     * @param $url
     * @param $requestContent
     * @return mixed
     * @author sleep
     */
    public function requestAsync($url, $requestContent)
    {
        $data         = [
            'auth_code'       => $this->getAuthCode(),
            'timestamp'       => time(),
            'request_content' => json_encode($requestContent),
            'notify_url'      => $this->getNotifyUrl()
        ];
        $sign         = $this->getSign($data);
        $data['sign'] = $sign;
        $url          = $this->getApi2() . $url;
        return HttpHelper::post($url, $data, 'json', ['Content-Type' => 'application/json']);
    }
}

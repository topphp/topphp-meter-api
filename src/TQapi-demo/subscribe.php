<?php

// 启动服务
// php -S 0.0.0.0:8044 subscribe.php


define('STDOUT', fopen('php://stdout', 'a'));

function stdout($c)
{
    fwrite(STDOUT, $c);
}

function stdoutl($c)
{
    stdout($c . PHP_EOL);
}

function getHeader()
{
    $headers = array();
    foreach ($_SERVER as $key => $value) {
        if ('HTTP_' == substr($key, 0, 5)) {
            $headers[str_replace('_', '-', substr($key, 5))] = $value;
        }
        if (isset($_SERVER['PHP_AUTH_DIGEST'])) {
            $header['AUTHORIZATION'] = $_SERVER['PHP_AUTH_DIGEST'];
        } elseif (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
            $header['AUTHORIZATION'] = base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $_SERVER['PHP_AUTH_PW']);
        }
        if (isset($_SERVER['CONTENT_LENGTH'])) {
            $header['CONTENT-LENGTH'] = $_SERVER['CONTENT_LENGTH'];
        }
        if (isset($_SERVER['CONTENT_TYPE'])) {
            $header['CONTENT-TYPE'] = $_SERVER['CONTENT_TYPE'];
        }
    }
    return $headers;
}

// 验签
function checkSign($response_content, $sign)
{
    // 随机字符串 后台获取
    $token = "7O2wtcxNCvtSL7MtIOLs";

    $buf    = $response_content . $token;
    $encode = md5($buf);

    return $encode == $sign;
}


$sign             = getallheaders()["sign"];
$response_content = @file_get_contents('php://input');


if ($response_content == '') {
    echo 'SUCCESS';
} else {
    if (!checkSign($response_content, $sign)) {
        stdoutl("sign check failed");
        echo "sign check failed";
    } else {
        //-----------加入业务逻辑-----------
        stdoutl("接收推送：" . $response_content);

        //----------------------------------
        echo 'SUCCESS';
    }
}


?>

<?php

// 启动服务
// php -S 0.0.0.0:8044 notify.php


define('STDOUT', fopen('php://stdout', 'a'));

function stdout($c)
{
    fwrite(STDOUT, $c);
}

function stdoutl($c)
{
    stdout($c . PHP_EOL);
}

// 验签
function checkSign($response_content, $timestamp, $sign)
{
    // 随机字符串 后台获取
    $nonce = "XOfX547SeCIlhufeeBBwgZIN";

    $buf    = $response_content . $timestamp . $nonce;
    $encode = md5($buf);

    return $encode == $sign;
}


//var_dump($_SERVER);
//var_dump($_POST);


$sign             = $_POST["sign"];
$timestamp        = $_POST["timestamp"];
$response_content = $_POST["response_content"];

stdoutl("sign: " . $sign);
stdoutl("timestamp: " . $timestamp);
stdoutl("response_content: " . $response_content);

if (!checkSign($response_content, $timestamp, $sign)) {
    stdoutl("sign check failed");
    echo "sign check failed";
} else {
    stdoutl("sign check success");
    //-----------加入业务逻辑-----------
    //----------------------------------
    echo 'SUCCESS';
}

?>

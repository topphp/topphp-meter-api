# topphp/topphp-meter-api

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## 本模块集成了水电表的api
目前对接了拓强水电表
接口地址:http://doc-api.tqdianbiao.com/#/home/welcome
## Structure
> 组件结构

```
bin/        
build/
docs/
config/
src/
tests/
vendor/
```
3个文件使用说明
```
TqMeter/AsyncApi/EleMeterClient.php 异步电表接口
TqMeter/AsyncApi/WaterMeterClient.php 异步水表接口
MeterClient.php 同步水电表操作接口
```

## Install

Via Composer

``` bash
$ composer require topphp/topphp/topphp-meter-api
```

## Usage
```php
//同步
$gateway = new MeterClient();
$res     = $gateway->setAuthCode('37577f8fb62a7b14ba55cc6faec5a142')
    ->setNonce('XOfX547SeCIlhufeeBBwgZIN')
    ->collectorQuery([]);
var_dump($res);

// 异步
$gateway = new EleMeterClient();
$res     = $gateway->setAuthCode('37577f8fb62a7b14ba55cc6faec5a142')
    ->setNonce('XOfX547SeCIlhufeeBBwgZIN')
    ->setNotifyUrl('')
    ->eleSecurityOpenAccount([
        [
            "opr_id"      => $gateway->generateOperateId(),
            "time_out"    => 0,
            "must_online" => true,
            "retry_times" => 1,
            "cid"         => "19020618114",
            "address"     => "000066660942",
            "params"      => [
                "money" => "100",
            ]
        ],
    ], '');
var_dump($res);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email sleep@kaituocn.com instead of using the issue tracker.

## Credits

- [topphp][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/topphp/topphp/topphp-meter-api.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/topphp/topphp/topphp-meter-api/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/topphp/topphp/topphp-meter-api.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/topphp/topphp/topphp-meter-api.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/topphp/topphp/topphp-meter-api.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/topphp/topphp/topphp-meter-api
[link-travis]: https://travis-ci.org/topphp/topphp/topphp-meter-api
[link-scrutinizer]: https://scrutinizer-ci.com/g/topphp/topphp/topphp-meter-api/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/topphp/topphp/topphp-meter-api
[link-downloads]: https://packagist.org/packages/topphp/topphp/topphp-meter-api
[link-author]: https://github.com/topphp
[link-contributors]: ../../contributors

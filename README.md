# maccotsan\CarbonJp

[![Build Status](https://travis-ci.org/maccotsan/CarbonJp.svg?branch=master)](https://travis-ci.org/maccotsan/CarbonJp)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/maccotsan/CarbonJp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maccotsan/CarbonJp/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/maccotsan/CarbonJp/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/maccotsan/CarbonJp/?branch=master)

## Install
please rewrite your composer.json.
````
・・・
    "repositories": [
            {
                "type": "vcs",
                "url": "https://github.com/maccotsan/CarbonJp.git"
            }
        ],
        "require": {
            "maccotsan/carbonjp": "dev-master"
        }
・・・
````

## Usage

````
use maccotsan\Carbon\CarbonJp;
CarbonJp::parse("1989-01-08T12:00:00+09:00(JST)")->eraName; // => '平成'
CarbonJp::parse("1989-01-08T12:00:00+09:00(JST)")->eraNameShort; // => 'H'
CarbonJp::parse("1989-01-08T12:00:00+09:00(JST)")->yearJp; // => 1
CarbonJp::parse("1989-01-08T12:00:00+09:00(JST)")->yearJpGan; // => '元'
CarbonJp::parse("1989-01-08T12:00:00+09:00(JST)")->dayOfWeekJp; // => '日'
CarbonJp::parse("1989-01-08T12:00:00+09:00(JST)")->ampmJp; // => '午後'

CarbonJp::parse("2016-09-02T15:03:08+09:00(JST)")->format("JK年m月d日(x) Eh時i分s秒"); // => '平成28年09月02日(金) 午後03時03分08秒'
````

## Document
https://maccotsan.github.io/CarbonJp/

## UnitTest
````
composer install --dev
composer test
````

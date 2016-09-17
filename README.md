# maccotsan\CarbonJp

[![Build Status](https://travis-ci.org/maccotsan/CarbonJp.svg?branch=master)](https://travis-ci.org/maccotsan/CarbonJp)

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
CarbonJp::parse("1989-01-08 12:00:00")->eraName; // => '平成'
CarbonJp::parse("1989-01-08 12:00:00")->eraNameShort; // => 'H'
CarbonJp::parse("1989-01-08 12:00:00")->yearJp; // => 1
CarbonJp::parse("1989-01-08 12:00:00")->yearJpGan; // => '元'
CarbonJp::parse("1989-01-08 12:00:00")->dayOfWeekJp; // => '日'
CarbonJp::parse("1989-01-08 12:00:00")->ampmJp; // => '午後'

CarbonJp::parse("2016-09-02 15:03:08")->format("JK年m月d日(x) Eh時i分s秒"); // => '平成28年09月02日(金) 午後03時03分08秒'
````

## UnitTest
````
composer install --dev
composer test
````

<?php
/**
 * maccotsan/CarbonJp
 *
 * @copyright 2016 maccotsan <maccotsan@gmail.com>
 * @license The MIT License (MIT)
 */

namespace maccotsan\Carbon;

/**
 * Class CarbonJpTest
 * @package maccotsan\StringTool
 */
class CarbonJpTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * 和暦（元号）
	 */
	public function testEraName()
	{
		// 平成 1989/01/08 〜
		$date = CarbonJp::parse("2016-01-01");
		$expected = "平成";
		$this->assertEquals($expected, $date->eraName);

		$date = CarbonJp::parse("1989-01-08 00:00:00");
		$expected = "平成";
		$this->assertEquals($expected, $date->eraName);

		// 昭和 1926/12/25 〜 1989/01/07
		$date = CarbonJp::parse("1989-01-07 23:59:59");
		$expected = "昭和";
		$this->assertEquals($expected, $date->eraName);

		$date = CarbonJp::parse("1926-12-25 00:00:00");
		$expected = "昭和";
		$this->assertEquals($expected, $date->eraName);

		// 大正 1912/07/30 〜 1926/12/24
		$date = CarbonJp::parse("1926-12-24 23:59:59");
		$expected = "大正";
		$this->assertEquals($expected, $date->eraName);

		$date = CarbonJp::parse("1913-07-30 00:00:00");
		$expected = "大正";
		$this->assertEquals($expected, $date->eraName);

		// 明治 1868/01/25 〜 1912/07/29
		$date = CarbonJp::parse("1912-07-29 23:59:59");
		$expected = "明治";
		$this->assertEquals($expected, $date->eraName);

		$date = CarbonJp::parse("1868-01-25 00:00:00");
		$expected = "明治";
		$this->assertEquals($expected, $date->eraName);

		try {
			$date = CarbonJp::parse("1868-01-24 23:59:59");
			$eraName = $date->eraName;
			$this->fail('not exeption.');
		} catch(\Exception $e) {
			$this->assertSame('元号が取得できませんでした。', $e->getMessage());
		}
	}

	/**
	 * 和暦（元号イニシャル）
	 */
	public function testEraNameShort()
	{
		// 平成 1989/01/08 〜
		$date = CarbonJp::parse("2016-01-01");
		$expected = "H";
		$this->assertEquals($expected, $date->eraNameShort);

		$date = CarbonJp::parse("1989-01-08 00:00:00");
		$expected = "H";
		$this->assertEquals($expected, $date->eraNameShort);

		// 昭和 1926/12/25 〜 1989/01/07
		$date = CarbonJp::parse("1989-01-07 23:59:59");
		$expected = "S";
		$this->assertEquals($expected, $date->eraNameShort);

		$date = CarbonJp::parse("1926-12-25 00:00:00");
		$expected = "S";
		$this->assertEquals($expected, $date->eraNameShort);

		// 大正 1912/07/30 〜 1926/12/24
		$date = CarbonJp::parse("1926-12-24 23:59:59");
		$expected = "T";
		$this->assertEquals($expected, $date->eraNameShort);

		$date = CarbonJp::parse("1913-07-30 00:00:00");
		$expected = "T";
		$this->assertEquals($expected, $date->eraNameShort);

		// 明治 1868/01/25 〜 1912/07/29
		$date = CarbonJp::parse("1912-07-29 23:59:59");
		$expected = "M";
		$this->assertEquals($expected, $date->eraNameShort);

		$date = CarbonJp::parse("1868-01-25 00:00:00");
		$expected = "M";
		$this->assertEquals($expected, $date->eraNameShort);

		try {
			$date = CarbonJp::parse("1868-01-24 23:59:59");
			$eraNameShort = $date->eraNameShort;
			$this->fail('not exeption.');
		} catch(\Exception $e) {
			$this->assertSame('元号が取得できませんでした。', $e->getMessage());
		}
	}

	/**
	 * 和暦（年数）
	 */
	public function testYearJp()
	{
		// 平成 1989/01/08 〜
		$date = CarbonJp::parse("2016-01-01");
		$expected = 28;
		$this->assertEquals($expected, $date->yearJp);

		$date = CarbonJp::parse("1989-01-08 00:00:00");
		$expected = 1;
		$this->assertEquals($expected, $date->yearJp);

		$expected = "元";
		$this->assertEquals($expected, $date->yearJpGan);

		// 昭和 1926/12/25 〜 1989/01/07
		$date = CarbonJp::parse("1989-01-07 23:59:59");
		$expected = 64;
		$this->assertEquals($expected, $date->yearJp);

		$date = CarbonJp::parse("1926-12-25 00:00:00");
		$expected = 1;
		$this->assertEquals($expected, $date->yearJp);

		$expected = "元";
		$this->assertEquals($expected, $date->yearJpGan);

		// 大正 1912/07/30 〜 1926/12/24
		$date = CarbonJp::parse("1926-12-24 23:59:59");
		$expected = 15;
		$this->assertEquals($expected, $date->yearJp);

		$date = CarbonJp::parse("1912-07-30 00:00:00");
		$expected = 1;
		$this->assertEquals($expected, $date->yearJp);

		$expected = "元";
		$this->assertEquals($expected, $date->yearJpGan);

		// 明治 1868/01/25 〜 1912/07/29
		$date = CarbonJp::parse("1912-07-29 23:59:59");
		$expected = 45;
		$this->assertEquals($expected, $date->yearJp);

		$date = CarbonJp::parse("1868-01-25 00:00:00");
		$expected = 1;
		$this->assertEquals($expected, $date->yearJp);

		$expected = "元";
		$this->assertEquals($expected, $date->yearJpGan);

		try {
			$date = CarbonJp::parse("1868-01-24 23:59:59");
			$eraName = $date->yearJp;
			$this->fail('not exeption.');
		} catch(\Exception $e){
			$this->assertSame('元号が取得できませんでした。', $e->getMessage());
		}

		try {
			$date = CarbonJp::parse("1868-01-24 23:59:59");
			$eraName = $date->yearJpGan;
			$this->fail('not exeption.');
		} catch(\Exception $e){
			$this->assertSame('元号が取得できませんでした。', $e->getMessage());
		}
	}

	/**
	 * 曜日
	 */
	public function testDayOfWeekJp()
	{
		$date = CarbonJp::parse("2016-09-13");
		$expected = "火";
		$this->assertEquals($expected, $date->dayOfWeekJp);

		$date = CarbonJp::parse("2016-09-14");
		$expected = "水";
		$this->assertEquals($expected, $date->dayOfWeekJp);

		$date = CarbonJp::parse("2016-09-15");
		$expected = "木";
		$this->assertEquals($expected, $date->dayOfWeekJp);

		$date = CarbonJp::parse("2016-09-16");
		$expected = "金";
		$this->assertEquals($expected, $date->dayOfWeekJp);

		$date = CarbonJp::parse("2016-09-17");
		$expected = "土";
		$this->assertEquals($expected, $date->dayOfWeekJp);

		$date = CarbonJp::parse("2016-09-18");
		$expected = "日";
		$this->assertEquals($expected, $date->dayOfWeekJp);

		$date = CarbonJp::parse("2016-09-19");
		$expected = "月";
		$this->assertEquals($expected, $date->dayOfWeekJp);
	}

	/**
	 * 午前午後
	 */
	public function testAmPmJp()
	{
		$date = CarbonJp::parse("2016-09-13 03:12:30");
		$expected = "午前";
		$this->assertEquals($expected, $date->ampmJp);

		$date = CarbonJp::parse("2016-09-13 13:12:30");
		$expected = "午後";
		$this->assertEquals($expected, $date->ampmJp);
	}

	/*
	 * Get a part of the Carbon object
	 */
	public function testDefaultProperty()
	{
		$date = CarbonJp::parse("2016-08-15");
		$expected = 8;
		$this->assertEquals($expected, $date->month);

	}

	/**
	 * format
	 */
	public function testFormat() {
		$date = CarbonJp::parse("2016-01-01");
		$expected = "2016-01-01 00:00:00";
		$this->assertEquals($expected, $date);

		$date = CarbonJp::parse("2016-09-02 15:03:08");
		$format = "JK年m月d日(x) Eh時i分s秒";
		$expected = "平成28年09月02日(金) 午後03時03分08秒";
		$this->assertEquals($expected, $date->format($format));

		$date = CarbonJp::parse("2016-09-02 15:03:08");
		$format = "JK年n月j日(x) Eg時i分s秒";
		$expected = "平成28年9月2日(金) 午後3時03分08秒";
		$this->assertEquals($expected, $date->format($format));

		$date = CarbonJp::parse("1926-12-30 15:03:08");
		$format = "JK年n月j日(x) Eg時i分s秒";
		$expected = "昭和元年12月30日(木) 午後3時03分08秒";
		$this->assertEquals($expected, $date->format($format));

		$date = CarbonJp::parse("1926-12-30 15:03:08");
		$format = "Jk年n月j日(x) Eg時i分s秒";
		$expected = "昭和1年12月30日(木) 午後3時03分08秒";
		$this->assertEquals($expected, $date->format($format));
	}
}

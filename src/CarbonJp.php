<?php
/**
 * maccotsan/CarbonJp
 *
 * @copyright 2016 maccotsan <maccotsan@gmail.com>
 * @license The MIT License (MIT)
 */

namespace maccotsan\Carbon;

use Carbon\Carbon;

/**
 * Class CarbonJp
 * @package maccotsan\CarbonJp
 */
class CarbonJp extends Carbon
{
	/**
	 * @var array 元号用設定
	 * @see http://ja.wikipedia.org/wiki/%E5%85%83%E5%8F%B7%E4%B8%80%E8%A6%A7_%28%E6%97%A5%E6%9C%AC%29 元号一覧
	 */
	private static $gengoList = [
		['name' => '平成', 'nameShort' => 'H', 'timestamp' =>  600188400],  // 1989-01-08
		['name' => '昭和', 'nameShort' => 'S', 'timestamp' => -1357635600], // 1926-12-25
		['name' => '大正', 'nameShort' => 'T', 'timestamp' => -1812186000], // 1912-07-30
		['name' => '明治', 'nameShort' => 'M', 'timestamp' => -3216790800], // 1868-01-25
	];

	/**
	 * @var array 日本語曜日設定
	 */
	private static $dayOfWeekJpList = [
		0 => '日',
		1 => '月',
		2 => '火',
		3 => '水',
		4 => '木',
		5 => '金',
		6 => '土',
	];

	/**
	 * @var array 午前午後
	 */
	private static $ampmJpList = [
		'am' => '午前',
		'pm' => '午後',
	];

	/**
	 * Get a part of the Carbon object
	 *
	 * @param string $name
	 *
	 * @throws \InvalidArgumentException
	 *
	 * @return string|int|\DateTimeZone
	 */
	public function __get($name)
	{
		switch ($name) {
			case "eraName":
				return $this->getEraName();
			case "eraNameShort":
				return $this->getEraNameShort();
			case "yearJp":
				return $this->getYearJp();
			case "yearJpGan":
				return $this->getYearJp(true);
			case "dayOfWeekJp":
				return $this->getDayOfWeekJp();
			case "ampmJp":
				return $this->getAmPmJp();
			default:
				return parent::__get($name);
		}
	}

	/**
	 * 和暦などを追加したformatメソッド
	 * via.http://qiita.com/chiyoyo/items/3d12e5b1ef63e7f332ba
	 *
	 * 追加した記号
	 * J : 元号
	 * b : 元号略称
	 * K : 和暦年(1年を元年と表記)
	 * k : 和暦年
	 * x : 日本語曜日
	 * E : 午前午後
	 *
	 * @param string $format DateTime::formatに準ずるformat文字列
	 * @return string
	 */
	public function format($format)
	{
		// J : 元号
		if ($this->isCharactor('J', $format)) {
			$format = $this->replaceCharactor('J', $this->eraName, $format);
		}

		// b : 元号略称
		if ($this->isCharactor('b', $format)) {
			$format = preg_replace('/b/', $this->eraNameShort, $format);
		}

		// K : 和暦用年(元年表示)
		if ($this->isCharactor('K', $format)) {
			$format = $this->replaceCharactor('K', $this->yearJpGan, $format);
		}

		// k : 和暦用年
		if ($this->isCharactor('k', $format)) {
			$format = $this->replaceCharactor('k', $this->yearJp, $format);
		}

		// x : 日本語曜日
		if ($this->isCharactor('x', $format)) {
			$format = $this->replaceCharactor('x', $this->dayOfWeekJp, $format);
		}

		// 午前午後
		if ($this->isCharactor('E', $format)) {
			$format = $this->replaceCharactor('E', $this->ampmJp, $format);
		}

		return parent::format($format);
	}

	/**
	 * 指定した文字があるかどうか調べる（エスケープされているものは除外）
	 * @param string $char 検索する文字
	 * @param string $string 検索される文字列
	 * @return boolean
	 */
	protected function isCharactor($char, $string)
	{
		return preg_match('/(?<!\\\)'.$char.'/', $string);
	}

	/**
	 * 指定した文字を置換する(エスケープされていないもののみ)
	 * @param string $char 置換される文字
	 * @param string $replace 置換する文字列
	 * @param string $string 元の文字列
	 * @return string 置換した文字列
	 */
	protected function replaceCharactor($char, $replace, $string)
	{
		// エスケープされていないもののみ置換
		$string = preg_replace('/(?<!\\\)'.$char.'/', '${1}'.$replace, $string);
		// エスケープ文字を削除
		$string = preg_replace('/\\\\'.$char.'/', $char, $string);
		return $string;
	}

	/**
	 * 現在のタイムスタンプから一致する元号データを取得
	 *
	 * @throws \Exception 対応する元号がない場合
	 * @return array 元号データ
	 */
	protected function getGengo()
	{
		foreach (self::$gengoList as $gengo) {
			if ($gengo['timestamp'] <= $this->getTimestamp()) {
				return $gengo;
			}
		}

		throw new \Exception('元号が取得できませんでした。');
	}

	/**
	 * 和暦（元号）を取得
	 *
	 * @return string 文字列
	 */
	protected function getEraName()
	{
		$gengo = $this->getGengo();
		return $gengo['name'];
	}

	/**
	 * 和暦（元号略称）を取得
	 *
	 * @return string 文字列
	 */
	protected function getEraNameShort()
	{
		$gengo = $this->getGengo();
		return $gengo['nameShort'];
	}

	/**
	 * 和暦（和暦用年）を取得
	 *
	 * @param boolean $useGan 1年目を元年表記するかどうか
	 * @return string 文字列
	 */
	protected function getYearJp($useGan = false)
	{
		$gengo = $this->getGengo();
		$year = $this->year - self::createFromTimestamp($gengo['timestamp'])->year + 1; // ex) 2016 - 1989 + 1 = 28
		if ($useGan) {
			$year = $year == 1 ? '元' : $year;
		}
		return $year;
	}

	/**
	 * 日本語曜日を取得
	 *
	 * @return string 文字列
	 */
	protected function getDayOfWeekJp()
	{
		$w = $this->format('w');
		return self::$dayOfWeekJpList[$w];
	}

	/**
	 * 午前午後を取得
	 *
	 * @return string 文字列
	 */
	protected function getAmPmJp()
	{
		$a = $this->format('a');
		return isset(self::$ampmJpList[$a]) ? self::$ampmJpList[$a] : '';
	}
}

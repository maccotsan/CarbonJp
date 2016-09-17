<?php
/**
 * maccotsan/CarbonJp
 *
 * @copyright 2016 maccotsan <maccotsan@gmail.com>
 * @license The MIT License (MIT)
 */

namespace maccotsan\Carbon;

/**
 * Class CarbonJpUTCTest
 * @package maccotsan\Carbon
 */
class CarbonJpUTCTest extends CarbonJpTest
{
	public function setUp() {
		date_default_timezone_set('UTC');
	}
}

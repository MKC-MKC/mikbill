<?php

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Helper\DeclensionHelper;
use PHPUnit\Framework\TestCase;

/** @see DeclensionHelper */
class DeclensionTest extends TestCase
{

	public function test_1($number = 1, $expected = "1 доллар"): void
	{
		DeclensionHelper::set("usd", ["доллар", "доллара", "долларов"]);
		$data = DeclensionHelper::format(number: $number, key: "usd");
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_2($number = 2, $expected = "2 гривні"): void
	{
		DeclensionHelper::set("грн", ["гривня", "гривні", "гривень"]);
		$data = DeclensionHelper::format(number: $number, key: "грн");
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_3($number = 5, $expected = "5 рублей"): void
	{
		DeclensionHelper::set("руб", ["рубль", "рубля", "рублей"]);
		$data = DeclensionHelper::format(number: $number, key: "руб");
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_4($number = 21, $expected = "21 день"): void
	{
		DeclensionHelper::set("дни", ["день", "дня", "дней"]);
		$data = DeclensionHelper::format(number: $number, key: "дни");
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_5($number = 22, $expected = "22 дня"): void
	{
		DeclensionHelper::set("дни", ["день", "дня", "дней"]);
		$data = DeclensionHelper::format(number: $number, key: "дни");
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_6($number = 116, $expected = "116 дней"): void
	{
		DeclensionHelper::set("дни", ["день", "дня", "дней"]);
		$data = DeclensionHelper::format(number: $number, key: "дни");
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_7($number = 1, $expected = "роутер"): void
	{
		DeclensionHelper::set("роутер", ["роутер", "роутера", "роутеров"]);
		$data = DeclensionHelper::get(number: $number, key: "роутер");
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_8($number = 2, $expected = "роутера"): void
	{
		DeclensionHelper::set("роутер", ["роутер", "роутера", "роутеров"]);
		$data = DeclensionHelper::get(number: $number, key: "роутер");
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_9($number = 5, $expected = "роутеров"): void
	{
		DeclensionHelper::set("роутер", ["роутер", "роутера", "роутеров"]);
		$data = DeclensionHelper::get(number: $number, key: "роутер");
		$this->assertEquals(expected: $expected, actual: $data);
	}

}

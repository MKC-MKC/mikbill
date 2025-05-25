<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
use Haikiri\DeclensionHelper\Declension;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование услуги "Турбо".
 * @cabinet - Клиентские запросы требуют токен клиента.
 */
class ServicesTurboActiveTest extends TestCase
{
	use InitTrait;

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/services/turbo-after.get.json";

	/**
	 * Проверяем стоимость активации услуги "Турбо".
	 */
	public function test_cost($expected = "Вартість активації послуги: 20 гривень"): void
	{
		# Запрашиваем данные.
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();

		$cost = $response->getActivationCost(); # "20.00"
		$currency = $response->getCurrency(); # "грн."
		$template = "Вартість активації послуги: {item} {form}"; # маска

		Declension::set($currency, ["гривня", "гривні", "гривень"]);
		$data = Declension::format(number: $cost, key: $currency, template: $template);

		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_1($expected = false): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->isAvailable();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_2($expected = true): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->isActive();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_3($expected = 20.0): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getActivationCost();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_4($expected = 102400): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getSpeedInBites();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_5($expected = 102400): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getSpeedOutBites();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_6($expected = 24): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getTime();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_7($expected = "25.05.2025 12:13:14"): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getStopTime()?->format("d.m.Y H:i:s");
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_8($expected = 100): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getSpeedIn();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_9($expected = 100): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getSpeedOut();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_10($expected = "грн"): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getCurrency();
		$this->assertEquals(expected: $expected, actual: $data);
	}

}

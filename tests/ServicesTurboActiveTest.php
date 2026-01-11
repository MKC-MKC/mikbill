<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use Tests\Haikiri\MikBiLL\Mock\MikBiLLApiMock as MikBiLLApi;
use Tests\Haikiri\MikBiLL\Trait\InitTrait;
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

	public function test_1($expected = false): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->isAvailable();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_2($expected = true): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->isActive();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_3($expected = 20.0): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getActivationCost();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_4($expected = 102400): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getSpeedInBites();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_5($expected = 102400): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getSpeedOutBites();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_6($expected = 24): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getTime();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_7($expected = "25.05.2025 12:13:14"): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getStopTime()?->format("d.m.Y H:i:s");
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_8($expected = 100): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getSpeedIn();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_9($expected = 100): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getSpeedOut();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_10($expected = "грн"): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();
		$data = $response->getCurrency();
		$this->assertSame(expected: $expected, actual: $data);
	}

}

<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование услуги "Заморозка".
 * @cabinet - Клиентские запросы требуют токен клиента.
 */
class ServicesFreezeInactiveTest extends TestCase
{
	use InitTrait;

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/services/freeze-before.get.json";

	public function test_1($expected = true): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->isAvailable();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_2($expected = false): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->isActive();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_3($expected = 0.0): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->getActivationCost();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_4($expected = 0.0): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->getDeactivationCost();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_5($expected = 0.0): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->getCostDay();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_6($expected = 1): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->getMinDay();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_7($expected = 0): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->getFreeCount();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_8($expected = 1): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->getFreeCountUsed();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_9($expected = "22.02.2020"): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->getDateStart()->format("d.m.Y");
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_10($expected = "23.02.2020"): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->getDateStop()->format("d.m.Y");
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_11($expected = false): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->hasDateStopEver();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_12($expected = true): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->getFreezeEver();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_13($expected = false): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->getReturnAp();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_14($expected = false): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->isBalancePlus();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_15($expected = false): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->isFixedMonth();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_16($expected = false): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->canUnfreezeEarlierPay();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_17($expected = false): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->canUnfreezeEarlierDisallow();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_18($expected = "руб"): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->getCurrency();
		$this->assertSame(expected: $expected, actual: $data);
	}

}

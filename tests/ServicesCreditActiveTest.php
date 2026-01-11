<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование услуги "Кредит".
 * @cabinet - Клиентские запросы требуют токен клиента.
 */
class ServicesCreditActiveTest extends TestCase
{
	use InitTrait;

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/services/credit-after.get.json";

	public function test_1($expected = true): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->isAvailable();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_2($expected = false): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->isActive();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_3($expected = 15.0): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getActivationCost();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_4($expected = 0): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getCreditPercent();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_5($expected = 3): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getType();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_6($expected = "руб"): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getCurrency();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_7($expected = 416.0): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getCreditSum();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_8($expected = true): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->canEarlyLoanRepayment();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_9($expected = 10): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getAvailableDays();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_10($expected = 21): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getCreditDayStart();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_11($expected = 24): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getCreditDayStop();
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_12($expected = "21.05.2025"): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getDateStart()->format("d.m.Y");
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_13($expected = "24.05.2025"): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getDateStop()->format("d.m.Y");
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_14($expected = 3): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getActivationDays();
		$this->assertSame(expected: $expected, actual: $data);
	}

}

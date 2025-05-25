<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
use Haikiri\DeclensionHelper\Declension;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование услуги "Кредит".
 * @cabinet - Клиентские запросы требуют токен клиента.
 */
class ServicesCreditInactiveTest extends TestCase
{
	use InitTrait;

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/services/credit-before.get.json";

	/**
	 * Проверяем стоимость активации услуги "Турбо".
	 */
	public function test_cost($expected = "Стоимость активации 15 рублей!"): void
	{
		# Запрашиваем данные.
		$response = self::$MikBiLL->cabinet->Services()->getCredit();

		$cost = $response->getActivationCost(); # "15.00"
		$currency = $response->getCurrency(); # "руб."
		$template = "Стоимость активации {item} {form}!"; # маска

		Declension::set($currency, ["рубль", "рубля", "рублей"]);
		$data = Declension::format(number: $cost, key: $currency, template: $template);

		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_1($expected = false): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->isAvailable();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_2($expected = true): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->isActive();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_3($expected = 15.0): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getActivationCost();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_4($expected = 0): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getCreditPercent();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_5($expected = -1): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getType();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_6($expected = "руб"): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getCurrency();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_7($expected = 416.0): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getCreditSum();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_8($expected = true): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->canEarlyLoanRepayment();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_9($expected = 10): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getAvailableDays();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_10($expected = 21): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getCreditDayStart();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_11($expected = 24): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getCreditDayStop();
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_12($expected = "21.05.2025"): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getDateStart()->format("d.m.Y");
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_13($expected = "24.05.2025"): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getDateStop()->format("d.m.Y");
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_14($expected = 3): void
	{
		$response = self::$MikBiLL->cabinet->Services()->getCredit();
		$data = $response->getActivationDays();
		$this->assertEquals(expected: $expected, actual: $data);
	}

}

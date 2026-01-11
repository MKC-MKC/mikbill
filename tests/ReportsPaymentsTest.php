<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use Tests\Haikiri\MikBiLL\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Exception\BillApiException;
use Haikiri\MikBiLL\Cabinet\Reports\Payment;
use Tests\Haikiri\MikBiLL\Trait\InitTrait;
use PHPUnit\Framework\TestCase;
use DateTime;

/**
 * Тестирование получения информации об платежах.
 * @cabinet - Клиентские запросы требуют токен клиента.
 */
class ReportsPaymentsTest extends TestCase
{
	use InitTrait;

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/reports/payments.json";

	/**
	 * Возвращаем массив объектов платежей.
	 * @return Payment[]
	 * @throws BillApiException
	 */
	private static function getData(): array
	{
		return self::$MikBiLL->cabinet->Reports()->getPayments(
			limit: 5,
			offset: 0,
			order: "desc",
			from: new DateTime(),
			to: (new DateTime())->modify("+3 days"),
		);
	}

	public function test_getAll($expected = true)
	{
		$response = self::getData(); # Получаем объекты платежей.

		# Можете посмотреть на массив, если включен debug.
		if (self::$debug) {
			foreach ($response as $payment) {
				echo PHP_EOL . str_repeat("=", 30) . PHP_EOL;
				echo "Время события: {$payment->getDate()?->format("d.m.Y в H:i:s")}" . PHP_EOL . PHP_EOL;
				echo "ID: {$payment->getId()}" . PHP_EOL;
				echo "Название: {$payment->getName()}" . PHP_EOL;
				echo "Сумма платежа: {$payment->getSumma()}" . PHP_EOL;
				echo "Тип события: {$payment->getSign()}" . PHP_EOL;
			}
		}

		$data = count($response) > 1;
		$this->assertSame(expected: $expected, actual: $data);
	}

	public function test_1($expected = 34)
	{
		$response = self::getData(); # Получаем объекты платежей.
		$getOne = $response[0]; # Получаем первый результат.

		$this->assertSame(expected: $expected, actual: $getOne->getId());
	}

	public function test_2($expected = 'Услуга "Турбо"')
	{
		$response = self::getData(); # Получаем объекты платежей.
		$getOne = $response[0]; # Получаем первый результат.

		$this->assertSame(expected: $expected, actual: $getOne->getName());
	}

	public function test_3($expected = 20)
	{
		$response = self::getData(); # Получаем объекты платежей.
		$getOne = $response[0]; # Получаем первый результат.

		$this->assertSame(expected: $expected, actual: $getOne->getSumma());
	}

	public function test_4($expected = "?")
	{
		$response = self::getData(); # Получаем объекты платежей.
		$getOne = $response[0]; # Получаем первый результат.

		$this->assertSame(expected: $expected, actual: $getOne->getSign());
	}

	public function test_5($expected = "")
	{
		$response = self::getData(); # Получаем объекты платежей.
		$getOne = $response[0]; # Получаем первый результат.

		$this->assertSame(expected: $expected, actual: $getOne->getComment());
	}

	public function test_6($expected = "25.05.2025 в 14:00:54")
	{
		$response = self::getData(); # Получаем объекты платежей.
		$getOne = $response[0]; # Получаем первый результат.
		$data = $getOne->getDate()->format("d.m.Y в H:i:s");

		$this->assertSame(expected: $expected, actual: $data);
	}

}

<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
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
	 * Возвращаем объекты платежей.
	 * @noinspection PhpUnhandledExceptionInspection
	 */
	private static function getData(): object
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
		$data = $response->getPayments(); # Получаем массив объектов.

		# Можете посмотреть на массив, если включен debug.
		if (self::$debug) {
			foreach ($data as $payment) {
				echo PHP_EOL . str_repeat("=", 30) . PHP_EOL;
				echo "Время события: {$payment->getDate()?->format("d.m.Y в H:i:s")}" . PHP_EOL . PHP_EOL;
				echo "ID: {$payment->getId()}" . PHP_EOL;
				echo "Название: {$payment->getName()}" . PHP_EOL;
				echo "Сумма платежа: {$payment->getSumma()}" . PHP_EOL;
				echo "Тип события: {$payment->getSign()}" . PHP_EOL;
			}
		}

		$data = count($data) > 1;
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_1($expected = 34)
	{
		$response = self::getData(); # Получаем объекты платежей.
		$data = $response->getOne(); # Получаем первый результат.

		$this->assertEquals(expected: $expected, actual: $data->getId());
	}

	public function test_2($expected = 'Услуга "Турбо"')
	{
		$response = self::getData(); # Получаем объекты платежей.
		$data = $response->getOne(); # Получаем первый результат.

		$this->assertEquals(expected: $expected, actual: $data->getName());
	}

	public function test_3($expected = 20)
	{
		$response = self::getData(); # Получаем объекты платежей.
		$data = $response->getOne(); # Получаем первый результат.

		$this->assertEquals(expected: $expected, actual: $data->getSumma());
	}

	public function test_4($expected = "?")
	{
		$response = self::getData(); # Получаем объекты платежей.
		$data = $response->getOne(); # Получаем первый результат.

		$this->assertEquals(expected: $expected, actual: $data->getSign());
	}

	public function test_5($expected = "")
	{
		$response = self::getData(); # Получаем объекты платежей.
		$data = $response->getOne(); # Получаем первый результат.

		$this->assertEquals(expected: $expected, actual: $data->getComment());
	}

	public function test_6($expected = "25.05.2025 в 14:00:54")
	{
		$response = self::getData(); # Получаем объекты платежей.
		$data = $response->getOne(); # Получаем первый результат.
		$data = $data->getDate()->format("d.m.Y в H:i:s");

		$this->assertEquals(expected: $expected, actual: $data);
	}

}

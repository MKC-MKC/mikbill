<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
use PHPUnit\Framework\TestCase;
use DateTime;

/**
 * Тестирование получения информации о сессиях клиента.
 * @cabinet - Клиентские запросы требуют токен клиента.
 */
class ReportsSessionsTest extends TestCase
{
	use InitTrait;

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/reports/sessions.json";

	/**
	 * Возвращаем объекты сессий.
	 * @noinspection PhpUnhandledExceptionInspection
	 */
	private static function getData(): object
	{
		return self::$MikBiLL->cabinet->Reports()->getSessions(
			limit: 2,
			offset: 0,
			order: "ASC",
			from: new DateTime(),
			to: (new DateTime())->modify("+3 days"),
		);
	}

	public function test_getAll($expected = true)
	{
		$response = self::getData(); # Получаем объекты сессий.
		$data = $response->getSessions(); # Получаем массив сессий.

		# Можете посмотреть на массив, если включен debug.
		if (self::$debug) {
			foreach ($data as $session) {
				echo PHP_EOL . str_repeat("=", 30) . PHP_EOL;
				echo "Time On: {$session->getTimeOn()}" . PHP_EOL;
				echo "Начало сессии: {$session->getStartDateTime()?->format("d.m.Y в H:i:s")}" . PHP_EOL;
				echo "Конец сессии: {$session->getStopDateTime()?->format("d.m.Y в H:i:s")}" . PHP_EOL . PHP_EOL;

				echo "Username: {$session->getUsername()}" . PHP_EOL;
				echo "Баланс вначале: {$session->getBillingBefore()}" . PHP_EOL;
				echo "Billing Minus: {$session->getBillingMinus()}" . PHP_EOL . PHP_EOL;

				echo "Call From: {$session->getCallFrom()}" . PHP_EOL;
				echo "IP: {$session->getIpAddress()}" . PHP_EOL;
				echo "IP Framed: {$session->getFramedIpAddress()}" . PHP_EOL;
				echo "IN: {$session->getIn()}" . PHP_EOL;
				echo "OUT: {$session->getOut()}" . PHP_EOL;
			}
		}

		$data = count($data) > 1;
		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_1($expected = "username")
	{
		$response = self::getData();
		$data = $response->getOne();

		$this->assertEquals(expected: $expected, actual: $data->getUsername());
	}

	public function test_2($expected = 332.718616)
	{
		$response = self::getData();
		$data = $response->getOne();

		$this->assertEquals(expected: $expected, actual: $data->getBillingBefore());
	}

	public function test_3($expected = 0.0)
	{
		$response = self::getData();
		$data = $response->getOne();

		$this->assertEquals(expected: $expected, actual: $data->getBillingMinus());
	}

	public function test_4($expected = 1300127)
	{
		$response = self::getData();
		$data = $response->getOne();

		$this->assertEquals(expected: $expected, actual: $data->getTimeOn());
	}

	public function test_5($expected = "04.12.2024 в 11:17:47")
	{
		$response = self::getData();
		$data = $response->getOne();
		$data = $data->getStartDateTime()?->format("d.m.Y в H:i:s");

		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_6($expected = "19.12.2024 в 12:26:34")
	{
		$response = self::getData();
		$data = $response->getOne();
		$data = $data->getStopDateTime()?->format("d.m.Y в H:i:s");

		$this->assertEquals(expected: $expected, actual: $data);
	}

	public function test_7($expected = "")
	{
		$response = self::getData();
		$data = $response->getOne();

		$this->assertEquals(expected: $expected, actual: $data->getCallFrom());
	}

	public function test_8($expected = "10.100.111.254")
	{
		$response = self::getData();
		$data = $response->getOne();

		$this->assertEquals(expected: $expected, actual: $data->getIpAddress());
	}

	public function test_9($expected = "10.100.111.254")
	{
		$response = self::getData();
		$data = $response->getOne();

		$this->assertEquals(expected: $expected, actual: $data->getFramedIpAddress());
	}

	public function test_10($expected = 28120.4)
	{
		$response = self::getData();
		$data = $response->getOne();

		$this->assertEquals(expected: $expected, actual: $data->getIn());
	}

	public function test_11($expected = 3860.2)
	{
		$response = self::getData();
		$data = $response->getOne();

		$this->assertEquals(expected: $expected, actual: $data->getOut());
	}

}

<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use PHPUnit\Framework\TestCase;

class CommonTest extends TestCase
{
	private static MikBiLLApi $MikBiLL;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";

	public static function processData($path): void
	{
		# Подготовка тестовых данных.
		$json = file_get_contents($path);

		# Инициализация MikBiLL SDK.
		self::$MikBiLL = new Mock\MikBiLLApiMock(
			url: "http://api.mikbill.local",
			key: self::$signKey,
			mockedData: $json,
		);

		# Записываем токен пользователя.
		self::$MikBiLL->setUserToken(self::$token);
	}

	public function test_getIp($expected = "10.11.12.13"): void
	{
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/getip.get.json");
		$data = self::$MikBiLL->cabinet->Common()->getIp();
		$this->assertEquals(expected: $expected, actual: $data->getIp());
	}

	public function test_getDatePlain($expected = "2025-05-22 15:00:00"): void
	{
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/serverdate.get.json");
		$data = self::$MikBiLL->cabinet->Common()->getDate();
		$this->assertEquals(expected: $expected, actual: $data->getFormat());
	}

	public function test_getDateTimeInEuropeanFormat($expected = "22.05.2025 15:00:00"): void
	{
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/serverdate.get.json");
		$result = self::$MikBiLL->cabinet->Common()->getDate();
		$date = $result->getDateTime(to: "UTC"); # Преобразовать время сервера в UTC.
		$data = $date->format("d.m.Y H:i:s"); # Возвращаем время в формате Европы.
		$this->assertEquals(expected: $expected, actual: $data);
	}

}

<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование получения конфигурации сервера.
 * @cabinet - Клиентские запросы требуют токен клиента.
 */
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
		self::$MikBiLL = new MikBiLLApi(
			url: "http://api.mikbill.local",
			key: self::$signKey,
			mockedData: $json,
		);

		# Записываем токен пользователя.
		self::$MikBiLL->setUserToken(self::$token);
	}

	public function test_1($expected = "10.11.12.13"): void
	{
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/getip.get.json");
		$data = self::$MikBiLL->cabinet->Common()->getIp();
		$this->assertSame(expected: $expected, actual: $data->getIp());
	}

	public function test_2($expected = "22.05.2025 15:00:00"): void
	{
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/serverdate.get.json");
		$data = self::$MikBiLL->cabinet->Common()->getDate()->getDateTime();
		$this->assertSame(expected: $expected, actual: $data?->format("d.m.Y H:i:s"));
	}

}

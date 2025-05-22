<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use PHPUnit\Framework\TestCase;

class UserServicesTest extends TestCase
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

	public function test_getCredit_before($expected = "21.05.2025"): void
	{
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/services/credit-before.get.json");
		$data = self::$MikBiLL->cabinet->Services()->getCredit();
		$this->assertEquals(expected: $expected, actual: $data->getDateStart()->format("d.m.Y"));
	}

	public function test_getCredit_after($expected = "24.05.2025"): void
	{
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/services/credit-after.get.json");
		$data = self::$MikBiLL->cabinet->Services()->getCredit();
		$this->assertEquals(expected: $expected, actual: $data->getDateStop()->format("d.m.Y"));
	}

}

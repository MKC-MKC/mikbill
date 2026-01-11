<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL\Trait;

use Tests\Haikiri\MikBiLL\Mock;

trait InitTrait
{

	public static function setUpBeforeClass(): void
	{
		# Подготовка тестовых данных.
		$json = file_get_contents(self::$dataFile);

		# Инициализация MikBiLL SDK.
		self::$MikBiLL = new Mock\MikBiLLApiMock(
			url: "http://api.mikbill.local",
			key: self::$signKey,
			mockedData: $json,
		);

		# Управляем логами.
		self::$MikBiLL::$debug = self::$debug;

		# Записываем токен пользователя.
		self::$MikBiLL->setUserToken(self::$token);
	}

}

<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL\Mock;

trait CreateApi
{
	public static function fromFile(string $path): MikBiLLApiMock
	{
		# Получаем файл.
		$json = (string)file_get_contents($path);

		# Инициализация MikBiLL SDK.
		$MikBiLL = new MikBiLLApiMock(
			url: "http://api.mikbill.local",
			key: (string)static::$signKey,
			mockedData: $json,
		);

		# Записываем токен.
		$MikBiLL->setUserToken(static::$token);
		return $MikBiLL;
	}
}

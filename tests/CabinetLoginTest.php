<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
use PHPUnit\Framework\TestCase;

/**
 * @cabinet - Клиентский запрос требующий токен клиента. 
 */
class CabinetLoginTest extends TestCase
{
	use InitTrait;

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/auth/login.post.json";

	public function test()
	{
		# Валидация данных.
		$username = "UserName"; # логин
		$password = "UserPass"; # пароль

		# Выполняем запрос в Billing.
		$response = self::$MikBiLL->cabinet->Auth()->login($username, $password);

		# Получаем токен клиента из ответа.
		$token = $response->getToken();

		# Если включен debug - выводим состояние.
		if (self::$debug) echo $token ? "Успешно авторизовались.\n" : "Не удалось авторизоваться.\n";

		# Обязательно записываем токен в stateless хранилище SDK для последующих запросов.
		self::$MikBiLL->setUserToken(token: $token);

		# Получаем токен из хранилища.
		$data = self::$MikBiLL->getUserToken();

		# Убеждаемся в корректности полученных данных.
		$this->assertEquals(expected: self::$token, actual: $data);
	}

}
